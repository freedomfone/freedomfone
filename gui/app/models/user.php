<?php
/****************************************************************************
 * user.php		- Model for managing users through the address book
 * version 		- 1.0.359
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

class User extends AppModel {

	var $name = 'User';
	
	var $belongsTo = array('Acl'); 

	var $hasMany = array('Message','Cdr','PhoneNumber');

	var $hasAndBelongsToMany = array('PhoneBook');

function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
	'email' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 50),
 				       'message' => __('Between 1 to 50 characters',true),
				       'allowEmpty' => true
 				       ),
	                'email' =>array(
				     'rule' => array('email',true),
				     'message' => __('Please supply a valid email address.',true),
				     'allowEmpty' => true
				     ),
      			'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => __('This email address is already in use.',true),
				     'allowEmpty' => true
				     ),

 		),
	'phone1' => array(
			'alphaNumeric' => array(
 				       'rule' => 'phoneFormat',
 				       'message' => __('Please sypply a valid phone number (numbers and plus (+) signed allowed).',true),
		   		       'allowEmpty' => true
 				       ),
 		),
	'skype' => array(
 				       'rule' => 'skypeFormat',
 				       'message' => __('Please supply a valid skype name.',true),
		   		       'allowEmpty' => true
 				       ),
	);
	}



function skypeFormat($check) {

  //Start with letter. 6-32 characters long. Allow {0-9,A-Z_.-}

  $value = array_values($check);
  $value = $value[0];
  return preg_match('/^[a-zA-Z]{1,1}[0-9a-zA-Z.-_\\,]{5,31}$/', $value);
  
  }


function phoneFormat($check) {
 
  //May start with a plus sign. Then 4-25 digits
  $value = array_values($check);
  $value = $value[0];

  return preg_match('/^[+]{0,1}[0-9]{4,25}$/', $value);
  
  }


}
?>