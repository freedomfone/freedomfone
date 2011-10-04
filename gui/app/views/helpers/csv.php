<?php 
/****************************************************************************
 * csv.php	- Helper for creating CSV files.
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

 * The Initial Developer of the Original Code is
 *  
 * Adam (ifunk) http://bakery.cakephp.org/articles/view/csv-helper-php5
 *    
 *
 *
 ***************************************************************************/
 
class CsvHelper extends AppHelper {
      
      var $delimiter = ',';
      var $enclosure = '"';
      var $filename = 'Export.csv';
      var $line = array();
      var $buffer;
      
      function CsvHelper() {
      	       $this->clear();
	       }
	       
       function clear() {
		$this->line = array();
		$this->buffer = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
	}
				    
	function addField($value) {
		$this->line[] = $value;
	}
	

       function endRow() {
		 $this->addRow($this->line);
		 $this->line = array();
	}
		
	
	function addRow($row) {
 	 	 fputcsv($this->buffer, $row, $this->delimiter, $this->enclosure);
	}
			 
	function renderHeaders() {
	 	  header("Content-type:application/vnd.ms-excel");
		  header("Content-disposition:attachment;filename=".$this->filename);
	}
	
	function setFilename($filename) {
		$this->filename = $filename;
		if (strtolower(substr($this->filename, -4)) != '.csv') {
			$this->filename .= '.csv';
		}
	}
					
 	function render($outputHeaders = true, $to_encoding = null, $from_encoding = "auto") {
        
		if ($outputHeaders) {
            	   if (is_string($outputHeaders)) {
                      $this->setFilename($outputHeaders);
            	      }
            	      $this->renderHeaders();
        	      }
        	      rewind($this->buffer);
        	      $output = stream_get_contents($this->buffer);
        	      if ($to_encoding) {
            	      	 $output = mb_convert_encoding($output, $to_encoding, $from_encoding);
        		 }
        		 return $this->output($output);
        }
}			  


?>