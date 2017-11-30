<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{
    public function index() {
        
    $this->data['pagebody'] = 'homepage'; 
    $this->render(); 
  }
}
