<?php
/****************************************************************************
 * channel.php		- Model for GSM channels based in GSMopen.
 * version 		- 1.0.440
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
 * Refresh SNMP data for OfficeRoute units
 *  
 * 
 *
 */


 function refresh_OR(){

    $or_mib    = Configure::read('OR_MIB');
    $snmp   = Configure::read('OR_SNMP');
  

     //For each office route in use
     foreach($snmp as $key => $unit){

         for($i=0; $i<4; $i++){

         $mib[$i]['line_id']             =  $this->get_entry($unit, 2, $i);
         $mib[$i]['imei']                =  $this->get_entry($unit, 3, $i);
         $mib[$i]['signal_strength']     =  $this->get_entry($unit, 7, $i);
         $mib[$i]['sim_inserted']        =  $or_mib['sim_inserted'][$this->get_entry($unit, 9, $i)];
         $mib[$i]['network_registered']  =  $or_mib['network_registered'][$this->get_entry($unit, 10, $i)];
         $mib[$i]['imsi']                =  $this->get_entry($unit, 12, $i);
         $mib[$i]['operator_name']       =  $this->get_entry($unit, 14, $i);         
         $mib[$i]['ip_addr']             =  $unit['ip_addr'];
        
         }

     }


     return $mib; 


}

 function get_entry($unit, $id, $i){

      $snmp   = Configure::read('OR_SNMP');
      $prefix = $unit['object_id'];

      $data = snmpget( $unit['ip_addr'] , $unit['community'], $prefix.'.'.$id.'.'.$i);

        if(preg_match('/:/',$data)){

                   $string = explode(':',$data);
                   $data = trim ($string[1], '" "');
        } else {

                   $data = false;

        }       

                   return $data;

 }


/*
 * Fetch new data from spooler
 *  
 * 
 *
 */

      function refresh(){


      	  $array = Configure::read('gsmopen');
          $instance_id = IID;
          $obj = new ff_event($array);	       

	  if ($obj -> auth != true) {
    	      die(printf("Unable to authenticate\r\n"));
	  }

      	  while ($entry = $obj->getNext('update')){

	  	$interface_id = $entry['interface_id'];
	  	$interface_name = $entry['interface_name'];
	        $epoch 	= floor($entry['Event-Date-Timestamp']/1000000);

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


}
?>
