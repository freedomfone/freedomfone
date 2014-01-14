<?php
/****************************************************************************
 * sms.php		- gammu smsd class (to send one or many sms)
 * version 		- 3.0.1500
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
 *   Ikhsan Agustian <ikhsan017@gmail.com>
 * 
 * Modified by:
 *   Louise Berthilson <louise@it46.se>
 *
 * @license   Distributed under GNU/GPL
 *
 ***************************************************************************/

class sms
{
    private $error, $type, $auth, $msg, $dest;

    /**
     * sms::__construct()
     * @usage object constructor 
     * @param $type (mysql or email), $auth (mysql or email credentials)
     * @return $data array($status,$res)
     */
    function __construct($type, $auth) 
    {
        $this->udh=array(
		'udh_length'	=>'05',		//sms udh length 05 for 8bit udh, 06 for 16 bit udh
        	'identifier'	=>'00', 	//use 00 for 8bit udh, use 08 for 16bit udh
        	'header_length' =>'03', 	//length of header including udh_length & identifier
        	'reference'	=>'00', 	//use 2bit 00-ff if 8bit udh, use 4bit 0000-ffff if 16bit udh
        	'msg_count'	=>1, 		//sms count
        	'msg_part'	=>1 		//sms part number
        );
	$this->timeout		= 30;
	$this->type		= $type;
        $this->error		= array();
	$this->RelativeValidity = 255;

	if($type == 'mysql'){

		 $this->res = $this->dbAuth($auth);

	} elseif($type == 'email'){

	         $this->res     = $this->orAuth($auth);  	       
	         $this->domain  = $auth['domain'];

	} elseif($type == 'ip_CT'){

	         $this->res     = $this->ctAuth($auth);  	       


	} else {

	       $this->error[] = "Wrong transmission channel specified ($type).";
	       $this->res     = false;
	}

	return array($this->res, $this->error);

    }
    

    /**
     * sms::dbAuth()
     * @usage connect to mysql database
     * @param array $auth ( array('host','user','password','database'))
     * @return $res mysql resource
     */
    private function dbAuth($auth)
    {

    $res = mysqli_connect($auth['host'], $auth['user'], $auth['password'], $auth['database']);
   
      if (!$res) {
        $this->error[] = $mysqli->connect_error;
     	return false;
      }

      return  $res;
    }




    /**
     * sms::orAuth()
     * @usage check if OfficeRoute is running
     * @param array $auth ( array('domain'))
     * @return $res bool
     */
    private function orAuth($auth)
    {
    
    $url = $auth['domain'];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	if (200 == $retcode) {
       	   return true;
    	} else {
       	   return false; 
        }
    }
					
    /**
     * sms::ctAuth()
     * @usage Authenticate against Clickatell account
     * @param array $auth ( array('url','username','password','api_key'))
     * @return $res bool
     */

    


    
    /**
     * sms::sendSMS()
     * @usage tell gammu-smsd to send one sms to many recipient OR tell OfficeRoute to send sms to single receipient
     * @param string $msg
     * @param array $dest
     * @param string $sender
     * @return void
     */
    function sendSMS($msg,$dest,$sender)
    {

        if($this->type == 'mysql' || $this->type == 'ip_CT' ){

        $this->msg	= substr($msg,0,160);

        if(!is_array($dest))
        {
            $id[] = $this->send($msg,$dest,$sender);
        }
        else
        {

         foreach($dest as $dst)
            {
                $id[] = $this->send($msg,$dst,$sender);
            }
        }
	return $id;

	} elseif($this->type == 'email') {

 	  $subject = 'Outgoing SMS from Freedom Fone';
	  $headers = 'From: sms@'.$this->domain . "\r\n" .
	  	     'reply-To: sms@'.$this->domain . "\r\n" .
    		     'X-Mailer: PHP/' . phpversion();

          //single recipient
          if(!is_array($dest)){
	     $to      = $dest."@".$this->domain;  
	     return mail($to, $subject, $msg, $headers);
	  } else {
	      foreach($dest as $entry){
	      	    $to      = $entry."@".$this->domain;  
	     	    $id[]    = mail($to, $subject, $msg, $headers);
	      }

	      return $id;
	  } 

	}
    }
    
    
    /**
     * sms::send()
     * @usage tell gammu-smsd to send sms to specified phone number
     * @param string $msg
     * @param string $dest
     * @param string $sender
     * @return false if error
     */
    function send($msg,$dest,$sender)
    {

    if(!$dest)
        {
            $this->error[]='No destination number defined';
            return false;
        }
        $this->msg	= $msg;
        $this->dest	= $dest;
        $id = $this->inject($sender);

	return $id;
    }
    
    
    /**
     * sms::inject()
     * @usage insert previously created sms part to database
     * @param string $sender
     * @return void
     */
    private function inject($sender)
    {

	if($this->type == 'mysql'){
          $query="insert into outbox (`DestinationNumber`,`TextDecoded`,`SenderID`, `RelativeValidity`) values ('{$this->dest}','{$this->msg}','{$sender}','{$this->RelativeValidity}')";
                mysqli_query($this->res, $query);
                $id=mysqli_fetch_assoc(mysqli_query($this->res, "select last_insert_id() as id"));
                $id=$id['id'];
	} elseif ($this->type == 'email'){

	//Add here

	}
            
	    return $id;

    }

    /**
     * sms::getStatus()
     * @usage Get status of pending/sent SMS
     * @param array $id
     * @return array $status
     */
    function getStatus($id)
    {

      if(is_array($id)){

        $res = mysqli_query($this->res, "select ID,Status from sentitems where ID in (".implode(',',$id).")");
        while ($data = mysqli_fetch_array($res)){
	  $status[$data['ID']] = $data['Status'];
        }
        return $status;

      } else {

         $res = mysqli_query($this->res, "select Status from sentitems where ID = $id");
         $data = mysqli_fetch_array($res);
         $status[$id] = $data['Status'];
         return $status;
      }
    }


    /**
     * sms::delOutbox
     * @usage Delete sent/failed messages from outbox
     * @param array $id
     * @return int $rows number of deleted entries
     */
    function delOutbox($id= null)
    {

      if(!$id){
         $res = mysqli_query($this->res, "delete from sentitems");
      } elseif(is_array($id)){
        $res = mysqli_query($this->res, "delete from sentitems where ID in (".implode(',',$id).")");
      } elseif(is_int($id)){
        $res = mysqli_query($this->res, "delete from sentitems where ID = ".$id);
      }

      return mysqli_affected_rows($this->res);

    }

    /**
     * sms::getPhones()
     * @usage Get status of connected GSM gateways
     * @param
     * @return array $data
     */    
    function getPhones(){

         $data = array();
	 $res = mysqli_query($this->res, "select * from phones");
	 while($row = mysqli_fetch_array($res)) {
	   $data[] = $row;
	 }
	
	return $data;
    }

    /**
     * sms::close()
     * @usage Close MySQL connection
     * @param
     * @return 
     */    
    function close(){

      mysqli_close($this->res);

    }

 }
    

?>