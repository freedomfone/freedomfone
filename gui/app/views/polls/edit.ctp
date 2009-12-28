<?php
echo $javascript->link('addRemoveElements');


	   echo "<h1>".__("Edit Poll",true)."</h1>";
	   echo $form->create('Poll',array('type' => 'post','action'=> 'edit'));
	   echo $form->input('id',array('type' => 'hidden','value'=> $this->data['Poll']['id']));

	   echo "<table>";
	   echo $html->tableCells(array (
     	   	array(__("Question",true),	$form->input('question',array('label'=>false,'size' => 70))),
     		array(array(__("Define a concrete question using simple language",true),"colspan='2' class='formComment'")),
     		array(__("SMS Code",true),	$form->input('code',array('label'=>false))),
    		array(array(__("Alpha-numeric characters only (maximum 10)",true),"colspan='2' class='formComment'")),
     		));
	  echo "</table>";

	  echo "<div class='formTitleAlone'>".__("Poll options",true)."</div>";
	  echo "<div class='formComment'>".__("Alpha-numeric characters only (maximum 10)",true)."</div>";

	  echo "<table>";
	  $rows=array();

		foreach ($this->data['Vote'] as $key =>$vote) {

		if(isset($vote['id'])){ $voteId=$vote['id'];} else { $voteId=false;}
			$hidden = $form->input('Vote.'.$key.'.id',array('value' => $voteId,'label'=>false));	    		
			if ($voteId){ 
			   $delete   = $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/polls/unlink/{$voteId}/{$this->data['Poll']['id']}",null , __("Are you sure you want to delete this poll option?",true),false);
			   } else { 
			   $delete=false;
			   }

	    		//$rows[$key] = array(__("Option",true)." ".($key+1),	$form->input('Vote.'.$key.'.chtext',array('label'=>false)), $delete);

			$rows[] = array(__("Option",true), $form->input('Vote.'.$key.'.chtext',array('value' => $vote['chtext'],'label'=>false)),$delete,$hidden);	    		

    			}


	echo $html->tableCells($rows);
	echo "</table>";

	?>
	<div id="doc">
	<div id="content"></div>
	<input id='add-element' type="button" value="<? echo __("Add",true);?>"/>
	</div>
	<?


	echo "<div class='formTitleAlone'>".__("Start and end time",true)."</div>";
	echo "<div class='formComment'>".__("When would you like to open and close the poll?",true)."</div>";

	echo "<table>";
	echo $html->tableCells(array (
     	     array(__("Start time",true),	$form->input('start_time',array('label'=>false))),
     	     array(__("End time",true),		$form->input('end_time',array('label'=>false)))
      	     ));
	echo "</table>";
	echo $form->end('Save'); 


?>

