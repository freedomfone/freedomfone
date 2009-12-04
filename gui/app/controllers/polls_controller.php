<?php

class PollsController extends AppController{

      var $name = 'Polls';

      var $helpers = array('Time','Html', 'Session','Form','CssMenu','Formatting');

      var $total;



      function refresh(){

      $this->autoRender = false;

      $array = Configure::read('poll_in');

	      
	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {

    	       die(printf("Unable to authenticate\r\n"));
	       }


      	    while ($entry = $obj->getNext('update')){
	    

 
		$_message= explode(' ',$entry['Body']);
		$polls_code   =  trim($_message[0]);
		$votes_chtext =  trim($_message[1]);
		$matched      =  false;
	
		//if a poll entry with this code exists
		if ($poll_entry = $this->Poll->findByCode( $polls_code)){

	
 	   if($poll_entry['Poll']['status']==1){

				//get valid poll chtext
	   		foreach ($poll_entry['Vote'] as $key => $vote){
	
				if (strcasecmp($votes_chtext,$vote['chtext'])==0){

			   	   //update vote with one
		   	   	   $vote_id = $vote['id'];
		   	   	   $this->Poll->Vote->query("UPDATE votes SET chvotes=chvotes+1 WHERE id=$vote_id "); 
		   	   	   $matched=true;
		   	   	   $this->log("Msg: NEW VOTE; To: ".$polls_code."; Chtext: ".$votes_chtext."; From: ".$entry['sender']."; Timestamp: ".$entry['Event-Date-Timestamp'], "poll");
		   		 }
	 	         }

	 		 //Poll messages has not been matched. Add to trash.
	 		 if (!$matched){
				$this->log("Msg: INCORRECT CHTEXT; To: ".$polls_code."; Chtext: ".$votes_chtext." From: ".$entry['sender']."; Timestamp: ".$entry['Event-Date-Timestamp'],"poll");
	 	         }

			// $this->log($entry['sender']." ".$entry['Event-Date-Timestamp']." ".$entry['Body']." ".$polls_code." ".$vote['chtext']." SMS","poll");	
	          }		 

	   	  else {

	   	         $this->log("Msg: CLOSED POLL; To: ".$polls_code."; Chtext: ".$votes_chtext."; From: ".$entry['sender']."; Timestamp: ".$entry['Event-Date-Timestamp'] , "poll");
	          }
   
		}	

	   	else {

	   	         $this->log("Msg: INCORRECT POLL; To: ".$polls_code."; Chtext: ".$votes_chtext."; From: ".$entry['sender']."; Timestamp: ".$entry['Event-Date-Timestamp'] , "poll");
	        }

          }


	// Update status of polls (use beforeSave to update status)

	$data = $this->Poll->findAll();

	foreach ($data as $key => $entry){

		$this->Poll->save($entry);
	}

      }


      function index(){

      $this->pageTitle = 'Manage polls';
      $this->set('polls',$this->Poll->find('all',array('order'=>'Poll.created DESC')));

      }


     function view($id){

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
	 $this->Poll->Vote->saveAll($this->data['Vote']);

	
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
    	     $this->Session->setFlash('Poll with question "'.$title.'" has been deleted.','default',array('class'=>'message_success'));
	     $this->log('Msg: POLL DELETED; Id:title: '.$id.":".$title, 'poll');	
	     $this->redirect(array('action' => '/index'));


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

	
	//Validate data (poll and vote)
	if ($this->Poll->saveAll($this->data, array('validate' => 'only'))) {


	 //Save poll data
	  $this->Poll->save($this->data['Poll']);


	  //Get unique id for each vote,
   	  $vote_id = $this->Poll->Vote->find('all', array('conditions' => array('Poll.id' => $id), 'order' => array('Vote.id asc')));

	  //Set id for each vote, and save data
   	   foreach($this->data['Vote'] as $key => $vote){
	     $this->data['Vote'][$key]['id']=$vote_id[$key]['Vote']['id'];
	     }


	 //Save vote data
	 $this->Poll->Vote->saveAll($this->data['Vote']);

	
	 $this->Session->setFlash(__("Your poll has been created.",true));
	 $this->redirect(array('action' => 'index'));
        }
      }
    }



}
?>
