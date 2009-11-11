<?php


class Poll extends AppModel{

      var $name = 'Poll';



	var $hasMany = array('Vote' => array(
                        	       'order' => 'Vote.id ASC',
                        	       'dependent' => true)
				       ); 

      var $validate = array(
        'question' => array(
            'rule'=>array('minLength', 10),
	    'required' => true,
            'message'=>'A valid question is required.' ),
	'code' => array(
			'alphaNumeric' => array(
 				       'rule' => 'alphaNumeric',
 				       'message' => 'Alphabets and numbers only'
 				       ),
 			'between' => array(
 				       'rule' => array('between', 1, 10),
 				       'message' => 'Between 1 to 10 characters'
 				       ),
	                'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => 'This SMS code is already in use.'
				     )
 		),
	'end_time' => array(
			'compareFieldValues' => array(
        				       'rule' => array('compareFieldValues', 'start_time' ),
        				       'message' => 'The end time must be later than the start time.'
                )
            ) 
	);




 function compareFieldValues( $data, $field) 
    {
        foreach( $data as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][ $field ];                 
            if($v2 > $v1) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }


   function futureDate($data, $field){

                if (strtotime($data[$field]) < time()){
                        return FALSE;
                }
                return TRUE;
    } 

    function getTitle($id){

    $data = $this->findById($id);
    return $data['Poll']['question'];     
    }


//
//
// Calculates and sets the status of the poll before saving data.
//
//

    function beforeSave(){

	$start = strtotime($this->data['Poll']['start_time']);
	$end   = strtotime($this->data['Poll']['end_time']);
	$now = time();


      	if ($start < $now && $end < $now ){ 
      	 $this->data['Poll']['status']=2;
	 }

      	elseif ($start > $now ){ 
      	 $this->data['Poll']['status']=0;
	 }

	 else {
      	 $this->data['Poll']['status']=1;
	 }


    	 return true;

    }

}



?>