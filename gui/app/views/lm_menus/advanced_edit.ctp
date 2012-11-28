<?php
/****************************************************************************
 * advanced_edit.ctp	- AJAX view for advanced LAM settings (edit LAM)
 * version 	        - 2.0.1041
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

$lm_settings = Configure::read('LM_SETTINGS');
$lm_default  = Configure::read('LM_DEFAULT');

$commentInvalid   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInvalidMessage']."</div>";
$commentLong      = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmLongMessage']."</div>";
$commentSelect    = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSelectMessage']."</div>";
$commentDelete    = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmDeleteMessage']."</div>";
$commentSave      = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSaveMessage']."</div>";
$commentGoodbye   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmGoodbyeMessage']."</div>";
$path = $lm_settings['path'].$this->data['LmMenu']['instance_id']."/".$lm_settings['dir_menu'];

$input3_3 = $input3_4 = false;
$input4_3 = $input4_4 = false;
$input5_3 = $input5_4 = false;
$input6_3 = $input6_4 = false;
$input7_3 = $input7_4 = false;
$input8_3 = $input8_4 = false;


     echo $html->div('instruction', __("If you choose to enable the advanced Leave-a-Message service, you should ask the caller to finish the call by pressing # instead of hanging up (in Step 2).",true));


     // ** Invalid **//
     echo "<fieldset><legend>".__('Step 3: Invalid message',true)."</legend>";
     $input3_1 = $form->input('LmMenuFile.lmInvalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input3_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmInvalid','title'=>__('Invalid Message',true),'id'=>'invalid')),array('valign'=>'bottom'));
     $input3_5 = $form->input('LmMenu.lmInvalidMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentInvalid,'between'=>'<br />' )); 

     $lines3[0] = array(array($input3_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmInvalid.mp3')){ 
	    $input3_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Invalid",null, null, false);
      } 


     $lines3[1] = array($input3_1,array($input3_3,array('valign'=>'bottom','width'=>'25')), $input3_2);
     
     echo "<table cellspacing = 0 class= 'none'>";
     echo $html->tableCells($lines3,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Long **//
     echo "<fieldset><legend>".__('Step 4: Long message',true)."</legend>";
     $input4_1 = $form->input('LmMenuFile.lmLong', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input4_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmLong','title'=>__('Long Message',true),'id'=>'long')),array('valign'=>'bottom'));
     $input4_5 = $form->input('LmMenu.lmLongMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentLong,'between'=>'<br />' )); 

     $lines4[0] = array(array($input4_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmLong.mp3')){ 
            $input4_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Long",null, null, false);
	
     } 



     $lines4[1] = array($input4_1,array($input4_3,array('valign'=>'bottom','width'=>'25')), $input4_2);
          
     echo "<table cellspacing = 0 class= 'none'>"; 
     echo $html->tableCells($lines4,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Select **//
     echo "<fieldset><legend>".__('Step 5: Select message',true)."</legend>";
     $input5_1 = $form->input('LmMenuFile.lmSelect', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input5_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmSelect','title'=>__('Select Message',true),'id'=>'select')),array('valign'=>'bottom'));
     $input5_5 = $form->input('LmMenu.lmSelectMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentSelect,'between'=>'<br />' )); 

     $lines5[0] = array(array($input5_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));
      if (file_exists($path.'/lmSelect.mp3')){ 
      	 $input5_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Select",null, null, false);	
      } 


     $lines5[1] = array($input5_1,array($input5_3,array('valign'=>'bottom','width'=>'25')), $input5_2);
    
     echo "<table cellspacing = 0 class= 'none'>";
     echo $html->tableCells($lines5,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Delete **//
     echo "<fieldset><legend>".__('Step 6: Delete message',true)."</legend>";
     $input6_1 = $form->input('LmMenuFile.lmDelete', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input6_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmDelete','title'=>__('Delete Message',true),'id'=>'delete')),array('valign'=>'bottom'));
     $input6_5 = $form->input('LmMenu.lmDeleteMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentDelete,'between'=>'<br />' )); 
     
     $lines6[0] = array(array($input6_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmDelete.mp3')){ 
      	 $input6_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Delete",null, null, false);	
      } 


     $lines6[1] = array($input6_1,array($input6_3,array('valign'=>'bottom','width'=>'25')), $input6_2);

     echo "<table cellspacing = 0 class= 'none'>";     
     echo $html->tableCells($lines6,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Save **//
     echo "<fieldset><legend>".__('Step 7: Save message',true)."</legend>";
     $input7_1 = $form->input('LmMenuFile.lmSave', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input7_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmSave','title'=>__('Save Message',true),'id'=>'save')),array('valign'=>'bottom'));
     $input7_5 = $form->input('LmMenu.lmSaveMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentSave,'between'=>'<br />' )); 

     $lines7[0] = array(array($input7_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmSave.mp3')){
      	    $input7_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Save",null, null, false); 
      } 


     $lines7[1] = array($input7_1,array($input7_3,array('valign'=>'bottom','width'=>'25')), $input7_2);
     

     echo "<table cellspacing = 0 class= 'none'>";
     echo $html->tableCells($lines7,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Goodbye **//
     echo "<fieldset><legend>".__('Step 8: Goodbye message',true)."</legend>";
     $input8_1 = $form->input('LmMenuFile.lmGoodbye', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input8_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmGoodbye','title'=>__('Goodbye Message',true),'id'=>'goodbye')),array('valign'=>'bottom'));
     $input8_5 = $form->input('LmMenu.lmGoodbyeMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentGoodbye,'between'=>'<br />' )); 

     $lines8[0] = array(array($input8_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmGoodbye.mp3')){ 
            $input8_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Goodbye",null, null, false);
      } 


     $lines8[1] = array($input8_1,array($input8_3,array('valign'=>'bottom','width'=>'25')), $input8_2);
          
     echo "<table cellspacing = 0 class= 'none'>";
     echo $html->tableCells($lines8,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";
        

?>