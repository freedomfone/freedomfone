<?php 
$this->pageTitle = 'Functionality : Poll ';           
echo $this->element('menu_next',array('fwd_text'=>__('Leave-a-message',true),'fwd_link'=>'/functionality/leave-a-message','div'=>'frameRight')); 

echo "<h1>Functionality: Poll</h1>";

?>
<p>The Poll service allows end users to participate in polls by sending SMSs to Freedom Fone. 
<p>The Freedom Fone administrator has the ability to <a href='/freedomfone/polls/add'>create</a>, <a href='/freedomfone/polls/'>edit and delete</a> polls. A poll is composed using the following parameters:


<ul>
<li>Question:   The question you want your audience to answer to</li>
<li>Code: 	The SMS code to use, to associate an SMS with your poll</li>
<li>Answers:    Two or more answers to the question.</li>
<li>Start time: Date and time when the poll opens for submission</li>
<li>End time:   Date and time when the poll closes for submission</li>
</ul>

<p>Poll details can be communicated with the public via any means, including website, email and printed materials. Remember to share the above details and include the phone number or short code to which participants should send their SMS replies.</p>
<p>The administrator can at any time edit the above listed fields. Of course, it is not recommended to change the question, code or answers to a poll, once it has been opened to the public.</p>
<p>Before a poll is opened, and after it has been closed, no poll votes are registered for the poll.</p>
<p>For each poll, once it has started, the administrator can at anytime, view the interim or final result in terms of number of votes per answer, and percentage of total votes per answer.</p>
<p>The poll is not sensitive to casing, so 'yes' ,'Yes', 'YES', 'yEs' will all be interpreted as a YES! The same logic applies to the SMS code.</p>
<p>More than one poll can be active at the same time. Incoming SMS are identified by the SMS code in use. </p>


<p>Example: The administrator creates a poll with the following parameters:

<ul>
<li>Question:   </td><td>Would you like to deploy Freedom Fone in your organization?</li>
<li>Code: 	    </td><td>freedomfone</li>
<li>Answers:    </td><td>Yes/No/Maybe</li>
<li>Start time: </td><td>08:00 AM, January 1, 2010</li>
<li>End time:   </td><td>08:00 AM, January 31, 2010</li>
</ul>

<p>To participate in the poll, the end user needs to send an SMS (after  08:00 AM the 1st of January, and before 08:00 AM the 31st of January 2010) with the following message: </p> 
<pre>freedomfone yes</pre>

<p>To participate in a poll, send an sms to +39 340 47 80 434 or +39 333 677 45 32 or a Skype chat message to "skypiax2" or "skypiax4".</p>