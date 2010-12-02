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

    var $helpers = array('Csv','Ajax');



 function index($user_id = null) {
 
        if ($user_id) {
 
        $this->set('user_id', $user_id);
        $this->PhoneNumber->recursive = 0;
        $this->set('phoneNumbers', $this->paginate('PhoneNumber', array('user_id' => intval($user_id))));

        } else {

    $this->Session->setFlash(__('shit happens', true));

        } 

}



    function delete ($user_id, $id){

         if ($id && $user_id){

    	     if($this->PhoneNumber->del($id)) {

             $this->log($user_id.' '.$id,'foo');

             $this->Session->setFlash(__('Phone number deleted', true));

	     }

         }
     }


}
?>
