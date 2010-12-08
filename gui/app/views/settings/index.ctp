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

echo "<h1>".__("System settings",true)."</h1>";
echo $form->create('Setting',array('type' => 'post','action'=> 'index'));

$msgNetwork = __('Your Freedom Fone server has two or more IP addresses (external, internal, and localhost). By selecting one or another, you are setting the access level of the audio content of your system. <br/>If you want the content to be available over the Internet (to computers outside your local network), then select the <i>External IP address</i>.<br/>If you want the audio content to be accessible from any computer on the same network as your Freedom Fone server, select the <i>Internal IP address</i>.<br/> If you want to restrict acces to the audio files to only the machine that runs Freedom Fone, then select <i>localhost</i>.',true);

 	if ($messages = $session->read('Message.multiFlash')) {
            foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
   	   }


	foreach ($data as $key => $unit){

	  $entry = $unit['Setting'];

	  if ($entry['name']=='language'){

	    $lang_selected = $entry['value_string'];
	    $languages = Configure::read('LANGUAGES');
	    $rows[] = array('Language', $form->input($entry['id'].'.value',array('options'=>$languages,'label'=>false,'selected'=>$lang_selected)));
	    echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));
	     
	  } 

	  elseif ($entry['name']=='timezone'){
	  
	    $timezones = DateTimeZone::listIdentifiers();
	  
	    foreach ($timezones as $timezone){
	       if (preg_match( '/^(Africa|America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $timezone)){ $zones[$timezone] = $timezone;}
	    }


	     $rows[] = array("Time zone",$form->input($entry['id'].'.value',array('options'=>$zones,'label'=>false,'selected'=>$entry['value_string'])));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));
	    

	  } 

	   elseif ($entry['name']=='ip_address'){





	   $options1 = array($external => ' '.__('External IP address',true));	
	   $options2 = array($internal => ' '.__('Internal IP address',true));	
	   $options3 = array('127.0.0.1'=>' '.__('Localhost',true));	

	   $default_ext = $default_int = $default_local = false;
	   $current_IP = $entry['value_string'];


	   $radio[] = array(array($html->div('instruction', __('Your current IP address is',true).': '.$current_IP),array('colspan'=>2)));

	   if($entry['value_string'] == $external) { $default_ext = true; $value = false;}
	   elseif($entry['value_string'] == $internal) { $default_int = true; $value = false;}
	   elseif($entry['value_string'] == '127.0.0.1') { $default_local = true; $value = false;}

	   


	    if ($external){ $radio[] = array($form->radio('ip_radio',$options1,array('legend'=>false,'value'=>$default_ext)),$external.' ('.gethostbyaddr($external).')');}
	    if ($internal){ $radio[] = array($form->radio('ip_radio',$options2,array('legend'=>false,'value'=>$default_int)),$internal);}
	    $radio[] = array($form->radio('ip_radio',$options3,array('legend'=>false,'value'=>$default_local)),'127.0.0.1');
	    $radio[] = array("Other:",$form->input($entry['id'].'.value',array('type'=>'text','label'=>false,'value'=>false,'size'=>30)));
	    echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));



	  } /*  elseif ($entry['name']=='overwrite_event'){
	      $checked = false;
	      if($entry['value_int']){ $checked = 'checked';}
	     $rows[] = array("Overwrite event",$form->input($entry['id'].'.value',array('type'=>'checkbox','label'=>false,'checked'=>$checked)));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_int'));
	  }   */

	}


     
	//Display language and timezone table
	echo "<h2>".__("Environment settings",true)."</h2>";
	echo "<table cellspacing=0 class='stand-alone'>";
	echo $html->tableCells($rows,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
	echo "</table>";


	//Display IP address table
	echo "<h2>".__("Network settings",true)." (".__("advanced",true).")</h2>";
	$session->flash();
        echo $html->div('instruction', $msgNetwork);
	echo "<table cellspacing=0 class='stand-alone'>";
	echo $html->tableCells($radio,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
        echo "</table>";

        //Dispaly Save button
	echo $html->div('button_center', $form->end(__('Save',true)));

?>
