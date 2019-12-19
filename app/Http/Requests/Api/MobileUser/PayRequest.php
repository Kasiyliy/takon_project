<?php

namespace App\Http\Requests\Api\MobileUser;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends ApiBaseRequest
{

    public function injectedRules()
    {
        return [
            'user_id' => 'required',
	        'id' => 'required',
	        'amount' => 'required',
        ];
    }
}
