<?php

namespace App\Http\Requests\Web\Partner\V1\ServiceControllerRequests;

use App\Http\Requests\Web\WebBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends WebBaseRequest
{
	public function injectedRules()
	{
		return [
			'name' => 'required',
			'price' => 'required',
			'expiration_days' => 'required',
		];
	}


}
