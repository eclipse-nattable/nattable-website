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
	$pageTitle 		= "NatTable 1.2.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 1.2.0 release was mainly made possible by <a href="http://www.ubs.com/">UBS</a>. 
There were a lot of contributions in form of ideas, bug reports, discussions and even new features like 
traversal handling, scaling for high resolutions and several more you can find in the following sections. 
We would like to thank UBS for their commitment and support on developing the 1.2.0 release.</p>

<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.2.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.2.0">here</a>.</p>

<h3>Dependencies</h3>
<ul>
	<li>
		Removed dependency to <a href="http://commons.apache.org/proper/commons-lang/">Apache Commons Lang</a>. 
		It was used internally and caused issues for consumers of NatTable
		when setting up a target definition with newer versions of the Eclipse Platform.
	</li>
	<li>
		Replaced the dependency to <i>org.eclipse.core.runtime</i> bundle with <i>org.eclipse.equinox.common</i> to have a smaller set on dependent plugins.
		The dependency to the <i>org.eclipse.equinox.common</i> bundle is required by <a href="https://wiki.eclipse.org/JFace">JFace</a>, 
		which is used for several NatTable dialogs.
	</li>
</ul>

<h3>API changes</h3>
<ul>
	<li>
		Added <span class="code">ISortModel#getColumnComparator(int)</span> which is necessary to retrieve the <span class="code">Comparator</span>
		for column values in order to be able to sort a tree according to the configured sorting. 
	</li>
	<li>
		Added <span class="code">ICellEditor#activateOnTraversal()IConfigRegistry, List<String>)</span> to be able to configure if an editor
		should be activated on traversal or not. Necessary because a checkbox shouldn't change it's value when automatically activated after 
		committing a value in an adjacent editor. The <span class="code">CheckBoxCellEditor</span> always returns <i>false</i>. The abstract
		implementations will check the newly introduced <span class="code">EditConfigAttributes#ACTIVATE_EDITOR_ON_TRAVERSAL</span>
		configuration attribute or return <i>true</i> in case there is no such configuration attribute set.
	</li>
	<li>
		Renamed <span class="code">AggregrateConfigLabelAccumulator</span> to <span class="code">AggregateConfigLabelAccumulator</span>. 
	</li>
	<li>
		Renamed <span class="code">ITreeRowModel#isCollapseable()</span> to <span class="code">ITreeRowModel#isCollapsible()</span>. 
	</li>
	<li>
		Added <span class="code">ITreeRowModel#expandToLevel(int)</span>, <span class="code">ITreeRowModel#expandToLevel(int, int)</span> and
		<span class="code">ITreeRowModel#expandToLevel(T, int)</span> to be able to expand a tree to a certain level. 
	</li>
	<li>
		Deprecated <span class="code">ITreeData#formatDataForDepth(int, int)</span>, <span class="code">ITreeData#formatDataForDepth(int, T)</span>
		and <span class="code">ITreeRowModel#getObjectAtIndexAndDepth(int, int)</span> which were used by <span class="code">TreeExportFormatter</span>. 
		Since it now correctly uses the configured <span class="code">IDisplayConverter</span> to convert the values, 
		these methods are not called from the framework anymore.
	</li>
	<li>
		Deprecated all expand/collapse related methods in <span class="code">GlazedListTreeData</span> and moved them to 
		<span class="code">GlazedListTreeRowModel</span> where they should reside correctly.
	</li>
	<li>
		<span class="code">ISelectionModel</span> now extends <span class="code">ILayerEventHandler&lt;IStructuralChangeEvent&gt;</span> in 
		order to be able to handle structural changes correctly dependent on the internal selection storage.
	</li>
	<li>
		Deprecated <span class="code">ColumnGroupMenuItemProviders</span> and moved the methods to the general <span class="code">MenuItemProviders</span>.
	</li>
	<li>
		Changed <span class="code">MoveSelectionCommandHandler</span> <i>moveLastSelectedXxx</i> method parameters from <span class="code">int</span>
		to <span class="code">ITraversalStrategy.</span>
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>Scaling support for high resolution displays</b><br/>
		Introduced <span class="code">IDpiConverter</span> and <span class="code">AbstractDpiConverter</span> that are used in conjunction 
		with the newly introduced  <span class="code">ConfigureScalingCommand</span> to inform <span class="code">ILayer</span> and 
		<span class="code">SizeConfig</span> instances about the scaling calculations that need to be performed.
		Extended the <span class="code">GUIHelper</span> for several methods related to scaling calculations and added the support for upscaled images.
		To add different images for different DPI settings, simply put images whose names are prefixed with the DPI values to
		the same place as the base image.
		<p>
		The following shows how to provide a set of images that are used on scaling. The file <i>checkbox.png</i> will be used for
		96 DPI, the others specify their DPI setting in the filename. 
		<ul>
			<li>checkbox.png</li>
			<li>checkbox_120_120.png</li>
			<li>checkbox_128_128.png</li>
			<li>checkbox_144_144.png</li>
			<li>checkbox_192_192.png</li>
			<li>checkbox_288_288.png</li>		
		</ul>
		If no image is found for the current DPI value, the base
		image will be upscaled.
		</p>
	</li>
	<li>
		<b>Fixed summary row</b><br/>
		Introduced the <span class="code">FixedSummaryRowLayer</span> that renders a summary row at a fixed position if added to a 
		<span class="code">CompositeLayer</span>. It can be configured for usage within a simple horizontal composition aswell as
		for usage within a grid.<br/><br/>
		<p>
		The following code shows how to add a fixed summary row above the viewport of a simple NatTable without column and row header.
		<div class="codeBlock">// Plug in the FixedSummaryRowLayer
FixedSummaryRowLayer summaryRowLayer = new FixedSummaryRowLayer(
    dataLayer, viewportLayer, configRegistry, false);

// configure that the horizontal dimensional dependency
// is not a CompositeLayer that adds an additional column
summaryRowLayer.setHorizontalCompositeDependency(false);

CompositeLayer composite = new CompositeLayer(1, 2);
composite.setChildLayer("SUMMARY", summaryRowLayer, 0, 0);
composite.setChildLayer(GridRegion.BODY, viewportLayer, 0, 1);</div>
		</p>
		<p>
		The following code shows how to add a fixed summary row at the bottom of a grid.
		<div class="codeBlock">// create the FixedGridSummaryRowLayer
FixedSummaryRowLayer summaryRowLayer =
    new FixedSummaryRowLayer(
        gridLayer.getBodyDataLayer(), 
        gridLayer, 
        configRegistry, 
        false);
                
// set the summary label that should be shown in the row header                
summaryRowLayer.setSummaryRowLabel("\u2211");

// create a composition that has the grid on top and the summary 
// row at the bottom
CompositeLayer composite = new CompositeLayer(1, 2);
composite.setChildLayer("GRID", gridLayer, 0, 0);
composite.setChildLayer(SUMMARY_REGION, summaryRowLayer, 0, 1);</div>
		</p>
		<p>
		In case the FixedSummaryRowLayer should be shown in a grid on top of the body stack below the column header, the layer composition
		needs some additional modifications. The CompositeLayer needs to be top most layer in the body region (which is typically the
		ViewportLayer). The row header layer needs to be of type FixedSummaryRowHeaderLayer in order to render the row header cell
		for the additional summary row on top.<br/><br/> 
		You will find examples in the <i>NatTable Examples Application</i> in<br/><i>Tutorial Examples -&gt; Layers -&gt; SummaryRow</i><br/> that show
		in detail how to setup a layer composition with a fixed summary row.
		</p>
	</li>
	<li>
		<b>Traversal strategy</b><br/>
		Introduced <span class="code">ITraversalStrategy</span> to be able to configure editing traversal and selection movement details. In short this
		means that you are able to specify if the selection anchor should cycle if moved over a table border and if the selection/focus should jump
		over cells.
		<p>
		An <span class="code">ITraversalStrategy</span> specifies a <span class="code">TraversalScope</span>, if the traversal should cycle, the step
		count and whether the target is valid. There are four default implementations that are only different for <span class="code">TraversalScope</span>
		and cycle configuration. All are configured for step count = 1 and accepting every target cell as valid.
		<ul>
			<li>
			<span class="code">ITraversalStrategy#AXIS_TRAVERSAL_STRATEGY</span><br/>
			TraversalScope = AXIS<br/>
			cycle = false<br/>
			On traversal we only see the current row/column and will stop at a table border. This is the known default behavior in NatTable.
			</li>
			<li>
			<span class="code">ITraversalStrategy#AXIS_CYCLE_TRAVERSAL_STRATEGY</span><br/>
			TraversalScope#AXIS<br/>
			cycle = true<br/>
			On traversal we only see the current row/column. On moving over a table border, the selection will move to the opposite side.
			E.g. moving over the last column in row 2 will set the selection to the first column in the same row.
			</li>
			<li>
			<span class="code">ITraversalStrategy#TABLE_TRAVERSAL_STRATEGY</span><br/>
			TraversalScope#TABLE<br/>
			cycle = false<br/>
			On traversal we see the whole table. On moving over a table border, the selection will move to the opposite side by an additional row/column.
			E.g. moving to the right over the last column in row 2 will set the selection to the first column in the next row.<br/>
			Since cycle is set to <i>false</i>, the traversal will stop at table borders (last column/last row or first column/first row).
			</li>
			<li>
			<span class="code">ITraversalStrategy#TABLE_CYCLE_TRAVERSAL_STRATEGY</span><br/>
			TraversalScope#TABLE<br/>
			cycle = true<br/>
			On traversal we see the whole table. On moving over a table border, the selection will move to the opposite side by an additional row/column.
			E.g. moving to the right over the last column in row 2 will set the selection to the first column in the next row.<br/>
			Since cycle is set to <i>true</i>, the traversal will jump over the table borders, e.g. on moving over the last column/last row 
			cell in a table, the selection will jump to the first column/first row cell in the table.
			</li>
		</ul>
		</p>
		<p>
		To specify a custom <span class="code">ITraversalStrategy</span> a custom <span class="code">MoveSelectionCommandHandler</span> needs to be 
		registered. By default a <span class="code">MoveSelectionCommandHandler</span> with <span class="code">ITraversalStrategy#AXIS_TRAVERSAL_STRATEGY</span>
		is registered for the <span class="code">SelectionLayer</span>. To override that behavior you can either exchange the 
		<span class="code">DefaultSelectionLayerConfiguration</span> or register the command handler on a layer above the <span class="code">SelectionLayer</span>,
		e.g. the <span class="code">ViewportLayer</span>. This will exchange the traversal settings globally.
		<div class="codeBlock">// register a MoveCellSelectionCommandHandler with
// TABLE_CYCLE_TRAVERSAL_STRATEGY
viewportLayer.registerCommandHandler(
    new MoveCellSelectionCommandHandler(
        selectionLayer, 
        ITraversalStrategy.TABLE_CYCLE_TRAVERSAL_STRATEGY));</div>
		Note that it is even possible to register different <span class="code">ITraversalStrategy</span> for horizontal and vertical movements.
		</p>
		<p>
		The global <span class="code">ITraversalStrategy</span> settings in the <span class="code">MoveSelectionCommandHandler</span> can be 
		overridden for a single command by executing a <span class="code">MoveSelectionCommand</span> with customized settings.
		</p>
		<p>
		Via <span class="code">EditTraversalStrategy</span> you are able to wrap a <span class="code">ITraversalStrategy</span> and add the ability
		to check for editable state. Using the <span class="code">EditTraversalStrategy</span> in conjunction with edit configurations for opening
		the adjacent editor on commit or editing traversal, the focus will jump to the next editable cell.
		</p>
	</li>
	<li>
		<b>SelectionModel updates</b><br/>
		As already stated in the <b>API changes</b> section, <span class="code">ISelectionModel</span> now extends 
		<span class="code">ILayerEventHandler&lt;IStructuralChangeEvent&gt;</span>. Doing this we introduced a tight connection between
		the <span class="code">ISelectionModel</span> and the handling of structural changes to update the selection. These two were
		loosely coupled before, which lead to several issues when exchanging the <span class="code">ISelectionModel</span>.<br/><br/>
		<b>Note:</b> If you used the <span class="code">PreserveSelectionStructuralChangeEventHandler</span> workaround in previous
		versions for not clearing the selection on structural changes, you will notice that this workaround will not work anymore.
		If you still need that behavior, you are now able to achieve the same by configuring and setting a <span class="code">SelectionModel</span>
		instance like this:
		<p><div class="codeBlock">SelectionModel model = new SelectionModel(selectionLayer);
// configure to not clear the selection on structural changes
model.setClearSelectionOnChange(false);
selectionLayer.setSelectionModel(model);</div></p>
		If you expect that the selection should update and move with structural changes (e.g. sorting), try to use the 
		<span class="code">PreserveSelectionModel</span>. 
	</li>
	<li>
		<b>PopupMenuBuilder - DisposeListener</b><br/>
		The <span class="code">PopupMenuBuilder</span> now adds the necessary <span class="code">DisposeListener</span> to the NatTable
		on calling <span class="code">PopupMenuBuilder#build()</span>. It is not necessary anymore to register such a listener in a
		configuration yourself.
	</li>
	<li>
		<b>PopupMenuBuilder - MenuManager</b><br/>
		The <span class="code">PopupMenuBuilder</span> now internally uses a <span class="code">MenuManager</span> for creating and handling
		<span class="code">MenuItem</span>s. This way it is possible to combine Eclipse popup menus with NatTable configurations in conjunction
		with using core expressions for visibility. Additionally the <span class="code">PopupMenuAction</span> now sets the 
		<span class="code">NatEventData</span> to the <span class="code">Menu</span> data map for the key 
		<span class="code">MenuItemProviders#NAT_EVENT_DATA_KEY</span>. This change was necessary because the Eclipse 4 
		<span class="code">MenuManagerRenderer</span> is setting the <span class="code">MenuManager</span> reference to the 
		<span class="code">Menu</span> data map without a key.
	</li>
	<li>
		<b>PopupMenuBuilder - IMenuItemState</b><br/>
		With the internal usage of <span class="code">MenuManager</span> it is now also possible to configure visibility and enablement of NatTable
		menu items. To configure these states the <span class="code">IMenuItemState</span> was introduced. It can be registered for an ID that
		points to a menu item. All default NatTable menu items are now identifiable via ID, which are available as constants in 
		<span class="code">PopupMenuBuilder</span>.
		The following code creates a menu containing the debug menu item that is only visible for columns at column position > 1.
		<p><div class="codeBlock">Menu debugMenu = new PopupMenuBuilder(natTable)
    .withInspectLabelsMenuItem()
    .withEnabledState(
        PopupMenuBuilder.INSPECT_LABEL_MENU_ITEM_ID,
        new IMenuItemState() {

            @Override
            public boolean isActive(NatEventData natEventData) {
                return natEventData.getColumnPosition() > 1;
            }
    })
    .build();</div></p>
	</li>
	<li>
		<b>DisplayModeMouseEventMatcher</b><br/>
		Introduced the <span class="code">DisplayModeMouseEventMatcher</span> that allows to register a UI binding for a <span class="code">DisplayMode</span>.
		Using the <span class="code">DisplayModeMouseEventMatcher</span> for example allows to register different actions on performing a right click
		on a selected cell or a non selected cell.
	</li>
	<li>
		<b>Tree - identification of tree column (index/position)</b><br/>
		The <span class="code">TreeLayer</span> always specifies the first column to be the tree column. 
		It is now possible to specify whether the column index or the column position should be used to determine the tree column.
		The default is to use the column position, which means that reordering another column to become the first column in a grid, 
		will make that column the tree column. Changing the behavior to use the column index for tree column determination,
		column reordering will lead to also reordering the tree column.<br/>
		The following code will change the identification of the tree column from column position to column index:
		<p><div class="codeBlock">treeLayer.setUseTreeColumnIndex(true);</div></p>
	</li>
	<li>
		<b>Tree - expand to level</b><br/>
		It is now possible to expand nodes in a tree to a certain level. For this the <span class="code>TreeExpandToLevelCommand</span>
		was introduced along with the necessary API changes to the <span class="code">ITreeRowModel</span>. 
		<p><div class="codeBlock">// expand all nodes to level 2
natTable.doCommand(new TreeExpandToLevelCommand(2));

// expand node at index 5 to level 2
natTable.doCommand(new TreeExpandToLevelCommand(5, 2));</div></p>
	</li>
	<li>
		<b>Tree - expand/collapse by key</b><br/>
		It is now possible to expand and collapse tree nodes via key interaction. For this the <span class="code">TreeExpandCollapseKeyAction</span>
		was introduced. On registering the default <span class="code">TreeLayerExpandCollapseKeyBindings</span> this action will be bound to the
		space key. Note that the binding requires the <span class="code">SelectionLayer</code> and the <span class="code">TreeLayer</span> to
		work correctly.
		<p><div class="codeBlock">// adds the key bindings that allows pressing space bar to
// expand/collapse tree nodes
natTable.addConfiguration(
        new TreeLayerExpandCollapseKeyBindings(
                bodyLayerStack.getTreeLayer(),
                bodyLayerStack.getSelectionLayer()));</div></p>
	</li>
	<li>
		<b>GroupBy feature enhancements/corrections</b><br/>
		There were numerous bug reports regarding the groupBy feature. They were mostly related to the usage of the wrong 
		<span class="code">IDisplayConverter</span> or the wrong <span class="code">Comparator</span>. To solve the issues regarding
		the <span class="code">IDisplayConverter</span> issues, the <span class="code">GroupByDisplayConverter</span> was introduced.
		It is registered by default via <span class="code">GroupByDataLayerConfiguration</span>. If you are not using the default
		configuration, you need to ensure to register it in your custom configuration in order to solve the converter issues.  
		<p>
		To solve the issues related to sorting, it is necessary to enrich the <span class="code">GroupByDataLayer</span> with additional information.
		The <span class="code">ISortModel</span> is needed to retrieve the correct <span class="code">Comparator</span>, the <span class="code">TreeLayer</span>
		is needed to be able to determine the tree column in order to be able to sort the tree nodes, and the <span class="code">GroupByDataLayer</span>
		reference is needed to be able to sort by summary values.
		The necessary references can be set using the newly introduced initialize method.
		<p><div class="codeBlock">// connect ISortModel, TreeLayer and GroupByDataLayer to the 
// Comparator to support sorting by groupBy summary values
bodyLayerStack.getBodyDataLayer().initializeTreeComparator(
        sortHeaderLayer.getSortModel(),
        bodyLayerStack.getTreeLayer(),
        true);</div></p>
		This is also the reason for the API change in <span class="code">ISortModel</span>.  
		</p>
	</li>
	<li>
		<b>Excel Export - Exporter configuration</b><br/>
		It is now possible to configure the charset and the sheet name to use when exporting a NatTable using the core <span class="code">ExcelExporter</span>.
		The following code will for example register an <span class="code">ExcelExporter</span> that exports a NatTable in UTF-8, setting the sheet name
		of the Excel sheet to <i>My data</i>.
		<p><div class="codeBlock">ExcelExporter exporter = new ExcelExporter();
exporter.setCharset("UTF-8");
exporter.setSheetname("My data");
configRegistry.registerConfigAttribute(
        ExportConfigAttributes.EXPORTER,
        exporter);</div></p>
		The <span class="code">PoiExcelExporter</span> in the Apache POI extension now also allows to set the sheet name.
	</li>
	<li>
		The <span class="code">CalculatedValueCache</span>, that is internally used for the calculation and caching of summary values,
		is now using the <span class="code">ConcurrentHashMap</span> to avoid concurrency issues related to the usage of <span class="code">HashMap</span>.
		See <a href="http://mailinator.blogspot.ch/2009/06/beautiful-race-condition.html">here</a> for a more detailed description on that issue.
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