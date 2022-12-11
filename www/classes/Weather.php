<?php

namespace app\classes;

use app\exceptions\ApiException;

class Weather
{
    protected const WEATHER_URL = 'http://api.weatherapi.com/v1/current.xml';
    protected const API_KEY = '3cf4ee0ed4f64cc284e144047221112';

    public static function getWeather(): array
    {
        $url = self::WEATHER_URL. '?key=' . self::API_KEY . '&q=Москва&lang=ru';
        try {
            $xml = Helpers::getCurlXml($url);
        } catch (ApiException $e) {
            var_dump($e->getMessage());
        }

        return [
            'location' => $xml->location->name,
            'time' => (string)$xml->location->localtime,
            'temp' => $xml->current->temp_c,
            'feelslik' => $xml->current->feelslike_c,
            'condition' => $xml->current->condition->text,
        ];
    }
}