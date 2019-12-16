<?php

namespace App\Http\Requests\Web\Partner\V1\CashierControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class CashierStoreRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'string'],
            'name' => ['required', 'string'],
        ];
    }
}
