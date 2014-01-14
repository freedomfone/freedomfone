<?php
/****************************************************************************
 * add.ctp	- Create new poll
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
echo $this->Html->addCrumb(__('Polls',true), '/polls');
echo $this->Html->addCrumb(__('Create',true), '/polls/add');

echo $this->Html->script('addRemoveElements');

echo "<h1>".__("Create Poll",true)."</h1>";
echo $this->Form->create('Poll',array('type' => 'post','action'=> 'add'));


echo $this->Html->div('frameLeft');
echo "<table cellpadding=0 class='blue'>";
echo $this->Html->tableCells(array (
     array(__("Question",true),	$this->Form->input('question',array('label'=>false,'size' => '70'))),
     array(array(__("Define a concrete question using simple language",true),"colspan='2' class='formComment'")),
     array(__("SMS Code",true),	$this->Form->input('code',array('label'=>false))),
    array(array(__("Alpha-numeric characters only (maximum 10)",true),"colspan='2' class='formComment'")),
     ),array('class'=>'blue'),array('class'=>'blue'));
echo "</table>";




echo "<h2>".__("Poll options",true)."</h2>";
echo "<div class='formComment'>".__("Alpha-numeric characters only (maximum 10)",true)."</div>";


echo "<table cellpadding=0 class='blue'>";
if(array_key_exists('Vote', $this->request->data)){

	$votes = $this->request->data['Vote'];
	$i=0;

	foreach ($votes as $key =>  $vote){
	$i++;
	$rows[] = array(__("Option",true), $this->Form->input('Vote.'.$key.'.chtext',array('value' => $vote['chtext'],'label'=>false)));
	}
	echo $this->Html->tableCells($rows,array('class'=>'blue'),array('class'=>'blue'));

}
else {


echo $this->Html->tableCells(array (
     array(__("Option",true), $this->Form->input('Vote.0.chtext',array('label'=>false))),
     array(__("Option",true), $this->Form->input('Vote.1.chtext',array('label'=>false)))
      ),array('class'=>'blue'),array('class'=>'blue'));

}

echo "</table>";
?>

<div id="doc">
<div id="content"></div>
<input id='add-element' type="button" value="<? echo __("Add",true);?>"/>
</div>


<?php

echo "<h2>".__("Start and end time",true)."</h2>";
echo "<div class='formComment'>".__("When would you like to open and close the poll?",true)."</div>";

echo "<table cellpadding=0 class='blue'>";
echo $this->Html->tableCells(array (
     array(__("Start time",true),	$this->Form->input('start_time',array('label'=>false))),
     array(__("End time",true),		$this->Form->input('end_time',array('label'=>false)))
      ),array('class'=>'blue'),array('class'=>'blue'));
echo "</table>";
echo $this->Form->end(__('Save',true));
echo "</div>";
?>

