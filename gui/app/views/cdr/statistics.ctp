<?php
/****************************************************************************
 * overview.ctp	- Show CDR statistics
 * version 	- 2.0.1160
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
echo $html->addCrumb('Statistics', '/cdr/statistics')
;

$session->flash();

echo "<h1>".__('CDR Statistics',true)."</h1>";

echo $form->create('Cdr',array('type' => 'post','action'=> 'statistics'));
echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

     //Calculate stats for CDR
     $pollCount  = 0;
     $lamCount   = 0;
     $ivrCount   = 0;
     $otherCount = 0;


     if($cdr){


     foreach ($cdr as $key => $entry){


     $app = $entry['Cdr']['application'];

  	     switch($app){

	     case 'poll':
	     $pollCount = $pollCount + 1;
	     break;

	     case 'lam':
	     $lamCount = $lamCount + 1;
	     break;

	     case 'ivr':
	     $ivrCount =$ivrCount +1;
	     break;

	     case 'bin':
	     $otherCount = $otherCount + 1;
	     break;
	     }
     }


    }

     $all=$lamCount+$ivrCount+$pollCount+$otherCount;
     $total=$all;
     if(!$all){ $all=1;}


     echo $form->create('Cdr',array('type' => 'post','action'=> 'statistics'));
  
     echo "<table width='400px' cellspacing = 0>";
     echo $html->tableHeaders(array (__('Application',true),__('No of entries',true),__('Percentage',true)),false,array('align'=>'center'));
     $stat[] = array(__('Leave-a-message',true), array($lamCount,array('align'=>'center')),array(round(100*$lamCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Voice menus',true), 	 array($ivrCount,array('align'=>'center')),array(round(100*$ivrCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Poll',true),		 array($pollCount,array('align'=>'center')),array(round(100*$pollCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Other SMS',true),	 array($otherCount,array('align'=>'center')),array(round(100*$otherCount/$all).' %',array('align'=>'center')));


  
     echo $html->tableCells($stat);
     echo $html->tableHeaders(array('', $total, 100*($lamCount+$ivrCount+$pollCount+$otherCount)/$all.' %'), false, array('align' => 'center'));
     echo "</table>";

     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells(array (
     array(__("Start time",true),	$form->input('start_time',array('label'=>false,'type' => 'datetime','interval'=>15,'selected' => $start))),
     array(__("End time",true),		$form->input('end_time',array('label'=>false,'type' => 'datetime','interval'=>15,'selected' => $end))),
     array($form->end(array('name' => __('View',true), 'label' =>__('View',true),'class' =>'button')),false),
      ),array('class' => 'none'), array('class' => 'none'));
      echo "</table>"; 

?>
