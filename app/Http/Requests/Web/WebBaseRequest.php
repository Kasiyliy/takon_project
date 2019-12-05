<?php

namespace App\Http\Requests\Web;

use App\Exceptions\WebServiceException;
use App\Http\Core\interfaces\WithUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Session;

abstract class WebBaseRequest extends FormRequest implements WithUser
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public abstract function injectedRules();

    public function rules()
    {
        return $this->injectedRules();
    }

    protected function failedValidation(Validator $validator)
    {
        Session::flash('error', trans('admin.error'));
        throw new WebServiceException($validator, request()->all());
    }

    public function getCurrentUserId()
    {
        return Auth::id();
    }


}
