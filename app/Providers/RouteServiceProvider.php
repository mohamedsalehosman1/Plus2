<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // You can add custom route patterns or model bindings here if needed
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        // $this->mapApiRoutes();

        // Custom route mapping can be added here
        $this->mapAdminRoutes(); // example custom route
        $this->mapVendorRoutes(); // example custom route
    }

    /**
     * Define the "web" routes for the application.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define custom routes, e.g., admin routes.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/admin.php')); // new custom routes file
    }


    /**
     * Define custom routes, e.g., admin routes.
     *
     * @return void
     */
    protected function mapVendorRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/vendor.php')); // new custom routes file
    }
}
