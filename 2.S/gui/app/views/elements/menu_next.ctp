<?
/****************************************************************************
 * menu_next.ctp	- Simple menu used for FF functionality pages to display previous and next
 * version 		- 3.0.1500
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

	if(isset($back_text) && isset($fwd_text)){

		      $frame = '&#171; '.$html->link($back_text,$back_link)." | ".$html->link($fwd_text,$fwd_link).' &#187;';
		     
		      }

		      elseif(isset($back_text) && !isset($fwd_text)){

		      $frame = '&#171; '.$html->link($back_text,$back_link);

		      }
		      elseif(!isset($back_text) && isset($fwd_text)){

		      $frame = $html->link($fwd_text,$fwd_link).' &#187;';

		      }


 echo $html->div($div,$frame);
?>