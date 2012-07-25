<?
Configure::write('debug', 0);

echo "<h1>Poll</h1>";
echo "<p>The Poll service allows end users to participate in polls by sending SMSs to Freedom Fone.<p>";
echo "<p>The Freedom Fone administrator has the ability to create, edit and delete polls.<p>";
echo "<p>The administrator can at any time edit the above listed fields. Of course, it is not recommended to change the question, code or answers to a poll, once it has been opened to the public.<p>";
echo "<p>Before a poll is opened, and after it has been closed, no poll votes are registered for the poll. <p>";
echo "<p>For each poll, once it has started, the administrator can at anytime, view the interim or final result in terms of number of votes per answer, and percentage of total votes per answer.</p>";

?>