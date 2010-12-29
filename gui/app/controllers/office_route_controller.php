<?php
/****************************************************************************
 * office_route_controller.ctp	- Controller for OfficeRoute channels.
 * version 			- 1.0.364
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
    

      function refresh($method = null){

      $this->autoRender = false;
      $this->logRefresh('office_route',$method); 

      $data = $this->OfficeRoute->refresh();


        //Create local db of old data
        $db = $this->OfficeRoute->findAll(array('imsi !=' => ''));
        foreach($db as $key => $entry){

                    $prev[$entry['OfficeRoute']['imsi']]= array($entry['OfficeRoute']['title'], $entry['OfficeRoute']['msisdn']);

        }

	if($data){

         foreach ($data as $key => $channel){

                 //Does db entry with IMEI exist?
                 $entry = $this->OfficeRoute->findByImei($channel['imei']);

                        //If yes: update db entry
                        if($entry){


                                if($channel['imsi']){ 
                                $channel['title'] = $prev[$channel['imsi']][0];
                                $channel['msisdn'] = $prev[$channel['imsi']][1];
                                } else {

                                $channel['title'] = false;
                                $channel['msisdn'] = false;
                                }
                               // $channel['slot'] = $key;
                                $id = $entry['OfficeRoute']['id'];
                                $this->OfficeRoute->set('id',$channel['id']);
  
                                $this->OfficeRoute->save($channel);
                     

                        } 

                        //If not: insert new entry
                        else {

                              // $channel['slot'] = $key;
                               $this->OfficeRoute->save($channel);

                        }


              }  //foreach   
	   }

              

         }


   function edit($id ){

      	$this->pageTitle = 'OfficeRoute : Edit';           


	  // No id, or empty form
	     if(!$id){	
	     $this->_flash(__('Invalid option.', true),'warning'); 
	     $this->redirect(array('action'=>'index')); 
	  }
          
          // Retrieve data from database and display 
    	  elseif(empty($this->data['OfficeRoute'])){

		$this->OfficeRoute->id = $id;
		$this->data = $this->OfficeRoute->read(null,$id);

          }
          
          //Fetch form data 
	  else {

          $this->OfficeRoute->set( $this->data );	       
          $this->OfficeRoute->save();
  	  $this->redirect(array('controller' => 'channels', 'action' => 'index'));
  
          }           

}


}



?>