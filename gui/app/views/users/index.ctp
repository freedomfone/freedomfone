<?php
/****************************************************************************
 * index.ctp	- List all contacts in system
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

$session->flash();
echo $javascript->includeScript('toggle');

echo $form->create('User',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('User',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRight',$form->submit(__('Add contact',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__('Contacts',true)."</h1>";


     if ($users){


echo $html->div("",$paginator->counter(array('format' => __("User:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
echo $form->create('User',array('type' => 'post','action'=> 'process','name'  => 'User'));

?>
<input type="button" name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(document.User)">
<input type="button" name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(document.User)">
<?


echo "<table width='100%'>";
echo $html->tableHeaders(array(
	'',
	$paginator->sort(__("New",true), 'new'),
 	$paginator->sort(__("Name",true), 'name'),
 	$paginator->sort(__("Surname",true), 'surname'),
 	$paginator->sort(__("Email",true), 'email'),
	$paginator->sort(__("Skype",true), 'skype'),
 	$paginator->sort(__("Acl",true), 'Acl.name'),
 	$paginator->sort(__("Phone",true), 'phone1'),
 	$paginator->sort(__("Country",true), 'Country.name_en'),
	__("Edit",true),
	__("Delete",true)));


 
      foreach ($users as $key => $user){

      $status='';
	$id = "<input name='user[$key]['User']' type='checkbox' value='".$user['User']['id']."' id='check' class='check'>";

	if($user['User']['new']){
		$status = $html->image("icons/star.png",array("title" => __("New",true)));
	}

	$name     = $user['User']['name'];
	$surname     = $user['User']['surname'];
	$email     = $text->autoLinkEmails($user['User']['email']);
	$skype     = $user['User']['skype'];
	$acl       = $user['Acl']['name'];
	$phone1     = $user['User']['phone1'];
	$country     = $user['Country']['name_en'];

	$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/users/edit/{$user['User']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/users/delete/{$user['User']['id']}",null, __("Are you sure you want to delete this user?",true),false);


        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
		$name,
		$surname,
		$email,
		$skype,
		$acl,
		$phone1,		
		$country,
		$edit,
		$delete);
	}
     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";

 
    echo "<table>";
     echo $html->tableCells(array(
     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
     $form->submit( __('Move to Archive',true), array('name' =>'data[Submit]', 'class' => 'button')), 
     $paginator->numbers()));
     echo "</table>";
     echo $form->end();

$count = $this->params['paging']['User']['count'];
echo "<span>".__("No of users per page: ",true);
echo $html->link('10','index/limit:10',null, null, false)." | ";
echo $html->link('25','index/limit:25',null, null, false)." | ";
echo $html->link('50','index/limit:50',null, null, false)." | " ;
echo $html->link(__('All',true),'index/limit:'.$count,null, null, false) ;

echo "</span>";
     }

?>
