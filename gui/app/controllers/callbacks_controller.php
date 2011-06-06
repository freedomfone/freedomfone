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
 * Refresh of new callback requests from dispatcher
 *
 *
 */

      function refresh($method = null){

           $this->autoRender = false;
           $this->logRefresh('callback_in',$method); 
           $this->Callback->refresh($method);

      }

/*
 *
 * Refresh of callback status from Dialer
 *
 *
 */

   function dialer_refresh($mode = null){

          $this->autoRender = false;
   	  $dialer = Configure::read('DIALER');
          $result = $this->Callback->find('all', array(
                                                 'fields' => array('Callback.id','Callback.phone_number','Campaign.nf_campaign_id','CallbackService.nf_campaign_id','CallbackService.id','CallbackService.calls_total', 'Callback.status'),
                                                 'conditions' => array('Callback.status' => array(1,2,3))
                                                 ));

             //** CONTACT::GET **//
             $HttpSocket = new HttpSocket();
             $request = array('auth' => array('method' => 'Basic', 'user' => $dialer['user'],'pass' => $dialer['pwd']));

             foreach($result as $entry){

                     if(! $nf_campaign_id = $entry['Campaign']['nf_campaign_id']) { $nf_campaign_id = $entry['CallbackService']['nf_campaign_id']; }
                     $results = $HttpSocket->get($dialer['host'].$dialer['contact'].'/'.$nf_campaign_id.'/'.$entry['Callback']['phone_number'], false,  $request); 
                     $header = $HttpSocket->response['raw']['status-line'];

                     if ($this->headerGetStatus($header) == 1) {     

                        $results = json_decode($results,true);
                        $this->Callback->id = $entry['Callback']['id'];
                        $this->data['status'] = $results[0]['status'];
                        $this->data['last_attempt'] = $results[0]['last_attempt'];
                        $this->data['retries'] = $results[0]['count_attempt'];
                        $this->Callback->save($this->data);

                        //Callback completed, add to statistics
                        if($results[0]['status'] == 5 && $entry['Callback']['status'] != 5 && $entry['CallbackService']['nf_campaign_id']){

                              $this->Callback->CallbackService->id = $entry['CallbackService']['id'];
                              $this->data['calls_total'] = $entry['CallbackService']['calls_total']+1;
                              $this->Callback->CallbackService->save($this->data);


                        }
                     }

             }
 }

}
?>
