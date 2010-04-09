<?php
/****************************************************************************
 * phone_books_controller.php	- Controller for phone books (used for classification of Users)
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

class PhoneBooksController extends AppController {

    var $name = 'PhoneBooks';

    var $scaffold;


      var $helpers = array('Csv');
	function index() {

      		$this->pageTitle = 'Phone books';
		$this->PhoneBook->recursive = 0;
		$this->set('data', $this->paginate());



	}


	function add() {

      		$this->pageTitle = 'Phone book : Add';

		if (!empty($this->data)) {
			$this->PhoneBook->create();
			if ($this->PhoneBook->save($this->data)) {
				$this->Session->setFlash(__('The phone book has been created', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The phone book could not be saved. Please, try again.', true));
			}
		}
	}


	function edit($id = null) {

      		$this->pageTitle = 'Phone book : Manage';

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->PhoneBook->save($this->data)) {
				$this->Session->setFlash(__('The phone book has been updated.', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The data could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PhoneBook->read(null, $id);


			$users   = $this->PhoneBook->User->find('list');

			$this->set(compact('users'));
		}

	}



    function delete ($id){

    	     if($this->PhoneBook->delete($id,true))
	     {
    	     $this->Session->setFlash(__('The selected phone book has been deleted.',true),'default',array('class'=>'message_success'));
	     $this->redirect(array('action' => '/index'));

	     }
     }



    function export($id){

    	     Configure::write('debug', 0);
	     //$acl = $this->PhoneBook->User->Acl->findAll(); 


//	 debug($this->PhoneBook->User->find('all',array('conditions' =>)));

    	     $this->set('data', $this->PhoneBook->findById($id)); 

    	     $this->layout = null;
    	     $this->autoLayout = false;
    	     $this->render();    
    }


}
?>
