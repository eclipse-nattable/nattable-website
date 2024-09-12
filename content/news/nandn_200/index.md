---
title: "NatTable 2.0.0 - New & Noteworthy"
date: 2020-12-16T00:00:00-00:00
summary: "Nebula NatTable 2.0.0 released"
categories: ["news"]
---

The NatTable 2.0.0 release is a major update that

*   Updates the license to EPLv2
*   Updates the minimum required Java version to Java 8 (BREE = JavaSE-1.8)
*   Updates third-party dependencies
*   Cleans up the code base

We would like to thank everyone involved for their commitment and support on developing the 2.0.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

We also removed the extension.builder from the sources, as it was never published and not maintained for several years.

Despite the modifications named above there are numerous bugfixes related to issues on concurrency, scaling, percentage sizing or performance and memory consumption.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.0.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=2.0.0).

### Third-Party-Dependencies Update

There are several changes to the dependencies of NatTable Core and the NatTable Extensions.

#### Updated libraries

*   GlazedLists 1.11
*   Apache POI 4.1.1
*   Nebula RichText 1.4.0
*   Nebula CDateTime 1.5.0

#### Added libraries

*   Apache Commons Collections4 (transitive dependency of Apache POI 4.1.1)
*   Apache Commons Math3 (transitive dependency of Apache POI 4.1.1)
*   Eclipse Collections 10.4.0
*   SLF4J API

#### Removed libraries

*   Apache Commons Logging

### API changes

The code base was cleanup up to increase the maintainability. In this process several classes, methods, fields and constructors were removed that were marked deprecated for a while. Additionally with the increase of the BREE to JavaSE-1.8 we could remove custom functional interfaces that were used internally and remove them with the default Java functional interfaces.

We now also have a Sonar analysis running. You can find the analysis report [here](https://sonarcloud.io/dashboard?id=org.eclipse.nebula.widgets.nattable%3Aparent).  
In this section the API additions that resulted from the Sonar analysis results are listed. All other additions and API modifications caused by new features are listed in the corresponding feature section.

*   **Removed classes**  
    
    *   `ActiveCellEditorRegistry`  
        This static registry was replaced with an instance field in NatTable.
    *   `BodyCellEditorMouseEventMatcher`  
        Replaced with `CellEditorMouseEventMatcher`
    *   `CellEditDragMode`  
        Intended handling is now done internally in `DragModeEventHandler`
    *   `ColumnGroupMenuItemProviders`  
        Moved to `MenuItemProviders` and `PopupMenuBuilder`
    *   `IRowHideShowCommandLayer`  
        Merged with `IRowHideShowLayer`
    *   `RowSelectionPreserver`  
        Functionality can be added by using the `RowSelectionModel`
    *   `SelectionLayerPainter#ApplyBorderFunction`  
        Replaced with `java.util.function.Function`
    *   `SelectionLayerStructuralChangeEventHandler`  
        Unnecessary as `ISelectionModel` is itself an `ILayerEventHandler`
    
*   **Removed methods**  
    
    *   `AbstractModeEventHandler#eventOnSameCell(MouseEvent, MouseEvent)`  
        Replaced with `MouseEventHelper#eventOnSameCell(ILayer, MouseEvent, MouseEvent)`
    *   `AbstractTreeRowModel#getObjectAtIndexAndDepth(int, int)`  
        Formatting should be performed in a configured `IExportFormatter`
    *   `CellPainterDecorator#setBaseCellPainterSpansWholeCell(boolean)`  
        Replaced with `CellPainterDecorator#setPaintDecorationDependent(boolean)`
    *   `ColumnHeaderLayer#getSelectionLayer`  
        `SelectionLayer` should be accessed via body.
    *   `CopySelectionLayerPainter#applyCopyBorderStyle`  
        Replaced with `CopySelectionLayerPainter#getCopyBorderStyle` to switch from an action to a supplier mechanism
    *   `EditUtils#commitAndCloseActiveEditor()`  
        Replaced with `NatTable#commitAndCloseActiveCellEditor()`
    *   `EditUtils#isCellEditable(ILayer, IConfigRegistry, PositionCoordinate)`  
        Replaced with `EditUtils#isCellEditable(PositionCoordinate, IConfigRegistry)`
    *   `EventConflaterChain(int, int)`  
        Replaced with `EventConflaterChain(long, long)`
    *   `FillHandleLayerPainter#applyCopyBorderStyle`  
        Replaced with `FillHandleLayerPainter#getCopyBorderStyle` to switch from an action to a supplier mechanism
    *   `FillHandleLayerPainter#applyHandleBorderStyle`  
        Replaced with `FillHandleLayerPainter#getHandleRegionBorderStyle` to switch from an action to a supplier mechanism
    *   `FillHandleLayerPainter#applyHandleStyle`  
        Replaced with `FillHandleLayerPainter#getHandleColor` and FillHandleLayerPainter#getHandleBorderStyle` to switch from an action to a supplier mechanism
    *   `FilterRowComboBoxDataProvider#removeCacheUdpateListener`  
        Replaced with `FilterRowComboBoxDataProvider#removeCacheUpdateListener`
    *   `GlazedListTreeData` - expand/collapse methods  
        expand/collapse operations are performed on the `ITreeRowModel`
    *   `GlazedListTreeData#formatDataForDepth(int, int)`  
        Formatting should be performed in a configured `IExportFormatter`
    *   `GlazedListTreeData#formatDataForDepth(int, T)`  
        Formatting should be performed in a configured `IExportFormatter`
    *   `GridLineCellLayerPainter#drawGridLines(ILayer, GC, Rectangle, IConfigRegistry)`  
        Replaced with `GridLineCellLayerPainter#drawGridLines(ILayer, GC, Rectangle, IConfigRegistry, List)`
    *   `GroupByDataLayer#getElementsInGroup(GroupByObject)`  
        Replaced with `GroupByDataLayer#getItemsInGroup(GroupByObject)`
    *   `GroupByDataLayer#setSortModel(ISortModel)`  
        Replaced with `GroupByDataLayer#initializeTreeComparator(ISortModel, IUniqueIndexLayer, boolean)`
    *   `GUIHelper#getImage(ImageData)`  
        No direct replacement as the function with the `ImageData` parameter was never functional
    *   `ITreeData#formatDataForDepth(int, int)`  
        Formatting should be performed in a configured `IExportFormatter`
    *   `ITreeData#formatDataForDepth(int, T)`  
        Formatting should be performed in a configured `IExportFormatter`
    *   `ITreeRowModel#getObjectAtIndexAndDepth(int, int)`  
        Formatting should be performed in a configured `IExportFormatter`
    *   `SelectionLayerPainter#applyBorderStyle`  
        Replaced with `SelectionLayerPainter#getBorderStyle` to switch from an action to a supplier mechanism
    *   `SelectionLayerPainter#getBorderCells(ILayer, int, int, Rectangle, ApplyBorderFunction)`  
        Replaced with `SelectionLayerPainter#getBorderCells(ILayer, int, int, Rectangle, Function)`
    *   `SizeConfig#correctPercentageValues(int, int)`  
        Replaced with `SizeConfig#correctPercentageValues(double, int)`
    *   `TextCellEditor#setErrorDecorationText(String)`  
        Error decorations are applied by using the `RenderErrorHandling`
    *   `TreeLayer#getTreeImagePainter`  
        The `TreeImagePainter` configured via `IConfigRegistry` is used instead
    *   `TreeRowModel#clear`  
        Not specified by `ITreeRowModel`
    
*   **Removed fields**  
    
    *   `FillHandleDragMode#startIndex`  
        Use `FillHandleDragMode#startPosition` that is relative to the `SelectionLayer` instead
    *   `NatCombo#style`  
        Replaced with `NatCombo#widgetStyle`
    
*   **Removed constructors**  
    
    *   `BodyMenuConfigurationNatTable, ILayer)`
    *   `ColumnGroupGroupHeaderLayer` - Removed the unused `SelectionLayer` parameter
    *   `ColumnGroupHeaderTextPainter` - All constructors with `ColumnGroupModel` parameter
    *   `ColumnReorderEvent` - All constructors without explicit index parameters
    *   `ColumnSelectionEvent(SelectionLayer, int)`
    *   `DefaultRowGroupHeaderLayerConfiguration(IRowGroupModel)`
    *   `IndentedTreeImagePainter` - All constructors with `ITreeRowModel` parameter
    *   `InlineCellEditEvent(ILayer, PositionCoordinate, Composite, IConfigRegistry, Object)`
    *   `RowGroupHeaderTextPainter` - All constructors with `IRowGroupModel` parameter
    *   `RowReorderEvent` - All constructors without explicit index parameters
    *   `RowSelectionEvent(SelectionLayer, Collection, int)`
    *   `SelectionLayer(IUniqueIndexLayer, ISelectionModel, boolean, boolean)`
    *   `ShowCellInViewportCommand(ILayer, int, int)`
    *   `ShowColumnInViewportCommand(ILayer, int, int)`
    *   `ShowRowInViewportCommand(ILayer, int, int)`
    *   `TreeImagePainter` - All constructors with `ITreeRowModel` parameter
    
*   **Added methods**  
    
    The following methods were added to fix user reported bugs and issues reported by Sonar.
    
    *   `ColumnCategoriesDialog#addListener(IColumnCategoriesDialogListener)`
    *   `ColumnCategoriesDialog#removeListener(IColumnCategoriesDialogListener)`
    *   `ColumnChooserDialog#addListener(ISelectionTreeListener)`
    *   `ColumnChooserDialog#removeListener(ISelectionTreeListener)`
    *   `ColumnChooserDialog#populateAvailableTree(List, ColumnGroupModel, boolean)`
    *   `ColumnChooserDialog#populateAvailableTree(List, ColumnGroupHeaderLayer, boolean)`
    *   `HideIndicatorOverlayPainter#setLayerOnTop(ILayer)`
    *   `HideIndicatorOverlayPainter#setLayerToLeft(ILayer)`
    
*   **Added constants**  
    
    *   `FormulaParser` - All regular expressions are now defined as `public static final` constants
    
*   **Added constructors**  
    
    *   `ComboBoxFilterRowConfiguration(ICellEditor, ImagePainter)`
    *   `HierarchicalWrapper(HierarchicalWrapper)`
    
*   **Modified helper classes and constants interfaces**  
    
    According to best practices all helper classes with static helper methods are now final and have a private default constructor to avoid sub-classing and instantiating. Additionally all constants interfaces are changed to constants classes to avoid that these interfaces are implemented.
    
    If the helper classes and constants interfaces were used as intended, this change should not affect users. If those classes were extended or the interfaces implemented (which was never the intended usage) you will need to adjust your code.
    
    At least two changes will cause compilation errors if you are using the according feature:
    
    *   `RowOnlySelectionConfiguration` - removed the unnecessary generic
    *   `FreezeConfigAttributes` - renamed to `FreezeConfigAttributes`
    
    The following list contains all modified interfaces and classes:
    
    *   `ArrayUtil`
    *   `BlinkConfigAttributes`
    *   `CellConfigAttributes`
    *   `CellDisplayConversionUtils`
    *   `CellDisplayValueSearchUtil`
    *   `CellEdgeDetectUtil`
    *   `CellEditDialogFactory`
    *   `CellStyleAttributes`
    *   `ColorPersistor`
    *   `ColumnChooserUtils`
    *   `ColumnGroupUtils`
    *   `EditConfigAttributes`
    *   `EditConfigHelper`
    *   `EditConstants`
    *   `EditController`
    *   `ExportConfigAttributes`
    *   `FillHandleConfigAttributes`
    *   `FilterRowConfigAttributes`
    *   `FilterRowUtils`
    *   `FreezeHelper`
    *   `GraphicsUtils`
    *   `GridRegion`
    *   `GroupByConfigAttributes`
    *   `GUIHelper`
    *   `IFreezeConfigAttributes`
    *   `InvertUtil`
    *   `LayerCommandUtil`
    *   `LayerUtil`
    *   `MaxCellBoundsHelper`
    *   `MenuItemProviders`
    *   `Mode`
    *   `MouseEventHelper`
    *   `NatTableCSSConstants`
    *   `NatTableCSSHelper`
    *   `ObjectUtils`
    *   `PersistenceHelper`
    *   `PersistenceUtils`
    *   `PrintConfigAttributes`
    *   `RowGroupUtils`
    *   `SelectionConfigAttributes`
    *   `SelectionStyleLabels`
    *   `SelectionUtils`
    *   `SortConfigAttributes`
    *   `StructuralChangeEventHelper`
    *   `StylePersistor`
    *   `SummaryRowConfigAttributes`
    *   `TickUpdateConfigAttributes`
    *   `TreeConfigAttributes`
    

### Enhancements and new features

The following features were added to NatTable:

*   **Performance and memory consumption improvements**  
    
    We realized that the memory consumption for NatTable instance with huge data sets is quite high. After some investigation we realized an issue with the usage of wrapper objects. To solve this we introduced [Eclipse Collections](https://www.eclipse.org/collections/) as a new dependency to NatTable Core, to make use of their primitive collections. Additionally we added new methods and constructors in several classes that take primitive type parameters. In most cases the changes should not directly affect users, as the methods and constructors were added and existing methods were not changed.
    
    Additional methods were added in the following classes in order to be able to operate on primitive types:
    
    *   `AbstractColumnHideShowLayer`
    *   `AbstractMultiColumnCommand`
    *   `AbstractMultiRowCommand`
    *   `ColumnEntry`
    *   `ColumnReorderEvent`
    *   `ColumnReorderLayer`
    *   `ColumnStructuralChangeEvent`
    *   `ColumnVisualChangeEvent`
    *   `GroupModel`
    *   `GroupMultiColumnReorderCommand`
    *   `GroupMultiRowReorderCommand`
    *   `HideColumnPositionsEvent`
    *   `HideRowPositionsEvent`
    *   `HierarchicalTreeLayer`
    *   `MultiColumnReorderCommand`
    *   `MultiColumnShowCommand`
    *   `MultiRowReorderCommand`
    *   `MultiRowShowCommand`
    *   `PositionUtil`
    *   `Range`
    *   `RowGroupUtils`
    *   `RowReorderEvent`
    *   `RowReorderLayer`
    *   `RowSelectionEvent`
    *   `RowStructuralChangeEvent`
    *   `RowVisualChangeEvent`
    *   `SelectRowCommandHandler`
    *   `SelectRowGroupCommandHandler`
    *   `ShowColumnPositionsEvent`
    *   `ShowRowPositionsEvent`
    *   `StructuralChangeEventHelper`
    *   `UpdateColumnGroupCollapseCommand`
    *   `UpdateRowGroupCollapseCommand`
    
    The blog post [NatTable + Eclipse Collections = Performance & Memory improvements ?](http://blog.vogella.com/2020/06/25/nattable-eclipse-collections-performance-memory-improvements/) explains the details.
    
    We also noticed that the performance of the `ListDataProvider` improves if a `MutableList` is used as the input `List` instead of an `ArrayList`.
    
*   **Dynamic scaling at runtime**  
    
    It is now possible to configure a NatTable to support dynamic scaling (zoom in / zoom out) at runtime.
    
    To enable the UI bindings for dynamic scaling the newly introduced `ScalingUiBindingConfiguration` needs to be added to the NatTable.
    
    ```java 
    natTable.addConfiguration( 
        new ScalingUiBindingConfiguration(natTable));
    ```
    
    This will add a `MouseWheelListener` and some key bindings to zoom in/out:
    
    *   CTRL + mousewheel up = zoom in
    *   CTRL + mousewheel down = zoom out
    *   CTRL + ‘+’ = zoom in
    *   CTRL + ‘-‘ = zoom out
    *   CTRL + ‘0’ = reset zoom
    
    The blog post [NatTable – dynamic scaling enhancements](http://blog.vogella.com/2020/03/05/nattable-dynamic-scaling-enhancements/) explains the new feature in more detail.
    
    The following API was added or changed visibility for the implementation:
    
    *   `AbstractDpiConverter#scaleFactor`
    *   `CellStyleProxy#getAttributeValue(ConfigAttribute, boolean)`
    *   `CellStyleUtil#getFont(IStyle, IConfigRegistry)`
    *   `ConfigureScalingCommand(IDpiConverter)`
    *   `CSSConfigureScalingCommandHandler`
    *   `DefaultHorizontalDpiConverter`
    *   `DefaultVerticalDpiConverter`
    *   `FixedScalingDpiConverter`
    *   `GUIHelper#convertHorizontalDpiToPixel(int, boolean)`
    *   `GUIHelper#convertHorizontalDpiToPixel(int, IConfigRegistry)`
    *   `GUIHelper#convertHorizontalPixelToDpi(int, boolean)`
    *   `GUIHelper#convertHorizontalPixelToDpi(int, IConfigRegistry)`
    *   `GUIHelper#convertVerticalDpiToPixel(int, boolean)`
    *   `GUIHelper#convertVerticalDpiToPixel(int, IConfigRegistry)`
    *   `GUIHelper#convertVerticalPixelToDpi(int, boolean)`
    *   `GUIHelper#convertVerticalPixelToDpi(int, IConfigRegistry)`
    *   `GUIHelper#getDisplayImage(String)`
    *   `GUIHelper#getDisplayImageByURL(String, URL)`
    *   `GUIHelper#getDisplayImageByURL(URL)`
    *   `GUIHelper#getDpiX(boolean)`
    *   `GUIHelper#getDpiY(boolean)`
    *   `GUIHelper#getImage(String, boolean, boolean)`
    *   `GUIHelper#getImageByURL(String, URL, boolean, boolean)`
    *   `GUIHelper#getInternalImageUrl(String, boolean, boolean)`
    *   `GUIHelper#getScaledFont(Font, float)`
    *   `GUIHelper#getScalingImageSuffix(boolean)`
    *   `GUIHelper#needScaling(boolean)`
    *   `GUIHelper#setDpi(int, int)`
    *   `IEditErrorHandler#displayError(ICellEditor, IConfigRegistry, Exception)`
    *   `IStyle#getAttributeValue(ConfigAttribute, T)`
    *   `IThemeExtension#createPainterInstances()`
    *   `NatLayerPainter#natTable`
    *   `NatTable#configureScaling(IDpiConverter, IDpiConverter)`
    *   `NatTableConfigAttributes`
    *   `NoScalingDpiConverter`
    *   `ResetScalingAction`
    *   `ScalingMouseWheelListener`
    *   `ScalingUiBindingConfiguration`
    *   `ScalingUtil`
    *   `Style(Style)`
    *   `StyleProxy#configRegistry`
    *   `ThemeConfiguration#createPainterInstances()`
    *   `ThemeManager#refreshCurrentTheme()`
    *   `ZoomInScalingAction`
    *   `ZoomOutScalingAction`
    
    The following API was changed for the implementation:
    
    *   `IndentedTreeImagePainter#getIndent(int) -> IndentedTreeImagePainter#getIndent(int, IConfigRegistry)`
    *   `PaddingDecorator#getInteriorBounds(Rectangle) -> PaddingDecorator#getInteriorBounds(Rectangle, IConfigRegistry)`
    
*   **`LabelStack` is now a `Collection`**  
    
    The `LabelStack` is now a `Collection`. With this it is possible to directly operate on the `LabelStack` and it is not necessary to use `LabelStack#getLabels()` anymore, which was deprecated with this change.
    
*   **`DisplayMode` is now an enumeration**  
    
    The `DisplayMode` is used to determine the cell state (normal, selected, hovered, edit). It was for historical reasons a String that was defined in a constants class. This was limiting the handling and also caused issues if people where using Strings instead of the pre-defined constants, as only those constants are handled internally. We therefore decided to change the String constants into an enumeration to make the API more intuitive. Additionally we can now internally use `EnumMap` to increase performance when searching for values in the `ConfigRegistry.`
    
    Most users should not be affected by this change. Only users that create custom layers and do not extend the existing abstract implementations will have to adjust `getDisplayModeByPosition(int, int)` to return `DisplayMode` instead of `String`.
    
    The following classes/interfaces were changed for the implementation:
    
    *   `AbstractIndexLayerTransform`
    *   `AbstractLayer`
    *   `AbstractLayerCell`
    *   `AbstractLayerTransform`
    *   `CellStyleProxy`
    *   `CellStyleUtil`
    *   `ConfigRegistry`
    *   `DefaultDisplayModeOrdering`
    *   `DisplayMode`
    *   `IConfigRegistry`
    *   `IDisplayModeOrdering`
    *   `ILayer`
    *   `ILayerCell`
    *   `NatTableCSSHelper`
    *   `StyleProxy`
    
    ... and all `ILayer` and `ILayerCell` implementations that override `ILayer#getDisplayModeByPosition(int, int)`/`ILayerCell#getDisplayMode()`
    
*   **`Mode` is now an enumeration**  
    
    The `Mode` is used to switch between UI interaction modes, like from click to drag. As the classes in charge are only used internally, this should not affect users.
    
    The following classes were changed for the implementation:
    
    *   `AbstractModeEventHandler`
    *   `Mode`
    *   `ModeSupport`
    
*   **`ISearchDirection` is now an enumeration**  
    
    The `ISearchDirection` is used internally while searching for values in a NatTable. As there are only two directions possible, we changed the String constants into an enumeration. To follow the Java naming conventions we also renamed it to `SearchDirection`.
    
    Users should only be affected by this change if they implemented custom search strategies or trigger `SearchCommand`s programmatically.
    
    The following classes were changed for the implementation:
    
    *   `AbstractSearchStrategy`
    *   `ColumnSearchStrategy`
    *   `GridSearchStrategy`
    *   `RowSearchStrategy`
    *   `SearchCommand`
    *   `SearchDirection`
    *   `SelectionSearchStrategy`
    
*   **Make implementation of spanning easier**  
    
    Via the abstract `WrappingSpanningDataProvider` it is easier to add spanning to an existing table, as only the spanning logic needs to be taken care of. Before the whole `ISpanningDataProvider` interface needed to be implemented.
    
    ```java 
    ISpanningDataProvider dataProvider = 
        new WrappingSpanningDataProvider(bodyDataProvider) { 
            @Override 
            public DataCell getCellByPosition(int columnPosition, int rowPosition) { 
                // TODO implement spanning logic 
            } 
        };
    ```
    
*   **Added commands to hide columns and rows by index**  
    
    There are use cases where hide/show operations need to be executed programmatically, in which only the column/row indexes are known. To support this we introduced the following commands and command handlers:
    
    *   `HideColumnByIndexCommand`
    *   `HideColumnByIndexCommandHandler`
    *   `HideRowByIndexCommand`
    *   `HideRowByIndexCommandHandler`
    
    The command handlers are already registered with the default layers, so the execution of the command is working out of the box.
    
*   **Add possibility to combine filtering and row hide/show by index**  
    
    Via the GlazedListsRowHideShowLayer it is possible to filter rows by row id rather than the index. This is especially useful in cases where a table also supports sorting and filtering based on GlazedLists. To make it easier to combine filtering with row hide/show, the following method was added:
    
    *   `GlazedListsRowHideShowLayer#getHideRowMatcherEditor()`
    
    ```java 
    // add the filter row functionality 
    DefaultGlazedListsStaticFilterStrategy filterStrategy = 
        new DefaultGlazedListsStaticFilterStrategy<>( 
            bodyLayerStack.getFilterList(), 
            columnPropertyAccessor, 
            configRegistry); 
            
    // connect row hide/show with filtering 
    filterStrategy.addStaticFilter( 
        bodyLayerStack.getRowHideShowLayer().getHideRowMatcherEditor());
    ```
    
    The following example shows the usage:  
    _**Tutorial Examples -> Integration -> EditableSortableGroupByWithFilterExample**_  
    
*   **Support filtering of converted data**  
    
    In [Bug 552575](https://bugs.eclipse.org/bugs/show_bug.cgi?id=552575) it was reported that a text based filter on columns whose data is shown converted, is not working correctly. To fix this we introduced the following new configuration attribute and corresponding method for the handling:
    
    *   `FilterRowConfigAttributes#FILTER\_CONTENT\_DISPLAY\_CONVERTER`
    *   `DefaultGlazedListsFilterStrategy#getFilterContentDisplayConverter(int)`
    
    ```java 
    // register a date converter for the birthday column 
    DefaultDateDisplayConverter converter = 
        new DefaultDateDisplayConverter("yyyy-MM-dd"); 
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
            + DataModelConstants.BIRTHDAY_COLUMN_POSITION);
    ```
    
    The following example shows the usage:  
    _**Tutorial Examples -> GlazedLists -> Filter -> GlazedListsFilterExample**_  
    
*   **Make the configuration of multi-export on the same sheet easier**  
    
    To export multiple NatTable instances on the same sheet using the Apache POI extension, it was necessary to configure the exporter via `PoiExcelExporter#setExportOnSameSheet(boolean)` and call `NatExporter#exportMultipleNatTables(ILayerExporter, Map, boolean, String)` with the appropriate parameter values.
    
    We introduced the following default method to avoid the additional configuration on the PoiExcelExporter. This way an export on the same sheet can be triggered directly by calling the appropriate method on `NatExporter`.
    
    *   `ILayerExporter#setExportOnSameSheet(boolean)`
    
*   **Extended the configurability of content proposals in the `TextCellEditor`**  
    
    We added the following API to the `TextCellEditor` to give a user more options on configuring content proposal support.
    
    *   `TextCellEditor#autoActivationDelay`
    *   `TextCellEditor#contentProposalAdapter`
    *   `TextCellEditor#proposalAcceptanceStyle`
    *   `TextCellEditor#enableContentProposal(IControlContentAdapter, IContentProposalProvider, KeyStroke, char\[\], int, int)`
    
*   **Extension of the `ILayer` interface**  
    
    In the past versions we introduced new methods only in the `AbstractLayer` class to avoid API breakage when adding new methods in the `ILayer` interface. We now added those methods to the `ILayer` interface to make them better integratable without multiple `instanceof` checks.
    
    *   `ILayer#configure(IConfigRegistry, UiBindingRegistry)`
    *   `ILayer#getProvidedLabels()`
    *   `ILayer#isDynamicSizeLayer()`
    
*   **Updated checkbox images**  
    
    We updated the checkbox images to match the current flat design of Windows. Additionally we added those images in an inverted design, to make the checkboxes better integratable with the dark theme. To use the inverted versions of the checkbox images, the following constructor was added to CheckBoxPainter.
    
    *   `CheckBoxPainter(boolean, boolean)`
    
*   **Align hide/show layer interfaces**  
    
    In the cleanup process we modified several interfaces and classes related to the hide/show feature. We removed the `IRowHideShowCommandLayer` and merged it with `IRowHideShowLayer`.
    
    Additionally the following classes were modified to align the API.
    
    *   `AbstractColumnHideShowLayer`
    *   `AbstractRowHideShowLayer`
    *   `IColumnHideShowLayer`
    *   `IRowHideShowLayer`
    *   `MultiRowHideCommandHandler`
    *   `MultiRowShowCommandHandler`
    *   `RowHideCommandHandler`
    *   `RowPositionHideCommandHandler`
    *   `RowShowCommandHandler`
    *   `ShowAllRowsCommandHandler`
    
*   **Added missing style configurations in themes and CSS**  
    
    We noticed that for some of the features added in the past releases, some style configurations were missing.
    
    The following styling API was added to the NatTable Theme configuration:
    
    *   `DefaultNatTableThemeConfiguration#dataChangeBgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeFgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeGradientBgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeGradientFgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeHAlign`
    *   `DefaultNatTableThemeConfiguration#dataChangeVAlign`
    *   `DefaultNatTableThemeConfiguration#dataChangeFont`
    *   `DefaultNatTableThemeConfiguration#dataChangeImage`
    *   `DefaultNatTableThemeConfiguration#dataChangeBorderStyle`
    *   `DefaultNatTableThemeConfiguration#dataChangePWEchoChar`
    *   `DefaultNatTableThemeConfiguration#dataChangeTextDecoration`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionBgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionFgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionGradientBgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionGradientFgColor`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionHAlign`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionVAlign`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionFont`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionImage`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionBorderStyle`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionPWEchoChar`
    *   `DefaultNatTableThemeConfiguration#dataChangeSelectionTextDecoration`
    *   `DefaultNatTableThemeConfiguration#freezeSeparatorWidth`
    *   `DefaultNatTableThemeConfiguration#hideIndicatorColor`
    *   `DefaultNatTableThemeConfiguration#hideIndicatorWidth`
    *   `ThemeConfiguration#configureDataChangeStyle(IConfigRegistry)`
    *   `ThemeConfiguration#configureHideIndicatorStyle(IConfigRegistry)`
    *   `ThemeConfiguration#getDataChangeStyle()`
    *   `ThemeConfiguration#getDataChangeSelectionStyle()`
    *   `ThemeConfiguration#getFreezeSeparatorWidth()`
    *   `ThemeConfiguration#getHideIndicatorColor()`
    *   `ThemeConfiguration#getHideIndicatorWidth()`
    *   `DefaultHierarchicalTreeLayerThemeExtension`
    *   `ModernHierarchicalTreeLayerThemeExtension`
    *   `DarkHierarchicalTreeLayerThemeExtension`
    
    The following CSS attributes were added to the CSS processing for NatTable table processing:
    
    *   `hide-indicator-color`
    *   `hide-indicator-width`
    
    Additionally we added the following methods to deal with a memory leak caused by the CSS implementation in NatTable.
    
    *   `NatTableElementAdapter#dispose()`
    *   `NatTableWrapper#dispose()`
    *   `NatTableWrapperElementAdapter#dispose()`