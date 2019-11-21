<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $fillable = [
        'company_id',
        'mobile_user_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function mobileUser()
    {
        return $this->belongsTo(MobileUser::class, 'mobile_user_idv');
    }
}
