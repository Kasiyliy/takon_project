<?php

namespace App\Http\Controllers\Api\MobileUser\V1;

use App\Account;
use App\Code;
use App\Exceptions\ApiServiceException;
use App\Http\Controllers\ApiBaseController;
use App\Http\Errors\ErrorCode;
use App\Http\Requests\Api\ApiBaseRequest;
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

    public function checkCode(CheckCodeRequest $request)
    {
        $codeModel = Code::where('phone', $request->phone)->where('code', $request->code)->first();
        if ($codeModel) {
            $user = User::where('phone', $request->phone)->first();
            DB::beginTransaction();

            try {
                if ($user) {
                    $user->token = ApiUtil::generateToken();
                    $user->save();
                }
                DB::commit();
                return $this->makeResponse(200, true, ['token' => $user->token, 'user' => $user]);
            } catch (\Exception $exception) {
                DB::rollBack();
                throw new ApiServiceException(200, false, [
                    'errorCode' => ErrorCode::SYSTEM_ERROR,
                    'errors' => [
                        'System error'
                    ]
                ]);
            }
        } else {
            return $this->makeResponse(401, false, []);
        }
    }


    public function getPartners(ApiBaseRequest $request)
    {
        $user = $request->user;

    }


}
