<?php

namespace App\Http\Middleware\badges;

use App\ModerationStatus;
use App\Service;
use Closure;
use Illuminate\Support\Facades\Auth;

class ModerationCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            if (Auth::user()->isAdmin()) {
                $servicesCount = Service::with(['partner'])
                    ->where('moderation_status_id', '=', ModerationStatus::MODERATION_STATUS_SUSPENDED_ID)
                    ->count();
                session()->put(['moderationCount' => $servicesCount]);
            } else if (Auth::user()->isPartner()) {
                $servicesCount = Service::with(['partner'])
                    ->where('moderation_status_id', '=', ModerationStatus::MODERATION_STATUS_SUSPENDED_ID)
                    ->where('partner_id', '=', Auth::user()->partner->id)
                    ->count();
                session()->put(['moderationCount' => $servicesCount]);
            }
        }
        return $next($request);
    }
}
