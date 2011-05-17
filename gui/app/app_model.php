<?php
/* SVN FILE: $Id$ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {


     function sanitizePhoneNumber($number){

       if($number){

        if(preg_match('/%/',$number)){ $number = urldecode($number);}

          $entry = $this->query("select value_int from settings where name = 'prefix'");
          $prefix =  $entry[0]['settings']['value_int'];


          //Starts with + sign
          if (preg_match('/^[+]{1,1}[0-9]{4,25}$/', $number)){

           //Replace +  sign with 00
           $number = preg_replace (array('/^[+]/'), array('00'),$number);           

          } 
          //Starts without country prefix
          elseif (!preg_match('/^[+]{1,1}[0-9]{4,25}$/', $number) && !preg_match('/^[00]{2,2}[0-9]{4,25}$/', $number)){
      
            //Append 00 and strip first 0 (if any)
            $number = '00'.$prefix.ltrim($number,'0');

          }

        }

        return $number;


     }

}
?>