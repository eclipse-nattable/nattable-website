<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2019 Dirk Fauth and others.
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
	$pageTitle 		= "NatTable 1.6.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 1.6.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. 
We would like to thank everyone involved for their commitment and support on developing the 1.6.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>
Despite the enhancements and new features there are numerous bugfixes related to issues on concurrency, scaling, percentage sizing or performance for NatTables with huge column sets.
</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.6.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.6.0">here</a>.</p>

<h3>API changes</h3>
<ul>
	<li>
		Several modifications were made to increase the extensibility of NatTable.
		Some additional methods are added and the visibility of some existing methods is increased. 
		Existing code should work unchanged.<br>
		Below is the list of those methods, the details can be found in the <i>Enhancements and new features</i> section.
		<ul>
			<li><span class="code">ReflectiveColumnPropertyAccessor#getPropertyDescriptor()</span></li>
			<li><span class="code">AbstractPositionCommand#getLayer()</span></li>
			<li><span class="code">AbstractRowCommand#getLayer()</span></li>
			<li><span class="code">AlternatingRowConfigLabelAccumulator#layer</span></li>
			<li><span class="code">ComboBoxCellEditor#isFocusOnText()</span></li>
			<li><span class="code">ComboBoxCellEditor#setFocusOnText()</span></li>
			<li><span class="code">CopyDataCommandHandler#internalDoCommand()</span></li>
			<li><span class="code">CopyDataCommandHandler#getSelectedColumnPositions()</span></li>
			<li><span class="code">CopyDataCommandHandler#getColumnHeaderLayer()</span></li>
			<li><span class="code">CopyDataCommandHandler#getRowHeaderLayer()</span></li>
			<li><span class="code">CopyDataCommandHandler#getCopyLayer()</span></li>
			<li><span class="code">CopyDataCommandHandler#isCopyAllowed()</span></li>
			<li><span class="code">CopyDataCommandHandler#isEmpty()</span></li>
			<li><span class="code">CopySelectionLayerPainter#getCopyBorderStyle()</span></li>
			<li><span class="code">ExportCommand#isExecuteSynchronously()</span></li>
			<li><span class="code">FillHandleDragMode#startPosition</span></li>
			<li><span class="code">FillHandleLayerPainter#getCopyBorderStyle()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#isUpdateEventsEnabled()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#enableUpdateEvents()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#disableUpdateEvents()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#getValueCacheLock()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#removeCacheUpdateListener()</span></li>
			<li><span class="code">FormulaParser#processPower()</span></li>
			<li><span class="code">InternalPasteDataCommandHandler#isPasteAllowed()</span></li>
			<li><span class="code">InternalPasteDataCommandHandler#getPasteLayer()</span></li>
			<li><span class="code">TextCellEditor#isCommitOnEnter()</span></li>
			<li><span class="code">TextCellEditor#setCommitOnEnter()</span></li>
			<li><span class="code">TextCellEditor#isCommitWithCtrlKey()</span></li>
			<li><span class="code">TextCellEditor#setCommitWithCtrlKey()</span></li>
			<li><span class="code">GroupByDataLayer#getSortModel()</span></li>
			<li><span class="code">GlazedListTreeRowModel#getTreeData()</span></li>
			<li><span class="code">GlazedListsSortModel#refresh()</span></li>
			<li><span class="code">CompositeFreezeLayer#getColumnBounds()</span></li>
			<li><span class="code">CompositeFreezeLayer#getRowBounds()</span></li>
			<li><span class="code">FreezePositionCommand#isInclude()</span></li>
			<li><span class="code">FreezeSelectionCommand#isInclude()</span></li>
			<li><span class="code">FreezeSelectionStrategy#getUnderlyingColumnPosition()</span></li>
			<li><span class="code">FreezeSelectionStrategy#getUnderlyingRowPosition()</span></li>
			<li><span class="code">ColumnGroupExpandCollapseCommand#getRowPositionLayer()</span></li>
			<li><span class="code">ColumnGroupExpandCollapseCommand#getLocalRowPosition()</span></li>
			<li><span class="code">RowGroupExpandCollapseCommand#getColumnPositionLayer()</span></li>
			<li><span class="code">RowGroupExpandCollapseCommand#getColumnPosition()</span></li>
			<li><span class="code">RowGroupExpandCollapseCommand#getLocalColumnPosition()</span></li>
			<li><span class="code">ColumnGroupGroupHeaderLayer#getColumnSpan()</span></li>
			<li><span class="code">ColumnGroupGroupHeaderLayer#getStartPositionOfGroup()</span></li>
			<li><span class="code">ColumnGroupHeaderLayer#getColumnSpan()</span></li>
			<li><span class="code">ColumnGroupHeaderLayer#getStartPositionOfGroup()</span></li>
			<li><span class="code">ColumnGroupModel#isDefaultCollapseable()</span></li>
			<li><span class="code">ColumnGroupModel#setDefaultCollapseable()</span></li>
			<li><span class="code">ColumnHideShowLayer#hideColumnPositions()</span></li>
			<li><span class="code">ColumnHideShowLayer#showColumnIndexes()</span></li>
			<li><span class="code">ColumnVisualChangeEvent#getColumnIndexes()</span></li>
			<li><span class="code">RowVisualChangeEvent#getRowIndexes()</span></li>
			<li><span class="code">CompositeLayer#getChildLayerLayout()</span></li>
			<li><span class="code">CompositeLayer#CompositeLayerPainter</span></li>
			<li><span class="code">TextPainter#isCalculateWrappedHeight()</span></li>
			<li><span class="code">TextPainter#setCalculateWrappedHeight()</span></li>
			<li><span class="code">LayerPrinter#addPrintListener()</span></li>
			<li><span class="code">LayerPrinter#removePrintListener()</span></li>
			<li><span class="code">ColumnReorderDragMode#getColumnCell()</span></li>
			<li><span class="code">ColumnReorderDragMode#ColumnReorderOverlayPainter</span></li>
			<li><span class="code">RowReorderDragMode#getRowCell()</span></li>
			<li><span class="code">RowReorderDragMode#RowReorderOverlayPainter</span></li>
			<li><span class="code">ColumnReorderCommand#updateFromColumnPosition()</span></li>
			<li><span class="code">ColumnReorderCommand#updateToColumnPosition()</span></li>
			<li><span class="code">ColumnReorderEndCommand#updateToColumnPosition()</span></li>
			<li><span class="code">RowReorderCommand#updateFromRowPosition()</span></li>
			<li><span class="code">RowReorderCommand#updateToRowPosition()</span></li>
			<li><span class="code">RowReorderEndCommand#updateToRowPosition()</span></li>
			<li><span class="code">ColumnReorderEvent#getBeforeFromColumnIndexes()</span></li>
			<li><span class="code">ColumnReorderEvent#getBeforeToColumnIndex()</span></li>
			<li><span class="code">ColumnReorderEvent#setConvertedBeforePositions()</span></li>
			<li><span class="code">RowReorderEvent#getBeforeFromRowIndexes()</span></li>
			<li><span class="code">RowReorderEvent#getBeforeToRowIndex()</span></li>
			<li><span class="code">RowReorderEvent#setConvertedBeforePositions()</span></li>
			<li><span class="code">ColumnReorderLayer#resetReorder()</span></li>
			<li><span class="code">RowReorderLayer#resetReorder()</span></li>
			<li><span class="code">PreserveSelectionModel#selectionLayer</span></li>
			<li><span class="code">PreserveSelectionModel#getRowIdByPosition()</span></li>
			<li><span class="code">PreserveSelectionModel#getRowPositionByRowObject()</span></li>
			<li><span class="code">PreserveSelectionModel#ignoreVerticalChange()</span></li>
			<li><span class="code">SelectCellCommandHandler#selectionLayer</span></li>
			<li><span class="code">SelectColumnCommandHandler#selectionLayer</span></li>
			<li><span class="code">SelectRowCommandHandler#selectionLayer</span></li>
			<li><span class="code">SelectionLayerPainter#ApplyBorderFunction</span></li>
			<li><span class="code">SelectionLayer#allCellsSelectedInRegion()</span></li>
			<li><span class="code">SelectionLayer#handleRowPositionHideCommand()</span></li>
			<li><span class="code">SummaryRowLayer#isSummaryRowPosition()</span></li>
			<li><span class="code">SummaryRowLayer#getSummaryRowPosition()</span></li>
			<li><span class="code">TreeExpandCollapseCommand#getColumnIndex()</span></li>
			<li><span class="code">IndentedTreeImagePainter#getInternalPainter()</span></li>
			<li><span class="code">AbstractTreeRowModel#getTreeData()</span></li>
			<li><span class="code">TreeLayer#isTreeColumn()</span></li>
		</ul>
	</li>
	<li>
		Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name.
		Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields
		to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields
		and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for
		bugfixing.
		<ul>
			<li><span class="code">IFreezeConfigAttributes#SEPARATOR_WIDTH</span></li>
			<li><span class="code">ISearchStrategy#SKIP_SEARCH_RESULT_LABEL</span></li>
			<li><span class="code">LayerUtil#ADDITIONAL_POSITION_MODIFIER</span></li>
			<li><span class="code">PopupMenuBuilder#CREATE_ROW_GROUP_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#RENAME_ROW_GROUP_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#REMOVE_ROW_GROUP_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#UNGROUP_ROWS_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#FREEZE_COLUMN_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#FREEZE_ROW_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#FREEZE_POSITION_MENU_ITEM_ID</span></li>
			<li><span class="code">PopupMenuBuilder#UNFREEZE_MENU_ITEM_ID</span></li>
			<li><span class="code">PrintConfigAttributes#DEFAULT_PAGE_ORIENTATION</span></li>
			<li><span class="code">SizeConfig#PERSISTENCE_KEY_PERCENTAGE_SIZES</span></li>
			<li><span class="code">SizeConfig#PERSISTENCE_KEY_DISTRIBUTE_REMAINING_SPACE</span></li>
			<li><span class="code">SizeConfig#PERSISTENCE_KEY_DEFAULT_MIN_SIZE</span></li>
			<li><span class="code">SizeConfig#PERSISTENCE_KEY_MIN_SIZES</span></li>
		</ul>
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>Performance column grouping</b><br/>
		<p>
			While fixing several issues with the existing column grouping feature (especially on rendering), we introduced a performance leak for huge column groups.
			While this is not noticeable for the most common use cases and the applied fixes ensure to render the column group cells correctly on structural changes and scrolling in frozen states,
			it had a really bad impact for column groups that span thousands of columns. As the existing solution is based on determining the column group cell at rendering time based on the
			column indexes that belong to the column group, it was not possible to fix the performance flaws for huge column groups here.
		</p>
		<p>
			Because of this fact and several other issues with the existing column grouping feature, we decided to implement a new column grouping. It has the following advantages:
			<ul>
				<li>Handle huge column groups</li>
				<li>Groups are configured once and updated via event handling</li>
				<li>Simplified API</li>
				<li>Multi-level configuration in one layer</li>
				<li>Model does not need to be created or configured outside the <span class="code">ColumnGroupHeaderLayer</span></li>
				<li>No need for a <span class="code">ColumnGroupReorderLayer</span></li>
			</ul>
			As a downside it is not possible anymore to render a split column group. 
			A column group is now always consecutive and it is not possible to place columns in between that are not part of the group.
		</p>
		<p>
			To be at least feature-equal with the existing column grouping, the following classes where extended with new constructors or new methods to support the new performance column grouping also:
			<ul>
				<li><span class="code">DisplayColumnChooserCommandHandler</span></li>
				<li><span class="code">ColumnChooser</span></li>
				<li><span class="code">ColumnGroupEntry</span></li>
				<li><span class="code">ColumnChooserDialog</span></li>
				<li><span class="code">ColumnGroupExpandCollapseCommand</span></li>
				<li><span class="code">ColumnGroupUtils</span></li>
				<li><span class="code">ColumnReorderEvent</span></li>
				<li><span class="code">GroupByHeaderConfiguration</span></li>
			</ul>
		</p>
		<p>
			When creating the new performance <span class="code">ColumnGroupHeaderLayer</span> you notice the following facts compared to the existing implementation:
			<ul>
				<li>The constructor of <span class="code">ColumnGroupHeaderLayer</span> does not need a <span class="code">ColumnGroupModel</span> parameter</li>
				<li>The column groups are configured by name, start index and span, not all included column indexes</li>
			</ul>
		</p>
		<p>
			<div class="codeBlock">// build the column header layer
IDataProvider columnHeaderDataProvider =
    new DefaultColumnHeaderDataProvider(propertyNames, propertyToLabelMap);
DataLayer columnHeaderDataLayer =
    new DefaultColumnHeaderDataLayer(columnHeaderDataProvider);
ColumnHeaderLayer columnHeaderLayer =
    new ColumnHeaderLayer(columnHeaderDataLayer, viewportLayer, selectionLayer);
ColumnGroupHeaderLayer columnGroupHeaderLayer =
    new ColumnGroupHeaderLayer(columnHeaderLayer, selectionLayer);

// configure the column groups
columnGroupHeaderLayer.addGroup("Person", 0, 4);
columnGroupHeaderLayer.addGroup("Address", 4, 4);
columnGroupHeaderLayer.addGroup("Facts", 8, 3);
columnGroupHeaderLayer.addGroup("Personal", 11, 3);</div>
		</p>
		<p>
			To support expand/collapse of column groups, the new performance <span class="code">ColumnGroupExpandCollapseLayer</span> needs to be included in the body layer stack.
			This is necessary to not mix column hide/show with column group expand/collapse.
		</p>
		<p>
			By default the <span class="code">ColumnGroupHeaderLayer</span> supports one grouping level. 
			To support additional grouping levels the method <span class="code">ColumnGroupHeaderLayer#addGroupingLevel()</span> needs to be called.
			To configure additional levels, all methods in <span class="code">ColumnGroupHeaderLayer</span> are available with a leading level parameter to specify on which level a group action should be performed.
			The levels are bottom-up, so level 0 is the bottom most column group level, while adding a new grouping level on top will be level 1, rendered in the first row.
		</p>
		<p>
			<div class="codeBlock">columnGroupHeaderLayer.addGroupingLevel();
columnGroupHeaderLayer.addGroup(1, "Person with Address", 0, 8);
columnGroupHeaderLayer.addGroup(1, "Additional Information", 8, 6);</div>
		</p>
		<p>
			The following examples show the usage:<br>
			<i><b>Tutorial Examples -&gt; Grouping -&gt; PerformanceColumnGroupingExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Grouping -&gt; HugeColumnGroupingExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Grouping -&gt; PerformanceColumnAndRowGroupingExample</b></i>
		</p>
	</li>
	<li>
		<b>Performance column grouping with GroupBy</b><br/>
		<p>
			When combining the GroupBy feature with the new performance column grouping a special handling for unbreakable groups is needed to avoid that a column
			can be reordered outside the column group. To support this also visually the <span class="code">GroupByColumnGroupReorderDragMode</span> is introduced.
			It can be configured simply by using the new <span class="code">GroupByHeaderConfiguration</span> constructor that takes the new performance 
			<span class="code">ColumnGroupHeaderLayer</span> as parameter.
		</p>
		<p>
			<div class="codeBlock">ColumnGroupHeaderLayer columnGroupHeaderLayer = 
    new ColumnGroupHeaderLayer(
        sortHeaderLayer,
        bodyLayerStack.getSelectionLayer());
// only render column group row if groups are configured
columnGroupHeaderLayer.setCalculateHeight(true);
...
final GroupByHeaderLayer groupByHeaderLayer = 
    new GroupByHeaderLayer(
        bodyLayerStack.getGroupByModel(),
        gridLayer,
        columnHeaderDataProvider,
        columnHeaderLayer,
        // register special configured
        // GroupByHeaderConfiguration to correctly visualize
        //  that unbreakable groups can't be broken
        new GroupByHeaderConfiguration(
            bodyLayerStack.getGroupByModel(), 
            columnHeaderDataProvider, 
            columnHeaderLayer, 
            columnGroupHeaderLayer));</div>
		</p>
		<p>
			The following example shows the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableGroupByFilterPerformanceColumnGroupAndFreezeExample</b></i>
		</p>
	</li>
	<li>
		<b>Performance row grouping</b><br/>
		<p>
			To align the row grouping API and functionality with the new performance column grouping and some issues with the existing row grouping feature, we created a new performance row grouping implementation.
			It is feature-equal with the new performance column grouping, which also includes dynamic grouping at runtime, which is not supported by the current implementation.
		</p>
		<p>
			It has the following advantages:
			<ul>
				<li>Handle huge row groups</li>
				<li>Groups are configured once and updated via event handling</li>
				<li>Simplified API</li>
				<li>Multi-level configuration in one layer</li>
				<li>Model does not need to be created or configured outside the <span class="code">RowGroupHeaderLayer</span></li>
				<li>No need for a <span class="code">RowGroupReorderLayer</span></li>
			</ul>
			As a downside it is not possible anymore to render a split row group. 
			A row group is now always consecutive and it is not possible to place rows in between that are not part of the group.
		</p>
		<p>
			To be at least feature-equal with the existing row grouping and to align the performance row grouping with the functionality of the new performance column grouping,
			the following classes where extended with new constructors or new methods to support the new performance row grouping also:
			<ul>
				<li><span class="code">RowGroupExpandCollapseCommand</span></li>
				<li><span class="code">RowGroupUtils</span></li>
			</ul>
		</p>
		<p>
			When creating the new performance <span class="code">RowGroupHeaderLayer</span> you notice the following facts compared to the existing implementation:
			<ul>
				<li>The constructor of <span class="code">RowGroupHeaderLayer</span> does not need a <span class="code">RowGroupModel</span> parameter</li>
				<li>The row groups are configured by name, start index and span, not by row objects</li>
				<li>The body <span class="code">DataProvider</span> does not need to be an <span class="code">IRowDataProvider</span></li>
			</ul>
		</p>
		<p>
			<div class="codeBlock">// build the row header layer
IDataProvider rowHeaderDataProvider =
    new DefaultRowHeaderDataProvider(bodyDataProvider);
DataLayer rowHeaderDataLayer =
    new DefaultRowHeaderDataLayer(rowHeaderDataProvider);
ILayer rowHeaderLayer =
    new RowHeaderLayer(rowHeaderDataLayer, viewportLayer, selectionLayer);
RowGroupHeaderLayer rowGroupHeaderLayer =
    new RowGroupHeaderLayer(rowHeaderLayer, selectionLayer);

// configure the row groups
// collect containing last names and the number of persons
// with that lastname in a list sorted by lastname
Map<String, Long> counted = persons.stream()
    .collect(Collectors.groupingBy(ExtendedPersonWithAddress::getLastName, Collectors.counting()));
counted.entrySet().stream().forEach(e -> {
    rowGroupHeaderLayer.addGroup(
        e.getKey(),
        // retrieve the index of the first element with the
        // given lastname
        IntStream.range(0, persons.size())
            .filter(index -> persons.get(index).getLastName().equals(e.getKey()))
            .findFirst()
            .getAsInt(),
        e.getValue().intValue());
});</div>
		</p>
		<p>
			To support expand/collapse of row groups, the new performance <span class="code">RowGroupExpandCollapseLayer</span> needs to be included in the body layer stack.
			This is necessary to not mix row hide/show with row group expand/collapse.
		</p>
		<p>
			By default the <span class="code">RowGroupHeaderLayer</span> supports one grouping level. 
			To support additional grouping levels the method <span class="code">RowGroupHeaderLayer#addGroupingLevel()</span> needs to be called.
			To configure additional levels, all methods in <span class="code">RowGroupHeaderLayer</span> are available with a leading level parameter to specify on which level a group action should be performed.
			The levels are right-to-left, so level 0 is the right most row group level, while adding a new grouping level to the left will be level 1, rendered in the first column.
		</p>
		<p>
			<div class="codeBlock">Group carlsonGroup = rowGroupHeaderLayer.getGroupByName("Carlson");
Group flandersGroup = rowGroupHeaderLayer.getGroupByName("Flanders");
rowGroupHeaderLayer.addGroupingLevel();
rowGroupHeaderLayer.addGroup(1, "Friends", 0,
    carlsonGroup.getOriginalSpan() + flandersGroup.getOriginalSpan());</div>
		</p>
		<p>
			The following examples show the usage:<br>
			<i><b>Tutorial Examples -&gt; Grouping -&gt; PerformanceRowGroupingExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Grouping -&gt; PerformanceColumnAndRowGroupingExample</b></i>
		</p>
	</li>
	<li>
		<b>Hierarchical tree representations</b><br/>
		<p>
			We introduced support for visualizing object graphs. 
			As NatTable internally is only able to handle list structures, several classes where introduced to flatten and handle such structures.
		</p>
		<p>
			Via <span class="code">HierarchicalHelper</span> it is possible to de-normalize or flatten an object graph to a list representation.
			The elements in the resulting list are of type <span class="code">HierarchicalWrapper</span> which internally references corresponding objects in the object graph.
			For accessing the properties of such objects the <span class="code">HierarchicalReflectiveColumnPropertyAccessor</span> is introduced.
			<div class="codeBlock">// de-normalize the object graph without parent structure objects
List<HierarchicalWrapper> data = 
    HierarchicalHelper.deNormalize(values, false, propertyNames);

HierarchicalReflectiveColumnPropertyAccessor columnPropertyAccessor =
    new HierarchicalReflectiveColumnPropertyAccessor(propertyNames);</div>
		</p>
		<p>
			The <span class="code">HierarchicalTreeLayer</span> was introduced to visualize multi-level object hierarchies in a space saving tree representation.
			The parent objects typically do not have their own row objects and span over all related child rows.
			The <span class="code">HierarchicalSpanningDataProvider</span> is introduced to support the calculation of the spanning out of the box.
		</p>
		<p>
			<div class="codeBlock">// build up the body layer stack
IRowDataProvider<HierarchicalWrapper> bodyDataProvider = 
    new ListDataProvider<>(data, columnPropertyAccessor);
HierarchicalSpanningDataProvider spanningDataProvider = 
    new HierarchicalSpanningDataProvider(bodyDataProvider, propertyNames);
DataLayer bodyDataLayer = 
    new SpanningDataLayer(spanningDataProvider);
ColumnReorderLayer columnReorderLayer = 
    new ColumnReorderLayer(bodyDataLayer);
ColumnHideShowLayer columnHideShowLayer = 
    new ColumnHideShowLayer(columnReorderLayer);
SelectionLayer selectionLayer = 
    new SelectionLayer(columnHideShowLayer);
HierarchicalTreeLayer treeLayer = 
    new HierarchicalTreeLayer(selectionLayer, data, propertyNames);
ViewportLayer viewportLayer = 
    new ViewportLayer(treeLayer);</div>
		</p>
		<p>
			<img align="middle" src="../images/hierarchical_example.png" border="0" alt="HierarchicalTreeLayerExample"/>
		</p>
		<p>
			The <span class="code">HierarchicalTreeLayer</span> provides several configuration options to customize visualization and behavior:
			<ul>
				<li><span class="code">HierarchicalTreeLayer#setShowTreeLevelHeader(boolean)</span><br>
					Configure whether the tree level header should be shown or not.</li>
				<li><span class="code">HierarchicalTreeLayer#setHandleCollapsedChildren(boolean)</span><br>
					Configure whether the <span class="code">#COLLAPSED_CHILD</span> label should be added to the <span class="code">LabelStack</span>.
					Enabling this configuration allows a different configuration for child cells of collapsed rows, e.g. different styles like no content painter or different background.</li>
				<li><span class="code">HierarchicalTreeLayer#setHandleNoObjectsInLevel(boolean)</span><br>
					Configure whether the <span class="code">#NO_OBJECT_IN_LEVEL</span> label should be added to the <span class="code">LabelStack</span>.
					Enabling this configuration allows a different configuration for child cells of row objects that have no object for a child level, e.g. making those cells not editable and different styles like no content painter or different background.</li>
				<li><span class="code">HierarchicalTreeLayer#setRetainRemovedRowObjectNodes(boolean)</span><br>
					Configure whether collapsed nodes should be retained in the local storage of collapsedNodes even if the row object is not contained in the underlying list anymore. 
					This can for example happen when using a FilterList, as filtering will remove the row objects from that list.
					Without using a FilterList or supporting deleting rows, it is suggested to set this flag to <span class="code">false</span> to avoid memory leaks on deleting an object.</li>
				<li><span class="code">HierarchicalTreeLayer#setExpandOnSearch(boolean)</span><br>
					Configure whether collapsed nodes should be expanded if they contain rows that are found on search or only the found row should be made visible by still keeping the nodes collapsed.</li>
				<li><span class="code">HierarchicalTreeLayer#setSelectSubLevels(boolean)</span><br>
					Configure whether columns in sub levels should be selected when selecting a level header cell or if only the cells in the same level should be selected.</li>
			</ul>
		</p>
		<p>
			Additionally to the config labels that are also applied by a <span class="code">TreeLayer</span>, the <span class="code">HierarchicalTreeLayer</span> provides the following labels:
			<ul>
				<li><span class="code">HierarchicalTreeLayer#LEVEL_HEADER_CELL</span><br>
					label applied to cells in the level header column (the separator column between columns)</li>
				<li><span class="code">HierarchicalTreeLayer#COLLAPSED_CHILD</span><br>
					label applied to child cells of a collapsed parent node. Only applied if <span class="code">#setHandleCollapsedChildren(boolean)</span> is set to <span class="code">true</span></li>
				<li><span class="code">HierarchicalTreeLayer#NO_OBJECT_IN_LEVEL</span><br>
					label applied to child cells in a row without an object. Only applied if <span class="code">#setHandleNoObjectsInLevel(boolean)</span> is set to <span class="code">true</span></li>
			</ul>
		</p>
		<p>
			The following classes where created to support different additional features with regards to the <span class="code">HierarchicalTreeLayer</span>:
			<ul>
				<li><span class="code">HierarchicalTraversalStrategy</span> - to support configuration of custom traversal strategies</li>
				<li><span class="code">HierarchicalTreeAlternatingRowConfigLabelAccumulator - to support alternating row colors based on the parent objects</span></li>
				<li><span class="code">HierarchicalWrapperComparator - to support sorting</span></li>
				<li><span class="code">HierarchicalTreeColumnReorderDragMode</span> - to respect levels on column reordering</li>
				<li><span class="code">HierarchicalTreeExpandCollapseAction</span> - to support an extended option for expand/collapse operations to a specified level</li>
				<li><span class="code">HierarchicalTreeExpandCollapseCommand</span> - to support an extended option for expand/collapse operations to a specified level</li>
				<li><span class="code">HierarchicalTreeCopyDataCommandHandler</span> - to support copy operations in a <span class="code">HierarchicalTreeLayer</span> by treating spanned cells as single cells and ignore gaps</li>
				<li><span class="code">HierarchicalTreePasteDataCommandHandler</span> - to support paste operations on a <span class="code">HierarchicalTreeLayer</span></li>
				<li><span class="code">HierarchicalWrapperSortModel</span> - to support dynamic sorting in combination with GlazedLists SortedList</li>
				<li><span class="code">HierarchicalWrapperTreeFormat</span> - to support multi level trees with GlazedLists TreeList in a modified <span class="code">TreeLayer</span></li>
			</ul>
		</p>
		<p>
			The following classes where extended with new constructors or other extensions to support the <span class="code">HierarchicalTreeLayer</span>, 
			e.g. to support selection handling on a layer that is placed on top of the <span class="code">SelectionLayer</span>:
			<ul>
				<li><span class="code">DeleteSelectionCommandHandler</span></li>
				<li><span class="code">EditSelectionCommandHandler</span></li>
				<li><span class="code">EditUtils</span></li>
				<li><span class="code">TickUpdateCommandHandler</span></li>
				<li><span class="code">TreeExpandCollapseCommand</span></li>
				<li><span class="code">TreeLayerExpandCollapseKeyBindings</span></li>
				<li><span class="code">IndentedTreeImagePainter</span></li>
			</ul>
		</p>
		<p>
			The following examples show the usage:<br>
			<i><b>Tutorial Examples -&gt; GlazedLists -&gt; Tree -&gt; HierarchicalTreeExample</b></i><br>
			<i><b>Tutorial Examples -&gt; GlazedLists -&gt; Tree -&gt; HierarchicalTreeLayerGridExample</b></i><br>
			<i><b>Tutorial Examples -&gt; GlazedLists -&gt; Tree -&gt; HierarchicalTreeLayerExample</b></i>
		</p>
	</li>
	<li>
		<b><span class="code">SelectRegionCommand</span></b><br/>
		<p>
			Introduced the <span class="code">SelectRegionCommand</span> to be able to select a region at once without the need to trigger the selection of two separate cells with modifier keys.
			This is for example needed to handle selections in a hierarchical tree when clicking a level header cell.
		</p>
	</li>
	<li>
		<b>Tracking of data changes</b><br/>
		<p>
			We introduced the support for tracking data changes in the table.
			This feature can be enabled by adding the <span class="code">DataChangeLayer</span> to the body layer stack, typically directly on top of the <span class="code">DataLayer</span>.
		</p>
		<p>
			<img align="middle" src="../images/datachangelayer_example.png" border="0" alt="DataChangeLayerExample"/>
		</p>
		<p>
			The <span class="code">DataChangeLayer</span> has two operation modes:
			<ol>
				<li><b>Temporary data storage</b><br>
					Data changes are handled temporary in the <span class="code">DataChangeLayer</span>. The underlying data model will be updated on save.</li>
				<li><b>Persistent data storage</b><br>
					Data changes are directly applied to the underlying data model.
					The <span class="code">DataChangeLayer</span> only keeps track of the changes to be able to highlight and to revert the changes.</li>
			</ol>
		</p>
		<p>
			To keep track of data changes, the change needs to be identified.
			For this a <span class="code">CellKeyHandler</span> needs to be provided.
			There are two default implementations that can be used to create a <span class="code">DataChangeLayer</span>:
			<ul>
				<li><span class="code">PointKeyHandler</span><br>
					Changes are tracked by column/row indexes.
					Used in cases where structural modifications like sorting or filtering are not added to the NatTable.</li>
				<li><span class="code">IdIndexKeyHandler</span><br>
					Changes are tracked by column index and row id.
					Used in cases where structural modifications like sorting or filtering are supported in the NatTable.</li>
			</ul>
		</p>
		<p>
			The following example shows the creation of a <span class="code">DataChangeLayer</span> in a NatTable that does not support sorting/filtering and temporarily tracks data changes:
			<div class="codeBlock">// add a DataChangeLayer that temporarily tracks data changes
// without updating the underlying data model
DataChangeLayer dataChangeLayer = 
    new DataChangeLayer(bodyDataLayer, new PointKeyHandler(), true);</div>
		</p>
		<p>
			The following example shows the creation of a <span class="code">DataChangeLayer</span> in a NatTable that does not support sorting/filtering and directly updates the underlying data model.
			Note that in such a scenario the save operation needs to be implemented yourself, as typically the underlying data model needs to be synchronized with the real data storage, e.g. a database.
			<div class="codeBlock">// add a DataChangeLayer that tracks data changes but directly
// updates the underlying data model
DataChangeLayer dataChangeLayer =
    new DataChangeLayer(bodyDataLayer, new PointKeyHandler(), false);

// we register a special command handler to perform custom
// changes on save
dataChangeLayer.registerCommandHandler(
    new SaveDataChangesCommandHandler(dataChangeLayer) {
        @Override
        public boolean doCommand(ILayer targetLayer, SaveDataChangesCommand command) {
            if (MessageDialog.openQuestion(
                    parent.getShell(),
                    "Save data",
                    "Do you really want to save to database?")) {
                // you would implement the storage to database here
                System.out.println("We save the data to the database");
                return super.doCommand(targetLayer, command);
            }
            return true;
        }
    });</div>
		</p>
		<p>
			Additionally to tracking cell data changes it is also possible to track row structural changes like adding or deleting rows.
			This can be enabled via constructor parameter and does only work in the persistent data storage mode.
		</p>
		<p>
			The following example shows the creation of a <span class="code">DataChangeLayer</span> that supports tracking deleting/inserting rows in a NatTable that supports sorting and filtering.
			<div class="codeBlock">// add support for row insert and delete operations
// use the event list instead of a transformed list to ensure
// the operations work even in a transformed (e.g. filtered)
// state register the RowDeleteCommandHandler for delete
// operations by index, e.g. used for reverting row insert
//  operations
this.bodyDataLayer.registerCommandHandler(
    new RowDeleteCommandHandler<>(this.eventList));

// register the RowObjectDeleteCommandHandler for delete
// operations by object, e.g. delete by UI interaction
this.bodyDataLayer.registerCommandHandler(
    new RowObjectDeleteCommandHandler<>(this.eventList));

// register the KeyRowInsertCommandHandler to be able to
// revert key insert operations by firing KeyRowInsertEvents
// uses an IdIndexKeyHandler with an alternative
// ListDataProvider on the base list in order to be able to
// discard the change on the base list
this.bodyDataLayer.registerCommandHandler(
    new KeyRowInsertCommandHandler<>(
        this.eventList,
        new IdIndexKeyHandler<>(
            new ListDataProvider<>(
                this.eventList, 
                columnPropertyAccessor), 
            rowIdAccessor)));

// layer for event handling of GlazedLists and PropertyChanges
GlazedListsEventLayer<T> glazedListsEventLayer =
    new GlazedListsEventLayer<>(
        this.bodyDataLayer,
        this.filterList);

// the DataChangeLayer can be placed on top of the
// GlazedListsEventLayer or directly on the DataLayer. Best
// results will be when placed near the DataLayer without
// index-position transformations in between, and placing on
// top of the GlazedListsEventLayer ensures that events are
// sent and handled on changes on the list.
DataChangeLayer changeLayer =
    new DataChangeLayer(
        glazedListsEventLayer,
        new IdIndexKeyHandler<>(
            this.bodyDataProvider,
            rowIdAccessor),
        false,
        true);</div>
		</p>
		<p>
			To discard/undo tracked data changes the <span class="code">DiscardDataChangesCommand</span> can be executed.
		</p>
		<p>
			To save tracked data changes the <span class="code">SaveDataChangesCommand</span> can be executed.
		</p>
		<p>
			Cells that contain modified data are marked with the cell label <span class="code">DataChangeLayer#DIRTY</span>.
			This allows for example to customize the visualization of dirty cells.
			<div class="codeBlock">// add a special style to highlight the modified cells
Style style = new Style();
style.setAttributeValue(
        CellStyleAttributes.BACKGROUND_COLOR, 
        GUIHelper.COLOR_YELLOW);
configRegistry.registerConfigAttribute(
        CellConfigAttributes.CELL_STYLE,
        style,
        DisplayMode.NORMAL,
        DataChangeLayer.DIRTY);</div>
		</p>
		<p>
			The following examples show the usage:<br>
			<i><b>Tutorial Examples -&gt; Layers -&gt; Data -&gt; DataChangeLayerExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Layers -&gt; Data -&gt; DataChangeLayerTempStorageExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; EditableSortableGroupByWithFilterExample</b></i>
		</p>
	</li>
	<li>
		<b><span class="code">UpdateDataCommandHandler</span> enhancements</b><br/>
		<p>
			Introduced a new constructor to be able to specify whether an equals check should be performed on applying a new value or not. 
			Typically an equals check is performed and an update is skipped if the new value is the same as the current value. 
			In some cases this could not be the desired behavior and it is expected that the value is applied without checking the current status, 
			e.g. when entering the same value in a filter, the filtering should be performed disregarding the current state to re-apply the filter.
		</p>
		<p>
			Also introduced the <span class="code">DataUpdateEvent</span> that is fired by the <span class="code">UpdateDataCommandHandler</span>
			in case the new value is set to the backing data via <span class="code">DataLayer</span>. It is a specialization of the <span class="code">CellVisualChangeEvent</span>
			that additionally carries the old and the new cell value.
		</p>
	</li>
	<li>
		<b>Hide/Show enhancements</b><br/>
		<p>There are several enhancements to the hide/show feature to improve the usability.</p>
		
		<p>
			We introduced the <span class="code">ResizeColumnHideShowLayer</span> which hides a column by resizing it to a width of 0. 
			With this a percentage sized column width configuration will always take the whole available space for the visible columns.
			It needs the body <span class="code">DataLayer</span> at creation time to operate on the column widths.
		</p>
		<p>
			<div class="codeBlock">ResizeColumnHideShowLayer columnHideShowLayer =
    new ResizeColumnHideShowLayer(bodyDataLayer, bodyDataLayer);</div>
		</p>
		<p>
			The following example shows the usage:<br>
			<i><b>Tutorial Examples -&gt; Layers -&gt; HideShow -&gt; ResizeColumnHideShowExample</b></i>
		</p>
		
		<p>
			We introduced the <span class="code">RowIdHideShowLayer</span> which allows to hide a row and keep track of it via row id. 
			This way hiding a row will work correctly even on sorting or filtering via GlazedLists.
		</p>
		<p>
			<div class="codeBlock">IRowIdAccessor<HierarchicalWrapper> rowIdAccessor = 
    new IRowIdAccessor<HierarchicalWrapper>() {

        @Override
        public Serializable getRowId(HierarchicalWrapper rowObject) {
            return rowObject.hashCode();
        }
    };

...

RowIdHideShowLayer<HierarchicalWrapper> rowHideShowLayer = 
    new RowIdHideShowLayer<>(
        columnHideShowLayer,
        bodyDataProvider,
        rowIdAccessor);</div>
		</p>
		
		<p>
			We introduced the <span class="code">HideIndicatorOverlayPainter</span> that can be used to render an indicator in the column and/or row header at places where columns/rows are hidden.
			It can also have a menu configured to it, so via right click on the hide indicator a menu opens that let the user show only the hidden columns at the given position again.
			A default menu can be added via <span class="code">HideIndicatorMenuConfiguration</span>.
		</p>
		<p>
			<img align="middle" src="../images/hideindicator_example.png" border="0" alt="HideIndicatorOverlayPainter example"/>
		</p>
		<p>
			<div class="codeBlock">// add the optional rendering indicator for the hidden
// columns and rows
HideIndicatorOverlayPainter overlayPainter =
        new HideIndicatorOverlayPainter(
                columnHeaderLayer, 
                rowHeaderLayer);
natTable.addOverlayPainter(overlayPainter);

// add a menu configuration that attaches menus to the hidden
// row and column indicator
natTable.addConfiguration(
        new HideIndicatorMenuConfiguration(
                natTable, 
                columnHeaderLayer, 
                rowHeaderLayer));</div>
		</p>
		<p>
			The appearance of the hide indicator can be configured via the following config attributes:
			<ul>
				<li><span class="code">HideIndicatorConfigAttributes#HIDE_INDICATOR_LINE_WIDTH</span></li>
				<li><span class="code">HideIndicatorConfigAttributes#HIDE_INDICATOR_COLOR</span></li>
			</ul>
			<div class="codeBlock">overlayPainter.setConfigRegistry(natTable.getConfigRegistry());
natTable.addConfiguration(new AbstractRegistryConfiguration() {

    @Override
    public void configureRegistry(IConfigRegistry configRegistry) {
        configRegistry.registerConfigAttribute(
            HideIndicatorConfigAttributes.HIDE_INDICATOR_COLOR,
            GUIHelper.COLOR_BLACK);
    }
});</div>
			Alternatively it is possible to set the line with and color values via setter methods on the <span class="code">HideIndicatorOverlayPainter</span>.
		</p>
		<p>
			The following example shows the usage:<br>
			<i><b>Tutorial Examples -&gt; Layers -&gt; HideShow -&gt; ColumnAndRowHideShowExample</b></i>
		</p>
	</li>
	<li>
		<b>Improved percentage sizing</b><br/>
		<p>
			There are several improvements to the percentage sizing feature to improve the usability.
		</p>
		<p>
			Several configuration options were added to the <span class="code">DataLayer</span> and <span class="code">SizeConfig</span> that allow to configure the behavior of percentage sized columns or rows.
			It is for example now possible to configure the minimum width/height to avoid that columns/rows vanish if the space becomes to small on resizing a window.
			It is also possible to configure how remaining space should be handled in case the size configuration does not cover 100%.
			This also improves the behavior on mixed size configurations, which gives developers a huge flexibility on how the size configuration should look like in their NatTables.
		</p>
		<p>
			The following methods where introduced for improved percentage sizing configurations:
			<ul>
				<li><span class="code">SizeConfig#resetConfiguredMinSize(int)</span></li>
				<li><span class="code">SizeConfig#isDistributeRemainingSpace()</span></li>
				<li><span class="code">SizeConfig#setDistributeRemainingSpace(boolean)</span></li>
				<li><span class="code">SizeConfig#getDefaultMinSize()</span></li>
				<li><span class="code">SizeConfig#setDefaultMinSize(int)</span></li>
				<li><span class="code">SizeConfig#getMinSize(int)</span></li>
				<li><span class="code">SizeConfig#setMinSize(int, int)</span></li>
				<li><span class="code">SizeConfig#isMinSizeConfigured()</span></li>
				<li><span class="code">SizeConfig#isMinSizeConfigured(int)</span></li>
				<li><span class="code">SizeConfig#isFixPercentageValuesOnResize()</span></li>
				<li><span class="code">SizeConfig#setFixPercentageValuesOnResize(boolean)</span></li>
				
				<li><span class="code">DataLayer#resetMinColumnWidth(int, boolean)</span></li>
				<li><span class="code">DataLayer#resetMinRowHeight(int, boolean)</span></li>
				<li><span class="code">DataLayer#isDistributeRemainingColumnSpace()</span></li>
				<li><span class="code">DataLayer#setDistributeRemainingColumnSpace(boolean)</span></li>
				<li><span class="code">DataLayer#isDistributeRemainingRowSpace()</span></li>
				<li><span class="code">DataLayer#setDistributeRemainingRowSpace(boolean)</span></li>
				<li><span class="code">DataLayer#getDefaultMinColumnWidth()</span></li>
				<li><span class="code">DataLayer#setDefaultMinColumnWidth(int)</span></li>
				<li><span class="code">DataLayer#getMinColumnWidth(int)</span></li>
				<li><span class="code">DataLayer#setMinColumnWidth(int, int)</span></li>
				<li><span class="code">DataLayer#isMinColumnWidthConfigured()</span></li>
				<li><span class="code">DataLayer#isMinColumnWidthConfigured(int)</span></li>
				<li><span class="code">DataLayer#getDefaultMinRowHeight()</span></li>
				<li><span class="code">DataLayer#setDefaultMinRowHeight(int)</span></li>
				<li><span class="code">DataLayer#getMinRowHeight(int)</span></li>
				<li><span class="code">DataLayer#setMinRowHeight(int, int)</span></li>
				<li><span class="code">DataLayer#isMinRowHeightConfigured()</span></li>
				<li><span class="code">DataLayer#isMinRowHeightConfigured(int)</span></li>
				<li><span class="code">DataLayer#isFixColumnPercentageValuesOnResize()</span></li>
				<li><span class="code">DataLayer#setFixColumnPercentageValuesOnResize(boolean)</span></li>
				<li><span class="code">DataLayer#isFixRowPercentageValuesOnResize()</span></li>
				<li><span class="code">DataLayer#setFixRowPercentageValuesOnResize(boolean)</span></li>
			</ul>
		</p>
		<p>
			<div class="codeBlock">DataLayer bodyDataLayer = new DataLayer(bodyDataProvider);
bodyDataLayer.setColumnPercentageSizing(true);
bodyDataLayer.setDefaultMinColumnWidth(20);</div>		
		</p>
		<p>
			The following example shows the usage of minimum column width configuration:<br>
			<i><b>Tutorial Examples -&gt; Layers -&gt; HideShow -&gt; ResizeColumnHideShowExample</b></i>
		</p>
	</li>
	<li>
		<b>Scaling improvements</b><br/>
		<p>
			The following methods where introduced for dealing with scaling when programmatically operating on a NatTable:
			<ul>
				<li><span class="code">SizeConfig#getConfiguredSize(int)</span></li>
				<li><span class="code">SizeConfig#upScale(int)</span></li>
				<li><span class="code">SizeConfig#downScale(int)</span></li>
				
				<li><span class="code">DataLayer#getConfiguredColumnWidthByPosition(int)</span></li>
				<li><span class="code">DataLayer#getConfiguredRowHeightByPosition(int)</span></li>
				<li><span class="code">DataLayer#upScaleColumnWidth(int)</span></li>
				<li><span class="code">DataLayer#downScaleColumnWidth(int)</span></li>
				<li><span class="code">DataLayer#upScaleRowHeight(int)</span></li>
				<li><span class="code">DataLayer#downScaleRowHeight(int)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Skip cells in search</b><br/>
		<p>
			It is now possible to configure that specific cells should be skipped in a search operation by adding the config label 
			<span class="code">ISearchStrategy#SKIP_SEARCH_RESULT_LABEL</span> to the config label stack.
			This is for example needed to avoid that columns that only render images or comboboxes are taken into account in the search result.
			It is also used in the <span class="code">ResizeColumnHideShowLayer</span> to avoid that currently hidden columns are part in the search.
		</p>
		<p>
			<div class="codeBlock">// skip second column in search
ColumnOverrideLabelAccumulator columnLabelAccumulator =
    new ColumnOverrideLabelAccumulator(bodyDataLayer);
columnLabelAccumulator.registerColumnOverrides(
    1, 
    ISearchStrategy.SKIP_SEARCH_RESULT_LABEL);</div>
		</p>
	</li>
	<li>
		<b><span class="code">PositionCoordinateComparator</span></b><br/>
		<p>
			Introduced the <span class="code">PositionCoordinateComparator</span> to be able to sort collections of 
			<span class="code">PositionCoordinate</span> in an ascending way.
		</p>
	</li>
	<li>
		<b><span class="code">ComboBoxCellEditor#focusOnText</span></b><br/>
		<p>
			Introduced the <span class="code">focusOnText</span> flag in <span class="code">ComboBoxCellEditor</span> to be able to specify whether the text field 
			or the dropdown should get the focus when the editor is activated.
			This is useful for <span class="code">ComboBoxCellEditor</span>s that support free editing.
		</p>
	</li>
	<li>
		<b><span class="code">TextCellEditor</span> enhancements to configure behavior on ENTER</b><br/>
		<p>
			Introduced methods to be able to configure the behavior of the <span class="code">TextCellEditor</span> if ENTER is pressed. 
			This is especially interesting for multiline text editors where pressing ENTER could either mean to apply the value or for adding a new line.
		</p>
	</li>
	<li>
		<b>Several new helper methods in <span class="code">LayerCommandUtil</span> and <span class="code">PositionUtil</span></b><br/>
		<p>
			To implement new features shown above, several new methods were introduced in utility classes that could also helpful for 
			users that create a highly customized NatTable.
		</p>
	</li>
	<li>
		<b>Increased the extensibility of <span class="code">CopyDataCommandHandler</span> and <span class="code">InternalPasteDataCommandHandler</span></b><br/>
		<p>
			The <span class="code">CopyDataCommandHandler</span> and the <span class="code">InternalPasteDataCommandHandler</span> where modified to increase the 
			extensibility by adding new methods that can be overriden. This gives the ability to customize checks or the behavior without the need
			to copy internal code to the custom handler.
		</p>
	</li>
	<li>
		<b>Copy spanned cells</b><br/>
		<p>
			The default implementation of the <span class="code">CopyDataCommandHandler</span> does not handle the spanning of a spanned cell. Instead it copies every
			cell in the spanning as a single cell. The same is true for pasting via the <span class="code">InternalPasteDataCommandHandler</span>.
			For several use cases this behavior is fine. But there are use cases where a spanned cell should be treated as a single cell, for example if the value in a cell
			that spans 6 rows should be pasted in a cell that has no spanning. The default implementation would paste the same value in 6 cells instead of a single cell.
			To support the copy of spanned cells as a single cell, the following command handler are introduced:
			<ul>
				<li><span class="code">RowSpanningCopyDataCommandHandler</span></li>
				<li><span class="code">RowSpanningPasteDataCommandHandler</span></li>
			</ul>
		</p>
		<p>
			The can be registered similar to the following snippet:
			<div class="codeBlock">selectionLayer.registerCommandHandler(
    new RowSpanningCopyDataCommandHandler(
        selectionLayer, 
        natTable.getInternalCellClipboard()));
selectionLayer.registerCommandHandler(
    new RowSpanningPasteDataCommandHandler(
        selectionLayer,
        natTable.getInternalCellClipboard()));</div>
		</p>
	</li>
	<li>
		<b>Increased the extensibility of <span class="code">PreserveSelectionModel</span></b><br/>
		<p>
			The <span class="code">PreserveSelectionModel is modified to increase the extensibility by adding new methods that can be overriden. 
			This gives the ability to customize checks and the behavior. 
		</p>
		<p>
			With these extensions it was possible to implement the <span class="code">SummaryRowPreserveSelectionModel</span>
			which can be used to combine the <span class="code">PreserveSelectionModel</span> behavior with a summary row, which otherwise fails as the summary row is not part
			of the underlying data model.
		</p>
	</li>
	<li>
		<b>Reacting on print execution</b><br/>
		<p>
			The <span class="code">PrintListener</span> interface was introduced to react on print events. 
			Implementations can be registered on <span class="code">LayerPrinter</span> to get informed when a print operation starts or is finished.
		</p>
		<p>
			<div class="codeBlock">viewportLayer.registerCommandHandler(
    new PrintCommandHandler(viewportLayer) {
        @Override
        public boolean doCommand(PrintCommand command) {
            LayerPrinter printer = new LayerPrinter(
                    this.layer,
                    command.getConfigRegistry());

            printer.addPrintListener(new PrintListener() {

                @Override
                public void printStarted() {
                    System.out.println("Print startet!");
                }

                @Override
                public void printFinished() {
                    System.out.println("Print finished!");
                }
            });
            printer.print(command.getShell());
            return true;
        }
    });</div>
		</p>
	</li>
	<li>
		<b>Automatic row resizing on rendering</b><br/>
		<p>
			There are several approaches to perform automatic auto resizing in NatTable. One approach is a to configure the <span class="code">ICellPainter</span>
			that support auto resize to calculate the height or width on rendering. This will only perform a resize for cells that come into the visible area, but
			it has the downside that by default it only increases the cell dimensions. An automatic shrinking of cell dimensions is not supported as this would lead
			to concurrency issues. Another approach is to register a <span class="code">PaintListener</span> that performs the auto resize operation when the table
			is painted. But so far that implied some internal knowledge of NatTable mechanisms and for row resizing also causes performance issues if not implemented
			carefully.
		</p>
		<p>
			To provide better auto row resizing support that is also able to shrink a row height if possible, the <span class="code">AutoResizeRowPaintListener</span> is introduced.
			It internally uses the <span class="code">AutoResizeHelper</span> that calculates the row heights asynchronously for the currently visible rows and triggers a
			<span class="code">MultiRowResizeCommand</span> once the calculation is done. It also takes care of concurrent execution e.g. on scrolling, to avoid
			inconsistent states and avoids frequent resize commands.
		</p>
		<p>
			<div class="codeBlock">natTable.addPaintListener(
    new AutoResizeRowPaintListener(
        natTable, 
        bodyLayerStack.getViewportLayer(), 
        bodyLayerStack.getBodyDataLayer()));</div>
		</p>
		<p>
			Additionally the <span class="code">AutoResizeRowsCommand</span> and the <span class="code">AutoResizeColumnsCommand</span> where extended to simplify
			programmatically triggered auto resize actions. These commands can now be created using the NatTable instance and the column/row positions that should be resized.
			This way for example the auto resize of the column header row can simply be triggered using the following code:
			<div class="codeBlock">natTable.doCommand(new AutoResizeRowsCommand(natTable, 0));</div>
		</p>
	</li>
	<li>
		<b>Reset size configurations</b><br/>
		<p>
			There are scenarios that require to reset an applied column width or row height configuration, e.g. when changing the content of a NatTable by exchanging the
			<span class="code">IDataProvider</span>. It is also possible to reset the size configuration only for a specific column or row, which for example is used in the 
			<span class="code">ResizeColumnHideShowLayer</span> to show a column again.
		</p>
		<p>
			To support the reset of size configurations the following methods where introduced:
			<ul>
				<li><span class="code">SizeConfig#reset()</span></li>
				<li><span class="code">SizeConfig#resetConfiguredSize(int)</span></li>
				<li><span class="code">DataLayer#resetColumnWidthConfiguration(boolean)</span></li>
				<li><span class="code">DataLayer#resetColumnWidth(int, boolean)</span></li>
				<li><span class="code">DataLayer#resetRowHeightConfiguration(boolean)</span></li>
				<li><span class="code">DataLayer#resetRowHeight(int, boolean)</span></li>
			</ul>
		</p>
		<p>
			Additionally the following commands and command handler where introduced to reset the size configurations via command:
			<ul>
				<li><span class="code">ColumnWidthResetCommand</span></li>
				<li><span class="code">ColumnWidthResetCommandHandler</span></li>
				<li><span class="code">RowHeightResetCommand</span></li>
				<li><span class="code">RowHeightResetCommandHandler</span></li>
			</ul>
		</p>
		<p>
			The following example shows the usage:<br>
			<i><b>Tutorial Examples -&gt; Data -&gt; ChangeDataProviderExample</b></i>
		</p>
	</li>
	<li>
		<b>Reset reordering</b><br/>
		<p>
			The <span class="code">ColumnReorderLayer</span> and the <span class="code">RowReorderLayer</span> are used in NatTable to support reordering of columns and rows.
			This can be triggered via UI interactions or programmatically. To support undoing  reorder operations the feature to reset those layers is introduced. It will remove
			all applied reorder operations and bring those layers back to the state it would have at initialization. 
		</p>
		<p>
			To support the reset of reordering the following methods where introduced:
			<ul>
				<li><span class="code">ColumnReorderLayer#resetReorder()</span></li>
				<li><span class="code">RowReorderLayer#resetReorder()</span></li>
			</ul>
		</p>
		<p>
			Additionally the following commands and command handler where introduced to reset reordering via command:
			<ul>
				<li><span class="code">ResetColumnReorderCommand</span></li>
				<li><span class="code">ResetColumnReorderCommandHandler</span></li>
				<li><span class="code">ResetRowReorderCommand</span></li>
				<li><span class="code">ResetRowReorderCommandHandler</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Index-based multi-reorder</b><br/>
		<p>
			The <span class="code">MultiColumnReorderCommand</span> and the <span class="code">MultiRowReorderCommand</span> are extended to support index-based reordering.
			This is useful for programmatical reording when columns/rows are hidden, which is used for example in the new performance column and row grouping for reordering
			groups with hidden elements. 
		</p>
		<p>
			To treat the from positions as indexes, <span class="code">setReorderByIndex(true)</span> needs to be set.
		</p>
		<p>
			<b>Note:</b> Only the from positions will then be treated as indexes and a position-index-transformation will be skipped on traversing down the layer stack!
			The to position will always be treated as position!
		</p>
	</li>
	<li>
		<b>Added support to select all columns in a column group / all rows in a row group</b><br/>
		<p>
			It is now possible to enable UI bindings that trigger a multi-column/multi-row selection when performing a click on the header cell.
		</p>
		<p>
			For the old column grouping these bindings can be enabled via <span class="code">DefaultColumnGroupHeaderLayerConfiguration</span>.
			This can be done by creating the ColumnGroupHeaderLayer without the default configuration and then register the 
			<span class="code">DefaultColumnGroupHeaderLayerConfiguration</span> with enabled selection bindings.
			The default is <span class="code">false</span> to avoid unwanted behavioral regressions in products when updating to NatTable 1.6.
		</p>
		<p>
			<div class="codeBlock">ColumnGroupHeaderLayer columnGroupHeaderLayer =
    new ColumnGroupHeaderLayer(columnHeaderLayer, selectionLayer, columnGroupModel, false);
columnGroupHeaderLayer.addConfiguration(
    new DefaultColumnGroupHeaderLayerConfiguration(columnGroupModel, true));</div>
		</p>
		<p>
			The new performance column grouping supports also supports column group selection bindings and has the same default to not having them enabled.
			To enable the column group selection bindings also the default configuration needs to be avoided and the <span class="code">DefaultColumnGroupHeaderLayerConfiguration</span>
			from the <span class="code">org.eclipse.nebula.widgets.nattable.group.performance.config</span> package needs to be created and registered with enabled selection bindings.
		</p>
		<p>
			<div class="codeBlock">ColumnGroupHeaderLayer columnGroupHeaderLayer =
    new ColumnGroupHeaderLayer(columnHeaderLayer, selectionLayer, false);
columnGroupHeaderLayer.addConfiguration(
    new DefaultColumnGroupHeaderLayerConfiguration(true));</div>
		</p>
		<p>
			To align the performance row grouping functionality to the new performance column grouping, the row group selection bindings can be enabled similarly.
		</p>
		<p>
			<div class="codeBlock">RowGroupHeaderLayer rowGroupHeaderLayer =
    new RowGroupHeaderLayer(rowHeaderLayer, selectionLayer, false);
rowGroupHeaderLayer.addConfiguration(
    new DefaultRowGroupHeaderLayerConfiguration(true));</div>
		</p>
		<p>
			To also support group selection bindings programmatically, the following actions, commands and command handler were added:
			<ul>
				<li><span class="code">ViewportSelectColumnGroupAction</span></li>
				<li><span class="code">ViewportSelectColumnGroupCommand</span></li>
				<li><span class="code">ViewportSelectColumnGroupCommandHandler</span></li>
				<li><span class="code">ViewportSelectRowGroupAction</span></li>
				<li><span class="code">ViewportSelectRowGroupCommand</span></li>
				<li><span class="code">ViewportSelectRowGroupCommandHandler</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Added option to execute an export synchronously</b><br/>
		<p>
			By default an export operation is performed asynchronously. As there might be use cases where a synchronous execution would be needed, 
			new constructors where added to the <span class="code">ExportCommand</span> and the <span class="code">NatExporter</span> to specify if the 
			export should be performed synchronously or asynchronously. The default is still asynchronous execution. 
		</p>
	</li>
	<li>
		<b>Enhanced freeze options</b><br/>
		<p>
			It is now possible to configure the <span class="code">FreezeSelectionCommand</span> and the <span class="code">FreezePositionCommand</span> to <b>include</b> 
			the current selected or specified position in the freeze area. 
			By default the cell for which the command is triggered is the first cell in the non-frozen area.
		</p>
		<p>
			To enable the include behavior, new constructors where added to the following classes with an additional <i>include</i> parameter:
			<ul>
				<li><span class="code">FreezeGridAction</span></li>
				<li><span class="code">FreezeSelectionCommand</span></li>
				<li><span class="code">FreezePositionCommand</span></li>
			</ul>
		</p>
		<p>
			The following snippet shows how to register custom freeze grid bindings that include the selected cell in the frozen area:
			<div class="codeBlock">CompositeFreezeLayer compositeFreezeLayer = 
    new CompositeFreezeLayer(
            freezeLayer,
            this.viewportLayer,
            this.selectionLayer,
            false);
    
    // register custom freeze grid bindings that include
    // the selected cell to the frozen region
    compositeFreezeLayer.addConfiguration(new AbstractUiBindingConfiguration() {
        
        @Override
        public void configureUiBindings(UiBindingRegistry uiBindingRegistry) {
            uiBindingRegistry.registerKeyBinding(
                new KeyEventMatcher(SWT.MOD1 | SWT.MOD2, 'f'),
                new FreezeGridAction(false, false, true));
            uiBindingRegistry.registerKeyBinding(
                new KeyEventMatcher(SWT.MOD1 | SWT.MOD2, 'u'),
                new UnFreezeGridAction());
        }
    });</div>
		</p>
		
		<p>
			There are pre-defined menu items that can be added to column header, row header or a body menu to trigger freeze operations.
			The menu items can be simply added by using the corresponding methods in the <span class="code">PopupMenuBuilder</span>.
			The related implementations can be found in <span class="code">MenuItemProviders</span> in case a custom menu builder implementation is used.
			<ul>
				<li><span class="code">PopupMenuBuilder#withFreezeColumnMenuItem()</span></li>
				<li><span class="code">PopupMenuBuilder#withFreezeColumnMenuItem(String)</span></li>
				<li><span class="code">PopupMenuBuilder#withFreezeRowMenuItem()</span></li>
				<li><span class="code">PopupMenuBuilder#withFreezeRowMenuItem(String)</span></li>
				<li><span class="code">PopupMenuBuilder#withFreezePositionMenuItem(boolean)</span></li>
				<li><span class="code">PopupMenuBuilder#withFreezePositionMenuItem(String, boolean)</span></li>
				<li><span class="code">PopupMenuBuilder#withUnfreezeMenuItem()</span></li>
				<li><span class="code">PopupMenuBuilder#withUnfreezeMenuItem(String)</span></li>
			</ul>
		</p>
		<p>
			The snippet below is taken from the updated freeze example:<br>
			<i><b>Tutorial Examples -&gt; Layers -&gt; FreezeExample</b></i>
		</p>
		<p>
			<div class="codeBlock">IMenuItemState freezeActiveState = new IMenuItemState() {

    @Override
    public boolean isActive(NatEventData natEventData) {
        return freezeLayer.isFrozen();
    }
};
natTable.addConfiguration(new AbstractHeaderMenuConfiguration(natTable) {
    @Override
    protected PopupMenuBuilder createColumnHeaderMenu(NatTable natTable) {
        return super.createColumnHeaderMenu(natTable)
            .withHideColumnMenuItem()
            .withShowAllColumnsMenuItem()
            .withColumnChooserMenuItem()
            .withFreezeColumnMenuItem()
            .withUnfreezeMenuItem()
            .withVisibleState(
                PopupMenuBuilder.UNFREEZE_MENU_ITEM_ID,
                freezeActiveState);
    }

    @Override
    protected PopupMenuBuilder createCornerMenu(NatTable natTable) {
        return super.createCornerMenu(natTable)
            .withShowAllColumnsMenuItem()
            .withStateManagerMenuItemProvider();
    }

    @Override
    protected PopupMenuBuilder createRowHeaderMenu(NatTable natTable) {
        return super.createRowHeaderMenu(natTable)
            .withFreezeRowMenuItem()
            .withUnfreezeMenuItem()
            .withVisibleState(
                PopupMenuBuilder.UNFREEZE_MENU_ITEM_ID, 
                freezeActiveState);
    }
});

natTable.addConfiguration(new AbstractUiBindingConfiguration() {

    private final Menu bodyMenu = new PopupMenuBuilder(natTable)
            .withInspectLabelsMenuItem()
            .withFreezePositionMenuItem(true)
            .withUnfreezeMenuItem()
            .withVisibleState(
                PopupMenuBuilder.UNFREEZE_MENU_ITEM_ID, 
                freezeActiveState)
            .build();

    @Override
    public void configureUiBindings(UiBindingRegistry uiBindingRegistry) {
        uiBindingRegistry.registerMouseDownBinding(
            new MouseEventMatcher(SWT.NONE, null, 3),
            new PopupMenuAction(this.bodyMenu));
    }

});</div>
		</p>
		
		
		<p>The width of the freeze border can now be configured via <span class="code">IFreezeConfigAttributes#SEPARATOR_WIDTH</span> configuration attribute.</p>
		<p>
			<div class="codeBlock">configRegistry.registerConfigAttribute(
        IFreezeConfigAttributes.SEPARATOR_WIDTH, 
        2);</div>
		</p>
		
		<p>
			The <span class="code">CompositeFreezeLayerPainter</span> can be configured to paint the freeze border over the whole table.
			By default the freeze border is only rendered in the body region, because the <span class="code">CompositeFreezeLayer</span> is part of the body layer stack.
			To extend the freeze border to also paint over regions outside the body layer stack, the <span class="code">CompositeFreezeLayerPainter</span> needs to be
			configured and registered differently.
		</p>
		<p>
			To paint the freeze border over the header regions in a simple grid composition, the <span class="code">CompositeFreezeLayerPainter</span>
			can be registered on the <span class="code">GridLayer</span> like this:
			<div class="codeBlock">// register a freeze painter that renders also in the header regions
gridLayer.setLayerPainter(
        new CompositeFreezeLayerPainter(
                gridLayer, 
                bodyLayerStack.getCompositeFreezeLayer()));</div>
		</p>
		<p>
			To paint the freeze border over the header regions and an additional region in a more complicated grid composition, e.g. with a fixed summary row, the following code can be used:
			<div class="codeBlock">// create a composition that has the grid on top and the 
// summary row on the bottom
CompositeLayer composite = new CompositeLayer(1, 2);
composite.setChildLayer("GRID", gridLayer, 0, 0);
composite.setChildLayer(SUMMARY_REGION, summaryRowLayer, 0, 1);

// register a CompositeFreezeLayerPainter that renders also
// in the header regions by registering it on the top
// CompositeLayer itself we configure the inspectComposite
// flag as false to avoid that the top and left positions
// in this CompositeLayer are inspected for the freeze line
// position
CompositeFreezeLayerPainter painter2 = 
    new CompositeFreezeLayerPainter(
        composite,
        ((SummaryRowBodyLayerStack) gridLayer.getBodyLayer())
		    .getCompositeFreezeLayer(),
        false);

// now we configure the column header layer and the row header
// layer as nested layers to shift the freeze lines to left
// and to the bottom so they are correctly aligned.
painter2.addNestedVerticalLayer(gridLayer.getColumnHeaderLayer());
painter2.addNestedHorizontalLayer(gridLayer.getRowHeaderLayer());
composite.setLayerPainter(painter2);</div>
		</p>
		<p>
			The snippet above is taken from the following example:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; EditableFixedSummaryRowWithFreezeExample</b></i>
		</p>

		<p>Also some modifications where performed to fix rendering issues in frozen state for column groups.</p>
	</li>
	<li>
		<b>Create <span class="code">PopupMenuBuilder</span> with a provided <span class="code">MenuManager</span></b><br/>
		<p>
			It is now possible to create a <span class="code">PopupMenuBuilder</span> with an existing <span class="code">MenuManager</span>.
			This way the instance can be created before a NatTable instance is available
			and can even be used to solve some issues with Eclipse 3.x based menus.
		</p>
		<p>
			<b>Note:</b> If the <span class="code">PopupMenuBuilder(MenuManager)</span> constructor is used, the menu can only be build via 
			<span class="code">PopupMenuBuilder#build(NatTable)</span>. Otherwise the generate menu can't be attached to the NatTable instance. 
		</p>
	</li>
	<li>
		<b>Concurrency issue fixes in <span class="code">FilterRowComboBoxDataProvider</span></b><br/>
		<p>
			There were several concurrency issues related to filtering. To fix those the <span class="code">FilterRowComboBoxDataProvider</span> needed to be
			extended e.g. to disable event handling to avoid issues for Excel like filter combo boxes and introducing a lock for accessing
			the value cache. Additionally a method name typo was fixed and the method <span class="code">removeCacheUpdateListener()</span> was introduced.
		</p>
	</li>
	<li>
		<b>Improvement in <span class="code">ShowXxxInViewportCommand</span></b><br/>
		<p>
			There were several flaws when programmatically using a <span class="code">ShowXxxInViewportCommand</span>s. 
			By providing an <span class="code">ILayer</span> and a position, people got confused about the position transformations
			and in some scenarios the transformation even broke the usage of those commands.
		</p>
		<p>
			To fix this the old constructors that take an <span class="code">ILayer</span> as parameter are deprecated. 
			Instead the constructors that only take position parameters should be used. 
			Those positions need to match the <span class="code">ILayer</span> on which the <span class="code">ViewportLayer</span> is build on 
			(typically the <span class="code">SelectionLayer</span>).
		</p>
		<p>
			This change applies to the following commands:
			<ul>
				<li><span class="code">ShowCellInViewportCommand</span></li>
				<li><span class="code">ShowColumnInViewportCommand</span></li>
				<li><span class="code">ShowRowInViewportCommand</span></li>
			</ul>
		</p>
	</li>
	
	
	<li>
		<b>Support for deleting row objects</b><br/>
		<p>
			NatTable Core now contains default commands and command handler to delete rows.
			<ul>
				<li><span class="code">RowDeleteCommand</span></li>
				<li><span class="code">RowDeleteCommandHandler</span></li>
				<li><span class="code">RowObjectDeleteCommand</span></li>
				<li><span class="code">RowObjectDeleteCommandHandler</span></li>
			</ul>
			The <span class="code">RowDeleteCommand</span> takes the row position to delete as parameter, while the <span class="code">RowObjectDeleteCommand</span>
			takes the object as parameter that should be removed from the underlying data.
		</p>
		<p>
			The NatTable GlazedLists Extension contains respective command handlers that consider the <span class="code">ReadWriteLock</span> in order to avoid concurrency issues.
			<ul>
				<li><span class="code">GlazedListsRowDeleteCommandHandler</span></li>
				<li><span class="code">GlazedListsRowObjectDeleteCommandHandler</span></li>
			</ul>
		</p>
		<p>
			The command handlers are NOT registered by default to any layer. To support delete row operations, the respective command handlers need to be registered:
		</p>
		<p>
			<div class="codeBlock">bodyDataLayer.registerCommandHandler(
    new RowDeleteCommandHandler<>(bodyDataProvider.getList()));</div>
		</p>
		<p>
			<div class="codeBlock">bodyDataLayer.registerCommandHandler(
    new RowObjectDeleteCommandHandler<>(bodyDataProvider.getList()));</div>
		</p>
		<p>
			<div class="codeBlock">bodyDataLayer.registerCommandHandler(
    new GlazedListsRowObjectDeleteCommandHandler<>(this.filterList));</div>
		</p>
		<p>
			To delete a row either the row position or the row object need to be provided:
		</p>
		<p>
			<div class="codeBlock">int rowPosition = MenuItemProviders.getNatEventData(event).getRowPosition();
    natTable.doCommand(new RowDeleteCommand(natTable, rowPosition));</div>
		</p>
		<p>
			<div class="codeBlock">int rowPosition = MenuItemProviders.getNatEventData(event).getRowPosition();
int pos = LayerUtil.convertRowPosition(natTable, rowPosition, selectionLayer);
int idx = selectionLayer.getRowIndexByPosition(pos);

natTable.doCommand(
    new RowObjectDeleteCommand<>(
	    bodyLayerStack.bodyDataProvider.getRowObject(idx)));</div>
		</p>
		<p>
			The usage of the commands is shown in the following examples:<br>
			<i><b>Tutorial Examples -&gt; Data -&gt; DataModificationExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; EditableSortableGroupByWithFilterExample</b></i><br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableGroupByWithComboBoxFilterExample</b></i>
		</p>
		
	</li>
	<li>
		<b>Support for inserting row objects</b><br/>
		<p>
			NatTable Core now contains default commands and command handler to insert rows.
			<ul>
				<li><span class="code">RowInsertCommand</span></li>
				<li><span class="code">RowInsertCommandHandler</span></li>
			</ul>
		</p>
		<p>
			The NatTable GlazedLists Extension contains respective command handlers that consider the <span class="code">ReadWriteLock</span> in order to avoid concurrency issues.
			<ul>
				<li><span class="code">GlazedListsRowInsertCommandHandler</span></li>
			</ul>
		</p>
		<p>
			The command handler is NOT registered by default to any layer. To support insert row operations, the respective command handler need to be registered:
			<div class="codeBlock">bodyDataLayer.registerCommandHandler(
    new RowInsertCommandHandler<>(bodyDataProvider.getList()));</div>
		</p>
		<p>
			To insert a row the index to insert and the row object to insert need to be specified.
			In a body menu the code to insert a row could look like this:
			<div class="codeBlock">int rowPosition = MenuItemProviders.getNatEventData(event).getRowPosition();
int rowIndex = natTable.getRowIndexByPosition(rowPosition);

Person ralph = new Person(bodyDataLayer.getRowCount() + 1, "Ralph", "Wiggum", Gender.MALE, false, new Date());
natTable.doCommand(new RowInsertCommand<>(rowIndex + 1, ralph));</div>
		</p>
		<p>
			The usage of the commands is shown in the following example:<br>
			<i><b>Tutorial Examples -&gt; Data -&gt; DataModificationExample</b></i>
		</p>
	</li>
	<li>
		<b><span class="code">GlazedListsSortModel#refresh()</span></b><br/>
		<p>
			The method <span class="code">GlazedListsSortModel#refresh()</span> was introduced to be able to trigger a re-sort. 
			Calling this method is needed for example when trying to add data to a NatTable that has an active GroupBy and an applied sorting on a column with groupby summary values. 
			Without re-sorting the new elements in the list could be placed at the wrong position and breaking the tree structure as it is not possible to calculate the summary at insertion
			time.
		</p>
	</li>
	<li>
		<b>Deactivate GlazedLists list change handling</b><br/>
		<p>
			It is possible to deactivate the list change handling in the <span class="code">GlazedListsEventLayer</span>.
			If list changes happen while the handling is deactivated, the changes are still tracked, so once the list change handling is activated again, a refresh event is triggered.
			As in some scenarios firing a general event could lead to an unwanted behavior, e.g. when using the <span class="code">RowReorderLayer</span> and inserting a single row, 
			the reorder state gets reset.
		</p>
		<p>
			To support such cases also, it is now possible to discard possible event processing before activating the list change handling again.
			This can be done by calling <span class="code">GlazedListsEventLayer#discardEventsToProcess()</span>.
			In such a case the caller of those methods need to fire the necessary refresh events in NatTable manually.
		</p>
		<p>
			Additionally the <span class="code">DetailGlazedListsEventLayer</span> is extended to also support deactivating the list change handling.
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