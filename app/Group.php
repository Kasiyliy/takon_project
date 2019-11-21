<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }


    public function mobileUsers()
    {
        return $this->hasMany(Group::class, 'group_id', 'id');
    }
}
