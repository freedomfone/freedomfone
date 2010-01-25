<?
/****************************************************************************
 * categories_controller.php	- Controller for categories (used for messages)
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
class CategoriesController extends AppController {

    var $name = 'Categories';


	function index() {

      		$this->pageTitle = 'Leave-a-Message : Categories';
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}


	function add() {

      		$this->pageTitle = 'Leave-a-Message : Categories : Add';
		if (!empty($this->data)) {
		  
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The category has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
			}
		}

		else {

			$messages   = $this->Category->Message->find('list',array('conditions' => array('Message.status =' => '1')));
			$this->set(compact('messages'));


		}

	}


	function edit($id = null) {

      		$this->pageTitle = 'Leave-a-Message : Categories : Edit';

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data['Category'])) {


   			//Get message_id for records to be updated
   			$message_id = $this->data['Category']['Message'];

			if($message_id){

			   //Update selected messages
			   foreach($message_id as $value){

			   if($value){
				$this->data = $this->Category->Message->read(null,$value);
				$this->data['Message']['category_id']=$id;
     				$this->Category->Message->save($this->data['Message']);
				}
	  		   }
			}
				
		        //Update de-selected messages (set category_id=NULL)
			$this->data = $this->Category->Message->findAllByCategoryId($id);
			foreach($this->data as $message){
					
				$id = $message['Message']['id'];

				if(!in_array($id, $message_id) && $id){
					$this->Category->Message->id = $message['Message']['id'];
					$this->Category->Message->saveField('category_id',NULL);
				}
	
			}
			$this->Session->setFlash(__('The category has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		
			$messages   = $this->Category->Message->find('list',array('conditions' => array('Message.status =' => '1')));
			$this->set(compact('messages'));


		}

	}



    function delete ($id){

    	     if($this->Category->delete($id,true))
	     {
    	     $this->Session->setFlash(__('The selected category has been deleted.',true),'default',array('class'=>'message_success'));
	     $this->redirect(array('action' => '/index'));

	     }
     }

}
?>
