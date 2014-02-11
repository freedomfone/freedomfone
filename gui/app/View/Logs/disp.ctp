<?php
/****************************************************************************
 * disp.ctp	- Display Freedom Fone logs
 * version 	- 3.0.1500
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

  if($this->request->data['Log']['type']){

     $system_log = Configure::read('SYSTEM_LOG');


      if(array_key_exists($this->request->data['Log']['type'], $system_log['system'])){

      $file = LOG_DIR_CORE.$this->request->data['Log']['type'].'.log';

      } else {

      $file = LOG_DIR_GUI.$this->request->data['Log']['type'].'.log';

      }

      if (file_exists($file)){
  	 $data = file($file);
	 $data = array_reverse($data);

	 if($data){ 
	   foreach($data as $key => $line){

	     if($key < 100){
	       echo $line."<br/>";
	     }

	   } //foreach
	  } else {

	   echo $this->Html->div('success',__('No log entries.',true));
	  }

       } else {

      	    echo $this->Html->div('warning',__('No log file of this type exists',true));
       }

  }

?>