<?php

namespace App\Http\Requests\Api\MobileUser;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SendFriendRequest extends ApiBaseRequest
{

    public function injectedRules()
    {
        return [
            'amount' => 'required|int',
	        'id' => 'required',
	        'phone' => 'required',
        ];
    }
}
