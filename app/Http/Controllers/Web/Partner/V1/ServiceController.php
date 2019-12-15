<?php

namespace App\Http\Controllers\Web\Partner\V1;

use App\CompanyOrder;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\Admin\V1\ServiceControllerRequests\CreateServiceRequest;
use App\ModerationStatus;
use App\OrderStatus;
use App\Service;
use App\ServiceStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends WebBaseController
{
    public function index()
    {
        $services = Service::with(['moderationStatus', 'serviceStatus'])->where('partner_id', Auth::user()->partner->id)->get();
        return view('partner.services.index')->with(['services' => $services]);
    }

    public function create()
    {
        return view('partner.services.create');
    }

    public function store(CreateServiceRequest $request)
    {
        DB::beginTransaction();

        try {
            $service = new Service();
            $service->name = $request->name;
            $service->price = $request->price;
            if ($request->is_payment_enabled) {
                $service->online_payment_enabled = true;
                $service->online_payment_price = $request->payment_price;
            }
            $service->expiration_days = $request->expiration_days;
            $service->service_status_id = ServiceStatus::STATUS_NOT_IN_STOCK_ID;
            $service->moderation_status_id = ModerationStatus::MODERATION_STATUS_SUSPENDED_ID;
            $service->partner_id = Auth::user()->partner->id;
            $service->save();
            DB::commit();
            $this->inModeration();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new WebServiceErroredException("Ошибка! Обратитесь пожалуйста к администратору сайта!");
        }


    }

    public function toggleStatus($id)
    {
        $service = Service::where('partner_id', Auth::user()->partner->id)->findOrFail($id);
        if ($service->service_status_id == ServiceStatus::STATUS_NOT_IN_STOCK_ID) {
            $service->service_status_id = ServiceStatus::STATUS_IN_STOCK_ID;
        } else {
            $service->service_status_id = ServiceStatus::STATUS_NOT_IN_STOCK_ID;
        }
        $service->save();
        $this->successOperation();
        return redirect()->back();
    }

    public function orders()
    {
        $companyOrders = CompanyOrder::select('company_orders.*')
            ->join('services', 'services.id', '=', 'company_orders.service_id')
            ->where('services.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
            ->get();
        return view('partner.services.orders', compact('companyOrders'));
    }

    public function ordersAccept($id)
    {
        $companyOrder = CompanyOrder::with([
            'orderStatus',
            'company',
            'service'
        ])
            ->join('services', 'services.id', '=', 'company_orders.service_id')
            ->where('services.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
            ->where('company_orders.id', '=', $id)
            ->first();

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
        $companyOrder = CompanyOrder::with([
            'orderStatus',
            'company',
            'service' => function ($query) {
                $query->where('services.partner_id', '=', $this->getCurrentUser()->partner->id);
            }
        ])
            ->join('services', 'services.id', '=', 'company_orders.service_id')
            ->where('services.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
            ->findOrFail($id);

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
        return view('partner.services.acceptedOrders', compact('companyOrders'));
    }

    public function ordersRejected()
    {
        $companyOrders = CompanyOrder::join('services', 'services.id', '=', 'company_orders.service_id')
            ->where('services.partner_id', '=', $this->getCurrentUser()->partner->id)
            ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_REJECTED_ID)
            ->get();
        return view('partner.services.rejectedOrders', compact('companyOrders'));
    }
}
