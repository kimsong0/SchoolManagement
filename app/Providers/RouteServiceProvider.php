<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Redirect users to the Filament admin panel after login.
     */
    public const HOME = '/admin'; // Redirecting to Filament panel

    /**
     * Define the redirect behavior after login.
     */
    protected function redirectTo($request)
    {
        return '/admin'; // Redirect to the Filament admin panel
    }

    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
