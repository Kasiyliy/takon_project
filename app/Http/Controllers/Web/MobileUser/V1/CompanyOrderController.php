<?php

namespace App\Http\Controllers\Web\MobileUser\V1;

use App\AccountCompanyOrder;
use App\AccountCompanyOrderStatus;
use App\Http\Controllers\WebBaseController;

class CompanyOrderController extends WebBaseController
{
    public function index()
    {
        $currentUser = $this->getCurrentUser();
        $currentMobileUser = $currentUser->mobileUser;
        $accountId = $currentMobileUser->account_id;
        $accountCompanyOrders = AccountCompanyOrder::where('account_id', $accountId)
            ->where('account_company_order_status_id', AccountCompanyOrderStatus::STATUS_TRANSFERRED_ID)
            ->paginate(9);
        return view('mobileUser.myOrders', compact('accountCompanyOrders'));
    }
}
