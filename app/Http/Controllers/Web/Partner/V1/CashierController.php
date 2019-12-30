<?php

namespace App\Http\Controllers\Web\Partner\V1;

use App\Account;
use App\Cashier;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\Partner\V1\CashierControllerRequests\CashierStoreRequest;
use App\Http\Utils\ApiUtil;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;
use Session;

class CashierController extends WebBaseController
{
    //CASHIERS
    public function cashiers()
    {
        $users = User::with('role', 'cashier')
            ->where('role_id', Role::ROLE_CASHIER_ID)
            ->get();
        return view('partner.cashiers.index', compact("users"));
    }

    public function cashiersEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_CASHIER_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('partner.cashiers.edit', compact('user'));
    }

	public function cashiersQr($id)
	{
		$user = User::with('cashier')->where('role_id', Role::ROLE_CASHIER_ID)->find($id);
		if (!$user) {
			Session::flash('error', 'Пользователь не существует!');
			return redirect()->back();
		}
		return view('partner.cashiers.qr', compact('user'));
	}

    public function cashiersCreate()
    {
        return view('partner.cashiers.create');
    }

    public function cashiersStore(CashierStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username;
            $user->phone_number = $user->username;
            $user->password = md5($request->password);
            $user->role_id = Role::ROLE_CASHIER_ID;
			$user->token = ApiUtil::generateToken();
            $user->save();

            $account = new Account();
            $account->role_id = $user->role_id;
            $account->save();

            $cashier = new Cashier();
            $cashier->account_id = $account->id;
            $cashier->user_id = $user->id;
            $cashier->partner_id = Auth::user()->partner->id;
            $cashier->name = $request->name;
            $cashier->token_hash = ApiUtil::generateToken();
            $cashier->save();

            DB::commit();
            $this->added();
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь пожалуйста к администратору сайта!");
        }
    }



}
