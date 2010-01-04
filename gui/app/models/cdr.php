<?php


class Cdr extends AppModel{

      var $name = 'Cdr';



	var $hasMany = array('MonitorIvr' => array(
                        	       'order' => 'MonitorIvr.id ASC',
                        	       'dependent' => true)
				       );


	function refresh(){

           //** Fetch CDR from spooler **//
      	      $array = Configure::read('cdr');
	      $obj = new ff_event($array);	       

	      if ($obj -> auth != true) {
    	       	  die(printf("Unable to authenticate\r\n"));
	      }

      	      while ($entry = $obj->getNext('update')){
		  
	       	  $this->set('epoch' , floor($entry['Event-Date-Timestamp']/1000000));
		  $this->set('channel_state' , $entry['Channel-State']);
	       	  $this->set('call_id', $entry['Unique-ID']);

		  $this->set('caller_name', $entry['Caller-Caller-ID-Name']);
    	       	  $this->set('caller_number',$entry['Caller-Caller-ID-Number']);
	       	  $this->set('extension', $entry['Caller-Destination-Number']);

		  $this->create($this->data);
	  	  $this->save($this->data);

		  $this->log("Channel state: ".$entry['Channel-State']."; Call-ID: ".$entry['Unique-ID']."; Timestamp: ".$entry['Event-Date-Timestamp'], "cdr"); 

	      }

           //** Fetch MONITOR_IVR from spooler **//
      	      $array = Configure::read('monitor_ivr');
	      $obj = new ff_event($array);	       

	      if ($obj -> auth != true) {
    	       	  die(printf("Unable to authenticate\r\n"));
	      }

      	      while ($entry = $obj->getNext('update')){
 
		$cdr = $this->find('first', array('conditions' => array('call_id' => $entry['FF-IVR-Unique-ID'], 'channel_state'=>'CS_ROUTING'),'order' =>'Cdr.call_id'));

	       	  $this->MonitorIvr->set('epoch' , floor($entry['Event-Date-Timestamp']/1000000));
		  $this->MonitorIvr->set('call_id' , $entry['FF-IVR-Unique-ID']);
	       	  $this->MonitorIvr->set('ivr_code', $entry['FF-IVR-IVR-Name']);
		  $this->MonitorIvr->set('digit', $entry['FF-IVR-IVR-Node-Digit']);
    	       	  $this->MonitorIvr->set('node_id',$entry['FF-IVR-IVR-Node-Unique-ID']);
	       	  $this->MonitorIvr->set('caller_number', $entry['FF-IVR-Caller-ID-Number']);
	       	  $this->MonitorIvr->set('extension', $entry['FF-IVR-Destination-Number']);
		  $this->MonitorIvr->set('cdr_id', $cdr['Cdr']['id']);

		  $this->MonitorIvr->create($this->MonitorIvr->data);
	  	  $this->MonitorIvr->save($this->MonitorIvr->data);

		  //$this->log("Channel state: ".$entry['Channel-State']."; Call-ID: ".$entry['Unique-ID']."; Timestamp: ".$entry['Event-Date-Timestamp'], "cdr"); 

	      }






	}


    function getCallId($id){

    $data = $this->findById($id);
    return $data['Cdr']['call_id'];     
    }


 }	





?>