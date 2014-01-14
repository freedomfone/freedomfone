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
      var $belongsTo = array('SmsGateway');




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
        'sms_gateway_id' => array(
	     'rule'	=> array('minLength', 1),
	    'required' 	=> true,
            'message'	=> __('Please select an SMS channel.',true)
	    ),
	);
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
	 $domain = $_sender[2];
     	 $sms   = new sms('email', array('domain' => $domain));

	 } elseif ($type == 'CT'){
	 debug($data);

	 debug("clickatel");
	 $auth = array('url' => $data['SmsGateway']['url'] , 'username' => $data['SmsGateway']['username'], 'password' => $data['SmsGateway']['password'], 'api_key' => $data['SmsGateway']['api_key']);
	 $sms   = new sms('ip_CT', $auth);


	 } elseif ($type == 'PC'){

	 debug("panacea");
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



	function test(){ 

    $username = 'freedom_fone';
    $password = 'fr3dzsms';
    $api_key = '3420964';
    $baseurl = 'http://api.clickatell.com'; 
    $text = urlencode("This is an example message");
    $to = "46706506749";
 
    // auth call
    $url = "$baseurl/http/auth?api_id=$api_key&user=$username&password=$password";

	debug($url);
    // do auth call
    $ret = file($url);
 
	debug($ret);
    // explode our response. return string is on first line of the data returned
    $status = explode(":",$ret[0]);

    debug($status);
    if ($status[0] == "OK") {
 
        $session_id = trim($status[1]); // remove any whitespace
        $url = "$baseurl/http/sendmsg?session_id=$session_id&to=$to&text=$text";

http://api.clickatell.com/http/sendmsg?session_id=xxxx&to=xxxx&text=xxxx

	debug($url); 
        // do sendmsg call
        $ret = file($url);
        $send = explode(":",$ret[0]);
 
	debug($ret);
        if ($send[0] == "ID") {
            echo "successnmessage ID: ". $send[1];
        } else {
            echo "send message failed";
        }
    } else {
        echo "Authentication failure: ". $ret[0];
    }



  	}

}



?>
