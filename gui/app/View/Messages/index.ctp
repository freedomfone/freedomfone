<?php
/****************************************************************************
 * index.ctp	- List all Leave-a-message messages
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

      echo $this->Html->script('toggle');
      
      echo $this->Html->addCrumb(__('Message Centre',true), '');
      echo $this->Html->addCrumb(__('Inboxes',true), '/messages');

      echo "<h1>".__('Audio Messages',true)."</h1>";
      echo $this->Html->div('feedback', __('Please select one or more criteria below.',true));
      $rates = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5);
      $limits = array(10 => 10, 25 => 25, 50 => 50);
      $order = array('Category.id' => __('Category',true),'Message.rate' => __('Rate',true), 'Message.instance_id' => __('Service',true),'Message.length' => __('Length',true), 'Message.created' => __('Time',true),'Message.new' => __('New message',true));
      $dir = array('ASC' => __('Ascending', true), 'DESC' => __('Descending',true));

      $instances = array_unique($instances);

      foreach ($instances as $key => $instance){

       $services[$instance] = '2'.$instance;
       ksort($services);


      }

      $this->Session->flash();
      echo $this->Form->create("Message", array('id' => 'MessageSelection'));
     echo $this->Form->hidden('source',array('value'=>'index'));

      $input1 = $this->Form->input('tag', array('class' => 'ServiceType','type' => 'select', 'options' => $tags, 'label' => false, 'empty' => '-- '.__("Tag",true).' --'));
    $input2 = $this->Form->input('category', array('class' => 'ServiceType','type' => 'select', 'options' => $categories, 'label' => false, 'empty' => '-- '.__("Category",true).' --'));
      $input3 = $this->Form->input('rate', array('class' => 'ServiceType','type' => 'select', 'options' => $rates, 'label' => false, 'empty' => '-- '.__("Rate",true).' --'));
      $input4 = $this->Form->input('service', array('class' => 'ServiceType','type' => 'select', 'options' => $services, 'label' => false, 'empty' => '--'.__("Service",true)."--"));


      $input5 = $this->Form->input('order', array('class' => 'ServiceType','type' => 'select', 'options' => $order, 'label' => false, 'empty' => '-- '.__("Order by",true).' --'));
      $input6 = $this->Form->input('dir', array('class' => 'ServiceType','type' => 'select', 'options' => $dir, 'label' => false, 'empty' => '-- '.__("Sorting direction",true).' --'));
      $input7 = $this->Form->input('limit', array('class' => 'ServiceType','type' => 'select', 'options' => $limits, 'label' => false, 'empty' => '-- '.__("Entries per page",true).' --'));

      $row1[] = array(array($this->Html->div('table_sub_header',__('Selection criteria',true)), array('colspan'=> 4)));
      $row1[] = array($input1,$input2,$input3,$input4);

      echo "<table cellspacing=0 class='none'>";
      echo $this->Html->tableCells($row1, array('class' => 'none'), array('class' => 'none'));
      echo "</table>";


      $row2[] = array(array($this->Html->div('table_sub_header',__('Order and direction',true)), array('colspan'=> 3)));
      $row2[] = array($input5,$input6,$input7);

      echo "<table cellspacing=0 class='none'>";
      echo $this->Html->tableCells($row2, array('class' => 'none'), array('class' => 'none'));
      echo "</table>";


      $this->Js->get('#MessageSelection');
      echo $this->Js->event('change',
        $this->Js->request(
          array('controller'=>'messages','action'=>'disp'),  
          array(
            'method'=>'post',
            'async'=>true,
            'update'=>'#service_div',
            'dataExpression'=>true,
            'data'=>$this->Js->serializeForm(array('isForm'=>false, 'inline'=>true))
          )
        )
      );

      echo $this->Form->create('Message',array('type' => 'post','action'=> 'index'));
      echo $this->Html->div('frameRightAlone', $this->Form->submit(__('Refresh',true),  array('name' =>'disp', 'class' => 'button')));
      echo $this->Form->end();
      echo $this->Access->showCheckbox($authGroup, 'document.Message','frameRightTrans');
      $ext = Configure::read('EXTENSIONS');


      //echo $this->Html->div(false, false, array('id' => "service_div"));
      echo "<div id='service_div'>";
      
      if ($messages){


      echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% "))); 
      echo $this->Form->create('Message',array('type' => 'post','action'=> 'process','name'  => 'Message'));
      echo $this->Form->hidden('source',array('value'=>'index'));


      echo $this->Html->div('empty',false);
      echo "<table width='95%' cellspacing  = '0'>";
      echo $this->Html->tableHeaders(array(
	'',
	__("New",true),
 	__("Service",true),
 	__("Title",true),
 	__("Caller",true),
 	__("Rate",true),
 	__("Category",true),
 	__("Date",true),
 	__("Length",true),
        __("Actions",true),
	__("Listen",true)));

 
      foreach ($messages as $key => $message){

        $status='';
	$id = "<input name='message[$key]['Message']' type='checkbox' value='".$message['Message']['id']."' id='check' class='check'>";

	if($message['Message']['new']){ $status = $this->Html->image("icons/star.png",array("title" => __("New",true)));}
        $service      = $message['Message']['instance_id'];
        $title      = $message['Message']['title'];
        $title_div  = $this->Html->div('',$this->Text->truncate($title,20,array('ending' => '...','exact' => true,'html' => false)),array('title' => $title),false);
	$sender     = $this->Access->showBlock($authGroup, $message['Message']['sender']);
	$rate       = $this->element('message_status',array('rate'=>$message['Message']['rate']));
	$category   = $message['Category']['name'];
	$created    = date('y/m/d H:i',$message['Message']['created']);
	$length     = $this->Formatting->epochToWords($message['Message']['length']);

        $edit       = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "messages", "action" => "edit", $message['Message']['id'])));
        $download   = $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "messages", "action" => "download", $message['Message']['id'])));
	$listen     = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>$title,'id'=>$message['Message']['id']));

        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
                array($ext['lam'].$service,array('align'=>'center')),
		array($title_div, array('width' => '110px')),
                $sender,
		array($rate,array('align'=>'center')),
		array($category,array('align'=>'center')),
		$created,		
		array($length,array('align'=>'center')),
		array($edit.' '.$this->Access->showBlock($authGroup, $download ) ,array('align'=>'center')),
		array($listen,array('align'=>'center')));
		

	} 


     echo $this->Html->tableCells($row);
     echo "</table>";

     if($authGroup == 1) {
                   echo "<table cellspacing = 0 class = 'none'>";
                   echo $this->Html->tableCells(array(__('Perform action on selected',true).': ',
                   $this->Form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
                   $this->Form->submit( __('Move to Archive',true), array('name' =>'data[Submit]', 'class' => 'button'))),array('class' => 'none'),array('class' => 'none'));
                   echo "</table>";
     }



     } else {

     echo $this->Html->div('feedback', __('No records found.',true));

     }

    
    echo "</div>";  //Service_div
    echo "</div>";
?>
