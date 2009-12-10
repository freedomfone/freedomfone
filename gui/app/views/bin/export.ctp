<?php

	if($data){


		$line = array(__('Time',true),__('Message',true),__('Sender',true),__('Type',true));
		$csv->addRow($line);


		foreach($data as $entry){
	
		$line = array($time->niceShort($entry['Bin']['created']),$entry['Bin']['body'],$entry['Bin']['sender'],$entry['Bin']['mode']);
		$csv->addRow($line);

		}

		echo $csv->render('UnclassifiedSMS.csv');  
		$csv->render(false);
	}



?>