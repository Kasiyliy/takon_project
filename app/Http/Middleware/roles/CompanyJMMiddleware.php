<?php

namespace App\Http\Middleware\roles;

use Closure;
use Illuminate\Support\Facades\Auth;

class CompanyJMMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isCompanyJM()) {
            return $next($request);
        } else {
            Session::flash('warning', 'Доступ запрещен!');
            return redirect()->back();
        }
    }
}
