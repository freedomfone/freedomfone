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

echo "<h1>".__("Create voice menu",true)."</h1>";

$ivr_default  = Configure::read('IVR_DEFAULT');

        if($session->check('Message.flash')){
                  $session->flash();
		}  
	
$commentTitle   = "<span class='formHelp'>".__("Name of IVR",true)."</span>";
$commentLong    = "<span class='formHelp'>".__("Long greeting message:include a brief description of the services offered and the menu alternatives.",true)."</span>";
$commentShort   = "<span class='formHelp'>".__("Brief instuctions: Repeat the menu alternatives. For example: For news, press 1. For health, press 2.",true)."</span>";
//$commentIndex   = "<span class='formHelp'>".__("",true)."</span>";
//$commentExit    = "<span class='formHelp'>".__("",true)."</span>";
//$commentInvalid = "<span class='formHelp'>".__("",true)."</span>";

$commentOption1  = "<span class='formHelp'>".__("Select option for alternative 1.",true)."</span>";
$commentOption2  = "<span class='formHelp'>".__("Select option for alternative 2.",true)."</span>";


$FallbackIndex   = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrIndexMessage']."</div>";
$FallbackExit    = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrExitMessage']."</div>";
$FallbackInvalid = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrInvalidMessage']."</div>";
$FallbackLong    = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrLongMessage']."</div>";
$FallbackShort   = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrShortMessage']."</div>";


echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/form-data') );


?>

<fieldset>
<legend><?php __('Name');?> </legend>
<?php echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle)); ?>
</fieldset>

<fieldset>
<h3>1. <?php __('Welcome');?> </h3>
<?php echo $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'after' => $FallbackLong, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenu.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>

<fieldset>
<h3>2. <?php __('Instructions');?> </h3>
<?php echo $form->input('message_short',array('type'=>'textarea','cols' => '80', 'rows' => '3','label'=>$commentShort,'after' => $FallbackShort,'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenu.file_short', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>

<fieldset>
<h3>3. <?php __('Goodbye');?> </h3>
<?php echo $form->input('message_exit',array('type'=>'text','size' => '93','label'=>false,'after' => $FallbackExit, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenu.file_exit', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>

<fieldset>
<h3>4. <?php __('Invalid');?> </h3>
<?php echo $form->input('message_invalid',array('type'=>'text','size' => '93','label'=>false,'after' => $FallbackInvalid, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenu.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>

<fieldset>
<legend><?php __('Menu entries');?> </legend>
<?

     for($i=1;$i<=8;$i++){

     	$options1=array('node' =>'');
     	$options2=array('lam' =>'');
        $attributes=array('legend'=>false,'default'=>'node');
        $radio1 = $form->radio('option'.$i.'_type',$options1,$attributes);
	$radio2 = $form->radio('option'.$i.'_type',$options2,$attributes);

        $row[$i-1]=array( array("<h3>".__('Press',true)." ".$i."</h3>",array('width'=>'100')), $radio1, $form->input('option'.$i.'_id',array('type'=>'select','options' => $nodes,'label'=>'','empty'=>'- '.__('Select menu option',true).' -' )),$radio2,__('Leave-a-message',true));
     }

     echo "<table width='700px'>";
     echo $html->tableCells($row);
     echo "</table>";

echo "</fieldset>";
echo $form->end(__('Save',true)); 

?>



