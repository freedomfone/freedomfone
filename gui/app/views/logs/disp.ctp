<?php
/****************************************************************************
 * disp.ctp	- Display Freedom Fone logs
 * version 	- 1.0.354
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


      echo $ajax->div("log_div");
      $file = '../tmp/logs/'.$this->data['Log']['type'].'.log';

      if (file_exists($file)){
	$handle = fopen($file,'r');

	if ($handle) {
    	   while (!feof($handle)) {
           	 $buffer = fgets($handle, 4096);
        	 echo $buffer."<br/>";
           }
    	   fclose($handle);
	
	}
      } else {

      echo $html->div('warning',__('No log file of this type exists',true));

      }

      echo $ajax->divEnd("log_div");
	

?>