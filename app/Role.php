<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

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
