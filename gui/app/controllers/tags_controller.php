<?php
/****************************************************************************
 * tags_controller.php		- Controller for tages (used for classification of Leave-a-message messages).
 * version 		 	- 1.0.368
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

class TagsController extends AppController {

    var $name = 'Tags';

    var $scaffold;


	function index() {

      		$this->pageTitle = 'Leave-a-Message : Tags';
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());



	}


	function add() {

      		$this->pageTitle = 'Leave-a-Message : Tags : Add';

		if (!empty($this->data)) {
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->_flash(__('The tag has been saved', true),'success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->_flash(__('The tag could not be saved. Please, try again.', true),'error');
			}
		}


	}


	function edit($id = null) {

      		$this->pageTitle = 'Leave-a-Message : Tags : Edit';

		if (!$id && empty($this->data)) {
			$this->_flash(__('Invalid Tag', true),'warning');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->_flash(__('The tag has been edited.', true),'success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->_flash(__('The tag could not be saved. Please, try again.', true),'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null, $id);

			$messages   = $this->Tag->Message->find('list',array('conditions' => array('Message.status =' => '1')));
			$this->set(compact('messages'));
		}

	}



    function delete ($id){

    	     if($this->Tag->delete($id,true))
	     {
    	     $this->_flash(__('The selected tag has been deleted.',true),'success');
	     $this->redirect(array('action' => '/index'));

	     }
     }

}
?>
