<?php
/****************************************************************************
 * index.ctp	- List all categories (used in Leave-a-message)
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

echo $html->addCrumb(__('Message Centre',true), '');
echo $html->addCrumb(__('Categories',true), '/categories');

$this->Access->showButton($authGroup, 'Category', 'add', 'frameRightAlone', __('Create new',true), 'submit', 'button');


echo "<h1>".__("Categories",true)."</h1>";

        // Multiple Flash messages
        if ($messages = $this->Session->read('Message')) {
                foreach($messages as $key => $value) {
                  if(is_int($key)){ echo $this->Session->flash($key);}
                }
        }

     if ($categories){

        foreach ($categories as $key => $category){

      		   $title 	= $category['Category']['name'];
      		   $description = $category['Category']['longname'];		   
                   $edit        = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "categories", "action" => "edit", $category['Category']['id'])));
                   $delete      = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "categories", "action" => "delete", $category['Category']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this category?',true)."');"));
      	
                   $row[$key] = array($title, $description, $edit.' '.$delete);
                   if($authGroup != 1) { unset($row[$key][2]);}


        }

        echo "<table width='500px' cellspacing=0 >";

        $headers = array(__('Category',true),__('Description',true), __('Actions', true));
        if($authGroup != 1 ){ unset($headers[2]); }
        echo $html->tableHeaders($headers);

        
        echo $html->tableCells($row);
        echo "</table>";

     } else {

        echo $html->div('feedback', __('No categories exist. Please create one by clicking the <i>Create new</i> button to the right.',true));
     }


?>