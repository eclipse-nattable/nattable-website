<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2015 Dirk Fauth and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Dirk Fauth <dirk.fauth@googlemail.com> - initial API and implementation
 *******************************************************************************/ 

	$pageKeywords	= "eclipse, project, nattable, grid";
	$pageAuthor		= "Dirk Fauth";
	$pageTitle 		= "NatTable 1.3.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 1.3.0 release is intended to be a bugfix release. It contains mainly bugfixes and just small enhancements
requested by the community in order to make the NatTable API more extensible.</p>

<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.3.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.3.0">here</a>.</p>

<h3>API changes</h3>
<ul>
	<li>
		Introduced the <span class="code">ICalculatedValueCache</span> interface and added corresponding getter and setter on
		<span class="code">SummaryRowLayer</span> and <span class="code">GroupByDataLayer</span> in order to be able
		to exchange the implementation for caching calculated values. 
	</li>
	<li>
		Added <span class="code">AbstractTextPainter#setTrimText(boolean)</span> to be able to configure if the text that is rendered
		by an <span class="code">AbstractTextPainter</span> is trimmed or not.
	</li>
	<li>
		Reworked column reordering in combination with column grouping. This caused the introduction of several new command handler and
		the modification of several existing command handler related to column reordering. 
		The update of column groups on column reordering is now performed in <span class="code">ColumnGroupReorderLayer#updateColumnGroupModel()</span>. 
	</li>
	<li>
		Changed visibility of <span class="code">ColumnResizeDragMode#getColumnWidthMinimum()</span> to protected in order to support
		specifying a custom min width for columns on drag resizing. 
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		Replaced every occurence of <span class="code">SWT.CTRL</span> in the NatTable default bindings with <span class="code">SWT.MOD1</span> 
		to make the bindings work correctly on Mac OS.
	</li>
	<li>
		Introduced the usage of an API Baseline and using the API tooling in order to ensure to have correct versions regarding the 
		OSGi semantic versioning.
	</li>
</ul>
</div>

<div id="rightcolumn">

</div>
EOHTML;
	# Generate the web page
	$App->AddExtraHtmlHeader("<style>
.homeitem p {margin-bottom : 5px;}
</style>");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>