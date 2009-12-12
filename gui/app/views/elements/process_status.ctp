<?php

if(isSet($status,$mode)){

	if ($mode=='image'){


		if(!$status){
   		  echo $html->image("icons/off.png", array("alt" => __("OFF",true)));
		}

		elseif($status==1){
   		  echo $html->image("icons/on.png", array("alt" => __("ON",true)));
		}

		return $status;
	}

	elseif ($mode == 'text'){

		if (!$status){ 
	   	   echo __("OFF",true);
		   }
		elseif ($status ==1) { 
	       	   echo __("ON",true);
		   }

	}


}



?>