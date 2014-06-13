<?php
/****************************************************************************
 * channel.php		- Model for GSM channels based in GSMopen.
 * version 		- 3.0.1500
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

App::import('Core', 'HttpSocket');  

class Channel extends AppModel{


      var $name = 'Channel';




/*
 * Fetch new data from spooler
 *  
 * 
 *
 */

      function refresh(){


      	  $array = Configure::read('gsmopen');
       
          $obj = new ff_event($array);	       

	  if ($obj -> auth != true) {
    	      die(printf("Unable to authenticate\r\n"));
	  }

      	  while ($entry = $obj->getNext('delete')){

	  	$interface_id = $entry['interface_id'];
	  	$interface_name = $entry['interface_name'];
	        $epoch 	= intval(floor($entry['Event-Date-Timestamp']/1000000));

		$this->set('epoch' , $epoch);
		$this->set('interface_name' , $entry['interface_name']);
		$this->set('interface_id' , $entry['interface_id']);
		$this->set('active' , $entry['active']);
		$this->set('not_registered' , $entry['not_registered']);
		$this->set('home_network_registered' , $entry['home_network_registered']);
		$this->set('roaming_registered' , $entry['roaming_registered']);
		$this->set('got_signal' , $entry['got_signal']);
		$this->set('running' , $entry['running']);
		$this->set('imei' , $entry['imei']);
		$this->set('imsi' , $entry['imsi']);
		$this->set('controldev_dead' , $entry['controldev_dead']);
		$this->set('controldevice_name' , $entry['controldevice_name']);
		$this->set('no_sound' , $entry['no_sound']);
		$this->set('playback_boost' , $entry['playback_boost']);
		$this->set('capture_boost' , $entry['capture_boost']);
		$this->set('ib_calls' , $entry['ib_calls']);
		$this->set('ob_calls' , $entry['ob_calls']);
		$this->set('ib_failed_calls' , $entry['ib_failed_calls']);
		$this->set('ob_failed_calls' , $entry['ob_failed_calls']);
		$this->set('interface_state' , $entry['interface_state']);
		$this->set('phone_callflow' , $entry['phone_callflow']);
		$this->set('during-call' , $entry['during-call']);

 		$result =  $this->find('count',array('conditions' => array('interface_id' =>$interface_id)));
		if(!$result){
		      $this->save($this->data);
		} else {
		      $data = $this->findByInterfaceId($interface_id);
   	   	      $this->id = $data['Channel']['id'];
		      $this->save($this->data);
		}
		
	  }
      }


/*
 * Send command to FreeSWITCH
 *  
 * @param string $cmd
 *
 * @return boolean
 *
 */

      function fsCommand($cmd=null){

      	       $settings  = Configure::read('FREESWITCH');
       	       $sock = new ESLconnection($settings['host'], $settings['port'], $settings['pass']);

	       //Connection established
	       if($sock->connected()){

	       $event = $sock->api($cmd);
	       $body = $event->getBody();


		$sock->disconnect();
		return $body;	
	       }
	       else {
	       return false;
	       }

      }



      function create_dialplan($data){


      	       $settings  = Configure::read('FREESWITCH');

	       
      	       $writer = new XMLWriter();  
	       $writer->openURI($settings['dialplan']);  
	       $writer->startDocument('1.0','UTF-8');  
	       $writer->setIndent(10);   

	       $writer->writeComment("CREATED ".date('c')); 
	       $writer->startElement('document');  
	       $writer->writeAttribute('type','freeswitch/xml');
	       
	       $writer->startElement('section');  
	       $writer->writeAttribute('name','dialplan');
	       $writer->writeAttribute('description','curl_diaplan');

	       $writer->startElement('include');  

	       $writer->writeComment("NO_SIP_AUTH: ".NO_SIP_AUTH);
	       if(!NO_SIP_AUTH){
	       //Context: public
	       $writer->startElement('context');  
	       $writer->writeAttribute('name','public');

	       $writer->startElement('extension');  
	       $writer->writeAttribute('name','entry');

	       $writer->startElement('condition');  
	       $writer->writeAttribute('field','destination_number');
	       $writer->writeAttribute('expression','^(.*)$');

	       $writer->startElement('action');  
	       $writer->writeAttribute('application','speak');
	       $writer->writeAttribute('data','cepstral|allison|All external calls fall here!');

	       $writer->endElement(); // action
 	       $writer->endElement(); // condition
 	       $writer->endElement(); // extension
 	       $writer->endElement(); // context
	       }

	       //Context: default
	       $writer->writeComment("LEAVE A MESSAGE");
	       $writer->startElement('context');  
	       
	       if(NO_SIP_AUTH){
		$writer->writeAttribute('name','public');
		} else {
		$writer->writeAttribute('name','default');
	       }

	       $writer->startElement('extension');
       	       $writer->writeAttribute('name','leave_message_pool');

	       $writer->startElement('condition');
       	       $writer->writeAttribute('field','destination_number');
       	       $writer->writeAttribute('expression','^2(\d{3})$');

	       $writer->startElement('action');
       	       $writer->writeAttribute('application','ring_ready');
	       $writer->endElement();

	       $writer->startElement('action');
       	       $writer->writeAttribute('application','answer');
	       $writer->endElement();

	       $writer->startElement('action');
       	       $writer->writeAttribute('application','sleep');
       	       $writer->writeAttribute('data','2000');
	       $writer->endElement();


	       $writer->startElement('action');
       	       $writer->writeAttribute('application','set');
       	       $writer->writeAttribute('data','instance_id=$1');
	       $writer->endElement();

	       $writer->startElement('action');
       	       $writer->writeAttribute('application','set');
       	       $writer->writeAttribute('data','lmIP=$${local_ip_v4}');
	       $writer->endElement();


	       $writer->startElement('action');
       	       $writer->writeAttribute('application','javascript');
       	       $writer->writeAttribute('data','/opt/freeswitch/scripts/freedomfone/leave_message/main.js ${instance_id} ${lmIP}');
	       $writer->endElement();

	       $writer->endElement(); //condition
	       $writer->endElement(); //extension


	       $writer->writeComment("VOICE MENUS"); 

	       $writer->startElement('extension');
       	       $writer->writeAttribute('name','ivr_pool');

	       $writer->startElement('condition');
       	       $writer->writeAttribute('field','destination_number');
       	       $writer->writeAttribute('expression','^4(\d{3})$');


	       $writer->startElement('action');
       	       $writer->writeAttribute('application','answer');
	       $writer->endElement();

	       $writer->startElement('action');
       	       $writer->writeAttribute('application','set');
       	       $writer->writeAttribute('data','instance_id=$1');
	       $writer->endElement();

	       $writer->startElement('action');
       	       $writer->writeAttribute('application','ivr');
       	       $writer->writeAttribute('data','freedomfone_ivr_${instance_id}');
	       $writer->endElement();


	       $writer->endElement(); //condition
	       $writer->endElement(); //extension


	       $writer->writeComment("INBOUND GSMOPEN"); 

	       foreach($data['Channel'] as $key => $channel){

	        if(array_key_exists('instance_id', $channel) && array_key_exists('interface_id', $channel) && $channel['instance_id']){

	       	       $writer->startElement('extension');
       	       	       $writer->writeAttribute('name',$channel['interface_id']);

	       	       $writer->startElement('condition');
       	       	       $writer->writeAttribute('field','destination_number');
       	       	       $writer->writeAttribute('expression','^500'.$key.'$');

	       	       $writer->startElement('action');
       	       	       $writer->writeAttribute('application','transfer');
       	       	       $writer->writeAttribute('data', $channel['instance_id']." XML default");
	       	       $writer->endElement(); //action

	       	       $writer->endElement(); //condition
		       $writer->endElement(); //extension

		       }

	       }

 	       $writer->endElement(); // context
 	       $writer->endElement(); // include
 	       $writer->endElement(); // section
 	       $writer->endElement(); // document

	       $writer->flush();
      }


      function updateHardwareDiscovery($data){

      	  $config = Configure::read('GAMMU');
	  $imsi = false;

	       foreach($data['Channel'] as $key => $channel){

	          if(array_key_exists('instance_id', $channel) && $channel['instance_id']){
	             $imsi[$channel['interface_id']] = $channel['instance_id'];
		  }
	       }

	       $file = file($config['discovery']);
	       $handle = fopen($config['discovery'],'w');

	       foreach($file as $key => $line){

	         $_line[$key] = explode(',',trim($line));
		 $size = sizeof($_line[$key]);

		 if($imsi && array_key_exists(trim($_line[$key][9]),$imsi)){
		     $instance_id = $imsi[trim($_line[$key][9])];		 


		 } else {

		    $instance_id = 'false';
		 }
         
		$_line[$key][10] = $instance_id;

	       } //foreach

	       foreach($_line as $key => $line){

	       $new_line = rtrim(implode(",",$line),',')."\r\n";
	       fwrite($handle, $new_line);

	       }

	       fclose($handle);
      }




 function getGammu(){

      $auth  = Configure::read('GAMMU');
      $gammu = new sms('mysql', $auth);
      $phones    = $gammu->getPhones(); 

      return $phones;


      }


}
?>
