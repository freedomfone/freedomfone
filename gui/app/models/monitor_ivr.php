<?php
/*
 * monitor_ivr.php	- Model for monitoring of IVR data.
 * version 		- 2.0.1175
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
 */


class MonitorIvr extends AppModel{

      var $name = 'MonitorIvr';
      
      var $belongsTo = array('Node','IvrMenu','LmMenu',
      	  'Cdr' => array(
 	  	 'className' => 'Cdr',
 		 'foreignKey' => 'cdr_id'
 		 ));
		 

/*
 * Get unique call id
 *  
 * @param int $id
 *
 * @return string $call_id
 *
 */

    function getCallId($id){

    $data = $this->findById($id);
    return $data['MonitorIvr']['call_id'];     
    }


}



?>
