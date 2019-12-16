<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    public const TYPE_PURCHASE_ID = 1;
    public const TYPE_TRANSFER_ID = 2;
    public const TYPE_COMBINED_PURCHASE_ID = 3;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'transaction_type_id', 'id');
    }
}
