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

echo $html->addCrumb(__('Dashboard',true), '');
echo $html->addCrumb(__('Settings',true), '/settings');


echo "<h1>".__("Settings",true)."</h1>";
echo $form->create('Setting',array('type' => 'post','action'=> 'index'));





$msgAccessLevel =  __('Please select appropriate IP address of your Freedom Fone installation.',true)."<br/>";
$msgAccessLevel .=  __('If the server: ',true)."<br/><ul>";
$msgAccessLevel .= "<li>".__('is connected to the Internet, and has a public IP address, select Internet.',true)."<br/></li>"; 
$msgAccessLevel .= "<li>".__('is connected to a local area network (LAN), select Local Area Network.',true)."<br/></li>"; 
$msgAccessLevel .= "<li>".__('is not networked, select Local machine.',true)."<br/></li></ul>"; 

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
	    

	  } elseif ($entry['name']=='country'){


	     $rows[] = array("Country", $form->input($entry['id'].'.value',array('options'=>$countries,'label'=>false,'selected'=>$entry['value_string'])));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));

          }

	   elseif ($entry['name']=='ip_address'){

           $options1 = array($external => ' '.__('Internet',true));
           $options2 = array($internal => ' '.__('Local Area Network',true));
           $options3 = array('127.0.0.1'=>' '.__('Local machine',true)); 


	   $default_ext = $default_int = $default_local = false;
	   $current_IP = $entry['value_string'];


	   $radio[] = array(array($html->div('instruction', __('Your current IP address is',true).': '.$current_IP),array('colspan'=>2)));

	   if($entry['value_string'] == $external) { $default_ext = true; $value = false;}
	   elseif($entry['value_string'] == $internal) { $default_int = true; $value = false;}
	   elseif($entry['value_string'] == '127.0.0.1') { $default_local = true; $value = false;}

	   

            if ($external){ $radio[] = array($form->radio('ip_radio',$options1,array('legend'=>false,'value'=>$default_ext)),$external);}
            if ($internal){ $radio[] = array($form->radio('ip_radio',$options2,array('legend'=>false,'value'=>$default_int)),$internal);}
            $radio[] = array($form->radio('ip_radio',$options3,array('legend'=>false,'value'=>$default_local)), '127.0.0.1');
            echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));                                                         


	}

}


     
	//Display language and timezone table
	echo "<h2>".__("Environment settings",true)."</h2>";
	echo "<table cellspacing=0 class='stand-alone'>";
	echo $html->tableCells($rows,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
	echo "</table>";


	//Display IP address table
        echo "<h2>".__("IP address",true)."</h2>";                                                                                                                                                                                                      
        echo $html->div('instruction', $msgAccessLevel);
	echo "<table cellspacing=0 class='stand-alone'>";
	echo $html->tableCells($radio,array('class' => 'stand-alone'),array('class' => 'stand-alone'));
        echo "</table>";

        //Dispaly Save button
	echo $html->div('button_center', $form->end(__('Save',true)));

?>
