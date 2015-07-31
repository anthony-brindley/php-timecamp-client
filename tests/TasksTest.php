<?php
class Tasks extends PHPUnit_Framework_TestCase
{
    // ...

    public function testAccessDenied()
    {
        $timecamp = new Timecamp\Client("asdasd");

        try {
        $timecamp->tasks();

      } catch(Exception $e) {
        $statusCode =  $e->getResponse()->getStatusCode();
        $this->assertEquals(403, $statusCode);
      }
    }

    public function testTasksReturnsArray()
    {
        $timecamp = new Timecamp\Client(get_key());

        $tasks = $timecamp->tasks();
        $this->assertEquals(gettype($tasks), 'array');

    }

    public function testEntriesReturnsArray()
    {
      //throw new Exception("asd");
        $timecamp = new Timecamp\Client(get_key());

        $entries= $timecamp->timeEntries([
          'from'=> '2015-06-01',
          'to'=> '2015-06-30'
        ]);

        $this->assertEquals(gettype($entries), 'array');

    }

    public function testEntriesRunningReturnsArray()
    {
        $timecamp = new Timecamp\Client(get_key());

        $timers= $timecamp->timerRunning();

        $this->assertEquals(gettype($timers), 'array');

    }

    public function testUsersReturnsArray()
    {
        $timecamp = new Timecamp\Client(get_key());
        $users= $timecamp->users();

        $this->assertEquals(gettype($users), 'array');

    }

    public function testEntriesChangesReturnsArray()
    {
        $timecamp = new Timecamp\Client(get_key());
        $changes= $timecamp->entriesChanges([
          'from'=> '2015-06-01',
          'to'=> '2015-06-30'
        ]);

        $this->assertEquals(gettype($changes), 'array');

    }

}

function get_key() {
  $api_token = Null;
  try {
  $api_token = trim(file_get_contents("tests-api-token.txt"));

} catch(Exception $e) {
      throw new Exception("Create a file named tests-api-token.txt with a valid Timecamp API key for the test cases");
  }
  return $api_token;
}
