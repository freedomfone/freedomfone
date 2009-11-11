<?php

if(isSet($status,$mode)){

	if ($mode=='image'){


		if(!$status){
   		  echo $html->image("icons/clock.png", array("alt" => __("Pending",true)));
		}

		elseif($status==1){
   		  echo $html->image("icons/lock_unlock.png", array("alt" => __("Open",true)));
		}

		elseif($status==2){
   		  echo $html->image("icons/lock.png", array("alt" => __("Closed",true)));
		}

		return $status;
	}

	elseif ($mode == 'text'){

		if (!$status){ 
	   	   echo __("Pending",true);
		   }
		elseif ($status ==1) { 
	       	   echo __("Open",true);
		   }
		elseif ($status ==2) { 
	       	   echo __("Closed",true);
		   }
	}


}



?>