<?
/****************************************************************************
 * tag.php		- Model for Leave-a-message tags. One Leave-a-message entry can have one of more tags.
 * version 		- 1.0.353
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

class Tag extends AppModel {

    var $name = 'Tag';

    var $hasAndBelongsToMany = array('Message');

      var $validate = array(
	'name' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 30),
 				       'message' => 'Between 1 to 30 characters'
 				       ),
	                'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => 'This description is already in use.'
				     )
 		),
	'longname' => array(
 			'between' => array(
 				       'rule' => array('between', 1, 50),
 				       'message' => 'Between 1 to 50 characters'
 				       )
 		));

}
?>
