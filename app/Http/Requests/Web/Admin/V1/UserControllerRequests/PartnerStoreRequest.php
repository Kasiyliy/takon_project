<?php

namespace App\Http\Requests\Web\Admin\V1\UserControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class PartnerStoreRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'string'],
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'string']
        ];
    }
}
