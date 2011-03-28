<?php
/****************************************************************************
 * users_controller.php		- Controller for Users (phone book)
 * version 		 	- 2.0.1225
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

      var $helpers = array('Flash','Formatting','Session','Text','Ajax','Html','Javascript');      

      var  $paginate = array('page' => 1, 'order' => array( 'User.name' => 'asc'));
      var $components = array('RequestHandler');


      function refresh($redirect, $id = null){

        $this->refreshAll();
        $this->redirect(array('controller' => 'users', 'action' => $redirect,$id));

      }


      function index(){

        $this->refreshAll();

        $this->pageTitle = 'Users';
        $this->User->recursive = 1;         

         if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('users_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
         } elseif($this->Session->check('users_sort')) {                     
               $this->paginate['order'] = $this->Session->read('users_sort');
         } 

         if(isset($this->params['named']['limit'])) { 
	        $this->Session->write('users_limit',$this->params['named']['limit']);
         } elseif($this->Session->check('users_limit')) { 
                $this->paginate['limit'] = $this->Session->read('users_limit');
         }	


         if(isset($this->params['form']['submit']) && $phone_book_id = $this->data['User']['phone_book_id']) { 
            
             $data = $this->User->PhoneBook->findById($phone_book_id);
             if ($data['User']){

                foreach ($data['User'] as $key => $user){

                     $user_id[] = $user['id'];
                }

                $users = $this->paginate('User', array('User.id' => $user_id));
                $this->set(compact('users'));    
             }
            
         } else {

             $users = $this->paginate('User');
             $this->set(compact('users'));    
         }

         $this->loadModel('PhoneBook');
         $options = $this->PhoneBook->find('list');
         $options[0] = __('All users',true);
         $this->set(compact('options','users'));

      }



     function view($id){

      	$this->pageTitle = 'User details';


      	   $this->User->id = $id;
      	   $this->set('data',$this->User->findById($id));       

       
      }


    function edit($id = null)    {  


    	     $this->pageTitle = 'Edit User';   

             if(isset($this->params['form']['submit'])) {
	        if ($this->params['form']['submit']==__('Refresh',true)){
                   $this->requestAction('/users/refresh/edit/'.$id);
                }
             }


	     //No id specified
	     if(!$id){
		  $this->redirect(array('action' =>'/'));
	     }

             //Fetch data from db     
    	     elseif(empty($this->data['User'])){

		$this->data = $this->User->read(null,$id);
		$phonenumbers = $this->User->PhoneNumber->find('all',array('conditions' =>array('User.id' => $id)));

		$acls 	    	    = $this->User->Acl->find('list');
 		$phonebook 	    = $this->User->PhoneBook->find('list');               
 		$this->set(compact('acls','phonebook','phonenumbers'));
              }

	      //Save form data
	      else {

                   unset($this->data['PhoneNumber']);

		     if($this->User->saveAll($this->data)){
                                 $this->log("INFO EDIT {ID: ".$id."; NAME: ".$this->data['User']['name']." ".$this->data['User']['surname']."}", "user");                       
                		 $this->_flash(__('The entry has been updated',true),'success');
    	     		 	 $this->redirect(array('action' => '/'));
	              } else {


                                $phonenumbers = $this->User->PhoneNumber->find('all',array('conditions' =>array('User.id' => $id)));
                                
                                $acls 	    	    = $this->User->Acl->find('list');
 		                $phonebook 	    = $this->User->PhoneBook->find('list');
 		                $this->set(compact('acls','phonebook','phonenumbers'));

                      }

	      }
    }



    function delete ($id){

    	     if($this->User->delete($id,true)) {
	           $this->_flash(__('Selected user has been deleted.',true),'success');
	           $data = $this->User->getIdentifier($id);
	           $this->log("INFO DELETE {ID: ".$id."; NAME: ".$data['User']['name']." ".$data['User']['surname']."}", "user");

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

    	     	        foreach ($entries as $key => $id){

		     	   $data = $this->User->getIdentifier($id);
		     	   if ($this->User->del($id)){
				$this->log("INFO DELETE {ID: ".$id."; NAME: ".$data['User']['name']." ".$data['User']['surname']."}", "user");
			   }
                        }
                           break;


                       case __('Merge',true): 

		       $this->User->id = array_pop($entries);
                       $this->User->unbindModel(array('hasMany' => array('Cdr','Message')));   
		       $core = $this->User->read();
                       $this->log("INFO MERGE {ID: ".$core['User']['id']."; NAME: ".$core['User']['name']." ".$core['User']['surname']."}", "user");                       

    	     	        foreach ($entries as $key => $user){


                           $id = $user;
			   $this->User->id = $id;
                           $tmp = $this->User->read();
                           $this->log("INFO MERGE {ID: ".$tmp['User']['id']."; NAME: ".$tmp['User']['name']." ".$tmp['User']['surname']."}", "user");                       
                           
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

                           $j = sizeof($core['PhoneNumber']);
                           if($tmp['PhoneNumber']){
                                foreach($tmp['PhoneNumber'] as $i => $phone_number){
                           
                                        $core['PhoneNumber'][$j+$i+1]['user_id'] = $core['User']['id'];
                                        $core['PhoneNumber'][$j+$i+1]['number'] = $phone_number['number'];
                         
                                }
                           }
                           if($tmp['PhoneBook']){
                                foreach($tmp['PhoneBook'] as $i => $phone_book){
  
                                        $phone_book['PhoneBooksUser']['user_id'] = $core['User']['id'];     
                                        unset($phone_book['PhoneBooksUser']['id'] );
                                        $core['PhoneBook'][] = $phone_book;
                                 } 
                           }

                           $this->User->del($tmp['User']['id']);
                        }

                      $this->User->saveAll($core);
                      $this->User->PhoneBook->save($core['PhoneBook']);



                 } //switch		     
              }     //array_key_exists 
		 

	     $this->redirect(array('action' => 'index'));

    }


    function add() {

    	$this->pageTitle = 'Add User';
	$acls = $this->User->Acl->find('list');
 	$this->set(compact('acls'));

        //Fetch form data and save
	if (!empty($this->data)) {


		$this->User->set( $this->data );
		if ($this->User->save($this->data['User'])) {

                        $id = $this->User->getLastInsertId();
                        $this->data['PhoneNumber']['user_id'] = $id;
                        $this->User->PhoneNumber->saveAll($this->data['PhoneNumber']);
			$this->_flash(__('New user has been added', true),'success');
			$this->redirect(array('action'=>'index'));
		} 

	} else {

		//Show empty form
      	 	$this->render();
	}


    }


    function disp (){

  	   Configure::write('debug', 0);

          if( $phone_book_id = $this->data['User']['phone_book_id']){

             if ($data = $this->User->PhoneBook->findById($phone_book_id)){


                foreach ($data['User'] as $key => $user){

                     $user_id[] = $user['id'];
                }


                $users = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
                $this->set(compact('users'));    
              }
            
             } else {

             $users = $this->User->find('all');
             $this->set(compact('users'));    

             }

     }

	       



}

?>
