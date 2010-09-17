<?php
/****************************************************************************
 * add.ctp	- Crate new language switcher
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

echo "<h1>".__("Create language switcher",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
     }

	
$commentTitle   = "<span class='formHelp'>".__("Name of language switcher",true)."</span>";
$commentInstruction    = "<span class='formHelp'>".__("Brief instruction how to reach each language menu.",true)."</span>";
$commentInvalid = "<span class='formHelp'>".__("Warning that the user has pressed an invalid option.",true)."</span>";


echo $form->create('Switcher', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/formdata') );

?>

<fieldset>
<legend><?php __('Title');?> </legend>
<?php echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle)); ?>
</fieldset>

<fieldset>
<h3>1. <?php __('Instructions');?> </h3>
<?php echo $form->input('message_instruction',array('type'=>'textarea','cols' => '80', 'rows' => '3','label'=>$commentInstruction,'between'=>'<br />' )); ?>
<?php echo $form->input('Switcher.file_instruction', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>


<fieldset>
<h3>2. <?php __('Invalid');?> </h3>
<?php echo $form->input('message_invalid',array('type'=>'text','size' => '93','label'=>false,'between'=>'<br />' )); ?>
<?php echo $form->input('Switcher.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>

<fieldset>
<legend><?php __('Menu entries');?> </legend> 

<?php

/*echo $form->create( 'Switcher' );

echo "<div id='typediv'>";

$titles = array( 1 => 'FOO', 2 => 'GOO'); 
echo $form->input( 'type', array( 'options' => $titles ));
echo "</form>";

echo $ajax->observeField( 'SwitcherType',
                          array(
                                'url' => array( 'action' => 'getLAM','update'=>'typediv'),
                                'frequency' => 0.2));

echo "</div>";  
*/


     foreach($ivr as $key => $entry){

        $_ivr[$entry['ivr_menus']['id']] = $entry['ivr_menus']['title'];

     }

     foreach($lam as $key => $entry){

        $_lam[$entry['lm_menus']['id']] = $entry['lm_menus']['title'];

     }

     	$options1=array('ivr' =>'  '.__('Voice Menu',true));
     	$options2=array('lam' =>'  '.__('Leave-a-message',true));
        $attributes=array('legend'=>false,'default'=>'ivr');

        $radio1 = $form->radio('type',$options1,$attributes);
	$radio2 = $form->radio('type',$options2,$attributes);
        $row[] = array("",$radio1,$radio2);


     for($i=1;$i<=3;$i++){

        $row[]=array( array("<h3>".__('Press',true)." ".$i."</h3>", array('width'=>'100')), 
                      $form->input('ivr'.$i,array('type'=>'select','options' => $_ivr,'label'=>'','empty'=>'- '.__('Select voice menu',true).' -' )), 
                      $form->input('lam'.$i,array('type'=>'select','options' => $_lam,'label'=>'','empty'=>'- '.__('Select Leave-a-message menu',true).' -' )));
     }

     echo "<table width='700px'>";
     echo $html->tableCells($row);
     echo "</table>";


echo "</fieldset>";
echo $form->end(__('Save',true)); 

?>