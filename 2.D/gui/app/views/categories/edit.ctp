<?php 
/****************************************************************************
 * edit.ctp	- Edit existing category (used in Leave-a-message)
 * version 	- 2.0.1200
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

      echo $html->addCrumb(__('Message Centre',true), '');
      echo $html->addCrumb(__('Categories',true), '/categories');
      $ivr_settings = Configure::read('IVR_SETTINGS');      

      if($this->data){

         foreach ($messages as $key => $entry){
             $messages[$key] = $text->truncate($entry,$ivr_settings['showLengthMax'],'...',true,false);
         }

         echo $html->addCrumb(__('Edit',true), '/categories/edit/'.$this->data['Category']['id']);
         echo "<h1>".__("Edit Category",true)."</h1>";
         $session->flash();

         $options	  = array('label' => false);
         $options_category = array('type'=>'select','multiple'=>'true','options' => $messages, 'label'=>false,'empty'=>'-- '.__('Use in none',true).' --');

         echo $form->create('Category',array('type' => 'post','action'=> 'edit'));
         echo "<table cellspacing = 0 class='stand-alone'>";
         echo $html->tableCells(array (
      	   array(__("Category",true),	        $form->input('name',$options)),
     	   array(__("Description",true),	$form->input('longname',$options)),
     	   array(array(__("Use in message",true),array('valign' => 'top')),	$form->input('Message',$options_category)),
     	   array('',	$form->end(__('Save',true)))),
           array('class' => 'stand-alone'),array('class' => 'stand-alone'));
         echo "</table>";

      }  else {

         echo $html->div("invalid_entry", __("This page does not exist.",true));

      }

?>

