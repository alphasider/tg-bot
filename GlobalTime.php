<?php
/*
 * This class is deprecated. Use Timing class instead!
 * */

  require 'vendor/autoload.php';

  use GuzzleHttp\Client;

  class GlobalTime {

    const API = "http://worldtimeapi.org/api/timezone/Europe/Moscow";

    /* obtenir des informations complètes sur l'heure actuelle
     * get full information about current time */
    protected function getTime() {
      // $client = new Client(['base_uri' => self::ALT_API]);
      $client = new Client(['base_uri' => self::API]);
      $response = $client->request('GET');
      $result = json_decode($response->getBody());
      return $result;
    }

    public function getCurrentTime() {
      $timeObject = $this->getTime(); // objet de temps info
      $fullTimeInfo = $timeObject->datetime; // info à plein temps (par exemple: 2020-03-09T16:58:32.638410+03:00)
      $time_start_position = strpos($fullTimeInfo, 'T') + 1; // Position of character 'T'
      $cleanTime = substr($fullTimeInfo, $time_start_position, 5); // extrait le temp
      return $cleanTime;
    }

  }