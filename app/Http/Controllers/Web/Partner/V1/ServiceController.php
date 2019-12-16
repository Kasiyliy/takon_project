<?php

namespace App\Http\Controllers\Web\Partner\V1;

use App\CompanyOrder;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\Partner\V1\ServiceControllerRequests\CreateServiceRequest;
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
        $services = Service::with(['moderationStatus', 'serviceStatus'])
            ->where('partner_id', Auth::user()->partner->id)
            ->orderBy('services.created_at', 'desc')
            ->paginate(10);
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

}
