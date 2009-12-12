<?php

class Bin extends AppModel{

      var $name = 'Bin';


    function getBody($id){

    	  $data = $this->findById($id);
    	  return $data['Bin']['body'];     

    }



    function refresh(){

      $array = Configure::read('bin');
      $instance_id = IID;
      $mode = __("Unclassified",true);
      
      $obj = new ff_event($array);	       

       	   if ($obj -> auth != true) {
  	       	  die(printf("Unable to authenticate\r\n"));
        	  }

     	    while ($entry = $obj->getNext('update')){

	      $created = floor($entry['Event-Date-Timestamp']/1000000);
      	      $data= array ( 'instance_id'  =>$instance_id, 'body' => $entry['Body'], 'sender' => $entry['from'], 'created' => $created, 'mode' => $mode);
	      
	      $this->create();
	      $result = $this->save($data);
	      $this->log("Message: ".$mode."; Body: ".$entry['Body']."; From: ".$entry['from']."; Timestamp: ".$created, "bin"); 
	      
	      }

	}

}

?>