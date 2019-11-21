<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCompanyOrderStatus extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];



    public function accountCompanyOrders()
    {
        return $this->hasMany(AccountCompanyOrder::class, 'account_company_order_status_id', 'id');
    }
}
