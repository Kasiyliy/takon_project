<?php

namespace App\Http\Requests\Web\Admin\V1\RoleControllerRequests;


use App\Http\Requests\Web\WebBaseRequest;

class UpdateRoleRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'name' => 'required',
        ];
    }
}
