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
        Session::flash('warning', 'Ошибка!');

    }

    public function added()
    {
        Session::flash('warning', 'Добавлено!');
    }

	public function inModeration()
	{
		Session::flash('warning', "Отправлено на мoдерацию администратору сайта");
	}

    public function deleted()
    {
        Session::flash('warning', 'Удалено!');
    }

    public function edited()
    {
        Session::flash('warning', 'Обновлено!');
    }

    public function notFound()
    {
        Session::flash('warning', 'Не найдено!');
    }


    public function error()
    {
        Session::flash('error', 'Ошибка!');
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getCurrentUserId()
    {
        return Auth::id();
    }

}
