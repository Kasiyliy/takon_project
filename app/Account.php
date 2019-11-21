<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
