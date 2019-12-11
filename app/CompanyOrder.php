<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOrder extends Model
{
    protected $fillable = [
        'due_date',
        'amount',
        'actual_service_price',
        'company_id',
        'service_id',
        'order_status_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    protected $dates = [
        'due_date',
    ];

    public function formatNumber(float $val)
    {
        return number_format($val, 2, ',', '.');
    }
}
