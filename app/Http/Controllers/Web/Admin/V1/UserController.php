<?php

namespace App\Http\Controllers\Web\Admin\V1;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Session;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.users.index' , compact("users"));
    }

    public function create()
    {
        $roles = Role::all();
        if(count($roles) == 0){
            Session::flash('warning' , 'Роли не существуют!');
            return redirect()->back();
        }
        return view('admin.users.create', compact("roles"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required',
            'phone_number' =>'required',
            'email' =>'required| email| unique:users',
            'password' =>'required',
            'repassword' =>'required',
            'role_id' =>'required|numeric| min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else if($request->password != $request->repassword){
            Session::flash('warning' , 'Пароли не совпадают!');
            return redirect()->back();
        }else{
            $user =  new User();
            $user->fill($request->all());
            $user->password = bcrypt($user->password);
            $user->save();
            Session::flash('success' , 'Пользователь успешно добавлен!');
            return redirect()->back();
        }
    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            Session::flash('success' , 'Пользователь успешно удален!');
        }else{
            Session::flash('error' , 'Пользователь не существует!');
        }
        return redirect()->back();
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        if(!$user){
            Session::flash('error' , 'Пользователь не существует!');
            return redirect()->back();
        }

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
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

    public function updatePassword(Request $request, $id){
        $user = User::find($id);
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
