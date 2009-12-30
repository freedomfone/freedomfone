<?php

$ivr = Configure::read('IVR_SETTINGS');

	if($this->data){

echo "<h1>".__("Edit voice menu",true)."</h1>";

$ivr_default  = Configure::read('IVR_DEFAULT');
$ivr_settings = Configure::read('IVR_SETTINGS');

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


echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
echo $form->input('id',array('type'=>'hidden'));

$path = $ivr_settings['path'].IID."/".$ivr_settings['dir_menu'];

?>

<fieldset>
<legend><?php __('Name');?> </legend>
<?php echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle)); ?>
</fieldset>

<fieldset>
<legend><?php __('Menu Instructions');?> </legend>
<h3><?php __('1. Welcome');?> </h3>
<?php echo $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file','after'=> $this->element('musicplayer_button',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$formatting->changeExt($this->data['IvrMenu']['file_long'],'mp3'),'title'=>'Welcome Message')))); ?>




<h3><?php __('2. Instructions');?> </h3>
<?php echo $form->input('message_short',array('type'=>'textarea','cols' => '80', 'rows' => '3','label'=>$commentShort,'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_short', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file','after'=> $this->element('musicplayer_button',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$formatting->changeExt($this->data['IvrMenu']['file_short'],'mp3'),'title'=>'Instructions Message')))); ?>


<h3><?php __('3. Goodbye');?> </h3>
<?php echo $form->input('message_exit',array('type'=>'text','size' => '93','label'=>$commentExit,'after' => $FallbackExit, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_exit', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file','after'=> $this->element('musicplayer_button',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$formatting->changeExt($this->data['IvrMenu']['file_exit'],'mp3'),'title'=>'Exit Message')))); ?>

<h3><?php __('4. Invalid');?> </h3>
<?php echo $form->input('message_invalid',array('type'=>'text','size' => '93','label'=>$commentInvalid,'after' => $FallbackInvalid, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenuFile.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file','after'=> $this->element('musicplayer_button',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>$formatting->changeExt($this->data['IvrMenu']['file_invalid'],'mp3'),'title'=>'Invalid Message')))); ?>
</fieldset>


<fieldset>
<legend><?php __('Menu Options');?> </legend>
<?

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
	
	   $listen =  $this->element('musicplayer_button',array('path'=>$path,'file'=>$formatting->changeExt($nodes['file'][$option_id],'mp3'),'title'=>$nodes['title'][$option_id]));
	}    
	else {$listen=false;}

       $row[$i]=array(
	array("<h3>".__('Press '.($i+1),true)."</h3>",array('width'=>'100px')),
	$radio1, 
	$form->input('option'.($i+1).'_id',array('type'=>'select','options' => $nodes['title'],'label'=>'','empty'=>'-Select node-' )),
	$listen,
	$radio2, 
	__("Leave-a-message",true)
	);
     }

     echo "<table width='600px'>";
     echo $html->tableCells($row);
     echo "</table>";

echo "</fieldset>";
echo $form->end('Save'); 
     }
     else {

         echo "<h1>".__("No IVR with this id exists",true)."</h1>";
     }

?>



