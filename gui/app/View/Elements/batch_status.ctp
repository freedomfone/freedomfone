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

$config['CT_STATUS_MESSAGES'] = array(
			      '001'=> array(__('Message unknown'), __('The message ID is incorrect or reporting is delayed.')),
			      '002'=> array(__('Message queued'), __('The message could not be delivered and has been queued for attempted redelivery.')), 
			      '003'=> array(__('Delivered to gateway'), __('Delivered to the upstream gateway or network (delivered to the recipient)')),
			      '004'=> array(__('Received by recipient'), __('Confirmation of receipt on the handset of the recipient')),
			      '005'=> array(__('Error with message'), __('There was an error with the message, probably caused by the content of the message itself')),
			      '006'=> array(__('User cancelled message delivery'), __('The message was terminated by a user (stop message command) or by our staff')),
			      '007'=> array(__('Error delivering message'), __('An error occurred delivering the message to the handset')),
			      '008'=> array(__('OK'), __('Message received by gateway')),
			      '009'=> array(__('Routing error'), __('An error occurred while attempting to route the message.')),
			      '010'=> array(__('Message expired'), __('Message has expired before we were able to deliver it to the upstream gateway. No charge applies.')),
			      '011'=> array(__('Message queued for later delivery'), __('Message has been queued at the gateway for delivery at a later time (delayed delivery).')),
			      '012'=> array(__('Out of credit'), __('The message cannot be delivered due to a lack of funds in your account. Please re-purchase credits.')),
			      '014'=> array(__('Maximum MT limit exceeded'), __('The allowable amount for MT messaging has been exceeded.'))
			      );


if(isSet($status_code,$gateway_code)){

	$msg = false;

	if ($gateway_code=='CT'){

      	        $ct_status_messages  = $config['CT_STATUS_MESSAGES'];


		if(!$status_code){
		   $msg = __('No status code available',true);
		}

		else {
		  $status = $ct_status_messages[$status_code];

		  $msg = $status[0];
		}

	} elseif ($gateway_code == 'OR'){

		  $msg = $status_code;


	} elseif ($gateway_code == 'GM'){

	          if(!$status_code){
		     $msg = __('Gammu is not running', false);
		  } elseif($status_code =='SendingOKNoReport'){
		      $msg = __('Sending OK', false);
		  } elseif($status_code =='SendingError'){
		      $msg = __('Sending failed', false);
		  }  else {
		     $msg = $status_code;
		  }
	}

		echo $msg;
}



?>