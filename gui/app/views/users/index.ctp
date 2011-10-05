<?php
/****************************************************************************
 * index.ctp	- List all users in system
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

echo $html->addCrumb(__('User Management',true), '');
echo $html->addCrumb(__('Users',true), '/users');


echo $javascript->includeScript('toggle');



echo $form->create('User',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightTrans', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

$this->Access->showButton($authGroup, 'User', 'add', 'frameRightTrans', __('Add user',true), 'submit', 'button');


echo $this->Access->showCheckbox($authGroup, 'document.User', 'frameRightTrans');


     echo "<h1>".__('Users',true)."</h1>";

   // Multiple Flash messages
   if ($messages = $this->Session->read('Message')) {
       foreach($messages as $key => $value) {
              echo $this->Session->flash($key);
       }
    }

   $options_slim = $options;
   $options[0] = __('All phone books',0);

     echo $form->create('User',array('type' => 'post','action'=> 'index','name'  => 'phone_book'));

     echo "<table cellspacing = '0' class='none'>";
     echo $html->tableCells(array($form->input('phone_book_id',array('id'=>'ServiceType','type'=>'select','options'=>$options,'selected' => $session->read('users_phone_book_id'), 'label'=> false,'empty'=>'-- '.__('Select phone book',true).' --')), $form->submit(__('Submit',true),array('name' =>'submit','class' =>'button'))), array('class' => 'none'));
     echo "</table>";
     echo $form->end();

     $row = array();
     $suffix = false;
     $phone_book_id = false;

     if ($users){
     
        if(isset($this->data['User']['phone_book_id'])){
                $phone_book_id = $this->data['User']['phone_book_id'];
        } elseif($session->read('users_phone_book_id')){
                $phone_book_id = $session->read('users_phone_book_id');
        }


        if($phone_book_id){

               $suffix = __('from phone book',true).' <b>'.$options[$phone_book_id].'</b>';

        }

        echo $html->div("paginator'",$paginator->counter(array('format' => __("User",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ".$suffix)));
        echo $form->create('User',array('type' => 'post','action'=> 'process','name'  => 'User'));

        echo "<table class='collapsed' cellspacing=0>";
        echo $html->tableHeaders(array(
	'',
	$paginator->sort(__("New",true), 'User.new'),
 	$paginator->sort(__("Name",true), 'User.name'),
 	$paginator->sort(__("Surname",true), 'User.surname'),
 	$paginator->sort(__("Email",true), 'User.email'),
	$paginator->sort(__("Skype",true), 'User.skype'),
	$paginator->sort(__("Acl",true), 'Acl.name'),
 	__("Phone",true),
	__("Actions",true)));


 
      foreach ($users as $key => $user){

        echo $form->input('User.'.$user['User']['id'].'.name',array('type'=>'hidden', 'value' => $user['User']['name']));
        $status='';

        if($authGroup == 1 ){
                      $id = "<input name='user[$key]['User']' type='checkbox' value='".$user['User']['id']."' id='check' class='check'>";
        } else {
                      $id = false;
        }

	if($user['User']['new']){
		$status = $html->image("icons/star.png",array("title" => __("New",true)));
	}

	$name     = $user['User']['name'];
	$surname  = $user['User']['surname'];
	$email    = $text->autoLinkEmails($user['User']['email']);
	$skype    = $user['User']['skype'];
	$acl      = $user['Acl']['name'];


        $phone_numbers = false;
        $info = false;
        $view = $html->link(
                        $this->Html->image("icons/view.png"),
                        "/users/view/".$user['User']['id'],
                        array("escape" => false, "title" => __("User details", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 950}); return false;"),
                        false);


	$edit     = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "users", "action" => "edit", $user['User']['id']))));
        $delete   = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "users", "action" => "delete", $user['User']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this user?',true)."');")));

          
             foreach($user['PhoneNumber'] as  $number){
 
               $info = $info.$number['number']."<br/>";
              
            }


        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
     		array($name,array('width' => '100px')),
     		array($surname,array('width' => '100px')),
		$email,
		$skype,
		$acl,
		$this->Access->showBlock($authGroup, $info,'XXX'),		
		array($view.' '.$edit.' '.$delete, array('align' => 'center', 'width' => '80px')));
	}
     
       echo $html->tableCells($row,array('class'=>'darker'));
       echo "</table>";


       if($authGroup == 1) {
                     echo "<table cellspacing = '0' class='none'>";
                     echo $html->tableCells(array(__('Perform action on selected',true).': ',
                     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
                     $form->submit(__('Merge',true),  array('name' =>'data[Submit]', 'class' => 'button'))),array('class' => 'none'),array('class' => 'none'));
                     echo "</table>";

                     echo "<table cellspacing = '0' class='none'>";
                     echo $html->tableCells(array(
                     $form->input('add_phone_book_id',array('id'=>'ServiceType','type'=>'select','options'=>$options_slim,'label'=> false,'empty'=>'-- '.__('Select phone book',true).' --')),
                     $form->submit( __('Add to phone book',true), array('name' =>'data[Submit]', 'class' => 'button')),
                     $form->submit( __('Remove from phone book',true), array('name' =>'data[Submit]', 'class' => 'button'))), array('class' => 'none'),array('class' => 'none'));
                     echo "</table>";
                     }

       echo $form->end();

     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }

     echo $html->div('paginator', __("Entries per page ",true).$html->link('10','index/limit:10',null, null, false)." | ".$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false));

     } else {

     echo $html->div('feedback',__('There are no users in the selected phone book.', true));

     }

?>
