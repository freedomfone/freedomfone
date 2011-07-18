<?php
/****************************************************************************
 * general.ctp	- Data mining of LAM and IVR calls
 * version 	- 2.0.1150
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

echo $html->addCrumb('System data', '');
echo $html->addCrumb('Reporting', '/cdr/general');


 $session->flash();
 $settings = Configure::read('IVR_SETTINGS');

 //If action = Export, create CSV file 
 $export=false;

 if(isset($this->params['form']['action'])) {	
	
     if ($this->params['form']['action']==__('Export',true)){

	     $export=true;

		$line = array(__('Date (Y-m-d)',true),__('Year',true),__('Month',true),__('Day',true),__('Time',true),__('Title',true),__('Caller',true),__('Channel',true),__('Length',true));
		$csv->addRow($line);

	if($cdr){

		foreach($cdr as $key => $entry){

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

		$csv->addRow($line);

		}

	}

		$prefix=date('Y-m-d');
	
		$filename = $prefix."_".__('CDR',true)."_".$application."_".$select_option;

		echo $csv->render($filename);  
		$csv->render(false);
	
	} //export

   } //action 
  
	//Do not display form if action=Export
	if(!$export){

	//** START: Search form **/
	echo "<h1>".__("Reporting of incoming calls",true)."</h1>";
	echo $form->create('Cdr',array('type' => 'post','action'=> 'general'));
	$options1=array('lam' =>'');
	$options2=array('ivr' =>'');


	//Set application default value (LAM)


	if( ! $app = $this->data['Cdr']['application']){
	      if(!$app = $session->read('cdr_app')){
 
                           $app = 'lam';
    	       }
	    }


       foreach($lam as $key => $entry){
             $lam[$key] = $text->truncate($entry,30,'...',true,false);
       }
       foreach($ivr as $key => $entry){
             $ivr[$key] = $text->truncate($entry,30,'...',true,false);
       }


	    $radio1 = $form->radio('application',$options1,array('legend'=>false,'value'=>$app));
	    $radio2 = $form->radio('application',$options2,array('legend'=>false,'value'=>$app));

	    $menu_lam = $form->input('title_lam',array('type'=>'select','options' =>$lam,'label'=>'','empty'=>'- '.__('All Leave-a-message',true).' -'));
	    $menu_ivr = $form->input('title_ivr',array('type'=>'select','options' =>$ivr,'label'=>'','empty'=>'- '.__('All Voice Menus',true).' -'));

	    echo "<table cellspacing = 0 class = 'none'>";
	    echo $html->tableCells(array (
     	    	 array(__('Application',true),$radio1,$menu_lam,$radio2,$menu_ivr)
      		 ),array('class' => 'none'), array('class' => 'none'));
            echo "</table>";

	    echo "<table cellspacing = 0 class = 'none'>";
	    echo $html->tableCells(array (
     	    	 array(__("Start time",true),	$form->input('start_time',array('label'=>false,'type' => 'datetime', 'interval' => 15, 'selected'=>$session->read('cdr_start')))),
     		 array(__("End time",true),	$form->input('end_time',array('label'=>false,'type' => 'datetime','interval' => 15,'selected' =>$session->read('cdr_end')))),
      		 ),array('class' => 'none'),array('class' => 'none'));
	    echo "</table>";


	    echo "<table cellspacing = 0 class = 'none'>";
	    $buttons=array();
	    $buttons[]= $form->submit(__('View',true),array('name'=>'action'));
     	    if($cdr){ 
	    	      $buttons[] = $form->submit(__('Export',true),array('name'=>'action'));
             }
	     echo $html->tableCells($buttons,array('class' => 'none'),array('class' => 'none'));
	     echo "</table>";
	     echo $form->end();
	     //** END: Search form **/


	    //** START: List CDR **/
    	    if($cdr){

          	    
	    echo $html->div('feedback',__('Number of records found:',true)." ".$count);

		foreach($cdr as $key => $entry){
	    		     $data = $entry['Cdr'];
	  		     $line = array($data['title'],date('M d Y',$data['epoch']),date('H:i:s A',$data['epoch']),$data['caller_number'],$formatting->epochToWords($data['length']));
                               if($app == 'lam') { $line[] = $this->element('message_status',array('quickHangup' => $data['quick_hangup']));}
                             $rows[] = $line;
	     		     }

	     $headers = array(__('Title',true),__('Date',true),__('Time',true),__('Caller',true),__('Length',true));

             if($app == 'lam') { $headers[] = __('Quick hangup',true); }

	     echo "<table cellspacing = 0>";
	     echo $html->tableHeaders($headers);
	     echo $html->tableCells($rows);
	     echo "</table>";


             if($paginator->counter(array('format' => '%pages%'))>1){
                     echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
              }


              echo $html->div('paginator', __("Entries per page ",true).$html->link('25','general/view/limit:25',null, null, false)." | ".$html->link('50','general/view/limit:50',null, null, false)." | ".$html->link('100','general/view/limit:100',null, null, false));





	     }	  else {
	     echo $html->div('feedback',__('No records found.',true));
	     }
 
	     //** END: List CDR **/

	     }

?>


