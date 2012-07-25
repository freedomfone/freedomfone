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

echo $html->addCrumb(__('IVR Centre',true), '');
echo $html->addCrumb(__('Voice menus',true), '/ivr_menus');

$ext = Configure::read('EXTENSIONS');

$this->Access->showButton($authGroup, 'IvrMenu', 'add', 'frameRightAlone', __('Create new',true), 'submit', 'button');


   $info = $html->link(
                        $this->Html->image("icons/bulb.png"),
                        "/pages/ivr_menus/tip",
                        array("escape" => false, "title" => __("Tool tip", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 500}); return false;"),
                        false);

   echo $html->div('frameInfo', $info);
   echo "<h1>".__('Voice menus',true)."</h1>";

       // Multiple Flash messages
       if ($messages = $this->Session->read('Message')) {
            foreach($messages as $key => $value) {
                       echo $this->Session->flash($key);
            }
       }




	echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";
     	if ($ivr_menus){

     	   echo $form->create('IvrMenu',array('type' => 'post','action'=> 'update'));
     	   echo "<table cellspacing=0>";
     	   echo $html->tableHeaders(array(
 		$paginator->sort(__("Service",true), 'instance_id'),
 		$paginator->sort(__("Title",true), 'title'),
 		$paginator->sort(__("Last modified",true), 'modified'),
		__("Actions",true)));

          echo $form->hidden('source',array('value'=>'index'));

 
	foreach ($ivr_menus as $key => $ivr_menu){
      		$options    = array($ivr_menu['IvrMenu']['id']=>'');
                $instance   = $ext['ivr'].$ivr_menu['IvrMenu']['instance_id'];
		$title      = $ivr_menu['IvrMenu']['title'];
		$modified   = $time->niceShort($ivr_menu['IvrMenu']['modified']);

	        $edit       = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "ivr_menus", "action" => "edit", $ivr_menu['IvrMenu']['id']))));
                $delete     = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "ivr_menus", "action" => "delete", $ivr_menu['IvrMenu']['id'].'/ivr'), "onClick" => "return confirm('".__('Are you sure you wish to delete this voice menu?',true)."');")));


     		$row[$key] = array(
			   $instance,
			   $title,
			   $modified,
			   array($edit.' '.$delete,array('align'=>'center')));
			   }


     		echo $html->tableCells($row);
     		echo "</table>";

     } else {

     echo $html->div('feedback',__("There are no voice menus created.",true));

     }

?>
