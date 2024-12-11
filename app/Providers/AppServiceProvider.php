<?php

namespace App\Providers;
use App\Models\CompanySettings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $companySettings = CompanySettings::first();
        view()->share('companySettings', $companySettings);
    }
}
