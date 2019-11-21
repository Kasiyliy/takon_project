<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'service_status_id', 'id');
    }
}
