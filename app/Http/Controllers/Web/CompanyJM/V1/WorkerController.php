<?php

namespace App\Http\Controllers\Web\CompanyJM\V1;

use App\Account;
use App\CompanyUser;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\CompanyJM\V1\WorkerControllerRequests\MobileUserStoreRequest;
use App\Http\Services\UserService;
use App\MobileUser;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Session;

class WorkerController extends WebBaseController
{

    protected $userService;

    /**
     * WorkerController constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    //MOBILE USERS
    public function mobileUsers()
    {
        $currentCompanyUser = $this->userService
            ->getUserWithCompanyRoleByUserId($this->getCurrentUserId());

        $users = DB::table('users as u')
            ->select(['u.id', 'u.username', 'u.phone_number', 'mu.first_name', 'mu.last_name', 'c.name'])
            ->join('mobile_users as mu', 'u.id', '=', 'mu.user_id')
            ->join('company_users as cu', 'cu.mobile_user_id', '=', 'mu.id')
            ->join('companies as c', 'c.id', '=', 'cu.company_id')
            ->whereNull('u.deleted_at')
            ->where('u.role_id', '=', Role::ROLE_MOBILE_USER_ID)
            ->where('c.id', '=', $currentCompanyUser->company->id)
            ->get();

        return view('company.workers.index', compact("users"));
    }

    public function mobileUsersEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_MOBILE_USER_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('company.workers.edit', compact('user'));
    }

    public function mobileUsersCreate()
    {
        return view('company.workers.create');
    }

    public function mobileUsersStore(MobileUserStoreRequest $request)
    {
        $currentCompanyUser = $this->userService
            ->getUserWithCompanyRoleByUserId($this->getCurrentUserId());

        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username;
            $user->phone_number = $user->username;
            $user->password = bcrypt($request->password);
            $user->role_id = Role::ROLE_MOBILE_USER_ID;
            $user->save();

            $account = new Account();
            $account->role_id = $user->role_id;
            $account->save();

            $mobileUser = new MobileUser();
            $mobileUser->account_id = $account->id;
            $mobileUser->user_id = $user->id;
            $mobileUser->first_name = $request->first_name;
            $mobileUser->last_name = $request->last_name;
            $mobileUser->save();

            $companyUser = new CompanyUser();
            $companyUser->mobile_user_id = $mobileUser->id;
            $companyUser->company_id = $currentCompanyUser->company->id;
            $companyUser->save();

            DB::commit();
            $this->added();
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь пожалуйста к администратору сайта!");
        }
    }


}
