<?php
  include('Timing.php');

  $time = new Timing();
  $timeInfo = $time->getCurrentTime();
//  $currentTime = $timeInfo->data;

print_r($timeInfo);