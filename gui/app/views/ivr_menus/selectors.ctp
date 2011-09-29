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

echo $html->addCrumb(__('IVR Centre',true), '');
echo $html->addCrumb(__('Language selectors',true), '/selectors');


$this->Access->showButton($authGroup, 'IvrMenu', 'add_selector', 'frameRightAlone', __('Create new',true), 'submit', 'button');


$ext = Configure::read('EXTENSIONS');

echo "<h1>".__('Language selectors',true)."</h1>";

   // Multiple Flash messages
   if ($messages = $this->Session->read('Message')) {
        foreach($messages as $key => $value) {
             echo $this->Session->flash($key);
        }
    }



     $types = array('lam' => __('Leave-a-message',true),'ivr' => __('Voice Menu',true), 'node' => __('Content',true));

     $switchers = $ivr_menus;
     	if ($switchers){

     	   echo "<table cellspacing=0>";
     	   echo $html->tableHeaders(array(
 		$paginator->sort(__("Service",true), 'instance_id'),
 		$paginator->sort(__("Title",true), 'title'),
 		$paginator->sort(__("Type",true), 'type'),
 		$paginator->sort(__("Last modified",true), 'modified'),
		__("Actions",true)));
          
		

	foreach ($switchers as $key => $switcher){
		$instance_id  = $ext['ivr'].$switcher['IvrMenu']['instance_id'];
		$title        = $switcher['IvrMenu']['title'];
		$type         = $types[$switcher['IvrMenu']['switcher_type']];
		$modified     = $time->niceShort($switcher['IvrMenu']['modified']);
                $edit         = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "selectors", "action" => "edit", $switcher['IvrMenu']['id']))));  
                $delete       = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "selectors", "action" => "delete", $switcher['IvrMenu']['id'].'/switcher'), "onClick" => "return confirm('".__('Are you sure you wish to delete this language selector?',true)."');")));

     		$row[$key] = array(
                           $instance_id,
			   $title,
			   $type,
                           $modified,		
			   array($edit.' '.$delete,array('align'=>'center')));
			   }


     		echo $html->tableCells($row,array('class'=>'darker'));
     		echo "</table>";
     }   else {

     echo $html->div('feedback',__("No language selectors exist. Please create one by clicking the <i>Create new</i> button to the right.",true));

     }

?>
