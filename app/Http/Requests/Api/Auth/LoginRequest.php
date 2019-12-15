<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class LoginRequest extends ApiBaseRequest
{

    public function injectedRules()
    {
        return [
            'phone' => 'required'
        ];
    }


}
