<?
Configure::write('debug', 0);

echo "<h1>".__('Poll',true)."</h1>";
echo "<p>".__('The Poll service allows end users to participate in polls by sending SMSs to Freedom Fone.',true)."<p>";
echo "<p>".__('The Freedom Fone administrator has the ability to create, edit and delete polls.',true)."<p>";
echo "<p>".__('The administrator can at any time edit the above listed fields. Of course, it is not recommended to change the question, code or answers to a poll, once it has been opened to the public.',true)."<p>";
echo "<p>".__('Before a poll is opened, and after it has been closed, no poll votes are registered for the poll.',true)."<p>";
echo "<p>".__('For each poll, once it has started, the administrator can at anytime, view the interim or final result in terms of number of votes per answer, and percentage of total votes per answer.',true)."</p>";

?>