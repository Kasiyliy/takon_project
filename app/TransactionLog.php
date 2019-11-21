<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $fillable = [
        "transaction_id",
        "account_id",
        "start_balance",
        "final_balance",
        "is_sender",
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
