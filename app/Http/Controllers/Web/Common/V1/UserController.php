<?php

namespace App\Http\Controllers\Web\Common\V1;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\Common\V1\UserControllerRequests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Session;
use Validator;

class UserController extends WebBaseController
{

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }

        $user->fill($request->all());
        $user->password = bcrypt($user->password);
        $user->save();
        Session::flash('success', 'Пользователь успешно обновлен!');
        return redirect()->back();
    }
}
