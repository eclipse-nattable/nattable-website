<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2023 Dirk Fauth and others.
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
	$pageTitle 		= "NatTable 2.2.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 2.2.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. 
The 2.2.0 release mainly contains some extensions and fixes in the area of filtering.  
We would like to thank everyone involved for their commitment and support on developing the 2.2.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>
Despite the enhancements and new features there are several bugfixes related to issues on filtering.
</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.2.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=2.2.0">here</a>.</p>

<h3>Maven Central</h3>
<p>
Because of a mistake in the publishing process, the 2.2.0 artefacts in Maven Central are incorrect. To consume the correct NatTable 2.2.0 artefacts, you
need to consume version 2.2.0.1, e.g. <a href="https://repo1.maven.org/maven2/org/eclipse/nebula/widgets/nattable/org.eclipse.nebula.widgets.nattable.core/2.2.0.1/">NatTable Core 2.2.0.1</a>". 
</p>

<h3>API changes</h3>
<ul>
	<li>
		Several modifications were made to increase the extensibility of NatTable.
		Some additional methods are added and the visibility of some existing methods is increased. 
		Existing code should work unchanged.<br>
		Below is the list of those methods, the details can be found in the <i>Enhancements and new features</i> section.
		<ul>
			<li><span class="code">ComboBoxCellEditor#getComboBoxDataProvider()</span></li>
			<li><span class="code">ComboBoxFilterUtils#isFilterActive(FilterRowDataLayer<T>, IComboBoxDataProvider, IConfigRegistry)</span></li>
			<li><span class="code">FilterNatCombo#createAddToFilterItemViewer()</span></li>
			<li><span class="code">FilterNatCombo#updateAddToFilterVisibility(TableItem)</span></li>
			<li><span class="code">FilterNatCombo#resetAddToFilter(TableItem)</span></li>
			<li><span class="code">FilterNatCombo#isFilterActive()</span></li>
			<li><span class="code">FilterNatCombo#getSelectAllLabel()</span></li>
			<li><span class="code">FilterNatCombo#getAddToFilterLabel()</span></li>
			<li><span class="code">FilterRowComboBoxCellEditor#isApplyFilterOnDropdownFilter()</span></li>
			<li><span class="code">FilterRowComboBoxCellEditor#isCloseOnEnterInDropdownFilter()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#isFilterApplied()</span></li>
			<li><span class="code">ComboBoxFilterRowHeaderComposite#setAllValuesSelected(boolean)</span></li>
		</ul>
		Below is the list of new constructors
		<ul>
			<li><span class="code">FilterRowMouseEventMatcher(int)</span></li>
		</ul>
	</li>
	<li>
		Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name.
		Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields
		to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields
		and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for
		bugfixing.
		<ul>
			<li><span class="code">FilterNatCombo#addToFilterItemViewer</span></li>
			<li><span class="code">FilterNatCombo#initialSelection</span></li>
		</ul>
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>Filter content on filtering the combobox content</b><br/>
		<p>
			The <span class="code">NatCombo</span> is extended to support registering a <span class="code">ModifyListener</span>
			and a <span class="code">KeyListener</span> on the dropdown filter textfield, which can be used to filter the
			dropdown content. This way it is possible to directly trigger a filter operation on the NatTable when the filter
			dropdown content is filtered.
		</p>
		<p>
			This feature was already introduced with 2.1.0. But with the implementation there it was not possible to extend an
			existing filter by applying a different filter in the opened dropdown, as the filter was always replaced.
			With 2.2.0 the filter dropdown will show an additional entry <i>Add current selection to filter</i> which allows to
			update the NatTable filter instead of simply replacing it. 
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableAllFilterPerformanceColumnGroupExample</b></i>
		</p>
	</li>
	<li>
		<b>Context menu on filter row cells</b><br/>
		<p>
			The <span class="code">FilterRowMouseEventMatcher</span> was extended to support the check for the clicked mouse button.
			This way it is now possible to open the column header context menu on right click in the filterrow, instead of activating
			the filter editor.
		</p>
	</li>
	<li>
		<b>FilterNatCombo / FilterRowComboBoxCellEditor</b><br/>
		<p>
			The visibility of several methods and properties got increased to support better subclassing of those two classes.
		</p>
	</li>
	<li>
		<b>ComboBoxFilterUtils - check for applied filter</b><br/>
		<p>
			There is now a helper method that can be used to check if a filter is applied based on the current filter state.
			Additionally it is of course also possible to check if a filter is applied by comparing the size of the FilterList with the size of the underlying base list.
		</p>
	</li>
</ul>

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