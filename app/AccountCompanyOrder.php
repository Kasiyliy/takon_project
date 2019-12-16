<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountCompanyOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'account_id',
        'company_order_id',
        'account_company_order_status_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function companyOrder()
    {
        return $this->belongsTo(CompanyOrder::class, 'company_order_id');
    }

    public function accountCompanyOrderStatus()
    {
        return $this->belongsTo(AccountCompanyOrderStatus::class, 'account_company_order_status_id');
    }
}
