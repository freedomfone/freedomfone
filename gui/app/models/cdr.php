<?php
/****************************************************************************
 * cdr.php		- Model for CDR. Manages refresh from spooler.
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


class Cdr extends AppModel{

      var $name = 'Cdr';


	var $belongsTo = array('User'); 

	var $hasMany = array('MonitorIvr' => array(
                        	       'order' => 'MonitorIvr.id ASC',
                        	       'dependent' => true)
				       );


/*
 * Fetching new data from spooler
 *
 *
 */

	function refresh(){

	$mapping = Configure::read('EXT_MAPPING');


           //** Fetch CDR from spooler **//
      	      $array = Configure::read('cdr');
	      $obj = new ff_event($array);	       

	      if ($obj -> auth != true) {
    	       	  die(printf("Unable to authenticate\r\n"));
	      }


      	      while ($entry = $obj->getNext('delete')){

	          $channel = $entry['Channel-Name'];
	      	  $channel_state = $entry['Channel-State'];
	      	  $answer_state = $entry['Answer-State'];
		  $call_id = $entry['Unique-ID'];
		  $application='';
		  $start='';
		  $ext = $entry['Caller-Destination-Number'];
		  $epoch = intval(floor($entry['Event-Date-Timestamp']/1000000));

		  $this->set('epoch' , $epoch);
		  $this->set('channel_state' , $channel_state);
	       	  $this->set('call_id', $call_id);
		  $this->set('caller_name', $this->sanitizePhoneNumber($entry['Caller-Caller-ID-Name']));
    	       	  $this->set('caller_number',$this->sanitizePhoneNumber($entry['Caller-Caller-ID-Number']));
	       	  $this->set('extension', $ext);


		  //Determine sender protocol (skype,gsm,sip)
	 	  $proto = $this->getProto($channel);
       	          $this->set('proto',$proto);

		  foreach($mapping as $app => $reg){
		       preg_match($reg,$ext,$matches);
		         if($matches){	
	 	        	$application = $app;
		         }
		   }


		   //Determine whether entry should be stored or not
		   $insert = $this->insertCDR($proto,$channel_state,$answer_state,$application);

		   //Calculate length of LAM and IVR calls

		     //LAM: fetch length of file from Messages
		     if ($application == 'lam' && $channel_state=='CS_ROUTING'){
		     	$this->bindModel(array('hasOne' => array(
		     					      	 'Message' => array(
								 'foreignKey' => false,
								 'conditions'=>array('Message.file'=>$call_id)))));

                        $instance_id = substr($ext,1);
		        $message = $this->Message->findByFile($call_id);


		        $this->set('length',$message['Message']['length']);
		        $this->set('quick_hangup',$message['Message']['quick_hangup']);
                               
		        $lm_menu = $this->query("select * from lm_menus where instance_id = $instance_id ");
		        $this->set('title',$lm_menu[0]['lm_menus']['title']);

                        $this->log("[INFO] NEW CDR, Application: ".$application.", Type: ".$entry['Channel-State'].", Call-ID: ".$entry['Unique-ID'].", Epoch: ".$entry['Event-Date-Timestamp'], "cdr"); 
		     } 
		     //IVR: Epoch diff of CS_ROUTING and CS_DESTROY
		     elseif ($channel_state =='CS_DESTROY'){

		     	    if($start = $this->find('first', array('conditions'=>array('call_id'=>$call_id,'channel_state' =>'CS_ROUTING','application'=>'ivr')))){

		     	    	    $length = $epoch - $start['Cdr']['epoch'];
		     		    $this->set('length',$length);

		     		}
		     }


		     //Set IVR title
	       	     //FIXME! //Create custom event for CS_ROUTING CDR	
	     	     elseif ($application == 'ivr' && $channel_state == 'CS_ROUTING'){


			       $ivr_parent = $this->query('select title from ivr_menus where instance_id = '.$matches[1]);
	       	       	       $this->set('title', $ivr_parent[0]['ivr_menus']['title']);
		      }


		     $this->set('application', $application);

		     if($insert){


			//Check if user is registered


			//Process only CS_ROUTING (start) messages
			if($entry['Channel-State']=='CS_ROUTING'){

				$sender = $this->sanitizePhoneNumber($entry['Caller-Caller-ID-Number']);

                        	//Determine database field to update
                        	if($application == 'ivr') {
                                         $update='count_ivr';
                                } elseif ($application == 'lam'){
                               	  	 $update='count_lam';
                                }

                        	//Update user statistics
                        	$user_id = $this->updateUserStatistics($proto,$sender,$application, $update);

	                } else {

			        $user_id = false;
			} 


			$this->set('user_id',$user_id);
			$this->create($this->data);
	  	     	$this->save($this->data['Cdr']);

			//Add call length to CS_ROUTING entry
		        if($start){
		           $this->id = $start['Cdr']['id'];
		           $this->saveField('length',$length);
		        }
		   


		  //Add routing(start) and destroy(end) to monitor_ivr if application='Voice menu'
		  if($application =='ivr' || ($channel_state=='CS_DESTROY' && $this->MonitorIvr->find('count',array('conditions' => array('MonitorIvr.call_id' => $call_id))))){


		  	$epoch = intval(floor($entry['Event-Date-Timestamp']/1000000));
	       	  	$this->MonitorIvr->set('epoch' , $epoch);
		  	$this->MonitorIvr->set('call_id' , $entry['Unique-ID']);
	       	  	$this->MonitorIvr->set('ivr_code', '');
		  	$this->MonitorIvr->set('digit', '');
    	       	  	$this->MonitorIvr->set('node_id','');
	       	  	$this->MonitorIvr->set('caller_number', $this->sanitizePhoneNumber($entry['Caller-Caller-ID-Number']));
	       	  	$this->MonitorIvr->set('extension', $entry['Caller-Destination-Number']);
		  	//$this->MonitorIvr->set('cdr_id', $cdr['Cdr']['id']);
		  	$this->MonitorIvr->set('type', $channel_state);

		  	$this->MonitorIvr->create($this->MonitorIvr->data);
	  	  	$this->MonitorIvr->save($this->MonitorIvr->data);

                        $this->log("[INFO] NEW CDR, Application: ".$application. ", Type: ".$entry['Channel-State'].", Call-ID: ".$entry['Unique-ID'].", Epoch: ".$entry['Event-Date-Timestamp'], "cdr"); 
		  	$this->log("[INFO] NEW ENTRY, Type: ".$entry['Channel-State'].", Call-ID: ".$entry['Unique-ID'].", Epoch: ".$entry['Event-Date-Timestamp'], "monitor_ivr");


		  }


	        } //insert into CDR		

	      }  //while

              //** Fetch MONITOR_IVR from spooler **//
      	      $array = Configure::read('monitor_ivr');
	      $obj = new ff_event($array);	       

	      if ($obj -> auth != true) {
    	       	  die(printf("Unable to authenticate\r\n"));
	      }

      	      while ($entry = $obj->getNext('delete')){

		$cdr = $this->find('first', array('conditions' => array('call_id' => $entry['FF-IVR-Unique-ID'], 'channel_state'=>'CS_ROUTING'),'order' =>'Cdr.call_id'));

                  $service = $entry['FF-IVR-IVR-Node-Service-ID'];
                  
                  switch ($service){

                         case 'Node':
                         $table_id = 'node_id';
                         break;

                         case 'LmMenu':
                         $table_id = 'lm_menu_id';
                         break;

                         case 'IvrMenu':
                         $table_id = 'ivr_menu_id';
                         break;

                  }
		  $epoch = intval(floor($entry['Event-Date-Timestamp']/1000000));
	       	  $this->MonitorIvr->set('epoch' , $epoch);
		  $this->MonitorIvr->set('call_id' , $entry['FF-IVR-Unique-ID']);
	       	  $this->MonitorIvr->set('ivr_code', urldecode($entry['FF-IVR-IVR-Name']));
		  $this->MonitorIvr->set('digit', $entry['FF-IVR-IVR-Node-Digit']);
    	       	  $this->MonitorIvr->set('service',$service);
    	       	  
                  if ($table_id) { $this->MonitorIvr->set($table_id,$entry['FF-IVR-IVR-Node-Unique-ID']);}

	       	  $this->MonitorIvr->set('caller_number', $this->sanitizePhoneNumber($entry['FF-IVR-Caller-ID-Number']));
	       	  $this->MonitorIvr->set('extension', $entry['FF-IVR-Destination-Number']);
		  $this->MonitorIvr->set('cdr_id', $cdr['Cdr']['id']);
		  $this->MonitorIvr->set('type', __('tag',true));

		  $this->MonitorIvr->create($this->MonitorIvr->data);
	  	  $this->MonitorIvr->save($this->MonitorIvr->data);


	        }  //While monitor_ivr

	} 

/*
 * Get unique id for call
 *
 * @param int $id 
 *
 */

    function getCallId($id){

    $data = $this->findById($id);
    return $data['Cdr']['call_id'];     
    }



/*
 * Convert date array to epoch
 *
 * @param array $data
 * @return array $epoch
 */

   function dateToEpoch($data){
 
      	 $start	  = $data['start_time'];
      	 $end 	  = $data['end_time'];
 
	$hour_start = $start['hour'];
	$hour_end   = $end['hour'];

	if($start['meridian']=='pm' && $start['hour']!=12){ 
	   	$hour_start=$hour_start+12;
		} 
 	elseif($start['meridian']=='am' && $start['hour']==12){ 
	   	$hour_start='00';
	}

	if($end['meridian']=='pm' && $end['hour']!=12){ 
	   	$hour_end=$hour_end+12;
		} 
 	elseif($end['meridian']=='am' && $end['hour']==12){ 
	   	$hour_end='00';
	}

	 $start = $start['year'].'-'.$start['month'].'-'.$start['day'].' '.$hour_start.':'.$start['min'].':00';
     	 $end   = $end['year'].'-'.$end['month'].'-'.$end['day'].' '.$hour_end.':'.$end['min'].':00';


	 $epoch['start'] = strtotime($start);
      	 $epoch['end']  = strtotime($end);

	 return $epoch;

	 }


/*
 * Determine channel used for incoming call (Skype/SIP/GSM)
 *
 *
 */
	 function getProto($channel){

		  $proto=false;	

		  if(stripos($channel,'skypopen')===0){ 
		  	$proto = 'skype';
		  } elseif(stripos($channel,'gsmopen')===0){ 
		    	$proto = 'gsm';
		  } elseif(stripos($channel,'sofia')===0){ 
		        $proto = 'sip';
		  }

		  return $proto;
	  }



/*
 * Determine whether CDR should be saved or not
 *
 *
 */

	function insertCDR($proto,$channel_state,$answer_state, $application){

		   $insert = true;
		   switch ($proto){

		    case 'gsm':
		    if ($channel_state == 'CS_ROUTING' && $answer_state =='ringing'){
		         $insert = false;
		    } 
		    break;

		    case 'sip':
		    if ($channel_state == 'CS_ROUTING' && $answer_state =='answered' && $application =='ivr'){
		         $insert = false;
		    }
		    break;
	

		    case 'skype':
		    if ($channel_state == 'CS_ROUTING' && $answer_state =='ringing'){
		         $insert = false;
		    }
		    break;
		   }

		   return $insert;
		   }



/*
 *
 *
 */

        function getEpoch($type){

                 switch($type){

                    case 'first':
                    $data = $this->find('first');
                    $epoch = $data['Cdr']['epoch'];

                    break;


                 }

                 return $epoch;

        }


}

?>
