<?php

namespace Owenoj\EmergentPay;

use Illuminate\Support\ServiceProvider;

class EmergentPayServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'owenoj');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'owenoj');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/emergentpay.php', 'emergentpay');

        // Register the service the package provides.
        $this->app->singleton('emergentpay', function ($app) {
            return new EmergentPay;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['emergentpay'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/emergentpay.php' => config_path('emergentpay.php'),
        ], 'emergentpay.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/owenoj'),
        ], 'emergentpay.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/owenoj'),
        ], 'emergentpay.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/owenoj'),
        ], 'emergentpay.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
