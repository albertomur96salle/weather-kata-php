<?php

namespace Codium\CleanCode;

interface WeatherForecastInterface {
    public function predict(string &$city, \DateTime $datetime = null);
}