<?php

	if($data){

		$line = array(__('Year',true),__('Month',true),__('Day',true),__('Time',true),__('Type',true),__('Caller number',true),__('Extension',true));
		$csv->addRow($line);


		foreach($data as $entry){
	
		$line = array( date('Y',$entry['Cdr']['epoch']),
		      	       date('m',$entry['Cdr']['epoch']),
			       date('d',$entry['Cdr']['epoch']),
			       date('H:i:s',$entry['Cdr']['epoch']),
			       $entry['Cdr']['channel_state'],
			       $entry['Cdr']['caller_number'],
			       $entry['Cdr']['extension']);

		$csv->addRow($line);

		}

		echo $csv->render(__('CDR',true).'.csv');  
		$csv->render(false);
	}



?>