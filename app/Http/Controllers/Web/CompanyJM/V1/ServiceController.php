<?php

namespace App\Http\Controllers\Web\CompanyJM\V1;

use App\CompanyOrder;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\CompanyJM\V1\ServiceControllerRequests\ServicesPurchaseRequest;
use App\ModerationStatus;
use App\OrderStatus;
use App\Partner;
use App\Service;
use App\ServiceStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends WebBaseController
{


    public function services()
    {
        $partners = Partner::with(['user', 'services' => function ($query) {
            $query->where('services.service_status_id', '=', ServiceStatus::STATUS_IN_STOCK_ID);
            $query->where('services.moderation_status_id', '=', ModerationStatus::MODERATION_STATUS_APPROVED_ID);
        }])->get();
        return view('company.services.index', compact('partners'));
    }

    public function servicesDetails($id)
    {
        $partner = Partner::with(['user', 'services' => function ($query) {
            $query->where('services.service_status_id', '=', ServiceStatus::STATUS_IN_STOCK_ID);
            $query->where('services.moderation_status_id', '=', ModerationStatus::MODERATION_STATUS_APPROVED_ID);
        }])->findOrFail($id);
        return view('company.services.details', compact('partner'));
    }

    public function servicesMakeOrder($service_id)
    {
        $service = Service::with([
            'serviceStatus' => function ($query) {
                $query->where('service_statuses.id', '=', ServiceStatus::STATUS_IN_STOCK_ID);
            },
            'moderationStatus' => function ($query) {
                $query->where('moderation_statuses.id', '=', ModerationStatus::MODERATION_STATUS_APPROVED_ID);
            },
            'partner'])->findOrFail($service_id);
        return view('company.services.makeOrder', compact('service'));
    }

    public function servicesPurchase($service_id, ServicesPurchaseRequest $request)
    {
        $service = Service::with([
            'serviceStatus' => function ($query) {
                $query->where('service_statuses.id', '=', ServiceStatus::STATUS_IN_STOCK_ID);
            },
            'moderationStatus' => function ($query) {
                $query->where('moderation_statuses.id', '=', ModerationStatus::MODERATION_STATUS_APPROVED_ID);
            },
            'partner'])->findOrFail($service_id);
        $company = $this->getCurrentUser()->company;
        $account = $company->account;
        if (!$company) {
            throw new WebServiceErroredException('У вас нет сущности компании! Обратитесь к администратору!');
        }

        if (!$account) {
            throw new WebServiceErroredException('У вас нет аккаунта! Обратитесь к администратору!');
        }
        DB::beginTransaction();
        try {

            $companyOrder = new CompanyOrder();
            $companyOrder->service_id = $service->id;
            $companyOrder->amount = $request->amount;
            $companyOrder->company_id = $company->id;
            $companyOrder->order_status_id = OrderStatus::STATUS_WAITING_ID;
            $companyOrder->due_date = Carbon::now();
            $companyOrder->actual_service_price = $service->price;
            $companyOrder->save();

            DB::commit();
            $this->makeToast('success', 'Запрос на покупку таконов успешно сделан!');
            return redirect()->back();
        } catch (\Exception $exception) {
            throw new WebServiceErroredException('Ошибка! Обратитесь к администратору!');
        }

    }

    public function servicesOrders()
    {
        $companyOrders = CompanyOrder::with([
            'orderStatus',
            'company' => function ($query) {
                $query->where('companies.id', '=', $this->getCurrentUser()->company->id);
            },
            'service'
        ])->get();

        return view('company.services.orders', compact('companyOrders'));
    }
}
