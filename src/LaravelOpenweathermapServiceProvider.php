<?php


namespace Davidcb\LaravelOpenweathermap;


use Illuminate\Support\ServiceProvider;
use Davidcb\LaravelOpenweathermap\Commands\RefreshWeather;

class LaravelOpenweathermapServiceProvider extends ServiceProvider
{

    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                RefreshWeather::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../config/openweathermap.php' => config_path('openweathermap.php')
        ]);
    }

    public function register()
    {
        $this->app->singleton('laravel-openweathermap', function ($app) {
            return new LaravelOpenweathermap($app);
        });
    }
}
