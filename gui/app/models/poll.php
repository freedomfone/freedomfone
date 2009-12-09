<?php


class Poll extends AppModel{

      var $name = 'Poll';



	var $hasMany = array('Vote' => array(
                        	       'order' => 'Vote.id ASC',
                        	       'dependent' => true)
				       ); 

      var $validate = array(
        'question' => array(
            'rule'=>array('minLength', 10),
	    'required' => true,
            'message'=>'A valid question is required.' ),
	'code' => array(
			'alphaNumeric' => array(
 				       'rule' => 'alphaNumeric',
 				       'message' => 'Alphabets and numbers only'
 				       ),
 			'between' => array(
 				       'rule' => array('between', 1, 10),
 				       'message' => 'Between 1 to 10 characters'
 				       ),
	                'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => 'This SMS code is already in use.'
				     )
 		),
	'end_time' => array(
			'compareFieldValues' => array(
        				       'rule' => array('compareFieldValues', 'start_time' ),
        				       'message' => 'The end time must be later than the start time.'
                )
            ) 
	);




 function compareFieldValues( $data, $field) 
    {
        foreach( $data as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][ $field ];                 
            if($v2 > $v1) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }


   function futureDate($data, $field){

                if (strtotime($data[$field]) < time()){
                        return FALSE;
                }
                return TRUE;
    } 

    function getTitle($id){

    $data = $this->findById($id);
    return $data['Poll']['question'];     
    }


//
//
// Calculates and sets the status of the poll before saving data.
//
//

    function beforeSave(){

	$start = strtotime($this->data['Poll']['start_time']);
	$end   = strtotime($this->data['Poll']['end_time']);
	$now = time();


      	if ($start < $now && $end < $now ){ 
      	 $this->data['Poll']['status']=2;
	 }

      	elseif ($start > $now ){ 
      	 $this->data['Poll']['status']=0;
	 }

	 else {
      	 $this->data['Poll']['status']=1;
	 }


    	 return true;

    }

//////////


	function refresh(){

      $array = Configure::read('poll_in');

      $instance_id = IID;
	      
	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {

    	       	  die(printf("Unable to authenticate\r\n"));
	       }

      	    while ($entry = $obj->getNext('update')){

	        $body 	        =  $entry['Body']; 
		$_message	=  explode(' ',$body);
		$polls_code   	=  trim($_message[0]);
		$votes_chtext 	=  trim($_message[1]);
		$sender		=  $entry['sender'];
	        $created = floor($entry['Event-Date-Timestamp']/1000000);
		$matched      	=  false;

		// CHECK A: CODE OK (VALID OR INCORRECT)
		if ($poll_entry = $this->findByCode( $polls_code)){
		   
			$poll_id = $poll_entry['Poll']['id'];
			$status = $poll_entry['Poll']['status'];

			//Fetch valid chtext for identified poll
	   		foreach ($poll_entry['Vote'] as $key => $vote){
	
				//Search for matching chtext
				if (strcasecmp($votes_chtext,$vote['chtext'])==0){
		   	   		$matched=true;
		   		 }
	 	         }		 

			        //CHECK A1: OPTION CORRECT (correct code, correct chtext)

				if ($matched){

		   	   	  $vote_id = $vote['id'];
			
				  switch($status){

				   case 0:
				   //ADD TO TRASH (pending)
				   $mode="VALID VOTE, PENDING";
				   $result = $this->query("insert into bin (instance_id,body,sender,created,mode)values ($instance_id,'$body','$sender','$created','$mode')");
				   break;

				   case 1:
				   //ADD TO STATS (open)
		   	   	   $this->Vote->query("UPDATE votes SET chvotes=chvotes+1 WHERE id=$vote_id "); 
				   $mode="VALID VOTE, OPEN";
				   break;


				   case 2:
				   //ADD TO STATS (closed)
				   $mode="VALID VOTE, CLOSED";
		   	   	   debug($this->Vote->query("UPDATE votes SET votes_closed=votes_closed+1 WHERE id=$vote_id ")); 
				   break;

				   }

				} else {

				//CHECK A2: OPTION INCORRECT (correct code, invalid chtext)
				   switch($status){

				   case 0:
				   //ADD TO TRASH (pending)
				   $mode="INCORRECT VOTE, PENDING";
				   $result = $this->query("insert into bin (instance_id,body,sender,created,mode)values ($instance_id,'$body','$sender','$created','$mode')");
				   break;

				   case 1:
				   //ADD TO STATS (open)
				   $mode="INCORRECT VOTE, OPEN";
				   $this->query("UPDATE polls SET incorrect_open=incorrect_open+1 WHERE id=$poll_id ");
				   break;


				   case 2:
				   //ADD TO STATS (closed)
				   $mode="INCORRECT VOTE, CLOSED";
				   $this->query("UPDATE polls SET incorrect_closed=incorrect_closed+1 WHERE id=$poll_id");
				   break;

				   }

	 	         	}

		} else {
		// CHECK B: CODE NOT OK (INVALID)

			
			 //ADD TO TRASH
	   		 $mode="INVALID VOTE";
			 $result = $this->query("insert into bin (instance_id,body,sender,created,mode)values ($instance_id,'$body','$sender','$created','$mode')");
	        }

	$this->log("Message: ".$mode."; Body: ".$body."; From: ".$sender."; Timestamp: ".$created, "poll"); 

	}


	// Update status of polls (use beforeSave to update status)
	$data = $this->findAll();
	foreach ($data as $key => $entry){
		$this->save($entry);
	}


   }

}



?>