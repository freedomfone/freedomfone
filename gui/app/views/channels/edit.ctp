<?php
/****************************************************************************
 * edit.ctp	- Edit Mobigater channel
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

		echo "<h1>".__("Edit channel",true)."</h1>";
		

   	  	if ($messages = $session->read('Message.multiFlash')) {
                   foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         	   }


		echo $form->create('Channel', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );


     	       echo "<table width='95%' cellspacing=0>";
		echo $html->tableCells(array (
     		     array(__("Title",true),	$form->input('title',array('label'=>false,'size'=>'50')))));
		echo $html->tableCells(array (
     		     array(__("Phone number",true),	$form->input('msisdn',array('label'=>false,'size'=>'50')))));
                echo $html->tableCells(array (
     		     array(__("IMSI",true),	$this->data['Channel']['imsi'])));
		echo "</table>";

		echo $form->end(__('Save',true));

		}

	else {
    		echo "<h1>".__("This page does not exist.",true)."</h1>";
	}

?>