<?php

class Bin extends AppModel{

      var $name = 'Bin';


    function getBody($id){

    	  $data = $this->findById($id);
    	  return $data['Bin']['body'];     

    }

}

?>