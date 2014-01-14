<?php
/****************************************************************************
 * polls_controller.php		- Controller for polls. Manages CRUD operations on polls and votes.
 * version 		 	- 3.0.1700
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


class PollsController extends AppController{

      var $name = 'Polls';

      var $helpers = array('Time','Html', 'Session','Form','Formatting','Number','Js');

      

      function refresh($method = null){

               $this->autoRender = false;
               $this->logRefresh('poll',$method); 
               $this->Poll->refresh();

      }



      function index(){


        $this->set('title_for_layout', __('Manage Polls',true));
        $this->Poll->unbindModel(array('hasMany' => array('User')));
        $this->set('polls',$this->Poll->find('all',array('order'=>'Poll.created DESC')));

      }


     function view($id){

        $this->set('title_for_layout', __('View Poll',true).' : '.$this->Poll->getTitle($id));
        $this->Poll->id = $id;
        $data = $this->Poll->findById($id);
        $this->set(compact('data'));

      }


   function add(){

       $this->set('title_for_layout', __('Create Poll',true));

      //Render empty form
      if (empty($this->request->data['Poll'])){
      	 $this->render(); 
      }  else{

      //Fetch form data
	$this->Poll->set( $this->request->data );

	foreach($this->request->data['Vote'] as $key => $option){

		if(!$option['chtext'] && $key>1){
			unset($this->request->data['Vote'][$key]); 
		}
	
	}

	//Validate data (poll and vote)
	if ($this->Poll->saveAll($this->request->data, array('validate' => 'only'))) {

	 //Save poll data
	  $this->Poll->save($this->request->data['Poll']);



	 //Retrieve id of saved poll
	 $id = $this->Poll->getLastInsertId();

	 

	 //Set poll_id for each vote
	 foreach ($this->request->data['Vote'] as $key => $value){
	
		$this->request->data['Vote'][$key]['poll_id']=$id; 
	 }

	 //Save vote data
	 $this->Poll->Vote->create($this->request->data['Vote']);
	 $this->Poll->Vote->saveAll($this->request->data['Vote'],array('validate' => false));
         $this->log('[INFO] POLL CREATED, Id: '.$id, 'poll');    	     

         if ( $this->Poll->find('first', array('conditions' => array('id' => $id, 'status' =>2)))){                                                                                                                                                                            
            $this->Session->setFlash(__("The poll has been created. Please note that the poll's closing time has already passed.",true),'warning');                               
                            $this->log('[WARNING] Poll closing time has passed, Id: '.$id, 'poll');                                                                                                                      
         } else {                                                                                                                                                                                                                                                              
          $this->Session->setFlash(__("The poll has successfully been created.",true),'success');

         }        
	
	 $this->redirect(array('action' => 'index'));
        }
      }
    }




    function delete ($id){

        $this->set('title_for_layout', __('Delete Poll',true));

     	     $title = $this->Poll->getTitle($id);
    	     if($this->Poll->delete($id,true))
	     {
    	     $this->Session->setFlash(__('The following poll has been deleted',true).': '.$title, 'success');
             $this->log('[INFO] POLL DELETED, Id: '.$id.', Title: '.$title, 'poll');    	     
	     $this->redirect(array('action' => '/index'));


	     }



    }


    function unlink ($id,$poll_id){

    $result =  $this->Poll->Vote->find('count',array('conditions' => array('Vote.poll_id' =>$poll_id)));
    
       if($result > 2){
    	     if($this->Poll->Vote->delete($id,true))
	     {
             $this->log('[INFO] POLL OPTION DELETED, Id: '.$id, 'poll');    	     
	     $this->redirect(array('action' => '/edit/'.$poll_id));
	     }
       } else {

       $this->Session->setFlash(__('Poll option could not be deleted. A poll needs at least two options.',true),'warning');
       $this->redirect(array('action' => '/edit/'.$poll_id));
       }



    }


   function edit($id = null){

        $this->set('title_for_layout', __('Edit Poll',true).' : '.$this->Poll->getTitle($id));   
 
	   if (!$id && empty($this->request->data)){ 
			$this->Session->setFlash(__('Invalid Poll', true)); 
			$this->redirect(array('action'=>'index')); 
	    } elseif (empty($this->request->data['Poll'])){ 


		$this->request->data = $this->Poll->read(null,$id);
                $votes = $this->Poll->Vote->find('all',array('conditions' =>array('Poll.id' => $id)));
		$this->set(compact('votes'));

	   } else{
   
                //Fetch form data
	        $this->Poll->set( $this->request->data );

	        //Validate data (poll and vote)
	        if ($this->Poll->saveAll($this->request->data, array('validate' => 'only'))) {

	            //Save poll data

	            $this->Poll->save($this->request->data['Poll']);
                    $this->log('[INFO] POLL EDITED, Id: '.$id, 'poll');    	     

                         if ( $this->Poll->find('first', array('conditions' => array('id' => $id, 'status' =>2)))){                                                                                                                                                                            
                            $this->Session->setFlash(__("The poll has been updated. Please note that the poll's closing time has already passed.",true),'warning');
                            $this->log('[WARNING] Poll closing time has passed, Id: '.$id, 'poll');
                                   
                         } else {
                      
                            $this->Session->setFlash(__("The poll has been updated.",true),'success');
                         }    
	
                        $this->redirect(array('action' => 'index'));

                 } else {

                  $votes = $this->Poll->Vote->find('all',array('conditions' =>array('Poll.id' => $id)));
		  $this->set(compact('votes'));

                 } 
            }
    }


}
?>
