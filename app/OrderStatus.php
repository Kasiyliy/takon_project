<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public const STATUS_WAITING_ID = 1;
    public const STATUS_APPROVED_ID = 2;
    public const STATUS_REJECTED_ID = 3;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function companyOrders()
    {
        return $this->hasMany(CompanyOrder::class, 'order_status_id', 'id');
    }
}
