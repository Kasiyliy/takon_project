<?php

namespace App\Http\Controllers\Web\Admin\V1;

use App\Account;
use App\Cashier;
use App\Company;
use App\CompanyUser;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\Admin\V1\UserControllerRequests\AdminStoreRequest;
use App\Http\Requests\Web\Admin\V1\UserControllerRequests\CashierStoreRequest;
use App\Http\Requests\Web\Admin\V1\UserControllerRequests\CompanyStoreRequest;
use App\Http\Requests\Web\Admin\V1\UserControllerRequests\PartnerStoreRequest;
use App\Http\Requests\Web\Admin\V1\UserControllerRequests\MobileUserStoreRequest;
use App\MobileUser;
use App\Partner;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

class UserController extends WebBaseController
{

    //ADMINS
    public function admins()
    {
        $users = User::where('role_id', Role::ROLE_ADMINISTRATOR_ID)
            ->with('role')
            ->get();
        return view('admin.users.admins.index', compact("users"));
    }

    public function adminsEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_ADMINISTRATOR_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('admin.users.admins.edit');
    }

    public function adminsCreate()
    {
        return view('admin.users.admins.create');
    }

    public function adminsStore(AdminStoreRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->email = $user->username;
        $user->password = bcrypt($request->password);
        $user->role_id = Role::ROLE_ADMINISTRATOR_ID;
        $user->save();
        $this->added();
        return redirect()->back();
    }

    //CASHIERS
    public function cashiers()
    {
        if (Auth::user()->isPartner()) {
            $users = User::with('role', 'cashier')
                ->where('role_id', Role::ROLE_CASHIER_ID)
                ->get();
        } else {
            $users = User::with('role', 'cashier')
                ->where('role_id', Role::ROLE_CASHIER_ID)
                ->get();
        }

        return view('admin.users.cashiers.index', compact("users"));
    }

    public function cashiersEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_CASHIER_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('admin.users.cashiers.edit', compact('user'));
    }

    public function cashiersCreate()
    {
        $partners = User::with(['role', 'partner'])
            ->where('role_id', Role::ROLE_PARTNER_ID)
            ->get();
        return view('admin.users.cashiers.create', compact('partners'));
    }

    public function cashiersStore(CashierStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username;
            $user->phone_number = $user->username;
            $user->password = bcrypt($request->password);
            $user->role_id = Role::ROLE_CASHIER_ID;
            $user->save();

            $account = new Account();
            $account->role_id = $user->role_id;
            $account->save();

            $cashier = new Cashier();
            $cashier->account_id = $account->id;
            $cashier->user_id = $user->id;
            $cashier->partner_id = $request->partner_id;
            $cashier->name = $request->name;
            $cashier->save();

            DB::commit();
            $this->added();
            return redirect()->back();
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь пожалуйста к администратору сайта!");
        }
    }

    //PARTNERS
    public function partners()
    {
        $users = User::with(['role', 'partner'])
            ->where('role_id', Role::ROLE_PARTNER_ID)
            ->get();
        return view('admin.users.partners.index', compact("users"));
    }

    public function partnersEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_PARTNER_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('admin.users.partners.edit', compact('user'));
    }

    public function partnersCreate()
    {
        return view('admin.users.partners.create');
    }

    public function partnersStore(PartnerStoreRequest $request)
    {

        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $user->username;
            $user->password = bcrypt($request->password);
            $user->role_id = Role::ROLE_PARTNER_ID;
            $user->save();

            $account = new Account();
            $account->role_id = $user->role_id;
            $account->save();

            $partner = new Partner();
            $partner->account_id = $account->id;
            $partner->name = $request->name;
            $partner->user_id = $user->id;
            $partner->phone_number = $request->phone_number;
            $partner->save();
            DB::commit();
            $this->added();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь пожалуйста к администратору сайта!");
        }
    }

    //MOBILE USERS
    public function mobileUsers()
    {
        $users = User::with('role')
            ->where('role_id', Role::ROLE_MOBILE_USER_ID)
            ->get();
        return view('admin.users.mobileUsers.index', compact("users"));
    }

    public function mobileUsersEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_MOBILE_USER_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('admin.users.mobileUsers.edit', compact('user'));
    }

    public function mobileUsersCreate()
    {
        $companies = User::with(['role', 'company'])
            ->where('role_id', Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID)
            ->get();
        return view('admin.users.mobileUsers.create', compact('companies'));
    }

    public function mobileUsersStore(MobileUserStoreRequest $request)
    {
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
            $companyUser->company_id = $request->company_id;
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


    //COMPANIES
    public function companies()
    {
        $users = User::with(['role', 'company'])
            ->where('role_id', Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID)
            ->get();
        return view('admin.users.companies.index', compact("users"));
    }

    public function companiesEdit($id)
    {
        $user = User::where('role_id', Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID)->find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }
        return view('admin.users.companies.edit', compact('user'));
    }

    public function companiesCreate()
    {
        return view('admin.users.companies.create');
    }

    public function companiesStore(CompanyStoreRequest $request)
    {

        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $user->username;
            $user->password = bcrypt($request->password);
            $user->role_id = Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID;
            $user->save();

            $account = new Account();
            $account->role_id = $user->role_id;
            $account->save();

            $company = new Company();
            $company->account_id = $account->id;
            $company->name = $request->name;
            $company->user_id = $user->id;
            $company->phone_number = $request->phone_number;
            $company->save();
            DB::commit();
            $this->added();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь пожалуйста к администратору сайта!");
        }
    }

    //COMMON
    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            Session::flash('error', 'Пользователь не существует!');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'repassword' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Ошибка!');
            return redirect()->back()->withErrors($validator);
        } else if ($request->password != $request->repassword) {
            Session::flash('warning', 'Пароли не совпадают!');
            return redirect()->back();
        } else {
            $user->fill($request->all());
            $user->password = bcrypt($user->password);
            $user->save();
            Session::flash('success', 'Пользователь успешно обновлен!');
            return redirect()->back();
        }
    }
}
