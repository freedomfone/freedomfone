<?php
/****************************************************************************
 * add.ctp	- Create new callback campaign
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
echo $html->addCrumb('Campaign', '/campaign');
echo $html->addCrumb('Create', '/campaign/add');


$ivr_settings = Configure::read('IVR_SETTINGS');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

     echo "<h1>".__("Create Campaign",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }

     echo $form->create('Campaign',array('type' => 'post','action'=> 'add'));


      echo "<fieldset>";
      echo "<legend>".__('General',true)."</legend>";

      echo "<table cellspacing= 0 class= 'none' >";
      echo $html->tableCells(array (
          array(__("Name",true),	$form->input('name',array('label'=>false))),
          array(array(__("Set a unique name of the job",true),"colspan='2' class='formComment'")),
          array(__("Phone book",true),	$form->input('phone_book_id',array('options' => $phonebooks, 'label'=>false))),
          array(array(__("Select phonebook to dial.",true),"colspan='2' class='formComment'"))

          ), array('class'=>'none'),array('class'=>'none'));
       
      echo "</table>";
      echo "</fieldset>";





       foreach($lam as $key => $entry){
             $lam[$key] = $text->truncate($entry,$ivr_settings['showLengthMin'],false,true,false);
       }
       foreach($ivr as $key => $entry){
             $ivr[$key] = $text->truncate($entry,$ivr_settings['showLengthMin'],false,true,false);
       }
       foreach($selector as $key => $entry){
             $selector[$key] = $text->truncate($entry,$ivr_settings['showLengthMin'],false,true,false);
       }

        $default = false;
     	$options1=array('selector' =>'');
     	$options2=array('ivr' =>'');
     	$options3=array('lam' =>'');

        $attributes=array('legend'=>false,'default'=>$default);

        $radio1 = $form->radio('type',$options1,array('legend' => false, 'default' => true));
	$radio2 = $form->radio('type',$options2,$attributes);
       	$radio3 = $form->radio('type',$options3,$attributes);


        $row[]=array(
	$radio1,$form->input('selector_instance_id',array('type'=>'select','options' => $selector,'label'=>'','empty'=>'- '.__('Select entry',true).' -' )),
	$radio2,$form->input('ivr_instance_id',array('type'=>'select','options' => $ivr,'label'=>'','empty'=>'- '.__('Select entry',true).' -' )),
	$radio3,$form->input('lam_instance_id',array('type'=>'select','options' => $lam,'label'=>'','empty'=>'- '.__('Select entry',true).' -' )),
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
       $row[0] = array(__("Max retries",true), $form->input('max_retries', array('options' => $callback_default['max_retries'],'label'=>false, 'selected' => $maxretries)));
       $row[1] = array(array(__("Default number of retries for a callback.",true),"colspan='2' class='formComment'"));

       $row[2] = array(__("Retry interval",true), $form->input('retry_interval', array('options' => $callback_default['retry_interval'],'label'=>false, 'selected' => $retryinterval)));
       $row[3] = array(array(__("Interval (seconds) beween callback attempts to a single user.",true),"colspan='2' class='formComment'"));

       $row[4] = array(__("Max duration",true), $form->input('max_duration', array('options' => $callback_default['max_duration'],'label'=>false, 'selected' => $maxduration)));
       $row[5] = array(array(__("Maxumum duration (seconds) for a callback call.",true),"colspan='2' class='formComment'"));



       echo $html->tableCells($row,array('class' => 'none'),array('class' => 'none'));
       echo "</table>";
       echo "</fieldset>";





       echo "<fieldset>";
       echo "<legend>".__('Start and end time',true)."</legend>";
       echo "<div class='formComment'>".__("The callback campaign will start at Start Time. No further attempts for outgoing calls will be made after the End Time.",true)."</div>";

       echo "<table cellspacing = 0 class='none'>";
       echo $html->tableCells(array (
            array(__("Start time",true),	$form->input('start_time',array('label'=>false,'type' => 'datetime','interval' => 15 ))),
            array(__("End time",true),	        $form->input('end_time',array('label'=>false,'type' => 'datetime','interval' => 15,'selected'=> time()+3600))),
      ),array('class'=>'none'),array('class'=>'none'));
      echo "</table>";
      echo "</fieldset>";

      echo $form->end(__('Save',true));



?>

