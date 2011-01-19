<?php
/****************************************************************************
 * add_selector.ctp	- Create new language selector
 * version 	        - 1.0.360
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

echo $html->addCrumb('IVR Centre', '');
echo $html->addCrumb('Language selectors', '/selectors');
echo $html->addCrumb('Create', '/selectors/add');


echo "<h1>".__("Create Language Selector",true)."</h1>";

$ivr_default  = Configure::read('IVR_DEFAULT');
$ivr = Configure::read('IVR_SETTINGS');

        if($session->check('Message.flash')){
                  $session->flash();
		}  
	
$commentTitle   = "<span class='formHelp'>".__("Name of IVR",true)."</span>";
$commentLong    = "<span class='formHelp'>".__("Long greeting message:include a brief description of the services offered and the menu alternatives.",true)."</span>";
$commentShort   = "<span class='formHelp'>".__("Brief instuctions: Repeat the menu alternatives. For example: For news, press 1. For health, press 2.",true)."</span>";


$FallbackIndex   = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrIndexMessage']."</div>";
$FallbackExit    = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrExitMessage']."</div>";
$FallbackInvalid = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrInvalidMessage']."</div>";
$FallbackLong    = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrLongMessage']."</div>";
$FallbackShort   = "<div class='formComment'>".__("Default",true).": ".$ivr_default['ivrShortMessage']."</div>";


echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'add_selector','enctype' => 'multipart/form-data') );
echo $form->input('ivr_type',array('type'=>'hidden','value'=>'switcher'));

?>

<fieldset>
<legend><?php __('Title');?> </legend>
<?php echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle)); ?>
</fieldset>

<fieldset>
<h3>1. <?php __('Instructions');?> </h3>
<?php echo $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'after' => $FallbackLong, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenu.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>


<fieldset>
<h3>2. <?php __('Invalid');?> </h3>
<?php echo $form->input('message_invalid',array('type'=>'text','size' => '93','label'=>false,'after' => $FallbackInvalid, 'between'=>'<br />' )); ?>
<?php echo $form->input('IvrMenu.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));?>
</fieldset>

<fieldset>

<?

echo "<legend>".__('Menu Options',true)."</legend>";


echo $form->create("IvrMenu");
          $opt = array('ivr'=>'Voice Menus','lam'=>'Leave-a-message','node' => 'Content');
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



?>



