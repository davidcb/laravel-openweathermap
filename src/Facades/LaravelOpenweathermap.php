<?php

namespace Davidcb\LaravelOpenweathermap\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelOpenweathermap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-openweathermap';
    }
}
