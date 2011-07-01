<?php
/****************************************************************************
 * edit.ctp	- Edit Leave-a-message IVR menu
 * version 	- 2.0.1170
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

echo $html->addCrumb('Message Centre', '');
echo $html->addCrumb('Administration', '/lm_menus');



if($this->data){

echo $html->addCrumb('Edit', '/lm_menus/edit/'.$this->data['LmMenu']['id']);

$lm_settings = Configure::read('LM_SETTINGS');
$lm_default  = Configure::read('LM_DEFAULT');

$info = __("Leave-a-message| The Leave-a-message voice menu consists of eight different messages. Each message can be generated in three different ways:| (1) customized audio files| (2) customized text to speech, or| (3) default text to speech.||If the administrator associates an audio file with a message, that file will be played to the caller when she enters the voice menu.|If no audio file is provided for a message, but a customized text message exists, the text message will be synthesized and played to the caller.|If neither an audio file, nor a customized text is provided, the default text will be synthesized and played to the user.|The audio files must be uploaded in .mp3 or .wav format through the user interface. Once uploaded, they can be listened to from the administration GUI via the built-in Flashplayer. Audio files can at any time be overwritten with a new audio file.",true);


     echo "<h1>".__("Edit Leave a Message IVR",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }



//         echo $html->div('frameInfoLeft', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));
         echo "<div class ='instruction'>".__("Please upload either an .mp3 or a .wav audio file for each message. If no audio file is present, the fallback text will be used in the Leave-a-Message IVR Menu. You can listen to your uploaded audio files by pressing the Play button or download a copy of the files by using the Download icon.",true)."</div>";
         echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";


$min = ' '.__('min',true);
$commentWelcome   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmWelcomeMessage']."</div>";
$commentInform    = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInformMessage']."</div>";

$commentTitle     = $html->div('formComment', __('Name of this Leave-a-message IVR menu.',true));
$commentMaxreclen = $html->div('formComment', __('Maximum duration (seconds) of voice message left by user.',true));
$commentForceTTS  = $html->div('formComment', __('Check the box to force Text-to-speach (ignore uploaded files)',true));
$options          = array('60' => '1'.$min, '120' => '2'.$min, '180' => '3'.$min, '240' => '4'.$min , '300' => '5'.$min, '900' => __('Unlimited',true)); 
$path = $lm_settings['path'].$this->data['LmMenu']['instance_id']."/".$lm_settings['dir_menu'];

$input1_3 = $input1_4 = false;
$input2_3 = $input2_4 = false;


     echo $form->create('LmMenu', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
     echo $form->hidden('instance_id',array('value'=>$this->data['LmMenu']['instance_id']));

     

echo $form->hidden('lmInvalidMessage');                                                                                           
echo $form->hidden('lmLongMessage');                                                                                              
echo $form->hidden('lmSelectMessage');                                                                                            
echo $form->hidden('lmDeleteMessage');                                                                                            
echo $form->hidden('lmSaveMessage');                                                                                              
echo $form->hidden('lmGoodbyeMessage'); 

     // ** General settings **//
     echo "<fieldset><legend>".__('General settings',true)."</legend>";
      echo $form->input('LmMenu.title', array('between'=>'<br />','type'=>'text','maxLength'=>50, 'size' => '45','label'=>__('Title',true),'after' => $commentTitle));
     echo $form->input('LmMenu.lmMaxreclen', array('between'=>'<br />','type'=>'select', 'options' => $options, 'label'=>__('Message duration',true),'after' => $commentMaxreclen));
     echo $form->hidden('lmForceTTS',array('value'=>0));
     echo $form->input('lmForceTTS',array('type' =>'checkbox','label' => false, 'before' => __('Do not use uploaded files',true).' '));    	    
     echo $form->hidden('lmOnHangup',array('value'=>'accept'));
     echo $commentForceTTS;
     echo "</fieldset>";


     // ** Welcome **//
     echo "<fieldset><legend>".__('Step 1: Welcome message',true)."</legend>";
     $input1_1 = $form->input('LmMenuFile.lmWelcome', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input1_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmWelcome','title'=>__('Welcome Message',true),'id'=>'welcome')),array('valign'=>'bottom'));
     $input1_5 = $form->input('lmWelcomeMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentWelcome,'between'=>'<br />' )); 
     $lines1[0] = array(array($input1_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));
  
      if (file_exists($path.'/lmWelcome.mp3')){      	    
      	    $input1_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Welcome",null, null, false);
      } 



     $lines1[1] = array($input1_1,array($input1_3,array('valign'=>'bottom','width'=>'25')), $input1_2);
     


     echo "<table cellspacing = 0 class= 'none'>";
     echo $html->tableCells($lines1,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Record **//
     echo "<fieldset><legend>".__('Step 2: Record message instructions',true)."</legend>";
     $input2_1 = $form->input('LmMenuFile.lmInform', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input2_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmInform','title'=>__('Inform Message',true),'id'=>'inform')),array('valign'=>'bottom'));
     $input2_5 = $form->input('lmInformMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentInform,'between'=>'<br />' )); 

     $lines2[0] = array(array($input2_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmInform.mp3')){ 
      	    $input2_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Inform",null, null, false);
       } 

     $lines2[1] = array($input2_1,array($input2_3,array('valign'=>'bottom','width'=>'25')), $input2_2);
    
 
     echo "<table cellspacing = 0 class= 'none'>";
     echo $html->tableCells($lines2,array('class'=>'none'),array('class'=>'none'));
     echo "</table>";
     echo "</fieldset>";

     // Show and collapse advanced menu.
     echo $ajax->link("Advanced options","/lm_menus/advanced_edit/{$this->data['LmMenu']['id']}",array("update"   => "lm_advanced", null,1));
     echo "<div id ='lm_advanced'></div>";
                             

     echo $form->end(__('Save',true)); 

     }	else {

         echo $html->div("invalid_entry", __("This page does not exist.",true));

     }

?>

