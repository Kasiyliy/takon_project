<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginCashierRequest extends ApiBaseRequest
{

    public function injectedRules()
    {
        return [
            'login',
	        'password'
        ];
    }
}
