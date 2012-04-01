<?php
/* SVN FILE: $Id$ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */


class AppModel extends Model {

     function sanitizePhoneNumber($number){

       if($number){

        if(preg_match('/%/',$number)){ $number = urldecode($number);}
       
         if(preg_match('/^[%2B0-9]+$/', $number)){


          $entry = $this->query("select value_int from settings where name = 'prefix'");
          $prefix =  $entry[0]['settings']['value_int'];


          //Starts with + sign
          if (preg_match('/^[+]{1,1}[0-9]{4,25}$/', $number)){

           //Replace +  sign with 00
           $number = preg_replace (array('/^[+]/'), array('00'),$number);           

          } 
          //Starts without country prefix
          elseif (!preg_match('/^[+]{1,1}[0-9]{4,25}$/', $number) && !preg_match('/^[00]{2,2}[0-9]{4,25}$/', $number)){
      
            //Append 00 and strip first 0 (if any)
            $number = '00'.$prefix.ltrim($number,'0');

          }
         }
        }

        return $number;


     }

     function headerGetStatus($header){

              $status = false;

              switch(trim($header)){

                case 'HTTP/1.1 201 CREATED':
                $status = 1;
                break;

              
                case 'HTTP/1.1 409 CONFLICT':
                $status = 2;
                break;

                case 'HTTP/1.1 500 INTERNAL SERVER ERROR':
                $status = 3;
                break;

                case 'HTTP/1.1 204 NO CONTENT':
                $status = 4;
                break;

                case 'HTTP/1.1 400 BAD REQUEST':
                $status = 5;
                break;

                case 'HTTP/1.1 401 UNAUTHORIZED':
                $status = 6;
                break;

                case 'HTTP/1.1 200 OK':
                $status = 7;
                break;


              }


              return $status;

     }


     function updateUserStatistics($proto,$sender,$application, $update){

              App::import('model','User');
              $user = new User();
              $created = time();

              //Determine state (skype or default) and fetch user data
	      if( strcasecmp($proto,'skype')== 0) { 
                  $state = 'skype';
                  $userData = $user->find('first',array('conditions' => array('skype' => $sender)));

              } elseif( strcasecmp($proto,'gsm') ==0  || strcasecmp($proto,'sip') == 0){  
                  $state = 'default';
                  $userData = $user->PhoneNumber->find('first',array('conditions' => array('PhoneNumber.number' => $sender)));
              }


              //If User exists
              if ($userData){
                     $user_id = $userData['User']['id'];
	             $count = $userData['User'][$update]+1;
                     $user->read(null, $userData['User']['id']);
	 	     $user->set(array($update => $count,'last_app'=>$application,'last_epoch'=>$created));
                     $user->save();           

	      } else {
              //If New User

                   if($state == 'default'){
                           $new_user =array('created'=> $created,'new'=>1,
                                            $update  =>1,'first_app'=>$application,
                                            'first_epoch' => $created, 'last_app'=>$application,
                                            'last_epoch'=>$created, 'acl_id' => 1,
                                            'name' => __('Unknown user',true));

                           if ($user->save($new_user)){
                                    $user_id = $user->getLastInsertId();
                                    $phonenumber = array('user_id' => $user_id, 'number' => $sender);
                                    $user->PhoneNumber->saveAll($phonenumber);
                           }                                  

                    } elseif ( $state == 'skype') {

                                 $new_user =array('User.skype' => $sender,'created'=> $created,'new'=>1,'count_ivr'=>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl_id'=>1);
                                 $user->save($new_user);
                                 $user_id = $user->getLastInsertId();
  
                    }
	      }

              return $user_id;

       }

/**
* Overrides the Core invalidate function from the Model class
* with the addition to use internationalization (I18n and L10n)
* @param string $field Name of the table column
* @param mixed $value The message or value which should be returned
* 2009-07-27 ms
*/

        function invalidate($field, $value = null) {
                 if (!is_array($this->validationErrors)) {
                    $this->validationErrors = array();
                 }
                 if(empty($value)) {
                    $value = true;
                 }
                 if (is_array($value)) {
                    if (count($value) > 2) { # string %s %s string, trans1, trans2
                       $translatedValue = sprintf(__($value[0], true), $value[1], $value[2]);
                     } else { # string %s string, trans1
                       $translatedValue = sprintf(__($value[0], true),$value[1]);
                     }
                     $this->validationErrors[$field] = $translatedValue;
                 } else {
                   $this->validationErrors[$field] = __($value, true);
                }
           }


}
?>