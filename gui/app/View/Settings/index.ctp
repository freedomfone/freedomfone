<?php 
/****************************************************************************
 * env.ctp	- Set environment settings
 * version 	- 2.0.1230
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

echo $this->Html->addCrumb(__('Dashboard',true), '');
echo $this->Html->addCrumb(__('Settings',true), '/settings');


echo "<h1>".__("Settings",true)."</h1>";
echo $this->Form->create('Setting',array('type' => 'post','action'=> 'index'));

$languages = Configure::read('LANGUAGES');

$msgAccessLevel =  __('Please select appropriate IP address of your Freedom Fone installation.',true)."<br/>";
$msgAccessLevel .=  __('If the server: ',true)."<br/><ul>";
$msgAccessLevel .= "<li>".__('is connected to the Internet, and has a public IP address, select Internet.',true)."<br/></li>"; 
$msgAccessLevel .= "<li>".__('is connected to a local area network (LAN), select Local Area Network.',true)."<br/></li>"; 
$msgAccessLevel .= "<li>".__('is not networked, select Local machine.',true)."<br/></li></ul>"; 


	$this->Session->flash();

foreach ($languages as $key => $language){
    $languages[$key] = __($language,true);
}



     foreach ($data as $key => $unit){

        $entry = $unit['Setting'];

	if($authGroup == 1){

	  if ($entry['name']=='language'){

	    $lang_selected = $entry['value_string'];



	    $rows[] = array(__('Language',true), $this->Form->input($entry['id'].'.value',array('options'=>$languages,'label'=>false,'selected'=>$lang_selected)));
	    echo $this->Form->hidden($entry['id'].'.field',array('value'=>'value_string'));
	     
	  } 

	  elseif ($entry['name']=='timezone'){
	  
	    $timezones = DateTimeZone::listIdentifiers();
	  
	    foreach ($timezones as $timezone){
	       if (preg_match( '/^(Africa|America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $timezone)){ $zones[$timezone] = $timezone;}
	    }


	     $rows[] = array(__("Time zone",true),$this->Form->input($entry['id'].'.value',array('options'=>$zones,'label'=>false,'selected'=>$entry['value_string'])));
	     echo $this->Form->hidden($entry['id'].'.field',array('value'=>'value_string'));
	    

	  } elseif ($entry['name']=='prefix'){


	     $rows[] = array(__("Country",true), $this->Form->input($entry['id'].'.value',array('options'=>$countries,'label'=>false,'selected'=>$entry['value_int'])));
	     echo $this->Form->hidden($entry['id'].'.field',array('value'=>'value_int'));

          }

	   elseif ($entry['name']=='ip_address'){

           $options1 = array($external => ' '.__('Internet',true));
           $options2 = array($internal => ' '.__('Local Area Network',true));
           $options3 = array('127.0.0.1'=>' '.__('Local machine',true)); 


	   $default_ext = $default_int = $default_local = false;
	   $current_IP = $entry['value_string'];


	   $radio[] = array(array($this->Html->div('instruction', __('Your current IP address is',true).': '.$current_IP),array('colspan'=>2)));

	   if($entry['value_string'] == $external) { $default_ext = true; $value = false;}
	   elseif($entry['value_string'] == $internal) { $default_int = true; $value = false;}
	   elseif($entry['value_string'] == '127.0.0.1') { $default_local = true; $value = false;}


            if ($external){ $radio[] = array($this->Form->input('ip_radio',array('type' => 'radio', 'options' => $options1, 'value' => $current_IP)),$external);}
            if ($internal){ $radio[] = array($this->Form->input('ip_radio',array('type' => 'radio', 'options' => $options2, 'value' => $current_IP)),$internal);}
              $radio[] = array($this->Form->input('ip_radio',array('type' => 'radio', 'options' => $options3, 'value' => $current_IP)),'127.0.0.1');

            echo $this->Form->hidden($entry['id'].'.field',array('value'=>'value_string'));                                                         
	    }

	} //authGroup

	else {

	$msgAccessLevel=false;

	  if ($entry['name']=='language'){
	    $rows[] = array(__('Language',true), $languages[$entry['value_string']]);
	  } 

	  elseif ($entry['name']=='timezone'){
	  	     $rows[] = array(__("Time zone",true), $entry['value_string']);	    

	  } elseif ($entry['name']=='prefix'){

	     $rows[] = array(__("Country",true), $countries[$entry['value_int']]);
          }

	   elseif ($entry['name']=='ip_address'){
	
	   $radio[] = array(array($this->Html->div('instruction', __('Your current IP address is',true).': '.$entry['value_string']),array('colspan'=>2)));

	   }
	} //authGroup

} //foreach

     
	//Display language and timezone table
	echo "<h2>".__("Environment settings",true)."</h2>";
	echo "<table cellspacing=0 class='stand-alone'>";
	echo $this->Html->tableCells($rows,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
	echo "</table>";


	//Display IP address table
        echo "<h2>".__("IP address",true)."</h2>";                                                                                                                                                                                                      
        echo $this->Html->div('instruction', $msgAccessLevel);
	echo "<table cellspacing=0 class='stand-alone'>";
	echo $this->Html->tableCells($radio,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
        echo "</table>";

        //Display Save button
	$save = $this->Html->div('button_center', $this->Form->end(__('Save',true)));
	echo $this->Access->showBlock($authGroup, $save);


?>
