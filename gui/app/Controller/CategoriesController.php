<?
/****************************************************************************
 * categories_controller.php	- Controller for categories (used for messages)
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
class CategoriesController extends AppController {

    var $name = 'Categories';


	function index() {

        
                $this->set('title_for_layout', __('Categories',true));
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}


	function add() {

                $this->set('title_for_layout', __('Add category',true));

		if (!empty($this->request->data)) {
		  
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved', true),'success');
				$this->redirect(array('action'=>'index'));
			} 
		}

		else {

			$messages   = $this->Category->Message->find('list',array('conditions' => array('Message.status =' => '1')));
			$this->set(compact('messages'));


		}

	}


	function edit($id = null) {


                $this->set('title_for_layout', __('Edit category',true));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Category', true),'warning');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Category->save($this->request->data['Category'])) {


   			//Get message_id for records to be updated
   			$message_id = $this->request->data['Category']['Message'];

			if($message_id){

			   //Update selected messages
			   foreach($message_id as $value){

			   if($value){
				$this->request->data = $this->Category->Message->read(null,$value);
				$this->request->data['Message']['category_id']=$id;
     				$this->Category->Message->save($this->request->data['Message']);
				}
	  		   }
			}
				
		        //Update de-selected messages (set category_id=NULL)
			$this->request->data = $this->Category->Message->findAllByCategoryId($id);
			foreach($this->request->data as $message){
					
				$id = $message['Message']['id'];

				if(!in_array($id, $message_id) && $id){
					$this->Category->Message->id = $message['Message']['id'];
					$this->Category->Message->saveField('category_id',NULL);
				}
	
			}
			$this->Session->setFlash(__('The category has been saved', true),'success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.', true),'error');
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Category->read(null, $id);
		
			$messages   = $this->Category->Message->find('list',array('conditions' => array('Message.status =' => '1')));
			$this->set(compact('messages'));


		}

	}



    function delete ($id){

    	     if($this->Category->delete($id,true))
	     {
    	     $this->Session->setFlash(__('The category has been deleted.',true),'success');
	     $this->redirect(array('action' => '/index'));

	     }
     }

}
?>
