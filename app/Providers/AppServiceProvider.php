<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The namespace for the controller routes.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Route::middleware(['web', 'checkIfDoctor'])
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
        Route::middleware(['web', 'checkIfPatient'])
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
        Route::middleware(['web', 'checkIfPharmacist'])
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('checkIfDoctor', \App\Http\Middleware\CheckIfDoctor::class);
        Route::aliasMiddleware('checkIfPatient', \App\Http\Middleware\CheckIfPatient::class);
        Route::aliasMiddleware('checkIfPharmacist', \App\Http\Middleware\CheckIfPharmacist::class);
    }
}
