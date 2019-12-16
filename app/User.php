<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone_number', 'password', 'token', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'username_verified_at' => 'datetime',
    ];

    //FUNCTIONS

    public function isAdmin()
    {
        return $this->role_id == Role::ROLE_ADMINISTRATOR_ID;
    }

    public function isPartner()
    {
        return $this->role_id == Role::ROLE_PARTNER_ID;
    }

    public function isCompanyJM()
    {
        return $this->role_id == Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID;
    }

    public function isMobileUser()
    {
        return $this->role_id == Role::ROLE_MOBILE_USER_ID;
    }

    public function isCashier()
    {
        return $this->role_id == Role::ROLE_CASHIER_ID;
    }

    //RELATIONSHIPS

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function cashier()
    {
        return $this->hasOne(Cashier::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function partner()
    {
        return $this->hasOne(Partner::class, 'user_id', 'id');
    }

    public function mobileUser()
    {
        return $this->hasOne(MobileUser::class, 'user_id', 'id');
    }

    public function getRealUserTypeByRole()
    {
        if ($this->isAdmin()) {
            return $this;
        } else if ($this->isCashier()) {
            return $this->cashier();
        } else if ($this->isCompanyJM()) {
            return $this->company();
        } else if ($this->isMobileUser()) {
            return $this->mobileUser();
        } else if ($this->isPartner()) {
            return $this->partner();
        } else {
            throw new \Exception("ROLE MISCONFIGURATION", 400);
        }
    }

}
