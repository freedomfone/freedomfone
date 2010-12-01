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
$ivr = Configure::read('IVR_SETTINGS');

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
echo $form->input('ivr_type',array('type'=>'hidden','value'=>'ivr'));

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

<?

echo "<legend>".__('Menu Options',true)."</legend>";

$path = $ivr['path'].$ivr['dir_node'];

     for($i=0;$i<9;$i++){

        echo $form->input('Mapping.'.$i.'.digit',array('type'=>'hidden','value' => $i+1));	
        echo $form->input('Mapping.'.$i.'.id',array('type'=>'hidden'));	


        $default = false;
     	$options1=array('lam' =>'');
     	$options2=array('ivr' =>'');
     	$options3=array('node' =>'');

        $attributes=array('legend'=>false,'default'=>$default);


        $radio1 = $form->radio('Mapping.'.$i.'.type',$options1,array('legend' => false, 'default' => true));
	$radio2 = $form->radio('Mapping.'.$i.'.type',$options2,$attributes);
       	$radio3 = $form->radio('Mapping.'.$i.'.type',$options3,$attributes);

        $listen = false;

        if($this->data['Mapping']){
                if($this->data['Mapping'][$i]['type'] == 'node'){

                   $id = $this->data['Mapping'][$i]['node_id'];
                   $file = $nodes['file'][$id];
                   $title = $nodes['title'][$id];
      	           $path = $ivr['path'].$ivr['dir_node'];
	           $listen =  $this->element('player',array('path'=>$path,'file'=>$file,'title'=>$title,'id'=>$id));
                }
        }


        $row[$i]=array(
	array("<h3>".__('#',true)." ".($i+1)."</h3>",array('width'=>'100px')),
	$radio1, 
        $form->input('Mapping.'.$i.'.lam_id',array('type'=>'select','options' => $lam,'label'=>'','empty'=>'- '.__('Select Leave-a-message',true).' -' )),
	$radio2, 
        $form->input('Mapping.'.$i.'.ivr_id',array('type'=>'select','options' => $voicemenu,'label'=>'','empty'=>'- '.__('Select Voice Menu',true).' -' )),
	$radio3, 
        $form->input('Mapping.'.$i.'.node_id',array('type'=>'select','options' => $nodes['title'],'label'=>'','empty'=>'- '.__('Select content',true).' -' )),
	$listen,

	);


     }



     echo "<table width='100%'>";
     echo $html->tableCells($row);
     echo "</table>";

     echo "</fieldset>";
     echo $form->end(__('Save',true)); 


?>



