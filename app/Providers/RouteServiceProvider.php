<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected const COMMON_PREFIX = '\Common';

    protected const COMPANY_JM_PREFIX = '\Company_JM';
    protected const PARTNER_PREFIX = '\Partner';
    protected const CASHIER_PREFIX = '\Cashier';
    protected const ADMIN_PREFIX = '\Admin';
    protected const MOBILE_USER_PREFIX = '\MobileUser';
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        //API
        $this->mapApiRoutes();
        $this->mapApiCashierRoutes();
        $this->mapApiMobileUserRoutes();

        //WEB
        $this->mapWebRoutes();
        $this->mapWebAdminRoutes();
        $this->mapWebCashierRoutes();
        $this->mapWebPartnerRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace.RouteServiceProvider::COMMON_PREFIX)
             ->group(base_path('routes/web.php'));
    }


    protected function mapWebAdminRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace.RouteServiceProvider::ADMIN_PREFIX)
            ->group(base_path('routes/web/web_admin.php'));
    }


    protected function mapWebCashierRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace.RouteServiceProvider::COMPANY_JM_PREFIX)
            ->group(base_path('routes/web/web_company_jm.php'));
    }

    protected function mapWebPartnerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace.RouteServiceProvider::PARTNER_PREFIX)
            ->group(base_path('routes/web/web_partner.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace.RouteServiceProvider::COMMON_PREFIX)
             ->group(base_path('routes/api.php'));
    }


    protected function mapApiCashierRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace.RouteServiceProvider::CASHIER_PREFIX)
            ->group(base_path('routes/api/api_cashier.php'));
    }

    protected function mapApiMobileUserRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace.RouteServiceProvider::MOBILE_USER_PREFIX)
            ->group(base_path('routes/api/api_mobile_user.php'));
    }
}
