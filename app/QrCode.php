<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    //
	protected $table = 'qr_codes';
	protected $fillable = [
		'amount',
		'account_company_order_id'
	];

	public function accountCompanyOrder(){
		return $this->belongsTo(AccountCompanyOrder::class, 'account_company_order_id');
	}
}
