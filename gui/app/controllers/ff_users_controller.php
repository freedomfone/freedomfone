<?php
/****************************************************************************
 * ff_users_controller.php	- Controller for Freedomfone users 
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

class FfUsersController extends AppController{

      var $name = 'FfUsers';

/*

      function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array('*'));
      }
*/


/*
       function beforeFilter(){
                 parent::beforeFilter();

        }

*/

      function login(){

        $this->set('title_for_layout', __('Login',true));

         if ($this->Session->read('Auth.FfUser')) {
            $this->Session->setFlash('You are logged in!');
            $this->redirect('/', null, false);
         }
  
      }       


      

      function logout(){

               $this->Session->setFlash('You are logged out.');
               $this->redirect($this->Auth->logout());


      }


	function index() {

                $this->set('title_for_layout', __('Freedomfone Users',true));
		$this->FfUser->recursive = 0;
		$this->set('ff_users', $this->paginate());


	}

	function add() {

               $this->set('title_for_layout', __('Add User',true));
               $this->loadModel('Group');
               $options = $this->Group->find('list');
               $this->set(compact('options'));


		if (!empty($this->data)) {

  			if ($this->FfUser->save($this->data)) {
				$this->_flash(__('New user has been created.', true),'success');
				$this->redirect(array('action'=>'index'));
			} 
		}
                



	}

   //Set Auth permissions:: REMOVE WHEN DONE!

   function initDB() {
    $group =& $this->FfUser->Group;

    //Allow admins to everything
    $group->id = 1;     
    $this->Acl->allow($group, 'controllers');
 
    //allow users to read but not write
    $group->id = 2;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/Polls');
    $this->Acl->allow($group, 'controllers/Cdr');

    echo "all done";
    exit;
}


 }

?>