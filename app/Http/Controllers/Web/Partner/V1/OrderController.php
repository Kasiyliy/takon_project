<?php

namespace App\Http\Controllers\Web\Partner\V1;

use App\CompanyOrder;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\OrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends WebBaseController
{

    public function orders()
    {
        $companyOrders = CompanyOrder::select('company_orders.*')
            ->join('services as s', 's.id', '=', 'company_orders.service_id')
            ->where('s.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
            ->get();
        return view('partner.orders.index', compact('companyOrders'));
    }

    public function ordersAccept($id)
    {
        $companyOrder = CompanyOrder::select('company_orders.*')
            ->join('services as s', 's.id', '=', 'company_orders.service_id')
            ->where('s.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
            ->find($id);

        DB::beginTransaction();
        try {
            $companyOrder->due_date = Carbon::now()->addDays($companyOrder->service->expiration_days);
            $companyOrder->order_status_id = OrderStatus::STATUS_APPROVED_ID;
            $companyOrder->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException('Ошибка! Обратитесь к администратору!');
        }
        $this->makeToast('success', 'Вы приняли запрос на заказ на услугу!');
        return redirect()->back();
    }

    public function ordersReject($id)
    {
        $companyOrder = CompanyOrder::select('company_orders.*')
            ->join('services as s', 's.id', '=', 'company_orders.service_id')
            ->where('s.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
            ->find($id);

        try {
            $companyOrder->order_status_id = OrderStatus::STATUS_REJECTED_ID;
            $companyOrder->save();
        } catch (\Exception $exception) {
            throw new WebServiceErroredException('Ошибка! Обратитесь к администратору!');
        }

        $this->makeToast('success', 'Вы отказали запрос на заказ на услугу!');
        return redirect()->back();
    }

    public function ordersAccepted()
    {
        $companyOrders = CompanyOrder::join('services', 'services.id', '=', 'company_orders.service_id')
            ->where('services.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_APPROVED_ID)
            ->get();
        return view('partner.orders.acceptedOrders', compact('companyOrders'));
    }

    public function ordersRejected()
    {
        $companyOrders = CompanyOrder::join('services', 'services.id', '=', 'company_orders.service_id')
            ->where('services.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_REJECTED_ID)
            ->get();
        return view('partner.orders.rejectedOrders', compact('companyOrders'));
    }
}
