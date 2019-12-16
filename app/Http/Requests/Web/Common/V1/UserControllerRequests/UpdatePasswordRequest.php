<?php

namespace App\Http\Requests\Web\Common\V1\UserControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class UpdatePasswordRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'password' => ['required', 'confirmed', 'min:8', 'string'],
        ];
    }
}
