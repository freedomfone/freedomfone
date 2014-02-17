<?php
/****************************************************************************
 * edit.ctp	- Edit Mobigater channel
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

echo $this->Html->addCrumb(__('Dashboard',true), '');
echo $this->Html->addCrumb(__('GSM channels',true), '/channels');


     if($this->data){

                echo $this->Html->addCrumb(__('Edit GSMOpen channel',true), '/channels/edit/'.$this->data['Channel']['id']);
		echo "<h1>".__("Edit GSMOpen channel",true)."</h1>";

                echo $this->Session->flash();

		echo $this->Form->create('Channel', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
		echo $this->Form->hidden('id', array('value' => $this->data['Channel']['id']));	
                $rows = array(
     		     array(__("Title",true),	$this->Form->input('title',array('label'=>false,'size'=>'50'))),
     		     array(__("Phone number",true),	$this->Form->input('msisdn',array('label'=>false,'size'=>'50'))),
     		     array(__("IMSI",true),	$this->data['Channel']['imsi']),
     		     array(__("IMEI",true),	$this->data['Channel']['imei']));


               echo "<div class='frameLeft'>";
     	       echo "<table width='95%' cellspacing=0 class='blue'>";
               echo $this->Html->tableCells($rows,array('class' => 'blue'),array('class' => 'blue'));
	       echo "</table>";

		echo $this->Form->end(array('name'=>__('Save',true),'label' =>__('Save',true), 'class'=>'save_button'));
                echo "</div>";
		}

	else {
    		echo "<h1>".__("This page does not exist.",true)."</h1>";
	}

?>

