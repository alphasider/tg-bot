<?php

  use GuzzleHttp\Client;

  class Weather {
    protected $token = '1063863518:AAFgvV-CVTDsuVq_D1IclhkoyXIMpQeLhTk';

    public function getWeather($latitude, $longitude) {
      $url = 'api.openweathermap.org/data/2.5/weather';
      $params = ['lat' => $latitude, 'lon' => $longitude, 'APPID' => $this->token];
      $url .= '?' . http_build_query($params);

      $client = new Client([
          'base_uri' => $url
      ]);

      $result = $client->request('GET');
      $json_result = json_decode($result->getBody());
      return $json_result;
    }
  }