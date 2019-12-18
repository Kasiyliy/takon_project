<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'account_id',
        'user_id',
	    'image_path'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'partner_id', 'id');
    }
}
