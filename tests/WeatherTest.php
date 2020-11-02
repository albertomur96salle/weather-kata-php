<?php

namespace Tests\Codium\CleanCode;

use Codium\CleanCode\WindWeatherForecast;
use Codium\CleanCode\StateNameWeatherForecast;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    // https://www.metaweather.com/api/location/766273/
    /** @test */
    public function find_the_weather_of_today()
    {
        $forecast = new StateNameWeatherForecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city);

        echo "Today: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_weather_of_any_day()
    {
        $forecast = new StateNameWeatherForecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime('+2 days'));

        echo "Day after tomorrow: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function find_the_wind_of_any_day()
    {
        $forecast = new WindWeatherForecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city, null, true);

        echo "Wind: $prediction\n";
        $this->assertTrue(true, 'I don\'t know how to test it');
    }

    /** @test */
    public function change_the_city_to_woeid()
    {
        $forecast = new WindWeatherForecast();
        $city = "Madrid";

        $forecast->predict($city, null, true);

        $this->assertEquals("766273", $city);
    }

    /** @test */
    public function there_is_no_prediction_for_more_than_5_days()
    {
        $forecast = new StateNameWeatherForecast();
        $city = "Madrid";

        $prediction = $forecast->predict($city, new \DateTime('+6 days'));

        $this->assertEquals("", $prediction);
    }
}