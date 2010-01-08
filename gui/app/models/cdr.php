<?php
/****************************************************************************
 * cdr.php		- Model for CDR. Manages refresh from spooler.
 * version 		- 1.0.353
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/


class Cdr extends AppModel{

      var $name = 'Cdr';

	var $hasMany = array('MonitorIvr' => array(
                        	       'order' => 'MonitorIvr.id ASC',
                        	       'dependent' => true)
				       );


	function refresh(){

	$applications = Configure::read('EXTENSIONS');

           //** Fetch CDR from spooler **//
      	      $array = Configure::read('cdr');
	      $obj = new ff_event($array);	       

	      if ($obj -> auth != true) {
    	       	  die(printf("Unable to authenticate\r\n"));
	      }

      	      while ($entry = $obj->getNext('update')){

	      	  $channel_state = $entry['Channel-State'];
		  $call_id = $entry['Unique-ID'];
		  $application=__('N/A',true);  
	       	  $this->set('epoch' , floor($entry['Event-Date-Timestamp']/1000000));
		  $this->set('channel_state' , $channel_state);
	       	  $this->set('call_id', $call_id);

		  $this->set('caller_name', $entry['Caller-Caller-ID-Name']);
    	       	  $this->set('caller_number',$entry['Caller-Caller-ID-Number']);
	       	  $this->set('extension', $entry['Caller-Destination-Number']);

		  $ext= $entry['Caller-Destination-Number'];

		  while ($app = current($applications)) {
    		    if ($app ==  $ext) {
        	       	 $application = key($applications);
    		       }
    		    next($applications);
		   }
		   
		  $this->set('application', $application);
		  $this->create($this->data);
	  	  $this->save($this->data);

		  //Add routing(start) and destroy(end) to monitor_ivr if application='ivr'

		  if($application =='ivr' || ($channel_state=='CS_DESTROY' && $this->MonitorIvr->find('count',array('conditions' => array('MonitorIvr.call_id' => $call_id))))){

		  	$epoch = floor($entry['Event-Date-Timestamp']/1000000);
	       	  	$this->MonitorIvr->set('epoch' , $epoch);
		  	$this->MonitorIvr->set('call_id' , $entry['Unique-ID']);
	       	  	$this->MonitorIvr->set('ivr_code', '');
		  	$this->MonitorIvr->set('digit', '');
    	       	  	$this->MonitorIvr->set('node_id','');
	       	  	$this->MonitorIvr->set('caller_number', $entry['Caller-Caller-ID-Number']);
	       	  	$this->MonitorIvr->set('extension', $entry['Caller-Destination-Number']);
		  	//$this->MonitorIvr->set('cdr_id', $cdr['Cdr']['id']);
		  	$this->MonitorIvr->set('type', $channel_state);

		  	$this->MonitorIvr->create($this->MonitorIvr->data);
	  	  	$this->MonitorIvr->save($this->MonitorIvr->data);

		  	$this->log("Channel state: ".$entry['Channel-State']."; Call-ID: ".$entry['Unique-ID']."; Timestamp: ".$entry['Event-Date-Timestamp'], "cdr"); 
		  	$this->log("Type: ".$entry['Channel-State']."; Call-ID: ".$entry['Unique-ID']."; Timestamp: ".$entry['Event-Date-Timestamp'], "monitor_ivr"); 
		}

	      }

           //** Fetch MONITOR_IVR from spooler **//
      	      $array = Configure::read('monitor_ivr');
	      $obj = new ff_event($array);	       

	      if ($obj -> auth != true) {
    	       	  die(printf("Unable to authenticate\r\n"));
	      }

      	      while ($entry = $obj->getNext('update')){
 
		$cdr = $this->find('first', array('conditions' => array('call_id' => $entry['FF-IVR-Unique-ID'], 'channel_state'=>'CS_ROUTING'),'order' =>'Cdr.call_id'));

		  $epoch = floor($entry['Event-Date-Timestamp']/1000000);
	       	  $this->MonitorIvr->set('epoch' , $epoch);
		  $this->MonitorIvr->set('call_id' , $entry['FF-IVR-Unique-ID']);
	       	  $this->MonitorIvr->set('ivr_code', $entry['FF-IVR-IVR-Name']);
		  $this->MonitorIvr->set('digit', $entry['FF-IVR-IVR-Node-Digit']);
    	       	  $this->MonitorIvr->set('node_id',$entry['FF-IVR-IVR-Node-Unique-ID']);
	       	  $this->MonitorIvr->set('caller_number', $entry['FF-IVR-Caller-ID-Number']);
	       	  $this->MonitorIvr->set('extension', $entry['FF-IVR-Destination-Number']);
		  $this->MonitorIvr->set('cdr_id', $cdr['Cdr']['id']);
		  $this->MonitorIvr->set('type', 'tag');

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