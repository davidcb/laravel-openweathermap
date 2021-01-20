<?php


namespace Davidcb\LaravelOpenweathermap;

use Illuminate\Support\Facades\Cache;

class LaravelOpenweathermap
{
    public static function getWeather()
    {
        if (Cache::has('openweathermap')) {
            $json = Cache::get('openweathermap');
        } else {
            try {
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => 'http://api.openweathermap.org/data/2.5/weather?id=' . config('openweathermap.city_id') . '&APPID=' . config('openweathermap.api_key') . '&units=' . config('openweathermap.units'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        'accept: application/json'
                    ),
                ));
                $result = curl_exec($ch);
                curl_close($ch);

                Cache::forever('openweathermap', $result);

                $json = $result;
            } catch (\Exception $e) {
                $json = null;
            }
        }

        if ($json) {
            $json = json_decode($json);

            if (isset($json->weather)) {

                switch ($json->weather[0]->id) {
                    case 300:
                    case 301:
                    case 302:
                    case 310:
                    case 311:
                    case 312:
                    case 313:
                    case 314:
                    case 321:
                    case 500:
                    case 501:
                    case 502:
                    case 503:
                    case 504:
                    case 511:
                    case 520:
                    case 521:
                    case 522:
                    case 531:
                        $icon = 'rain';
                        break;
                    case 200:
                    case 201:
                    case 202:
                    case 210:
                    case 211:
                    case 212:
                    case 221:
                    case 230:
                    case 231:
                    case 232:
                        $icon = 'storm';
                        break;
                    case 800:
                        $icon = 'sun';
                        break;
                    case 701:
                    case 711:
                    case 721:
                    case 731:
                    case 741:
                    case 751:
                    case 761:
                    case 762:
                    case 771:
                    case 781:
                    case 803:
                    case 804:
                        $icon = 'clouds';
                        break;
                    case 801:
                    case 802:
                        $icon = 'sunclouds';
                        break;
                    default:
                        $icon = 'sunrain';
                        break;
                }

                /* if (Carbon::now()->hour <= 7 || Carbon::now()->hour >= 19) {
                    $icon .= '_night';
                } */

                return [
                    'currentCTemp' => round($json->main->temp),
                    'currentFTemp' => round(($json->main->temp * 9 / 5) + 32),
                    'icon' => $icon,
                    'weather' => $json->weather[0]->main
                ];
            }
        }
    }

    public static function refresh()
    {
        Cache::forget('openweathermap');
        return static::getWeather();
    }
}
