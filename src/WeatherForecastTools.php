<?php

namespace Codium\CleanCode;

use GuzzleHttp\Client;

class WeatherForecastTools {
    const FIND_WOEID_BY_CITY = "https://www.metaweather.com/api/location/search/?query=";
    const GET_PREDICTIONS_BY_WOEID = "https://www.metaweather.com/api/location/";

    public function renewDatetime($datetime) {
        // When date is not provided we look for the current prediction
        if (!$datetime) {
            $datetime = new \DateTime();
        }

        return $datetime;
    }

    public function isDateValid($datetime) {
        return $datetime < new \DateTime("+6 days 00:00:00");
    }

    public function getResults(&$city) {
        // Create a Guzzle Http Client
        $client = new Client();

        // Find the id of the city on metawheather
        $woeid = json_decode($client->get(self::FIND_WOEID_BY_CITY . $city)->getBody()->getContents(),
            true)[0]['woeid'];
        $city = $woeid;

        // Find the predictions for the city
        return json_decode($client->get(self::GET_PREDICTIONS_BY_WOEID . $woeid)->getBody()->getContents(),
            true)['consolidated_weather'];
    }

    public function iterateResultsByField($results, $datetime, $field) {
        foreach ($results as $result) {
            // When the date is the expected
            if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
                return $result[$field];
            }
        }
    }
}