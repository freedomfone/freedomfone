<?php
/****************************************************************************
 * sms_receiver.php	- Model for recivers of SMS batches.
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


class SmsReceiver extends AppModel{

      var $name = 'SmsReceiver';
      var $options = array();
      
      var $belongsTo = array(
      	  'Batch' => array(
 	  	 'className' => 'Batch',
 		 'foreignKey' => 'batch_id'
 		 ),
      	  'SmsGateway' => array(
 	  	 'className' => 'SmsGateway',
 		 'foreignKey' => 'sms_gateway_id'
 		 ),

		 );


}
?>
