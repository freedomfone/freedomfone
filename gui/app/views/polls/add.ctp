<?php
/****************************************************************************
 * add.ctp	- Create new poll
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
echo $javascript->link('addRemoveElements');

echo "<h1>".__("Create new poll",true)."</h1>";
echo $form->create('Poll',array('type' => 'post','action'=> 'add'));

echo $ajax->div("newsEditContainer"); 
$form->input('Vote.2.chtext',array('label'=>false));
echo $ajax->divEnd("newsEditContainer"); 


echo "<table>";
echo $html->tableCells(array (
     array(__("Question",true),	$form->input('question',array('label'=>false,'size' => '70'))),
     array(array(__("Define a concrete question using simple language",true),"colspan='2' class='formComment'")),
     array(__("SMS Code",true),	$form->input('code',array('label'=>false))),
    array(array(__("Alpha-numeric characters only (maximum 10)",true),"colspan='2' class='formComment'")),
     ));
echo "</table>";




echo "<div class='formTitleAlone'>".__("Poll options",true)."</div>";
echo "<div class='formComment'>".__("Alpha-numeric characters only (maximum 10)",true)."</div>";


echo "<table>";
if($votes = $this->data['Vote']){
$i=0;

	foreach ($votes as $key =>  $vote){
	$i++;
	$rows[] = array(__("Option",true)." ".$i, $form->input('Vote.'.$key.'.chtext',array('value' => $vote['chtext'],'label'=>false)));
	}
	echo $html->tableCells($rows);

}
else {


echo $html->tableCells(array (
     array(__("Option",true), $form->input('Vote.0.chtext',array('label'=>false))),
     array(__("Option",true), $form->input('Vote.1.chtext',array('label'=>false)))
      ));

}

echo "</table>";
?>

<div id="doc">
<div id="content"></div>
<input id='add-element' type="button" value="<? echo __("Add",true);?>"/>
</div>


<?php

echo "<div class='formTitleAlone'>".__("Start and end time",true)."</div>";
echo "<div class='formComment'>".__("When would you like to open and close the poll?",true)."</div>";

echo "<table>";
echo $html->tableCells(array (
     array(__("Start time",true),	$form->input('start_time',array('label'=>false))),
     array(__("End time",true),		$form->input('end_time',array('label'=>false)))
      ));
echo "</table>";
echo $form->end(__('Save',true));

?>

