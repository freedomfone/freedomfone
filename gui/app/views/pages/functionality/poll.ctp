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

echo "<h3>".__("Classification of votes",true)."</h3>";
echo __("<p>The system classifies all incoming votes as <i>valid, invalid,</i> or <i>incorrect</i>:</p>",true);
echo __("<p><b>Valid vote:</b> correct poll code, and correct poll option</p>",true);
echo __("<ul><li>Early: Received before the poll opened.</li><li>In time: Received while the poll was open.</li><li>Late: Received after the poll was closed.</li></ul>",true);
echo __("<p>Early votes will be registered as ”Valid, early”. The number of early votes per poll option is presented in a separate column under the View poll page. Early votes will not be added to the Total votes accepted for the poll.",true);
echo __("<p>Late votes will be registered as “Valid, late”. The number of late votes per poll option is presented in a separate column under the View poll page. Late votes will not be added to the Total votes accepted for the poll.",true);
echo __("<p>The Early and Late vote classifications are summarised separately to provide a complete view of votes submitted to the poll concerned.",true);

echo __("<p><b>Invalid vote:</b> correct poll code, but a non-matching poll option",true);
echo __("<p>Invalid votes are registered as votes, but classified as “invalid”. “Early”, “late” and “on-time” invalid votes are registered.",true);
echo __("<p>Only “on-time” invalid votes are incorporated into the Total number of votes (in time) summary.",true);
echo __("<p>Invalid vote totals are provided to give deployers an idea of how SMS errors might impact on poll results.",true); 

echo __("<p><b>Incorrect vote: </b>Non-matching poll code",true);
echo __("<p>Incorrect votes that cannot be matched to any existing poll, will be classified as an incoming SMS and will be stored under “Other SMS”. The SMS will be classified as “Unclassified”.",true);

echo "<h3>".__("Practical example",true)."</h3>";
echo __("<p>The poll is not sensitive to casing, so 'yes' ,'Yes', 'YES', 'yEs' will all be interpreted as a YES. The same logic applies to the SMS code.</p>",true);
echo __("<p>More than one poll can be active at the same time. Incoming SMS are identified by the SMS code used and matched with existing polls. </p>",true);

echo __("<p>The timestamp used to determine whether or not a vote is in time for a poll, is the time of arrival to the Freedom Fone platform. Hence, if an SMS gets delayed in the GSM network, it will be classified as late even if it was sent before the poll deadline. ",true);

echo __("<p>Example: The administrator creates a poll with the following parameters:<ul><li>Question: Would you like to deploy Freedom Fone in your organization?</li><li>Code: freedomfone</li><li>Answers: Yes/No/Maybe</li><li>Start time: 08:00 AM, January 1, 2010</li><li>End time: 08:00 AM, January 31, 2010</li></ul></p>",true);

echo __("<p>To participate in the poll, the end user needs to send an SMS (after  08:00 AM the 1st of January, and before 08:00 AM the 31st of January 2010) with one of the following messages: </p><pre>freedomfone yes\nfreedomfone no\nfreedomfone maybe</pre>",true);
