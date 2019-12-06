<?php

namespace App\Http\Controllers;

use App\Http\Core\interfaces\WithUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class WebBaseController extends Controller implements WithUser
{
    public function warning()
    {
        Session::flash('warning', trans('admin.problems'));

    }

    public function added()
    {
        Session::flash('warning', trans('admin.added'));
    }

	public function inModeration()
	{
		Session::flash('warning', "Отправлено на мoдерацию администратору сайта");
	}

    public function deleted()
    {
        Session::flash('warning', trans('admin.deleted'));
    }

    public function edited()
    {
        Session::flash('warning', trans('admin.edited'));
    }

    public function notFound()
    {
        Session::flash('warning', trans('admin.not.found'));
    }


    public function error()
    {
        Session::flash('error', trans('admin.error'));
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }


}
