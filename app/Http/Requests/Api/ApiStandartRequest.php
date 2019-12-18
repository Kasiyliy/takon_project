<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ApiStandartRequest extends ApiBaseRequest
{

    public function injectedRules()
    {
        return [

        ];
    }
}
