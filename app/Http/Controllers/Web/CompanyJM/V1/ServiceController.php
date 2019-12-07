<?php

namespace App\Http\Controllers\Web\CompanyJM\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\ModerationStatus;
use App\Partner;
use App\ServiceStatus;
use Illuminate\Http\Request;

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

}
