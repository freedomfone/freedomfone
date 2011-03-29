<?php
/****************************************************************************
 * manage_batch.ctp	- Manage  (stop and start) callback batches 
 * version 	        - 2.5.1200
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
echo $html->addCrumb('Callback', '/callbacks');
echo $html->addCrumb('Manage batches', '/callbacks/manage_batch');

$ivr_settings = Configure::read('IVR_SETTINGS');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

$order = array('batch_id' => __('Batch id',true),'created' => __('Created',true),'user_id' => __('User',true),'status' => __('Status',true), 'type' => __('Type',true),'extension' => __('Service ID',true),'retry' => __('Attempts',true));
$dir   = array('ASC' => __('Ascending',true), 'DESC' => __('Descending',true));

     echo "<h1>".__("Manage batches",true)."</h1>";


     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }
   



     echo $form->create("Callback");
     $input = $form->input('batch_id',array('id'=>'ServiceType2','type'=>'select','options'=>$batch_id,'label'=> false,'empty'=>'-- '.__('Select batch',true).' --'));
   

     echo "<table cellspacing = 0 class ='none'>";
     echo $html->tableCells(array($input), array('class'=>'none'),array('class'=>'none'));
     echo "</table>";

     $opt = array("update" => "service_div","url" => "disp_manage","frequency" => "0.2" );
     echo $ajax->observeForm("CallbackAddForm",$opt);
     echo $form->end();
     echo "<div id='service_div' style=''></div>";


?>

