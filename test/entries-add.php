<?php

require "Client.php" ;

$api_token = trim(file_get_contents("tests-api-token.txt"));

$timecamp = new Timecamp\Client($api_token);

$entry= $timecamp->createTimeEntry(array(
  'task_id'=> 4444495,
  'date'=> '2015-07-29',
  'duration'=>3600,
  'start_time'=> '04:45:00',
  'end_time'=> '05:55:00',
  'note'=>'borrame'
));

var_dump($entry);
