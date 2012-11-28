<?php
/****************************************************************************
 * status.ctp	- View status of current callback jobs (callback service)
 * version 	- 2.5.1300
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
echo $html->addCrumb(__('Callback Services',true), '/callback_services');
echo $html->addCrumb(__('Status',true), '/callback_services/status');

$ivr_settings = Configure::read('IVR_SETTINGS');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

foreach($callback_default['callback_status'] as $key => $entry){
	 $callback_default['callback_status'][$key] = __($entry,true);
}


$type = array('SMS' =>__('SMS',true), 'TICKLE' =>__('Tickle',true));
$order = array('Callback.callback_service_id' => __('Callback service',true),'CallbackService.created' => __('Created',true),'Callback.user_id' => __('User',true),'Callback.status' => __('Status',true), 'Callback.type' => __('Type',true),'CallbackService.extension' => __('Service ID',true),'Callback.retries' => __('Attempts',true));
$dir   = array('ASC' => __('Ascending',true), 'DESC' => __('Descending',true));
     echo "<h1>".__("Callback Service Status",true)."</h1>";


     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }
   
   

     echo $form->create("Callback");
     $input1 = $form->input('status',array('id'=>'ServiceType1','type'=>'select','options'=>$callback_default['callback_status'],'label'=> false,'empty'=>'-- '.__('Select status',true).' --'));         
     $input2 = $form->input('callback_service_id',array('id'=>'ServiceType2','type'=>'select','options'=>$callbackService,'label'=> false,'empty'=>'-- '.__('Select callback service',true).' --'));
     $input3 = $form->input('order',array('id'=>'ServiceType3','type'=>'select','options'=>$order,'label'=> false,'empty'=>'-- '.__('Order by',true).' --'));
     $input4 = $form->input('dir',array('id'=>'ServiceType4','type'=>'select','options'=>$dir,'label'=> false,'empty'=>'-- '.__('Direction',true).' --'));
     $input5 = $form->input('type',array('id'=>'ServiceType5','type'=>'select','options'=>$type,'label'=> false,'empty'=>'-- '.__('Type',true).' --'));


     echo "<table cellspacing = 0 class ='none'>";
     echo $html->tableCells(array(array($input1, $input2, $input5), array($input3, $input4, false)),array('class'=>'none'),array('class'=>'none'));
     echo "</table>";

     $opt = array("update" => "service_div","url" => "disp","frequency" => "0.1" );
     echo $ajax->observeForm("CallbackAddForm",$opt);
     echo $form->end();
     echo "<div id='service_div' style=''></div>";


?>