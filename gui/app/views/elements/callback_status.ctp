<?php

if(isSet($status)){

		if(!$status){
   		  echo $html->image("icons/reject.png", array("alt" => __("Rejected",true)));
		}

		elseif($status==1){
   		  echo $html->image("icons/accept.png", array("alt" => __("Accepted",true)));
		}

		return $status;
	}




?>