<?php 
/****************************************************************************
 * lam.ctp	- Settings for the Leave-a-message service
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

echo "<h1>".__("Leave-a-message settings",true)."</h1>";

$session->flash();

$options	  = array('label' => false);



$selected = $data['Setting']['value_string'];
echo $form->create('Setting',array('type' => 'post','action'=> 'lam'));
echo $form->input('id',array('type' => 'hidden','value'=> $data['Setting']['id']));

$rows[] = array(__("Message length",true),$form->input('value_int',array('label'=>false,'type'=>'text','value'=>$data['Setting']['value_int'])));
$rows[] = array(array($form->end(__('Save',true)),array('colspan'=>2,'align'=>'center')));


echo "<table>";
echo $html->tableCells($rows);
echo "</table>";

?>
