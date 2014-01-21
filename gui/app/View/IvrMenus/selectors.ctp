<?php
/****************************************************************************
 * selectors.ctp	- List language selectors
 * version 	        - 3.0.1500
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
echo $this->Html->addCrumb(__('Language selectors',true), '/selectors');

$this->Access->showButton($authGroup, 'IvrMenu', 'add_selector', 'frameRightAlone', __('Create new',true), 'submit', 'button');


$ext = Configure::read('EXTENSIONS');

echo "<h1>".__('Language selectors',true)."</h1>";

echo $this->Session->flash();

$types = array('lam' => __('Leave-a-message',true),'ivr' => __('Voice Menu',true), 'node' => __('Content',true));

     $switchers = $ivr_menus;
     	if ($switchers){

     	   echo "<table cellspacing=0>";
     	   echo $this->Html->tableHeaders(array(
 		$this->Paginator->sort('instance_id', __("Service",true)),
 		$this->Paginator->sort('title', __("Title",true)),
 		$this->Paginator->sort('type', __("Type",true)),
 		$this->Paginator->sort('modified', __("Last modified",true)),
		__("Actions",true)));
 

	foreach ($switchers as $key => $switcher){


		$instance_id  = $ext['ivr'].$switcher['IvrMenu']['instance_id'];
		$title        = $switcher['IvrMenu']['title'];
		$type         = $types[$switcher['IvrMenu']['switcher_type']];
		$modified     = $this->Time->niceShort($switcher['IvrMenu']['modified']);
                $edit         = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "selectors", "action" => "edit", $switcher['IvrMenu']['id']))));  
                $delete       = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "selectors", "action" => "delete", $switcher['IvrMenu']['id'], 'switcher'), "onClick" => "return confirm('".__('Are you sure you wish to delete this language selector?',true)."');")));

     		$row[$key] = array(
                           $instance_id,
			   $title,
			   $type,
                           $modified,		
			   array($edit.' '.$delete,array('align'=>'center')));
			   }


     		echo $this->Html->tableCells($row,array('class'=>'darker'));
     		echo "</table>";
     }   else {

     echo $this->Html->div('feedback',__("No language selectors exist. Please create one by clicking the <i>Create new</i> button to the right.",true));

     }

?>
