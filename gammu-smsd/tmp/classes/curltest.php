		<?php 
		// $IpSip = '196.44.184.141';
		$IpSip = 'kubatana01.com';
		echo " * * * Using SIP Channel * * * \n";
		echo 'connecting to IP address ' . $IpSip . "\n";
		//mysql_query("update outbox set status = 2 where id = '$id'");
		$ch = curl_init($IpSip);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		echo ' * * * ' . $retcode . ' * * * * ' . "\n";
		?>
