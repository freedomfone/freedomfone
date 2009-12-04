<?
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
				$this->Session->setFlash(__('The tag has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The tag could not be saved. Please, try again.', true));
			}
		}


	}


	function edit($id = null) {

      		$this->pageTitle = 'Leave-a-Message : Tags : Edit';

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The tag has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true));
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
    	     $this->Session->setFlash('The selected tag has been deleted.','default',array('class'=>'message_success'));
	     $this->redirect(array('action' => '/index'));

	     }
     }

}
?>
