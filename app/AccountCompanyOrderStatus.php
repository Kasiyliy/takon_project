<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCompanyOrderStatus extends Model
{

    public static const STATUS_TRANSFERRED_ID = 1;
    public static const STATUS_CANCELLED_ID = 2;
    public static const STATUS_EXPIRED_ID = 3;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];



    public function accountCompanyOrders()
    {
        return $this->hasMany(AccountCompanyOrder::class, 'account_company_order_status_id', 'id');
    }
}
