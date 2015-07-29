<?php

require "index.php" ;

$api_token = trim(file_get_contents("tests-api-token.txt"));

$timecamp = new Timecamp\Client($api_token);
$entries= $timecamp->timerRunning();
// var_dump($entries);
foreach($entries as $v) {
  var_dump($v);
}
