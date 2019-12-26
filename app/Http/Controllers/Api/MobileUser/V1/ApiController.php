<?php

namespace App\Http\Controllers\Api\MobileUser\V1;

use App\Account;
use App\AccountCompanyOrder;
use App\AccountCompanyOrderStatus;
use App\Cashier;
use App\Code;
use App\Exceptions\ApiServiceException;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\MobileUser\GetServiceInfoRequest;
use App\Http\Requests\Api\MobileUser\GetServicesRequest;
use App\Http\Requests\Api\MobileUser\PayRequest;
use App\Http\Requests\Api\MobileUser\QRGenerateRequest;
use App\Http\Requests\Api\MobileUser\QRScanRequest;
use App\Http\Requests\Api\MobileUser\SendFriendRequest;
use App\Http\Services\TransactionService;
use App\Http\Utils\ApiUtil;
use App\MobileUser;
use App\ModerationStatus;
use App\Partner;
use App\QrCode;
use App\Role;
use App\User;
use App\UserSubscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiController extends ApiBaseController
{
	public function logIn(LoginRequest $request)
	{

		// find and delete all previous sms codes
		$codes = Code::where('phone', $request->phone)->get();
		foreach ($codes as $code) {
			$code->delete();
		}

		// create new model for sms code
		$code = new Code();
		$code->phone = $request->phone;
		$code->code = ApiUtil::generateSmsCode();
		$code->save();

		// send sms to this number with generated random code
		ApiUtil::sendAuthSms($request->phone, $code->code);
		return $this->makeResponse(200, true, ["message" => "success"]);
	}

	public function checkCode(CheckCodeRequest $request)
	{
		$codeModel = Code::where('phone', $request->phone)->where('code', $request->code)->first();
		if ($codeModel) {

			$user = User::where('phone_number', $request->phone)->first();
			DB::beginTransaction();

			try {
				if ($user) {
					$user->token = ApiUtil::generateToken();
					$user->save();
				} else {
					$user = new User();
					$user->username = $request->phone;
					$user->phone_number = $request->phone;
					$user->password = bcrypt($request->phone);
					$user->token = ApiUtil::generateToken();
					$user->role_id = Role::ROLE_MOBILE_USER_ID;
					$user->save();

					$account = new Account();
					$account->role_id = Role::ROLE_MOBILE_USER_ID;
					$account->save();

					$mobileUser = new MobileUser();
					$mobileUser->account_id = $account->id;
					$mobileUser->user_id = $user->id;
					$mobileUser->save();
				}
				DB::commit();
				return $this->makeResponse(200, true, ['token' => $user->token, 'user' => $user]);
			} catch (ApiServiceException $exception) {
				DB::rollBack();
				return $this->makeResponse(200, false, ['errors' => $exception->getMessage()]);
			}


		} else {

			return $this->makeResponse(401, false, []);
		}
	}


	public function getPartners()
	{
		$user = $this->getCurrentUser();
		$subscriptions = DB::table('user_subscriptions')
			->join('partners', 'user_subscriptions.partner_id', '=', 'partners.id')
			->where('user_subscriptions.user_id', $user->id)
//			->groupBy('partners.id')
			->select('partners.*')
			->get();

		return $this->makeResponse(200, true, ['partners' => $subscriptions]);
	}


	public function getServices(GetServicesRequest $request)
	{

		$data = DB::table('services')
			->leftJoin('company_orders as co', 'services.id', '=', 'co.service_id')
			->leftJoin('account_company_orders as aco', 'co.id', '=', 'aco.company_order_id')
			->leftJoin('accounts as a', function ($leftJoin) use ($request) {
				$leftJoin->on('a.id', '=', 'aco.account_id')
					->where('a.id', $this->getCurrentUser()->mobileUser->account_id);
			})
			->where('services.partner_id', $request->partner_id)
			->where('services.moderation_status_id', ModerationStatus::MODERATION_STATUS_APPROVED_ID)
			->selectRaw('services.*, SUM(IFNULL(aco.amount, 0)) as usersAmount')
			->groupBy('services.id')
			->get();

		return $this->makeResponse(200, true, ['services' => $data]);
	}

	public function getAllPartners()
	{
		$partners = DB::table('user_subscriptions')
			->where('user_id', $this->getCurrentUser()->id)
			->select('partner_id')
			->get();
		$ids = [];
		foreach ($partners as $partner) {
			array_push($ids, $partner->partner_id);
		}
		$res = Partner::all();
		$final = [];
		foreach ($res as $r) {
			if (in_array($r->id, $ids)) {
				$result['has'] = true;
			} else {
				$result['has'] = false;
			}
			$result['id'] = $r->id;
			$result['name'] = $r->name;
			$result['image_path'] = $r->image_path;
			array_push($final, $result);
		}
		return $this->makeResponse(200, true, ['partners' => $final]);
	}

	public function subscribe(GetServicesRequest $request)
	{
		$partner = Partner::findOrFail($request->partner_id);
		$subscriptions = UserSubscription::where('partner_id', $partner->id)->where('user_id', $this->getCurrentUser()->id)->get();
		foreach ($subscriptions as $subscription) {
			$subscription->delete();
		}
		$subscription = new UserSubscription();
		$subscription->user_id = $this->getCurrentUser()->id;
		$subscription->partner_id = $partner->id;
		$subscription->save();
		return $this->makeResponse(200, true, []);

	}

	public function removeSubscription(GetServicesRequest $request)
	{
		$subscriptions = UserSubscription::where('partner_id', $request->partner_id)->where('user_id', $this->getCurrentUser()->id)->first();
		$subscriptions->delete();
		return $this->makeResponse(200, true, []);

	}

	public function getServiceInfo(GetServiceInfoRequest $request)
	{

		$data = DB::table('account_company_orders')
			->join('company_orders as co', 'account_company_orders.company_order_id', '=', 'co.id')
			->join('services as s', 'co.service_id', '=', 's.id')
			->join('companies as c', 'co.company_id', '=', 'c.id')
			->where('s.id', $request->service_id)
			->where('account_company_orders.account_id', $this->getCurrentUser()->mobileUser->account_id)
			->selectRaw('account_company_orders.id, account_company_orders.amount, s.name, c.name, co.due_date')
			->groupBy('account_company_orders.id')
			->get();

		return $this->makeResponse(200, true, ['data' => $data]);


		/*
			SELECT account_company_orders.amount,
			s.name, c.name, co.due_date
			from account_company_orders
			inner join company_orders co on account_company_orders.company_order_id = co.id
			inner join services s on co.service_id = s.id
			inner join companies c on co.company_id = c.id
			where s.id = 2 and account_company_orders.account_id = 4
			group by account_company_orders.id;
		 */
	}


	public function sendFriend(SendFriendRequest $request)
	{
		$userService = AccountCompanyOrder::findOrFail($request->id);
		if ($userService->amount < $request->amount) {
			return $this->makeResponse(200, false, ['error' => 'Нелостаточно таконов']);
		}
		$user = User::with('mobileUser')->where('phone_number', $request->phone)->first();
		if (!$user) {
			return $this->makeResponse(200, false, ['error' => 'Пользователь не найден']);
		}

		try {

			DB::beginTransaction();
			$recieversService = AccountCompanyOrder::where('company_order_id', $userService->company_order_id)
				->where('account_id', $user->mobileUser->account_id)->first();
			if ($recieversService) {
				$recieversService->amount += $request->amount;
			} else {
				$recieversService = new AccountCompanyOrder();
				$recieversService->amount = $request->amount;
				$recieversService->account_id = $user->mobileUser->account_id;
				$recieversService->company_order_id = $userService->company_order_id;
				$recieversService->account_company_order_status_id = $userService->account_company_order_status_id;
			}
			$recieversService->save();
			TransactionService::SendTakonToFriend($userService, $request->amount, $recieversService);
			DB::commit();
			return $this->makeResponse(200, true, []);

		} catch (\Exception $exception) {
			DB::rollBack();
			throw new ApiServiceException(200, false, ['errors' => $exception->getMessage()]);
		}


	}

	public function generateQr(QRGenerateRequest $request)
	{

		$aco = AccountCompanyOrder::where('id', $request->id)->first();
		if ($aco->account_id != $this->getCurrentUser()->mobileUser->account_id) {
			return $this->makeResponse(200, false, ['incorrect id']);
		}
		$qrCode = new QrCode();
		$qrCode->token_hash = Str::random(65);
		$qrCode->account_company_order_id = $request->id;
		$qrCode->amount = $request->amount;
		$qrCode->save();
		return $this->makeResponse(200, true, []);
	}

	public function scan(QRScanRequest $request)
	{
		$cashier = Cashier::where('token_hash', $request->qrstring)->first();
		if ($cashier) {
			$partner = Partner::where('id', $cashier->partner_id)->first();
			return $this->makeResponse(200, true, ['partner_id' => $partner->id, 'partner_name' => $partner->name, 'user_id' => $cashier->id, 'partner' => $partner]);
		} else {
			$qrModel = QrCode::with('accountCompanyOrder')->where('token_hash', $request->qrstring)->first();
			if ($this->getCurrentUser()->isMobileUser()) {
				try {
					DB::beginTransaction();
					$aco = AccountCompanyOrder::where('company_order_id', $qrModel->accountCompanyOrder->id)
						->where('account_id', $this->getCurrentUser()->mobileUser->account_id)->first();
					if ($aco) {
						$aco->amount += $qrModel->amount;
					} else {
						$aco = new AccountCompanyOrder();
						$aco->amount = $qrModel->amount;
						$aco->account_id = $this->getCurrentUser()->mobileUser->account_id;
						$aco->company_order_id = $qrModel->accountCompanyOrder->company_order_id;
						$aco->account_company_order_status_id = AccountCompanyOrderStatus::STATUS_TRANSFERRED_ID;
					}
					$aco->save();
					TransactionService::SendTakonToFriend($qrModel->accountCompanyOrder, $qrModel->amount, $aco);
					DB::commit();
					return $this->makeResponse(200, true, []);
				} catch (\Exception $exception) {
					DB::rollBack();
					throw new ApiServiceException(200, false, ['error' => $exception->getMessage()]);
				}

			}
		}

	}

	public function pay(PayRequest $request)
	{
		DB::beginTransaction();
		try {
			$aco = AccountCompanyOrder::where('id', $request->id)->first();
			$cashier = Cashier::where('id', $request->user_id)->first();
			if ($aco->amount < $request->amount) {
				return $this->makeResponse(200, false, ['error' => $cashier]);
			}
			$aco->amount -= $request->amount;
			$aco->save();
			TransactionService::Pay($aco, $cashier, $request->amount);
		} catch (\Exception $exception) {
			throw new ApiServiceException(200, false, ['errors' => $exception->getMessage()]);
		}

	}

}
