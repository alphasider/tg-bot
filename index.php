<?php

  $token = '1063863518:AAFgvV-CVTDsuVq_D1IclhkoyXIMpQeLhTk';
  $url = 'https://api.telegram.org/bot' . $token . '/getUpdates';

  $response = json_decode(file_get_contents($url, JSON_OBJECT_AS_ARRAY));
  var_dump($response);

//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_URL, $url);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//  $content = curl_exec($ch);
//  curl_close($ch);
//  var_dump($content);