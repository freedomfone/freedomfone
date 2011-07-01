<?php
/****************************************************************************
 * status.ctp	- View status of current callback jobs
 * version 	- 2.5.1200
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
echo $html->addCrumb('Campaigns', '/campaigns');

$ivr_settings = Configure::read('IVR_SETTINGS');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

$order = array('Callback.campaign_id' => __('Campaign',true),'Campaign.created' => __('Created',true),'Callback.user_id' => __('User',true),'Callback.status' => __('Status',true), 'Callback.type' => __('Type',true),'Campaign.extension' => __('Service ID',true),'Callback.retries' => __('Attempts',true));

$dir   = array('ASC' => __('Ascending',true), 'DESC' => __('Descending',true));
     echo "<h1>".__("Call Status",true)."</h1>";


     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }
   
   
     echo $form->create("Callback");
     $input1 = $form->input('campaign_id',array('id'=>'ServiceType2','type'=>'select','options'=>$campaign,'label'=> false,'empty'=>'-- '.__('Select campaign',true).' --'));
     $input2 = $form->input('status',array('id'=>'ServiceType1','type'=>'select','options'=>$callback_default['status'],'label'=> false,'empty'=>'-- '.__('Select call status',true).' --'));         
     $input3 = $form->input('order',array('id'=>'ServiceType3','type'=>'select','options'=>$order,'label'=> false,'empty'=>'-- '.__('Order by',true).' --'));
     $input4 = $form->input('dir',array('id'=>'ServiceType4','type'=>'select','options'=>$dir,'label'=> false,'empty'=>'-- '.__('Direction',true).' --'));


     echo "<table cellspacing = 0 class ='none'>";
     echo $html->tableCells(array(array($input1, $input2), array($input3, $input4)),array('class'=>'none'),array('class'=>'none'));
     echo "</table>";

     $opt = array("update" => "service_div","url" => "disp","frequency" => "0.2" );
     echo $ajax->observeForm("CallbackAddForm",$opt);
     echo $form->end();
     echo "<div id='service_div' style=''></div>";


?>