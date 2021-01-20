<?php


namespace Davidcb\LaravelOpenweathermap\Commands;


use Illuminate\Console\Command;
use Davidcb\LaravelOpenweathermap\LaravelOpenweathermap;

class RefreshWeather extends Command
{
    protected $signature = 'openweathermap:refresh';

    protected $description = 'Refreshes the weather saved on cache';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        LaravelOpenweathermap::refresh();
    }
}
