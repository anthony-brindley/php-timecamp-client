<?php

require "Client.php" ;

$api_token = trim(file_get_contents("tests-api-token.txt"));

$timecamp = new Timecamp\Client($api_token);
$users= $timecamp->users();
// var_dump($users);
foreach($users as $v) {
  var_dump($v);
}
