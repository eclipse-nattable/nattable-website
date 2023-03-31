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
	$pageTitle 		= "NatTable 2.1.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 2.1.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. 
We would like to thank everyone involved for their commitment and support on developing the 2.1.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>
Despite the enhancements and new features there are numerous bugfixes related to issues on filtering.
</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.1.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=2.1.0">here</a>.</p>

<h3>Dependency changes</h3>
<p>
The dependency to Nebula, to consume the RichText control for example, was updated to Nebula 3.0 to consume a bugfix related
to the vertical alignment in NatTable. Nebula 3.0 updated the minimum required Java version to Java 11. This means, if you 
consume all NatTable features and dependencies via the NatTable Update Site, you will need Java 11 as runtime because of the
updated Nebula requirements. The NatTable bundles have <b>NOT</b> updated the minimum requirement to Java 11. So you can still
setup an application that runs with Java 8 if you don't use the Nebula Extension or use a Nebula version before 3.0.
</p>

<h3>API changes</h3>
<ul>
	<li>
		Several modifications were made to increase the extensibility of NatTable.
		Some additional methods are added and the visibility of some existing methods is increased. 
		Existing code should work unchanged.<br>
		Below is the list of those methods, the details can be found in the <i>Enhancements and new features</i> section.
		<ul>
			<li><span class="code">CellSelectionEvent#isForcingEntireCellIntoViewport()</span></li>
			<li><span class="code">ComboBoxGlazedListsFilterStrategy#hasComboBoxFilterEditorRegistered()</span></li>
			<li><span class="code">CompositeFreezeLayer#modifyColumnSpanLayerCell(ILayerCell)</span></li>
			<li><span class="code">CompositeFreezeLayer#modifyRowSpanLayerCell(ILayerCell)</span></li>
			<li><span class="code">FilterAppliedEvent#getColumnIndex()</span></li>
			<li><span class="code">FilterAppliedEvent#getNewValue()</span></li>
			<li><span class="code">FilterAppliedEvent#getOldValue()</span></li>
			<li><span class="code">FilterAppliedEvent#isCleared()</span></li>
			<li><span class="code">FilterAppliedEvent#isFilterComboEditor()</span></li>
			<li><span class="code">FilterAppliedEvent#setCleared(boolean)</span></li>
			<li><span class="code">FilterAppliedEvent#setFilterComboEditor(boolean)</span></li>
			<li><span class="code">FilterNatCombo#setFilterModifyAction(Runnable)</span></li>
			<li><span class="code">FilterRowComboBoxCellEditor#configureDropdownFilter(boolean, boolean)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#getAllValues(int)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#getValues(Collection, int, Map<Integer, List<?>>, ReadWriteLock)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#collectValuesForColumn(int)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#collectValues(Collection, int)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#updateCache(int)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#updateCache(int, Map<Integer, List<?>>, ReadWriteLock)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#clearCache(boolean)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#clearCache(Map<Integer, List<?>>, ReadWriteLock, boolean)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#isEventFromBodyLayer(ILayerEvent)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#isFilterChanged(int, Object, Object)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#buildUpdateEvent(FilterRowComboUpdateEvent, int, List<?>, List<?>)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#isDistinctNullAndEmpty()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#setDistinctNullAndEmpty(boolean)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#getFilterCollection()</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#setFilterCollection(Collection, ILayer)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#setLastFilter(int, Collection)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#doCommand(ILayer, UpdateDataCommand)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#getCommandClass()</span></li>
			<li><span class="code">FilterRowComboUpdateEvent#addUpdate(int, Collection<?>, Collection<?>)</span></li>
			<li><span class="code">FilterRowComboUpdateEvent#getColumnIndex(int)</span></li>
			<li><span class="code">FilterRowComboUpdateEvent#getAddedItems(int)</span></li>
			<li><span class="code">FilterRowComboUpdateEvent#getRemovedItems(int)</span></li>
			<li><span class="code">FilterRowComboUpdateEvent#updateContentSize()</span></li>
			<li><span class="code">FilterRowDataProvider#getFilterStrategy()</span></li>
			<li><span class="code">FilterRowDataProvider#setFilterRowComboBoxDataProvider(FilterRowComboBoxDataProvider)</span></li>
			<li><span class="code">FilterRowUtils#getSeparatorCharacters(String)</span></li>
			<li><span class="code">GlazedListsFilterRowComboBoxDataProvider#activate()</span></li>
			<li><span class="code">GlazedListsFilterRowComboBoxDataProvider#deactivate()</span></li>
			<li><span class="code">GlazedListsFilterRowComboBoxDataProvider#discardEventsToProcess()</span></li>
			<li><span class="code">GlazedListsFilterRowComboBoxDataProvider#isActive()</span></li>
			<li><span class="code">GlazedListsFilterRowComboBoxDataProvider#isDisposed()</span></li>
			<li><span class="code">GroupByDataLayer#enableFilterSupport(FilterRowDataProvider)</span></li>
			<li><span class="code">HoverLayer#setCurrentHoveredCellByIndex(int, int)</span></li>
			<li><span class="code">NatCombo#setDropdownFilterKeyListener(KeyListener)</span></li>
			<li><span class="code">NatCombo#setDropdownFilterModifyListener(ModifyListener)</span></li>
			<li><span class="code">ObjectUtils#collectionsEqual(Collection, Collection)</span></li>
			<li><span class="code">PoiExcelExporter#getDataFormatString(Object, ILayerCell, IConfigRegistry)</span></li>
			<li><span class="code">RichTextCellPainter#getHtmlText(ILayerCell, IConfigRegistry)</span></li>
			<li><span class="code">UpdateDataCommand#setNewValue(Object)</span></li>
			<li><span class="code">ViewportLayer#getOriginColumnPosition()</span></li>
			<li><span class="code">ViewportLayer#getOriginRowPosition()</span></li>
		</ul>
		Below is the list of new constructors
		<ul>
			<li><span class="code">CellPainterMouseEventMatcher(int, String, int, ICellPainter)</span></li>
			<li><span class="code">CellPainterMouseEventMatcher(int, String, int, Class<? extends ICellPainter>)</span></li>
			<li><span class="code">CellSelectionEvent(SelectionLayer, int, int, boolean, boolean, boolean)</span></li>
			<li><span class="code">ComboBoxFilterRowConfiguration(ICellEditor, ImagePainter, IComboBoxDataProvider)</span></li>
			<li><span class="code">IdIndexKeyHandler(IRowDataProvider, IRowIdAccessor, Class)</span></li>
			<li><span class="code">FilterAppliedEvent(ILayer, boolean)</span></li>
			<li><span class="code">FilterAppliedEvent(ILayer, int, Object, Object, boolean)</span></li>
			<li><span class="code">FilterRowPainter(ICellPainter, ImagePainter)</span></li>
			<li><span class="code">ShowColumnInViewportCommand(ILayer, int)</span></li>
			<li><span class="code">ShowColumnInViewportCommand(ShowColumnInViewportCommand)</span></li>
		</ul>
	</li>
	<li>
		Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name.
		Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields
		to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields
		and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for
		bugfixing.
		<ul>
			<li><span class="code">ComboBoxFilterRowConfiguration#comboBoxDataProvider</span></li>
			<li><span class="code">ComboBoxFilterRowConfiguration#filterRowPainter</span></li>
			<li><span class="code">ExportConfigAttributes#NUMBER_FORMAT</span></li>
			<li><span class="code">FilterRowDataProvider#COMMA_REPLACEMENT</span></li>
			<li><span class="code">FilterRowDataProvider#EMPTY_REPLACEMENT</span></li>
			<li><span class="code">FilterRowDataProvider#NULL_REPLACEMENT</span></li>
			<li><span class="code">GroupByHeaderMenuConfiguration#groupByHeaderLayer</span></li>
			<li><span class="code">GroupModel#PIPE_REPLACEMENT</span></li>
		</ul>
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>Excel-like filter - Enhancements</b><br/>
		<p>
			There are numerous enhancements and bugfixes in the area of filtering content in a NatTable.
			Especially the "Excel-like" filter was extended, to feel even more like "Excel". One of the improvements
			is that if you filter in one column, the filter comboboxes of all other columns will only contain items
			based on the current filtered data in the table. While the filter combobox of the column where the filter
			was applied, still contains all previous values. This increases the usability of the "Excel-like" filter 
			feature in NatTable, but caused a lot of modifications in the related code base. 
		</p>
		<p>
			To enable this feature you only need to set the filter collection and the column header layer to the 
			<span class="code">FilterRowComboBoxDataProvider</span> via 
			<span class="code">FilterRowComboBoxDataProvider#setFilterCollection(Collection, ILayer)</span>. All other 
			mechanisms are handled internally. The necessary API changes are documented in the upper section.
		</p>
		<p>
			<div class="codeBlock">this.filterRowComboBoxDataProvider.setFilterCollection(
			bodyLayerStack.getFilterList(), 
			this.filterRowHeaderLayer);</div>
		</p>
		<p>
			The following examples contain demonstrations on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableAllFilterPerformanceColumnGroupExample</b></i>
		</p>
	</li>
	<li>
		<b>Inverted combobox filter persistence</b><br/>
		<p>
			When using the "Excel-like" filter combobox filter row, the persisted filter is based on what is selected.
			This makes the persisted state dependent on the content shown in the NatTable.
			If the persisted state should be reused even with different contents, it should be stored what is <b>NOT</b>
			selected. To be able to store this inverted logic, the <span class="code">FilterRowDataProvider</span> needs to know the
			<span class="code">FilterRowComboBoxDataProvider</span> in order to be able to identify what is not selected. This can be done via
			<span class="code">FilterRowDataProvider#setFilterRowComboBoxDataProvider(FilterRowComboBoxDataProvider)</span>.
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableAllFilterPerformanceColumnGroupExample</b></i>
		</p>
	</li>
	<li>
		<b>Filter content on filtering the combobox content</b><br/>
		<p>
			The <span class="code">NatCombo</span> is extended to support registering a <span class="code">ModifyListener</span>
			and a <span class="code">KeyListener</span> on the dropdown filter textfield, which can be used to filter the
			dropdown content. This way it is possible to directly trigger a filter operation on the NatTable when the filter
			dropdown content is filtered.
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableAllFilterPerformanceColumnGroupExample</b></i>
		</p>
	</li>
	<li>
		<b>FilterAppliedEvent extension</b><br/>
		<p>
			The <span class="code">FilterAppliedEvent</span> was extended to transport lot more information than before.
			This extension was necessary to support the feature to handle filter combobox content that contains only values
			that are currently visible.
		</p>
	</li>
	<li>
		<b>IActivatableFilterStrategy</b><br/>
		<p>
			We introduced the <span class="code">IActivatableFilterStrategy</span> interface to add support for activating and
			deactivating a filter strategy. This is for example needed for the GroupBy feature to ensure that the original
			list state is not changed when operating on filters and groups.
		</p>
	</li>
	<li>
		<b>ComboBoxGlazedListsWithExcludeFilterStrategy</b><br/>
		<p>
			We introduced the <span class="code">ComboBoxGlazedListsWithExcludeFilterStrategy</span> that supports excluding
			table items from filtering. Excluding items from filtering means that these items are never filtered and therefore
			always part of the NatTable content.
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableAllFilterPerformanceColumnGroupExample</b></i>
		</p>
	</li>
	<li>
		<b>GlazedListsFilterRowComboBoxDataProvider</b><br/>
		<p>
			The <span class="code">GlazedListsFilterRowComboBoxDataProvider</span> now supports deactivation similar to the 
			<span class="code">GlazedListsEventHandler</span>. This is especially helpful and necessary in case of bulk updates
			on the NatTable content, like replacing the content.
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; SortableAllFilterPerformanceColumnGroupExample</b></i>
		</p>
	</li>
	<li>
		<b>GroupBy - Filter - Combination</b><br/>
		<p>
			If the GroupBy feature is combined with filtering, there are situations where it can happen that the original
			list order is lost. To avoid this the <span class="code">GroupByDataLayer</span> needs to know the <span class="code">FilterRowDataProvider</span>.
			This can be set via <span class="code">GroupByDataLayer#enableFilterSupport(FilterRowDataProvider)</span>.
		</p>
	</li>
	<li>
		<b>Performance grouping expand/collapse handling</b><br/>
		<p>
			The following classes were added for specialized hide/show events related to performance group expand/collapse:
			<ul>
			<li><span class="code">ColumnGroupCollapseEvent</span></li>
			<li><span class="code">ColumnGroupExpandEvent</span></li>
			<li><span class="code">RowGroupCollapseEvent</span></li>
			<li><span class="code">RowGroupExpandEvent</span></li>
			</ul> 
		</p>
	</li>
	<li>
		<b>Hover by index</b><br/>
		<p>
			The hover functionality was extended to work also via indexes. This was necessary to fix some rendering issues in performance group headers in scrolled state.
			The following classes were added:
			<ul>
			<li><span class="code">HoverStylingByIndexAction</span></li>
			<li><span class="code">HoverStylingByIndexCommand</span></li>
			<li><span class="code">HoverStylingByIndexCommandHandler</span></li>
			</ul> 
		</p>
	</li>
	<li>
		<b>ShowColumnInViewportAction</b><br/>
		<p>
			We introduced the <span class="code">ShowColumnInViewportAction</span> to be able to move a cell into the viewport.
			This is for example necessary to avoid a rendering glitch when applying a filter that causes a removal of the scrollbar.
		</p>
	</li>
	<li>
		<b>Export - Number Formatting</b><br/>
		<p>
			It is now possible to configure the number format on exportin to Excel using the POI extension. 
			This can be done via the <span class="code">ExportConfigAttributes.NUMBER_FORMAT</span> configuration attribute.
			The possible values are defined by <a href="https://poi.apache.org/apidocs/dev/org/apache/poi/ss/usermodel/BuiltinFormats.html">BuiltinFormats</a>.
		</p>
		<p>
			<div class="codeBlock">configRegistry.registerConfigAttribute(
        ExportConfigAttributes.NUMBER_FORMAT,
        "0.00", //$NON-NLS-1$
        DisplayMode.NORMAL,
        ColumnLabelAccumulator.COLUMN_LABEL_PREFIX + 3);</div>
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; GroupBySummaryFixedSummaryRowExample</b></i>
		</p>
	</li>
	<li>
		<b>RichText - Separate data and markup display converter</b><br/>
		<p>
			It is now possible to configure a markup display converter separated and additionally to a data converter.
			Previously only a <span class="code">CellConfigAttributes.DISPLAY_CONVERTER</span> could be registered to add the HTML markup. This made it difficult for cases where the data needs to be converted to text in advance.
			Now the markup display converter can be registered via the <span class="code">RichTextConfigAttributes.MARKUP_DISPLAY_CONVERTER</span> configuration attribute.
		</p>
		<p>
			<div class="codeBlock">configRegistry.registerConfigAttribute(
        RichTextConfigAttributes.MARKUP_DISPLAY_CONVERTER,
        markupConverter,
        DisplayMode.NORMAL,
        ColumnLabelAccumulator.COLUMN_LABEL_PREFIX + 1);</div>
		</p>
		<p>
			The following example contains a demonstration on the usage:<br>
			<i><b>Tutorial Examples -&gt; Configuration -&gt; NebulaRichTextIntegrationExample</b></i>
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