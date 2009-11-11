<?php



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
	    		$rows[$key] = array(__("Option",true)." ".($key+1),	$form->input('Vote.'.$key.'.chtext',array('label'=>false)));
    			}


	echo $html->tableCells($rows);
	echo "</table>";

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

