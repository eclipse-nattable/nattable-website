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
	
	$pageTitle 		= "NatTable - Feature Overview";

	$html  = <<<EOHTML
<div id="midcolumn">
<h2>$pageTitle</h2>

<p>This is a overview of features of the NatTable widget.  We also recommend 
to try out the <!--a href="" title="NatTable Examples"-->examples.
For detail and technical insight please look at the 
<a href="documentation.php" title="NatTable Documentation">documentation</a>.</p>
<p>Please note that most feature are optional, they can be enabled or disabled
when constructing the table widget.</p>


<div class="homeitem">
<h4>Table, tree and special layouts</h4>
<p>In addition to the classic table layout, NatTable also supports:</p>
<ul>
	<li>Trees supporting expand/collapse of rows</li>
	<li>Cells spanning multiple rows and columns</li>
	<li>Dynamically changing table layouts</li>
</div>

<div class="homeitem">
<h4>Low requirements</h4>
<ul>
	<li>Simple interface to hook in the data model</li>
	<li>Cell values are only loaded if required e.g. for painting</li>
</ul>
<p>This allows NatTable to handle huge datasets from nearly any source
without any performance issues.</p>
</div>

<div class="homeitem">
<h4>UI Binding</h4>
<div class="rightfloat">
<a href="images/featuresScreenshot_PercentageBar.png"><img src="images/featuresScreenshot_PercentageBar_th.png" alt="Screenshot percentage bars" title="Screenshot: NatTable with Percentage Bars"></a>
Completely customizable rendering: Percentage Bars
</div>
<ul>
	<li>Customizable converters between actual data value and rendered value</li>
	<li>Configurable cell painters allow complete control over cell rendering</li>
	<li>Bind feature to arbitrary key / mouse triggers</li>
</ul>
</div>

<div class="homeitem">
<h4>Flexible Selection</h4>
<p>NatTable uses a flexible selection model which tracks the selection
by rows, columns and indiviual cells.</p>
<ul>
	<li>Predefined keyboard and mouse actions</li>
	<li>Optional JFace selection provider</li>
</ul>
</div>

<div class="homeitem">
<h4>Editing</h4>
<ul>
	<li>Cell editors for common data types (text, combo and check box)</li>
	<li>Configurable validation rules</li>
	<li>Visual indication of invalid values</li>
	<li>Multi-cell editing allows changing multiple cell values at once</li>
</ul>
</div>

<div class="homeitem">
<h4>Grouping and Freezing of Rows and Columns</h4>
<ul>
	<li>Row groups and column groups</li>
	<li>Multiple grouping levels</li>
	<li>Collapse/Expand of groups</li>
	<li>Freezing of column and rows avoids scrolling of selected cells</li>
</ul>
</div>

<div class="homeitem">
<h4>Sorting, Filtering and Searching</h4>
<ul>
	<li>Sorting by column (up/down/of) with indicator in headers</li>
	<li>Sorting by multiple columns</li>
	<li>Custom comparators per column possible</li>
	<li>Filtering by values in columns</li>
	<li>Searching values in table (dialog)</li>
</ul>
</div>

<div class="homeitem">
<h4>Cell highlighting</h4>
<ul>
	<li>Blinking cell</li>
	<li>E.g. for changed cell or your own criteria</li>
</ul>
</div>

<div class="homeitem">
<h4>Column/Row customization</h4>
<p>NatTable provides a lot of predefined actions which allows the user
to customize the table:</p>
<div class="rightfloat">
<a href="images/featuresScreenshot_ColumnChooser.png"><img src="images/featuresScreenshot_ColumnChooser_th.png" alt="Screenshot column chooser" title="Screenshot: Column Chooser of NatTable"></a>
Column chooser: quickly change order and visibility
</div>
<ul>
	<li>Resize and auto-size of rows and columns (by mouse)</li>
	<li>Multi row/column resize, so all selected rows/columns are resized to the same size</li>
	<li>Reorder and hide/show of columns (by mouse and dialog)</li>
	<li>Group/ungroup of columns</li>
	<li>Rename of columns</li>
	<li>Configure cell format of columns</li>
</ul>
</div>

<div class="homeitem">
<h4>Persistence</h4>
<p>A NatTable can save and restore its configuration e.g. column groups,
group states, cell formats.</p>
</div>

<div class="homeitem">
<h4>Standard Actions</h4>
<p>Standard action implementations to:</p>
<ul>
	<li>Copy data to clipboard (Ctrl + C)</li>
	<li>Export as Excel file (formatting preserved, Ctrl + E)</li>
	<li>Print (formatting preserved, Ctrl + P)</li>
</ul>
</div>

</div>
EOHTML;
	# Generate the web page
	$App->AddExtraHtmlHeader("<style>
.homeitem p {margin-bottom : 5px;}
.rightfloat { width: 240px; margin-right: -260px; float: right; }
</style>");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>