<?php
/****************************************************************************
 * index.ctp	- List all tags (used in Leave-a-message)
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


echo $form->create('Tag',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRight',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__("Manage Tags",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {                                                     
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);                                  
        }  


   if ($tags){

      echo "<table width='400px' cellspacing = 0>";
      echo $html->tableHeaders(array(__('Tag',true),__('Description',true),__('Edit',true),__('Delete',true)));


      	      foreach ($tags as $key => $tag){

      	      	         $title      = $tag['Tag']['name'];
      			 	        $description = $tag['Tag']['longname'];		   
  						        $edit 				   = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/tags/edit/{$tag['Tag']['id']}",null, null, false);
      											      $delete 					= $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/tags/delete/{$tag['Tag']['id']}",null, __("Are you sure you want to delete this tag?",true),false);
      											      						   

     $row[$key] = array($title, $description,$edit,$delete);

      		     }

     echo $html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {
      echo "<div class='instruction'>".__("No tags exist. Please create one by clicking the 'Create new' button to the right.")."</div>";

      }

?>