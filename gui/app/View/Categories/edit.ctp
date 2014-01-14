<?php 
/****************************************************************************
 * edit.ctp	- Edit existing category (used in Leave-a-message)
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
      echo $this->Html->addCrumb(__('Categories',true), '/categories');
      $ivr_settings = Configure::read('IVR_SETTINGS');      

      if($this->data){

         foreach ($messages as $key => $entry){
             $messages[$key] = $this->Text->truncate($entry,$ivr_settings['showLengthMax'],array('ending' => '...', 'exact' => true, 'html' => false));
         }

         echo $this->Html->addCrumb(__('Edit',true), '/categories/edit/'.$this->data['Category']['id']);
         echo "<h1>".__("Edit Category",true)."</h1>";
         $this->Session->flash();

         $options	  = array('label' => false);
         $options_category = array('type'=>'select','multiple'=>'true','options' => $messages, 'label'=>false,'empty'=>'-- '.__('Use in none',true).' --');

         echo $this->Form->create('Category',array('type' => 'post','action'=> 'edit'));
	  echo $this->Form->hidden('Category.id', array('value' => $this->data['Category']['id']));
         echo "<table cellspacing = 0 class='stand-alone'>";
         echo $this->Html->tableCells(array (
      	   array(__("Category",true),	        $this->Form->input('name',$options)),
     	   array(__("Description",true),	$this->Form->input('longname',$options)),
     	   array(array(__("Use in message",true),array('valign' => 'top')),	$this->Form->input('Message',$options_category)),
     	   array('',	$this->Form->end(__('Save',true)))),
           array('class' => 'stand-alone'),array('class' => 'stand-alone'));
         echo "</table>";

      }  else {

         echo $this->Html->div("invalid_entry", __("This page does not exist.",true));

      }

?>

