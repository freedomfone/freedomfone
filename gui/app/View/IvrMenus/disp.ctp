<?php
/****************************************************************************
 * disp.ctp	- Display Language Selector service options
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

      $ivr  = Configure::read('IVR_SETTINGS');

      foreach($data as $key => $entry){
             $data[$key] = $this->Text->truncate($entry,$ivr['showLengthMax'],array('ending' => '...','exact' => true,'html' => false));

      }


      for($i=1;$i<=8;$i++){

        echo $this->Form->input('Mapping.'.$i.'.digit',array('type'=>'hidden','value' => $i));	
        echo $this->Form->input('Mapping.'.$i.'.id',array('type'=>'hidden'));	
        echo $this->Form->input('Mapping.'.$i.'.type',array('type'=>'hidden','value' => $service));	

        $row[]=array( array("<h3>".__('#',true)." ".$i."</h3>", array('width'=>'100')),             
        $this->Form->input('Mapping.'.$i.'.'.$service.'_id',array('type'=>'select','options' => $data, 'label' => false,'empty'=>'-- '.__('Select entry',true).' --' )));  
      
       }

       echo "<table width='700px' cellspacing = 0 class='none'>";
       echo $this->Html->tableCells($row,array('class' => 'none'),array('class' => 'none'));
       echo "</table>";
       echo $this->Form->end(__('Save',true));



?>