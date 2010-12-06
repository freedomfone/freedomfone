<?php
/****************************************************************************
 * edit_selector.ctp	- Edit language selecor
 * version 	        - 1.0.360
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

$settings = Configure::read('IVR_SETTINGS');

$commentTitle   = "<span class='formHelp'>".__("Name of language selector",true)."</span>";
$commentLong    = "<span class='formHelp'>".__("Brief instruction how to reach each language menu.",true)."</span>";
$commentInvalid = "<span class='formHelp'>".__("Warning that the user has pressed an invalid option.",true)."</span>";



echo "<h1>".__("Edit language selector",true)."</h1>";


	if($this->data && $this->data['IvrMenu']['ivr_type']=='switcher'){


                $switcher = $this->data['IvrMenu'];

                if ($messages = $session->read('Message.multiFlash')) {
                              foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
                }

                $path = $settings['path'].$switcher['instance_id'].'/'.$settings['dir_menu'];

                echo $form->create('IvrMenu', array('type' => 'post', 'action' => 'edit_selector','enctype' => 'multipart/form-data') );
                echo $form->input('id',array('type'=>'hidden'));
                echo $form->input('instance_id',array('type'=>'hidden','value'=>$switcher['instance_id']));

                
                //** TITLE **///
                echo "<fieldset>";
                echo "<legend>".__('Title',true)."</legend>";
                echo $form->input('title',array('type'=>'text','size' => '93', 'between'=>'<br />','label'=>$commentTitle));
                echo "</fieldset>";

                //** MENU INSTRUCTIONS **///
                echo "<fieldset>";
                echo "<legend>".__('Menu Instructions',true)."</legend>";

               
                $step1[3]=false; 
                $step2[3]=false;


                 //**** 1. Instructions ****//
                 $step1[0] = "<h3>1. ".__('Instructions',true)."</h3>";
                 $step1[1] = $form->input('message_long',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentLong, 'between'=>'<br />' ));
                 $step1[2] = $form->input('SwitcherFile.file_long', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step1[4] = $this->element('player',array('host'=>$settings['host'],'path'=>$path,'file'=>'file_long','title'=>__('Instructions Message',true),'id'=>'short'));

                 if($switcher['file_long']){
	                $step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['instance_id']}/short",null, null, false);
	         }

                 echo "<table>";
                 echo $html->tableCells(array(
		      array(array($step1[0],array('colspan'=>3))),	
		      array(array($step1[1],array('colspan'=>3))),	
		      array($step1[2],array($step1[3],array('valign'=>'bottom')),array($step1[4],array('valign'=>'bottom')))));
                 echo "</table>";


                 //**** 2. Invalid ****//
                 $step2[0] = "<h3>2. ".__('Invalid option',true)."</h3>";
                 $step2[1] = $form->input('message_invalid',array('type'=>'textarea','cols' => '80', 'rows' => '3', 'label'=>$commentInvalid, 'between'=>'<br />' ));
                 $step2[2] = $form->input('SwitcherFile.file_invalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
                 $step2[4] = $this->element('player',array('host'=>$settings['host'],'path'=>$path,'file'=>'file_invalid','title'=>__('Invalid Message',true),'id'=>'short'));

                 if($switcher['file_invalid']){
	                $step1[3] = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/ivr_menus/download/{$this->data['IvrMenu']['instance_id']}/short",null, null, false);
	         }

                 echo "<table>";
                 echo $html->tableCells(array(
		      array(array($step2[0],array('colspan'=>3))),	
		      array(array($step2[1],array('colspan'=>3))),	
		      array($step2[2],array($step2[3],array('valign'=>'bottom')),array($step2[4],array('valign'=>'bottom')))));
                 echo "</table>";
	

    
                echo "</fieldset>";

                //** SERVICES **//
                echo "<fieldset>";
                echo "<legend>".__('Services',true)."</legend>";


     for($i=0;$i<9;$i++){

        echo $form->input('Mapping.'.$i.'.digit',array('type'=>'hidden','value' => $i+1));	
        echo $form->input('Mapping.'.$i.'.id',array('type'=>'hidden'));	



        $default = false;
     	$options1=array('lam' =>'');
     	$options2=array('ivr' =>'');
     	$options3=array('node' =>'');

        $attributes=array('legend'=>false,'default'=>$default);


        $radio1 = $form->radio('Mapping.'.$i.'.type',$options1,array('legend' => false, 'default' => true));
	$radio2 = $form->radio('Mapping.'.$i.'.type',$options2,$attributes);
       	$radio3 = $form->radio('Mapping.'.$i.'.type',$options3,$attributes);

        $listen = false;

        if($this->data['Mapping'][$i] ){

//          if( array_key_exists('type', $this->data['Mapping'][$i])){
                if($this->data['Mapping'][$i]['type'] == 'node'){

                   $id = $this->data['Mapping'][$i]['node_id'];
                   $file = $nodes['file'][$id];
                   $title = $nodes['title'][$id];
      	           $path = $settings['path'].$settings['dir_node'];
	           $listen =  $this->element('player',array('path'=>$path,'file'=>$file,'title'=>$title,'id'=>$id));
                }
  //         }
        }


        $row[$i]=array(
	array("<h3>".__('#',true)." ".($i+1)."</h3>",array('width'=>'100px')),
	$radio1, 
        $form->input('Mapping.'.$i.'.lam_id',array('type'=>'select','options' => $lam,'label'=>'','empty'=>'- '.__('Select Leave-a-message',true).' -' )),
	$radio2, 
        $form->input('Mapping.'.$i.'.ivr_id',array('type'=>'select','options' => $voicemenu,'label'=>'','empty'=>'- '.__('Select Voice Menu',true).' -' )),
	$radio3, 
        $form->input('Mapping.'.$i.'.node_id',array('type'=>'select','options' => $nodes['title'],'label'=>'','empty'=>'- '.__('Select content',true).' -' )),
	$listen,

	);


     }

     echo "<table width='100%'>";
     echo $html->tableCells($row);
     echo "</table>";


     echo "</fieldset>";
     echo $form->end(__('Save',true)); 

     }

     else {

         echo "<h3>".__("This language selector does not exist.",true)."</h3>";

     }

?>



