<?php
/****************************************************************************
 * poll.ctp	- Describes the poll functionality
 * version 	- 1.0.356
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
 
$this->pageTitle = __('Functionality : Poll ',true);           
echo $this->element('menu_next',array('fwd_text'=>__('Leave-a-message',true),'fwd_link'=>'/functionality/leave-a-message','div'=>'frameRight')); 

echo "<h1>".__('Functionality: Poll',true)."</h1>";
echo __("<p>The Poll service allows end users to participate in polls by sending SMSs to Freedom Fone.",true);
echo __("<p>The Freedom Fone administrator has the ability to <a href='/freedomfone/polls/add'>create</a>, <a href='/freedomfone/polls/'>edit and delete</a> polls. A poll is composed using the following parameters:",true);

echo __("<ul><li>Question: The question you want your audience to answer to</li><li>Code: The SMS code to use, to associate an SMS with your poll</li><li>Answers: Two or more answers to the question.</li><li>Start time: Date and time when the poll opens for submission</li><li>End time: Date and time when the poll closes for submission</li></ul>",true);


echo __("<p>Poll details can be communicated with the public via any means, including website, email and printed materials. Remember to share the above details and include the phone number or short code to which participants should send their SMS replies.</p>",true);
echo __("<p>The administrator can at any time edit the above listed fields. Of course, it is not recommended to change the question, code or answers to a poll, once it has been opened to the public.</p>",true);
echo __("<p>Before a poll is opened, and after it has been closed, no poll votes are registered for the poll.</p>",true);
echo __("<p>For each poll, once it has started, the administrator can at anytime, view the interim or final result in terms of number of votes per answer, and percentage of total votes per answer.</p>",true);
echo __("<p>The poll is not sensitive to casing, so 'yes' ,'Yes', 'YES', 'yEs' will all be interpreted as a YES! The same logic applies to the SMS code.</p>",true);
echo __("<p>More than one poll can be active at the same time. Incoming SMS are identified by the SMS code in use. </p>",true);

echo __("<p>Example: The administrator creates a poll with the following parameters:<ul><li>Question: Would you like to deploy Freedom Fone in your organization?</li><li>Code: freedomfone</li><li>Answers: Yes/No/Maybe</li><li>Start time: 08:00 AM, January 1, 2010</li><li>End time: 08:00 AM, January 31, 2010</li></ul></p>",true);

echo __("<p>To participate in the poll, the end user needs to send an SMS (after  08:00 AM the 1st of January, and before 08:00 AM the 31st of January 2010) with the following message: </p><pre>freedomfone yes</pre>",true);
