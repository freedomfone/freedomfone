<?php
/****************************************************************************
 * user.php		- Model for managing authentication of Freedom Fone users 
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

class FfUser extends AppModel {

	var $name = 'FfUser';
	
        var $belongsTo = array('Group');
        var $actsAs = array('Acl' => array('type' => 'requester'));
 

function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
	'username' => array(
			'alphaNumeric' => array(
                                       'required' => true,
                                       'empty' => false,
 				       'rule' => 'alphaNumeric',
 				       'message' => __('Letters and numbers only. No spaces or special characters allowed.',true)
 				       ),
 			'between' => array(
                                       'required' => true,
                                       'empty' => false,
 				       'rule' => array('between', 5, 20),
 				       'message' => __('Between 5 to 20 characters',true)
 				       ),
	                'isUnique' =>array(
                                       'required' => true,
                                       'empty' => false,
				       'rule' => 'isUnique',
				       'message' => __('This username is already in use.',true)
				     )
 		),
	'password' => array(
 			'between' => array(
                                       'required' => false,
                                       'empty' => false,
 				       'rule' => array('between', 5, 50),
 				       'message' => __('The password must be between 5 to 50 characters',true)
 				       ),
			'compareFieldValues' => array(
        			       'rule' => array('compareValues', 'pwd_repeat' ),
        			       'message' => __('The passwords do not match.',true)
                		       ),
 		),
	);
}


    function compareValues( $data, $field){

        if($data['password'] == $this->data['FfUser'][$field]){
                 return true;
        } else {
                 return false;
        }

    }


  function bindNode($ff_user) {
           return array('model' => 'Group', 'foreign_key' => $ff_user['FfUser']['group_id']);
  
  }


  function parentNode() {
    if (!$this->id && empty($this->data)) {
        return null;
    }
    if (isset($this->data['FfUser']['group_id'])) {
    $groupId = $this->data['FfUser']['group_id'];
    } else {
      $groupId = $this->field('group_id');
    }
    if (!$groupId) {
    return null;
    } else {
        return array('Group' => array('id' => $groupId));
    }
  }




}
?>