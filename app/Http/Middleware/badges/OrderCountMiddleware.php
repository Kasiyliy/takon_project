<?php

namespace App\Http\Middleware\badges;

use App\CompanyOrder;
use App\OrderStatus;
use Closure;
use Illuminate\Support\Facades\Auth;

class OrderCountMiddleware
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
            if (Auth::user()->isPartner()) {

                $ordersCount = CompanyOrder::select('company_orders.*')
                    ->join('services as s', 's.id', '=', 'company_orders.service_id')
                    ->where('s.partner_id', '=', Auth::user()->partner->id)
                    ->where('company_orders.order_status_id', '=', OrderStatus::STATUS_WAITING_ID)
                    ->count();

                session()->put(['ordersCount' => $ordersCount]);
            }
        }
        return $next($request);
    }
}
