<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function companyOrders()
    {
        return $this->hasMany(CompanyOrder::class, 'order_status_id', 'id');
    }
}
