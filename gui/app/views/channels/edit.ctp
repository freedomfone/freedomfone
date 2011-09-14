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

echo $html->addCrumb(__('Dashboard',true), '');
echo $html->addCrumb(__('GSM channels',true), '/channels');



	if($this->data){

                echo $html->addCrumb(__('Edit Mobigater',true), '/channels/edit/'.$this->data['Channel']['id']);
		echo "<h1>".__("Edit channel",true)."</h1>";
		

   	  	if ($messages = $session->read('Message.multiFlash')) {
                   foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         	   }


		echo $form->create('Channel', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
	
                $rows = array(
     		     array(__("Title",true),	$form->input('title',array('label'=>false,'size'=>'50'))),
     		     array(__("Phone number",true),	$form->input('msisdn',array('label'=>false,'size'=>'50'))),
     		     array(__("IMSI",true),	$this->data['Channel']['imsi']),
     		     array(__("IMEI",true),	$this->data['Channel']['imei']));


               echo "<div class='frameLeft'>";
     	       echo "<table width='95%' cellspacing=0 class='blue'>";
               echo $html->tableCells($rows,array('class' => 'blue'),array('class' => 'blue'));
	       echo "</table>";

		echo $form->end(array('name'=>__('Save',true),'label' =>__('Save',true), 'class'=>'save_button'));
                echo "</div>";
		}

	else {
    		echo "<h1>".__("This page does not exist.",true)."</h1>";
	}

?>

