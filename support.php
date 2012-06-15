<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2009 
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    
 *******************************************************************************/
	
	$pageTitle 		= "NatTable - Support";

	$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>

<p>The support for NatTable at Eclipse.org is provided by the community on a 
volunteer basis.</p>


<div class="homeitem">
<h3>Questions</h3>
<p>The <i>NatTable Newsgroup</i> is for users of NatTable 
to ask questions, discuss ideas and so on. Join in and get involved!</p>
<ul>
	<li><a href="http://www.eclipse.org/forums">General information and signup</a></li>
	<li>Web access: <a href="http://www.eclipse.org/forums/eclipse.nattable">NatTable Forum</a></li>
	<li>nntp: <a href="news://news.eclipse.org/eclipse.nattable">eclipse.nattable</a></li>
</ul>
</div>

<div class="homeitem">
<h3>Bugs, Code Contributions</h3>
<p>NatTable uses Bugzilla to track bugs and enhancements. The issues of NatTable are 
categorized in Product <i>NatTable</i>.</p>
<ul>
	<li><a href="https://bugs.eclipse.org/bugs/query.cgi?product=NatTable">Bugzilla Search</a></li>
	<li>Eclipse FAQ: <a href="http://wiki.eclipse.org/FAQ_How_do_I_report_a_bug_in_Eclipse%3F">How to report a bug</a></li>
</ul>
</div>

</div>
EOHTML;
	# Generate the web page
	$App->AddExtraHtmlHeader("<style>
.homeitem p {margin-bottom : 5px;}
</style>");
	
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>