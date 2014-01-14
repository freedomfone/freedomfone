<?
/****************************************************************************
 * phone_number.php	- Model for phone number. A user can have one or more phone numbers
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

class PhoneNumber extends AppModel {

    var $name = 'PhoneNumber';

    var $belongsTo = array('User');


 function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
	              'number' => array(
            	                'isUnique' => array(
				       'rule'       => 'isUnique',
				       'message'    => __('This phone number is already in use',true),
                                       'allowEmpty' => false
				      ),
                               'format' => array(
 				       'rule'       => 'phoneFormat',
 				       'message'    => __('Invalid phone number format (numbers and plus (+) sign are allowed).',true),
		   		       'allowEmpty' => false
 				       )
                             ));
	
  }

  function phoneFormat($check) {

           //May start with a plus sign. Then 4-20 digits
           $value = array_values($check);
           $value = trim($value[0]);
           return preg_match('/^[+]{0,1}[0-9]{4,20}$/', $value);

  }


}
?>
