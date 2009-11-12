<?php
echo "<h1>".__("Create voice menu",true)."</h1>";

$ivr_default  = Configure::read('IVR_DEFAULT');

        if($session->check('Message.flash')){
                  $session->flash();
		}  

//echo "<div class ='instruction'>".__("add instructions here.",true)."</div>";
  	
$commentTitle   = "<span class='formHelp'>".__("Name of IVR",true)."</span>";
$commentLong   = "<span class='formHelp'>".__("Long greeting message:include a brief description of the services offered and the menu alternatives.",true)."</span>";
$commentShort  = "<span class='formHelp'>".__("Brief instuctions: Repeat the menu alternatives. For example: For news, press 1. For health, press 2.",true)."</span>";
$commentIndex  = "<span class='formHelp'>".__("",true)."</span>";
$commentExit   = "<span class='formHelp'>".__("",true)."</span>";
$commentInvalid   = "<span class='formHelp'>".__("",true)."</span>";

$commentOption1  = "<span class='formHelp'>".__("Select option for alternative 1.",true)."</span>";
$commentOption2  = "<span class='formHelp'>".__("Select option for alternative 2.",true)."</span>";


$FallbackIndex   = "<div class='formComment'>".__("Default: ",true).$ivr_default['ivrIndexMessage']."</div>";
$FallbackExit    = "<div class='formComment'>".__("Default: ",true).$ivr_default['ivrExitMessage']."</div>";
$FallbackInvalid    = "<div class='formComment'>".__("Default: ",true).$ivr_default['ivrInvalidMessage']."</div>";


echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/form-data') );

//$path = $ivr_settings['path'].IID."/".$ivr_settings['dir_menu'];

?>

<fieldset>
<legend><?php __('Name');?> </legend>
<?php echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle)); ?>
</fieldset>

<fieldset>
<h3><?php __('1. Welcome');?> </h3>
<?php echo $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file'));?>
</fieldset>

<fieldset>
<h3><?php __('2. Instructions');?> </h3>
<?php echo $form->input('message_short',array('type'=>'textarea','cols' => '80', 'rows' => '3','label'=>$commentShort,'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_short', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file'));?>
</fieldset>

<fieldset>
<h3><?php __('3. Goodbye');?> </h3>
<?php echo $form->input('message_exit',array('type'=>'text','size' => '93','label'=>$commentExit,'after' => $FallbackExit, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_exit', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file'));?>
</fieldset>

<fieldset>
<h3><?php __('4. Invalid');?> </h3>
<?php echo $form->input('message_invalid',array('type'=>'text','size' => '93','label'=>$commentInvalid,'after' => $FallbackInvalid, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file'));?>
</fieldset>

<fieldset>
<legend><?php __('Menu entries');?> </legend>
<?
     for($i=0;$i<8;$i++){
        $row[$i]=array( array("<h3>".__('Press '.($i+1),true)."</h3>",array('width'=>'100')), $form->input('option'.($i+1).'_id',array('type'=>'select','options' => $nodes,'label'=>'','empty'=>'-Select node-' )));
     }

     echo "<table width='800px'>";
     echo $html->tableCells($row);
     echo "</table>";

echo "</fieldset>";
echo $form->end('Save'); 

?>



