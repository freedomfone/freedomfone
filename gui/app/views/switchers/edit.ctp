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

$settings = Configure::read('SWITCHER_SETTINGS');

$commentTitle   = "<span class='formHelp'>".__("Name of language switcher",true)."</span>";
$commentInstruction    = "<span class='formHelp'>".__("Brief instruction how to reach each language menu.",true)."</span>";
$commentInvalid = "<span class='formHelp'>".__("Warning that the user has pressed an invalid option.",true)."</span>";



echo "<h1>".__("Edit language switcher",true)."</h1>";

          if($this->data){

                $switcher = $this->data['Switcher'];

                if ($messages = $session->read('Message.multiFlash')) {
                              foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
                }

                $path = $settings['path'].$settings['dir_menu'];

                echo $form->create('Switcher', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
                echo $form->input('id',array('type'=>'hidden'));
                
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
                 $step1[1] = $form->input('message_instruction',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentInstruction, 'between'=>'<br />' ));
                 $step1[2] = $form->input('SwitcherFile.file_instruction', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step1[4] = $this->element('player',array('host'=>$settings['host'],'path'=>$path,'file'=>$this->data['Switcher']['id'].'_instruction','title'=>__('Instructions Message',true),'id'=>'short'));

                 if($switcher['file_instruction']){
	                $step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/switchers/download/{$this->data['Switcher']['id']}/short",null, null, false);
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
                 $step2[4] = $this->element('player',array('host'=>$settings['host'],'path'=>$path,'file'=>$this->data['Switcher']['id'].'_invalid','title'=>__('Invalid Message',true),'id'=>'short'));

                 if($switcher['file_invalid']){
	                $step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/switchers/download/{$this->data['Switcher']['id']}/short",null, null, false);
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
                

                foreach($ivr as $key => $entry){
                             $_ivr[$entry['ivr_menus']['id']] = $entry['ivr_menus']['title'];
                 }

                 foreach($lam as $key => $entry){
                            $_lam[$entry['lm_menus']['id']] = $entry['lm_menus']['title'];
                 }

     	         $options1=array('ivr_menus' =>'  '.__('Voice Menu',true));
     	         $options2=array('lm_menus' =>'  '.__('Leave-a-message',true));
                 $attributes=array('legend'=>false,'default'=>'ivr_menus');

                 $radio1 = $form->radio('type',$options1,$attributes);
	         $radio2 = $form->radio('type',$options2,$attributes);
                 $row[] = array("",$radio1,$radio2);

                 $model = $switcher['type'];

                 $anti_model = 'lm_menus';
                 if($model == 'lm_menus') { 
                           $anti_model = 'ivr_menus';
                 } 

                 $this->data['Services'][$model][1]=$switcher['id_1'];
                 $this->data['Services'][$model][2]=$switcher['id_2'];
                 $this->data['Services'][$model][3]=$switcher['id_3'];
                 $this->data['Services'][$anti_model][1]=false;
                 $this->data['Services'][$anti_model][2]=false;
                 $this->data['Services'][$anti_model][3]=false;
                 $services = $this->data['Services'];


                 for($i=1;$i<=3;$i++){

                        $row[]=array( array("<h3>".__('Press',true)." ".$i."</h3>", array('width'=>'100')), 
                       
                        $form->input('Services.ivr_menus.'.$i,array('type'=>'select','options' => $_ivr,'label'=>'','selected' => $services['ivr_menus'][$i], 'empty'=>'- '.__('Select voice menu',true).' -' )), 
                        $form->input('Services.lm_menus.'.$i,array('type'=>'select','options' => $_lam,'label'=>'', 'selected' => $services['lm_menus'][$i],'empty'=>'- '.__('Select Leave-a-message menu',true).' -' )));
                  }

                  echo "<table width='700px'>";
                  echo $html->tableCells($row);
                  echo "</table>";

                  echo $form->end(__('Save',true)); 
                  echo "</fieldset>";
     }

     else {

         echo "<h1>".__("No languge switcher with this id exists",true)."</h1>";

     }

?>



