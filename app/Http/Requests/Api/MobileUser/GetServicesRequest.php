<?php

namespace App\Http\Requests\Api\MobileUser;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetServicesRequest extends ApiBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function injectedRules()
    {
        return [
            'partner_id' => 'required'
        ];
    }
}
