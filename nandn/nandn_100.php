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
	
	$pageKeywords	= "eclipse, project, nattable, grid";
	$pageAuthor		= "Dirk Fauth";
	$pageTitle 		= "NatTable 1.0.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>There are several changes in the infrastructure, the API and the feature set of Nebula NatTable with the 1.0.0 release. Here are the most important ones.</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed with the 1.0.0 release have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?list_id=5573174&resolution=FIXED&classification=Technology&query_format=advanced&component=Core&target_milestone=1.0.0&product=NatTable">here</a></p>

<h3>Infrastructure</h3> 
There are several infrastructural changes in Nebula NatTable. 
<ul>
	<li>Update of third-party dependency to <a href="http://www.glazedlists.com/">GlazedLists</a> 1.9</li>
	<li>Update of third-party dependency to <a href="http://poi.apache.org/">Apache POI</a> 3.9</li>
	<li>Modification of the target-platform to replace local library dependencies with Software Site dependencies. 
		This is possible because GlazedLists and Apache POI are now integrated in <a href="http://www.eclipse.org/orbit/">Eclipse Orbit</a> as OSGi bundles</li>
	<li>Providing a fully functional p2 update site for NatTable core, its extensions and the corresponding source bundles. 
		See the <a href="http://eclipse.org/nattable/download.php">download section</a> for details</li>
	<li>Providing p2 update sites for <a href="http://download.eclipse.org/nattable/snapshots/">SNAPSHOT builds</a> that are created after changes in the repository occured</li>
	<li>Publishing the API Javadoc. Still not complete</li>
</ul>

<h3>Enhancements and new features</h3>
There are several enhancements and new features that were added to Nebula NatTable.
<ul>
	<li>Smooth/continuous scrolling of the viewport<br>
		Before 1.0.0 on scrolling the viewport jumped cell-wise, now scrolling is performed pixel-wise which increases the user experience on scrolling. It also enables the user to scroll 
		large cells that does not fit into the viewport which was not possible before.
		You do not have to change any of your code to enable this enhancement.</li>
	<li>Introduced the <span class="code">AbstractHeaderMenuConfiguration</span> to make it easier to create new header menus. This one also adds a corner header menu to solve the issue to 
		restore from a state where all columns where hidden.</li>
	<li>Dialog for managing NatTable states<br>
		NatTable supports saving and loading of states via <span class="code">saveState()</span> and <span class="code">loadState()</span> which are working on <span class="code">java.util.Properties</span> 
		objects. With NatTable 1.0.0 the state handling was corrected for some layers and added to layers that did not support state handling before. For convenience also a dialog is added that can be used 
		to manage different state sets. To make use of it you need to register the necessary command handler like this:
		<div class="codeBlock">DisplayPersistenceDialogCommandHandler handler = 
			new DisplayPersistenceDialogCommandHandler();
gridLayer.registerCommandHandler(handler);</div>
		To open the dialog you could add the corresponding menu item to the column header menu like this:
		<div class="codeBlock">natTable.addConfiguration(
	new HeaderMenuConfiguration(natTable) {
               @Override
               protected PopupMenuBuilder createColumnHeaderMenu(NatTable natTable) {
                       return super.createColumnHeaderMenu(natTable)
						.withStateManagerMenuItemProvider();
               }
	});</div><br>
	<img align="middle" src="../images/viewManagementDialog.png" border="0" alt="View Configuration Management Dialog"/>
	</li>
	<li>Major refactoring of the editing behaviour<br>
		We cleaned up the API to prepare for the next generation and made things clearer and stabilized the process for additional features, e.g. creating editors that open in subdialogs, even making 
		use of SWT and JFace dialogs. Additionally with several bugfixes these are quite some tickets that have been fixed. In this forum topic you can find a list of what has been done at this point: 
		<a href="http://www.eclipse.org/forums/index.php/t/452211/">http://www.eclipse.org/forums/index.php/t/452211/</a><br>
		You should only notice these changes in your code if you implemented custom editors. If you created custom editors than check the <span class="code">ICellEditor</span> interface, the <span class="code">AbstractCellEditor</span> and the <span class="code">AbstractDialogCellEditor</span> for details.</li>
	<li>Added new <span class="code">EditConfigAttributes</span>
		<table>
			<tr>
				<th><span class="code">EditConfigAttributes</span></th>
				<th>Datatype</th>
				<th>Description</th>
			</tr>
			<tr>
				<td><span class="code">OPEN_IN_DIALOG</span></td>
				<td>Boolean</td>
				<td>Configure if a cell should be edited inline or in a dialog. Default is false for editing inline.</td>
			</tr>
			<tr>
				<td><span class="code">OPEN_ADJACENT_EDITOR</span></td>
				<td valign="top">Boolean</td>
				<td>Configure if the adjacent editor should be opened after committing the value in the current active editor. Will only be interpreted for inline editing. Default is false for not opening the adjacent editor.</td>
			</tr>
			<tr>
				<td><span class="code">SUPPORT_MULTI_EDIT</span></td>
				<td>Boolean</td>
				<td>Configure if the editor supports multi-edit by pressing F2 when multiple cells are selected that have the same editor configured. Default is true, which  will open a subdialog for multi-editing if the prerequisites match.</td>
			</tr>
			<tr>
				<td><span class="code">EDIT_DIALOG_SETTINGS</span></td>
				<td nowrap>Map&lt;String, Object&gt;</td>
				<td>Configure the appearance of the subdialog that is used for editing. This includes shell title, icon, location, size, resizable state and a custom message. The keys that are supported by this map are specified in <span class="code">ICellEditDialog</span></td>
			</tr>
		</table>
	</li>
	<li>Enhanced the <span class="code">NatCombo</span> to support free editing and multiple selection with and without checkboxes in the dropdown part. These configuration can be applied via style bits <span class="code">SWT.READ_ONLY</span> for not enabling free editing, <span class="code">SWT.MULTI</span> for multi selection behaviour and <span class="code">SWT.CHECK</span> for rendering checkboxes. <span class="code">ComboBoxCellEditor</span>s need to be configured via boolean properties <span class="code">freeEdit</span>, <span class="code">multiselect</span> and <span class="code">useCheckbox</span>.</li>
	<li>Corrected and enhanced the tick update handling that is added to NatTable instances with the <span class="code">DefaultTickUpdateConfiguration</span> that is part of the <span class="code">DefaultSelectionLayerConfiguration</span>. This one allows to increase/decrease number values by using the + and - keys of your keypad.</li>
	<li>Excel like filter row<br>
		With this you are able to add a filter row to your NatTable that looks like in Excel, providing the same functionality. It collects all available values in the columns and will filter those values that are not checked in the dropdown.<br>
		<img align="middle" src="../images/excelFilter.png" border="0" alt="Excel like filter row"/><br><br>
		To add it to your NatTable use the following code that assumes your body layer stack contains a <span class="code">GlazedListsEventLayer</span> and a <span class="code">FilterList</span> that wraps the main list:</li>
		<div class="codeBlock">ComboBoxFilterRowHeaderComposite<PersonWithAddress> filterRowHeaderLayer =                
	new ComboBoxFilterRowHeaderComposite<PersonWithAddress>(                        
		bodyLayerStack.getFilterList(), 
		bodyLayerStack.getGlazedListsEventLayer(), 
		bodyLayerStack.getSortedList(),                        
		columnPropertyAccessor, columnHeaderLayer, 
		columnHeaderDataProvider, configRegistry);</div>
	<li>Added several layers to add support for row reordering and row hide/show according to the column functionality
		<ul>
			<li><span class="code">RowReorderLayer</span></li>
			<li><span class="code">RowHideShowLayer</span></li>
			<li><span class="code">GlazedListsRowHideShowLayer</span> to support hiding of rows in a GlazedLists manner</li>
			<li><span class="code">DetailGlazedListsEventLayer</span> to transport detail information on GlazedLists changes</li>
		</ul>
	</li>
	<li>Extended the API of the <span class="code">TextPainter</span> and <span class="code">VerticalTextPainter</span> to specify whether the height and/or width should be calculated by content. This is done by using new constructors that allow that explicit configuration.</li>
	<li>Corrected key modifier in default key bindings from <span class="code">SWT.CONTROL</span> to <span class="code">SWT.MOD1</span> to correct the key bindings on Mac</li>
	<li>Several API modifications to increase the flexibility on configuring and extending NatTable classes, e.g. setting the images for expand/collapse in trees. Such modifications are always documented via Javadoc, so have a look at the Javadoc or the detailed list of fixed tickets to find out more.</li>
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