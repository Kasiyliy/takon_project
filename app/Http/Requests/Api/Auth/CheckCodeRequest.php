<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiBaseRequest;

class CheckCodeRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'code' => 'required|max:4',
            'phone' => 'required'
        ];
    }

}
