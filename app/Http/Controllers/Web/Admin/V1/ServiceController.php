<?php

namespace App\Http\Controllers\Web\Admin\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\ModerationStatus;
use App\Partner;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends WebBaseController
{
    public function services()
    {
        $services = Service::with(['partner'])
            ->where('moderation_status_id', '=', ModerationStatus::MODERATION_STATUS_SUSPENDED_ID)
            ->get();
        return view('admin.services.index', compact('services'));
    }

    public function servicesAccept($id)
    {
        $service = Service::findOrFail($id);
        $service->moderation_status_id = ModerationStatus::MODERATION_STATUS_APPROVED_ID;
        $service->save();

        $this->makeToast('success', 'Сервис одобрен!');

        return redirect()->back();
    }

    public function servicesReject($id)
    {
        $service = Service::findOrFail($id);
        $service->moderation_status_id = ModerationStatus::MODERATION_STATUS_REJECTED_ID;
        $service->save();

        $this->makeToast('warning', 'Сервис отклонен!');

        return redirect()->back();
    }

}
