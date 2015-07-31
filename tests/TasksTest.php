<?php
class Tasks extends PHPUnit_Framework_TestCase
{
    // ...

    public function testAccessDenied()
    {
      //throw new Exception("asd");
        // Arrange
        $timecamp = new Timecamp\Client("asdasd");

        // Assert
        try {
        $timecamp->tasks();

      } catch(Exception $e) {
        $statusCode =  $e->getResponse()->getStatusCode();
        $this->assertEquals(403, $statusCode);
      }
    }

    public function testTasksReturnsArray()
    {
      //throw new Exception("asd");
        // Arrange
        $timecamp = new Timecamp\Client(get_key());

        // Assert
        $tasks = $timecamp->tasks();
        $this->assertEquals(gettype($tasks), 'array');

    }

    public function testEntriesReturnsArray()
    {
      //throw new Exception("asd");
        // Arrange
        $timecamp = new Timecamp\Client(get_key());

        // Assert
        $entries= $timecamp->timeEntries(array(
          'from'=> '2015-06-01',
          'to'=> '2015-06-30'
        ));

        $this->assertEquals(gettype($entries), 'array');

    }

    public function testEntriesRunningReturnsArray()
    {
      //throw new Exception("asd");
        // Arrange
        $timecamp = new Timecamp\Client(get_key());

        // Assert
        $timers= $timecamp->timerRunning();

        $this->assertEquals(gettype($timers), 'array');

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
