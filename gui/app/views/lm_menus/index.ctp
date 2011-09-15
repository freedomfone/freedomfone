<?php
/****************************************************************************
 * index.ctp	- List existing Leave-a-message IVR menus. Provide links to Add, Edit and Delete.
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

echo $html->addCrumb('Message Centre', '');
echo $html->addCrumb('Leave-a-message', '/lm_menus');


$ext = Configure::read('EXTENSIONS');

echo $form->create('LmMenu',array('type' => 'post','action'=> 'create'));
echo $html->div('frameRightAlone',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();
echo "<h1>".__('Manage Leave-a-message',true)."</h1>";
echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";


     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }


     	if ($lm_menus){

     	   echo "<table cellspacing=0>";
     	   echo $html->tableHeaders(array(
 		$paginator->sort(__("Service",true), 'instance_id'),
 		$paginator->sort(__("Title",true), 'title'),
 		$paginator->sort(__("Created",true), 'created'),
		__("Edit",true),
		__("Delete",true)));


	foreach ($lm_menus as $key => $lm_menu){
  		$instance_id      = $ext['lam'].$lm_menu['LmMenu']['instance_id'];
		$title         = $lm_menu['LmMenu']['title'];
		$created       = $time->niceShort($lm_menu['LmMenu']['created']);
                $edit      = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "lm_menus", "action" => "edit", $lm_menu['LmMenu']['id'])));
                $delete      = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "lm_menus", "action" => "delete", $lm_menu['LmMenu']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this Leave-a-message IVR menu?',true)."');"));

        


                $row[$key] = array(
                           $instance_id,
			   $title,
			   $created,		
			   array($edit,array('align'=>'center')),
			   array($delete,array('align'=>'center')));
	   }

     	   echo $html->tableCells($row);
     	   echo "</table>";

         } else {

         echo $html->div('feedback', __('No Leave-a-Message menus exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

         }

?>
