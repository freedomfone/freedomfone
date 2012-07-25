<?php
/****************************************************************************
 * callback.php         - Model for callback requests. Manages outgoing calls, and user limits.
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

App::import('Core', 'HttpSocket');


class Callback extends AppModel{


      var $name = 'Callback';

      var $belongsTo = array(
      	  'Campaign' => array(
 	  	 'className' => 'Campaign',
 		 'foreignKey' => 'campaign_id'
 		 ),
      	  'CallbackService' => array(
 	  	 'className' => 'CallbackService',
 		 'foreignKey' => 'callback_service_id'
 		 ),


                 );


function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

       $this->validate = array(
                'extension' => array(
                            'rule' => 'notEmpty',
                            'message'  => __('You must select a service.',true),
                            ));

}


/*
 * Fetches new data from spooler
 *
 *
 */

    function refresh(){

      $array       = Configure::read('callback_in');
      $dialer      = Configure::read('DIALER');
      $obj         = new ff_event($array);	       

       	   if ($obj -> auth != true) {
  	       	  die(printf("Unable to authenticate\r\n"));
           }

     	   while ($entry = $obj->getNext('update')){

              $code             = $entry['Body'];
	      $created          = intval(floor($entry['Event-Date-Timestamp']/1000000));
	      $type             = $entry['FF-Type'];
	      $sender           = $this->sanitizePhoneNumber($entry['from']);
              $time             = time();
              $user             = $this->getCallbackUser($sender);             
              $callback_service = $this->getCallbackService($code);  
              $limits           = $this->getUserUsage($sender,$callback_service['id']);

              //CallbackService Open
              if(strtotime($callback_service['end_time']) < $time || strtotime($callback_service['start_time']) > $time){

                        //callback_denied (reason: callback time)
                        $this->log('ERROR refresh: CALLBACK SERVICE NOT OPEN', 'callback');		       
              } 
              //CallbackService Quota
              elseif ($callback_service['max_calls_total'] == $callback_service['calls_total']){

                     //callback_denied (reason: callback quota)
                    $this->log('ERROR refresh: CALLBACK QUOTA EXCEEDED', 'callback');		       
              } 
              //User ACL
              elseif($user['User']['acl'] == 3){

                     //callback_denied (reason: user ACL)
                    $this->log('ERROR refresh: USER ACL', 'callback');   
              } 
              //User call quota (total)
              elseif($callback_service['max_calls_user'] == $limits['total']){

                    //callback_denied (reason: user calls total)
                    $this->log('ERROR refresh: USER TOTAL LIMIT EXCEEDED', 'callback');   
              }
              //User call quota (daily)
              elseif($callback_service['max_calls_user_day'] == $limits['day']){

                    //callback_denied (reason: user calls day)
                    $this->log('ERROR refresh: USER DAILY LIMIT EXCEEDED', 'callback');   

              } else 

             {


                //Process callback
                if ($type == 'tickle'){ 

                   $name  = __('Callback tickle',true);
		   $field = 'count_callback_tickle';
		   $application = 'callback_tickle';

                } else { 

                   $name  = __('Callback SMS',true); 
                   $type  = 'SMS';
		   $field = 'count_callback_sms';
		   $application = 'callback_sms';

                }

                if($user){
                        $this->updateUserStatistics('gsm', $sender, $application, $field);
                        $user_id = $user['User']['id'];
                } else {
                        $user_id = $this->createUser($sender, $name, $field);
                }
 

                //** Create Newfie CampaignSubscriber **// 
		App::import('model','CallbackService');
		$callbackService = new CallbackService();
		$data = $callbackService->getCallbackService($code);

                $campaign_subscriber = array('phonebook_id' => $data['nf_phone_book_id'], 'contact' => $sender);

                $HttpSocket = new HttpSocket();
                $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                              'header' => array('Content-Type' =>'application/json')
                                    );
                $results = $HttpSocket->post($dialer['host'].$dialer['path'].$dialer['campaign_subscriber_POST'], json_encode($campaign_subscriber), $request); 
                $results = json_decode($results,true);
                $header  = $HttpSocket->response['raw']['status-line'];

                if ($this->headerGetStatus($header) == 1) {

                  $results = $HttpSocket->get($dialer['host'].$dialer['path'].$dialer['campaign_subscriber_GET'].$data['nf_campaign_id'].'/'.$sender.'/', false,$request);  
		  $results = json_decode($results,true);

                  unset($callback);
                  $callback['callback_service_id'] = $callback_service['id'];
                  $callback['nf_campaign_subscriber_id'] = $results[0]['campaign_subscriber_id'];
                  $callback['user_id'] = $user_id;
                  $callback['type'] = $type;
                  $callback['retries'] = 0; 
                  $callback['status'] = 1;
                  $callback['state'] = 1; 
                  $callback['phone_number'] = $sender;
                  $callback['last_attempts'] = false; 
                  $callback['created'] = $created;

                  $this->create();
                  $this->save($callback);


                  } else {

	            $this->log('ERROR refresh: Newfies contact::post '.$results, 'callback');		       
                  
                  }

                }  // Process callback

            } // while

      }



/**
 * Check if the number of callbacks allowed (within a certain time limit) for a user has exceeded its maximum value or not
 * return true| false
 *
 */
	function withinLimit($sender){

		 $data = $this->query("select * from callback_settings limit 0,1");

		       if ($data[0]['callback_settings']['limit_time']==0 | $data[0]['callback_settings']['limit_user'] ==0 ){
	    	       	  return true;
			  }
		       else {

		       	$epoch_limit = time()-$data[0]['callback_settings']['limit_time']*3600;
			$user_limit  = $data[0]['callback_settings']['limit_user'];
			$response = $this->find('count', array('conditions' => array('Callback.sender' => $sender,'Callback.created >' => $epoch_limit,'Callback.status' =>'1')));

		    		  if($response >= $user_limit){
		        	  	       return false;
		     			       }
		     			       else {
		     			       return true;
		     	             }
		   }

	}

/*
 *
 * Get User entry associated with incoming Callback request
 * 
 * @params
 *      $phone_number ($int)
 * 
 * @return
 *      $userData ($array) 
 */

     function getCallbackUser($phone_number){

            $this->bindModel(array('hasMany' => array('User' => array('className' => 'User','foreignKey' => 'user_id'))));
            $userData = $this->User->PhoneNumber->find('first',array('conditions' => array('PhoneNumber.number' => $phone_number)));

            return $userData;
     }


/*
 *
 * Get CallbackService entry associated with incoming Callback request
 * 
 * @params
 *      $code ($string)
 * 
 * @return
 *      $data ($array) 
 */

     function getCallbackService($code){

            $this->bindModel(array('hasMany' => array('CallbackService' => array('className' => 'CallbackService','foreignKey' => 'callback_service_id'))));
            $data = $this->CallbackService->find('first',array('conditions' => array('CallbackService.code' => $code)));

            return $data['CallbackService'];
     }

/*
 *
 * Get number of Callback requests for a specific user and callback service. Only callbacks with status START, PAUSE, and COMLETE are counted
 * 
 * @params
 *      $phone_number (int)
 *      $code (string)  //Callback code
 * 
 * @return
 *      $array($total (int), $day (int)) 
 */
     function getUserUsage($phone_number,$callback_service_id){

              $time = time() - 86400;
              $total = $this->find('count', array('conditions' => array('Callback.callback_service_id' => $callback_service_id, 'Callback.phone_number' => $phone_number, 'Callback.status' => array(1,2,5))));
              $day   = $this->find('count', array('conditions' => array('Callback.callback_service_id' => $callback_service_id, 'Callback.phone_number' => $phone_number, 'Callback.status' => array(1,2,5),'Callback.created >' => $time)));

              return array('total' => $total, 'day' => $day);
     }



/*
 *
 * Create new user 
 * 
 * @params
 *      $phone_number (int)
 *      $name (string)
 * 
 */
    function createUser($phone_number, $name, $field){

      	     
      $application = 'callback_in';
      $created = time();
 
         $user =array('created'=> $created,'new'=>1, $field =>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl'=>1,'name' => $name);
         $this->User->create(); 
         if ($this->User->save($user)){
                $user_id = $this->User->getLastInsertId();
                $this->User->PhoneNumber->saveAll(array('user_id' => $user_id, 'number' => $phone_number));
         }

         return $user_id;
     }


}


?>
