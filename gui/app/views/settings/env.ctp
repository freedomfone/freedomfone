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


	  $languages = Configure::read('LANGUAGES');
	  $timezones = DateTimeZone::listIdentifiers();

	    foreach ($timezones as $timezone){
	       if (preg_match( '/^(Africa|America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $timezone)){ $zones[$timezone] = $timezone;}
	    }

        echo $form->input('id',array('type'=>'hidden','value'=>1));


	  $rows[] = array(__("Language",true), $form->input('language',array('type'=>'select',  'options'=>$languages,'label'=>false,'selected'=>$data['Setting']['language'])));
	  $rows[] = array(__("Time zone",true),$form->input('timezone', array('type'=>'select', 'options'=>$zones,'label'=>false,'selected'=>$data['Setting']['timezone'])));
	  $rows[] = array(__("Domain",true),$form->input('domain',array('type'=>'text','label'=>false,'size'=>30,'value'=>$data['Setting']['domain'])));
	  $rows[] = array(__("IP address",true),$form->input('ip_address',array('type'=>'text','label'=>false,'size'=>30,'value'=>$data['Setting']['ip_address'])));
	  $rows[] = array(__("Overwrite event",true),$form->input('overwrite_event', array('type'=>'checkbox','label'=>false,'checked'=>$data['Setting']['overwrite_event'])));
	  $rows[] = array(array($form->end(__('Save',true)),array('colspan'=>2,'align'=>'center')));

	echo "<table>";
	echo $html->tableCells($rows);
	echo "</table>";

     echo "<table>";
     $lines[] = array(array($html->div('empty_line'),array('colspan'=>2,'height'=>100,'valign'=>'bottom')));
     $lines[] = array(__('Current time',true).' :', $time->format('H:i:s A (e \G\M\T O)',time()));
     echo $html->tableCells($lines);
     echo "</table>"; 



?>
