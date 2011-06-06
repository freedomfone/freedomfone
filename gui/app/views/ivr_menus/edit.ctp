<?php
/****************************************************************************
 * index.ctp	- List processes
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

$ivr = Configure::read('IVR_SETTINGS');
$session->flash();

	if($this->data){

$ivrMenu = $this->data['IvrMenu'];
echo "<h1>".__("Edit voice menu",true)."</h1>";

$ivr_default  = Configure::read('IVR_DEFAULT');
$ivr_settings = Configure::read('IVR_SETTINGS');

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }


$commentTitle   = "<span class='formHelp'>".__("Name of IVR",true)."</span>";
$commentLong   = "<span class='formHelp'>".__("Long greeting message: include a brief description of the services offered and the menu alternatives.",true)."</span>";
$commentShort  = "<span class='formHelp'>".__("Brief instuctions: Repeat the menu alternatives. For example: For news, press 1. For health, press 2.",true)."</span>";
$commentIndex  = "<span class='formHelp'>".__(" ",true)."</span>";
$commentExit   = "<span class='formHelp'>".__(" ",true)."</span>";
$commentInvalid   = "<span class='formHelp'>".__(" ",true)."</span>";
$commentOption1  = "<span class='formHelp'>".__("Select option for alternative 1.",true)."</span>";
$commentOption2  = "<span class='formHelp'>".__("Select option for alternative 2.",true)."</span>";
$FallbackIndex   = "<div class='formComment'>".__("Default: ",true).$ivr_default['ivrIndexMessage']."</div>";
$FallbackExit    = "<div class='formComment'>".__("Default: ",true).$ivr_default['ivrExitMessage']."</div>";
$FallbackInvalid    = "<div class='formComment'>".__("Default: ",true).$ivr_default['ivrInvalidMessage']."</div>";
$FallbackLong    = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrLongMessage']."</div>";
$FallbackShort   = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrShortMessage']."</div>";


echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
echo $form->input('id',array('type'=>'hidden'));
//echo $form->input('MAX_FILE_SIZE',array('type'=>'hidden','value'=>200000000));


$path = $ivr_settings['path'].IID."/".$ivr_settings['dir_menu'];

echo "<fieldset><legend>".__('Name',true)."</legend>";
echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle));
echo "</fieldset>";

echo "<fieldset>";
echo "<legend>".__('Menu Instructions',true)."</legend>";

$box=array(false,false,false,false);
$step1[3]=false; $step2[3]=false;$step3[3]=false; $step4[3]=false;


//**** 1. Welcome ****//

$step1[0] = "<h3>1. ".__('Welcome',true)."</h3>";
$step1[1] = $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'after' => $FallbackLong, 'between'=>'<br />' ));
$step1[2] = $form->input('IvrMenuFile.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','Label'=>__('Audio file',true)));
$step1[4] = $this->element('player',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$this->data['IvrMenu']['id'].'_file_long','title'=>__('Welcome Message',true),'id'=>'long'));

if($ivrMenu['file_long']){
	$box[0] = $form->input('mode_long',array('type' =>'checkbox','label' => false, 'after' =>__('Do not use uploaded file',true).' ('.$ivrMenu['file_long'].')'));
	$step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['id']}/long",null, null, false);				  
}

 echo "<table>";
 echo $html->tableCells(array(
		array(array($step1[0],array('colspan'=>3))),	
		array(array($step1[1],array('colspan'=>3))),	
		array($step1[2],array($step1[3],array('valign'=>'bottom')),array($step1[4],array('valign'=>'bottom'))),
		array(array($box[0],array('colspan'=>3))),
		array(array("<hr>",array('colspan'=>3)))	
		));


//**** 2. Instructions ****//

$step2[0] = "<h3>2. ".__('Instructions',true)."</h3>";
$step2[1] = $form->input('message_short',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentShort, 'after' => $FallbackShort, 'between'=>'<br />' ));
$step2[2] = $form->input('IvrMenuFile.file_short', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
$step2[4] = $this->element('player',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$this->data['IvrMenu']['id'].'_file_short','title'=>__('Instructions Message',true),'id'=>'short'));

if($ivrMenu['file_short']){
	$box[1] = $form->input('mode_short',array('type' =>'checkbox','label' => false, 'after' =>__('Do not use uploaded file',true).' ('.$ivrMenu['file_short'].')'));
	$step2[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['id']}/short",null, null, false);
	}

 echo "<table>";
 echo $html->tableCells(array(
		array(array($step2[0],array('colspan'=>3))),	
		array(array($step2[1],array('colspan'=>3))),	
		array($step2[2],array($step2[3],array('valign'=>'bottom')),array($step2[4],array('valign'=>'bottom'))),
		array(array($box[1],array('colspan'=>3))),
		array(array("<hr>",array('colspan'=>3)))	
		));


//**** 3. Goodbye ****//

$step3[0] = "<h3>3. ".__('Goodbye',true)."</h3>";
$step3[1] = $form->input('message_exit',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentExit, 'after' => $FallbackExit, 'between'=>'<br />' ));
$step3[2] = $form->input('IvrMenuFile.file_exit', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
$step3[4] = $this->element('player',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$this->data['IvrMenu']['id'].'_file_exit','title'=>__('Goodbye Message',true),'id'=>'exit'));

if($ivrMenu['file_exit']){
	$box[2] = $form->input('mode_exit',array('type' =>'checkbox','label' => false, 'after' =>__('Do not use uploaded file',true).' ('.$ivrMenu['file_exit'].')'));
	$step3[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['id']}/exit",null, null, false);
	}

 echo "<table>";
 echo $html->tableCells(array(
		array(array($step3[0],array('colspan'=>3))),	
		array(array($step3[1],array('colspan'=>3))),	
		array($step3[2],array($step3[3],array('valign'=>'bottom')),array($step3[4],array('valign'=>'bottom'))),
		array(array($box[2],array('colspan'=>3))),
		array(array("<hr>",array('colspan'=>3)))	
		));



//**** 4. Invalid ****//

$step4[0] = "<h3>4. ".__('Invalid',true)."</h3>";
$step4[1] = $form->input('message_invalid',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentInvalid, 'after' => $FallbackInvalid, 'between'=>'<br />' ));
$step4[2] = $form->input('IvrMenuFile.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
$step4[4] = $this->element('player',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$this->data['IvrMenu']['id'].'_file_invalid','title'=>__('Invalid Message',true),'id'=>'invalid'));

if($ivrMenu['file_invalid']){
	$box[3] = $form->input('mode_invalid',array('type' =>'checkbox','label' => false, 'after' =>__('Do not use uploaded file',true).' ('.$ivrMenu['file_invalid'].')'));
	$step4[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['id']}/invalid",null, null, false);
	}

 echo "<table>";
 echo $html->tableCells(array(
		array(array($step4[0],array('colspan'=>3))),	
		array(array($step4[1],array('colspan'=>3))),	
		array($step4[2],array($step4[3],array('valign'=>'bottom')),array($step4[4],array('valign'=>'bottom'))),
		array(array($box[3],array('colspan'=>3))),
		array(array("<hr>",array('colspan'=>3)))	
		));
 echo "</table>";



echo "</fieldset>";


echo "<fieldset>";
echo "<legend>".__('Menu Options',true)."</legend>";

$path = $ivr['path'].IID."/".$ivr['dir_node'];

     for($i=0;$i<8;$i++){

	$key = 'option'.($i+1).'_id';
	$key_type = 'option'.($i+1).'_type';
	$default = $this->data['IvrMenu'][$key_type];

     	$options1=array('node' =>'');
     	$options2=array('lam' =>'');
        $attributes=array('legend'=>false,'default'=>$default);
        $radio1 = $form->radio('option'.($i+1).'_type',$options1,$attributes);
	$radio2 = $form->radio('option'.($i+1).'_type',$options2,$attributes);

	if ($option_id = $this->data['IvrMenu'][$key]){
	
	   $listen =  $this->element('player',array('path'=>$path,'file'=>$nodes['file'][$option_id],'title'=>$nodes['title'][$option_id],'id'=>$i));
	}    
	else {$listen=false;}

       $row[$i]=array(
	array("<h3>".__('Press',true)." ".($i+1)."</h3>",array('width'=>'100px')),
	$radio1, 
	$form->input('option'.($i+1).'_id',array('type'=>'select','options' => $nodes['title'],'label'=>'','empty'=>'- '.__('Select menu option',true).' -' )),
	$listen,
	$radio2, 
	__("Leave-a-message",true)
	);
     }

     echo "<table width='700px'>";
     echo $html->tableCells($row);
     echo "</table>";

     echo "</fieldset>";
     echo $form->end(__('Save',true)); 
     }
     else {

         echo "<h1>".__("No IVR with this id exists",true)."</h1>";
     }

?>



