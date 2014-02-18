<?php
/****************************************************************************
 * CallersController.php		- Controller for Callers (phone book)
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

class CallersController extends AppController{

      var $name = 'Callers';

      var $helpers = array('Flash','Formatting','Text','Html');      

      var  $paginate = array('page' => 1, 'order' => array( 'Caller.name' => 'asc'));
      var $components = array('RequestHandler');


      function refresh($redirect, $id = null){

        $this->refreshAll();
        $this->redirect(array('controller' => 'callers', 'action' => $redirect,$id));

      }


      function index(){

       Configure::write('debug', 0);

       $this->refreshAll();
       $this->set('title_for_layout', __('Callers',true));
       $this->Caller->recursive = 1;         

       if(strpos($this->referer(),'callers') === false){

            $this->Session->write('callers_phone_book_id',false);


       } else {

           if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('callers_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
           } elseif($this->Session->check('callers_sort')) {                     
               $this->paginate['order'] = $this->Session->read('callers_sort');
           } 

           if(isset($this->params['named']['limit'])) { 
	        $this->Session->write('callers_limit',$this->params['named']['limit']);
           } elseif($this->Session->check('callers_limit')) { 
                $this->paginate['limit'] = $this->Session->read('callers_limit');
           }	

        }


        //Phone book selected || Show all phone books
        if($this->request->data['Caller']['phone_book_id']){

	   if(array_key_exists('phone_book_id', $this->request->data['Caller'])){
	
		$phone_book_id = $this->request->data['Caller']['phone_book_id'];

                $this->Session->write('callers_phone_book_id', $phone_book_id);
                $data = $this->Caller->PhoneBook->findById($phone_book_id);

                if ($data['Caller']){
                   foreach ($data['Caller'] as $key => $user){
                     $user_id[] = $user['id'];
                   }

                $callers = $this->paginate('Caller', array('Caller.id' => $user_id));
                $this->set(compact('callers'));

                } else {
                   $callers = false;
                }
	     } //phone_book_id

             //Show all phone books
            } elseif ( isset($phone_book_id) && $phone_book_id == 0 ){
             $this->Session->write('callers_phone_book_id', $phone_book_id);


             $callers = $this->paginate('Caller');
             $this->set(compact('callers'));    

             //Pagination changed
             } elseif ( !isset($phone_book_id)  && $this->Session->read('callers_phone_book_id')){

             $phone_book_id = $this->Session->read('callers_phone_book_id');
     
             $data = $this->Caller->PhoneBook->findById($phone_book_id);



             if ($data['Caller']){
                foreach ($data['Caller'] as $key => $user){
                     $user_id[] = $user['id'];
                }

                $callers = $this->paginate('Caller', array('Caller.id' => $user_id));
                $this->set(compact('callers'));

             
             } else {
                $callers = false;
             }

             } else {
             //Visit site for first time
             $this->Session->write('callers_phone_book_id', false);
             $callers = $this->paginate('Caller');
             $this->set(compact('callers'));    

             }




         $this->loadModel('PhoneBook');
         $options = $this->PhoneBook->find('list');
         $this->set(compact('options','callers'));


      }



     function view($id){

       $this->set('title_for_layout', __('Caller details',true));

      	   $this->Caller->id = $id;
      	   $this->set('data',$this->Caller->findById($id));       

       
      }


    function edit($id = null)    {  

             $this->set('title_for_layout', __('Edit Caller',true));

             if(isset($this->request->data['submit'])) {
	        if ($this->request->data['submit']==__('Refresh',true)){
                   $this->requestAction('/callers/refresh/edit/'.$id);
                }
             }


	     //No id specified
	     if(!$id){
		  $this->redirect(array('action' =>'/'));
	     }

             //Fetch data from db     
    	     elseif(empty($this->request->data['Caller'])){

      		if($this->Session->check('messages_sort')){
			$data = $this->Session->read('messages_sort');
			$keys = array_keys($data);
			$field = $keys[0];
			$dir = $data[$field];
		} else {
			$field = 'id';
			$dir = 'asc';
		}


		$this->request->data	= $this->Caller->read(null,$id);
		$phonenumbers       	= $this->Caller->PhoneNumber->find('all',array('conditions' =>array('Caller.id' => $id)));
		$acls 	    	    	= $this->Caller->Acl->find('list');
 		$phonebook 	    	= $this->Caller->PhoneBook->find('list');

 		$this->set(compact('acls','phonebook','phonenumbers','neighbors'));
              
              }

	      //Save form data
	      else {

                   unset($this->request->data['PhoneNumber']);


		     if($this->Caller->saveAll($this->request->data)){
                                 $this->log("INFO EDIT {ID: ".$id."; NAME: ".$this->request->data['Caller']['name']." ".$this->request->data['Caller']['surname']."}", "user");                       
                		 $this->Session->setFlash(__('The entry has been updated',true),'success');
    	     		 	 $this->redirect(array('action' => '/'));
	              } else {


                                $phonenumbers = $this->Caller->PhoneNumber->find('all',array('conditions' =>array('Caller.id' => $id)));
                                
                                $acls 	    	    = $this->Caller->Acl->find('list');
 		                $phonebook 	    = $this->Caller->PhoneBook->find('list');
 		                $this->set(compact('acls','phonebook','phonenumbers'));

                      }

	      }
    }



    function delete ($id){

           if($id){

		$data = $this->Caller->getIdentifier($id);
		$this->log("INFO DELETE {ID: ".$id."; NAME: ".$data['Caller']['name']." ".$data['Caller']['surname']."}", "user");

    	        if($this->Caller->delete($id,true)) {
	           $this->Session->setFlash(__('Selected user has been deleted.',true),'success');	       
	        }
	     }
             $this->redirect(array('action' => 'index'));
    }

    function process (){

	    //One or more callers selected
	    if(array_key_exists('caller',$this->request->data)){

		$entries = $this->request->data['caller'];
    	    	$action = $this->request->data['Submit'];



                switch($action){


                        case __('Add to phone book',true): 

                        $phone_book_id_selected = $this->request->data['Caller']['add_phone_book_id'];
    	     	        foreach ($entries as $key => $id){


                                $user_id = $id;
                                $phonebooks = $this->Caller->findById($user_id);
                                $phone_books = $phonebooks['PhoneBook'];
                                foreach ($phone_books as $book){
                                        
                                        $phone_book_id[] = $book['id'];

                                }
                                $phone_book_id[] = $phone_book_id_selected;
                                $phone_book_id = array_unique($phone_book_id);

                                unset($this->request->data);
                                $this->request->data = $this->Caller->findById($user_id);
                                $this->request->data['PhoneBook'] = $phone_book_id;
                                $this->Caller->save($this->request->data);
                        }
                        break;

                        case __('Remove from phone book',true): 
                        
                        $phone_book_id_selected = $this->request->data['Caller']['add_phone_book_id'];
                        foreach ($entries as $key => $id){
                        
                                unset($phonebooks);
                                unset($phone_book_id);
                                $phone_book_id = array();

                                $user_id = $id;
                                $phonebooks = $this->Caller->findById($user_id);
                                $phone_books = $phonebooks['PhoneBook'];
                                foreach ($phone_books as $book){                             
                                        $phone_book_id[] = $book['id'];
                                }

                                $key = array_search($phone_book_id_selected, $phone_book_id);
                                unset($phone_book_id[$key]);                                 


                                unset($this->request->data);
                                $this->request->data = $this->Caller->findById($user_id);

                               if(!sizeof($phone_book_id)){
                                     $this->request->data['PhoneBook'][0] = false;
                                } else {
                                     $this->request->data['PhoneBook'] = $phone_book_id;
                                }
        

                                $this->Caller->save($this->request->data);


                        }

                        break;


                        case __('Delete',true): 

    	     	        foreach ($entries as $key => $id){

		     	   $data = $this->Caller->getIdentifier($id);
		     	   if ($this->Caller->delete($id)){
				$this->log("INFO DELETE {ID: ".$id."; NAME: ".$data['Caller']['name']." ".$data['Caller']['surname']."}", "user");
			   }
                        }
                           break;


                       case __('Merge',true): 


		       $this->Caller->id = array_pop($entries);
                       $this->Caller->unbindModel(array('hasMany' => array('Cdr','Message')));   
		       $core = $this->Caller->read();
                       $this->log("INFO MERGE {ID: ".$core['Caller']['id']."; NAME: ".$core['Caller']['name']." ".$core['Caller']['surname']."}", "user");                       

    	     	        foreach ($entries as $key => $user){


                           $id = $user;
			   $this->Caller->id = $id;
                           $tmp = $this->Caller->read();
                           $this->log("INFO MERGE {ID: ".$tmp['Caller']['id']."; NAME: ".$tmp['Caller']['name']." ".$tmp['Caller']['surname']."}", "user");                       
                           
                           $core['Caller']['name']         = substr($core['Caller']['name'].$tmp['Caller']['name'],0,20);
                           $core['Caller']['surname']      = substr($core['Caller']['surname'].$tmp['Caller']['surname'],0,20);
                           $core['Caller']['skype']        = substr($core['Caller']['skype'].$tmp['Caller']['skype'],0,20);
                           $core['Caller']['organization'] = substr($core['Caller']['organization'].$tmp['Caller']['organization'],0,20);

                           $core['Caller']['count_poll'] += $tmp['Caller']['count_poll'];
                           $core['Caller']['count_ivr']  += $tmp['Caller']['count_ivr'];
                           $core['Caller']['count_lam']  += $tmp['Caller']['count_lam'];
                           $core['Caller']['count_bin']  += $tmp['Caller']['count_bin'];
                           $core['Caller']['count_callback']  += $tmp['Caller']['count_callback'];
                           $core['Caller']['new'] = 0;

                           if(!$core['Caller']['email']){ $core['Caller']['email'] = $tmp['Caller']['email'];}
                           if(!$core['Caller']['first_app']){ $core['Caller']['first_app'] = $tmp['Caller']['first_app'];}
                           if(!$core['Caller']['last_app']){ $core['Caller']['last_app'] = $tmp['Caller']['last_app'];}
                           $core['Caller']['created'] = min(array($core['Caller']['created'],$tmp['Caller']['created']));
                           $core['Caller']['modified'] = max(array($core['Caller']['modified'],$tmp['Caller']['modified']));
                           $core['Caller']['first_epoch'] = min(array($core['Caller']['first_epoch'],$tmp['Caller']['first_epoch']));
                           $core['Caller']['last_epoch'] = max(array($core['Caller']['last_epoch'],$tmp['Caller']['last_epoch']));
                           $core['Caller']['acl_id'] = max(array($core['Caller']['acl_id'],$tmp['Caller']['acl_id']));

                           $j = sizeof($core['PhoneNumber']);
                           unset($core['PhoneNumber']);
                           if($tmp['PhoneNumber']){
                                foreach($tmp['PhoneNumber'] as $i => $phone_number){
                           
                                        $core['PhoneNumber'][$i]['user_id'] = $core['Caller']['id'];
                                        $core['PhoneNumber'][$i]['number'] = $phone_number['number'];
                         
                                }
                           }


                           if($tmp['PhoneBook']){
                                foreach($tmp['PhoneBook'] as $i => $phone_book){
  
                                        $phone_book['PhoneBooksCaller']['user_id'] = $core['Caller']['id'];     
                                        unset($phone_book['PhoneBooksCaller']['id'] );
                                        $core['PhoneBook'][] = $phone_book;
                                 } 
                           }

                           $this->Caller->delete($tmp['Caller']['id']);
                        }

                      if($this->Caller->PhoneNumber->validates()){
                        $this->Caller->id = $core['Caller']['id'];
                        $this->Caller->save($core['Caller'], array('validate' => false));
                        $this->Caller->PhoneNumber->saveAll($core['PhoneNumber']);      
                        $this->Caller->PhoneBook->saveAll($core['PhoneBook'], array('validate' => false));
                      
                      } else {
                        $errors = $this->Caller->invalidFields();

                      }


                 } //switch		     
              }     //array_key_exists 
		 

	     $this->redirect(array('action' => '/'));

    }


    function add() {


        $this->set('title_for_layout', __('Add Caller',true));
    	
	$acls = $this->Caller->Acl->find('list');
 	$this->set(compact('acls'));

        //Fetch form data and save
	if (array_key_exists('Caller', $this->request->data)) {


		$this->Caller->set( $this->request->data );
		if ($this->Caller->save($this->request->data['Caller'])) {

                        $id = $this->Caller->getLastInsertId();
                        $this->request->data['PhoneNumber']['user_id'] = $id;
                        $this->Caller->PhoneNumber->saveAll($this->request->data['PhoneNumber']);
			$this->Session->setFlash(__('New caller has been added', true),'success');
			$this->redirect(array('action'=>'index'));
		} 

	} 

               $this->loadModel('PhoneBook');
               $options = $this->PhoneBook->find('list');
               $this->set(compact('options'));
    	       $this->render();



    }


    function disp (){

	  Configure::write('debug', 0);

          if( $phone_book_id = $this->request->data['Caller']['phone_book_id']){

             if ($data = $this->Caller->PhoneBook->findById($phone_book_id)){

                foreach ($data['Caller'] as $key => $user){
                     $user_id[] = $user['id'];
                }

                $callers = $this->Caller->find('all', array('conditions' => array('Caller.id' => $user_id)));
                $this->set(compact('callers'));    
              }
            
           } else {

             $callers = $this->Caller->find('all');
             $this->set(compact('callers'));    

           }

     }

	       



}

?>
