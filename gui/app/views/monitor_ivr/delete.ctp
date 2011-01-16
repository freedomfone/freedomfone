<?php
/****************************************************************************
 * delete.ctp	- Display form for deleting IVR monitoring data.
 * version 	- 2.0.1160
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

echo "<h1>".__("Delete monitoring data",true)."</h1>";
echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'delete'));

echo "<table cellspacing = 0 class='stand-alone'>";
echo $html->tableCells(array (
     array(__("Start time",true),	$form->input('start_time',array('label'=>false,'type' => 'datetime', 'interval' => 15, 'selected' => $start))),
     array(__("End time",true),		$form->input('end_time',array('label'=>false,'type' => 'datetime','interval' =>15, 'selected' => $end)))
      ),array('class'=>'stand-alone'), array('class' => 'stand-alone'));
echo "</table>";

echo $form->end(array('name' => __('Delete',true), 'label' =>__('Delete',true),'class' =>'button'));


?>