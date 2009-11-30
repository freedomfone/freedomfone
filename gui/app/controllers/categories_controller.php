<?
class CategoriesController extends AppController {

    var $name = 'Categories';


	function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}


	function add() {
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
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data['Category'])) {

   			//Get message_id for records to be updated
   			$message_id = $this->data['Category']['Message'];
   

			foreach($message_id as $value){

	     			$this->data['Category']['Message']['id']=$value;
	     			$this->data['Category']['Message']['category_id']=$id;
	     			$this->Category->Message->save($this->data['Category']['Message']);

	  			}


				$this->Session->setFlash(__('The Category has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
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
    	     $this->Session->setFlash('The selected category has been deleted.','default',array('class'=>'message_success'));
	     $this->redirect(array('action' => '/index'));

	     }
     }

}
?>
