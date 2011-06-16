<?
Configure::write('debug', 0);

echo "<h1>Classification of votes</h1>";
echo "<p>The system classifies all incoming votes as <i>valid</i>, <i>invalid</i>, or <i>incorrect</i>:</p>";
echo "<p><b>Valid vote:</b> correct poll code, and correct poll option|<ul><li>Early: Received before the poll opened.</li><li>In time: Received while the poll was open.</li><li>Late: Received after the poll was closed.</li></ul>Early votes will be registered as \"Valid, early\". The number of early votes per poll option is presented in a separate column under the View poll page. Early votes will not be added to the Total votes accepted for the poll.</p>";

echo "<p>Late votes will be registered as \"Valid, late\". The number of late votes per poll option is presented in a separate column under the View poll page. Late votes will not be added to the Total votes accepted for the poll.</p>";
echo "<p><b>Invalid vote:</b> correct poll code, but a non-matching poll option</p>";
echo "<p>Invalid votes are registered as votes, but classified as \"invalid\". \"Early\", \"late\" and \"on-time\" invalid votes are registered.</p>";
echo "<p>Only \"on-time\" invalid votes are incorporated into the Total number of votes (in time) summary.</p>";
echo "<p>Invalid vote totals are provided to give deployers an idea of how SMS errors might impact on poll results.</p>";
echo "<p><b>Incorrect vote:</b> Non-matching poll code</p>";
echo "<p>Incorrect votes that cannot be matched to any existing poll, will be classified as an incoming SMS and will be stored under \"Incoming SMS\". The SMS will be classified as \"Unclassified\".</p>";

?>
