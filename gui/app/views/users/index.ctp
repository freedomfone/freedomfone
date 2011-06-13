<?php
/****************************************************************************
 * index.ctp	- List all users in system
 * version 	- 2.0.1170
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

echo $html->addCrumb('User Management', '');
echo $html->addCrumb('Users', '/users');


echo $javascript->includeScript('toggle');

echo $form->create('User',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('User',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRightAlone',$form->submit(__('Add user',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

?>
<div class='frameRightAlone'><input type="button" class="button" name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(document.User)"></div>
<div class='frameRightAlone'><input type="button" class="button" name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(document.User)"></div>
<?
     echo "<h1>".__('Users',true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
     }

   

   $options_slim = $options;
   $options[0] = __('All phone books',0);

     echo $form->create('User',array('type' => 'post','action'=> 'index','name'  => 'phone_book'));

     echo "<table cellspacing = '0' class='none'>";
     echo $html->tableCells(array($form->input('phone_book_id',array('id'=>'ServiceType','type'=>'select','options'=>$options,'label'=> false,'empty'=>'-- '.__('Select phone book',true).' --')), $form->submit(__('Submit',true),array('name' =>'submit','class' =>'button'))), array('class' => 'none'));
     echo "</table>";
     echo $form->end();

     $row = array();

     if ($users){


     echo $html->div("paginator'",$paginator->counter(array('format' => __("User:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $form->create('User',array('type' => 'post','action'=> 'process','name'  => 'User'));



     echo "<table width='800px' class='collapsed' cellspacing=0>";
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
	$id = "<input name='user[$key]['User']' type='checkbox' value='".$user['User']['id']."' id='check' class='check'>";

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
        

        $view  = $html->link($html->image("icons/view.png", array("title" => __("User details",true))), array('controller' => 'users', 'action' => 'view',$user['User']['id'] ), array('title' => 'User details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 850}); return false;"),null,false,false);	
        $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/users/edit/{$user['User']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/users/delete/{$user['User']['id']}",null, __("Are you sure you want to delete this user?",true),false);

          
             foreach($user['PhoneNumber'] as  $number){
 
               $info = $info.$number['number']."<br/>";
              
            }


        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
		$name,
		$surname,
		$email,
		$skype,
		$acl,
		$info,		
		$view.' '.$edit.' '.$delete);
	}
     
       echo $html->tableCells($row,array('class'=>'darker'));
       echo "</table>";


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
       echo $form->end();

     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }

     echo $html->div('paginator', __("Entries per page ",true).$html->link('10','index/limit:10',null, null, false)." | ".$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false));

     } else {

     echo $html->div('feedback',__('There are no users in the selected phone book.', true));

     }

?>
