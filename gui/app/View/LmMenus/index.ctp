<?php
/****************************************************************************
 * index.ctp	- List existing Leave-a-message IVR menus. Provide links to Add, Edit and Delete.
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

echo $this->Html->addCrumb(__('Message Centre',true), '');
echo $this->Html->addCrumb(__('Leave-a-message',true), '/lm_menus');


$ext = Configure::read('EXTENSIONS');


$this->Access->showButton($authGroup, 'LmMenu', 'create', 'frameRightAlone', __('Create new',true), 'submit', 'button');


echo "<h1>".__('Manage Leave-a-message',true)."</h1>";
echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";

 echo $this->Session->flash();               


     	if ($lm_menus){

     	   echo "<table cellspacing=0>";
     	   $headers = array( $this->Paginator->sort('instance_id', __("Service",true) ),
 		             $this->Paginator->sort('title', __("Title",true)),
 		             $this->Paginator->sort('created' , __("Created",true)),
		             __("Actions",true)
                             );

           if($authGroup != 1 ) { unset($headers[3]);}
     	   echo $this->Html->tableHeaders($headers);


	foreach ($lm_menus as $key => $lm_menu){
  		$instance_id   = $ext['lam'].$lm_menu['LmMenu']['instance_id'];
		$title         = $lm_menu['LmMenu']['title'];
		$created       = $this->Time->niceShort($lm_menu['LmMenu']['created']);
                $edit          = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "lm_menus", "action" => "edit", $lm_menu['LmMenu']['id']))));
                $delete        = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "lm_menus", "action" => "delete", $lm_menu['LmMenu']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this Leave-a-message IVR menu?',true)."');")));



                $row[$key] = array(
                           $instance_id,
			   $title,
			   $created,		
			   array($edit.' '.$delete, array('align'=>'center')));

               if($authGroup != 1 ) { unset($row[$key][3]);}
     	   

	   }

     	   echo $this->Html->tableCells($row);
     	   echo "</table>";

         } else {

         echo $this->Html->div('feedback', __('No Leave-a-Message menus exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

         }

?>
	