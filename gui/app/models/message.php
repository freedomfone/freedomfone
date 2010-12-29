<?php
/****************************************************************************
 * message.php		- Model for Leave-a-message entries.
 * version 		- 1.0.359
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



      function refresh(){

      $this->autoRender = false;


      $array = Configure::read('lm_in');

	      
	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {
    	       die(printf("Unable to authenticate\r\n"));
	       }

 	       while ($entry = $obj->getNext('update')){


	       $created = floor($entry['Event-Date-Timestamp']/1000000);
	       $length  = floor(($entry['FF-FinishTimeEpoch']-$entry['FF-StartTimeEpoch'])/1000);
	       
	       $mode = $entry['FF-CallerID'];
	       $value = $entry['FF-CallerName'];


	       $data= array ( 'sender'  =>$entry['FF-CallerID'],
	       	      	      'file'    =>$entry['FF-FileID'],
	       	      	      'created' =>$created,
			      'length'  =>$length,
	       		      'url'     => $entry['FF-URI']);

	      $this->log('Msg: NEW Message', 'leave_message');	

	       $this->create();
	       $this->save($data);

               } 
     
     }



}
?>
