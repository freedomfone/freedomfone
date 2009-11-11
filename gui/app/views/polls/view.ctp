<?php

echo $html->div("frameRight");
echo $form->create('Poll',array('type' => 'post','action'=> 'view/'.$data["Poll"]["id"]));
echo $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button'));
echo $form->end();
echo "</div>";

	if ($data){


echo "<h1>".__("Question",true).": ".$data['Poll']['question']." ";
echo  $html->link($html->image("icons/edit.png", array("alt" => "Edit")),"/polls/edit/{$data['Poll']['id']}",null, null, false)."</h1>";
echo "<h3>".__("SMS code",true).": ".$data['Poll']['code']."</h3>";



//echo $html->div('box',__("Please hit the refresh button to refresh the poll result.",true));
echo $html->div('formTitleAlone',__("Result",true));
      
        $total = 0;
        print "<table>";
        print "<tr><th>".__("Options",true)."</th><th>".__("Votes",true)."</th><th>".__("Percentage",true)."</th></tr>";


	$votes = $data['Vote'];

	   foreach ($votes as $vote) {
	    	   $total = $total + $vote['chvotes'];

    	    }



    foreach ($votes as $vote) {

    if (!$total){ $percentage = 0;}
    else { $percentage = $number->toPercentage(100*$vote['chvotes']/$total,0);}

	print "<tr><td>".$vote['chtext']."</td>";
	print "<td align='center'>".$vote['chvotes']."</td>";
	print "<td align='center'>".$percentage."</td></tr>";
    }
        print "<tr><td>Total</td><td align='center'>".$total."</td><td align='center'></td></tr>";
	print "</table>";

     echo "<div class='formTitleAlone'>".__("Poll information",true)."</div>";
     echo "<table>";
 

     echo $html->tableCells(array (
     array(__("Status",true),	  $this->element('poll_status',array('status'=>$data['Poll']['status'],'mode'=>'text'))),
     array(__("Start time",true), $data['Poll']['start_time']),
     array(__("End time",true),	  $data['Poll']['end_time'])));
     echo "</table>";

	}

	else {

	echo "<h1>".__("No poll with this id exists",true)."</h1>";
	}

?>