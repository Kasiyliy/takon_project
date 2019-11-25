<?php

namespace App\Http\Controllers\Web\Common\V1;

use App\Http\Controllers\WebBaseController;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

class UserController extends WebBaseController
{



    public function selfEdit(){
        $user = Auth::user();
        $roles = Role::all();
        if(!$user){
            Session::flash('error' , 'Пользователь не существует!');
            return redirect()->back();
        }

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function selfUpdate(Request $request){
        $user = Auth::user();
        if(!$user){
            Session::flash('error' , 'Пользователь не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required',
            'phone_number' =>'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else{
            $user->fill($request->all());
            $user->save();
            Session::flash('success' , 'Пользователь успешно обновлен!');
            return redirect()->back();
        }
    }

    public function selfUpdatePassword(Request $request){
        $user = Auth::user();
        if(!$user){
            Session::flash('error' , 'Пользователь не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'password' =>'required',
            'repassword' =>'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error' , 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        }else if($request->password != $request->repassword){
            Session::flash('warning' , 'Пароли не совпадают!');
            return redirect()->back();
        }else{
            $user->fill($request->all());
            $user->password = bcrypt($user->password);
            $user->save();
            Session::flash('success' , 'Пользователь успешно обновлен!');
            return redirect()->back();
        }
    }



}
