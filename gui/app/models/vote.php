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
	 	        'between' => array(
			   'rule'=>array('between', 1,10),
            	  	   'message'=>'Between 1 to 10 characters.'
			   ),
			'alphaNumeric' => array(
		       	   'rule' => 'alphaNumeric',
 		           'message' => 'Letters and numbers only. No spaces allowed.'
 		           )));

			   

}



?>
