<?php
/****************************************************************************
 * index.ctp	- List all tags (used in Leave-a-message)
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
echo $html->addCrumb(__('Tags',true), '/tags');

$this->Access->showButton($authGroup, 'Tag', 'add', 'frameRightAlone', __('Create new',true), 'submit', 'button');
echo "<h1>".__("Tags",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {                                                     
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);                                  
        }  


   if ($tags){

      echo "<table width='400px' cellspacing = 0>";
      $headers = array(__('Tag',true),__('Description',true), __('Actions', true));
      if($authGroup != 1 ){ unset($headers[2]); }

      echo $html->tableHeaders($headers);

      	      foreach ($tags as $key => $tag){

      	      	         $title       = $tag['Tag']['name'];
 			 $description = $tag['Tag']['longname'];		   
                         $edit        = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "tags", "action" => "edit", $tag['Tag']['id']))));
                         $delete      = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "tags", "action" => "delete", $tag['Tag']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this tag?',true)."');")));

                         $row[$key] = array($title, $description, $edit.' '.$delete);
                         if($authGroup != 1) { unset($row[$key][2]);}

              }

     echo $html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {

         echo $html->div('feedback', __('No tags exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

      }

?>