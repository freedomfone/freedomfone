<?php
/****************************************************************************
 * groups_controller.php	- Controller for Freedomfone groups
 * version 		 	- 3.0.1500
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

class GroupsController extends AppController{

      var $name = 'Groups';




      function index() {

                $this->set('title_for_layout', __('Freedom Fone Groups',true));
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());


	}

        /*
       function add() {

                $this->set('title_for_layout', __('Add Group',true));

		if (!empty($this->data)) {

  			if ($this->Group->save($this->data)) {
				$this->_flash(__('New group has been created.', true),'success');
				$this->redirect(array('action'=>'index'));
			} 
		}
      }*/


}

?>
