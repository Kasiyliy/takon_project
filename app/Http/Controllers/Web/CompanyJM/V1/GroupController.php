<?php

namespace App\Http\Controllers\Web\CompanyJM\V1;

use App\Exceptions\WebServiceErroredException;
use App\Group;
use App\GroupMobileUser;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\CompanyJM\V1\GroupControllerRequests\ChangeGroupRequest;
use App\Http\Requests\Web\CompanyJM\V1\GroupControllerRequests\GroupStoreRequest;
use App\Http\Requests\Web\CompanyJM\V1\GroupControllerRequests\GroupUpdateRequest;
use App\Http\Services\UserService;
use App\Role;
use Illuminate\Support\Facades\DB;

class GroupController extends WebBaseController
{

    protected $userService;

    /**
     * GroupController constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function groups()
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());
        $groups = Group::where('company_id', $companyUser->company->id)->get();
        return view('company.groups.index', compact('companyUser', 'groups'));
    }

    public function groupsCreate()
    {
        return view('company.groups.create');

    }

    public function groupsStore(GroupStoreRequest $request)
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());

        DB::beginTransaction();

        try {
            $group = new Group();
            $group->name = $request->name;
            $group->company_id = $companyUser->company->id;
            $group->save();
            DB::commit();
            $this->added();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь к администратору сайта!");
        }
    }

    public function groupsEdit($id)
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());
        $group = Group::where('company_id', $companyUser->company->id)->find($id);
        if ($group) {
            return view('company.groups.edit', compact('group'));
        } else {
            throw new WebServiceErroredException("Не существует!");
        }
    }

    public function groupsUpdate($id, GroupUpdateRequest $request)
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());
        $group = Group::where('company_id', $companyUser->company->id)->find($id);
        if ($group) {
            $group->name = $request->name;
            $group->save();
            $this->edited();
            return redirect()->back();
        } else {
            throw new WebServiceErroredException("Не существует!");
        }
    }

    public function groupsDelete($id)
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());
        $group = Group::where('company_id', $companyUser->company->id)->find($id);
        if ($group) {
            $group->delete();
            $this->deleted();
            return redirect()->back();
        } else {
            throw new WebServiceErroredException("Не существует!");
        }
    }

    public function groupsDetails($id)
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());
        $group = Group::where('company_id', $companyUser->company->id)->find($id);
        if ($group) {
            $groupUsers = DB::table('users as u')
                ->select(['u.id', 'mu.id as mobile_user_id', 'u.username', 'u.phone_number', 'mu.first_name', 'mu.last_name', 'c.name'])
                ->join('mobile_users as mu', 'u.id', '=', 'mu.user_id')
                ->join('company_users as cu', 'cu.mobile_user_id', '=', 'mu.id')
                ->join('companies as c', 'c.id', '=', 'cu.company_id')
                ->join('group_mobile_users as gmu', function ($join) use ($id) {
                    $join->on('gmu.group_id', '=', DB::raw($id));
                    $join->on('gmu.mobile_user_id', '=', 'cu.mobile_user_id');
                })
                ->whereNull('u.deleted_at')
                ->where('u.role_id', '=', Role::ROLE_MOBILE_USER_ID)
                ->where('c.id', '=', $companyUser->company->id)
                ->get();

            $notGroupUsers = DB::table('users as u')
                ->select(['u.id', 'mu.id as mobile_user_id', 'u.username', 'u.phone_number', 'mu.first_name', 'mu.last_name', 'c.name'])
                ->join('mobile_users as mu', 'u.id', '=', 'mu.user_id')
                ->join('company_users as cu', 'cu.mobile_user_id', '=', 'mu.id')
                ->join('companies as c', 'c.id', '=', 'cu.company_id')
                ->leftJoin('group_mobile_users as gmu', function ($join) use ($id) {
                    $join->on('gmu.group_id', '=', DB::raw($id));
                    $join->on('gmu.mobile_user_id', '=', 'cu.mobile_user_id');
                })
                ->whereNull('gmu.id')
                ->whereNull('u.deleted_at')
                ->where('u.role_id', '=', Role::ROLE_MOBILE_USER_ID)
                ->where('c.id', '=', $companyUser->company->id)
                ->get();
            return view('company.groups.details', compact('group', 'groupUsers', 'notGroupUsers'));
        } else {
            throw new WebServiceErroredException("Не существует!");
        }
    }

    public function changeGroup(ChangeGroupRequest $request)
    {
        $companyUser = $this->userService->getUserWithCompanyRoleByUserId($this->getCurrentUserId());
        $group = Group::where('company_id', $companyUser->company->id)->find($request->group_id);
        if (!$group) {
            throw new WebServiceErroredException("Нет доступа!");
        }
        $mobileUser = DB::table('mobile_users as mu')
            ->select([
                'mu.id'
            ])
            ->join('company_users as cu', 'cu.mobile_user_id', '=', 'mu.id')
            ->where('cu.mobile_user_id', '=', $request->mobile_user_id)
            ->where('cu.company_id', '=', $companyUser->company->id)
            ->first();

        if (!$mobileUser) {
            throw new WebServiceErroredException("Нет доступа!");
        }

        $groupMobileUser = GroupMobileUser::where('group_id', '=', $group->id)
            ->where('mobile_user_id', '=', $mobileUser->id)
            ->first();

        if ($groupMobileUser) {
            $groupMobileUser->delete();
            $this->deleted();
        } else {
            $groupMobileUser = new GroupMobileUser();
            $groupMobileUser->mobile_user_id = $mobileUser->id;
            $groupMobileUser->group_id = $group->id;
            $groupMobileUser->save();
            $this->added();
        }
        return redirect()->back();
    }


}
