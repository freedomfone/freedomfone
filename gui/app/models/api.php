<?php
/****************************************************************************
 * api.php	- Model for Freedom Fone public API
 * version 	- 2.5.1350
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


class Api extends AppModel{

      var $name = 'Api';
      var $useTable = false;


/*
 * Validation of POST data
 *
 * @params
 *      $post_vars(array)
 *      $keys(array)
 *
 * @return 
 *      boolean
 */
  function validPostVars($post_vars,$keys){

           $status = true;

           foreach($post_vars as $key => $var){

             if(!in_array($key,$keys)){
                $status = false;
             
             }
                              
           }
           return $status;

  }

/*
 * Validation of integer range
 *
 * @params
 *      $data(int) data to be within min and max
 *      $min(int)
 *      $max(int)
 *
 * @return 
 *      boolean
 */
      function validRange($data, $min, $max){

               if($data >= $min  && $data <= $max){
                          return true;
                          } else {

                          return false;
                          }

      }



/*
 * Add Leave-a-message mp3 files to object
 *
 * @params
 *      $lm_menu(array) 
 *
 * @return 
 *      $lm_menu(array)
 */
    
    function addLmMenuFiles($lm_menu){

           $lm_settings = Configure::read('LM_SETTINGS');
           foreach($lm_menu as $key => $entry) {

               $path = $lm_settings['path'].$entry['LmMenu']['instance_id']."/".$lm_settings['dir_menu'];

               if(file_exists($path.'lmWelcome.mp3')){
                 $lm_menu[$key]['LmMenu']['lmWelcome'] = urlencode($path.'lmWelcome.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmWelcome'] = false;
               }


               if(file_exists($path.'lmInform.mp3')){
                 $lm_menu[$key]['LmMenu']['lmInform'] = urlencode($path.'lmInform.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmInform'] = false;
               }

               if(file_exists($path.'lmInvalid.mp3')){
                 $lm_menu[$key]['LmMenu']['lmInvalid'] = urlencode($path.'lmInvalid.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmInvalid'] = false;
               }

               if(file_exists($path.'lmLong.mp3')){
                 $lm_menu[$key]['LmMenu']['lmLong'] = urlencode($path.'lmLong.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmLong'] = false;
               }

               if(file_exists($path.'lmSelect.mp3')){
                 $lm_menu[$key]['LmMenu']['lmSelect'] = urlencode($path.'lmSelect.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmSelect'] = false;
               }

               if(file_exists($path.'lmDelete.mp3')){
                 $lm_menu[$key]['LmMenu']['lmDelete'] = urlencode($path.'Delete.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmDelete'] = false;
               }

               if(file_exists($path.'lmSave.mp3')){
                 $lm_menu[$key]['LmMenu']['lmSave'] = urlencode($path.'lmSave.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmSave'] = false;
               }

               if(file_exists($path.'lmGoodbye.mp3')){
                 $lm_menu[$key]['LmMenu']['lmGoodbye'] = urlencode($path.'lmGoodbye.mp3');
               } else {
                 $lm_menu[$key]['LmMenu']['lmGoodbye'] = false;
               }

           }
 
           return $lm_menu;
       }

/*
 * Get mp3 file to Message
 *
 * @params
 *      $filename(string)
 *      $instance_id(id) 
 *
 * @return 
 *      $path(string)
 */
    
    function getMessageAudio($filename,$instance_id){

           $ext  ='mp3';
           $lm_settings = Configure::read('LM_SETTINGS');
           $path = $lm_settings['path'].$instance_id."/".$lm_settings['dir_messages'];

               if(file_exists($file = $path.$filename.'.'.$ext)){
                 return urlencode($file);
               } else {
                 return __('No file found',true);
               }

    }

/*
 * Output HTTP header
 *
 * @params
 *      $data(array) data to be sent out
 *      $bad_request(bool)
 *      $not_found(bool)
 *
 * @return 
 *      $path(string)
 */
    function sendHeader($data,$bad_request, $not_found){

           if($bad_request){ 
                 echo header("HTTP/1.0 400 Bad Request");
           } elseif($not_found){
                 echo header("HTTP/1.0 404 Not Found");
           } else {
                echo json_encode($data);     
           } 

     
    }

}

?>
