<?php
/****************************************************************************
 * smsGateway.php	- Model for SMS gateways
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


class SmsGateway extends AppModel{

      var $name = 'SmsGateway';

/*      var $belongsTo = array('GatewayType' => array(
                        	       'order' => 'GatewayType.name ASC',
                        	       'dependent' => true)
				       ); 

*/

      var $hasOne	= array('Batch');



function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
        'name' => array(
		    'minLength'=> array(
				'rule'=>array('minLength', 5),
	    			'required' => true,
            			'message'=> __('A valid name of the SMS gateway is required (Min 5 characters).',true)
	    			),
	            'isUnique' =>array(
				'rule' => 'isUnique',
				'message' => __('The SMS gateway name must be unique.',true)
				 ),
			),
        'username' => array(
            'rule'      => array('minLength', 1),
	    'required' 	=> true,
            'message'	=> __('Please enter a username.',true)
	    ),
        'password' => array(
            'rule'      => array('minLength', 1),
	    'required' 	=> true,
            'message'	=> __('Please enter a password.',true)
	    ),
        'url' => array(
            'rule'      => array('minLength', 1),
	    'required' 	=> true,
            'message'	=> __('Please enter a URL to the SMS gateway.',true)
	    ),
        'api_key' => array(
            'rule'      => 'numeric',
	    'required' 	=> true,
            'message'	=> __('Please enter a API key. Valid  characters are	1-9.',true)
	    ),

	);
}


}


?>
