<?php
/****************************************************************************
 * phone_numbers_controller.php	- Controller for phone numbers
 * version 		 	- 1.0.368
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

class PhoneNumbersController extends AppController {

    var $name = 'PhoneNumbers';

    var $helpers = array('Csv','Ajax','Flash');
    var $components = array('RequestHandler');

    function add(){

    Configure::write('debug', 3);

       if(!empty($this->data)){

             if($this->data['PhoneNumber']['number']){

	       $this->data['PhoneNumber']['number'] = $this->sanitizePhoneNumber($this->data['PhoneNumber']['number']);
	       
                $this->PhoneNumber->create();
                if ($this->PhoneNumber->save($this->data)){
                
                   $view = 'add_success';

                } else {

                   $view = 'add_failure';

                }
             } else {

                   $view = 'add_failure';


             }

                $phonenumbers = $this->PhoneNumber->find('all', array('conditions' => array('user_id' => $this->data['PhoneNumber']['user_id']), 'recursive' => -1));
                $user = $this->data['PhoneNumber']['user_id'];
                $this->set(compact('phonenumbers','user'));
                $this->render($view,'ajax');
           }
    }

    function delete($id, $user_id){

    Configure::write('debug', 0);

       if($id && $user_id){
                
                if ($this->PhoneNumber->del($id)){
               
                   $phonenumbers = $this->PhoneNumber->find('all', array('conditions' => array('user_id' => $user_id), 'recursive' => -1));
                   $user = $user_id;
                   $this->set(compact('phonenumbers','user'));
                   $this->render('add_success','ajax');
                } else {
                  $this->render('add_failure','ajax');
                }
       } else {


       }
    }






}
?>
