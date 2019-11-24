<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    public static const STATUS_IN_STOCK_ID = 1;
    public static const STATUS_NOT_IN_STOCK_ID = 2;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'service_status_id', 'id');
    }
}
