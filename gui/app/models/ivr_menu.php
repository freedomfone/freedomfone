<?php


class IvrMenu extends AppModel{

      var $name = 'IvrMenu';

      var $hasMany = array('Node');

      var $validate = array(
        'title' => array(
            'rule'     => array('minLength', 3),
	    'required' =>  true,
            'message'  => 'A title is required. Minimum 3 characters.' ),
        'message_short' => array(
            'rule'     => array('minLength', 3),
	    'required' =>  true,
            'message'  => 'Instructions are required.' ));



/**
 * Check if parent exist. If not, set current to parent
 * 
 *
 */
    function setParent($id){

	 $count = $this->find('count', array('conditions' => array('IvrMenu.parent' => '1')));     

	 if (!$count){

	 $this->unbindModel(array('hasMany' => array('Node')));   
	 $this->saveField('parent', 1);

	 }    	 

	 return true;
}


	function lastIVR(){

	 $total = $this->find('count');

	 if ($total){
	    return false;
	    }

	    else {
	    return true;
	    }

}

/**
 * Update parent status of IVR menus. 
 * update ivr_menus set status = 0;
 * update ivr_menus set status = 1 where id = $id
 *
 */
    function updateParent(){
    
    	     $this->updateAll(array('IvrMenu.parent' => 0));
    	     $this->saveField('parent', 1);
    }


/**
 * Check if IVR is parent
 * return true| false
 *
 */
    function isParent($id){

	 $this->unbindModel(array('hasMany' => array('Node')));   
    	 $data = $this->findByParent(1);     
    	 
	 if($data['IvrMenu']['id']==$id){
	    return 1;
	  }
	   else {
	    return 0;
	  }
    	    
    }



/**
 * Fetch next IVR that is not parent(order by id)
 * return $id 
 *
 */
    function nextEntry(){

    $this->unbindModel(array('hasMany' => array('Node')));      
    $data= $this->find('first', array('conditions' => array('IvrMenu.instance_id' => IID)));
    $id = $data['IvrMenu']['id'];

    return $id;

    }


/**
 * Set parent flag =1 of selected IVR
 * update ivr_menus set parent = 1 where id = $id
 *
 */
    function setNewParent(){

    $this->unbindModel(array('hasMany' => array('Node')));   
    $this->saveField('parent',1);

    }


/**
 * Write IVR xml file (curl_xml)
 * All existing IVRs for an instance is written. The default IVR is set to parent.
 *
 */
     function writeIVR(){


	$data = $this->query("select * from ivr_menus where instance_id=100 order by parent desc");

	//Instanciate class	
	 $obj = new ivr_xml();	       

	 //Create header
	$obj->ivr_header();      

	//write each IVR
	foreach($data as $key => $ivr){

	      $ivr = $ivr['ivr_menus'];

	      //Create xml menu
	      $obj->write_menu($ivr);
	      if($ivr['option1_id']){ $obj->write_entry($ivr['option1_type'],$ivr['option1_id'],1,$key);}
	      if($ivr['option2_id']){ $obj->write_entry($ivr['option2_type'],$ivr['option2_id'],2,$key);}
	      if($ivr['option3_id']){ $obj->write_entry($ivr['option3_type'],$ivr['option3_id'],3,$key);}
              if($ivr['option4_id']){ $obj->write_entry($ivr['option4_type'],$ivr['option4_id'],4,$key);}
              if($ivr['option5_id']){ $obj->write_entry($ivr['option5_type'],$ivr['option5_id'],5,$key);}
              if($ivr['option6_id']){ $obj->write_entry($ivr['option6_type'],$ivr['option6_id'],6,$key);}
              if($ivr['option7_id']){ $obj->write_entry($ivr['option7_type'],$ivr['option7_id'],7,$key);}
              if($ivr['option8_id']){ $obj->write_entry($ivr['option8_type'],$ivr['option8_id'],8,$key);}
              

	      $obj->write_entry_common($key);
	  
	    }

    	    //Write to file
	    $obj->write_file();
	    $obj->close_file();

      }	    
}

?>
