<?php
/****************************************************************************
 * office_route.php	- Model for GSM channels based on OfficeRoute
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


class OfficeRoute extends AppModel{


      var $name = 'OfficeRoute';


/*
 * Refresh SNMP data for OfficeRoute units
 *  
 * 
 *
 */


 function refresh(){

   $OR_MIB= array( 
                'sim_inserted'		=> array(__('No'), __('Yes')),
                'network_registration'  => array(__('Not registered'), 
					         __('Registered to home network'),
						 __('Searching for network'),
						 __('Registration denied'),
						 __('Unknown'),
						 __('Registered roaming'))
                				 );


    $or_mib    = Configure::read('OR_MIB');
    $snmp   = Configure::read('OR_SNMP');
    $mib = false;

     //For each office route in use
     foreach($snmp as $key => $unit){


       if($this->isAlive($unit['ip_addr'])){


          if(snmpget( $unit['ip_addr'] , $unit['community'], $unit['object_id'].'.2.1',1000000,1)){
	  
	  
                for($i=0; $i<4; $i++){

			  $j = $i+($key*4);

                          $mib[$j]['id']                    =  $j + 1; 
                          $mib[$j]['line_id']               =  $this->get_entry($unit, 2, $i);
                          $mib[$j]['imei']                  =  $this->get_entry($unit, 3, $i);
                          $mib[$j]['signal_level']          =  $this->get_entry($unit, 7, $i);
                          $mib[$j]['sim_inserted']          =  $OR_MIB['sim_inserted'][$this->get_entry($unit, 9, $i)];
                          $mib[$j]['network_registration']  =  $OR_MIB['network_registration'][$this->get_entry($unit, 10, $i)];
                          $mib[$j]['imsi']                  =  $this->get_entry($unit, 12, $i);
                          $mib[$j]['operator_name']         =  $this->get_entry($unit, 14, $i);         
                          $mib[$j]['ip_addr']               =  $unit['ip_addr'];

                          if (trim($mib[$j]['sim_inserted']) == 'No') { $mib[$j]['signal_level']= false;}
        
                }  //for

           } 

     } //if


     }


     return $mib;

}


 function get_entry($unit, $id, $i){

      $snmp   = Configure::read('OR_SNMP');
      $prefix = $unit['object_id'];

      $data = snmpget( $unit['ip_addr'] , $unit['community'], $prefix.'.'.$id.'.'.$i,1000000,1);


        if(preg_match('/:/',$data)){

                   $string = explode(':',$data);
                   $data = trim ($string[1], '" "');
        } else {

                   $data = false;

        }       

                   return $data;

 }





  function snmp_on($id){

    $snmp   = Configure::read('OR_SNMP');

          if(snmpget( $snmp[$id]['ip_addr'] , $snmp[$id]['community'], $snmp[$id]['object_id'].'.2.1',1000000,1)){
          
                return true;
          
          } else {

               return false;


         }

  }

}



?>
