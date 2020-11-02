<?php

namespace Codium\CleanCode;

include_once 'WeatherForecastTools.php';

class WindWeatherForecast implements WeatherForecastInterface {
    private $weather_tools;

    function __construct() {
        $this->weather_tools = new WeatherForecastTools();
    }

    public function predict(string &$city, \DateTime $datetime = null) {
        $datetime = $this->weather_tools->renewDatetime($datetime);

        if (!$this->weather_tools->isDateValid($datetime)) {
            return "";
        }

        $results = $this->weather_tools->getResults($city);

        return $this->weather_tools->iterateResultsByField($results, $datetime, 'wind_speed');
    }
}