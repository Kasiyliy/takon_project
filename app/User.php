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

    public function isAdmin(){
        return $this->role_id == Role::ROLE_ADMINISTRATOR_ID;
    }

    public function isPartner(){
        return $this->role_id == Role::ROLE_PARTNER_ID;
    }

    public function isCompanyJM(){
        return $this->role_id == Role::ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID;
    }

    public function isMobileUser(){
        return $this->role_id == Role::ROLE_MOBILE_USER_ID;
    }

    public function isCashier(){
        return $this->role_id == Role::ROLE_CASHIER_ID;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
