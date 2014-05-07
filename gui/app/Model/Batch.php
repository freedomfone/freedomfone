<?php
/****************************************************************************
 * batch.php		- Model for outoging sms batch.
 * version 		- 3.0.1500
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this fileexcept in compliance with
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


class Batch extends AppModel{

      var $name = 'Batch';
      var $hasMany = array('SmsReceiver' => array(
                        	       'order' => 'SmsReceiver.id ASC',
                        	       'dependent' => true)
				       ); 
      var $belongsTo = array('SmsGateway');




function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
        'body' => array(
               	  'rule'	=> array('maxLength', 160),
	          'required' 	=> true,
            	  'message'	=> __('A valid SMS body is required (Max 160 characters).',true)
	        ),
        'filename' => array(
            	   'rule'	=> array('minLength', 1),
	           'required' 	=> true,
            	   'message'	=> __('Please select a file to upload.',true)
	        ),
        'name' => array(
	           'minLength'	=> array(
		   		'rule'	=> array('minLength', 5),
		   		'required' => true,
		   		'message'=> __('A valid name of the SMS batch is required (Min 5 characters).',true)
		   	       ),
		'isUnique'     => array(
		       	       'rule'	 => 'isUnique',
			       'message' => __('The batch name must be unique.',true)
			       ),
	),
        'sms_gateway_id' => array(
	     'rule'	 => array('minLength', 1),
	     'required'  => true,
             'message'	 => __('Please select an SMS channel.',true)
	        	 ),
		);
}



function authBatch($id){

	 $data = $this->findByid($id);
	 $type = $data['Batch']['gateway_code'];


	 //GAMMU
	 if($type == 'GM'){

      	 $auth  = Configure::read('GAMMU');
     	 $sms   = new sms('mysql', $auth);
     

	 }

	 //OFFICEROUTE
	 elseif ($type == 'OR'){

      	 $auth  = Configure::read('OR_SNMP');
	 $_sender = explode(' ',$data['Batch']['sender']);
	 $ip_addr= $_sender[1];
	 $domain = $_sender[2];
     	 $sms   = new sms('email', array('domain' => $domain,'ip_addr' => $ip_addr));

	 } elseif ($type == 'CT'){


	 $auth = array('baseurl' => $data['SmsGateway']['url'] , 'username' => $data['SmsGateway']['username'], 'password' => $data['SmsGateway']['password'], 'api_key' => $data['SmsGateway']['api_key']);
	 $sms   = new sms('ip_CT', $auth);



	 } elseif ($type == 'PC'){


	 } 


	 return $sms;

} 


function getStatus($sms = null, $code= null, $id = null){

	 $status=false;

	 if($code == 'CT' && $sms && $id){

	   $result = $sms->getStatus(false, $code, $id);
	   $status = trim($result[2]);

	 } elseif( $code =='OR'){

	   $status = 'N/A';

	 } elseif($code == 'GM'){

	   $result = $sms->getStatus($id, $code, false);
	   $status = $result[$id];


   	} 

	 return $status;

}

function processBatch($id){


	 $data = $this->findByid($id);
	 $type = $data['Batch']['gateway_code'];


	 //GAMMU
	 if($type == 'GM'){

      	 $auth  = Configure::read('GAMMU');
     	 $sms   = new sms('mysql', $auth);

	 }

	 //OFFICEROUTE
	 elseif ($type == 'OR'){

      	 $auth  = Configure::read('OR_SNMP');
	 $_sender = explode(' ',$data['Batch']['sender']);
	 $ip_addr = $_sender[1];
	 $domain = $_sender[2];

     	 $sms   = new sms('email', array('ip_addr' => $ip_addr, 'domain' => $domain));

	 } elseif ($type == 'CT'){


	 $auth = array('baseurl' => $data['SmsGateway']['url'] , 'username' => $data['SmsGateway']['username'], 'password' => $data['SmsGateway']['password'], 'api_key' => $data['SmsGateway']['api_key']);
	 $sms   = new sms('ip_CT', $auth);



	 } elseif ($type == 'PC'){


	 } 


	 if(!$sms->res){ 

	   return false;
	   
	 }  else { 

	  foreach($data['SmsReceiver'] as $key => $receiver){

	      $receivers[] = $receiver['receiver'];

	   }


  	    $id = $sms->sendSMS($data['Batch']['body'], $receivers,  $data['Batch']['sender_number']); 

	    return array($id, $receivers);

	 }
}


function getChannels(){

      $auth  = Configure::read('GAMMU');
      $gammu = new sms('mysql', $auth);
      $phones    = $gammu->getPhones(); 


      foreach($phones as $phone){
        $channels[] = $phone[0];
      }

      $officeroutes  = Configure::read('OR_SNMP');
      foreach($officeroutes as $officeroute){

        if($this->isAlive($officeroute['ip_addr'])){

	   $channels[] = "OR ".$officeroute['ip_addr']." ".$officeroute['domain'];

	}
      }

      return $channels;

}

}


?>
