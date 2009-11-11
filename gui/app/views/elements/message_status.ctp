<?php

if(isSet($status)){

	if (!$status){ 

	       echo __("Archive",true);

	}
	
	elseif ($status ==1) { 

	       echo __("Active",true);

	}

}


if(isSet($rate)){

	if ($rate == 0){

	   echo __("N/A",true); 

	}

	else {

	  echo $rate;

	}


}

if (isSet($modified)){

	if (!$modified){

	   echo __("Never",true);

	}

	else { 

	     echo $time->niceShort($modified);
        } 



}
?>