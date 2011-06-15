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
 * Retrieve Incoming SMS (bin)
 * Method: GET
 *
 * @data
 *      $sender(int) Phone number of SMS sender 
 *
 * @return 
 *      $bin (array)
 */
      function bin(){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;

           parse_str(file_get_contents("php://input"),$post_vars);
           $keys = array('sender');

           if(!$this->Api->validPostVars($post_vars,$keys)){
                echo header("HTTP/1.0 400 Bad Request");
           } else {

             $this->loadModel('Bin');

             foreach($post_vars as $key => $value){

                 switch($key){

                    case 'sender':  
                    if(is_numeric($value)){
                         $params[] = array( 'Bin.sender' => $value);
                    } else {
                         $bad_request = true;
                    }
                    break;

                 }

              }

              $bin = $this->Bin->find('all', array('conditions' => $params));

              if(!$bin){ $not_found = true;}

                 $this->Api->sendHeader($bin,$bad_request,$not_found);
              }
        
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

           $params = false;
           $bad_request = false;
           $not_found   = false;

           parse_str(file_get_contents("php://input"),$post_vars);
           $keys = array('status','id');
           $post_vars['id'] = $id;

           if(!$this->Api->validPostVars($post_vars,$keys)){
                echo header("HTTP/1.0 400 Bad Request");
           } else {

             $this->loadModel('Poll');

             foreach($post_vars as $key => $value){

                 switch($key){

                    case 'status':  
                    if($this->Api->validRange($value,0,2)){
                        $params[] = array( 'Poll.status' => $value);
                    } else {
                        $bad_request = true;
                    }
                    break;

                    case 'id':
                    if(is_numeric($value)){
                         $params[] = array( 'Poll.id' => $value);
                    } else {
                         $bad_request = true;
                    }
                    break;

                 }

              }

              $poll = $this->Poll->find('all', array('conditions' => $params));

              if(!$poll){ $not_found = true;}

                 $this->Api->sendHeader($poll,$bad_request,$not_found);
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
           $bad_request = false;
           $not_found = false;

           $this->loadModel('LmMenu');
     	   $this->LmMenu->unbindModel(array('hasMany' => array('MonitorIvr')));
     	   $this->LmMenu->unbindModel(array('hasMany' => array('Mapping')));

           //LmMenu id
           if($id){
             if(is_numeric($id)){
                   $params = array( 'LmMenu.id' => $id);
             } else {
                   $bad_request = true;
             }
           }

           $lm_menu = $this->LmMenu->find('all', array('conditions' => $params));

           if(!$lm_menu){ $not_found = true;} else {
                          $lm_menu = $this->Api->addLmMenuFiles($lm_menu);
           }
          
           $this->Api->sendHeader($lm_menu,$bad_request,$not_found); 




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
 *      $tag_id(int): id of tag
 *      $rate: message rate {1-5}
 *      $new: message status {0-1}
 *      $quick_hangup: Message left by quick hangup, or complete hangup (boolean)

 
 * @return 
 *      $messages (array)
 */
    function messages($instance_id){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;

           parse_str(file_get_contents("php://input"),$post_vars);
           $post_vars['instance_id'] = $instance_id;
           $keys = array('id','user_id','category_id','rate','new','quick_hangup','tag_id','instance_id');

           if(!$this->Api->validPostVars($post_vars,$keys)){
                echo header("HTTP/1.0 400 Bad Request");
           } else {

             $this->loadModel('Message');

             foreach($post_vars as $key => $value){


                    switch($key){

                        case 'instance_id':
                         if(is_numeric($value)){
                                $params[] = array( 'Message.instance_id' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'id':
                         if(is_numeric($value)){
                                $params[] = array( 'Message.id' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;


                        case 'user_id':
                         if(is_numeric($value)){
                                $params[] = array( 'Message.user_id' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'category_id':
                        if(is_numeric($value)){
                                $params[] = array( 'Message.category_id' => $value);
                        } else {
                               $bad_request = true;              
                        }
                        break;

                        case 'tag_id':
                        if(is_numeric($value)){
                                if($tags = $this->Message->Tag->findById($value)){
                                         foreach ($tags['Message'] as $key => $message){
                                                 $message_id[] = $message['id'];
                                         }
                                         $params[] = array('Message.id' => $message_id);
                                } else {
                                  $not_found = true;
                                } 
                        } else {
                           $bad_request = true;
                        }
                        break;

                        case 'rate':
                        if(is_numeric($value) && $this->Api->validRange($value,1,5)){
                             $params[] = array('Message.rate' => $value);
                        } else {
                             $bad_request = true;              
                        }
                        break;

                        case 'new':
                        if(is_numeric($value) && $this->Api->validRange($value,0,1)){
                             $params[] = array('Message.new' => $value);
                        } else {
                            $bad_request = true;              
                        }
                        break;

                        case 'quick_hangup':

                        if((bool)$value){
                             $params[] = array( 'Message.quick_hangup' => $value);
                        } else {
                            $bad_request = true;
                         
                        }
                        break;




                    } //switch

             } //foreach
           

           $message = $this->Message->find('all', array('conditions' => $params));
           if(!$message){ 
                          $not_found = true;
           } else {

             foreach($message as $key => $entry){
                $message[$key]['Message']['url'] = urlencode($message[$key]['Message']['url']);
                $message[$key]['Message']['file'] = $this->Api->getMessageAudio($entry['Message']['file'],$entry['Message']['instance_id']);
                unset($message[$key]['Message']['url']);
              }
           }


           $this->Api->sendHeader($message,$bad_request,$not_found);
           
        }
      }

/*
 * Retrieve message categories
 * Method: GET
 *
 * @params
 *      $id(int) Category id
 * 
 * @return 
 *      $categories (array)
 */
      function categories($id = null){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;

             $this->loadModel('Category');

             if($id) {
                    if(is_numeric($id)){
                        $params[] = array( 'Category.id' => $id);
                    } else {
                        $bad_request = true;
                    }
              }

     	      $this->Category->unbindModel(array('hasMany' => array('Message')));
              $category = $this->Category->find('all', array('conditions' => $params));
              $this->Api->sendHeader($category,$bad_request,$not_found);
      }

/*
 * Retrieve message tags
 * Method: GET
 *
 * @params
 *      $id(int) Tag id
 * 
 * @return 
 *      $tags (array)
 */
      function tags($id = null){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;

             $this->loadModel('Tag');

             if($id) {
                    if(is_numeric($id)){
                        $params[] = array( 'Tag.id' => $id);
                    } else {
                        $bad_request = true;
                    }
              }

     	      $this->Tag->unbindModel(array('hasAndBelongsToMany' => array('Message')));
              $tag = $this->Tag->find('all', array('conditions' => $params));
              $this->Api->sendHeader($tag,$bad_request,$not_found);
      }

/*
 * Retrieve CDR
 * Method: GET
 *
 * @data
 *      $start_time(int)      : epoch start time
 *      $end_time (int)       : epoch end time
 *      $caller_number (int)  : caller phone number
 *      $application (string) : type of application {bin, poll, lam, ivr, callback}
 *      $service (int)        : a  four character long numeric string unique for a certain instance of an application. 
 *                              {2100-2119} for LAM, and {4100-4119} for IVR.
 *      $user_id(int)         : User id 
 *
 * @return 
 *      $cdr (array)
 */
      function cdr(){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;
           $page = 1;
           $limit = 100;

           parse_str(file_get_contents("php://input"),$post_vars);
           $keys = array('start_time', 'end_time', 'caller_number', 'application', 'user_id','service', 'limit', 'page');
                    

           if(!$this->Api->validPostVars($post_vars,$keys)){
                echo header("HTTP/1.0 400 Bad Request");
           } else {


             $this->loadModel('Cdr');

             foreach($post_vars as $key => $value){

                 switch($key){

                        case 'start_time':
                         if(is_numeric($value)){
                                $params[] = array( 'Cdr.epoch >=' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'end_time':
                         if(is_numeric($value)){
                                $params[] = array( 'Cdr.epoch <=' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'caller_number':
                         if(is_numeric($value)){
                                $params[] = array( 'Cdr.caller_number' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'application':
                         if(in_array($value, array('lam','ivr','bin','poll', 'callback'))){
                                $params[] = array( 'Cdr.application' => $value);

                         } else {
                                $bad_request = true;              
                         }
                         break;


                         case 'service':

                            $params[] = array( 'Cdr.channel_state' => 'CS_ROUTING');
                            $application = $post_vars['application'];
                         if($application == 'ivr'){
                                    if($this->Api->validRange($value,4100,4119)){
                                        $params[] = array( 'Cdr.extension' => $value);
                                    } else {
                                        $bad_request = true;              
                                    }
                         } elseif ($application == 'lam'){
                                    if($this->Api->validRange($value,2100,2119)){
                                        $params[] = array( 'Cdr.extension' => $value);
                                    } else {
                                        $bad_request = true;              
                                    }
                         } else {
                              $bad_request = true;
                         }
                         break;


                        case 'user_id':
                         if(is_numeric($value)){
                                $params[] = array( 'Cdr.user_id' => $value);
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'limit':
                         if(is_numeric($value)){
                                $limit = $value;
                         } else {
                                $bad_request = true;              
                         }
                         break;

                        case 'page':
                         if(is_numeric($value)){
                                $page = $value;
                         } else {
                                $bad_request = true;              
                         }
                         break;

                   }                         
             }

     	     $this->Cdr->unbindModel(array('hasMany' => array('MonitorIvr')));
     	     $this->Cdr->unbindModel(array('belongsTo' => array('User')));
             $cdr = $this->Cdr->find('all', array('conditions' => $params, 'limit' => $limit, 'page' => $page));
             $this->Api->sendHeader($cdr,$bad_request,$not_found);

         }
     }
  
/*
 * Retrieve Freedom Fone services
 * Method: GET
 *
 * @params
 *      $type(string): service type (ivr, lam)
 * 
 * @return 
 *      $services (array)
 */
      function services($type = null){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;

           if($type == 'lam'){ 
                    $model = 'LmMenu';

           } elseif ($type == 'ivr'){ 
                    $model = 'IvrMenu';

           }
           else {
                echo header("HTTP/1.0 400 Bad Request");
           }

           $this->loadModel($model);
     	   $this->{$model}->unbindModel(array('hasMany' => array('MonitorIvr')));
           $this->{$model}->unbindModel(array('hasMany' => array('Mapping')));
           $services = $this->{$model}->find('all');
           $this->Api->sendHeader($services, $bad_request,$not_found);
      }

/*
 * Retrieve user details
 * Method: GET
 *
 * @params
 *      $id(int) User id
 * 
 * @return 
 *      $users (array)
 */
      function users($id = null){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $params = false;
           $bad_request = false;
           $not_found   = false;

             $this->loadModel('User');

             if($id) {
                    if(is_numeric($id)){
                        $params[] = array( 'User.id' => $id);
                    } else {
                        $bad_request = true;
                    }
              }

     	      $this->User->unbindModel(array('hasMany' => array('Message')));
     	      $this->User->unbindModel(array('hasMany' => array('Cdr')));
     	      $this->User->unbindModel(array('belongsTo' => array('Acl')));
              $user = $this->User->find('all', array('conditions' => $params));
              $this->Api->sendHeader($user,$bad_request,$not_found);
      }


       function system(){

           Configure::write('debug', 0);
           $this->autoRender = false;
           $this->layout = 'json/default';
           $this->RequestHandler->setContent('json','text/x-json');  

           $this->loadModel('Process');
 	   $system['dispatcher_version']   = $this->Process->version(3);
	   $system['fs_version']           = trim($this->Process->fsCommand("version"));
           $system['apache_version']       = urlencode(apache_get_version());
           $system['mysql_version']        = mysql_get_server_info();
           $system['freedomfone_version']  = VERSION;

           $system['svn_rev']              = $this->Process->getSVN();
           $os = php_uname('s');
           $cmd1 = exec('/usr/bin/lsb_release -d');
           $cmd2 = exec('/usr/bin/lsb_release -a');
           $release = $lsb = false;
           if($cmd1){ 
 	      $release = explode(':',$cmd1); 
           }
           if($cmd2){ 
 	      $lsb = explode(':',$cmd2); 
           }

           $system['operative_system'] = array('operative_system' => $os, 'release' => trim($release[1]), 'name' => trim($lsb[1]));


           $this->loadModel('Setting');
	   $settings = $this->Setting->find('all');
              foreach ($settings as $key => $value){
                switch ($value['Setting']['name']){
                       case 'language':
                       $system['language'] = Configure::read('LANGUAGES.'.$value['Setting']['value_string']);
                       break;

                       case 'domain':
                       $system['domain'] = urlencode($value['Setting']['value_string']);
                       break;
                
                       case 'ip_address':
                       $system['ip_address'] = $value['Setting']['value_string'];
                       break;

                       case 'timezone':
                       $system['timezone'] = urlencode($value['Setting']['value_string']);
                       break;

                       case 'country':
                       $country_id = $value['Setting']['value_string'];
                       break;

                       case 'prefix':
                       $system['prefix'] = $value['Setting']['value_int'];
                       break;
                  }
            }
           $this->loadModel('Country');
           $country = $this->Country->findById($country_id);
           $system['country'] = $country['Country']['name'];
           $data[]['system'] = $system;
           $this->Api->sendHeader( $data, false, false);
      }

}
?>