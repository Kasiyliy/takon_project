<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMobileUser extends Model
{
    protected $fillable = [
        'group_id',
        'mobile_user_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function mobileUser()
    {
        return $this->belongsTo(MobileUser::class, 'mobile_user_id');
    }
}
