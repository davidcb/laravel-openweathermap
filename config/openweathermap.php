<?php

return [
    /*
     * The API key from registering your app on Open Weather Map
     */
    'api_key' => env('OPENWEATHERMAP_API_KEY', 'YOUR OPENWEATHERMAP API KEY'),

    'city_id' => env('OPENWEATHERMAP_CITY_ID', 'OPENWEATHERMAP CITY ID'),

    'units' => env('OPENWEATHERMAP_UNITS', 'metric'), // standard, metric, imperial
];
