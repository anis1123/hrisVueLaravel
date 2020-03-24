<?php

namespace App\Modules\Employee\Providers;

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
        $this->loadTranslationsFrom(module_path('employee', 'Resources/Lang', 'app'), 'employee');
        $this->loadViewsFrom(module_path('employee', 'Resources/Views', 'app'), 'employee');
        $this->loadMigrationsFrom(module_path('employee', 'Database/Migrations', 'app'), 'employee');
        $this->loadConfigsFrom(module_path('employee', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('employee', 'Database/Factories', 'app'));
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
