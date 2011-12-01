<?php
/****************************************************************************
 * message.php		- Model for Leave-a-message entries.
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
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/

class Message extends AppModel {

	var $name = 'Message';
	
	var $belongsTo = array('Category','User'); 

	var $hasAndBelongsToMany = array('Tag');



/*
 * Return message title
 * 
 * @param int $id
 * @return string $title
 *
 */

    function getTitle($id){

       $data = $this->findById($id);
       return $data['Message']['title'];     
    }


/*
 * Fetch new data from spooler
 * 
 * 
 * 
 *
 */
      function refresh(){

      $this->autoRender = false;
      $array = Configure::read('lm_in');

	      
	    $obj = new ff_event($array);	       

	   if ($obj -> auth != true) {
    	          die(printf("Unable to authenticate\r\n"));
	   }

 	   while ($entry = $obj->getNext('delete')){

	       $created = intval(floor($entry['Event-Date-Timestamp']/1000000));
	       $length  = intval(floor(($entry['FF-FinishTimeEpoch']-$entry['FF-StartTimeEpoch'])/1000));   
	       $mode = $entry['FF-CallerID'];
	       $value = $entry['FF-CallerName'];

	       $data= array ( 'sender'          => $this->sanitizePhoneNumber($entry['FF-CallerID']),
	       	      	      'file'            => $entry['FF-FileID'],
	       	      	      'created'         => $created,
			      'length'          => $length,
	       		      'url'             => $entry['FF-URI'],
	       		      'instance_id'     => $entry['FF-InstanceID'],
      			      'quick_hangup'    => $entry['FF-OnQuickHangup'],
                              );

	       $this->log('[INFO] NEW MESSAGE, Sender: '.$entry['FF-CallerID'], 'message');	
	       $this->create();
	       $this->save($data);

               //Check if CDR with the same call_id exists with length=false
                $this->query("UPDATE cdr set length = ".$length.", quick_hangup = '".$entry['FF-OnQuickHangup']."' where call_id = '".$entry['FF-FileID']."' and channel_state='CS_ROUTING'");

           } 
     
     }

}
?>
