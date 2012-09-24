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
	
	$pageTitle 		= "NatTable - Download";

	$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>
<p>All downloads are provided under the terms and conditions of the <a href="/legal/epl/notice.php">Eclipse Foundation Software User Agreement</a> unless otherwise specified.</p>

<h3>NatTable 0.9.0</h3>
<p><a href="https://bugs.eclipse.org/bugs/buglist.cgi?product=NatTable&target_milestone=0.9.0&order=Last%20Changed">Changelog</a></p>
<p>
<b><a href="http://build.eclipse.org/technology/nebula/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.core-0.9.0.jar">org.eclipse.nebula.widgets.nattable.core</a></b>
  (<a href="http://build.eclipse.org/technology/nebula/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.core-0.9.0-sources.jar">sources</a>)<br />
</p>

<p>
Optional extensions:
<b><a href="http://build.eclipse.org/technology/nebula/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.glazedlists-0.9.0.jar">org.eclipse.nebula.widgets.nattable.extension.glazedlists</a></b>
  (<a href="http://build.eclipse.org/technology/nebula/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.glazedlists-0.9.0-sources.jar">sources</a>)<br />

<b><a href="http://build.eclipse.org/technology/nebula/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.poi-0.9.0.jar">org.eclipse.nebula.widgets.nattable.extension.poi</a></b>
  (<a href="http://build.eclipse.org/technology/nebula/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.poi-0.9.0-sources.jar">sources</a>)<br />
</p>

<!--
<h3>Helios - Eclipse 3.6 (unreleased)</h3>
<p><b>Update site:</b> http://download.eclipse.org/myproject/<br />
<b>ZIP file: </b><a href="/downloads/download.php?file=/myproject/file.zip">file.zip</a> (10 MiB)</p>
-->

</div>
EOHTML;
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>