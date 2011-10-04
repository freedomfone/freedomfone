<?php
/****************************************************************************
 * dialer_status.ctp	- Display correct dialer status {1-7}
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

if(isSet($status,$mode)){

                switch($status){

                  case 1:
                  $status_image = 'pending.png';
                  $status_text =  __('Pending', true);
                  break;

                  case 2:
                  $status_image = 'failure.png';
                  $status_text =  __('Failure', true);
                  break;

                  case 3:
                  $status_image = 'retry.png';
                  $status_text =  __('Retry', true);
                  break;

                  case 4:
                  $status_image = 'success.png';
                  $status_text =  __('Success', true);
                  break;

                  case 5:
                  $status_image = 'abort.png';
                  $status_text =  __('Abort', true);
                  break;

                  case 6:
                  $status_image = 'pause.png';
                  $status_text =  __('Pause', true);
                  break;

                  case 7:
                  $status_image = 'process.png';
                  $status_text =  __('Process', true);
                  break;


                }


		if($mode == 'image'){
   		  echo $html->image($status_image, array("alt" => $status_text, "title" => $status_text));
		} 

		elseif($mode == 'text'){
   		  echo $status_text;
		}

}



?>