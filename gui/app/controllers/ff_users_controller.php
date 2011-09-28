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


       function beforeFilter(){
                 parent::beforeFilter();
                 $this->Auth->allow('logout');

        }



      function login(){

        $this->set('title_for_layout', __('Login',true));

         if ($this->Session->read('Auth.FfUser')) {
            $this->_flash('You are logged in!');
            $this->redirect('/', null, false);
         }
  
      }       


      

      function logout(){


               $this->_flash('You are logged out.','success');
               $this->redirect($this->Auth->logout());


      }


	function index() {

                $this->set('title_for_layout', __('Freedomfone Users',true));

                $this->loadModel('Group');
                $options = $this->Group->find('list');
                $this->set(compact('options'));

		$this->FfUser->recursive = 0;
		$this->set('ff_users', $this->paginate());


	}

	function add() {

               $this->set('title_for_layout', __('Add User',true));
               $this->loadModel('Group');
               $options = $this->Group->find('list');
               $this->set(compact('options'));


		if (!empty($this->data)) {

                    //Set password to non-hashed for validation
                    $this->data['FfUser']['password'] = $this->data['FfUser']['pwd']; 
                    $this->FfUser->set($this->data);

  		    if ($this->FfUser->save($this->data)) {


                         //If data is saved/validated, update password field with hashed version	               
                         $this->FfUser->id = $this->FfUser->getLastInsertId();
                         $this->FfUser->saveField('password', $this->Auth->password($this->data['FfUser']['pwd']));

			 $this->_flash(__('New user has been created.', true),'success');
			 $this->redirect(array('action'=>'index'));

		    } else {

                         $errors = $this->FfUser->invalidFields(); 
			 $this->_flash($errors['password'],'error');

                    }


 
		}
               
	}

	function edit($id = null) {

                $this->set('title_for_layout', __('Edit User',true));

		if (!$id && empty($this->data)) {
			$this->_flash(__('Invalid option', true),'warning');
			$this->redirect(array('action'=>'index'));
		}


		if (!empty($this->data)) {


                    //Set password to non-hashed for validation
                    $this->data['FfUser']['password'] = $this->data['FfUser']['pwd']; 

                    //If password is left blank, do not validate
                    if(!$this->data['FfUser']['pwd']){
                      unset($this->data['FfUser']['password']);

                    }

                    $this->FfUser->set($this->data);

  		    if ($this->FfUser->save($this->data)) {

                         //If data is saved/validated, update password field with hashed version	               
                         $this->FfUser->id = $id;

                         $this->FfUser->saveField('password', $this->Auth->password($this->data['FfUser']['pwd']));




			 $this->_flash(__('User has been updated.', true),'success');
			 $this->redirect(array('action'=>'index'));

		    } else {

                         $errors = $this->FfUser->invalidFields(); 
			 $this->_flash($errors['password'], 'error');

                    }


 
		}


                   $this->loadModel('Group');
                   $groups =  $this->Group->find('list');
                   $this->set(compact('groups'));
	           $this->data = $this->FfUser->read(null, $id);



	}


       function delete ($id){

         if($id != 1 ){
    	     if($this->FfUser->delete($id,true)) {
    	         $this->_flash(__('The user been deleted.',true),'success');
	         $this->redirect(array('action' => '/index'));
	     }
         } else {
                $this->_flash(__('You can not delete the Admin user.',true),'success');
	        $this->redirect(array('action' => '/index'));
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

    //Polls
    $this->Acl->deny($group, 'controllers/Polls');
    $this->Acl->allow($group, 'controllers/Polls/index');
    $this->Acl->allow($group, 'controllers/Polls/view');


    //Leave a message
    $this->Acl->deny($group, 'controllers/Messages');
    $this->Acl->allow($group, 'controllers/Messages/index');
    $this->Acl->allow($group, 'controllers/Messages/disp');
    $this->Acl->allow($group, 'controllers/Messages/archive');
    $this->Acl->allow($group, 'controllers/Messages/edit');
    $this->Acl->allow($group, 'controllers/Messages/view');


    //Categories
    $this->Acl->deny($group, 'controllers/Categories');
    $this->Acl->allow($group, 'controllers/Categories/index');

    //Tags
    $this->Acl->deny($group, 'controllers/Tags');
    $this->Acl->allow($group, 'controllers/Tags/index');


    //Leave-a-message
    $this->Acl->deny($group, 'controllers/LmMenus');
    $this->Acl->allow($group, 'controllers/LmMenus/index');

    //Incoming SMS
    $this->Acl->deny($group, 'controllers/Bin');
    $this->Acl->allow($group, 'controllers/Bin/index');

    //Language Selectors and Voice menus
    $this->Acl->deny($group, 'controllers/IvrMenus');
    $this->Acl->allow($group, 'controllers/IvrMenus/index');
    $this->Acl->allow($group, 'controllers/IvrMenus/selectors');

    //Content
    $this->Acl->deny($group, 'controllers/Nodes');
    $this->Acl->allow($group, 'controllers/Nodes/index');

    //Users
    $this->Acl->deny($group, 'controllers/Users');
    $this->Acl->allow($group, 'controllers/Users/index');
    $this->Acl->allow($group, 'controllers/Users/view');

    //Phone books
    $this->Acl->deny($group, 'controllers/PhoneBooks');
    $this->Acl->allow($group, 'controllers/PhoneBooks/index');

    //System data (CDR)
    $this->Acl->deny($group, 'controllers/Cdr');
    $this->Acl->allow($group, 'controllers/Cdr/index');
    $this->Acl->allow($group, 'controllers/Cdr/statistics');
    $this->Acl->allow($group, 'controllers/Cdr/general');
    $this->Acl->allow($group, 'controllers/Cdr/overview');


    //Monitor IVR
    $this->Acl->deny($group, 'controllers/MonitorIvr');
    $this->Acl->allow($group, 'controllers/MonitorIvr/index');

    
    //Dashboard
    $this->Acl->deny($group, 'controllers/Processes');
    $this->Acl->allow($group, 'controllers/Processes/index');
    $this->Acl->allow($group, 'controllers/Processes/refresh');
    $this->Acl->allow($group, 'controllers/Processes/system');
    
    //Settings
    $this->Acl->deny($group, 'controllers/Settings');
    $this->Acl->allow($group, 'controllers/Settings/index');

    //GSM channels
    $this->Acl->deny($group, 'controllers/Channels');
    $this->Acl->allow($group, 'controllers/Channels/index');
    $this->Acl->allow($group, 'controllers/Channels/refresh');
    $this->Acl->deny($group, 'controllers/OfficeRoute');
    $this->Acl->allow($group, 'controllers/OfficeRoute/refresh');

    //Logs
    $this->Acl->deny($group, 'controllers/Logs');

    //Authentication
    $this->Acl->deny($group, 'controllers/FfUsers');
    $this->Acl->deny($group, 'controllers/Groups');


    echo "all done";
    exit;
}


 }

?>