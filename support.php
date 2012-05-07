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
<br/>

<div class="homeitem">
<h3>Questions</h3>
<p>If you have questions about NatTable:</p>
<ul>
	<li><a href="http://www.eclipse.org/forums/eclipse.technology.nebula">Nebula Forum/Newsgroup</a><br/>
(nntp: <a href="news://news.eclipse.org/eclipse.technology.nebula">eclipse.technology.nebula</a>)</li>
</ul>
</div>

<div class="homeitem">
<h3>Bugs, Code Contributions</h3>
<p>If you want to report bugs or feature requests:</p>
<ul>
	<li><a href="https://bugs.eclipse.org/bugs/query.cgi?product=NatTable">Bugzilla</a> (Product: NatTable)</li>
</ul>
</div>

</div>
EOHTML;
	# Generate the web page
	$App->AddExtraHtmlHeader("<style>
p {margin-bottom : 5px;}
</style>");
	
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>