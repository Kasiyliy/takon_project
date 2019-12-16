<?php

namespace App\Http\Controllers\Api\MobileUser\V1;

use App\Account;
use App\Code;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Utils\ApiUtil;
use App\MobileUser;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;

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

    public function checkCode(CheckCodeRequest $request){
		$codeModel = Code::where('phone', $request->phone)->where('code', $request->code)->first();
		if ($codeModel){

			$user = User::where('phone', $request->phone)->first();
			DB::beginTransaction();

			try{
				if($user){
					$user->token = ApiUtil::generateToken();
					$user->save();
				}else{
					$user = new User();
					$user->username = $request->phone;
					$user->phone_number = $user->phone;
//			$user->password = bcrypt($request->password);
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
			}catch (\Exception $exception){
				DB::rollBack();
//				return $this->makeResponse(200, false, ['errors' => $exception->getMessage()]);
			}


		}else{

			return $this->makeResponse(401, false, []);
		}
    }

}
