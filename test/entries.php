<?php

require "index.php" ;

$api_token = trim(file_get_contents("tests-api-token.txt"));

$timecamp = new Timecamp\Client($api_token);
$entries= $timecamp->timeEntries(array(
  'from'=> '2015-06-01',
  'to'=> '2015-06-30'
));
// var_dump($entries);
foreach($entries as $v) {
  echo "$v[name]\n";
}
