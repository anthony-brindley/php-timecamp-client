<?php

require "index.php" ;

$api_token = trim(file_get_contents("tests-api-token.txt"));

$timecamp = new Timecamp\Client($api_token);
$tasks = $timecamp->tasks();
foreach($tasks as $v) {
  echo "$v[name]\n";
}
