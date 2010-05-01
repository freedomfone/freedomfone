<?php
/****************************************************************************
 * index.ctp	- List processes
 * version 	- 1.0.359
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

$session->flash();

echo $form->create('IvrMenu',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRight',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

$info = __('Voice Menu| This component allows you to build a variety of personal Voice Menus based on customized audio files, or synthesized text messages.| A Voice menu consists of:| Menu Instructions: a set of mandatory voice messages, such as a Welcome message, and instructions on how to navigate through the menu|  Menu Options: audio files or components associated with telephony keypad selections.',true);

echo $html->div('frameInfo', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));

echo "<h1>".__('Voice menus',true)."</h1>";

echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";
     if ($ivr_menus){

     echo $form->create('IvrMenu',array('type' => 'post','action'=> 'update'));

     echo "<table width=100%>";
     echo $html->tableHeaders(array(
     	__("Default",true),
 	$paginator->sort(__("Title",true), 'title'),
 	$paginator->sort(__("Greeting",true), 'message_long'),
 	$paginator->sort(__("IVR code",true), 'modified'),
 	$paginator->sort(__("Last modified",true), 'modified'),
	__("Edit",true),
	__("Delete",true)));

	echo $form->hidden('source',array('value'=>'index'));

	//Find parent
      foreach ($ivr_menus as $key => $ivr_menu){
      	   if ($ivr_menu['IvrMenu']['parent']==1){
	      $parent = $ivr_menu['IvrMenu']['id'];
	      }
      }
 
      foreach ($ivr_menus as $key => $ivr_menu){
      $options=array($ivr_menu['IvrMenu']['id']=>'');


        $attributes=array('legend'=>false,'default'=>$parent);
        $default = $form->radio('parent',$options,$attributes);

	$title         = $ivr_menu['IvrMenu']['title'];
	$message_long  = $ivr_menu['IvrMenu']['message_long'];
	$ivr_code      = $ivr_menu['IvrMenu']['modified'];
	$modified      = $time->niceShort($ivr_menu['IvrMenu']['modified']);
	$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/ivr_menus/edit/{$ivr_menu['IvrMenu']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/ivr_menus/delete/{$ivr_menu['IvrMenu']['id']}",null, __("Are you sure you want to delete this voice menu?",true),false);

     	$row[$key] = array(
		$default,
		array($title,array('width'=>'100px')),
		$message_long,
		$ivr_code,		
		$modified,
		array($edit,array('align'=>'center')),
		array($delete,array('align'=>'center')));
	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";

     echo $form->end(__('Update default',true));
     }

?>
