<?php
/****************************************************************************
 * office_route.php	- Model for GSM channels based on OfficeRoute
 * version 		- 1.0.440
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


class OfficeRoute extends AppModel{


      var $name = 'OfficeRoute';


/*
 * Refresh SNMP data for OfficeRoute units
 *  
 * 
 *
 */


 function refresh(){

    $or_mib    = Configure::read('OR_MIB');
    $snmp   = Configure::read('OR_SNMP');


 

     //For each office route in use
     foreach($snmp as $key => $unit){

    if($fp = fsockopen($unit['ip_addr'], 80, $errno, $errstr, 30)){

         fclose($fp);


         for($i=0; $i<4; $i++){

         $mib[$i]['id']                    =  $i + 1; 
         $mib[$i]['line_id']               =  $this->get_entry($unit, 2, $i);
         $mib[$i]['imei']                  =  $this->get_entry($unit, 3, $i);
         $mib[$i]['signal_level']          =  $this->get_entry($unit, 7, $i);
         $mib[$i]['sim_inserted']          =  $or_mib['sim_inserted'][$this->get_entry($unit, 9, $i)];
         $mib[$i]['network_registration']  =  $or_mib['network_registration'][$this->get_entry($unit, 10, $i)];
         $mib[$i]['imsi']                  =  $this->get_entry($unit, 12, $i);
         $mib[$i]['operator_name']         =  $this->get_entry($unit, 14, $i);         
         $mib[$i]['ip_addr']               =  $unit['ip_addr'];
        
         } //for

     }

     return $mib; 


     }
     



}

 function get_entry($unit, $id, $i){

      $snmp   = Configure::read('OR_SNMP');
      $prefix = $unit['object_id'];

      $data = snmpget( $unit['ip_addr'] , $unit['community'], $prefix.'.'.$id.'.'.$i);

        if(preg_match('/:/',$data)){

                   $string = explode(':',$data);
                   $data = trim ($string[1], '" "');
        } else {

                   $data = false;

        }       

                   return $data;

 }



  

 }

?>