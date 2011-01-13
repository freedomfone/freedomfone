<?php
/****************************************************************************
 * index.ctp	- List all categories (used in Leave-a-message)
 * version 	- 2.0.1139
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

echo $form->create('Category',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRightAlone',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();
echo "<h1>".__("Categories",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {                                                     
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);                                  
        }  

     if ($categories){

        foreach ($categories as $key => $category){

      		   $title 	= $category['Category']['name'];
      		   $description = $category['Category']['longname'];		   
  		   $edit 	= $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/categories/edit/{$category['Category']['id']}",null, null, false);
      		   $delete 	= $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/categories/delete/{$category['Category']['id']}",null, __("Are you sure you want to delete this category?",true),false);
      		   
                   $row[$key] = array($title, $description,$edit,$delete);

        }

        echo "<table width='500px' cellspacing=0 >";
        echo $html->tableHeaders(array(__('Category',true),__('Description',true),__('Edit',true),__('Delete',true)));
        echo $html->tableCells($row);
        echo "</table>";

     } else {

        echo $html->div('feedback', __('No categories exist. Please create one by clicking the <i>Create new</i> button to the right.',true));
     }


?>