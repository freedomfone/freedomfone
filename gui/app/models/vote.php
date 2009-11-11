<?php


class Vote extends AppModel{

      var $name = 'Vote';

      var $belongsTo = array(
      	  'Poll' => array(
 	  	 'className' => 'Poll',
 		 'foreignKey' => 'poll_id'
 		 ));
		 

      var $validate = array(
         'chtext'      => array(
	 	        'minLength' => array(
			   'rule'=>array('minLength', 1),
            	  	   'message'=>'A valid answer for the poll is required'
			   ),
			'alphaNumeric' => array(
		       	   'rule' => 'alphaNumeric',
 		           'message' => 'Letters and numbers only. No spaces allowed.'
 		           )));

			   

}



?>