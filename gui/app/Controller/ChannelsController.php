<?php
/****************************************************************************
 * channels_controller.ctp	- Controller for GSMopen channels.
 * version 			- 3.0.1500
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
      $gammu  = Configure::read('GAMMU');

      $data = false;

      //Refresh OfficeRoute
      $this->requestAction('/office_route/refresh');
      $this->loadModel('OfficeRoute');

      //For each office route in use
       foreach($snmp as $key => $unit){

     	if($this->OfficeRoute->is_alive($unit['ip_addr']) && $this->OfficeRoute->snmp_on()){

           $data[] = $this->OfficeRoute->findAllByIpAddr($unit['ip_addr']);
	
	} elseif ($this->OfficeRoute->is_alive($unit['ip_addr']) && !$this->OfficeRoute->snmp_on()){

           $data = 'snmp_off';
           $this->Session->setFlash(__('OfficeRoute SNMP daemon is not running.', true),'warning'); 

        }
       }

      $this->set('data',$data);

      $this->Channel->fsCommand("gsmopen_dump list");
      $this->set('title_for_layout', __('Audio channels',true));
      $this->requestAction('/channels/refresh');
      $this->set('gsmopen',$this->Channel->find('all'));



      }

      function audio_services(){


       if($this->request->data){

	    //Update hardware discovery files
	    $this->Channel->updateHardwareDiscovery($this->request->data);

	    //Create dialplan
            $this->Channel->create_dialplan($this->request->data);
       }

      $gammu  = Configure::read('GAMMU');
      $lam = $ivr = false;

      //Gammu
      if(file_exists($gammu['discovery'])){

      $gammu_discovery = file($gammu['discovery']);

      $this->loadModel('LmMenu');
      $lam = $this->LmMenu->find('list', array('fields' => array('instance_id','title')));
      foreach($lam as $key => $entry){
         $lam['2'.$key] = $lam[$key];
	 unset($lam[$key]);
      }

      $this->loadModel('IvrMenu');
      $ivr = $this->IvrMenu->find('list', array('fields' => array('instance_id','title')));
      foreach($ivr as $key => $entry){
         $ivr['4'.$key] = $ivr[$key];
	 unset($ivr[$key]);
      }



      } else {

      $gammu_discovery = false;

      }

      $this->set('gammu_discovery',$gammu_discovery);      
      $this->set(compact('gammu_discovery','lam','ivr'));

      }


      function refresh($method = null){


           $this->autoRender = false;
      	   $this->logRefresh('channels',$method); 
       	   $this->Channel->refresh();

      }

   function edit($id ){

        $this->set('title_for_layout', __('Edit Mobigater',true));  


	  // No id, or empty form
	     if(!$id){	
	     $this->Session->setFlash(__('Invalid option.', true),'warning'); 
	     $this->redirect(array('action'=>'index')); 
	  }
          
          // Retrieve data from database and display 
    	  elseif(empty($this->request->data['Channel'])){

		$this->Channel->id = $id;
		$this->request->data = $this->Channel->read(null,$id);

          }
          
          //Fetch form data 
	  else {

          $this->Channel->set( $this->request->data );	       
          $this->Channel->save();
  	  $this->redirect(array('action' => 'index'));
  
          }           

}


}



