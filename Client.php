<?php
namespace Timecamp;

require "vendor/autoload.php";

class Client extends \GuzzleHttp\Client {
  var $api_token;
  var $client;
  function __construct($api_token) {
    $this->api_token = $api_token;
    parent::__construct([
      'base_uri'=>"https://www.timecamp.com/third_party/api/"
    ]);
  }

  function users() {
    $url = sprintf("users/format/serialized/api_token/%s",
      $this->api_token);
    $res = $this->get($url);
    $s = $res->getBody();
    $entries = unserialize($s);
    return $entries;
  }

  function tasks($options=array()) {
     $url = sprintf("tasks/format/serialized/api_token/%s", $this->api_token);

     if (in_array('task_id',$options)) {
       $task_id = $options['task_id'];
       $url = sprintf("%s/task_id/%s", $url, join(",",$task_id));
     }
    $res = $this->get($url);

    $s = $res->getBody();
    $tasks = unserialize($s);
    // $tasks = json_decode($s,true);
    return $tasks;
  }

  function entries($options) {
    return $this->timeEntries($options);
  }

  function timeEntries($options) {
    $options = array_merge(array(
      'with_subtasks'=>1
    ), $options);
    $url = sprintf("entries/format/serialized/api_token/%s/from/%s/to/%s/with_subtasks/%s",
      $this->api_token, $options['from'], $options['to'], $options['with_subtasks']);
    if (in_array('user_ids',$options)) {
      $user_ids = $options['user_ids'];
      $url = sprintf("%s/user_ids/%s", $url, join(",",$user_ids));
    }
    if (in_array('task_ids', $options)) {
      $task_ids = $options['task_ids'];
      $url = sprintf("%s/task_ids/%s", $url, join(",",$task_ids));
    }
    $res = $this->get($url);
    $s = $res->getBody();
    $entries = unserialize($s);
    return $entries;
  }

  function timerRunning() {
    $url = sprintf("timer_running/format/serialized/api_token/%s",
      $this->api_token);
    $res = $this->get($url);
    $s = $res->getBody();
    $entries = unserialize($s);
    return $entries;
  }

  function entriesChanges($options) {
    $options = array_merge($options, array(
      'with_subtasks'=>1
    ));
    $url = sprintf("entries/format/serialized/api_token/%s/from/%s/to/%s/with_subtasks/%s",
      $this->api_token, $options['from'], $options['to'], $options['with_subtasks']);
    if (in_array('user_ids',$options)) {
      $user_ids = $options['user_ids'];
      $url = sprintf("%s/user_ids/%s", $url, join(",",$user_ids));
    }
    if (in_array('task_ids', $options)) {
      $task_ids = $options['task_ids'];
      $url = sprintf("%s/task_ids/%s", $url, join(",",$task_ids));
    }
    if (in_array('limit',$options)) {
      $limit = $options['limit'];
      $url = sprintf("%s/limit/%s", $url, $limit);
    }
    $res = $this->get($url);
    $s = $res->getBody();
    $entries = unserialize($s);
    return $entries;
  }
}



//$data =  $res->send()->json();
//echo $data;
