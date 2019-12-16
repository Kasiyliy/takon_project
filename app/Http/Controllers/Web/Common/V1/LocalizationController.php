<?php

namespace App\Http\Controllers\Web\Common\V1;

use App\Http\Controllers\WebBaseController;
use Session;
use Validator;

class LocalizationController extends WebBaseController
{
    public function index($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        Session::flash('success', trans('config.locale.changed'));
        return redirect()->back();
    }
}
