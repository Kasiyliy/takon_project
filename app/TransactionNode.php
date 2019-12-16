<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionNode extends Model
{
    protected $fillable = [
        "amount",
        "account_company_order_id",
        "transaction_id",
    ];


    public function accountCompanyOrder()
    {
        return $this->belongsTo(AccountCompanyOrder::class, 'account_company_order_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

}
