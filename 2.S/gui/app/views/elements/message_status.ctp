<?php
/****************************************************************************
 * message_status.ctp	- Shows status (Active/Archive), Rate and Modified for Leave-a-message messages
 * version 		- 3.0.1500
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
***************************************************************************/

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

if(isSet($quickHangup)){

	if ($quickHangup == 'true'){

	   echo __("Yes",true); 

	}

	else {

	   echo __("No",true); 


	}

}

?>