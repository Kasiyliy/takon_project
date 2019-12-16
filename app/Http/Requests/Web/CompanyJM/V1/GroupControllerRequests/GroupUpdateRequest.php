<?php

namespace App\Http\Requests\Web\CompanyJM\V1\GroupControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class GroupUpdateRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
