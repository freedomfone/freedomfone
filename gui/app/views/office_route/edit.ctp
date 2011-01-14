<?php
/****************************************************************************
 * edit.ctp	- Edit office route channel
 * version 	- 1.0.362
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


	if($this->data){

		echo "<h1>".__("Edit channel (slot ".$this->data['OfficeRoute']['id'].")",true)."</h1>";
		

   	  	if ($messages = $session->read('Message.multiFlash')) {
                   foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         	   }

                echo $html->div('frameLeft');

		echo $form->create('OfficeRoute', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );

		$row = array (array(__("Title",true),	$form->input('title',array('label'=>false,'size'=>'50'))), 
		              array(__("Phone number",true),	$form->input('msisdn',array('label'=>false,'size'=>'50'))),
     		              array(__("Operator",true),	$this->data['OfficeRoute']['operator_name']));

                echo "<table width='400px' cellspacing='0' class='blue'>"; 
                echo $html->tableCells($row,array('class' => 'blue'),array('class' => 'blue'));
                echo "</table>";

		echo $form->end(array('name'=>__('Save',true),'label' =>__('Save',true), 'class'=>'button'));

                echo "</div>";

		}

	else {
    		echo "<h1>".__("This page does not exist.",true)."</h1>";
	}

        
?>