<?php

namespace App\Http\Controllers\Api\MobileUser;

use App\Code;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Utils\ApiUtil;

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
        $this->makeResponse(200, true, ["message" => "success"]);
    }

}
