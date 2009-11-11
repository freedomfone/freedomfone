<?php echo $this->element('menu_next',array('back_text'=>__('Voice menu',true),'back_link'=>'/functionality/ivr','div'=>'frameRight')); ?>


<h1>Callback</h1>


<p>The Callback service offers callers a means to access audio content from Freedom Fone at a low cost, or at no cost at all. As the name suggests, the Callback service establishes outgoing phone calls from Freedom Fone to a caller, with the Freedom Fone deployer carrying the cost of the call. </p>
<p>To request a Callback from Freedom Fone, the caller can either</p>

<ul>
<li>send an SMS to a designated number with the text “callback”, or</li>
<li>tickle a designated number (ring once and hang up)</li>
</ul>

<p>The cost to the caller will either be the cost for an SMS, or nothing (if you hang up after the first ring).</p>

<h3>Administration settings</h3>

<p>The administrator can choose which content to connect with the Callback service. The options for Freedom Fone v.1 are </p>
<ul>
<li>Leave-a-message menu OR</li>
<li>Default Voice Menu</li>
</ul>


<p>To limit the risk of abuse of the Callback service, the administrator can limit the maximum number of Callbacks for a unique GSM number for a certain period of time.</p>

<ul>
<li>Max Calls: 10, 25, 50, 100, no limit</li>
<li>Period : 12h, 24h, 2d, 4d, 1 week</li>
</ul>

<p>The administration parameters can be found under Settings.</p>

