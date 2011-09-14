<?php
/****************************************************************************
 * add.ctp	- Create new poll
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
echo $html->addCrumb(__('Polls',true), '/polls');
echo $html->addCrumb(__('Create',true), '/polls/add');

echo $javascript->link('addRemoveElements');

echo "<h1>".__("Create Poll",true)."</h1>";
echo $form->create('Poll',array('type' => 'post','action'=> 'add'));

echo $ajax->div("newsEditContainer"); 
$form->input('Vote.2.chtext',array('label'=>false));
echo $ajax->divEnd("newsEditContainer"); 

echo $html->div('frameLeft');

echo "<table cellpadding=0 class='blue'>";
echo $html->tableCells(array (
     array(__("Question",true),	$form->input('question',array('label'=>false,'size' => '70'))),
     array(array(__("Define a concrete question using simple language",true),"colspan='2' class='formComment'")),
     array(__("SMS Code",true),	$form->input('code',array('label'=>false))),
    array(array(__("Alpha-numeric characters only (maximum 10)",true),"colspan='2' class='formComment'")),
     ),array('class'=>'blue'),array('class'=>'blue'));
echo "</table>";




echo "<h2>".__("Poll options",true)."</h2>";
echo "<div class='formComment'>".__("Alpha-numeric characters only (maximum 10)",true)."</div>";

echo "<table cellpadding=0 class='blue'>";
if($votes = $this->data['Vote']){
$i=0;

	foreach ($votes as $key =>  $vote){
	$i++;
	$rows[] = array(__("Option",true), $form->input('Vote.'.$key.'.chtext',array('value' => $vote['chtext'],'label'=>false)));
	}
	echo $html->tableCells($rows,array('class'=>'blue'),array('class'=>'blue'));

}
else {


echo $html->tableCells(array (
     array(__("Option",true), $form->input('Vote.0.chtext',array('label'=>false))),
     array(__("Option",true), $form->input('Vote.1.chtext',array('label'=>false)))
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
echo $html->tableCells(array (
     array(__("Start time",true),	$form->input('start_time',array('label'=>false))),
     array(__("End time",true),		$form->input('end_time',array('label'=>false)))
      ),array('class'=>'blue'),array('class'=>'blue'));
echo "</table>";
echo $form->end(__('Save',true));
echo "</div>";
?>

