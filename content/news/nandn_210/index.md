---
title: "NatTable 2.1.0 - New & Noteworthy"
date: 2023-03-27T00:00:00-00:00
summary: "Nebula NatTable 2.1.0 released"
categories: ["news"]
---

The NatTable 2.1.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. We would like to thank everyone involved for their commitment and support on developing the 2.1.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Despite the enhancements and new features there are numerous bugfixes related to issues on filtering.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.1.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=2.1.0).

### Dependency changes

The dependency to Nebula, to consume the RichText control for example, was updated to Nebula 3.0 to consume a bugfix related to the vertical alignment in NatTable. Nebula 3.0 updated the minimum required Java version to Java 11. This means, if you consume all NatTable features and dependencies via the NatTable Update Site, you will need Java 11 as runtime because of the updated Nebula requirements. The NatTable bundles have **NOT** updated the minimum requirement to Java 11. So you can still setup an application that runs with Java 8 if you don't use the Nebula Extension or use a Nebula version before 3.0.

### API changes

*   Several modifications were made to increase the extensibility of NatTable. Some additional methods are added and the visibility of some existing methods is increased. Existing code should work unchanged.  
    Below is the list of those methods, the details can be found in the _Enhancements and new features_ section.
    
    *   `CellSelectionEvent#isForcingEntireCellIntoViewport()`
    *   `ComboBoxGlazedListsFilterStrategy#hasComboBoxFilterEditorRegistered()`
    *   `CompositeFreezeLayer#modifyColumnSpanLayerCell(ILayerCell)`
    *   `CompositeFreezeLayer#modifyRowSpanLayerCell(ILayerCell)`
    *   `FilterAppliedEvent#getColumnIndex()`
    *   `FilterAppliedEvent#getNewValue()`
    *   `FilterAppliedEvent#getOldValue()`
    *   `FilterAppliedEvent#isCleared()`
    *   `FilterAppliedEvent#isFilterComboEditor()`
    *   `FilterAppliedEvent#setCleared(boolean)`
    *   `FilterAppliedEvent#setFilterComboEditor(boolean)`
    *   `FilterNatCombo#setFilterModifyAction(Runnable)`
    *   `FilterRowComboBoxCellEditor#configureDropdownFilter(boolean, boolean)`
    *   `FilterRowComboBoxDataProvider#getAllValues(int)`
    *   `FilterRowComboBoxDataProvider#getValues(Collection, int, Map, ReadWriteLock)`
    *   `FilterRowComboBoxDataProvider#collectValuesForColumn(int)`
    *   `FilterRowComboBoxDataProvider#collectValues(Collection, int)`
    *   `FilterRowComboBoxDataProvider#updateCache(int)`
    *   `FilterRowComboBoxDataProvider#updateCache(int, Map, ReadWriteLock)`
    *   `FilterRowComboBoxDataProvider#clearCache(boolean)`
    *   `FilterRowComboBoxDataProvider#clearCache(Map, ReadWriteLock, boolean)`
    *   `FilterRowComboBoxDataProvider#isEventFromBodyLayer(ILayerEvent)`
    *   `FilterRowComboBoxDataProvider#isFilterChanged(int, Object, Object)`
    *   `FilterRowComboBoxDataProvider#buildUpdateEvent(FilterRowComboUpdateEvent, int, List, List)`
    *   `FilterRowComboBoxDataProvider#isDistinctNullAndEmpty()`
    *   `FilterRowComboBoxDataProvider#setDistinctNullAndEmpty(boolean)`
    *   `FilterRowComboBoxDataProvider#getFilterCollection()`
    *   `FilterRowComboBoxDataProvider#setFilterCollection(Collection, ILayer)`
    *   `FilterRowComboBoxDataProvider#setLastFilter(int, Collection)`
    *   `FilterRowComboBoxDataProvider#doCommand(ILayer, UpdateDataCommand)`
    *   `FilterRowComboBoxDataProvider#getCommandClass()`
    *   `FilterRowComboUpdateEvent#addUpdate(int, Collection, Collection)`
    *   `FilterRowComboUpdateEvent#getColumnIndex(int)`
    *   `FilterRowComboUpdateEvent#getAddedItems(int)`
    *   `FilterRowComboUpdateEvent#getRemovedItems(int)`
    *   `FilterRowComboUpdateEvent#updateContentSize()`
    *   `FilterRowDataProvider#getFilterStrategy()`
    *   `FilterRowDataProvider#setFilterRowComboBoxDataProvider(FilterRowComboBoxDataProvider)`
    *   `FilterRowUtils#getSeparatorCharacters(String)`
    *   `GlazedListsFilterRowComboBoxDataProvider#activate()`
    *   `GlazedListsFilterRowComboBoxDataProvider#deactivate()`
    *   `GlazedListsFilterRowComboBoxDataProvider#discardEventsToProcess()`
    *   `GlazedListsFilterRowComboBoxDataProvider#isActive()`
    *   `GlazedListsFilterRowComboBoxDataProvider#isDisposed()`
    *   `GroupByDataLayer#enableFilterSupport(FilterRowDataProvider)`
    *   `HoverLayer#setCurrentHoveredCellByIndex(int, int)`
    *   `NatCombo#setDropdownFilterKeyListener(KeyListener)`
    *   `NatCombo#setDropdownFilterModifyListener(ModifyListener)`
    *   `ObjectUtils#collectionsEqual(Collection, Collection)`
    *   `PoiExcelExporter#getDataFormatString(Object, ILayerCell, IConfigRegistry)`
    *   `RichTextCellPainter#getHtmlText(ILayerCell, IConfigRegistry)`
    *   `UpdateDataCommand#setNewValue(Object)`
    *   `ViewportLayer#getOriginColumnPosition()`
    *   `ViewportLayer#getOriginRowPosition()`
    
    Below is the list of new constructors
    *   `CellPainterMouseEventMatcher(int, String, int, ICellPainter)`
    *   `CellPainterMouseEventMatcher(int, String, int, Class)`
    *   `CellSelectionEvent(SelectionLayer, int, int, boolean, boolean, boolean)`
    *   `ComboBoxFilterRowConfiguration(ICellEditor, ImagePainter, IComboBoxDataProvider)`
    *   `IdIndexKeyHandler(IRowDataProvider, IRowIdAccessor, Class)`
    *   `FilterAppliedEvent(ILayer, boolean)`
    *   `FilterAppliedEvent(ILayer, int, Object, Object, boolean)`
    *   `FilterRowPainter(ICellPainter, ImagePainter)`
    *   `ShowColumnInViewportCommand(ILayer, int)`
    *   `ShowColumnInViewportCommand(ShowColumnInViewportCommand)`
*   Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name. Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for bugfixing.
    *   `ComboBoxFilterRowConfiguration#comboBoxDataProvider`
    *   `ComboBoxFilterRowConfiguration#filterRowPainter`
    *   `ExportConfigAttributes#NUMBER_FORMAT`
    *   `FilterRowDataProvider#COMMA_REPLACEMENT`
    *   `FilterRowDataProvider#EMPTY_REPLACEMENT`
    *   `FilterRowDataProvider#NULL_REPLACEMENT`
    *   `GroupByHeaderMenuConfiguration#groupByHeaderLayer`
    *   `GroupModel#PIPE_REPLACEMENT`

### Enhancements and new features

*   **Excel-like filter - Enhancements**  
    
    There are numerous enhancements and bugfixes in the area of filtering content in a NatTable. Especially the "Excel-like" filter was extended, to feel even more like "Excel". One of the improvements is that if you filter in one column, the filter comboboxes of all other columns will only contain items based on the current filtered data in the table. While the filter combobox of the column where the filter was applied, still contains all previous values. This increases the usability of the "Excel-like" filter feature in NatTable, but caused a lot of modifications in the related code base.
    
    To enable this feature you only need to set the filter collection and the column header layer to the `FilterRowComboBoxDataProvider` via `FilterRowComboBoxDataProvider#setFilterCollection(Collection, ILayer)`. All other mechanisms are handled internally. The necessary API changes are documented in the upper section.
    
    ```java
    this.filterRowComboBoxDataProvider.setFilterCollection( 
        bodyLayerStack.getFilterList(), 
        this.filterRowHeaderLayer);
    ```

    The following examples contain demonstrations on the usage:  
    _**Tutorial Examples -> Integration -> SortableAllFilterPerformanceColumnGroupExample**_
    
*   **Inverted combobox filter persistence**  
    
    When using the "Excel-like" filter combobox filter row, the persisted filter is based on what is selected. This makes the persisted state dependent on the content shown in the NatTable. If the persisted state should be reused even with different contents, it should be stored what is **NOT** selected. To be able to store this inverted logic, the `FilterRowDataProvider` needs to know the `FilterRowComboBoxDataProvider` in order to be able to identify what is not selected. This can be done via `FilterRowDataProvider#setFilterRowComboBoxDataProvider(FilterRowComboBoxDataProvider)`.
    
    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Integration -> SortableAllFilterPerformanceColumnGroupExample**_
    
*   **Filter content on filtering the combobox content**  
    
    The `NatCombo` is extended to support registering a `ModifyListener` and a `KeyListener` on the dropdown filter textfield, which can be used to filter the dropdown content. This way it is possible to directly trigger a filter operation on the NatTable when the filter dropdown content is filtered.
    
    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Integration -> SortableAllFilterPerformanceColumnGroupExample**_
    
*   **FilterAppliedEvent extension**  
    
    The `FilterAppliedEvent` was extended to transport lot more information than before. This extension was necessary to support the feature to handle filter combobox content that contains only values that are currently visible.
    
*   **IActivatableFilterStrategy**  
    
    We introduced the `IActivatableFilterStrategy` interface to add support for activating and deactivating a filter strategy. This is for example needed for the GroupBy feature to ensure that the original list state is not changed when operating on filters and groups.
    
*   **ComboBoxGlazedListsWithExcludeFilterStrategy**  
    
    We introduced the `ComboBoxGlazedListsWithExcludeFilterStrategy` that supports excluding table items from filtering. Excluding items from filtering means that these items are never filtered and therefore always part of the NatTable content.
    
    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Integration -> SortableAllFilterPerformanceColumnGroupExample**_
    
*   **GlazedListsFilterRowComboBoxDataProvider**  
    
    The `GlazedListsFilterRowComboBoxDataProvider` now supports deactivation similar to the `GlazedListsEventHandler`. This is especially helpful and necessary in case of bulk updates on the NatTable content, like replacing the content.
    
    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Integration -> SortableAllFilterPerformanceColumnGroupExample**_
    
*   **GroupBy - Filter - Combination**  
    
    If the GroupBy feature is combined with filtering, there are situations where it can happen that the original list order is lost. To avoid this the `GroupByDataLayer` needs to know the `FilterRowDataProvider`. This can be set via `GroupByDataLayer#enableFilterSupport(FilterRowDataProvider)`.
    
*   **Performance grouping expand/collapse handling**  
    
    The following classes were added for specialized hide/show events related to performance group expand/collapse:
    
    *   `ColumnGroupCollapseEvent`
    *   `ColumnGroupExpandEvent`
    *   `RowGroupCollapseEvent`
    *   `RowGroupExpandEvent`
    
*   **Hover by index**  
    
    The hover functionality was extended to work also via indexes. This was necessary to fix some rendering issues in performance group headers in scrolled state. The following classes were added:
    
    *   `HoverStylingByIndexAction`
    *   `HoverStylingByIndexCommand`
    *   `HoverStylingByIndexCommandHandler`
    
*   **ShowColumnInViewportAction**  
    
    We introduced the `ShowColumnInViewportAction` to be able to move a cell into the viewport. This is for example necessary to avoid a rendering glitch when applying a filter that causes a removal of the scrollbar.
    
*   **Export - Number Formatting**  
    
    It is now possible to configure the number format on exportin to Excel using the POI extension. This can be done via the `ExportConfigAttributes.NUMBER_FORMAT` configuration attribute. The possible values are defined by [BuiltinFormats](https://poi.apache.org/apidocs/dev/org/apache/poi/ss/usermodel/BuiltinFormats.html).
    
    ```java
    configRegistry.registerConfigAttribute( 
        ExportConfigAttributes.NUMBER_FORMAT, 
        "0.00", //$NON-NLS-1$ 
        DisplayMode.NORMAL, 
        ColumnLabelAccumulator.COLUMN_LABEL_PREFIX + 3);
    ```

    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Integration -> GroupBySummaryFixedSummaryRowExample**_
    
*   **RichText - Separate data and markup display converter**  
    
    It is now possible to configure a markup display converter separated and additionally to a data converter. Previously only a `CellConfigAttributes.DISPLAY_CONVERTER` could be registered to add the HTML markup. This made it difficult for cases where the data needs to be converted to text in advance. Now the markup display converter can be registered via the `RichTextConfigAttributes.MARKUP_DISPLAY_CONVERTER` configuration attribute.
    
    ```java
    configRegistry.registerConfigAttribute( 
        RichTextConfigAttributes.MARKUP_DISPLAY_CONVERTER, 
        markupConverter, 
        DisplayMode.NORMAL, 
        ColumnLabelAccumulator.COLUMN_LABEL_PREFIX + 1);
    ```

    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Configuration -> NebulaRichTextIntegrationExample**_