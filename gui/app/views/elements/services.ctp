<?php
/****************************************************************************
 * services.ctp         - Converts variations of service names to huam readable format
 * version 		- 2.0.1220
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

if(isSet($service)){


		if($service == 'Node'){
   		     $return =  __('Content',true);
		}

		elseif($service == 'LmMenu' || $server == 'lam'){
   		     $return =__('Leave-a-message',true);
		}

		elseif($service == 'IvrMenu' || $service == 'ivr'){
   		     $return = __('Voice Menu',true);
		}

		elseif($service == 'bin'){
   		     $return = __('SMS',true);
		}

                echo $return;
                
}



?>