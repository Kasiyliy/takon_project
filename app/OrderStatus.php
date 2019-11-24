<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public static const STATUS_WAITING_ID = 1;
    public static const STATUS_APPROVED_ID = 2;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function companyOrders()
    {
        return $this->hasMany(CompanyOrder::class, 'order_status_id', 'id');
    }
}
