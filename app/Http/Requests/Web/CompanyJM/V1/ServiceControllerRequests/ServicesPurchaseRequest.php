<?php

namespace App\Http\Requests\Web\CompanyJM\V1\ServiceControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;

class ServicesPurchaseRequest extends WebBaseRequest
{
    public function injectedRules()
    {
        return [
            'amount' => ['required', 'numeric'],
        ];
    }
}
