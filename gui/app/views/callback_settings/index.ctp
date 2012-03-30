<?php
/****************************************************************************
 * index.ctp	- Display callback settings
 * version 	- 2.0.1200
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

echo $html->addCrumb(__('Callback Dialer',true), '');
echo $html->addCrumb(__('Campaigns and Callback Settings',true), '/callback_settings');
$default  = Configure::read('CALLBACK_DEFAULT');


echo "<h1>".__("Campaigns and Callback settings",true)."</h1>";

   	  if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         }


         if($this->data){

         echo $form->create('CallbackSetting', array('type' => 'post', 'action' => 'index','enctype' => 'multipart/form-data'));
         echo $form->input('id',array('type'=>'hidden','value'=>$this->data['CallbackSetting']['id']));

         echo "<table cellspacing=0 class='stand-alone'>";
//     $row[0] = array(__("SMS code",true),		$form->input('sms_code', array('type'=>'text','size' => '10','label'=>false)));
//     $row[1] = array(array(__("Code for incoming SMS to generate a Callback",true),"colspan='2' class='formComment'"));
//     $row[2] = array(__("Default response",true), $form->input('response_type', array('options' => $callback_default['response_type'],'label' => false, 'selected' => $this->data['CallbackSetting']['response_type'])));
//     $row[3] = array(array(__("Default callback response",true),"colspan='2' class='formComment'"));
//     $row[4] = array(__("Max calls",true), $form->input('limit_user', array('options' => $user_limit,'label'=>false, 'selected' => $this->data['CallbackSetting']['limit_user'])));
//     $row[5] = array(array(__("Limit the number of calls per user per day.",true),"colspan='2' class='formComment'"));
//     $row[6] = array(__("Period",true), $form->input('limit_time', array('options' => $time_limit,'label'=>false, 'selected' => $this->data['CallbackSetting']['limit_time'])));
//     $row[7] = array(array(__("Limit the number of calls per user per day.",true),"colspan='2' class='formComment'"));

       $row[0] = array(__("Max retries",true), $form->input('max_retries', array('options' => $default['max_retries'],'label'=>false, 'selected' => $this->data['CallbackSetting']['max_retries'])));
       $row[1] = array(array(__("Default number of retires for a callback.",true),"colspan='2' class='formComment'"));

       $row[2] = array(__("Retry interval",true), $form->input('retry_interval', array('options' => $default['retry_interval'],'label'=>false, 'selected' => $this->data['CallbackSetting']['retry_interval'])));
       $row[3] = array(array(__("Interval between callback attempts to a single user.",true),"colspan='2' class='formComment'"));

       $row[4] = array(__("max duration",true), $form->input('max_duration', array('options' => $default['max_duration'],'label'=>false, 'selected' => $this->data['CallbackSetting']['max_duration'])));
       $row[5] = array(array(__("Maximum duration for a callback call.",true),"colspan='2' class='formComment'"));

       echo $html->tableCells($row,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
       echo "</table>";
       echo $form->end(__('Save',true)); 

       }
?>

