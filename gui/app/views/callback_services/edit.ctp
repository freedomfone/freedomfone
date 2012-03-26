<?php
/****************************************************************************
 * editctp	- Edit Callback Service
 * version 	- 2.5.1450
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
echo $html->addCrumb(__('Callback Service',true), '/callback_services');
echo $html->addCrumb(__('Edit',true), '/callback_services/edit');


$ivr_settings = Configure::read('IVR_SETTINGS');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

        if($this->data){ $data = $this->data;}

     echo "<h1>".__("Edit Callback Service",true).": ".$data['CallbackService']['code']."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }

     echo $form->create('CallbackService',array('type' => 'post','action'=> 'edit', 'enctype' => 'multipart/form-data'));
     echo $form->input('id',array('type' => 'hidden','value'=> $data['CallbackService']['id']));
     echo $form->input('status',array('type' => 'hidden','value'=> $data['CallbackService']['status']));
     echo $form->input('code',array('type' => 'hidden','value'=> $data['CallbackService']['code']));
     echo $form->input('nf_campaign_id',array('type' => 'hidden','value'=> $data['CallbackService']['nf_campaign_id']));


       foreach($lam as $key => $entry){
             $lam[$key] = $text->truncate($entry,30,false,true,false);
       }
       foreach($ivr as $key => $entry){
             $ivr[$key] = $text->truncate($entry,30,false,true,false);
       }
       foreach($selector as $key => $entry){
             $selector[$key] = $text->truncate($entry,30,false,true,false);
       }


     	$options1=array('selector' =>'');
     	$options2=array('ivr' =>'');
     	$options3=array('lam' =>'');

        $selected_selector = $selected_ivr = $selected_lam = $default1 = $default2 = $default3 = false;

        switch($data['CallbackService']['type']){
        
                case 'selector':
                $selected_selector = $data['CallbackService']['instance_id'];
                $default1 = true;
                break;

                case 'ivr':
                $selected_ivr = $data['CallbackService']['instance_id'];
                $default2 = true;
                break;

                case 'lam':
                $selected_lam = $data['CallbackService']['instance_id'];
                $default3 = true;
                break;


        }

        $attributes1 = array('legend'=>false,'default'=>$default1);
        $attributes2 = array('legend'=>false,'default'=>$default2);
        $attributes3 = array('legend'=>false,'default'=>$default3);

        $radio1 = $form->radio('type',$options1,$attributes1);
	$radio2 = $form->radio('type',$options2,$attributes2);
       	$radio3 = $form->radio('type',$options3,$attributes3);

        $row[]=array(
	$radio1,$form->input('selector_instance_id',array('type'=>'select','options' => $selector,'label'=>'','empty'=>'- '.__('Select entry',true).' -' ,'selected' => $selected_selector)),
	$radio2,$form->input('ivr_instance_id',array('type'=>'select','options' => $ivr,'label'=>'','empty'=>'- '.__('Select entry',true).' -' ,'selected' => $selected_ivr)),
	$radio3,$form->input('lam_instance_id',array('type'=>'select','options' => $lam,'label'=>'','empty'=>'- '.__('Select entry',true).' -' ,'selected' => $selected_lam)),
	);


       $titles = array(array(__('Selector',true),array('colspan'=>2,'align' => 'center')),array(__('Voice Menu',true),array('colspan'=>2,'align' => 'center')),array(__('Leave-a-Message',true),array('colspan'=>2,'align' => 'center')));

       echo "<fieldset>";
       echo "<legend>".__('Service',true)."</legend>";

       echo "<table cellspacing=0 border='0' class='none'>";
       echo $html->tableCells(array($titles),array('class'=>'none'),array('class'=>'none'));
       echo $html->tableCells($row, array('class' =>'none'),array('class' =>'none'));
       echo "</table>";
       echo "</fieldset>";


       echo "<fieldset>";
       echo "<legend>".__('Settings',true)."</legend>";
       echo "<table cellspacing=0 border='0' class='none'>";
       $row[0] = array(__("Max retries",true), $form->input('max_retries', array('options' => $callback_default['max_retries'],'label'=>false, 'selected' => $data['CallbackService']['max_retries'])));
       $row[1] = array(array(__("Default number of retries for a callback.",true),"colspan='2' class='formComment'"));

       $row[2] = array(__("Retry interval",true), $form->input('retry_interval', array('options' => $callback_default['retry_interval'],'label'=>false, 'selected' => $data['CallbackService']['retry_interval'])));
       $row[3] = array(array(__("Interval (seconds) beween callback attempts to a single user.",true),"colspan='2' class='formComment'"));

       $row[4] = array(__("Max duration",true), $form->input('max_duration', array('options' => $callback_default['max_duration'],'label'=>false, 'selected' => $data['CallbackService']['max_duration'])));
       $row[5] = array(array(__("Maximum duration (seconds) for a callback call.",true),"colspan='2' class='formComment'"));

       $row[6] = array(__("Max calls per user",true), $form->input('max_calls_user', array('options' => $callback_default['max_calls_user'],'selected' => $data['CallbackService']['max_calls_user'], 'label'=>false )));
       $row[7] = array(array(__("Maximum number of calls per user for this service.",true),"colspan='2' class='formComment'"));

       $row[8] = array(__("Max calls per user and day",true), $form->input('max_calls_user_day', array('options' => $callback_default['max_calls_user_day'],'selected' => $data['CallbackService']['max_calls_user_day'], 'label'=>false )));
       $row[9] = array(array(__("Maximum number of calls per user/day (24h) for this service.",true),"colspan='2' class='formComment'"));

       $row[10] = array(__("Max calls",true), $form->input('max_calls_total', array('options' => $callback_default['max_calls_total'],'selected' => $data['CallbackService']['max_calls_total'], 'label'=>false )));
       $row[11] = array(array(__("Maximum number of calls for this service.",true),"colspan='2' class='formComment'"));


       echo $html->tableCells($row,array('class' => 'none'),array('class' => 'none'));
       echo "</table>";
       echo "</fieldset>";





       echo "<fieldset>";
       echo "<legend>".__('Start and end time',true)."</legend>";
       echo "<div class='formComment'>".__("The Callback Service will be available from Start Time. No outgoing calls will be made after the End Time.",true)."</div>";

       echo "<table cellspacing = 0 class='none'>";
       echo $html->tableCells(array (
            array(__("Start time",true),	$form->input('start_time',array('label'=>false,'type' => 'datetime','interval' => 15,'selected' => $data['CallbackService']['start_time'] ))),
            array(__("End time",true),	        $form->input('end_time',array('label'=>false,'type' => 'datetime','interval' => 15,'selected'=> $data['CallbackService']['end_time']))),
      ),array('class'=>'none'),array('class'=>'none'));
      echo "</table>";
      echo "</fieldset>";

      echo $form->end(__('Save',true));



?>

