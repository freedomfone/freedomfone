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
//            parent::beforeFilter();
//            $this->Auth->allow(array('*'));
//           $this->Auth->allow(array('logout'));

      }

*/


       function beforeFilter(){
                 parent::beforeFilter();
                 $this->Auth->allow('logout');

        }



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
    $this->Acl->allow($group, 'controllers/ivrMenus/index');

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

    //DIALER COMPONENT DISABLED FOR 3.0 //
    /*
    //Campaigns
    $this->Acl->deny($group, 'controllers/Campaigns');
    $this->Acl->allow($group, 'controllers/Campaigns/index');

    //Callback services
    $this->Acl->deny($group, 'controllers/CallbackServices');
    $this->Acl->allow($group, 'controllers/CallbackServices/index');

    //Callbacks
    $this->Acl->deny($group, 'controllers/Callbacks');
    $this->Acl->allow($group, 'controllers/Callbacks/index');

    //Callback settings
    $this->Acl->deny($group, 'controllers/CallbackSettings');
    $this->Acl->allow($group, 'controllers/CallbackSettings/index');

    */

    //System data (CDR)
    $this->Acl->deny($group, 'controllers/Cdr');
    $this->Acl->allow($group, 'controllers/Cdr/index');
    $this->Acl->allow($group, 'controllers/Cdr/statistics');
    $this->Acl->allow($group, 'controllers/Cdr/general');
    $this->Acl->allow($group, 'controllers/Cdr/overview');
    
    //Dashboard
    $this->Acl->deny($group, 'controllers/Processes');
    $this->Acl->allow($group, 'controllers/Processes/index');
    
    //Settings
    $this->Acl->deny($group, 'controllers/Settings');
    $this->Acl->allow($group, 'controllers/Settings/index');

    //GSM channels
    $this->Acl->deny($group, 'controllers/Channels');
    $this->Acl->allow($group, 'controllers/Channels/index');
    $this->Acl->deny($group, 'controllers/OfficeRoute');
    $this->Acl->allow($group, 'controllers/OfficeRoute/index');

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