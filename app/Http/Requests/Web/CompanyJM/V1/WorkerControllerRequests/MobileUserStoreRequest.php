<?php

namespace App\Http\Requests\Web\CompanyJM\V1\WorkerControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class MobileUserStoreRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}

