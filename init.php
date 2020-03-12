<?php
  include('vendor/autoload.php');
  include('TelegramBot.php');
  include('Timing.php');

  $telegramApi = new TelegramBot();
  $timeApi = new Timing();

  $updt = $telegramApi->getUpdates();
  print_r($updt);

  /*$msg = $telegramApi->getLatestMessageDetails();
  $text = $msg['text'];
  $chat_id = $msg['chat_id'];
  $currentTime = $timeApi->getCurrentTime();
  if($text === '/time'){
    $telegramApi->sendMessage($chat_id, $currentTime);
  }*/
//print_r($currentTime);


