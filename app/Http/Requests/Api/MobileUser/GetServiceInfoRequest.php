<?php

namespace App\Http\Requests\Api\MobileUser;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetServiceInfoRequest extends ApiBaseRequest
{

    public function injectedRules()
    {
        return [
            'service_id' => 'required'
        ];
    }
}
