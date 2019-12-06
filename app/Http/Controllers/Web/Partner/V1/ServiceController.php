<?php

namespace App\Http\Controllers\Web\Partner\V1;

use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\Admin\V1\ServiceControllerRequests\CreateServiceRequest;
use App\Service;
use App\ServiceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends WebBaseController
{
    public function index()
    {
        $services = Service::where('partner_id', Auth::user()->partner->id)->get();
        return view('partner.service.index')->with(['services' => $services]);
    }

    public function create()
    {
        return view('partner.service.create');
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
            $service->service_status_id = ServiceStatus::STATUS_IN_STOCK_ID;
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
}
