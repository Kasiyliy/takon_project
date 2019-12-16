<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModerationStatus extends Model
{
    public const MODERATION_STATUS_SUSPENDED_ID = 1;
    public const MODERATION_STATUS_APPROVED_ID = 2;
    public const MODERATION_STATUS_REJECTED_ID = 3;

    protected $fillable = [
        'name'
    ];
}
