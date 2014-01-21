<?
/****************************************************************************
 * PhoneBook.php	- Model for Phone book. One user can belong to one or more phone books. One phone book contains one or more contacts.
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

class PhoneBook extends AppModel {

    var $name = 'PhoneBook';

    var $hasAndBelongsToMany = array('Caller');

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

	$this->validate = array(
	'name' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 30),
 				       'message' => __('Between 1 to 30 characters',true)
 				       ),
	                'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => __('This name is already in use.',true)
				     )
 		),
	'description' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 50),
 				       'message' => __('Please enter a valid description using 1 to 50 characters',true)
 				       )
 		));

		}
}
?>
