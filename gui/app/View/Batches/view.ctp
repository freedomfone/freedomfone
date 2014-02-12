<?php
/****************************************************************************
 * view.ctp	- List SMS receivers by batch id
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

echo $this->Html->addCrumb(__('SMS Centre',true), '');
echo $this->Html->addCrumb(__('SMS Batches',true), '/batches');



$this->Session->flash();


echo "<h1>".__('SMS receivers',true)."</h1>";

     if ($batches){

     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

      echo $this->Form->create('SmsReceiver',array('type' => 'post','action'=> 'process','name' =>'Batch'));
      echo "<table width='50%' cellspacing=0>";

      echo $this->Html->tableHeaders(array(
 	$this->Paginator->sort('status', __("Status",true)),
 	$this->Paginator->sort('receiver', __("SMS receiver",true)),

	));


      foreach ($batches as $key1 => $batch){

      foreach ($batch['SmsReceiver']  as $key2 => $entry){

	$status	     =  $this->element('batch_status',array('status_code'=>$entry['status'],'gateway_code'=>$batch['Batch']['gateway_code']));
	$receiver     = array($entry['receiver'], array('width' => '200px'));


     	$row[$key2] = array(
		     $status,
                     $receiver, 
                     );

	}


	} 
     echo $this->Html->tableCells($row);
     echo "</table>"; 


     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('10','index/limit:10',null, null, false)." | ".$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false));




     }  else {

          echo $this->Html->div("invalid_entry", __("This page does not exist.",true));

     }

     echo $this->Form->end();
     echo "</div>";

?>
