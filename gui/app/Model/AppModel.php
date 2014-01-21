<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
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

                case 'HTTP/1.0 200 OK':
                $status = 1;
                break;

                case 'HTTP/1.1 200 OK':
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



              }


              return $status;

     }


     function updateCallerStatistics($proto,$sender,$application, $update){

              App::import('model','Caller');
              $caller = new Caller();
              $created = time();

              //Determine state (skype or default) and fetch caller data
	      if( strcasecmp($proto,'skype')== 0) { 
                  $state = 'skype';
                  $callerrData = $caller->find('first',array('conditions' => array('skype' => $sender)));

              } elseif( strcasecmp($proto,'gsm') ==0  || strcasecmp($proto,'sip') == 0){  
                  $state = 'default';
                  $callerData = $caller->PhoneNumber->find('first',array('conditions' => array('PhoneNumber.number' => $sender)));
              }


              //If Caller exists
              if ($callerData){
                     $caller_id = $callerData['Caller']['id'];
	             $count = $callerrData['Caller'][$update]+1;
                     $caller->read(null, $callerData['Caller']['id']);
	 	     $caller->set(array($update => $count,'last_app'=>$application,'last_epoch'=>$created));
                     $caller->save();           

	      } else {
              //If New Caller

                   if($state == 'default'){
                           $new_caller =array('created'=> $created,'new'=>1,
                                            $update  =>1,'first_app'=>$application,
                                            'first_epoch' => $created, 'last_app'=>$application,
                                            'last_epoch'=>$created, 'acl_id' => 1,
                                            'name' => __('Unknown user',true));

                           if ($caller->save($new_caller)){
                                    $caller_id = $caller->getLastInsertId();
                                    $phonenumber = array('caller_id' => $caller_id, 'number' => $sender);
                                    $caller->PhoneNumber->saveAll($phonenumber);
                           }                                  

                    } elseif ( $state == 'skype') {

                                 $new_caller =array('Caller.skype' => $sender,'created'=> $created,'new'=>1,'count_ivr'=>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl_id'=>1);
                                 $caller->save($new_caller);
                                 $caller_id = $caller->getLastInsertId();
  
                    }
	      }

              return $caller_id;

       }



     function protoToChannel($proto){

              $channel = 'N/A';


              switch($proto){

              case 'GSM':
              $channel = 'OfficeRoute';
              break;

              case 'SMS':
              $channel = 'Mobigater';
              break;


              }

              return $channel;

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





	function getChannel($proto,$login){


	  if($proto == 'officeroute'){

	    $or = substr($str, 2, 1); //returns the 3rd character
	    $sim = substr($str, 6, 1); //returns the 7th character

	    $pos = ($or-1)*4+$sim;

	    $this->loadModel('OfficeRoute');
	    $channel = $this->OfficeRoute->findById($pos);
	    $imsi = $channel['OfficeRoute']['IMSI'];

	    debug($channel);

	    return $login."-".$imsi;
	  } else {

	  return $login;

	  }
	}


}
