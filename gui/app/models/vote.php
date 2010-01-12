<?php
/****************************************************************************
 * vote.php		- Model for poll votes. Manages validation of poll options when addding/creating polls.
 * version 		- 1.0.367
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


class Vote extends AppModel{

      var $name = 'Vote';
      var $options = array();
      
      var $belongsTo = array(
      	  'Poll' => array(
 	  	 'className' => 'Poll',
 		 'foreignKey' => 'poll_id'
 		 ));

function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

	$this->validate = array(
         'chtext'      => array(
	 	        'between' => array(
			   'rule'=>array('between', 1,10),
            	  	   'message'=>'Between 1 to 10 characters.'
			   ),
			'alphaNumeric' => array(
		       	   'rule' => 'alphaNumeric',
 		           'message' => 'Letters and numbers only. No spaces allowed.'
			   ),
			'uniqueChtext' => array(
        		    'rule' => array('uniqueChtext', 'chtext'),
        		     'message' => 'The option is not unique.'
                	   )
 		           ));


}


/*
 * Validation: Checks if chtext is unique for the poll
 *  
 * @param array $data, string $field
 *
 * @return boolean
 *
 */
  function uniqueChtext($data, $field) {

 	  global $options;
	  $result = true;

     if(is_array($options)){ 
	if (in_array($data['chtext'],$options)) { 
	   $result = __('The option is not unique',true);
	} else { 
	   $result = true;
	}
     }
     
     $options[] = $data['chtext'];
     return $result;

	}
}
?>
