<?php

namespace App\Http\Controllers\Web\Admin\V1;

use App\Exceptions\WebServiceException;
use App\Http\Requests\Web\Admin\V1\RoleControllerRequests\UpdateRoleRequest;
use App\Http\Controllers\WebBaseController;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class RoleController extends WebBaseController
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact("roles"));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            Session::flash('success', 'Роль успешно добавлена!');
            return redirect()->back();
        }
    }


    public function delete($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            Session::flash('success', 'Роль успешно удалена!');
        } else {
            Session::flash('error', 'Роль не существует!');
        }
        return redirect()->back();
    }


    public function edit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            Session::flash('error', ' Роль не существует!');
            return redirect()->back();
        }

        return view('admin.roles.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            $this->notFound();
            return redirect()->back();
        }
        $role->name = $request->name;

        DB::beginTransaction();
        try {
            $role->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->error();
            throw new WebServiceException(null, null);
        }

        $this->edited();
        return redirect()->back();
    }

}
