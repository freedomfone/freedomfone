<?php 
/****************************************************************************
 * edit.ctp	- Edits user data in phone book
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


      if($data){

     $button = $form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'button'));

     echo "<fieldset>";

     echo "<h1>".__("Edit contact",true)."</h1>";

     echo $form->create('User',array('type' => 'post','action'=> 'edit'));
     echo $form->hidden('new',array('value'=>0));


     if(! $skype = $data['User']['skype']){ $skype = $form->input('skype',array('label'=>false));}
     if(! $phone1 = $data['User']['phone1']){ $phone1 = $form->input('phone1',array('label'=>false));}
     if (! $last_seen = $data['User']['last_epoch']){ $last_seen= __('Never',true);}

     echo "<div class='frameLeft'>";
     echo "<table>";
     echo $html->tableCells(array (
     array(array($html->div('table_sub_header',__('User data',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("Name",true),			$form->input('name',array('label'=>false))),
     array(__("Surname",true),			$form->input('surname',array('label'=>false))),
     array(__("Email",true),			$form->input('email',array('label'=>false))),
     array(__("Skype",true),			$skype),
     array(__("Phone number",true),		$phone1),
     array(__("Organization",true),		$form->input('organization',array('label'=>false))),
     array(__("Country",true),			$form->input('country_id',array('type'=>'select','options'=>$countries, 'empty'=>'- '.__('Select country',true).' -','label'=>false))),
     array(__("ACL",true),			$form->input('acl_id',array('type'=>'select','options'=>$acls, 'label'=>false))),
     array(__("Phone book",true),		$form->input('PhoneBook',array('type'=>'select','options'=>$phonebook, 'empty'=>'- '.__('Select phone book',true).' -','label'=>false))),
     array( $button,'')
     ));
     echo "</table>";
     echo $form->end(); 
     echo "</div>";



     echo "<div class='frameRight'>";
     echo "<table>";
     echo $html->tableCells(array (
     array(array($html->div('table_sub_header',__('Statistics',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("In the system since",true),	date('Y-m-d',$data['User']['created'])),
     array(__("Last seen",true),		$last_seen),
     array(__("First application",true),	$formatting->appMatch($data['User']['first_app'])),
     array(__("Last application",true),	     	$formatting->appMatch($data['User']['last_app'])),
     array(array($html->div('table_sub_header',__('Activity',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("Poll",true),			$data['User']['count_poll']),
     array(__("Voice Menu",true),		$data['User']['count_ivr']),
     array(__("Leave-a-message",true),		$data['User']['count_lam'])
     ));
     echo "</table>";
     echo "</div>";

    echo "</fieldset>";
    }
    else {

    echo "<h1>".__("No user with this id exists",true)."</h1>";
    }

 

?>

