<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "amount",
        "transaction_type_id",
        "sender_account_id",
        "receiver_account_id",
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function senderAccount()
    {
        return $this->belongsTo(Account::class, 'sender_account_id');
    }

    public function receiverAccount()
    {
        return $this->belongsTo(Account::class, 'receiver_account_id');
    }
}
