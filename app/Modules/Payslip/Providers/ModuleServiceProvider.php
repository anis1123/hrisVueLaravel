<?php

namespace App\Modules\Payslip\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('payslip', 'Resources/Lang', 'app'), 'payslip');
        $this->loadViewsFrom(module_path('payslip', 'Resources/Views', 'app'), 'payslip');
        $this->loadMigrationsFrom(module_path('payslip', 'Database/Migrations', 'app'), 'payslip');
        $this->loadConfigsFrom(module_path('payslip', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('payslip', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
