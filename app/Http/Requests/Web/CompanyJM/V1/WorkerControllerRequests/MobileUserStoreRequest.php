<?php

namespace App\Http\Requests\Web\CompanyJM\V1\WorkerControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class MobileUserStoreRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'string'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
        ];
    }
}

