<?
   echo "<div id='batch_div' class='batch_div'>";

   if($batch){

           echo "<table width='35%' cellspacing  = '0' class = 'stand-alone'>";
	   $row[] = array(array(__('Batch details',true),array('colspan'=> 2, 'align' => 'center')));
           $row[] = array(__('Start time',true), $batch['Callback']['start_time']);
           $row[] = array(__('End time',true), $batch['Callback']['end_time']);
           $row[] = array(__('Initialization time',true), $batch['Callback']['created']);
           $row[] = array(__('Max duration',true), $batch['Callback']['max_duration']);
           $row[] = array(__('Max retries',true), $batch['Callback']['max_retries']);

           echo $html->tableCells($row,array('class'=>'stand-alone'),array('class'=>'stand-alone'));
           echo "</table>";

           }

  echo "</div>";


?>

