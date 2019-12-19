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

    protected const WEB_COMMON_PREFIX = '\Web\Common';
    protected const API_COMMON_PREFIX = '\Api\Common';

    protected const WEB_ADMIN_PREFIX = '\Web\Admin';

    protected const WEB_COMPANY_JM_PREFIX = '\Web\CompanyJM';

    protected const WEB_PARTNER_PREFIX = '\Web\Partner';

    protected const API_CASHIER_PREFIX = '\Api\Cashier';
    protected const WEB_CASHIER_PREFIX = '\Web\Cashier';

    protected const API_MOBILE_USER_PREFIX = '\Api\MobileUser';
    protected const WEB_MOBILE_USER_PREFIX = '\Web\MobileUser';

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
        $this->mapWebCompanyJMRoutes();
        $this->mapWebPartnerRoutes();
        $this->mapWebCashierRoutes();
        $this->mapWebMobileUserRoutes();
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
            ->namespace($this->namespace . RouteServiceProvider::WEB_COMMON_PREFIX)
            ->group(base_path('routes/web.php'));
    }


    protected function mapWebAdminRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_ADMIN'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_ADMIN_PREFIX)
            ->group(base_path('routes/web/web_admin.php'));
    }


    protected function mapWebCompanyJMRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_COMPANY_JM'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_COMPANY_JM_PREFIX)
            ->group(base_path('routes/web/web_company_jm.php'));
    }

    protected function mapWebPartnerRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_PARTNER'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_PARTNER_PREFIX)
            ->group(base_path('routes/web/web_partner.php'));
    }

    protected function mapWebMobileUserRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_MOBILE_USER'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_MOBILE_USER_PREFIX)
            ->group(base_path('routes/web/web_mobile_user.php'));
    }


    protected function mapWebCashierRoutes()
    {
        Route::middleware(['web', 'auth', 'ROLE_CASHIER'])
            ->namespace($this->namespace . RouteServiceProvider::WEB_CASHIER_PREFIX)
            ->group(base_path('routes/web/web_cashier.php'));
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
            ->namespace($this->namespace . RouteServiceProvider::API_COMMON_PREFIX)
            ->group(base_path('routes/api.php'));
    }


    protected function mapApiCashierRoutes()
    {
        Route::prefix('api/cashiers')
            ->middleware(['api'])
            ->namespace($this->namespace . RouteServiceProvider::API_CASHIER_PREFIX)
            ->group(base_path('routes/api/api_cashier.php'));
    }

    protected function mapApiMobileUserRoutes()
    {
        Route::prefix('api/mobile-users')
            ->middleware(['api'])
            ->namespace($this->namespace . RouteServiceProvider::API_MOBILE_USER_PREFIX)
            ->group(base_path('routes/api/api_mobile_user.php'));
    }
}
