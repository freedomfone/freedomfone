<?php
/****************************************************************************
 * index.ctp	- List all IVR Voice Menus
 * version 	- 3.0.1500
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


echo $this->Html->addCrumb(__('IVR Centre',true), '');
echo $this->Html->addCrumb(__('Voice menus',true), '/ivr_menus');


$ext = Configure::read('EXTENSIONS');

$this->Access->showButton($authGroup, 'IvrMenu', 'add', 'frameRightAlone', __('Create new',true), 'submit', 'button');


   $info = $this->Html->link(
                        $this->Html->image("icons/bulb.png"),
                        "/pages/ivr_menus/tip",
                        array("escape" => false, "title" => __("Tool tip", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 500}); return false;"),
                        false);

   echo $this->Html->div('frameInfo', $info);
   echo "<h1>".__('Voice menus',true)."</h1>";

   echo $this->Session->flash(0);
   echo $this->Session->flash(1);
   echo $this->Session->flash(2);
   echo $this->Session->flash(3);





	echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";
     	if ($ivr_menus){

     	   echo $this->Form->create('IvrMenu',array('type' => 'post','action'=> 'update'));
     	   echo "<table cellspacing=0>";
     	   echo $this->Html->tableHeaders(array(
 		$this->Paginator->sort('instance_id', __("Service",true)),
 		$this->Paginator->sort('title', __("Title",true)),
 		$this->Paginator->sort('modified', __("Last modified",true)),
		__("Actions",true)));

          echo $this->Form->hidden('source',array('value'=>'index'));

 
	foreach ($ivr_menus as $key => $ivr_menu){
      		$options    = array($ivr_menu['IvrMenu']['id']=>'');
                $instance   = $ext['ivr'].$ivr_menu['IvrMenu']['instance_id'];
		$title      = $ivr_menu['IvrMenu']['title'];
		$modified   = $this->Time->niceShort($ivr_menu['IvrMenu']['modified']);

	        $edit       = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "ivr_menus", "action" => "edit", $ivr_menu['IvrMenu']['id']))));
                $delete     = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "ivr_menus", "action" => "delete", $ivr_menu['IvrMenu']['id'], 'ivr'), "onClick" => "return confirm('".__('Are you sure you wish to delete this voice menu?',true)."');")));


     		$row[$key] = array(
			   $instance,
			   $title,
			   $modified,
			   array($edit.' '.$delete,array('align'=>'center')));
			   }


     		echo $this->Html->tableCells($row);
     		echo "</table>";

     } else {

     echo $this->Html->div('feedback',__("There are no voice menus created.",true));

     }

?>
