#!/usr/local/bin/php -q
<?php
//include_once('ss_twitter2.php');

error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush();

$address = '127.0.0.1';
$port = 10002;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
   echo "socket_create() failed: reason: " . socket_strerror($sock) . "\n";
}

if (($ret = socket_bind($sock, $address, $port)) < 0) {
   echo "socket_bind() failed: reason: " . socket_strerror($ret) . "\n";
}

if (($ret = socket_listen($sock, 5)) < 0) {
   echo "socket_listen() failed: reason: " . socket_strerror($ret) . "\n";
}

do {
   if (($msgsock = socket_accept($sock)) < 0) {
       echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
       break;
   }
   /* Send instructions. */
   $msg = "\nWelcome to the php daemon to twitter Server. \n". 
       "accepted commands: quit/shutdown'.\n";
   socket_write($msgsock, $msg, strlen($msg));

   do {
       if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
           echo "socket_read() failed: reason: " . socket_strerror($ret) . "\n";
           break 2;
       }
       if (!$buf = trim($buf)) {
           continue;
       }
       if ($buf == 'quit') {
           break;
       }
       if ($buf == 'shutdown') {
           socket_close($msgsock);
           break 2;
       }
       $talkback = "php2twitter'$buf'.\n";
       socket_write($msgsock, $talkback, strlen($talkback));
       echo "$buf\n";


$twitter_username       ='smsg2';
$twitter_psw            ='';

function postToTwitter($username,$password,$message){

    $host = "http://twitter.com/statuses/update.xml?status=".urlencode(stripslashes(urldecode($message)));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");

    $result = curl_exec($ch);
    // Look at the returned header
    $resultArray = curl_getinfo($ch);

    curl_close($ch);

    if($resultArray['http_code'] == "200"){
         $twitter_status='Your message has been sended! <a href="http://twitter.com/'.$username.'">See your profile</a>';
    } else {
         $twitter_status="Error posting to Twitter. Retry";
    }
        return $twitter_status;
}


//Code for twitter
postToTwitter($twitter_username, $twitter_psw, $buf); 




   } while (true);
   socket_close($msgsock);
} while (true);

socket_close($sock);
?>
