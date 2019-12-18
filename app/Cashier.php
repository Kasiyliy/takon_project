<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'longitude',
        'latitude',
        'account_id',
        'user_id',
        'partner_id',
	    'token_hash'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }


    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
