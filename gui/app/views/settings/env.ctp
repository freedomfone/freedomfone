<?php 
/****************************************************************************
 * env.ctp	- Set environment settings
 * version 	- 1.0.362
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

echo "<h1>".__("Environment settings",true)."</h1>";

$session->flash();
echo $form->create('Setting',array('type' => 'post','action'=> 'env'));


	foreach ($data as $key => $unit){

	  $entry = $unit['Setting'];

	  if ($entry['name']=='language'){

	     $lang_selected = $entry['value_string'];
	     $languages = Configure::read('LANGUAGES');
	     $rows[] = array(__("Language",true), $form->input($entry['id'].'.value',array('options'=>$languages,'label'=>false,'selected'=>$lang_selected)));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));


	  } elseif ($entry['name']=='timezone'){


	  
	  $timezones = DateTimeZone::listIdentifiers();
	    foreach ($timezones as $timezone){
	       if (preg_match( '/^(Africa|America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $timezone)){ $zones[$timezone] = $timezone;}
	    }


	     $rows[] = array(__("Time zone",true),$form->input($entry['id'].'.value',array('options'=>$zones,'label'=>false,'selected'=>$entry['value_string'])));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));


	  }    elseif ($entry['name']=='domain'){
	
	     $rows[] = array(__("Domain",true),$form->input($entry['id'].'.value',array('type'=>'text','label'=>false,'value'=>$entry['value_string'],'size'=>30)));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));	

	  }   elseif ($entry['name']=='ip_address'){
	
	     $rows[] = array(__("IP address",true),$form->input($entry['id'].'.value',array('type'=>'text','label'=>false,'value'=>$entry['value_string'],'size'=>30)));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));


	  }   elseif ($entry['name']=='overwrite_event'){
	      $checked = false;
	      if($entry['value_int']){ $checked = 'checked';}
	     $rows[] = array(__("Overwrite event",true),$form->input($entry['id'].'.value',array('type'=>'checkbox','label'=>false,'checked'=>$checked)));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_int'));
	  }   

	}

	$rows[] = array(array($form->end(__('Save',true)),array('colspan'=>2,'align'=>'center')));


	echo "<table>";
	echo $html->tableCells($rows);
	echo "</table>";


?>
