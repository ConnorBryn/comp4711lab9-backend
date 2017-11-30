<?php
//require_once '../application/core/CSV_Model.php';
if(!class_exists('PHPUnit_Framework_TestCase')) {
  class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}
require_once '../application/models/Task.php';
 class TaskTest extends PHPUnit_Framework_TestCase
  {
    private $CI;
    private $task;
    public function setUp()
    {
      // Load CI instance normally
      $this->CI = &get_instance();
      $this->task = new Task;
    }

    public function testSetTask()
    {
      // Way too many characters
      $this->task->Task="This should not pass...................................................................";
      $this->assertEquals(NULL, $this->task->task);
      // A valid example
      $this->task->Task="This should pass.";
      $this->assertEquals("This should pass.", $this->task->task);
      // Valid example at the maximum character limit.
      $this->task->Task="64 Character limit... This should work with 64 characters.......";
      $this->assertEquals("64 Character limit... This should work with 64 characters.......", $this->task->task);
      // InValid example at 65 characters
      // When the validation fails, the task should stay the same as before.
      $this->task->Task="64 Character limit... This should fail with 65 characters....asdf.....";
      $this->assertEquals("64 Character limit... This should work with 64 characters.......", $this->task->task);
    }

    public function testSetPriority()
    {
      // The highest valid priority
      $this->task->Priority='3';
      $this->assertEquals('3', $this->task->priority);
      // 4 is invalid priority, so value should not change.
      $this->task->Priority='4';
      $this->assertEquals('3', $this->task->priority);
      // -1 is invalid priority, so value should not change.
      $this->task->Priority='-1';
      $this->assertEquals('3', $this->task->priority);
      // 0 is lowest valid priority
      $this->task->Priority='0';
      $this->assertEquals('0', $this->task->priority);
    }

    public function testSetSize()
    {
      // The highest valid  size
      $this->task->Size='3';
      $this->assertEquals('3', $this->task->size);
      // An invalid  size, size should not change
      $this->task->Size='4';
      $this->assertEquals('3', $this->task->size);
      // An invalid  size, size should not change
      $this->task->Size='-1';
      $this->assertEquals('3', $this->task->size);
      // 0 is lowest valid size, value changes
      $this->task->Size='0';
      $this->assertEquals('0', $this->task->size);
    }
    public function testSetGroup(){
      // The highest valid group
      $this->task->Group='4';
      $this->assertEquals('4', $this->task->group);
      // An invalid  group, value should not change
      $this->task->Group='5';
      $this->assertEquals('4', $this->task->group);
      // An invalid  size, size should not change
      $this->task->Group='-1';
      $this->assertEquals('4', $this->task->group);
      // 0 is lowest valid group, value changes
      $this->task->Group='0';
      $this->assertEquals('0', $this->task->group);
    }



  }
