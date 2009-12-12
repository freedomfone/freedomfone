<?php

App::import('Core', 'HttpSocket');  

class Process extends AppModel{


      var $name = 'Process';


      function getPid(){
 
	$HttpSocket = new HttpSocket();  
    	return $HttpSocket->request(array('uri' => PID_URI.$this->data['Process']['name'].'.pid'));

      }


      function start(){

      $cmd = $this->data['Process']['start_cmd'];
      exec($cmd);
      return true;
      }
}

?>