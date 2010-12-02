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
      $this->layout ='jquery';

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

	
         $this->User->recursive = 1; 
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

 		$this->set(compact('acls','phonebook'));
		}

		//Save form data
		else {

		     if($this->User->saveAll($this->data)){
				 $this->_flash(__('The entry has been updated',true),'success');
    	     		 	 $this->redirect(array('action' => '/'));
	              } else {

                                $acls 	    	    = $this->User->Acl->find('list');
 		                $phonebook 	    = $this->User->PhoneBook->find('list');
 		                $this->set(compact('acls','phonebook'));

                      }

		}
    }



    function delete ($id){

    	     if($this->User->del($id)) {
	     $this->_flash(__('Selected user has been deleted.',true),'success');
	     }
             $this->redirect(array('action' => 'index'));
    }

    function process (){



	    //One or more users selected
	    if(array_key_exists('user',$this->params['form'])){

		$entries = $this->params['form']['user'];
    	    	$action = $this->params['data']['Submit'];

                switch($action){

                        case __('Delete',true): 

    	     	        foreach ($entries as $key => $user){
	     	           $id = $user['User'];
			   $this->User->id = $id;
		     	   $data = $this->User->getIdentifier($id);
		     	   if ($this->User->del($id)){
				$this->log('Message: User deleted; Id: '.$id."; Key: ".$data['key']."; Value: ".$data['value']."; Timestamp: ".time(), 'user');
			   }
                        }
                           break;


                       case __('Merge',true): 
                       
		       $this->User->id = $entries[0]['User'];
		       $core = $this->User->read();
                       debug($core['PhoneNumber']);
                       unset($entries[0]);
 

    	     	        foreach ($entries as $key => $user){


                           $id = $user['User'];
			   $this->User->id = $id;
                           $tmp = $this->User->read();
                           debug($tmp);	     	           

                           $core['User']['name'].= $tmp['User']['name'];
                           $core['User']['surname'].= $tmp['User']['surname'];
                           $core['User']['skype'].= $tmp['User']['skype'];
                           $core['User']['organization'].= $tmp['User']['organization'];

                           $core['User']['count_poll'] += $tmp['User']['count_poll'];
                           $core['User']['count_ivr']  += $tmp['User']['count_ivr'];
                           $core['User']['count_lam']  += $tmp['User']['count_lam'];
                           $core['User']['count_bin']  += $tmp['User']['count_bin'];
                           $core['User']['new'] = 0;

                           if(!$core['User']['email']){ $core['User']['email'] = $tmp['User']['count_bin'];}
                           if(!$core['User']['first_app']){ $core['User']['first_app'] = $tmp['User']['first_app'];}
                           if(!$core['User']['last_app']){ $core['User']['last_app'] = $tmp['User']['last_app'];}
                           $core['User']['created'] = min(array($core['User']['created'],$tmp['User']['created']));
                           $core['User']['modified'] = max(array($core['User']['modified'],$tmp['User']['modified']));
                           $core['User']['first_epoch'] = min(array($core['User']['first_epoch'],$tmp['User']['first_epoch']));
                           $core['User']['last_epoch'] = max(array($core['User']['last_epoch'],$tmp['User']['last_epoch']));
                           $core['User']['acl_id'] = max(array($core['User']['acl_id'],$tmp['User']['acl_id']));

                           }



                           $this->User->save($core);



                 } //switch		     
              }     //array_key_exists 
		 

	     $this->redirect(array('action' => 'index'));

    }


    function add() {

    	$this->pageTitle = 'Contacts : Add';
		$acls 	    	    = $this->User->Acl->find('list');

 		$this->set(compact('acls'));

          //Fetch form data and save
		if (!empty($this->data)) {

		   	$this->User->set( $this->data );
			if ($this->User->save($this->data)) {
				$this->_flash(__('New contact has been added', true),'success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->_flash(__('The contact could not be added. Please, try again.', true),'error');
			}
		} else {

		//Show empty form
      	 	$this->render();
		}


	}




}

?>
