<?php
/****************************************************************************
 * selectors.ctp	- List language selectors
 * version 	        - 1.0.359
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

echo $form->create('IvrMenu',array('type' => 'post','action'=> 'add_switcher'));
echo $html->div('frameRight',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__('Languge selectors',true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
     }

     $types = array('lam' => __('Leave-a-message',true),'ivr' => __('Voice Menu',true), 'node' => __('Content',true));

     $switchers = $ivr_menus;
     	if ($switchers){

     	   echo "<table width=100%>";
     	   echo $html->tableHeaders(array(
 		$paginator->sort(__("Title",true), 'title'),
 		$paginator->sort(__("Type",true), 'type'),
 		$paginator->sort(__("Created",true), 'created'),
 		$paginator->sort(__("Modified",true), 'created'),
		__("Edit",true),
		__("Delete",true)));
          
		

	foreach ($switchers as $key => $switcher){

		$title        = $switcher['IvrMenu']['title'];
		$type         = $types[$switcher['IvrMenu']['switcher_type']];
		$created      = $time->niceShort($switcher['IvrMenu']['created']);
		$modified     = $time->niceShort($switcher['IvrMenu']['modified']);
		$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/selectors/edit/{$switcher['IvrMenu']['id']}",null, null, false);
		$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/selectors/delete/{$switcher['IvrMenu']['id']}/switcher",null, __("Are you sure you want to delete this language selector?",true),false);

     		$row[$key] = array(
			   array($title,array('width'=>'100px')),
			   array($type,array('width'=>'100px')),
			   $created,		
                           $modified,		
			   array($edit,array('align'=>'center')),
			   array($delete,array('align'=>'center')));
			   }


     		echo $html->tableCells($row,array('class'=>'darker'));
     		echo "</table>";
     }   else {

     echo $html->div('instruction',__("There are no language selectors created",true));

     }

?>
