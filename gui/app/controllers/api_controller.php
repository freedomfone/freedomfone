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

/*
 * Retrieve callback SMS codes
 * Method: GET
 * 
 * @return 
 *      array($callback (array), $tickle(string))
 */
     function get(){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $this->loadModel('CallbackService');  
    	   $list   = $this->CallbackService->find('list', array('fields' => array('code')));
    	   $tickle = $this->CallbackService->findByTickle(1);
           $data['callback'] = $list;
           $data['tickle']   = $tickle['CallbackService']['code'];

           echo json_encode($data);       

       
      }

/*
 * Retrieve poll data
 * Method: GET
 *
 * @params
 *      $id(int) Poll id
 * 
 * @data
 *      $status(int) Status value (0-2)
 *
 * @return 
 *      $poll (array)
 */
      function polls($id = null){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           parse_str(file_get_contents("php://input"),$post_vars);
           

           $params = false;
           $valid_request = true;

           $this->loadModel('Poll');

           //Status
           if(array_key_exists('status', $post_vars)){
             $status = $post_vars['status'];
  
             if($this->Api->validRange($status,0,2)){
                      $params[] = array( 'Poll.status' => $status);
             } else {
               $valid_request = false;              
             }

           }

           //Poll id
           if($id){
                   $params[] = array( 'Poll.id' => $id);
           }

           $poll = $this->Poll->find('all', array('conditions' => $params));

           if($valid_request){           
                echo json_encode($poll);     
           } else {
                echo header("HTTP/1.0 400 Bad Request");

           }
      }




/*
 * Retrieve Leave-a-message data
 * Method: GET
 *
 * @params
 *      $id(int) Leave-a-message id
 * 
 *
 * @return 
 *      $lm_menu (array)
 */
      function lm_menus($id = null){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $valid_request = true;

           $this->loadModel('LmMenu');
     	   $this->LmMenu->unbindModel(array('hasMany' => array('MonitorIvr')));
     	   $this->LmMenu->unbindModel(array('hasMany' => array('Mapping')));

           //LmMenu id
           if($id){
                   $params = array( 'LmMenu.id' => $id);
           }

           $lm_menu = $this->LmMenu->find('all', array('conditions' => $params));

           $lm_menu = $this->Api->addLmMenuFiles($lm_menu);

           if($valid_request){           
                echo json_encode($lm_menu);     
           } else {
                echo header("HTTP/1.0 400 Bad Request");

           }



      }


/*
 * Retrieve Leave-a-message message
 * Method: GET
 *
 * @params
 *      $instance_id(int) Leave-a-message instance
 * 
 * @data
 *      $id(int) id of message
 *      $user_id(int) id of message author 
 *      $category_id: id of message category
 *      $rate: message rate {1-5}
 *      $new: message status {0-1}
 *      $quick_hangup: Message left by quick hangup, or complete hangup (boolean)
 
 * @return 
 *      $messages (array)
 */
    function messages(){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $valid_request = true;
           parse_str(file_get_contents("php://input"),$post_vars);
           $keys = array('id','user_id','category_id','rate','new','quick_hangup');

           if(!$this->Api->validPostVars($post_vars,$keys)){
                echo header("HTTP/1.0 400 Bad Request");
           } else {

             $this->loadModel('Message');

           
                //User ID
                if(array_key_exists('user_id', $post_vars)){
                $user_id = $post_vars['user_id'];
                         if(is_int((int)$user_id)){
                                $params[] = array( 'Message.user_id' => $user_id);
                         } else {
                                $valid_request = false;              
                         }
                }

           //Category ID
           if(array_key_exists('category_id', $post_vars)){
             $category_id = $post_vars['category_id'];
             if(is_int((int)$category_id)){
                      $params[] = array( 'Message.category_id' => $category_id);
             } else {
               $valid_request = false;              
             }
           }

           //Rate
           if(array_key_exists('rate', $post_vars)){
             $rate = $post_vars['rate'];
             if(is_int((int)$category_id) && $this->Api->validRange($rate,1,5)){
                      $params[] = array('Message.rate' => $rate);
             } else {
               $valid_request = false;              
             }
           }

           //New (true)
           if(array_key_exists('new', $post_vars)){
             $new = $post_vars['new'];
             if(is_int((int)$new) && $this->Api->validRange($new,0,1)){
                      $params[] = array( 'Message.new' => $new);
             } else {
               $valid_request = false;              
             }
           }

           //Quick hangup
           if(array_key_exists('quick_hangup', $post_vars)){
             $quick_hangup = $post_vars['quick_hangup'];
             if($quick_hangup== 'true'){
                      $params[] = array( 'Message.quick_hangup' => $quick_hangup);
             } else {
               $valid_request = false;              
             }
           }
           Configure::write('debug', 1);
           $message = $this->Message->find('all', array('conditions' => $params));

           foreach($message as $key => $entry){
                $message[$key]['Message']['url'] = urlencode($message[$key]['Message']['url']);
                $message[$key]['Message']['file'] = $this->Api->getMessageAudio($entry['Message']['file'],$entry['Message']['instance_id']);
                unset($message[$key]['Message']['url']);
           }

           
           if($valid_request){           
                echo json_encode($message);     
           } else {
                echo header("HTTP/1.0 400 Bad Request");

           }

           }
      }

}
?>