<?php
/****************************************************************************
 * index.ctp	- Form for selecting Freedom Fone logs
 * version 	- 1.0.354
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
//Georgia

	echo "<h1>".__("System Overview",true)."</h1>";

        echo "<div id = 'header'>";
        echo $html->tag('span', 'Question',array('class' => 'header_start'));
        echo $html->tag('span', 'SMS code',array('class' => 'header_mid'));
        echo $html->tag('span', 'Votes',array('class' => 'header_end'));
        echo "</div>";        

        foreach ($polls as $poll){

$votes  = 5;
        echo "<div id = 'header'>";
        echo $html->tag('span', $poll['Poll']['question'],array('class' => 'body_mid'));
        echo $html->tag('span', $poll['Poll']['code'] ,array('class' => 'body_mid'));
        echo $html->tag('span', $votes,array('class' => 'body_mid'));
        echo "</div>";



        }


?>