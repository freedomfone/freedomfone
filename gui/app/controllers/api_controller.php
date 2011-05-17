<?php
/****************************************************************************
 * api_controller.php           - Controller public API
 * version 		 	- 2.5.1350
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

class ApiController extends AppController{

	var $name = 'Api';
        var $components = array('RequestHandler','Security');

     function beforeFilter(){

	   $auth = Configure::read('public_api');
 
               $this->Security->loginOptions = array('type' => 'basic', 'realm' => 'MyRealm');
               $this->Security->loginUsers = array($auth['user'] => $auth['password']);
               $this->Security->requireLogin();

     }

     function get(){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $this->loadModel('CallbackService');  
    	   $data = $this->CallbackService->find('list', array('fields' => array('code')));
           echo json_encode($data);       

       
      }

      }

?>