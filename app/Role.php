<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static const ROLE_ADMINISTRATOR_ID = 1;
    public static const ROLE_COMPANY_OR_JUDICIAL_MEMBER_ID = 2;
    public static const ROLE_PARTNER_ID = 3;
    public static const ROLE_CLIENT_ID = 4;
    public static const ROLE_CASHIER_ID = 5;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'role_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

}
