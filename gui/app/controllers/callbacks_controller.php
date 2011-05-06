<?php
/****************************************************************************
 * callback_controller.php	- Controller for incoming and outgoing callback requests.
 * version 		 	- 2.5.1200
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

class CallbacksController extends AppController{

	var $name = 'Callbacks';
	var $helpers = array('Flash','Session','Time','Number','Formatting');      


	var $paginate = array(
		    	      'limit' => 50,
			      'order' => array('Callback.created' => 'desc'));


/*
 *
 * Refresh of calback requests from Dialer
 *
 *
 */

   function dialer_refresh($mode = null){


          $this->autoRender = false;
   	  $dialer = Configure::read('DIALER');
          $result = $this->Callback->find('all', array('conditions' => array('Callback.status' => array(1,2))));
          $request = array('auth' => array('method' => 'Basic', 'user' => $dialer['user'],'pass' => $dialer['pwd']));


          foreach($result as $key => $entry){

debug($entry);
             $campaign_id  = $entry['Campaign']['dialer_id'];          
             $phone_number = $entry['Callback']['phone_number'];          
             $job_id       = $entry['Callback']['job_id'];          

             $HttpSocket = new HttpSocket();
             $results = $HttpSocket->get($dialer['host'].$dialer['contact'].'/'.$campaign_id.'/'.$job_id, false,  $request); 
             $header = $HttpSocket->response['raw']['status-line'];

             if ($this->headerGetStatus($header) == 1) {     

                $dialer_result = json_decode($results);

                if ($entry['Callback']['id'] == $dialer_result[0]->{'contact_id'} ){


                   $id                         = $entry['Callback']['id'];
                   $this->Callback->id         = $id;
                   //$this->data['status']       = $dialer_result[0]->{'status'};
                   $this->data['retries']      = $dialer_result[0]->{'count_attempt'};
                   $this->data['last_attempt'] = $dialer_result[0]->{'last_attempt'};
                   $this->data['status']       = 1;
                       
                       $this->Callback->save($this->data, array('status','retries','last_attempt'));
                       $this->log("SUCCESS: dialer_refresh; Campaign id: ".$id."; Mode: ".$mode, "campaign");               
                 } else {

                    $this->log("FAILURE: dialer_refresh MISMATCH ID; Campaign id: ".$id."; Mode: ".$mode, "campaign"); 

                 }             


              } else {

                      $this->log("FAILURE: dialer_refresh HEADER; Campaign id: ".$id."; Mode: ".$mode, "campaign"); 
              }

           }
   }

}
?>
