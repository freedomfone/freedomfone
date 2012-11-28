<?php
/****************************************************************************
 * dialer_status.ctp	- Display correct dialer status {1-7}
 * version 		- 1.0.362
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
                  $status_image = 'pause.png';
                  $status_text =  __('Paused', true);
                  break;

                  case 3:
                  $status_image = 'abort.png';
                  $status_text =  __('Aborted', true);
                  break;

                  case 4:
                  $status_image = 'failure.png';
                  $status_text =  __('Failed', true);
                  break;

                  case 5:
                  $status_image = 'complete.png';
                  $status_text =  __('Completed', true);
                  break;

                  case 6:
                  $status_image = 'process.png';
                  $status_text =  __('In process', true);
                  break;

                  case 7:
                  $status_image = 'no_auth.png';
                  $status_text =  __('Not authorized', true);
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