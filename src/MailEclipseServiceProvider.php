<?php

namespace Qoraiche\MailEclipse;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Qoraiche\MailEclipse\Command\VendorPublishCommand;

class MailEclipseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('maileclipse', config('maileclipse.middlewares', []));

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'maileclipse');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'maileclipse');
        $this->registerRoutes();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'Qoraiche\MailEclipse\Http\Controllers',
            'prefix' => config('maileclipse.path'),
            'middleware' => 'maileclipse',
        ];
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/maileclipse.php', 'maileclipse');

        // Register the service the package provides.
        $this->app->singleton('maileclipse', function ($app) {
            return new MailEclipse;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['maileclipse'];
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
            __DIR__.'/../config/maileclipse.php' => config_path('maileclipse.php'),
        ], 'maileclipse.config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/maileclipse'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../resources/views/templates' => $this->app->resourcePath('views/vendor/maileclipse/templates'),
        ], 'maileclipse.templates');

        // Add Artisan publish command
        $this->commands([
            VendorPublishCommand::class,
        ]);
    }
}
