<?php
/****************************************************************************
 * poll_status.ctp	- Show Pending/Open/Closed icons depending on given status
 * version 		- 1.0.362
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