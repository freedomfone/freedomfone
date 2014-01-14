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
      var $belongsTo = array('Group');
      var $actsAs = array('Acl' => array('type' => 'requester'));

      public function beforeFilter() {
      	     parent::beforeFilter();

    	     $this->Auth->allow('logout');

      }


 public function login() {

    if ($this->request->is('post')) {
      if ($this->Auth->login($this->request->data['FfUser'])) {
            return $this->redirect($this->Auth->redirectUrl());
	    

        } else {
            $this->Session->setFlash( __('Username or password is incorrect'));
        }
    }
}


    public function logincc() {

      $this->set('title_for_layout', __('Login',true));


       if ($this->request->is('post')) {

//       	    $this->request->data['FfUser']['id'] = $this->FfUser->id;
  	    $this->request->data['FfUser']['id'] = 1;

        if ($this->Auth->login($this->request->data['FfUser'])) {

      	   $this->Session->setFlash(__('You are logged in.',true));

            return $this->redirect($this->Auth->redirectUrl());

        } else {
            $this->Session->setFlash(__('Username or password is incorrect'),'default', array(),'auth' );
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

		$this->FfUser->recursive = 0;
		$this->set('ff_users', $this->paginate());


                $res = $this->FfUser->findByUsername('Admin');
                if( $res['FfUser']['password'] == '6f04cfa963380dee68a9bfe8bdff14784af284a7'){
                    $this->Session->setFlash(__('Default password is currently in use for Admin. Please change the password as soon as possible using Edit functionality below.',true));
                } 




	}

	function add() {

               $this->set('title_for_layout', __('Add System User',true));
               $this->loadModel('Group');
               $options = $this->Group->find('list');
               $this->set(compact('options'));


		if (array_key_exists('FfUser', $this->request->data)) {

                    //Set password to non-hashed for validation
                    $this->request->data['FfUser']['password'] = $this->request->data['FfUser']['pwd']; 
                    $this->FfUser->set($this->request->data);

  		    if ($this->FfUser->save($this->request->data)) {


                         //If data is saved/validated, update password field with hashed version	               
                         $this->FfUser->id = $this->FfUser->getLastInsertId();
                         $this->FfUser->saveField('password', $this->Auth->password($this->request->data['FfUser']['pwd']));

			 $this->Session->setFlash(__('New user has been created.', true),'success');
			 $this->redirect(array('action'=>'index'));

		    } else {

                         $errors = $this->FfUser->invalidFields(); 
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
                    $this->request->data['FfUser']['password'] = $this->request->data['FfUser']['pwd']; 

                    //If password is left blank, do not validate
                    if(!$this->request->data['FfUser']['pwd']){

                      unset($this->request->data['FfUser']['password']);

                    }

                    $this->FfUser->set($this->request->data);

  		    if ($this->FfUser->save($this->request->data) && key_exists('password',$this->request->data['FfUser']) ) {


                         //If data is saved/validated, update password field with hashed version	               
                         $this->FfUser->id = $id;

                         $this->FfUser->saveField('password', $this->Auth->password($this->request->data['FfUser']['pwd']));

			 $this->Session->setFlash(__('User has been updated.', true),'success');
			 $this->redirect(array('action'=>'index'));

		    } else {

                         $errors = $this->FfUser->invalidFields(); 
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
	           $this->request->data = $this->FfUser->read(null, $id);



	}


       function delete ($id){

         if($id != 1 ){
    	     if($this->FfUser->delete($id,true)) {
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