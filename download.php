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


<h3>NatTable 1.0.1 (<a href="https://bugs.eclipse.org/bugs/buglist.cgi?product=NatTable&target_milestone=1.0.1&order=Last%20Changed">changelog</a>)</h3>

<p><b>Please read the <a href="http://eclipse.org/nattable/nandn/nandn_100.php">New and Noteworthy</a> for the 1.0.0 release.</b></p>

<p>Release artifacts can be obtained from the following p2 repository: <a href="http://download.eclipse.org/nattable/releases/1.0.1/repository/">http://download.eclipse.org/nattable/releases/1.0.1/repository/</a></p>
<p>A zipped p2 repository is also available here: <a href="/downloads/download.php?file=/nattable/releases/1.0.1/repository.zip">repository.zip</a></p>

<p>Note that if you want to use the NatTable extensions for GlazedLists and/or Apache POI, the necessary OSGi bundles for those third-party dependencies need to be available for the installation process.
These bundles are available in the latest recommended release build of <a href="http://www.eclipse.org/orbit/">Eclipse Orbit</a>.
You can either install those bundles manually prior installing the NatTable extensions or simply add the Eclipse Orbit Update Site to the list of Available Software Sites so the installation process is able to resolve the dependencies itself.
The following update site is at the time writing this document the latest recommended Eclipse Orbit build repository:<br>
<a href="http://download.eclipse.org/tools/orbit/downloads/drops/R20130517111416/repository/">http://download.eclipse.org/tools/orbit/downloads/drops/R20130517111416/repository/</a></p>

<p>The examples jar can be downloaded here: <a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/1.0.1/NatTableExamples-1.0.1.jar">NatTableExamples-1.0.1.jar</a><br/>
Please read the Examples section of the <a href="http://eclipse.org/nattable/documentation.php?page=getting_started">Getting Started</a> page for info on how to run the examples jar.</p>


<h3>Development Snapshot Builds</h3>
<p>Development snapshot builds are available here:<br> <a href="http://download.eclipse.org/nattable/snapshots/">http://download.eclipse.org/nattable/snapshots/</a></p>


<h3>Old Releases</h3>

<h4>NatTable 1.0.0 (<a href="https://bugs.eclipse.org/bugs/buglist.cgi?product=NatTable&target_milestone=1.0.0&order=Last%20Changed">changelog</a>)</h4>
<ul>
<li>p2 repo: <a href="http://download.eclipse.org/nattable/releases/1.0.0/repository/">http://download.eclipse.org/nattable/releases/1.0.1/repository/</a> (<a href="/downloads/download.php?file=/nattable/releases/1.0.0/repository.zip">repository.zip</a>)</li>
<li>Examples: <a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/1.0.0/NatTableExamples-1.0.0.jar">NatTableExamples-1.0.1.jar</a></li>
</ul>

<h4>NatTable (Incubation) 0.9.0 (<a href="https://bugs.eclipse.org/bugs/buglist.cgi?product=NatTable&target_milestone=0.9.0&order=Last%20Changed">changelog</a>)</h4>
NatTable Core:
<ul>
<li><a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.core-0.9.0.jar">org.eclipse.nebula.widgets.nattable.core</a>
   (<a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.core-0.9.0-sources.jar">sources</a>)</li>
</ul>

Optional extensions:
<ul>
<li><a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.glazedlists-0.9.0.jar">org.eclipse.nebula.widgets.nattable.extension.glazedlists</a>
   (<a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.glazedlists-0.9.0-sources.jar">sources</a>)</li>

<li><a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.poi-0.9.0.jar">org.eclipse.nebula.widgets.nattable.extension.poi</a>
   (<a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/org.eclipse.nebula.widgets.nattable.extension.poi-0.9.0-sources.jar">sources</a>)<br/>
   <b>NOTE:</b> The poi extension has been re-released to address a major issue that resulted in an exception if the table was exported more than once (<a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=390522">bug 390522</a>).
   <b>If you downloaded the poi extension prior to 2012/11/12 please download it again and use the updated version.</b> You can verify you have the correct version by inspecting the META-INF/MANIFEST.MF inside the jar.
   The updated version has Bundle-Version: 0.9.0.201210040001. None of the other 0.9.0 release artifacts were affected.
</li>
</ul>

Examples:
<ul>
<li><a href="http://www.eclipse.org/downloads/download.php?file=/nattable/releases/0.9.0/NatTableExamples-0.9.0.jar">NatTableExamples-0.9.0.jar</a></li>
</ul>

<div class="homeitem">
<h5>Release Notes</h5>
<p>
This is our first release as part of Eclipse Nebula. As such our package namespace is now org.eclipse.nebula.widgets.nattable.
Our release numbering has also been reset to 0.9.0 in compliance with Eclipse conventions for incubation projects. This release is the successor to the last NatTable release on SourceForge, version 2.3.2.
</p>
<p>
This release contains ~40 bugfixes and new features. There is also one notable API change:
</p>
<ul>
<li>API calls that used to contain references to the concrete class LayerCell have been changed to reference the ILayerCell interface instead. If you have implemented any of these APIs (e.g. callbacks), please substitute ILayerCell for LayerCell when migrating to this release.</li>
<ul>
</div>

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
