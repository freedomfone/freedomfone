<?php
/****************************************************************************
 * barch_status.ctp	- Show Status messages for sent SMS
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

if(isSet($status_code,$gateway_code)){

	$msg = false;

	if ($gateway_code=='CT'){

      	        $ct_status_messages  = Configure::read('CT_STATUS_MESSAGES');

		if(!$status_code){
		   $msg = __('No status code available',true);
		}

		else {
		  $status = $ct_status_messages[$status_code];

		  $msg = $status[0];
		}

	} elseif ($gateway_code == 'OR'){

		  $msg = $status_code;

	}

		echo $msg;
} 



?>