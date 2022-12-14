<?php

namespace Stingraydevelopment\RolesAndPermissions;

use Stingraydevelopment\RolesAndPermissions\BladeDirectives;
use Illuminate\Support\ServiceProvider;

class RolesAndPermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        // Add custom blade directives.
        // BladeDirectives::boot();
        
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'roles-and-permissions');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'roles-and-permissions');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {

            // Publish the config file.
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('roles-and-permissions.php'),
            ], 'config');

            // Publish the migrations.
            $this->publishes([
                __DIR__ . '/../migrations/' => database_path('migrations'),
            ], 'migrations');

            // Publish the blade directives.
            $this->publishes([
                __DIR__ . '/../blade/' => app_path('Blade/BladeDirectives.php'),
            ], 'blade');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views/admin/' => resource_path('views/admin/roles-and-permissions'),
            ], 'views');

            // Publishing Vue Components.
            $this->publishes([
                __DIR__.'/../resources/js/components/' => resource_path('js/components'),
            ], 'assets');

            // Publishing Controllers.
            $this->publishes([
                __DIR__.'/../controllers/' => app_path('Controllers'),
            ], 'controllers');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/roles-and-permissions'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
        
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'roles-and-permissions');

        // Register the main class to use with the facade
        $this->app->singleton('roles-and-permissions', function () {
            return new RolesAndPermissions;
        });

        
    }
}
