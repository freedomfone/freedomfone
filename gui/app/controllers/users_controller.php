<?php
/****************************************************************************
 * users_controller.php		- Controller for Users (phone book)
 * version 		 	- 1.0.408
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

class UsersController extends AppController{

      var $name = 'Users';

      var $helpers = array('Flash','Formatting','Session','Text');      

      var  $paginate = array('page' => 1, 'order' => array( 'User.name' => 'desc')); 


      function refresh(){

      $this->redirect(array('action' =>'/'));

      }

      function index(){

      $this->pageTitle = 'Contact : Inbox';
   

        if(isset($this->params['form']['submit'])) {
	   if ($this->params['form']['submit']==__('Refresh',true)){
                   $this->requestAction('/users/refresh');
                   }
       }


      if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('users_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		}
	elseif($this->Session->check('users_sort')) { 
		   $this->paginate['order'] = $this->Session->read('users_sort');

	} 

      if(isset($this->params['named']['limit'])) { 

	$this->Session->write('users_limit',$this->params['named']['limit']);
	}
	elseif($this->Session->check('users_limit')) { 
	$this->paginate['limit'] = $this->Session->read('users_limit');
	}	

	
         $this->User->recursive = 0; 
	 $data = $this->paginate('User');

	 $this->set('users',$data);  
	     }




    function edit($id = null)    {  


    	     $this->pageTitle = 'Contact : Edit';   

	     //No id specified
	     if(!$id){
		     $this->redirect(array('action' =>'/'));
		     }

             //Fetch data from db     
    	     elseif(empty($this->data['User'])){

		$this->referer();
		$this->User->id = $id;
		$this->data = $this->User->read();
		$this->set('data',$this->User->read());       

		//$tags 	    = $this->User->Tag->find('list');
		$acls 	    	    = $this->User->Acl->find('list');
 		$phonebook 	    = $this->User->PhoneBook->find('list');

 		$countries 	    = $this->User->Country->find('list',array('fields' => array('Country.id','Country.name_en')));
 		$this->set(compact('acls','phonebook','countries'));
		}

		//Save form data
		else {

		     if($this->User->save($this->data)){
				 $this->Session->setFlash('The entry has been updated');
    	     		 	 $this->redirect(array('action' => '/'));
			 }

		}
    }



    function delete ($id){

    	     if($this->User->del($id)) {
	     $this->Session->setFlash(__('Selected user has been deleted.',true));
	     }
             $this->redirect(array('action' => 'index'));
    }



    function add() {

    	$this->pageTitle = 'Contacts : Add';
		$acls 	    	    = $this->User->Acl->find('list');
 		$countries 	    = $this->User->Country->find('list',array('fields' => array('Country.id','Country.name_en')));
 		$this->set(compact('acls','countries'));

          //Fetch form data and save
		if (!empty($this->data)) {

		   	$this->User->set( $this->data );

//			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('New contact has been added', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be added. Please, try again.', true));
			}
		} else {

		//Show empty form
      	 	$this->render();
		}


	}



}

?>
