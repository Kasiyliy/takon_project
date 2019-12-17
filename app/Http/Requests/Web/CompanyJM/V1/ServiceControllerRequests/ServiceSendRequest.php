<?php

namespace App\Http\Requests\Web\CompanyJM\V1\ServiceControllerRequests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceSendRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required',
            'id' => 'required',
	        'amount' => 'required|int'
        ];
    }
}
