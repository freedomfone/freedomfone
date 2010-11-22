<?php
/****************************************************************************
 * edit.ctp	- Edit language switcher
 * version 	- 1.0.360
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

$settings = Configure::read('IVR_SETTINGS');

$commentTitle   = "<span class='formHelp'>".__("Name of language switcher",true)."</span>";
$commentLong    = "<span class='formHelp'>".__("Brief instruction how to reach each language menu.",true)."</span>";
$commentInvalid = "<span class='formHelp'>".__("Warning that the user has pressed an invalid option.",true)."</span>";



echo "<h1>".__("Edit language switcher",true)."</h1>";

          if($this->data){

                $switcher = $this->data['IvrMenu'];

                if ($messages = $session->read('Message.multiFlash')) {
                              foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
                }

                $path = $settings['path'].$switcher['instance_id'].'/'.$settings['dir_menu'];

                echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'edit_switcher','enctype' => 'multipart/form-data') );
                echo $form->input('id',array('type'=>'hidden'));
                echo $form->input('instance_id',array('type'=>'hidden','value'=>$switcher['instance_id']));
                
                //** TITLE **///
                echo "<fieldset>";
                echo "<legend>".__('Title',true)."</legend>";
                echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle));
                echo "</fieldset>";

                //** MENU INSTRUCTIONS **///
                echo "<fieldset>";
                echo "<legend>".__('Menu Instructions',true)."</legend>";

               
                $step1[3]=false; 
                $step2[3]=false;


                 //**** 1. Instructions ****//
                 $step1[0] = "<h3>1. ".__('Instructions',true)."</h3>";
                 $step1[1] = $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'between'=>'<br />' ));
                 $step1[2] = $form->input('SwitcherFile.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step1[4] = $this->element('player',array('host'=>$settings['host'],'path'=>$path,'file'=>'file_long','title'=>__('Instructions Message',true),'id'=>'short'));

                 if($switcher['file_long']){
	                $step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['id']}/short",null, null, false);
	         }

                 echo "<table>";
                 echo $html->tableCells(array(
		      array(array($step1[0],array('colspan'=>3))),	
		      array(array($step1[1],array('colspan'=>3))),	
		      array($step1[2],array($step1[3],array('valign'=>'bottom')),array($step1[4],array('valign'=>'bottom')))));
                 echo "</table>";


                 //**** 2. Invalid ****//
                 $step2[0] = "<h3>2. ".__('Invalid option',true)."</h3>";
                 $step2[1] = $form->input('message_invalid',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentInvalid, 'between'=>'<br />' ));
                 $step2[2] = $form->input('SwitcherFile.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step2[4] = $this->element('player',array('host'=>$settings['host'],'path'=>$path,'file'=>'file_invalid','title'=>__('Invalid Message',true),'id'=>'short'));

                 if($switcher['file_invalid']){
	                $step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['id']}/short",null, null, false);
	         }

                 echo "<table>";
                 echo $html->tableCells(array(
		      array(array($step2[0],array('colspan'=>3))),	
		      array(array($step2[1],array('colspan'=>3))),	
		      array($step2[2],array($step2[3],array('valign'=>'bottom')),array($step2[4],array('valign'=>'bottom')))));
                 echo "</table>";
	

    
                echo "</fieldset>";

                //** SERVICES **//
                echo "<fieldset>";
                echo "<legend>".__('Services',true)."</legend>";



	echo $form->create("IvrMenu");
	$opt = array('ivr'=>'Voice Menus','lam'=>'Leave-a-message');
	echo $form->input('switcher_type',array('id'=>'ServiceType','type'=>'select','options'=>$opt,'label'=> false,'empty'=>'-- '.__('Select service',true).' --'));


	$opt = array(
		"update" => "service_div",
		"url" => "disp",
		"frequency" => "0.1"
	);

	echo $ajax->observeField("ServiceType",$opt);
	echo $form->end();

	echo "<div id='service_div' style=''></div>";
        echo "</fieldset>";
     }

     else {

         echo "<h1>".__("No languge switcher with this id exists",true)."</h1>";

     }

?>



