<?php
/****************************************************************************
 * index.ctp	- List all phone books (used for Contacts)
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

echo $this->Html->addCrumb(__('Caller Management',true), '');
echo $this->Html->addCrumb(__('Phone books',true), '/phone_books');


$this->Access->showButton($authGroup, 'PhoneBook', 'add', 'frameRightAlone', __('Create new',true), 'submit', 'button');

   echo "<h1>".__("Phone books",true)."</h1>";
   echo $this->Session->flash();
  

   if ($data){

     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Phone book:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));



      echo "<table width='500px' class='collapsed' cellspacing=0>";
      echo $this->Html->tableHeaders(array(__('Phone book',true),__('Description',true),__('Actions',true)));

      	   foreach ($data as $key => $phone_book){

      	      $title 	   = $phone_book['PhoneBook']['name'];
      	      $description = $phone_book['PhoneBook']['description'];		   
	      $edit        = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "phone_books", "action" => "edit", $phone_book['PhoneBook']['id']))));
              $delete      = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "phone_books", "action" => "delete", $phone_book['PhoneBook']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this phone book?',true)."');")));
	      $export      = $this->Access->showBlock($authGroup, $this->Html->image("icons/export-16.png", array("alt" => __("Export",true), "title" => __("Export",true), "url" => array("controller" => "phone_books", "action" => "export", $phone_book['PhoneBook']['id']))));


              $row[$key] = array($title, $description,$edit.' '.$delete.' '.$export);


            }

         echo $this->Html->tableCells($row);
         echo "</table>";

     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false)." | ".$this->Html->link('100','index/limit:100',null, null, false));





   }   else {
      
      echo $this->Html->div('feedback', __('No phone books exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

   }

?>