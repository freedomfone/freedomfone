<?php
/****************************************************************************
 * office_route_controller.ctp	- Controller for OfficeRoute channels.
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

class OfficeRouteController extends AppController{

      var $name = 'OfficeRoute';
      var $helpers = array('Flash');    

      function refresh($method = null){

      $this->autoRender = false;
      $this->logRefresh('office_route',$method); 

      $data = $this->OfficeRoute->refresh();


        //Create local db of old data
        $db = $this->OfficeRoute->find('all', array('imsi !=' => ''));
  


       if($db){
		foreach($db as $key => $entry){
                    $prev[$entry['OfficeRoute']['imsi']]= array($entry['OfficeRoute']['title'], $entry['OfficeRoute']['msisdn']);
        	}
	} else {

	            $prev = array();
	}
	//$this->OfficeRoute->deleteAll('1 = 1', false);
	if($data){

         foreach ($data as $key => $channel){

	 //IMSI has been seen before
	  if($channel['imsi'] && array_key_exists($channel['imsi'], $prev)){


	  $data[$key]['title'] = $prev[$channel['imsi']][0];
	  $data[$key]['msisdn'] = $prev[$channel['imsi']][1];

	  }


	 } //foreach



	 } //data

         $this->OfficeRoute->saveAll($data);


         }


   function edit($id ){

        $this->set('title_for_layout', __('Edit OfficeRoute',true));


	  // No id, or empty form
	     if(!$id){	
	     $this->Session->setFlash(__('Invalid option.', true),'warning'); 
	     $this->redirect(array('action'=>'index')); 
	  }
          
          // Retrieve data from database and display 
    	  elseif(empty($this->request->data['OfficeRoute'])){

		$this->OfficeRoute->id = $id;
		$this->request->data = $this->OfficeRoute->read(null,$id);

          }
          
          //Fetch form data 
	  else {
	  
          $this->OfficeRoute->set( $this->request->data );	       
          $this->OfficeRoute->save();
  	  $this->redirect(array('controller' => 'channels', 'action' => 'index'));
  
          }           

}


}



?>