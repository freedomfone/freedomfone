<?php
/****************************************************************************
 * edit_selector.ctp	- Edit language selecor
 * version 	        - 3.0.1500
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


echo $this->Html->addCrumb(__('IVR Centre',true), '');
echo $this->Html->addCrumb(__('Language selectors',true), '/selectors');



$ivr_settings = Configure::read('IVR_SETTINGS');

$commentTitle   = "<span class='formHelp'>".__("Name of language selector",true)."</span>";
$commentLong    = "<span class='formHelp'>".__("Brief instruction how to reach each language menu.",true)."</span>";
$commentInvalid = "<span class='formHelp'>".__("Warning that the user has pressed an invalid option.",true)."</span>";



echo "<h1>".__("Edit language selector",true)."</h1>";


	if($this->data && $this->data['IvrMenu']['ivr_type']=='switcher'){

                echo $this->Html->addCrumb(__('Edit',true), '/selectors/edit/'.$this->data['IvrMenu']['id']);

                $switcher = $this->data['IvrMenu'];

                echo $this->Session->flash();


                $path = $ivr_settings['path'].$switcher['instance_id'].'/'.$ivr_settings['dir_menu'];

                echo $this->Form->create('IvrMenu', array('type' => 'post', 'action' => 'edit_selector','enctype' => 'multipart/form-data') );
                echo $this->Form->input('id',array('type'=>'hidden'));
                echo $this->Form->input('instance_id',array('type'=>'hidden','value'=>$switcher['instance_id']));

                
                //** TITLE **///
                echo "<fieldset>";
                echo "<legend>".__('Title',true)."</legend>";
                echo $this->Form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle));
                echo "</fieldset>";

                //** MENU INSTRUCTIONS **///
                echo "<fieldset>";
                echo "<legend>".__('Menu Instructions',true)."</legend>";

               
                $step1[3]=false; 
                $step2[3]=false;


                 //**** 1. Instructions ****//
                 $step1[0] = "<h3>1. ".__('Instructions',true)."</h3>";
                 $step1[1] = $this->Form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'between'=>'<br />' ));
                 $step1[2] = $this->Form->input('SwitcherFile.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step1[4] = $this->element('player',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>'file_long','title'=>__('Instructions Message',true),'id'=>'long'));

                 if($switcher['file_long']){
        		$step1[3] = $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "ivr_menus", "action" => "download", $this->data['IvrMenu']['instance_id'], 'long')));  	

	         }

                 echo "<table cellspacing=0 class='none'>";
                 echo $this->Html->tableCells(array(
		      array(array($step1[0],array('colspan'=>3))),	
		      array(array($step1[1],array('colspan'=>3))),	
		      array($step1[2],array($step1[3],array('valign'=>'bottom')),array($step1[4],array('valign'=>'bottom')))),array('class' =>'none'),array('class' =>'none'));
                 echo "</table>";


                 //**** 2. Invalid ****//
                 $step2[0] = "<h3>2. ".__('Invalid option',true)."</h3>";
                 $step2[1] = $this->Form->input('message_invalid',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentInvalid, 'between'=>'<br />' ));
                 $step2[2] = $this->Form->input('SwitcherFile.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step2[4] = $this->element('player',array('host'=>$ivr_settings['host'],'path'=>$path,'file'=>'file_invalid','title'=>__('Invalid Message',true),'id'=>'invalid'));

                 if($switcher['file_invalid']){
        		$step2[3] = $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "ivr_menus", "action" => "download", $this->data['IvrMenu']['instance_id'], 'short')));  	

	         }

                 echo "<table cellspacing=0 class='none'>";
                 echo $this->Html->tableCells(array(
		      array(array($step2[0],array('colspan'=>3))),	
		      array(array($step2[1],array('colspan'=>3))),	
		      array($step2[2],array($step2[3],array('valign'=>'bottom')),array($step2[4],array('valign'=>'bottom')))),array('class' =>'none'),array('class' =>'none'));
                 echo "</table>";
	

    
                echo "</fieldset>";

                //** SERVICES **//
                echo "<fieldset>";
                echo "<legend>".__('Services',true)."</legend>";


       foreach($lam as $key => $entry){
             $lam[$key] = $this->Text->truncate($entry,$ivr_settings['showLengthMin'], array('ending' => false,'exact' => true, 'html' => false));

       }



       foreach($voicemenu as $key => $entry){
             $voicemenu[$key] = $this->Text->truncate($entry,$ivr_settings['showLengthMin'],array('ending' => false,'exact' => true, 'html' => false));
       }

       foreach($nodes['title'] as $key => $entry){
             $nodes['title'][$key] = $this->Text->truncate($entry,$ivr_settings['showLengthMin'],array('ending' => false,'exact' => true, 'html' => false));
       }


     for($i=0;$i<8;$i++){

        echo $this->Form->input('Mapping.'.$i.'.digit',array('type'=>'hidden','value' => $i+1));	
        echo $this->Form->input('Mapping.'.$i.'.id',array('type'=>'hidden'));	



        $default = false;
     	$options1=array('lam' =>'');
     	$options2=array('ivr' =>'');
     	$options3=array('node' =>'');

        $attributes=array('legend'=>false,'default'=>$default);


        $radio1 = $this->Form->radio('Mapping.'.$i.'.type',$options1,array('legend' => false, 'default' => true));
	$radio2 = $this->Form->radio('Mapping.'.$i.'.type',$options2,$attributes);
       	$radio3 = $this->Form->radio('Mapping.'.$i.'.type',$options3,$attributes);

        $listen = false;
        if($mappings = $this->data['Mapping']){

          if(array_key_exists($i,$mappings)){
            
              if($mappings[$i]['type'] == 'node'){

                   $id = $mappings[$i]['node_id'];
                   $file = $nodes['file'][$id];
                   $title = $nodes['title'][$id];
      	           $path = $ivr_settings['path'].$ivr_settings['dir_node'];
	           $listen =  $this->element('player',array('path'=>$path,'file'=>$file,'title'=>$title,'id'=>$id));
                }

           }
        }


        $row[$i]=array(
	"<h3>".__('#',true)." ".($i+1)."</h3>",
	$radio1, 
        $this->Form->input('Mapping.'.$i.'.lam_id',array('type'=>'select','options' => $lam,'label'=>'','empty'=>'- '.__('Select entry',true).' -' )),
	$radio2, 
        $this->Form->input('Mapping.'.$i.'.ivr_id',array('type'=>'select','options' => $voicemenu,'label'=>'','empty'=>'- '.__('Select entry',true).' -' )),
	$radio3, 
        $this->Form->input('Mapping.'.$i.'.node_id',array('type'=>'select','options' => $nodes['title'],'label'=>'','empty'=>'- '.__('Select entry',true).' -' )),
	$listen,

	);


     }


     $headers = array('','',__('Leave-a-Message',true),'',__('Voice Menu',true),'',__('Content',true),'');
     echo "<table cellspacing=0>";
     echo $this->Html->tableHeaders($headers);
     echo $this->Html->tableCells($row, array('class' =>'none'),array('class' =>'none'));
     echo "</table>";


     echo "</fieldset>";
     echo $this->Form->end(__('Save',true)); 

     }

     else {

         echo "<h3>".__("This language selector does not exist.",true)."</h3>";

     }

?>



