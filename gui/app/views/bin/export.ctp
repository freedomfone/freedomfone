<?php

	if($data){


		$line = array(__('Date and Time',true),__('Date',true),__('Time',true),__('Message',true),__('Sender',true),__('Type',true));
		$csv->addRow($line);


		foreach($data as $entry){
	
		$line = array(date('Y-m-d H:i:s',$entry['Bin']['created']),date('Y-m-d',$entry['Bin']['created']),date('H:i:s',$entry['Bin']['created']),$entry['Bin']['body'],$entry['Bin']['sender'],$entry['Bin']['mode']);
		$csv->addRow($line);

		}

		echo $csv->render(__('OtherSMS',true).'.csv');  
		$csv->render(false);
	}



?>