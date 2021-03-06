<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileUser extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'account_id',
        'user_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
