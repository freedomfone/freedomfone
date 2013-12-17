<?php
/****************************************************************************
 * batch.php		- Model for outoging sms batch.
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


class Batch extends AppModel{

      var $name = 'Batch';
      var $hasMany = array('SmsReceiver' => array(
                        	       'order' => 'SmsReceiver.id ASC',
                        	       'dependent' => true)
				       ); 




function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
        'body' => array(
            'rule'=>array('maxLength', 160),
	    'required' => true,
            'message'=> __('A valid SMS body is required (Max 160 characters).',true)
	    ),
        'name' => array(
		    'minLength'=> array(
				'rule'=>array('minLength', 5),
	    			'required' => true,
            			'message'=> __('A valid name of the SMS batch is required (Main 5 characters).',true)
	    			),
	            'isUnique' =>array(
				'rule' => 'isUnique',
				'message' => __('The batch name must be unique.',true)
				 ),
			),
        'sender' => array(
	     'rule'	=> array('minLength', 2),
	    'required' 	=> true,
            'message'	=> __('Please select an SMS channel.',true)
	    ),
	);
}


function processBatch($id){


	 $data = $this->findByid($id);
	 $type = $data['Batch']['gateway_type'];


	 //GAMMU
	 if($type == 'GM'){

      	 $auth  = Configure::read('GAMMU');
     	 $sms   = new sms('mysql', $auth);
     
	 }

	 //OFFICEROUTE
	 elseif ($type == 'OR'){

      	 $auth  = Configure::read('OR_SNMP');
	 $_sender = explode(' ',$data['Batch']['sender']);
	 $domain = $_sender[2];
     	 $sms   = new sms('email', array('domain' => $domain));

	 }

	  foreach($data['SmsReceiver'] as $key => $receiver){

	      $receivers[] = $receiver['receiver'];

	   }

     	    $id = $sms->sendSMS($data['Batch']['body'], $receivers,  $data['Batch']['sender']); 


	return array($id, $receivers);

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
        
	$channels[] = "OR ".$officeroute['ip_addr']." ".$officeroute['domain'];
      }

      return $channels;

}


}



?>
