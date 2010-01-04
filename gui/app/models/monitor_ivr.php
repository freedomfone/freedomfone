<?php


class MonitorIvr extends AppModel{

      var $name = 'MonitorIvr';
      
      var $belongsTo = array(
      	  'Cdr' => array(
 	  	 'className' => 'Cdr',
 		 'foreignKey' => 'cdr_id'
 		 ));
		 


}



?>
