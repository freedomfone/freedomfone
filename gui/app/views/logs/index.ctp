<?php
/****************************************************************************
 * index.ctp	- Form for selecting Freedom Fone logs
 * version 	- 2.0.1170
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

echo $html->addCrumb('Dashboard', '');
echo $html->addCrumb('Logs', '/logs');


	echo "<h1>".__("Logs",true)."</h1>";
	echo $html->div('instructions',__('Select log file to view',true));
	echo $form->create("Log");
	$opt = array('poll'=>'Poll','bin' => 'SMS','message'=>'Message Centre','ivr' => 'IVR Centre','debug'=> 'Debug','error' => 'Error');
	echo $form->input("type",array("id"=>"LogType","type"=>"select","options"=>$opt,"label"=> false,"empty" => '-- '.__("Select log file",true).' --'));
	$opt = array(
		"update" => "log_div",
		"url" => "/logs/disp",
		"frequency" => "0.1"
	);

	echo $ajax->observeField("LogType",$opt);
	echo $form->end();
?>



<div id="log_div" style=""></div>


