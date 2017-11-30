<?php
class Task {
    var $task;
    var $priority;
    var $size;
    var $group;
    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {
        // if a set* method exists for this key, 

       // use that method to insert this value. 

       // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name =
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
        if (method_exists($this, $method))
        {
          $this->$method($value);
          return $this;
        } else {
          // Otherwise, just set the property value directly.
           $this->$key = $value;
           return $this;
        }


    }
    public function setTask($value){
      if (strlen($value) <= 64){
        $this ->task = $value;
      }
    }
    public function setPriority($value){
      if(is_numeric($value)) {
        if ($value <=3 && $value >= 0){
          $this->priority = $value;
        }
      }
    }
    public function setSize($value){
      if (preg_match("/^[0-3]+$/", $value)){
        $this->size = $value;
      }
    }
    public function setGroup($value){
      if (preg_match("/^[0-4]+$/", $value)){
        $this->group = $value;
      }
    }
}
 ?>
