<?php

  require 'vendor/autoload.php';

  use GuzzleHttp\Client;

  // For correct time
  date_default_timezone_set("Europe/Moscow");

  class Timing {
    const API = 'http://api.aladhan.com/v1/currentTime?zone=Europe/Moscow';
    const TIMING_API = 'http://api.aladhan.com/v1/timingsByCity?city=Moscow&country=RF&method=14';

    /*
        public function getTime() {
          $client = new Client(['base_uri' => self::API]);
          $response = $client->request('GET');
          $result = json_decode($response->getBody());
          return $result;
        }
    */

// Main function
    public function getInfo() {
      $client = new Client(['base_uri' => self::TIMING_API]);
      $response = $client->request('GET');
      $result = json_decode($response->getBody());
      return $result;
    }

    // Get current time (HH:mm)
    public function getCurrentTime() {
      $timestamp = $this->getInfo();
      $http_code = $timestamp->code;
      $current_time = 'Time not set yet';
      if ($http_code == 200) {
        $current_time = date('H:i', $timestamp->data->date->timestamp);
      }
      return $current_time;
    }
  }