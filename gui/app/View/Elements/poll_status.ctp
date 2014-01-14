<?php
/****************************************************************************
 * poll_status.ctp	- Show Pending/Open/Closed icons depending on given status
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

if(isSet($status,$mode)){

	if ($mode=='image'){


		if(!$status){
   		  echo $this->Html->image("icons/clock.png", array("title" => __("Pending",true)));
		}

		elseif($status==1){
   		  echo $this->Html->image("icons/lock_unlock.png", array("title" => __("Open",true)));
		}

		elseif($status==2){
   		  echo $this->Html->image("icons/lock.png", array("title" => __("Closed",true)));
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