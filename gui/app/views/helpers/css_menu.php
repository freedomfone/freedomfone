<?php 
/*
 * CSS menu helper.  
 * Author: John Reeves.
 */
class CssMenuHelper extends Helper{

	var $helpers = array('Html');
	
	/*
	 * display a menu list.
	 * @arg $data: a nested associative array.  The keys are the text that
	 * 	is displayed for that menu item.  If the value is an array, it is
	 *	treated as a sub menu, with the same format.  Otherwise it is 
	 *	interpreted as a URL to be used for a link.
	 * @arg $type: the type of array.  Can be right, left, or down.
	 */
	function menu($data=array(), $type='right'){
		global $cm_css_inc;
		$out ='';
		if($cm_css_inc != true){
			$cm_css_inc = true;
			$out .= $this->Html->css('css_menu');
		}
		return $this->output($out . $this->_cm_render($data, $type));
	}

	/* render a menu. 
	 * This is a helper for recursion.  The arguments are the 
	 * same as for $this->menu().
	 */
	function _cm_render($data=array(), $type='right'){
		$out='';
		if($data == array()) return;
		if(is_array($data)){
			$out .= "<ul class=\"css_menu cm_$type\">\n";
			foreach($data as $key => $item){
				if(is_array($item)){
					$out .= '<li class="parent">'. $key. "\n";
					$out .= $this->_cm_render($item, $type);
					$out .= "</li>\n";
				}else{
					$out .= '<li><a href="'. $item. '">'. $key. '</a></li>'. "\n";
				}
			}
			$out .=  "</ul>\n";
		}
		return $out;
	}
}
?>