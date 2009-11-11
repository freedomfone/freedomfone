<?php


App::import('Core', 'Socket');

class CallbackIn extends AppModel{

      var $name = 'CallbackIn';


/**
 * Check if the number of callbacks allowed (within a certain time limit) for a user has exceeded its maximum value or not
 * return true| false
 *
 */
	function withinLimit($sender){

		 $data = $this->query("select * from callback_settings where instance_id=100 limit 0,1");

		       if ($data[0]['callback_settings']['limit_time']==0 | $data[0]['callback_settings']['limit_user'] ==0 ){
	    	       	  return true;
			  }
		       else {

		       	$epoch_limit = time()-$data[0]['callback_settings']['limit_time']*3600;
			$user_limit  = $data[0]['callback_settings']['limit_user'];
			$response = $this->find('count', array('conditions' => array('CallbackIn.sender' => $sender,'CallbackIn.created >' => $epoch_limit,'CallbackIn.status' =>'1')));

		    		  if($response >= $user_limit){
		        	  	       return false;
		     			       }
		     			       else {
		     			       return true;
		     	             }
		   }

	}





	function dial($data){

	$settings = $this->query("select response_type from callback_settings where instance_id=100 limit 0,1");
	$ext  = $settings[0]['callback_settings']['response_type'];

        $defaults = array(
        'host' => '127.0.0.1',
        'port' => '9999',
        'timeout' => 30,
        'stream_timeout' => 5
        );

	$id = $data['id'];
	$proto = $data['proto'];
	$sender = $data['sender'];


	$msg = $id.",".$proto.','.$sender.','.$ext;

	debug($msg);
		 $this->Socket = new CakeSocket($defaults);	

		 $this->Socket->connect();
		 $this->Socket->write($msg);
		 $this->Socket->disconnect();
	}
}

?>
