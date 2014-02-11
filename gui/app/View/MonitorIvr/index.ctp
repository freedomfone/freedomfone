<?php
/****************************************************************************
 * index.ctp	- List monitoring data for Voice Menus
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

echo $this->Html->addCrumb(__('System data',true), '');
echo $this->Html->addCrumb(__('Monitoring',true), '/monitor_ivr');



$this->Session->flash();
echo $this->Html->script('toggle');


$msg_delete = 'return confirmSubmit("'.__("Are you sure that you want to delete the selected entries?",true).'")';

echo $this->Form->create('MonitorIvr',array('type' => 'post','action'=> 'index'));
echo $this->Html->div('frameRightAlone',$this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();


$this->Access->showButton($authGroup, 'MonitorIvr', 'output', 'frameRightTrans', __('Export all',true), 'submit', 'button');
$this->Access->showButton($authGroup, 'MonitorIvr', 'export', 'frameRightTrans', __('Export',true),     'submit', 'button');
$this->Access->showButton($authGroup, 'MonitorIvr', 'delete', 'frameRightTrans', __('Delete',true),     'submit', 'button');


echo "<h1>".__('Monitoring of Voice Menus',true)."</h1>";


     if ($data){

     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Entries:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $this->Form->create('MonitorIvr',array('type' => 'post','action'=> 'process','name'  => 'MonitorIvr'));

     echo $this->Access->showCheckbox($authGroup, 'document.MonitorIvr', 'frameLeftTrans');     
     echo $this->Access->showBlock($authGroup, $this->Html->div('frameLeftTrans', $this->Form->submit(__('Delete selected',true),  array('name' =>'data[Submit]', 'class' => 'button','onClick'=>$msg_delete))));

     echo $this->Html->div('empty',false);
     echo "<table width='95%' cellspacing=0>";
     echo $this->Html->tableHeaders(array(
	'',
 	$this->Paginator->sort('epoch', __("Date (YMD)",true)),
 	$this->Paginator->sort('epoch', __("Time",true)),
 	$this->Paginator->sort('call_id', __("Call ID",true)),
 	$this->Paginator->sort('caller_number', __("Caller ID",true)),
 	$this->Paginator->sort('ivr_code', __("From",true)),
 	$this->Paginator->sort('digit', __("Pressed",true)),
 	$this->Paginator->sort('service', __("To",true)),
 	$this->Paginator->sort('title', __("Title",true)),
 	$this->Paginator->sort('type', __("Type",true)),
	''));

	$call_id_old=false;
	$class='lighter';

      foreach ($data as $key => $entry){


	$id             = $this->Access->showBlock($authGroup, "<input name='monitor_ivr[$key][MonitorIvr]' type='checkbox' value='".$entry['MonitorIvr']['id']."' id='check' class='check'>");
	$date  	        = date('Y-m-d',$entry['MonitorIvr']['epoch']);
	$time           = date('H:i:s',$entry['MonitorIvr']['epoch']);
	$ivr_code       = $this->Text->truncate($entry['MonitorIvr']['ivr_code'],20, array('ending' => '...','exact' => true,'html' => false));
	$call_id        = $this->Text->truncate($entry['MonitorIvr']['call_id'],8, array('ending' => false,'exact' => true,'html' => false));
	$digit          = $entry['MonitorIvr']['digit'];
	$caller_number  = $this->Access->showBlock($authGroup, $entry['MonitorIvr']['caller_number']);
	$type_tmp = $entry['MonitorIvr']['type'];
        $title = false;
	$service = false;

        if($type_tmp =='CS_ROUTING'){ 
                 $type   = __("start",true);
         
        } elseif ($type_tmp =='CS_DESTROY'){ 
                $type=__("end",true);

        } elseif ($type_tmp == 'tag'){

                 $type=__("tag",true);
                 $service = $this->element('services',array('service' => $entry['MonitorIvr']['service']));
                 $title  = $this->Text->truncate($entry[$entry['MonitorIvr']['service']]['title'],13,array('ending' => '...','exact' => true,'html' => false));

        }




	if (!$caller_number = $entry['MonitorIvr']['caller_number']) {  $caller_number='';}
        

        $delete      = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "monitor_ivr", "action" => "del", $entry['MonitorIvr']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this entry?',true)."');")));

		//change class
		if($call_id_old != $call_id){ 
				if($class=='darker'){ $class='lighter';}
				else { $class='darker';}
		$call_id_old=$call_id;
		}

     $row = array(
                $this->Access->showBlock($authGroup, $id),
		$date,
		$time,
		$call_id,
		$this->Access->showBlock($authGroup, $caller_number),
		$ivr_code,
		array($digit,array('align'=>'center')),
                $service,
		$title,
		array($type,array('align'=>'center')),
		array($delete,array('align'=>'center'))
		);

		
 	echo $this->Html->tableCells($row,array('class'=>$class),null,null,null);
	
	}


     echo "</table>";
     echo $this->Form->end();

     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false)." | ".$this->Html->link('100','index/limit:100',null, null, false));


     }  else {

     echo $this->Html->div('feedback', __('No records found.',true));

     }

?>
