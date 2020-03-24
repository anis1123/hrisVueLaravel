<?php

namespace App\Modules\Rulebook\Providers;

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
        $this->loadTranslationsFrom(module_path('rulebook', 'Resources/Lang', 'app'), 'rulebook');
        $this->loadViewsFrom(module_path('rulebook', 'Resources/Views', 'app'), 'rulebook');
        $this->loadMigrationsFrom(module_path('rulebook', 'Database/Migrations', 'app'), 'rulebook');
        $this->loadConfigsFrom(module_path('rulebook', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('rulebook', 'Database/Factories', 'app'));
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
