<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 6.12.2019
 * Time: 00:37
 */

namespace App\Http\Services;


use App\Role;
use App\User;

class UserService
{



    public function getUserWithPartnerRoleByUserId($id)
    {
        return User::where('role_id', Role::ROLE_PARTNER_ID)
            ->with(['partner', 'role'])
            ->find($id);
    }

    public function getUserWithCompanyRoleByUserId($id)
    {
        return User::where('role_id', Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID)
            ->with(['company', 'role'])
            ->find($id);
    }


    public function getUserWithMobileUserRoleByUserId($id)
    {
        return User::where('role_id', Role::ROLE_MOBILE_USER_ID)
            ->with(['mobileUser', 'role'])
            ->find($id);
    }

    public function getUserWithCashierRoleByUserId($id)
    {
        return User::where('role_id', Role::ROLE_CASHIER_ID)
            ->with(['cashier', 'role'])
            ->find($id);
    }

}