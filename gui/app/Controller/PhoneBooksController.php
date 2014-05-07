<?php
/****************************************************************************
 * PhoneBooksController.php	- Controller for phone books (used for classification of Callers)
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

class PhoneBooksController extends AppController {

    var $name = 'PhoneBooks';

      var $scaffold;
      var $helpers = array('Csv','Session');
      var $paginate = array('limit' => 10, 'page' => 1, 'order' => array( 'PhoneBook.name' => 'asc'));


	function index() {

                $this->set('title_for_layout', __('Phone books',true));
		$this->PhoneBook->recursive = 0;
		$this->set('data', $this->paginate('PhoneBook'));


	}


	function add() {

                $this->set('title_for_layout', __('Add Phone book',true));


		//Form data exists
		if (!empty($this->request->data['PhoneBook'])) {
			$this->PhoneBook->create();
			if ($this->PhoneBook->save($this->request->data['PhoneBook'])) {
				$this->Session->setFlash(__('The phone book has been created.', true),'success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The phone book could not be saved. Please, try again.', true),'error');
			}
		}
	}


	function edit($id = null) {

                $this->set('title_for_layout', __('Edit Phone book',true));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {

			if ($this->PhoneBook->saveAll($this->request->data)) {

				$this->Session->setFlash(__('The phone book has been updated.', true),'success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The data could not be saved. Please, try again.', true),'error');
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->PhoneBook->read(null, $id);

			$callers   = $this->PhoneBook->Caller->find('list');


			$this->set(compact('callers'));
		}

	}



    function delete ($id){

    	     if($this->PhoneBook->delete($id,true)) {

    	     $this->Session->setFlash(__('The selected phone book has been deleted.',true),'success');
	     $this->redirect(array('action' => 'index'));

	     }
     }



    function export($id){

    	     Configure::write('debug', 0);

             $data = $this->PhoneBook->findById($id); 
             $this->set('phonebook_name', $data['PhoneBook']['name']);
             $id_keys = array();

             foreach ($data['Caller'] as $key => $caller){
             
                $id_keys[] = $caller['id'];

             }

             $this->loadModel('Caller');
             $this->Caller->unbindModel(
                array('hasMany' => array('Message','Cdr'))
                );

             $this->Caller->unbindModel(
                array('hasAndBelongsToMany' => array('PhoneBook'))
                );

  	     $data = $this->Caller->findAllById($id_keys); 
    	     $this->set('data', $data); 

    	     $this->layout = null;
    	     $this->autoLayout = false;
    	     $this->render();    
    }



}
?>
