<?php

namespace App\Http\Requests;


use App\Http\Core\interfaces\WithUser;
use App\Http\Errors\ErrorCode;
use App\Http\Utils\ResponseUtil;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiBaseRequest extends FormRequest implements WithUser
{
    public function authorize()
    {
        return true;
    }

    public function getCurrentUser(){
        return request()->user;
    }

    public abstract function injectedRules();

    public function rules()
    {
        return $this->injectedRules();
    }

    protected function failedValidation(Validator $validator)
    {
        $response = ResponseUtil::makeResponse(
            400,
            false,
            [
                'errorCode' => ErrorCode::INVALID_FIELD,
                'errors' => $validator->errors()
            ]
        );
        throw new HttpResponseException($response);
    }
}
