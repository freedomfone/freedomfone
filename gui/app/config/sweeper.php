<?php
/****************************************************************************
 * sweeper.php	- Configuration parameters for the System Sweeper
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


$config['SWEEP_CONFIG'] = array(
                        'enable' => 1,                 //1 = enable, 0 = diable 
                        'mode'   => 'high',             //low  = phone numbers only, high = phone numbers and user data (name, email etc.)
                        );

$config['SWEEP_SETTINGS'] = array(
                          'Bin'           => array('low'  => array('sender' => NULL),
                                                   'high' => array('sender' => '555666'),
                                          ),
                          'Cdr'           => array('low'  => array('caller_number' => NULL),
                                                   'high' => array('caller_number' => '555666'),
                                          ),
                          'MonitorIvr'   => array('low'  => array('caller_number' => NULL),
                                                   'high' => array('caller_number' => '555666'),
                                          ),
                          'PhoneNumber' => array('low'  => array('number' => NULL),
                                                   'high' => array('number' => '555666'),
                                          ),
                          'User'         => array('low'  => array(),
                                                  'high'  => array('name' => 'John', 'surname' => 'Doe', 'email' => 'john.doe@gmail.com', 'skype' => 'john.doe', 'organization' => NULL),                                                   
                                          ),
                                  );


?>
