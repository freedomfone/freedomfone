<?php

      if($gateway_type== 'GSM_GW'){
	    foreach($options as $entry){
	       $_options[$entry] = $entry;
            }
	    $options = $_options;
      }


      $input1 = $this->Form->input('Batch.sms_gateway_id', array('type' => 'select', 'options' => $options, 'label' => false));
      $input2 = $this->Form->hidden('Batch.gateway_type', array('value' => $gateway_type));
      echo "<table cellspacing=0 class='blue'>";
      echo $this->Html->tableCells(array($input1), array('class' => 'blue'), array('class' => 'blue'));
      echo $this->Html->tableCells(array($input2), array('class' => 'blue'), array('class' => 'blue'));
      echo "</table>";



?>