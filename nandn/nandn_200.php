<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2020 Dirk Fauth and others.
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
	$pageTitle 		= "NatTable 2.0.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 2.0.0 release is a major update that
<ul>
<li>Updates the license to EPLv2</li>
<li>Updates the minimum required Java version to Java 8 (BREE = JavaSE-1.8)</li>
<li>Updates third-party dependencies</li>
<li>Cleans up the code base</li>
</ul> 
We would like to thank everyone involved for their commitment and support on developing the 2.0.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>
We also removed the extension.builder from the sources, as it was never published and not maintained for several years.
</p>
<p>
Despite the modifications named above there are numerous bugfixes related to issues on concurrency, scaling, percentage sizing or performance and memory consumption.
</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.0.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=2.0.0">here</a>.</p>

<h3>Third-Party-Dependencies Update</h3>

There are several changes to the dependencies of NatTable Core and the NatTable Extensions.

<h4>Updated libraries</h4>
<ul>
	<li>GlazedLists 1.11</li>
	<li>Apache POI 4.1.1</li>
	<li>Nebula RichText 1.4.0</li>
	<li>Nebula CDateTime 1.5.0</li>
</ul>

<h4>Added libraries</h4>
<ul>
	<li>Apache Commons Collections4 (transitive dependency of Apache POI 4.1.1)</li>
	<li>Apache Commons Math3 (transitive dependency of Apache POI 4.1.1)</li>
	<li>Eclipse Collections 10.4.0</li>
	<li>SLF4J API</li>
</ul>

<h4>Removed libraries</h4>
<ul>
	<li>Apache Commons Logging</li>
</ul>

<h3>API changes</h3>
<p>
The code base was cleanup up to increase the maintainability. In this process several classes, methods, fields and constructors were removed that were marked deprecated for a while.
Additionally with the increase of the BREE to JavaSE-1.8 we could remove custom functional interfaces that were used internally and remove them with the default Java functional interfaces.
</p>
<p>
We now also have a Sonar analysis running. You can find the analysis report <a href="https://sonarcloud.io/dashboard?id=org.eclipse.nebula.widgets.nattable%3Aparent">here</a>.<br>
In this section the API additions that resulted from the Sonar analysis results are listed. All other additions and API modifications caused by new features are listed in the corresponding feature section.
</p>
<ul>
	<li>
		<b>Removed classes</b><br/>
		<p>
			<ul>
				<li><span class="code">ActiveCellEditorRegistry</span></br>This static registry was replaced with an instance field in NatTable.</li>
				<li><span class="code">BodyCellEditorMouseEventMatcher</span></br>Replaced with <span class="code">CellEditorMouseEventMatcher</span></li>
				<li><span class="code">CellEditDragMode</span></br>Intended handling is now done internally in <span class="code">DragModeEventHandler</span></li>
				<li><span class="code">ColumnGroupMenuItemProviders</span></br>Moved to <span class="code">MenuItemProviders</span> and <span class="code">PopupMenuBuilder</span></li>
				<li><span class="code">IRowHideShowCommandLayer</span></br>Merged with <span class="code">IRowHideShowLayer</span></li>
				<li><span class="code">RowSelectionPreserver</span></br>Functionality can be added by using the <span class="code">RowSelectionModel</span></li>
				<li><span class="code">SelectionLayerPainter#ApplyBorderFunction</span></br>Replaced with <span class="code">java.util.function.Function</span></li>
				<li><span class="code">SelectionLayerStructuralChangeEventHandler</span></br>Unnecessary as <span class="code">ISelectionModel</span> is itself an <span class="code">ILayerEventHandler</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Removed methods</b><br/>
		<p>
			<ul>
				<li><span class="code">AbstractModeEventHandler#eventOnSameCell(MouseEvent, MouseEvent)</span></br>Replaced with <span class="code">MouseEventHelper#eventOnSameCell(ILayer, MouseEvent, MouseEvent)</span></li>
				<li><span class="code">AbstractTreeRowModel#getObjectAtIndexAndDepth(int, int)</span></br>Formatting should be performed in a configured <span class="code">IExportFormatter</span></li>
				<li><span class="code">CellPainterDecorator#setBaseCellPainterSpansWholeCell(boolean)</span></br>Replaced with <span class="code">CellPainterDecorator#setPaintDecorationDependent(boolean)</span></li>
				<li><span class="code">ColumnHeaderLayer#getSelectionLayer</span></br><span class="code">SelectionLayer</span> should be accessed via body.</li>
				<li><span class="code">CopySelectionLayerPainter#applyCopyBorderStyle</span></br>Replaced with <span class="code">CopySelectionLayerPainter#getCopyBorderStyle</span> to switch from an action to a supplier mechanism</li>
				<li><span class="code">EditUtils#commitAndCloseActiveEditor()</span></br>Replaced with <span class="code">NatTable#commitAndCloseActiveCellEditor()</span></li>
				<li><span class="code">EditUtils#isCellEditable(ILayer, IConfigRegistry, PositionCoordinate)</span></br>Replaced with <span class="code">EditUtils#isCellEditable(PositionCoordinate, IConfigRegistry)</span></li>
				<li><span class="code">EventConflaterChain(int, int)</span></br>Replaced with <span class="code">EventConflaterChain(long, long)</span></li>
				<li><span class="code">FillHandleLayerPainter#applyCopyBorderStyle</span></br>Replaced with <span class="code">FillHandleLayerPainter#getCopyBorderStyle</span> to switch from an action to a supplier mechanism</li>
				<li><span class="code">FillHandleLayerPainter#applyHandleBorderStyle</span></br>Replaced with <span class="code">FillHandleLayerPainter#getHandleRegionBorderStyle</span> to switch from an action to a supplier mechanism</li>
				<li><span class="code">FillHandleLayerPainter#applyHandleStyle</span></br>Replaced with <span class="code">FillHandleLayerPainter#getHandleColor</span> and FillHandleLayerPainter#getHandleBorderStyle</span> to switch from an action to a supplier mechanism</li>
				<li><span class="code">FilterRowComboBoxDataProvider#removeCacheUdpateListener</span></br>Replaced with <span class="code">FilterRowComboBoxDataProvider#removeCacheUpdateListener</span></li>
				<li><span class="code">GlazedListTreeData</span> - expand/collapse methods</br> expand/collapse operations are performed on the <span class="code">ITreeRowModel</span></li>
				<li><span class="code">GlazedListTreeData#formatDataForDepth(int, int)</span></br>Formatting should be performed in a configured <span class="code">IExportFormatter</span></li>
				<li><span class="code">GlazedListTreeData#formatDataForDepth(int, T)</span></br>Formatting should be performed in a configured <span class="code">IExportFormatter</span></li>
				<li><span class="code">GridLineCellLayerPainter#drawGridLines(ILayer, GC, Rectangle, IConfigRegistry)</span></br>Replaced with <span class="code">GridLineCellLayerPainter#drawGridLines(ILayer, GC, Rectangle, IConfigRegistry, List)</span></li>
				<li><span class="code">GroupByDataLayer#getElementsInGroup(GroupByObject)</span></br>Replaced with <span class="code">GroupByDataLayer#getItemsInGroup(GroupByObject)</span></li>
				<li><span class="code">GroupByDataLayer#setSortModel(ISortModel)</span></br>Replaced with <span class="code">GroupByDataLayer#initializeTreeComparator(ISortModel, IUniqueIndexLayer, boolean)</span></li>
				<li><span class="code">GUIHelper#getImage(ImageData)</span></br>No direct replacement as the function with the <span class="code">ImageData</span> parameter was never functional</li>
				<li><span class="code">ITreeData#formatDataForDepth(int, int)</span></br>Formatting should be performed in a configured <span class="code">IExportFormatter</span></li>
				<li><span class="code">ITreeData#formatDataForDepth(int, T)</span></br>Formatting should be performed in a configured <span class="code">IExportFormatter</span></li>
				<li><span class="code">ITreeRowModel#getObjectAtIndexAndDepth(int, int)</span></br>Formatting should be performed in a configured <span class="code">IExportFormatter</span></li>
				<li><span class="code">SelectionLayerPainter#applyBorderStyle</span></br>Replaced with <span class="code">SelectionLayerPainter#getBorderStyle</span> to switch from an action to a supplier mechanism</li>
				<li><span class="code">SelectionLayerPainter#getBorderCells(ILayer, int, int, Rectangle, ApplyBorderFunction)</span></br>Replaced with <span class="code">SelectionLayerPainter#getBorderCells(ILayer, int, int, Rectangle, Function)</span></li>
				<li><span class="code">SizeConfig#correctPercentageValues(int, int)</span></br>Replaced with <span class="code">SizeConfig#correctPercentageValues(double, int)</span></li>
				<li><span class="code">TextCellEditor#setErrorDecorationText(String)</span></br>Error decorations are applied by using the <span class="code">RenderErrorHandling</span></li>
				<li><span class="code">TreeLayer#getTreeImagePainter</span></br>The <span class="code">TreeImagePainter</span> configured via <span class="code">IConfigRegistry</span> is used instead</li>
				<li><span class="code">TreeRowModel#clear</span></br>Not specified by <span class="code">ITreeRowModel</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Removed fields</b><br/>
		<p>
			<ul>
				<li><span class="code">FillHandleDragMode#startIndex</span></br>Use <span class="code">FillHandleDragMode#startPosition</span> that is relative to the <span class="code">SelectionLayer</span> instead</li>
				<li><span class="code">NatCombo#style</span></br>Replaced with <span class="code">NatCombo#widgetStyle</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Removed constructors</b><br/>
		<p>
			<ul>
				<li><span class="code">BodyMenuConfigurationNatTable, ILayer)</span></li>
				<li><span class="code">ColumnGroupGroupHeaderLayer</span> - Removed the unused <span class="code">SelectionLayer</span> parameter</li>
				<li><span class="code">ColumnGroupHeaderTextPainter</span> - All constructors with <span class="code">ColumnGroupModel</span> parameter</li>
				<li><span class="code">ColumnReorderEvent</span> - All constructors without explicit index parameters</li>
				<li><span class="code">ColumnSelectionEvent(SelectionLayer, int)</span></li>
				<li><span class="code">DefaultRowGroupHeaderLayerConfiguration(IRowGroupModel)</span></li>
				<li><span class="code">IndentedTreeImagePainter</span> - All constructors with <span class="code">ITreeRowModel</span> parameter</li>
				<li><span class="code">InlineCellEditEvent(ILayer, PositionCoordinate, Composite, IConfigRegistry, Object)</span></li>
				<li><span class="code">RowGroupHeaderTextPainter</span> -  All constructors with <span class="code">IRowGroupModel</span> parameter</li>
				<li><span class="code">RowReorderEvent</span> - All constructors without explicit index parameters</li>
				<li><span class="code">RowSelectionEvent(SelectionLayer, Collection<Integer>, int)</span></li>
				<li><span class="code">SelectionLayer(IUniqueIndexLayer, ISelectionModel, boolean, boolean)</span></li>
				<li><span class="code">ShowCellInViewportCommand(ILayer, int, int)</span></li>
				<li><span class="code">ShowColumnInViewportCommand(ILayer, int, int)</span></li>
				<li><span class="code">ShowRowInViewportCommand(ILayer, int, int)</span></li>
				<li><span class="code">TreeImagePainter</span> - All constructors with <span class="code">ITreeRowModel</span> parameter</li>
			</ul>
		</p>
	</li>
	<li>
		<b>Added methods</b><br/>
		<p>
			The following methods were added to fix user reported bugs and issues reported by Sonar.
		</p>
		<p>
			<ul>
				<li><span class="code">ColumnCategoriesDialog#addListener(IColumnCategoriesDialogListener)</span></li>
				<li><span class="code">ColumnCategoriesDialog#removeListener(IColumnCategoriesDialogListener)</span></li>
				<li><span class="code">ColumnChooserDialog#addListener(ISelectionTreeListener)</span></li>
				<li><span class="code">ColumnChooserDialog#removeListener(ISelectionTreeListener)</span></li>
				<li><span class="code">ColumnChooserDialog#populateAvailableTree(List<ColumnEntry>, ColumnGroupModel, boolean)</span></li>
				<li><span class="code">ColumnChooserDialog#populateAvailableTree(List<ColumnEntry>, ColumnGroupHeaderLayer, boolean)</span></li>
				<li><span class="code">HideIndicatorOverlayPainter#setLayerOnTop(ILayer)</span></li>
				<li><span class="code">HideIndicatorOverlayPainter#setLayerToLeft(ILayer)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Added constants</b><br/>
		<p>
			<ul>
				<li><span class="code">FormulaParser</span> - All regular expressions are now defined as <span class="code">public static final</span> constants</li>
			</ul>
		</p>
	</li>
	<li>
		<b>Added constructors</b><br/>
		<p>
			<ul>
				<li><span class="code">ComboBoxFilterRowConfiguration(ICellEditor, ImagePainter)</span></li>
				<li><span class="code">HierarchicalWrapper(HierarchicalWrapper)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Modified helper classes and constants interfaces</b><br/>
		<p>
			According to best practices all helper classes with static helper methods are now final and have a private default constructor to avoid sub-classing and instantiating.
			Additionally all constants interfaces are changed to constants classes to avoid that these interfaces are implemented.
		</p>
		<p>
			If the helper classes and constants interfaces were used as intended, this change should not affect users. If those classes were extended or the interfaces implemented (which was never the intended usage) you will need to adjust your code.
		</p>
		<p>
			At least two changes will cause compilation errors if you are using the according feature:
			<ul>
				<li><span class="code">RowOnlySelectionConfiguration</span> - removed the unnecessary generic</li>
				<li><span class="code">FreezeConfigAttributes</span> - renamed to <span class="code">FreezeConfigAttributes</span></li>
			</ul>
		</p>
		<p>
			The following list contains all modified interfaces and classes:
		</p>
		<p>
			<ul>
				<li><span class="code">ArrayUtil</span></li>
				<li><span class="code">BlinkConfigAttributes</span></li>
				<li><span class="code">CellConfigAttributes</span></li>
				<li><span class="code">CellDisplayConversionUtils</span></li>
				<li><span class="code">CellDisplayValueSearchUtil</span></li>
				<li><span class="code">CellEdgeDetectUtil</span></li>
				<li><span class="code">CellEditDialogFactory</span></li>
				<li><span class="code">CellStyleAttributes</span></li>
				<li><span class="code">ColorPersistor</span></li>
				<li><span class="code">ColumnChooserUtils</span></li>
				<li><span class="code">ColumnGroupUtils</span></li>
				<li><span class="code">EditConfigAttributes</span></li>
				<li><span class="code">EditConfigHelper</span></li>
				<li><span class="code">EditConstants</span></li>
				<li><span class="code">EditController</span></li>
				<li><span class="code">ExportConfigAttributes</span></li>
				<li><span class="code">FillHandleConfigAttributes</span></li>
				<li><span class="code">FilterRowConfigAttributes</span></li>
				<li><span class="code">FilterRowUtils</span></li>
				<li><span class="code">FreezeHelper</span></li>
				<li><span class="code">GraphicsUtils</span></li>
				<li><span class="code">GridRegion</span></li>
				<li><span class="code">GroupByConfigAttributes</span></li>
				<li><span class="code">GUIHelper</span></li>
				<li><span class="code">IFreezeConfigAttributes</span></li>
				<li><span class="code">InvertUtil</span></li>
				<li><span class="code">LayerCommandUtil</span></li>
				<li><span class="code">LayerUtil</span></li>
				<li><span class="code">MaxCellBoundsHelper</span></li>
				<li><span class="code">MenuItemProviders</span></li>
				<li><span class="code">Mode</span></li>
				<li><span class="code">MouseEventHelper</span></li>
				<li><span class="code">NatTableCSSConstants</span></li>
				<li><span class="code">NatTableCSSHelper</span></li>
				<li><span class="code">ObjectUtils</span></li>
				<li><span class="code">PersistenceHelper</span></li>
				<li><span class="code">PersistenceUtils</span></li>
				<li><span class="code">PrintConfigAttributes</span></li>
				<li><span class="code">RowGroupUtils</span></li>
				<li><span class="code">SelectionConfigAttributes</span></li>
				<li><span class="code">SelectionStyleLabels</span></li>
				<li><span class="code">SelectionUtils</span></li>
				<li><span class="code">SortConfigAttributes</span></li>
				<li><span class="code">StructuralChangeEventHelper</span></li>
				<li><span class="code">StylePersistor</span></li>
				<li><span class="code">SummaryRowConfigAttributes</span></li>
				<li><span class="code">TickUpdateConfigAttributes</span></li>
				<li><span class="code">TreeConfigAttributes</span></li>
			</ul>
		</p>
	</li>
</ul>




<!-- TODO -->
<h3>Enhancements and new features</h3>

The following features were added to NatTable:
<ul>
	<li>
		<b>Performance and memory consumption improvements</b><br/>
		<p>
			We realized that the memory consumption for NatTable instance with huge data sets is quite high. After some investigation we realized an issue with the usage of wrapper objects. To solve this we introduced
			<a href="https://www.eclipse.org/collections/">Eclipse Collections</a> as a new dependency to NatTable Core, to make use of their primitive collections. Additionally we added new methods and constructors in several
			classes that take primitive type parameters. In most cases the changes should not directly affect users, as the methods and constructors were added and existing methods were not changed. 
		</p>
		<p>
			Additional methods were added in the following classes in order to be able to operate on primitive types:
			<ul>
				<li><span class="code">AbstractColumnHideShowLayer</span></li>
				<li><span class="code">AbstractMultiColumnCommand</span></li>
				<li><span class="code">AbstractMultiRowCommand</span></li>
				<li><span class="code">ColumnEntry</span></li>
				<li><span class="code">ColumnReorderEvent</span></li>
				<li><span class="code">ColumnReorderLayer</span></li>
				<li><span class="code">ColumnStructuralChangeEvent</span></li>
				<li><span class="code">ColumnVisualChangeEvent</span></li>
				<li><span class="code">GroupModel</span></li>
				<li><span class="code">GroupMultiColumnReorderCommand</span></li>
				<li><span class="code">GroupMultiRowReorderCommand</span></li>
				<li><span class="code">HideColumnPositionsEvent</span></li>
				<li><span class="code">HideRowPositionsEvent</span></li>
				<li><span class="code">HierarchicalTreeLayer</span></li>
				<li><span class="code">MultiColumnReorderCommand</span></li>
				<li><span class="code">MultiColumnShowCommand</span></li>
				<li><span class="code">MultiRowReorderCommand</span></li>
				<li><span class="code">MultiRowShowCommand</span></li>
				<li><span class="code">PositionUtil</span></li>
				<li><span class="code">Range</span></li>
				<li><span class="code">RowGroupUtils</span></li>
				<li><span class="code">RowReorderEvent</span></li>
				<li><span class="code">RowReorderLayer</span></li>
				<li><span class="code">RowSelectionEvent</span></li>
				<li><span class="code">RowStructuralChangeEvent</span></li>
				<li><span class="code">RowVisualChangeEvent</span></li>
				<li><span class="code">SelectRowCommandHandler</span></li>
				<li><span class="code">SelectRowGroupCommandHandler</span></li>
				<li><span class="code">ShowColumnPositionsEvent</span></li>
				<li><span class="code">ShowRowPositionsEvent</span></li>
				<li><span class="code">StructuralChangeEventHelper</span></li>
				<li><span class="code">UpdateColumnGroupCollapseCommand</span></li>
				<li><span class="code">UpdateRowGroupCollapseCommand</span></li>
			</ul>
		</p>
		<p>
			The blog post <a href="http://blog.vogella.com/2020/06/25/nattable-eclipse-collections-performance-memory-improvements/">NatTable + Eclipse Collections = Performance & Memory improvements ?</a> explains the details.
		</p>
		<p>
			We also noticed that the performance of the <span class="code">ListDataProvider</span> improves if a <span class="code">MutableList</span> is used as the input <span class="code">List</span> instead of an <span class="code">ArrayList</span>.
		</p>
	</li>
	<li>
		<b>Dynamic scaling at runtime</b><br/>
		<p>
			It is now possible to configure a NatTable to support dynamic scaling (zoom in / zoom out) at runtime.
		</p>
		<p>
			To enable the UI bindings for dynamic scaling the newly introduced <span class="code">ScalingUiBindingConfiguration</span> needs to be added to the NatTable.
		</p>
		<p>
			<div class="codeBlock">natTable.addConfiguration(
    new ScalingUiBindingConfiguration(natTable));</div>
		</p>
		<p>
			This will add a <span class="code">MouseWheelListener</span> and some key bindings to zoom in/out:
			<ul>
				<li>CTRL + mousewheel up = zoom in</li>
				<li>CTRL + mousewheel down = zoom out</li>
				<li>CTRL + ‘+’ = zoom in</li>
				<li>CTRL + ‘-‘ = zoom out</li>
				<li>CTRL + ‘0’ = reset zoom</li>
			</ul>
		</p>
		<p>
			The blog post <a href="http://blog.vogella.com/2020/03/05/nattable-dynamic-scaling-enhancements/">NatTable – dynamic scaling enhancements</a> explains the new feature in more detail.
		</p>
		<p>
			The following API was added or changed visibility for the implementation:
			<ul>
				<li><span class="code">AbstractDpiConverter#scaleFactor</span></li>
				<li><span class="code">CellStyleProxy#getAttributeValue(ConfigAttribute<T>, boolean)</span></li>
				<li><span class="code">CellStyleUtil#getFont(IStyle, IConfigRegistry)</span></li>
				<li><span class="code">ConfigureScalingCommand(IDpiConverter)</span></li>
				<li><span class="code">CSSConfigureScalingCommandHandler</span></li>
				<li><span class="code">DefaultHorizontalDpiConverter</span></li>
				<li><span class="code">DefaultVerticalDpiConverter</span></li>
				<li><span class="code">FixedScalingDpiConverter</span></li>
				<li><span class="code">GUIHelper#convertHorizontalDpiToPixel(int, boolean)</span></li>
				<li><span class="code">GUIHelper#convertHorizontalDpiToPixel(int, IConfigRegistry)</span></li>
				<li><span class="code">GUIHelper#convertHorizontalPixelToDpi(int, boolean)</span></li>
				<li><span class="code">GUIHelper#convertHorizontalPixelToDpi(int, IConfigRegistry)</span></li>
				<li><span class="code">GUIHelper#convertVerticalDpiToPixel(int, boolean)</span></li>
				<li><span class="code">GUIHelper#convertVerticalDpiToPixel(int, IConfigRegistry)</span></li>
				<li><span class="code">GUIHelper#convertVerticalPixelToDpi(int, boolean)</span></li>
				<li><span class="code">GUIHelper#convertVerticalPixelToDpi(int, IConfigRegistry)</span></li>
				<li><span class="code">GUIHelper#getDisplayImage(String)</span></li>
				<li><span class="code">GUIHelper#getDisplayImageByURL(String, URL)</span></li>
				<li><span class="code">GUIHelper#getDisplayImageByURL(URL)</span></li>
				<li><span class="code">GUIHelper#getDpiX(boolean)</span></li>
				<li><span class="code">GUIHelper#getDpiY(boolean)</span></li>
				<li><span class="code">GUIHelper#getImage(String, boolean, boolean)</span></li>
				<li><span class="code">GUIHelper#getImageByURL(String, URL, boolean, boolean)</span></li>
				<li><span class="code">GUIHelper#getInternalImageUrl(String, boolean, boolean)</span></li>
				<li><span class="code">GUIHelper#getScaledFont(Font, float)</span></li>
				<li><span class="code">GUIHelper#getScalingImageSuffix(boolean)</span></li>
				<li><span class="code">GUIHelper#needScaling(boolean)</span></li>
				<li><span class="code">GUIHelper#setDpi(int, int)</span></li>
				<li><span class="code">IEditErrorHandler#displayError(ICellEditor, IConfigRegistry, Exception)</span></li>
				<li><span class="code">IStyle#getAttributeValue(ConfigAttribute<T>, T)</span></li>
				<li><span class="code">IThemeExtension#createPainterInstances()</span></li>
				<li><span class="code">NatLayerPainter#natTable</span></li>
				<li><span class="code">NatTable#configureScaling(IDpiConverter, IDpiConverter)</span></li>
				<li><span class="code">NatTableConfigAttributes</span></li>
				<li><span class="code">NoScalingDpiConverter</span></li>
				<li><span class="code">ResetScalingAction</span></li>
				<li><span class="code">ScalingMouseWheelListener</span></li>
				<li><span class="code">ScalingUiBindingConfiguration</span></li>
				<li><span class="code">ScalingUtil</span></li>
				<li><span class="code">Style(Style)</span></li>
				<li><span class="code">StyleProxy#configRegistry</span></li>
				<li><span class="code">ThemeConfiguration#createPainterInstances()</span></li>
				<li><span class="code">ThemeManager#refreshCurrentTheme()</span></li>
				<li><span class="code">ZoomInScalingAction</span></li>
				<li><span class="code">ZoomOutScalingAction</span></li>
				
			</ul>
		</p>
		<p>
			The following API was changed for the implementation:
			<ul>
				<li><span class="code">IndentedTreeImagePainter#getIndent(int) -&gt; IndentedTreeImagePainter#getIndent(int, IConfigRegistry)</span></li>
				<li><span class="code">PaddingDecorator#getInteriorBounds(Rectangle) -&gt; PaddingDecorator#getInteriorBounds(Rectangle, IConfigRegistry)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b><span class="code">LabelStack</span> is now a <span class="code">Collection</span></b><br/>
		<p>
		The <span class="code">LabelStack</span> is now a <span class="code">Collection</span>. With this it is possible to directly operate on the <span class="code">LabelStack</span> and it is not necessary
		to use <span class="code">LabelStack#getLabels()</span> anymore, which was deprecated with this change.
		</p>
	</li>
	<li>
		<b><span class="code">DisplayMode</span> is now an enumeration</b><br/>
		<p>
			The <span class="code">DisplayMode</span> is used to determine the cell state (normal, selected, hovered, edit). It was for historical reasons a String that was defined in a constants class.
			This was limiting the handling and also caused issues if people where using Strings instead of the pre-defined constants, as only those constants are handled internally. We therefore decided
			to change the String constants into an enumeration to make the API more intuitive. Additionally we can now internally use <span class="code">EnumMap</span> to increase performance when searching 
			for values in the <span class="code">ConfigRegistry.</span> 
		</p>
		<p>
			Most users should not be affected by this change. Only users that create custom layers and do not extend the existing abstract implementations will have to adjust <span class="code">getDisplayModeByPosition(int, int)</span>
			to return <span class="code">DisplayMode</span> instead of <span class="code">String</span>.
		</p>
		<p>
			The following classes/interfaces were changed for the implementation:
			<ul>
				<li><span class="code">AbstractIndexLayerTransform</span></li>
				<li><span class="code">AbstractLayer</span></li>
				<li><span class="code">AbstractLayerCell</span></li>
				<li><span class="code">AbstractLayerTransform</span></li>
				<li><span class="code">CellStyleProxy</span></li>
				<li><span class="code">CellStyleUtil</span></li>
				<li><span class="code">ConfigRegistry</span></li>
				<li><span class="code">DefaultDisplayModeOrdering</span></li>
				<li><span class="code">DisplayMode</span></li>
				<li><span class="code">IConfigRegistry</span></li>
				<li><span class="code">IDisplayModeOrdering</span></li>
				<li><span class="code">ILayer</span></li>
				<li><span class="code">ILayerCell</span></li>
				<li><span class="code">NatTableCSSHelper</span></li>
				<li><span class="code">StyleProxy</span></li>
			</ul>
			... and all <span class="code">ILayer</span> and <span class="code">ILayerCell</span> implementations that override <span class="code">ILayer#getDisplayModeByPosition(int, int)</span>/<span class="code">ILayerCell#getDisplayMode()</span>
		</p>
	</li>
	<li>
		<b><span class="code">Mode</span> is now an enumeration</b><br/>
		<p>
			The <span class="code">Mode</span> is used to switch between UI interaction modes, like from click to drag. As the classes in charge are only used internally, this should not affect users.
		</p>
		<p>
			The following classes were changed for the implementation:
			<ul>
				<li><span class="code">AbstractModeEventHandler</span></li>
				<li><span class="code">Mode</span></li>
				<li><span class="code">ModeSupport</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b><span class="code">ISearchDirection</span> is now an enumeration</b><br/>
		<p>
			The <span class="code">ISearchDirection</span> is used internally while searching for values in a NatTable. As there are only two directions possible, we changed the String constants into an enumeration.
			To follow the Java naming conventions we also renamed it to <span class="code">SearchDirection</span>.
		</p>
		<p>
			Users should only be affected by this change if they implemented custom search strategies or trigger <span class="code">SearchCommand</span>s programmatically.
		</p>
		<p>
			The following classes were changed for the implementation:
			<ul>
				<li><span class="code">AbstractSearchStrategy</span></li>
				<li><span class="code">ColumnSearchStrategy</span></li>
				<li><span class="code">GridSearchStrategy</span></li>
				<li><span class="code">RowSearchStrategy</span></li>
				<li><span class="code">SearchCommand</span></li>
				<li><span class="code">SearchDirection</span></li>
				<li><span class="code">SelectionSearchStrategy</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Make implementation of spanning easier</b><br/>
		<p>
		Via the abstract <span class="code">WrappingSpanningDataProvider</span> it is easier to add spanning to an existing table, as only the spanning logic needs to be taken care of.
		Before the whole <span class="code">ISpanningDataProvider</span> interface needed to be implemented. 
		</p>
		<p>
			<div class="codeBlock">ISpanningDataProvider dataProvider 
    = new WrappingSpanningDataProvider(bodyDataProvider) {

    @Override
    public DataCell getCellByPosition(int columnPosition, int rowPosition) {
        // TODO implement spanning logic
    }

};</div>
		</p>
	</li>
	<li>
		<b>Added commands to hide columns and rows by index</b><br/>
		<p>
		There are use cases where hide/show operations need to be executed programmatically, in which only the column/row indexes are known. To support this we introduced the following commands and command handlers:
		</p>
		<p>
			<ul>
				<li><span class="code">HideColumnByIndexCommand</span></li>
				<li><span class="code">HideColumnByIndexCommandHandler</span></li>
				<li><span class="code">HideRowByIndexCommand</span></li>
				<li><span class="code">HideRowByIndexCommandHandler</span></li>
			</ul>
		</p>
		<p>
		The command handlers are already registered with the default layers, so the execution of the command is working out of the box.
		</p>
	</li>
	<li>
		<b>Add possibility to combine filtering and row hide/show by index</b><br/>
		<p>
		Via the GlazedListsRowHideShowLayer it is possible to filter rows by row id rather than the index. This is especially useful in cases where a table also supports sorting and filtering based on GlazedLists.
		To make it easier to combine filtering with row hide/show, the following method was added:
		</p>
		<p>
			<ul>
				<li><span class="code">GlazedListsRowHideShowLayer#getHideRowMatcherEditor()</span></li>
			</ul>
		</p>
		<p>
			<div class="codeBlock">// add the filter row functionality
DefaultGlazedListsStaticFilterStrategy<ExtendedPersonWithAddress> filterStrategy =
        new DefaultGlazedListsStaticFilterStrategy<>(
                bodyLayerStack.getFilterList(),
                columnPropertyAccessor,
                configRegistry);
// connect row hide/show with filtering
filterStrategy.addStaticFilter(
    bodyLayerStack.getRowHideShowLayer().getHideRowMatcherEditor());</div>
		<p>
			The following example shows the usage:<br>
			<i><b>Tutorial Examples -&gt; Integration -&gt; EditableSortableGroupByWithFilterExample</b></i><br>
		</p>
	</li>
	<li>
		<b>Support filtering of converted data</b><br/>
		<p>
		In <a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=552575">Bug 552575</a> it was reported that a text based filter on columns whose data is shown converted, is not working correctly. To fix this we introduced the following new configuration attribute and corresponding method for the handling:
		</p>
		<p>
			<ul>
				<li><span class="code">FilterRowConfigAttributes#FILTER_CONTENT_DISPLAY_CONVERTER</span></li>
				<li><span class="code">DefaultGlazedListsFilterStrategy#getFilterContentDisplayConverter(int)</span></li>
			</ul>
		</p>
		<p>
			<div class="codeBlock">// register a date converter for the birthday column
DefaultDateDisplayConverter converter 
    = new DefaultDateDisplayConverter("yyyy-MM-dd");
configRegistry.registerConfigAttribute(
        CellConfigAttributes.DISPLAY_CONVERTER,
        converter,
        DisplayMode.NORMAL,
        ColumnLabelAccumulator.COLUMN_LABEL_PREFIX
                + DataModelConstants.BIRTHDAY_COLUMN_POSITION);

// register the same converter in the filter row as content
// converter to support text based filtering on formatted Date
// objects (e.g. filter for "-08-" to get all birthdays in August)
configRegistry.registerConfigAttribute(
        FilterRowConfigAttributes.FILTER_CONTENT_DISPLAY_CONVERTER,
        converter,
        DisplayMode.NORMAL,
        FilterRowDataLayer.FILTER_ROW_COLUMN_LABEL_PREFIX
                + DataModelConstants.BIRTHDAY_COLUMN_POSITION);</div>
		</p>
		<p>
			The following example shows the usage:<br>
			<i><b>Tutorial Examples -&gt; GlazedLists -&gt; Filter -&gt; GlazedListsFilterExample</b></i><br>
		</p>
	</li>
	<li>
		<b>Make the configuration of multi-export on the same sheet easier</b><br/>
		<p>
		To export multiple NatTable instances on the same sheet using the Apache POI extension, it was necessary to configure the exporter via 
		<span class="code">PoiExcelExporter#setExportOnSameSheet(boolean)</span> and call <span class="code">NatExporter#exportMultipleNatTables(ILayerExporter, Map<String, NatTable>, boolean, String)</span> with the appropriate parameter values.
		</p>
		<p>
		We introduced the following default method to avoid the additional configuration on the PoiExcelExporter. This way an export on the same sheet can be triggered directly by calling the appropriate method on <span class="code">NatExporter</span>.
			<ul>
				<li><span class="code">ILayerExporter#setExportOnSameSheet(boolean)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Extended the configurability of content proposals in the <span class="code">TextCellEditor</span></b><br/>
		<p>
		We added the following API to the <span class="code">TextCellEditor</span> to give a user more options on configuring content proposal support.
		</p>
		<p>
			<ul>
				<li><span class="code">TextCellEditor#autoActivationDelay</span></li>
				<li><span class="code">TextCellEditor#contentProposalAdapter</span></li>
				<li><span class="code">TextCellEditor#proposalAcceptanceStyle</span></li>
				<li><span class="code">TextCellEditor#enableContentProposal(IControlContentAdapter, IContentProposalProvider, KeyStroke, char[], int, int)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Extension of the <span class="code">ILayer</span> interface</b><br/>
		<p>
		In the past versions we introduced new methods only in the <span class="code">AbstractLayer</span> class to avoid API breakage when adding new methods in the <span class="code">ILayer</span> interface. 
		We now added those methods to the <span class="code">ILayer</span> interface to make them better integratable without multiple <span class="code">instanceof</span> checks.
		</p>
		<p>
			<ul>
				<li><span class="code">ILayer#configure(IConfigRegistry, UiBindingRegistry)</span></li>
				<li><span class="code">ILayer#getProvidedLabels()</span></li>
				<li><span class="code">ILayer#isDynamicSizeLayer()</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Updated checkbox images</b><br/>
		<p>
		We updated the checkbox images to match the current flat design of Windows. Additionally we added those images in an inverted design, to make the checkboxes better integratable with the dark theme.
		To use the inverted versions of the checkbox images, the following constructor was added to CheckBoxPainter.
		</p>
		<p>
			<ul>
				<li><span class="code">CheckBoxPainter(boolean, boolean)</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Align hide/show layer interfaces</b><br/>
		<p>
		In the cleanup process we modified several interfaces and classes related to the hide/show feature. We removed the <span class="code">IRowHideShowCommandLayer</span> and merged it with <span class="code">IRowHideShowLayer</span>.
		</p>
		<p>
			Additionally the following classes were modified to align the API.
			<ul>
				<li><span class="code">AbstractColumnHideShowLayer</span></li>
				<li><span class="code">AbstractRowHideShowLayer</span></li>
				<li><span class="code">IColumnHideShowLayer</span></li>
				<li><span class="code">IRowHideShowLayer</span></li>
				<li><span class="code">MultiRowHideCommandHandler</span></li>
				<li><span class="code">MultiRowShowCommandHandler</span></li>
				<li><span class="code">RowHideCommandHandler</span></li>
				<li><span class="code">RowPositionHideCommandHandler</span></li>
				<li><span class="code">RowShowCommandHandler</span></li>
				<li><span class="code">ShowAllRowsCommandHandler</span></li>
			</ul>
		</p>
	</li>
	<li>
		<b>Added missing style configurations in themes and CSS</b><br/>
		<p>
			We noticed that for some of the features added in the past releases, some style configurations were missing. 
		</p>
		<p>
			The following styling API was added to the NatTable Theme configuration:
			<ul>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeBgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeFgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeGradientBgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeGradientFgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeHAlign</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeVAlign</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeFont</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeImage</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeBorderStyle</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangePWEchoChar</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeTextDecoration</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionBgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionFgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionGradientBgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionGradientFgColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionHAlign</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionVAlign</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionFont</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionImage</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionBorderStyle</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionPWEchoChar</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#dataChangeSelectionTextDecoration</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#freezeSeparatorWidth</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#hideIndicatorColor</span></li>
				<li><span class="code">DefaultNatTableThemeConfiguration#hideIndicatorWidth</span></li>
				<li><span class="code">ThemeConfiguration#configureDataChangeStyle(IConfigRegistry)</span></li>
				<li><span class="code">ThemeConfiguration#configureHideIndicatorStyle(IConfigRegistry)</span></li>
				<li><span class="code">ThemeConfiguration#getDataChangeStyle()</span></li>
				<li><span class="code">ThemeConfiguration#getDataChangeSelectionStyle()</span></li>
				<li><span class="code">ThemeConfiguration#getFreezeSeparatorWidth()</span></li>
				<li><span class="code">ThemeConfiguration#getHideIndicatorColor()</span></li>
				<li><span class="code">ThemeConfiguration#getHideIndicatorWidth()</span></li>
				<li><span class="code">DefaultHierarchicalTreeLayerThemeExtension</span></li>
				<li><span class="code">ModernHierarchicalTreeLayerThemeExtension</span></li>
				<li><span class="code">DarkHierarchicalTreeLayerThemeExtension</span></li>
			</ul>
		</p>
		<p>
			The following CSS attributes were added to the CSS processing for NatTable table processing:
			<ul>
				<li><span class="code">hide-indicator-color</span></li>
				<li><span class="code">hide-indicator-width</span></li>
			</ul>
		</p>
		<p>
			Additionally we added the following methods to deal with a memory leak caused by the CSS implementation in NatTable.
		</p>
		<p>
			<ul>
				<li><span class="code">NatTableElementAdapter#dispose()</span></li>
				<li><span class="code">NatTableWrapper#dispose()</span></li>
				<li><span class="code">NatTableWrapperElementAdapter#dispose()</span></li>
			</ul>
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