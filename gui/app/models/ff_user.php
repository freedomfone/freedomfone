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
	
	var $hasMany = array('Poll'); 
        var $belongsTo = array('Group');
        var $actsAs = array('Acl' => array('type' => 'requester'));
 

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