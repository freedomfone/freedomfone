<?php
/****************************************************************************
 * UsersController.php	- Controller for Freedomfone users 
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

class UsersController extends AppController{

      var $name = 'Users';
      var $belongsTo = array('Group');
      var $actsAs = array('Acl' => array('type' => 'requester'));


public function beforeFilter() {
       

    parent::beforeFilter();
    $this->Auth->allow('initDB','login'); // We can remove this line after we're finished
}

   function initDB() {
    $group =& $this->User->Group;

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
    $this->Acl->allow($group, 'controllers/Polls/refresh');


    //Leave a message
    $this->Acl->deny($group, 'controllers/Messages');
    $this->Acl->allow($group, 'controllers/Messages/index');
    $this->Acl->allow($group, 'controllers/Messages/disp');
    $this->Acl->allow($group, 'controllers/Messages/archive');
    $this->Acl->allow($group, 'controllers/Messages/edit');
    $this->Acl->allow($group, 'controllers/Messages/view');
    $this->Acl->allow($group, 'controllers/Messages/refresh');


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
    $this->Acl->allow($group, 'controllers/Bin/refresh');
    $this->Acl->allow($group, 'controllers/Bin/delete');
    $this->Acl->allow($group, 'controllers/Bin/disp');

    //Outgoing SMS
    $this->Acl->deny($group, 'controllers/Batches');
    $this->Acl->allow($group, 'controllers/Batches/index');
    $this->Acl->allow($group, 'controllers/Batches/disp');


    //SMS gateways
    $this->Acl->deny($group, 'controllers/SmsGateways');
    $this->Acl->allow($group, 'controllers/SmsGateways/index');



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
    $this->Acl->allow($group, 'controllers/Cdr/refresh');


    //Monitor IVR
    $this->Acl->deny($group, 'controllers/MonitorIvr');
    $this->Acl->allow($group, 'controllers/MonitorIvr/index');
    $this->Acl->allow($group, 'controllers/MonitorIvr/refresh');

    
    //Dashboard
    $this->Acl->deny($group, 'controllers/Processes');
    $this->Acl->allow($group, 'controllers/Processes/index');
    $this->Acl->allow($group, 'controllers/Processes/refresh');
    $this->Acl->allow($group, 'controllers/Processes/system');
    $this->Acl->allow($group, 'controllers/Processes/refresh');
    
    //Settings
    $this->Acl->deny($group, 'controllers/Settings');
    $this->Acl->allow($group, 'controllers/Settings/index');

    //GSM channels
    $this->Acl->deny($group, 'controllers/Channels');
    $this->Acl->allow($group, 'controllers/Channels/index');
    $this->Acl->allow($group, 'controllers/Channels/refresh');
    $this->Acl->allow($group, 'controllers/Channels/audio_services');

    $this->Acl->deny($group, 'controllers/OfficeRoute');
    $this->Acl->allow($group, 'controllers/OfficeRoute/refresh');

    //Logs
    $this->Acl->deny($group, 'controllers/Logs');


    //Authentication
    $this->Acl->deny($group, 'controllers/Users');
    $this->Acl->deny($group, 'controllers/Groups');


    echo "all done";
    exit;
  }


public function login() {

    if ($this->Session->read('Auth.User')) {
        $this->Session->setFlash('You are logged in!');
        return $this->redirect('/');
    }


    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            return $this->redirect($this->Auth->redirect());
        }

        $this->Session->setFlash(__('Your username or password was incorrect.'));
    }
}


 public function loginXX() {

    if ($this->request->is('post')) {


      if ($this->Auth->login()) {

      
            return $this->redirect($this->Auth->redirectUrl());
	    

        } else {
            $this->Session->setFlash( __('Username or password is incorrect'));
        }
    }
}


      function logout(){

               $this->Session->setFlash(__('You are logged out.',true),'success');
               $this->redirect($this->Auth->logout());

      }



	function index() {

                $this->set('title_for_layout', __('System Users',true));

                $this->loadModel('Group');
                $options = $this->Group->find('list');
                $this->set(compact('options'));

		$this->User->recursive = 0;
		$this->set('users', $this->paginate());


                $res = $this->User->findByUsername('Admin');
                if( $res['User']['password'] == '6f04cfa963380dee68a9bfe8bdff14784af284a7'){
                    $this->Session->setFlash(__('Default password is currently in use for Admin. Please change the password as soon as possible using Edit functionality below.',true));
                } 




	}

	function add() {

               $this->set('title_for_layout', __('Add System User',true));
               $this->loadModel('Group');
               $options = $this->Group->find('list');
               $this->set(compact('options'));


		if (array_key_exists('User', $this->request->data)) {

                    //Set password to non-hashed for validation
                    $this->request->data['User']['password'] = $this->request->data['User']['pwd']; 
                    $this->User->set($this->request->data);

  		    if ($this->User->save($this->request->data)) {


                         //If data is saved/validated, update password field with hashed version	               
                         $this->User->id = $this->User->getLastInsertId();
                         $this->User->saveField('password', $this->Auth->password($this->request->data['User']['pwd']));

			 $this->Session->setFlash(__('New user has been created.', true),'success');
			 $this->redirect(array('action'=>'index'));

		    } else {

                         $errors = $this->User->invalidFields(); 
			 $this->Session->setFlash($errors['password'],'error');

                    }


 
		}
               
	}

	function edit($id = null) {

                $this->set('title_for_layout', __('Edit System User',true));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid option', true),'warning');
			$this->redirect(array('action'=>'index'));
		}

		if (!empty($this->request->data)) {

                    //Set password to non-hashed for validation
                    $this->request->data['User']['password'] = $this->request->data['User']['pwd']; 

                    //If password is left blank, do not validate
                    if(!$this->request->data['User']['pwd']){

                      unset($this->request->data['User']['password']);

                    }

                    $this->User->set($this->request->data);

  		    if ($this->User->save($this->request->data) && key_exists('password',$this->request->data['User']) ) {


                         //If data is saved/validated, update password field with hashed version	               
                         $this->User->id = $id;

                         $this->User->saveField('password', $this->Auth->password($this->request->data['User']['pwd']));

			 $this->Session->setFlash(__('User has been updated.', true),'success');
			 $this->redirect(array('action'=>'index'));

		    } else {

                         $errors = $this->User->invalidFields(); 
                         if(key_exists('password', $errors)){
			    $this->Session->setFlash($errors['password'], 'error');
                         }

                    }

			 $this->Session->setFlash(__('User has been updated.', true),'success');
			 $this->redirect(array('action'=>'index'));

 
		}


                   $this->loadModel('Group');
                   $groups =  $this->Group->find('list');
                   $this->set(compact('groups'));
	           $this->request->data = $this->User->read(null, $id);



	}


       function delete ($id){

         if($id != 1 ){
    	     if($this->User->delete($id,true)) {
    	         $this->Session->setFlash(__('The user been deleted.',true),'success');
	         $this->redirect(array('action' => '/index'));
	     }
         } else {
                $this->Session->setFlash(__('You cannot delete the Admin user.',true),'success');
	        $this->redirect(array('action' => '/index'));
         }

        }


        function system_sweeper(){

     	         if(isset($this->params['form']['submit'])) {

                      unset($this->params['form']['submit']);
                      $status =  $this->sweeper();   

                       if($status) {                     
                                   $this->Session->setFlash(__('Freedom Fone has successfully been swept.',true),'success');
                       } else {
                                   $this->Session->setFlash(__('Sweeping failed. Please review your Sweeper settings.',true),'error');
                       }

                  } 
        }

}

?>