<?php
/****************************************************************************
 * polls_controller.php		- Controller for polls. Manages CRUD operations on polls and votes.
 * version 		 	- 1.0.368
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

      var $helpers = array('Time','Html', 'Session','Form','Formatting');

      var $total;



      function refresh(){

      $this->autoRender = false;
 
      $this->Poll->refresh();

      }



      function index(){

        if(isset($this->params['form']['submit'])) {
	   if ($this->params['form']['submit']==__('Refresh',true)){
                   $this->requestAction('/polls/refresh');
                   }
       }


      $this->pageTitle = 'Manage polls';
      $this->set('polls',$this->Poll->find('all',array('order'=>'Poll.created DESC')));

      }


     function view($id){


     	if(isset($this->params['form']['submit'])) {
		if ($this->params['form']['submit']==__('Refresh',true)){
	   	   $this->requestAction('/polls/refresh');
     	   	   }
	}	   
      	   $this->Poll->id = $id;
      	   $this->set('data',$this->Poll->findById($id));       
      	   $this->pageTitle = 'View poll: '.$this->Poll->getTitle($id);
       
      }


   function add(){

      $this->pageTitle = 'Create new poll';

      //Render empty form
      if (empty($this->data)){

      	 $this->render();
	 }


      //Validate and save form data
      else{

        //Fetch form data
	$this->Poll->set( $this->data );

	foreach($this->data['Vote'] as $key => $option){

		if(!$option['chtext'] && $key>1){
			unset($this->data['Vote'][$key]); 
		}
	
	}

	//Validate data (poll and vote)
	if ($this->Poll->saveAll($this->data, array('validate' => 'only'))) {

	 //Save poll data
	  $this->Poll->save($this->data['Poll']);



	 //Retrieve id of saved poll
	 $id = $this->Poll->getLastInsertId();

	 

	 //Set poll_id for each vote
	 foreach ($this->data['Vote'] as $key => $value){
	
		$this->data['Vote'][$key]['poll_id']=$id; 
	 }

	 //Save vote data
	 $this->Poll->Vote->create($this->data['Vote']);
	 $this->Poll->Vote->saveAll($this->data['Vote'],array('validate' => false));


	
	 $this->Session->setFlash(__("The poll has been added to the database",true));
	 $this->redirect(array('action' => 'index'));
        }
      }
    }




    function delete ($id){

      $this->pageTitle = 'Delete poll';

     	     $title = $this->Poll->getTitle($id);
    	     if($this->Poll->delete($id,true))
	     {
    	     $this->Session->setFlash(__('The follwing poll has been deleted',true).': '.$title, 'default', array('class'=>'message_success'));
	     $this->log('Msg: POLL DELETED; Id:title: '.$id.":".$title, 'poll');	
	     $this->redirect(array('action' => '/index'));


	     }



    }


    function unlink ($id,$poll_id){

    $result =  $this->Poll->Vote->find('count',array('conditions' => array('Vote.poll_id' =>$poll_id)));
    
       if($result > 2){
    	     if($this->Poll->Vote->delete($id,true))
	     {
	     $this->log('Msg: POLL OPTION DELETED; Id: '.$id, 'poll');	
	     $this->redirect(array('action' => '/edit/'.$poll_id));
	     }
       } else {

       $this->Session->setFlash(__('Poll option could not be deleted. A poll needs at least two options.',true),'default',array('class'=>'error-message'));
       $this->redirect(array('action' => '/edit/'.$poll_id));
       }



    }


   function edit($id = null){

   $this->pageTitle = 'Edit poll: '.$this->Poll->getTitle($id);   

 
		if (!$id && empty($this->data)){ 
			$this->Session->setFlash(__('Invalid Poll', true)); 
			$this->redirect(array('action'=>'index')); 
		} 


   	    if (empty($this->data)){ 

		   $this->Poll->id = $id;
		
			//if entry with this id exists
			if ($this->data = $this->Poll->read(null,$id)){
			   $this->set('data',$this->data);       
			   
			   }
			else {
			   $this->Session->setFlash(__('Invalid Poll', true)); 
			   $this->redirect(array('action'=>'index')); 

			   }
		}


      //Validate and save form data
      else{

   
        //Fetch form data
	$this->Poll->set( $this->data );

	foreach($this->data['Vote'] as $key => $option){

		if(!$option['chtext'] && $key>1){
			unset($this->data['Vote'][$key]); 
		}
	
	}


	//Validate data (poll and vote)
	if ($this->Poll->saveAll($this->data, array('validate' => 'only'))) {

	 //Save poll data

	  $this->Poll->save($this->data['Poll']);

	  //Get unique id for each vote,
   	  $vote_id = $this->Poll->Vote->find('all', array('conditions' => array('Poll.id' => $id), 'order' => array('Vote.id asc')));

	  //Set id for each vote, and save data
   	   foreach($this->data['Vote'] as $key => $vote){


	   if(isset($vote_id[$key]['Vote']['id'])) { $voteId=$vote_id[$key]['Vote']['id'];} else { $voteId=false;}
		$this->data['Vote'][$key]['id']= $voteId;
	    	$this->data['Vote'][$key]['poll_id']=$id;

	     }

	 //Save vote data

	$this->Poll->Vote->create($this->data['Vote']);
	$this->Poll->Vote->saveAll($this->data['Vote'],array('validate'=>false));

	
	 $this->Session->setFlash(__("The poll has been edited.",true));
	 $this->redirect(array('action' => 'index'));
       }


      }
    }



}
?>
