<?php
/****************************************************************************
 * general.ctp	- Data mining of LAM and IVR calls
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


 //If action = Export, create CSV file 
 $export=false;


 if(isset($this->request->data['action'])) {	
	
     if ($this->request->data['action']==__('Export',true) && $authGroup == 1){


     	$this->Csv->clear();
	     $export= true;
	     $line = array(__('DateXXX (Y-m-d)',true),__('Year',true),__('Month',true),__('Day',true),__('Time',true),__('Title',true),__('Caller',true),__('Channel',true),__('Length',true));
		$this->Csv->addRow($line);


	if($export_cdr){

		foreach($export_cdr as $key => $entry){

                if(!$entry['Cdr']['length']){$entry['Cdr']['length'] = 0;}
 
		$line = array( date('Y-m-d',$entry['Cdr']['epoch']),
		               date('Y',$entry['Cdr']['epoch']),
		      	       date('m',$entry['Cdr']['epoch']),
			       date('d',$entry['Cdr']['epoch']),
			       date('H:i:s',$entry['Cdr']['epoch']),
			       $entry['Cdr']['title'],
			       $entry['Cdr']['caller_number'],
			       $entry['Cdr']['proto'],
			       $entry['Cdr']['length']);

		$this->Csv->addRow($line);

		}

	}

		$prefix=date('Y-m-d');
	
		$filename = $prefix."_".__('CDR',true)."_".$application."_".$select_option;

		echo $this->Csv->render($filename);  
		$this->Csv->render(false);
	
	} //export

   } //action 


echo $this->Html->addCrumb(__('System data',true), '');
echo $this->Html->addCrumb(__('Reporting',true), '/cdr/general');

$settings = Configure::read('IVR_SETTINGS');
  
	//Do not display form if action=Export
	if(!$export){

	//** START: Search form **/
	echo "<h1>".__("Call detail report",true)."</h1>";
	echo $this->Form->create('Cdr',array('type' => 'post','action'=> 'general'));
	$options1=array('lam' =>'');
	$options2=array('ivr' =>'');


	//Set application default value (LAM)

	if( !array_key_exists('Cdr', $this->request->data)){
	      if(!$app = $this->Session->read('cdr_app')){
 
                           $app = 'lam';
    	       }
	    }


       foreach($lam as $key => $entry){
             $lam[$key] = $this->Text->truncate($entry,30,array('ending' => '...', 'exact' => true, 'html' => false));
       }
       foreach($ivr as $key => $entry){
             $ivr[$key] = $this->Text->truncate($entry,30,array('ending' => '...', 'exact' => true, 'html' => false));
       }


	    $radio1 = $this->Form->radio('application',$options1,array('legend'=>false,'value'=>$app));
	    $radio2 = $this->Form->radio('application',$options2,array('legend'=>false,'value'=>$app));

	    $menu_lam = $this->Form->input('title_lam',array('type'=>'select','options' =>$lam, 'selected' => $this->Session->read('title'),'label'=>''));
	    $menu_ivr = $this->Form->input('title_ivr',array('type'=>'select','options' =>$ivr, 'selected' => $this->Session->read('title'), 'label'=>''));

	    echo "<table cellspacing = 0 class = 'none'>";
	    echo $this->Html->tableCells(array (
     	    	 array(__('Application',true),$radio1,$menu_lam,$radio2,$menu_ivr)
      		 ),array('class' => 'none'), array('class' => 'none'));
            echo "</table>";



	    echo "<table cellspacing = 0 class = 'none'>";
	    echo $this->Html->tableCells(array (
     	    	 array(__("Start time",true),	$this->Form->input('start_time',array('label'=>false,'type' => 'datetime', 'interval' => 15, 'selected'=>$this->Session->read('cdr_start')))),
     		 array(__("End time",true),	$this->Form->input('end_time',array('label'=>false,'type' => 'datetime','interval' => 15,'selected' =>$this->Session->read('cdr_end')))),
      		 ),array('class' => 'none'),array('class' => 'none'));
	    echo "</table>";


	    echo "<table cellspacing = 0 class = 'none'>";
	    $buttons=array();
	    $buttons[]= $this->Form->submit(__('View',true),array('name'=>'action'));

     	    if($cdr && $authGroup == 1){ 
	    	      $buttons[] = $this->Form->submit(__('Export',true),array('name'=>'action'));
             }

	     echo $this->Html->tableCells($buttons,array('class' => 'none'),array('class' => 'none'));
	     echo "</table>";
	     echo $this->Form->end();
	     //** END: Search form **/


	    //** START: List CDR **/
    	    if($cdr){

          	    
	    echo $this->Html->div('feedback',__('Number of records found:',true)." ".$count);

		foreach($cdr as $key => $entry){

	
	    		     $data = $entry['Cdr'];
	  		     $line = array( $data['title'], 
				            date('M d Y',$data['epoch']),
					    date('H:i:s A',$data['epoch']),
				            $this->Access->showBlock($authGroup, $data['caller_number']),
				            $this->Formatting->epochToWords($data['length'])
			                   );
                               if($app == 'lam') { $line[] = $this->element('message_status',array('quickHangup' => $data['quick_hangup']));}
                             $rows[] = $line;
	     		     }

	     $headers = array(__('Title',true),__('Date',true),__('Time',true),__('Caller',true),__('Length',true));

             if($app == 'lam') { $headers[] = __('Quick hangup',true); }

	     echo "<table cellspacing = 0>";
	     echo $this->Html->tableHeaders($headers);
	     echo $this->Html->tableCells($rows);
	     echo "</table>";


             if($this->Paginator->counter(array('format' => '%pages%'))>1){
                     echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
              }


              echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('25','general/limit:25',null, null, false)." | ".$this->Html->link('50','general/limit:50',null, null, false)." | ".$this->Html->link('100','general/limit:100',null, null, false));





	     }	  else {
	     echo $this->Html->div('feedback',__('No records found.',true));
	     }
 
	     //** END: List CDR **/

	     }

?>