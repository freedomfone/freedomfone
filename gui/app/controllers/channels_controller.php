<?php
/****************************************************************************
 * channels_controller.ctp	- Controller for GSMopen channels.
 * version 			- 2.0.1170
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

class ChannelsController extends AppController{

      var $name = 'Channels';
    

      function index(){


      $snmp   = Configure::read('OR_SNMP');
      $data = false;

      //Refresh OfficeRoute
      $this->requestAction('/office_route/refresh');
      $this->loadModel('OfficeRoute');

      //For each office route in use
       foreach($snmp as $key => $unit){

     	if($this->OfficeRoute->is_alive($unit['ip_addr'])){

           $data[] = $this->OfficeRoute->findAllByIpAddr($unit['ip_addr']);
	
	}
       }

      $this->set('data',$data);

      $this->Channel->fsCommand("gsmopen_dump list");
      $this->pageTitle = __('GSM channels',true);
      $this->requestAction('/channels/refresh');
      $this->set('gsmopen',$this->Channel->findAll());

      }




      function refresh($method = null){


           $this->autoRender = false;
      	   $this->logRefresh('channels',$method); 
       	   $this->Channel->refresh();

      }

   function edit($id ){

      	$this->pageTitle = 'Mobigater : Edit';           


	  // No id, or empty form
	     if(!$id){	
	     $this->_flash(__('Invalid option.', true),'warning'); 
	     $this->redirect(array('action'=>'index')); 
	  }
          
          // Retrieve data from database and display 
    	  elseif(empty($this->data['Channel'])){

		$this->Channel->id = $id;
		$this->data = $this->Channel->read(null,$id);

          }
          
          //Fetch form data 
	  else {

          $this->Channel->set( $this->data );	       
          $this->Channel->save();
  	  $this->redirect(array('action' => 'index'));
  
          }           

}


}



