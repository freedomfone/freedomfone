<?php
/****************************************************************************
 * disp.ctp	- Display Language Selector service options
 * version 	- 1.0.354
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


      echo $ajax->div("service_div");


      for($i=1;$i<=9;$i++){

        echo $form->input('Mapping.'.$i.'.digit',array('type'=>'hidden','value' => $i));	
        echo $form->input('Mapping.'.$i.'.id',array('type'=>'hidden'));	
        echo $form->input('Mapping.'.$i.'.type',array('type'=>'hidden','value' => $service));	


       $row[]=array( array("<h3>".__('#',true)." ".$i."</h3>", array('width'=>'100')),             
      $form->input('Mapping.'.$i.'.'.$service.'_id',array('type'=>'select','options' => $data, 'label' => false,'empty'=>'-- '.__('Select entry',true).' --' ))
      );  
                  }

         echo "<table width='700px'>";
         echo $html->tableCells($row);
         echo "</table>";
         echo $form->end(__('Save',true));
         echo $ajax->divEnd("service_div");
	

?>