<?php

namespace App\Http\Requests\Web\CompanyJM\V1\GroupControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class ChangeGroupRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'mobile_user_id' => ['required', 'numeric'],
            'group_id' => ['required', 'numeric'],
        ];
    }
}
