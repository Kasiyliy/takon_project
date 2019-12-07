<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'price',
        'name',
        'expiration_days',
        'partner_id',
        'service_status_id',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function serviceStatus()
    {
        return $this->belongsTo(ServiceStatus::class, 'service_status_id');
    }

    public function moderationStatus()
    {
        return $this->belongsTo(ModerationStatus::class, 'moderation_status_id');
    }

}
