<?php
//require_once '../application/core/CSV_Model.php';
if(!class_exists('PHPUnit_Framework_TestCase')) {
  class_alias('PHPUnit\Framework\TestCase', 'PHPUnit_Framework_TestCase');
}

class TaskListTest extends PHPUnit_Framework_TestCase {
        private $CI;
        public function setUp() {
          $this -> CI = &get_instance();
        }

        function testUncompletedTasks()
        {
          $tasks = (new Tasks()) -> all();
          $undoneTaskCount = 0;
          $doneTaskCount = 0;
          foreach ($tasks as $t) {
              if ($t -> status != 2){
                $undoneTaskCount++;
              }
              else{
                $doneTaskCount++;
              }

          }
          $this -> assertLessThan($undoneTaskCount, $doneTaskCount);

        }

}
