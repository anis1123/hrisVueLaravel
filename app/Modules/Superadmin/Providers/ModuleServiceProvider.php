<?php

namespace App\Modules\Superadmin\Providers;

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
        $this->loadTranslationsFrom(module_path('superadmin', 'Resources/Lang', 'app'), 'superadmin');
        $this->loadViewsFrom(module_path('superadmin', 'Resources/Views', 'app'), 'superadmin');
        $this->loadMigrationsFrom(module_path('superadmin', 'Database/Migrations', 'app'), 'superadmin');
        $this->loadConfigsFrom(module_path('superadmin', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('superadmin', 'Database/Factories', 'app'));
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
