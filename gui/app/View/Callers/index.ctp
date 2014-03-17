<?php
/****************************************************************************
 * index.ctp	- List all callers in system
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
echo $this->Html->addCrumb(__('Callers',true), '/callers');


$config   = Configure::read('SWEEP_CONFIG');
$settings = Configure::read('SWEEP_SETTINGS');
$mode     = $config['mode'];

echo $this->Html->script('toggle');



echo $this->Form->create('Caller',array('type' => 'post','action'=> 'index'));
echo $this->Html->div('frameRightTrans', $this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();

$this->Access->showButton($authGroup, 'Caller', 'add', 'frameRightTrans', __('Add caller',true), 'submit', 'button');


echo $this->Access->showCheckbox($authGroup, 'document.Caller', 'frameRightTrans');


     echo "<h1>".__('Callers',true)."</h1>";

     echo $this->Session->flash();
   


   $options_slim = $options;
   $options['all'] = __('All callers','all');


     echo $this->Form->create('Caller',array('type' => 'post','action'=> 'index','name'  => 'phone_book'));

     echo "<table  cellspacing = '0' class='none'>";
     echo $this->Html->tableCells(array($this->Form->input('phone_book_id',array('id'=>'ServiceType','type'=>'select','options'=>$options,'selected' => $this->Session->read('callers_phone_book_id'), 'label'=> false,'empty'=>'-- '.__('Select phone book',true).' --')), $this->Form->submit(__('Submit',true),array('name' =>'submit','class' =>'button'))), array('class' => 'none'));
     echo "</table>";
     echo $this->Form->end();

     $row = array();
     $suffix = false;
     $phone_book_id = false;

     if ($callers){
     
        if(isset($this->data['Caller']['phone_book_id'])){
                $phone_book_id = $this->data['Caller']['phone_book_id'];
        } elseif($this->Session->read('callers_phone_book_id')){
                $phone_book_id = $this->Session->read('callers_phone_book_id');
        }


        if($phone_book_id){

               $suffix = __('from phone book',true).' <b>'.$options[$phone_book_id].'</b>';

        }

        echo $this->Html->div("paginator'",$this->Paginator->counter(array('format' => __("Caller",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ".$suffix)));
        echo $this->Form->create('Caller',array('type' => 'post','action'=> 'process','name'  => 'Caller'));

        echo "<table width='90%' class='collapsed' cellspacing=0>";
        echo $this->Html->tableHeaders(array(
	'',
	$this->Paginator->sort('Caller.new',__("New",true)),
 	$this->Paginator->sort('Caller.name', __("Name",true)),
 	$this->Paginator->sort('Caller.surname', __("Surname",true)),
 	$this->Paginator->sort('Caller.email', __("Email",true)),
	$this->Paginator->sort('Caller.skype', __("Skype",true)),
	$this->Paginator->sort('Acl.name', __("Acl",true)),
 	__("Phone",true),
	__("Actions",true)));


 
      foreach ($callers as $key => $caller){
  
        $status='';

        if($authGroup == 1 ){
                      $id = "<input name='caller[$key]['Caller']' type='checkbox' value='".$caller['Caller']['id']."' id='check' class='check'>";
        } else {
                      $id = false;
        }

	if($caller['Caller']['new']){
		$status = $this->Html->image("icons/star.png",array("title" => __("New",true)));
	}

	$name     = $caller['Caller']['name'];
	$surname  = $caller['Caller']['surname'];
	$email    = $this->Text->autoLinkEmails($caller['Caller']['email']);
	$skype    = $caller['Caller']['skype'];
	$acl      = $caller['Acl']['name'];


        $phone_numbers = false;
        $info = false;
        $view = $this->Html->link(
                        $this->Html->image("icons/view.png"),
                        "/callers/view/".$caller['Caller']['id'],
                        array("escape" => false, "title" => __("Caller details", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 950}); return false;"),
                        false);


	$edit     = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "callers", "action" => "edit", $caller['Caller']['id']))));
        $delete   = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "callers", "action" => "delete", $caller['Caller']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this caller?',true)."');")));

          
             foreach($caller['PhoneNumber'] as  $number){
 
               $info = $info.$number['number']."<br/>";
              
            }



        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
     		array($this->Access->showBlock($authGroup, $name, $settings['Caller'][$mode]['name']),array('width' => '100px')),
     		array($this->Access->showBlock($authGroup, $surname, $settings['Caller'][$mode]['surname']),array('width' => '100px')),
     		array($this->Access->showBlock($authGroup, $email, $settings['Caller'][$mode]['email']),array('width' => '100px')),
     		array($this->Access->showBlock($authGroup, $skype, $settings['Caller'][$mode]['skype']),array('width' => '100px')),
		$acl,
		$this->Access->showBlock($authGroup, $info,$settings['PhoneNumber'][$mode]['number']),		
		array($view.' '.$edit.' '.$delete, array('align' => 'center', 'width' => '80px')));
	}
     
       echo $this->Html->tableCells($row,array('class'=>'darker'));
       echo "</table>";


       if($authGroup == 1) {
                     echo "<table cellspacing = '0' class='none'>";
                     echo $this->Html->tableCells(array(__('Perform action on selected',true).': ',
                     $this->Form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
                     $this->Form->submit(__('Merge',true),  array('name' =>'data[Submit]', 'class' => 'button'))),array('class' => 'none'),array('class' => 'none'));
                     echo "</table>";

                     echo "<table cellspacing = '0' class='none'>";
                     echo $this->Html->tableCells(array(
                     $this->Form->input('add_phone_book_id',array('id'=>'ServiceType','type'=>'select','options'=>$options_slim,'label'=> false,'empty'=>'-- '.__('Select phone book',true).' --')),
                     $this->Form->submit( __('Add to phone book',true), array('name' =>'data[Submit]', 'class' => 'button')),
                     $this->Form->submit( __('Remove from phone book',true), array('name' =>'data[Submit]', 'class' => 'button'))), array('class' => 'none'),array('class' => 'none'));
                     echo "</table>";
                     }

       echo $this->Form->end();

     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }

     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('10','index/limit:10',null, null, false)." | ".$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false));

     } else {

     echo $this->Html->div('feedback',__('There are no callers in the selected phone book.', true));

     }

?>
