---
title: "NatTable 1.6.0 - New & Noteworthy"
date: 2019-09-18T00:00:00-00:00
summary: "Nebula NatTable 1.6.0 released"
categories: ["news"]
---

The NatTable 1.6.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. We would like to thank everyone involved for their commitment and support on developing the 1.6.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Despite the enhancements and new features there are numerous bugfixes related to issues on concurrency, scaling, percentage sizing or performance for NatTables with huge column sets.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.6.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.6.0).

### API changes

*   Several modifications were made to increase the extensibility of NatTable. Some additional methods are added and the visibility of some existing methods is increased. Existing code should work unchanged.  
    Below is the list of those methods, the details can be found in the _Enhancements and new features_ section.
    *   `ReflectiveColumnPropertyAccessor#getPropertyDescriptor()`
    *   `AbstractPositionCommand#getLayer()`
    *   `AbstractRowCommand#getLayer()`
    *   `AlternatingRowConfigLabelAccumulator#layer`
    *   `ComboBoxCellEditor#isFocusOnText()`
    *   `ComboBoxCellEditor#setFocusOnText()`
    *   `CopyDataCommandHandler#internalDoCommand()`
    *   `CopyDataCommandHandler#getSelectedColumnPositions()`
    *   `CopyDataCommandHandler#getColumnHeaderLayer()`
    *   `CopyDataCommandHandler#getRowHeaderLayer()`
    *   `CopyDataCommandHandler#getCopyLayer()`
    *   `CopyDataCommandHandler#isCopyAllowed()`
    *   `CopyDataCommandHandler#isEmpty()`
    *   `CopySelectionLayerPainter#getCopyBorderStyle()`
    *   `ExportCommand#isExecuteSynchronously()`
    *   `FillHandleDragMode#startPosition`
    *   `FillHandleLayerPainter#getCopyBorderStyle()`
    *   `FilterRowComboBoxDataProvider#isUpdateEventsEnabled()`
    *   `FilterRowComboBoxDataProvider#enableUpdateEvents()`
    *   `FilterRowComboBoxDataProvider#disableUpdateEvents()`
    *   `FilterRowComboBoxDataProvider#getValueCacheLock()`
    *   `FilterRowComboBoxDataProvider#removeCacheUpdateListener()`
    *   `FormulaParser#processPower()`
    *   `InternalPasteDataCommandHandler#isPasteAllowed()`
    *   `InternalPasteDataCommandHandler#getPasteLayer()`
    *   `TextCellEditor#isCommitOnEnter()`
    *   `TextCellEditor#setCommitOnEnter()`
    *   `TextCellEditor#isCommitWithCtrlKey()`
    *   `TextCellEditor#setCommitWithCtrlKey()`
    *   `GroupByDataLayer#getSortModel()`
    *   `GlazedListTreeRowModel#getTreeData()`
    *   `GlazedListsSortModel#refresh()`
    *   `CompositeFreezeLayer#getColumnBounds()`
    *   `CompositeFreezeLayer#getRowBounds()`
    *   `FreezePositionCommand#isInclude()`
    *   `FreezeSelectionCommand#isInclude()`
    *   `FreezeSelectionStrategy#getUnderlyingColumnPosition()`
    *   `FreezeSelectionStrategy#getUnderlyingRowPosition()`
    *   `ColumnGroupExpandCollapseCommand#getRowPositionLayer()`
    *   `ColumnGroupExpandCollapseCommand#getLocalRowPosition()`
    *   `RowGroupExpandCollapseCommand#getColumnPositionLayer()`
    *   `RowGroupExpandCollapseCommand#getColumnPosition()`
    *   `RowGroupExpandCollapseCommand#getLocalColumnPosition()`
    *   `ColumnGroupGroupHeaderLayer#getColumnSpan()`
    *   `ColumnGroupGroupHeaderLayer#getStartPositionOfGroup()`
    *   `ColumnGroupHeaderLayer#getColumnSpan()`
    *   `ColumnGroupHeaderLayer#getStartPositionOfGroup()`
    *   `ColumnGroupModel#isDefaultCollapseable()`
    *   `ColumnGroupModel#setDefaultCollapseable()`
    *   `ColumnHideShowLayer#hideColumnPositions()`
    *   `ColumnHideShowLayer#showColumnIndexes()`
    *   `ColumnVisualChangeEvent#getColumnIndexes()`
    *   `RowVisualChangeEvent#getRowIndexes()`
    *   `CompositeLayer#getChildLayerLayout()`
    *   `CompositeLayer#CompositeLayerPainter`
    *   `TextPainter#isCalculateWrappedHeight()`
    *   `TextPainter#setCalculateWrappedHeight()`
    *   `LayerPrinter#addPrintListener()`
    *   `LayerPrinter#removePrintListener()`
    *   `ColumnReorderDragMode#getColumnCell()`
    *   `ColumnReorderDragMode#ColumnReorderOverlayPainter`
    *   `RowReorderDragMode#getRowCell()`
    *   `RowReorderDragMode#RowReorderOverlayPainter`
    *   `ColumnReorderCommand#updateFromColumnPosition()`
    *   `ColumnReorderCommand#updateToColumnPosition()`
    *   `ColumnReorderEndCommand#updateToColumnPosition()`
    *   `RowReorderCommand#updateFromRowPosition()`
    *   `RowReorderCommand#updateToRowPosition()`
    *   `RowReorderEndCommand#updateToRowPosition()`
    *   `ColumnReorderEvent#getBeforeFromColumnIndexes()`
    *   `ColumnReorderEvent#getBeforeToColumnIndex()`
    *   `ColumnReorderEvent#setConvertedBeforePositions()`
    *   `RowReorderEvent#getBeforeFromRowIndexes()`
    *   `RowReorderEvent#getBeforeToRowIndex()`
    *   `RowReorderEvent#setConvertedBeforePositions()`
    *   `ColumnReorderLayer#resetReorder()`
    *   `RowReorderLayer#resetReorder()`
    *   `PreserveSelectionModel#selectionLayer`
    *   `PreserveSelectionModel#getRowIdByPosition()`
    *   `PreserveSelectionModel#getRowPositionByRowObject()`
    *   `PreserveSelectionModel#ignoreVerticalChange()`
    *   `SelectCellCommandHandler#selectionLayer`
    *   `SelectColumnCommandHandler#selectionLayer`
    *   `SelectRowCommandHandler#selectionLayer`
    *   `SelectionLayerPainter#ApplyBorderFunction`
    *   `SelectionLayer#allCellsSelectedInRegion()`
    *   `SelectionLayer#handleRowPositionHideCommand()`
    *   `SummaryRowLayer#isSummaryRowPosition()`
    *   `SummaryRowLayer#getSummaryRowPosition()`
    *   `TreeExpandCollapseCommand#getColumnIndex()`
    *   `IndentedTreeImagePainter#getInternalPainter()`
    *   `AbstractTreeRowModel#getTreeData()`
    *   `TreeLayer#isTreeColumn()`
*   Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name. Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for bugfixing.
    *   `IFreezeConfigAttributes#SEPARATOR_WIDTH`
    *   `ISearchStrategy#SKIP_SEARCH_RESULT_LABEL`
    *   `LayerUtil#ADDITIONAL_POSITION_MODIFIER`
    *   `PopupMenuBuilder#CREATE_ROW_GROUP_MENU_ITEM_ID`
    *   `PopupMenuBuilder#RENAME_ROW_GROUP_MENU_ITEM_ID`
    *   `PopupMenuBuilder#REMOVE_ROW_GROUP_MENU_ITEM_ID`
    *   `PopupMenuBuilder#UNGROUP_ROWS_MENU_ITEM_ID`
    *   `PopupMenuBuilder#FREEZE_COLUMN_MENU_ITEM_ID`
    *   `PopupMenuBuilder#FREEZE_ROW_MENU_ITEM_ID`
    *   `PopupMenuBuilder#FREEZE_POSITION_MENU_ITEM_ID`
    *   `PopupMenuBuilder#UNFREEZE_MENU_ITEM_ID`
    *   `PrintConfigAttributes#DEFAULT_PAGE_ORIENTATION`
    *   `SizeConfig#PERSISTENCE_KEY_PERCENTAGE_SIZES`
    *   `SizeConfig#PERSISTENCE_KEY_DISTRIBUTE_REMAINING_SPACE`
    *   `SizeConfig#PERSISTENCE_KEY_DEFAULT_MIN_SIZE`
    *   `SizeConfig#PERSISTENCE_KEY_MIN_SIZES`

### Enhancements and new features

*   **Performance column grouping**  
    
    While fixing several issues with the existing column grouping feature (especially on rendering), we introduced a performance leak for huge column groups. While this is not noticeable for the most common use cases and the applied fixes ensure to render the column group cells correctly on structural changes and scrolling in frozen states, it had a really bad impact for column groups that span thousands of columns. As the existing solution is based on determining the column group cell at rendering time based on the column indexes that belong to the column group, it was not possible to fix the performance flaws for huge column groups here.
    
    Because of this fact and several other issues with the existing column grouping feature, we decided to implement a new column grouping. It has the following advantages:
    
    *   Handle huge column groups
    *   Groups are configured once and updated via event handling
    *   Simplified API
    *   Multi-level configuration in one layer
    *   Model does not need to be created or configured outside the `ColumnGroupHeaderLayer`
    *   No need for a `ColumnGroupReorderLayer`
    
    As a downside it is not possible anymore to render a split column group. A column group is now always consecutive and it is not possible to place columns in between that are not part of the group.
    
    To be at least feature-equal with the existing column grouping, the following classes where extended with new constructors or new methods to support the new performance column grouping also:
    
    *   `DisplayColumnChooserCommandHandler`
    *   `ColumnChooser`
    *   `ColumnGroupEntry`
    *   `ColumnChooserDialog`
    *   `ColumnGroupExpandCollapseCommand`
    *   `ColumnGroupUtils`
    *   `ColumnReorderEvent`
    *   `GroupByHeaderConfiguration`
    
    When creating the new performance `ColumnGroupHeaderLayer` you notice the following facts compared to the existing implementation:
    
    *   The constructor of `ColumnGroupHeaderLayer` does not need a `ColumnGroupModel` parameter
    *   The column groups are configured by name, start index and span, not all included column indexes
    
    ```java
    // build the column header layer 
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
    columnGroupHeaderLayer.addGroup("Personal", 11, 3);
    ```
    To support expand/collapse of column groups, the new performance `ColumnGroupExpandCollapseLayer` needs to be included in the body layer stack. This is necessary to not mix column hide/show with column group expand/collapse.
    
    By default the `ColumnGroupHeaderLayer` supports one grouping level. To support additional grouping levels the method `ColumnGroupHeaderLayer#addGroupingLevel()` needs to be called. To configure additional levels, all methods in `ColumnGroupHeaderLayer` are available with a leading level parameter to specify on which level a group action should be performed. The levels are bottom-up, so level 0 is the bottom most column group level, while adding a new grouping level on top will be level 1, rendered in the first row.
    
    ```java
    columnGroupHeaderLayer.addGroupingLevel(); 
    columnGroupHeaderLayer.addGroup(1, "Person with Address", 0, 8); 
    columnGroupHeaderLayer.addGroup(1, "Additional Information", 8, 6);
    ```

    The following examples show the usage:  
    _**Tutorial Examples -> Grouping -> PerformanceColumnGroupingExample**_  
    _**Tutorial Examples -> Grouping -> HugeColumnGroupingExample**_  
    _**Tutorial Examples -> Grouping -> PerformanceColumnAndRowGroupingExample**_
    
*   **Performance column grouping with GroupBy**  
    
    When combining the GroupBy feature with the new performance column grouping a special handling for unbreakable groups is needed to avoid that a column can be reordered outside the column group. To support this also visually the `GroupByColumnGroupReorderDragMode` is introduced. It can be configured simply by using the new `GroupByHeaderConfiguration` constructor that takes the new performance `ColumnGroupHeaderLayer` as parameter.
    
    ```java
    ColumnGroupHeaderLayer columnGroupHeaderLayer = 
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
            // that unbreakable groups can't be broken 
            new GroupByHeaderConfiguration( 
                bodyLayerStack.getGroupByModel(), 
                columnHeaderDataProvider, 
                columnHeaderLayer, 
                columnGroupHeaderLayer));
    ```

    The following example shows the usage:  
    _**Tutorial Examples -> Integration -> SortableGroupByFilterPerformanceColumnGroupAndFreezeExample**_
    
*   **Performance row grouping**  
    
    To align the row grouping API and functionality with the new performance column grouping and some issues with the existing row grouping feature, we created a new performance row grouping implementation. It is feature-equal with the new performance column grouping, which also includes dynamic grouping at runtime, which is not supported by the current implementation.
    
    It has the following advantages:
    
    *   Handle huge row groups
    *   Groups are configured once and updated via event handling
    *   Simplified API
    *   Multi-level configuration in one layer
    *   Model does not need to be created or configured outside the `RowGroupHeaderLayer`
    *   No need for a `RowGroupReorderLayer`
    
    As a downside it is not possible anymore to render a split row group. A row group is now always consecutive and it is not possible to place rows in between that are not part of the group.
    
    To be at least feature-equal with the existing row grouping and to align the performance row grouping with the functionality of the new performance column grouping, the following classes where extended with new constructors or new methods to support the new performance row grouping also:
    
    *   `RowGroupExpandCollapseCommand`
    *   `RowGroupUtils`
    
    When creating the new performance `RowGroupHeaderLayer` you notice the following facts compared to the existing implementation:
    
    *   The constructor of `RowGroupHeaderLayer` does not need a `RowGroupModel` parameter
    *   The row groups are configured by name, start index and span, not by row objects
    *   The body `DataProvider` does not need to be an `IRowDataProvider`
    
    ```java
    // build the row header layer 
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
    Map counted = persons.stream() 
        .collect(Collectors.groupingBy(ExtendedPersonWithAddress::getLastName, Collectors.counting())); 
    counted.entrySet().stream().forEach(e -> { 
        rowGroupHeaderLayer.addGroup( e.getKey(), 
        // retrieve the index of the first element with the 
        // given lastname 
        IntStream.range(0, persons.size()) 
            .filter(index -> persons.get(index).getLastName().equals(e.getKey())) 
            .findFirst() 
            .getAsInt(), 
        e.getValue().intValue()); 
    });
    ```

    To support expand/collapse of row groups, the new performance `RowGroupExpandCollapseLayer` needs to be included in the body layer stack. This is necessary to not mix row hide/show with row group expand/collapse.
    
    By default the `RowGroupHeaderLayer` supports one grouping level. To support additional grouping levels the method `RowGroupHeaderLayer#addGroupingLevel()` needs to be called. To configure additional levels, all methods in `RowGroupHeaderLayer` are available with a leading level parameter to specify on which level a group action should be performed. The levels are right-to-left, so level 0 is the right most row group level, while adding a new grouping level to the left will be level 1, rendered in the first column.
    
    ```java
    Group carlsonGroup = rowGroupHeaderLayer.getGroupByName("Carlson"); 
    Group flandersGroup = rowGroupHeaderLayer.getGroupByName("Flanders"); 
    rowGroupHeaderLayer.addGroupingLevel(); 
    rowGroupHeaderLayer.addGroup(
        1, 
        "Friends", 
        0, 
        carlsonGroup.getOriginalSpan() + flandersGroup.getOriginalSpan());
    ```

    The following examples show the usage:  
    _**Tutorial Examples -> Grouping -> PerformanceRowGroupingExample**_  
    _**Tutorial Examples -> Grouping -> PerformanceColumnAndRowGroupingExample**_
    
*   **Hierarchical tree representations**  
    
    We introduced support for visualizing object graphs. As NatTable internally is only able to handle list structures, several classes where introduced to flatten and handle such structures.
    
    Via `HierarchicalHelper` it is possible to de-normalize or flatten an object graph to a list representation. The elements in the resulting list are of type `HierarchicalWrapper` which internally references corresponding objects in the object graph. For accessing the properties of such objects the `HierarchicalReflectiveColumnPropertyAccessor` is introduced.
    
    ```java
    // de-normalize the object graph without parent structure objects 
    List data = HierarchicalHelper.deNormalize(values, false, propertyNames); 
    HierarchicalReflectiveColumnPropertyAccessor columnPropertyAccessor = 
        new HierarchicalReflectiveColumnPropertyAccessor(propertyNames);
    ```

    The `HierarchicalTreeLayer` was introduced to visualize multi-level object hierarchies in a space saving tree representation. The parent objects typically do not have their own row objects and span over all related child rows. The `HierarchicalSpanningDataProvider` is introduced to support the calculation of the spanning out of the box.
    
    ```java
    // build up the body layer stack 
    IRowDataProvider bodyDataProvider = 
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
        new ViewportLayer(treeLayer);
    ```

    {{< figure src="hierarchical_example.png" alt="HierarchicalTreeLayerExample">}}
    
    The `HierarchicalTreeLayer` provides several configuration options to customize visualization and behavior:
    
    *   `HierarchicalTreeLayer#setShowTreeLevelHeader(boolean)`  
        Configure whether the tree level header should be shown or not.
    *   `HierarchicalTreeLayer#setHandleCollapsedChildren(boolean)`  
        Configure whether the `#COLLAPSED_CHILD` label should be added to the `LabelStack`. Enabling this configuration allows a different configuration for child cells of collapsed rows, e.g. different styles like no content painter or different background.
    *   `HierarchicalTreeLayer#setHandleNoObjectsInLevel(boolean)`  
        Configure whether the `#NO_OBJECT_IN_LEVEL` label should be added to the `LabelStack`. Enabling this configuration allows a different configuration for child cells of row objects that have no object for a child level, e.g. making those cells not editable and different styles like no content painter or different background.
    *   `HierarchicalTreeLayer#setRetainRemovedRowObjectNodes(boolean)`  
        Configure whether collapsed nodes should be retained in the local storage of collapsedNodes even if the row object is not contained in the underlying list anymore. This can for example happen when using a FilterList, as filtering will remove the row objects from that list. Without using a FilterList or supporting deleting rows, it is suggested to set this flag to `false` to avoid memory leaks on deleting an object.
    *   `HierarchicalTreeLayer#setExpandOnSearch(boolean)`  
        Configure whether collapsed nodes should be expanded if they contain rows that are found on search or only the found row should be made visible by still keeping the nodes collapsed.
    *   `HierarchicalTreeLayer#setSelectSubLevels(boolean)`  
        Configure whether columns in sub levels should be selected when selecting a level header cell or if only the cells in the same level should be selected.
    
    Additionally to the config labels that are also applied by a `TreeLayer`, the `HierarchicalTreeLayer` provides the following labels:
    
    *   `HierarchicalTreeLayer#LEVEL_HEADER_CELL`  
        label applied to cells in the level header column (the separator column between columns)
    *   `HierarchicalTreeLayer#COLLAPSED_CHILD`  
        label applied to child cells of a collapsed parent node. Only applied if `#setHandleCollapsedChildren(boolean)` is set to `true`
    *   `HierarchicalTreeLayer#NO_OBJECT_IN_LEVEL`  
        label applied to child cells in a row without an object. Only applied if `#setHandleNoObjectsInLevel(boolean)` is set to `true`
    
    The following classes where created to support different additional features with regards to the `HierarchicalTreeLayer`:
    
    *   `HierarchicalTraversalStrategy` - to support configuration of custom traversal strategies
    *   `HierarchicalTreeAlternatingRowConfigLabelAccumulator - to support alternating row colors based on the parent objects`
    *   `HierarchicalWrapperComparator - to support sorting`
    *   `HierarchicalTreeColumnReorderDragMode` - to respect levels on column reordering
    *   `HierarchicalTreeExpandCollapseAction` - to support an extended option for expand/collapse operations to a specified level
    *   `HierarchicalTreeExpandCollapseCommand` - to support an extended option for expand/collapse operations to a specified level
    *   `HierarchicalTreeCopyDataCommandHandler` - to support copy operations in a `HierarchicalTreeLayer` by treating spanned cells as single cells and ignore gaps
    *   `HierarchicalTreePasteDataCommandHandler` - to support paste operations on a `HierarchicalTreeLayer`
    *   `HierarchicalWrapperSortModel` - to support dynamic sorting in combination with GlazedLists SortedList
    *   `HierarchicalWrapperTreeFormat` - to support multi level trees with GlazedLists TreeList in a modified `TreeLayer`
    
    The following classes where extended with new constructors or other extensions to support the `HierarchicalTreeLayer`, e.g. to support selection handling on a layer that is placed on top of the `SelectionLayer`:
    
    *   `DeleteSelectionCommandHandler`
    *   `EditSelectionCommandHandler`
    *   `EditUtils`
    *   `TickUpdateCommandHandler`
    *   `TreeExpandCollapseCommand`
    *   `TreeLayerExpandCollapseKeyBindings`
    *   `IndentedTreeImagePainter`
    
    The following examples show the usage:  
    _**Tutorial Examples -> GlazedLists -> Tree -> HierarchicalTreeExample**_  
    _**Tutorial Examples -> GlazedLists -> Tree -> HierarchicalTreeLayerGridExample**_  
    _**Tutorial Examples -> GlazedLists -> Tree -> HierarchicalTreeLayerExample**_
    
*   **`SelectRegionCommand`**  
    
    Introduced the `SelectRegionCommand` to be able to select a region at once without the need to trigger the selection of two separate cells with modifier keys. This is for example needed to handle selections in a hierarchical tree when clicking a level header cell.
    
*   **Tracking of data changes**  
    
    We introduced the support for tracking data changes in the table. This feature can be enabled by adding the `DataChangeLayer` to the body layer stack, typically directly on top of the `DataLayer`.
    
    {{< figure src="datachangelayer_example.png" alt="DataChangeLayerExample">}}
    
    The `DataChangeLayer` has two operation modes:
    
    1.  **Temporary data storage**  
        Data changes are handled temporary in the `DataChangeLayer`. The underlying data model will be updated on save.
    2.  **Persistent data storage**  
        Data changes are directly applied to the underlying data model. The `DataChangeLayer` only keeps track of the changes to be able to highlight and to revert the changes.
    
    To keep track of data changes, the change needs to be identified. For this a `CellKeyHandler` needs to be provided. There are two default implementations that can be used to create a `DataChangeLayer`:
    
    *   `PointKeyHandler`  
        Changes are tracked by column/row indexes. Used in cases where structural modifications like sorting or filtering are not added to the NatTable.
    *   `IdIndexKeyHandler`  
        Changes are tracked by column index and row id. Used in cases where structural modifications like sorting or filtering are supported in the NatTable.
    
    The following example shows the creation of a `DataChangeLayer` in a NatTable that does not support sorting/filtering and temporarily tracks data changes:
    
    ```java
    // add a DataChangeLayer that temporarily tracks data changes 
    // without updating the underlying data model 
    DataChangeLayer dataChangeLayer = 
        new DataChangeLayer(bodyDataLayer, new PointKeyHandler(), true);
    ```

    The following example shows the creation of a `DataChangeLayer` in a NatTable that does not support sorting/filtering and directly updates the underlying data model. Note that in such a scenario the save operation needs to be implemented yourself, as typically the underlying data model needs to be synchronized with the real data storage, e.g. a database.
    
    ```java
    // add a DataChangeLayer that tracks data changes but directly 
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
        });
    ```

    Additionally to tracking cell data changes it is also possible to track row structural changes like adding or deleting rows. This can be enabled via constructor parameter and does only work in the persistent data storage mode.
    
    The following example shows the creation of a `DataChangeLayer` that supports tracking deleting/inserting rows in a NatTable that supports sorting and filtering.
    
    ```java
    // add support for row insert and delete operations 
    // use the event list instead of a transformed list to ensure 
    // the operations work even in a transformed (e.g. filtered) 
    // state register the RowDeleteCommandHandler for delete 
    // operations by index, e.g. used for reverting row insert 
    // operations 
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
    GlazedListsEventLayer glazedListsEventLayer = 
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
            true);
    ```

    To discard/undo tracked data changes the `DiscardDataChangesCommand` can be executed.
    
    To save tracked data changes the `SaveDataChangesCommand` can be executed.
    
    Cells that contain modified data are marked with the cell label `DataChangeLayer#DIRTY`. This allows for example to customize the visualization of dirty cells.
    
    ```java
    // add a special style to highlight the modified cells 
    Style style = new Style(); 
    style.setAttributeValue( 
        CellStyleAttributes.BACKGROUND_COLOR, 
        GUIHelper.COLOR_YELLOW); 
    configRegistry.registerConfigAttribute( 
        CellConfigAttributes.CELL_STYLE, 
        style, 
        DisplayMode.NORMAL, 
        DataChangeLayer.DIRTY);
    ```

    The following examples show the usage:  
    _**Tutorial Examples -> Layers -> Data -> DataChangeLayerExample**_  
    _**Tutorial Examples -> Layers -> Data -> DataChangeLayerTempStorageExample**_  
    _**Tutorial Examples -> Integration -> EditableSortableGroupByWithFilterExample**_
    
*   **`UpdateDataCommandHandler` enhancements**  
    
    Introduced a new constructor to be able to specify whether an equals check should be performed on applying a new value or not. Typically an equals check is performed and an update is skipped if the new value is the same as the current value. In some cases this could not be the desired behavior and it is expected that the value is applied without checking the current status, e.g. when entering the same value in a filter, the filtering should be performed disregarding the current state to re-apply the filter.
    
    Also introduced the `DataUpdateEvent` that is fired by the `UpdateDataCommandHandler` in case the new value is set to the backing data via `DataLayer`. It is a specialization of the `CellVisualChangeEvent` that additionally carries the old and the new cell value.
    
*   **Hide/Show enhancements**  
    
    There are several enhancements to the hide/show feature to improve the usability.
    
    We introduced the `ResizeColumnHideShowLayer` which hides a column by resizing it to a width of 0. With this a percentage sized column width configuration will always take the whole available space for the visible columns. It needs the body `DataLayer` at creation time to operate on the column widths.
    
    ```java
    ResizeColumnHideShowLayer columnHideShowLayer = 
        new ResizeColumnHideShowLayer(bodyDataLayer, bodyDataLayer);
    ```

    The following example shows the usage:  
    _**Tutorial Examples -> Layers -> HideShow -> ResizeColumnHideShowExample**_
    
    We introduced the `RowIdHideShowLayer` which allows to hide a row and keep track of it via row id. This way hiding a row will work correctly even on sorting or filtering via GlazedLists.
    
    ```java
    IRowIdAccessor rowIdAccessor = 
        new IRowIdAccessor() { 
            @Override 
            public Serializable getRowId(HierarchicalWrapper rowObject) { 
                return rowObject.hashCode(); 
            } 
        }; 
    
    ... 
    
    RowIdHideShowLayer rowHideShowLayer = 
        new RowIdHideShowLayer<>( 
            columnHideShowLayer, 
            bodyDataProvider, 
            rowIdAccessor);
    ```

    We introduced the `HideIndicatorOverlayPainter` that can be used to render an indicator in the column and/or row header at places where columns/rows are hidden. It can also have a menu configured to it, so via right click on the hide indicator a menu opens that let the user show only the hidden columns at the given position again. A default menu can be added via `HideIndicatorMenuConfiguration`.
    
    {{< figure src="hideindicator_example.png" alt="HideIndicatorOverlayPainter example">}}
    
    ```java
    // add the optional rendering indicator for the hidden 
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
            rowHeaderLayer));
    ```

    The appearance of the hide indicator can be configured via the following config attributes:
    
    *   `HideIndicatorConfigAttributes#HIDE_INDICATOR_LINE_WIDTH`
    *   `HideIndicatorConfigAttributes#HIDE_INDICATOR_COLOR`
    
    ```java
    overlayPainter.setConfigRegistry(natTable.getConfigRegistry()); 
    natTable.addConfiguration(new AbstractRegistryConfiguration() { 

        @Override 
        public void configureRegistry(IConfigRegistry configRegistry) { 
            configRegistry.registerConfigAttribute( 
                HideIndicatorConfigAttributes.HIDE_INDICATOR_COLOR, 
                GUIHelper.COLOR_BLACK); 
        } 
    });
    ```
    Alternatively it is possible to set the line with and color values via setter methods on the `HideIndicatorOverlayPainter`.
    
    The following example shows the usage:  
    _**Tutorial Examples -> Layers -> HideShow -> ColumnAndRowHideShowExample**_
    
*   **Improved percentage sizing**  
    
    There are several improvements to the percentage sizing feature to improve the usability.
    
    Several configuration options were added to the `DataLayer` and `SizeConfig` that allow to configure the behavior of percentage sized columns or rows. It is for example now possible to configure the minimum width/height to avoid that columns/rows vanish if the space becomes to small on resizing a window. It is also possible to configure how remaining space should be handled in case the size configuration does not cover 100%. This also improves the behavior on mixed size configurations, which gives developers a huge flexibility on how the size configuration should look like in their NatTables.
    
    The following methods where introduced for improved percentage sizing configurations:
    
    *   `SizeConfig#resetConfiguredMinSize(int)`
    *   `SizeConfig#isDistributeRemainingSpace()`
    *   `SizeConfig#setDistributeRemainingSpace(boolean)`
    *   `SizeConfig#getDefaultMinSize()`
    *   `SizeConfig#setDefaultMinSize(int)`
    *   `SizeConfig#getMinSize(int)`
    *   `SizeConfig#setMinSize(int, int)`
    *   `SizeConfig#isMinSizeConfigured()`
    *   `SizeConfig#isMinSizeConfigured(int)`
    *   `SizeConfig#isFixPercentageValuesOnResize()`
    *   `SizeConfig#setFixPercentageValuesOnResize(boolean)`
    *   `DataLayer#resetMinColumnWidth(int, boolean)`
    *   `DataLayer#resetMinRowHeight(int, boolean)`
    *   `DataLayer#isDistributeRemainingColumnSpace()`
    *   `DataLayer#setDistributeRemainingColumnSpace(boolean)`
    *   `DataLayer#isDistributeRemainingRowSpace()`
    *   `DataLayer#setDistributeRemainingRowSpace(boolean)`
    *   `DataLayer#getDefaultMinColumnWidth()`
    *   `DataLayer#setDefaultMinColumnWidth(int)`
    *   `DataLayer#getMinColumnWidth(int)`
    *   `DataLayer#setMinColumnWidth(int, int)`
    *   `DataLayer#isMinColumnWidthConfigured()`
    *   `DataLayer#isMinColumnWidthConfigured(int)`
    *   `DataLayer#getDefaultMinRowHeight()`
    *   `DataLayer#setDefaultMinRowHeight(int)`
    *   `DataLayer#getMinRowHeight(int)`
    *   `DataLayer#setMinRowHeight(int, int)`
    *   `DataLayer#isMinRowHeightConfigured()`
    *   `DataLayer#isMinRowHeightConfigured(int)`
    *   `DataLayer#isFixColumnPercentageValuesOnResize()`
    *   `DataLayer#setFixColumnPercentageValuesOnResize(boolean)`
    *   `DataLayer#isFixRowPercentageValuesOnResize()`
    *   `DataLayer#setFixRowPercentageValuesOnResize(boolean)`
    
    ```java
    DataLayer bodyDataLayer = new DataLayer(bodyDataProvider); 
    bodyDataLayer.setColumnPercentageSizing(true); 
    bodyDataLayer.setDefaultMinColumnWidth(20);
    ```
    
    The following example shows the usage of minimum column width configuration:  
    _**Tutorial Examples -> Layers -> HideShow -> ResizeColumnHideShowExample**_
    
*   **Scaling improvements**  
    
    The following methods where introduced for dealing with scaling when programmatically operating on a NatTable:
    
    *   `SizeConfig#getConfiguredSize(int)`
    *   `SizeConfig#upScale(int)`
    *   `SizeConfig#downScale(int)`
    *   `DataLayer#getConfiguredColumnWidthByPosition(int)`
    *   `DataLayer#getConfiguredRowHeightByPosition(int)`
    *   `DataLayer#upScaleColumnWidth(int)`
    *   `DataLayer#downScaleColumnWidth(int)`
    *   `DataLayer#upScaleRowHeight(int)`
    *   `DataLayer#downScaleRowHeight(int)`
    
*   **Skip cells in search**  
    
    It is now possible to configure that specific cells should be skipped in a search operation by adding the config label `ISearchStrategy#SKIP_SEARCH_RESULT_LABEL` to the config label stack. This is for example needed to avoid that columns that only render images or comboboxes are taken into account in the search result. It is also used in the `ResizeColumnHideShowLayer` to avoid that currently hidden columns are part in the search.
    
    ```java
    // skip second column in search 
    ColumnOverrideLabelAccumulator columnLabelAccumulator = 
        new ColumnOverrideLabelAccumulator(bodyDataLayer); 
    columnLabelAccumulator.registerColumnOverrides( 
        1, 
        ISearchStrategy.SKIP_SEARCH_RESULT_LABEL);
    ```

*   **`PositionCoordinateComparator`**  
    
    Introduced the `PositionCoordinateComparator` to be able to sort collections of `PositionCoordinate` in an ascending way.
    
*   **`ComboBoxCellEditor#focusOnText`**  
    
    Introduced the `focusOnText` flag in `ComboBoxCellEditor` to be able to specify whether the text field or the dropdown should get the focus when the editor is activated. This is useful for `ComboBoxCellEditor`s that support free editing.
    
*   **`TextCellEditor` enhancements to configure behavior on ENTER**  
    
    Introduced methods to be able to configure the behavior of the `TextCellEditor` if ENTER is pressed. This is especially interesting for multiline text editors where pressing ENTER could either mean to apply the value or for adding a new line.
    
*   **Several new helper methods in `LayerCommandUtil` and `PositionUtil`**  
    
    To implement new features shown above, several new methods were introduced in utility classes that could also helpful for users that create a highly customized NatTable.
    
*   **Increased the extensibility of `CopyDataCommandHandler` and `InternalPasteDataCommandHandler`**  
    
    The `CopyDataCommandHandler` and the `InternalPasteDataCommandHandler` where modified to increase the extensibility by adding new methods that can be overriden. This gives the ability to customize checks or the behavior without the need to copy internal code to the custom handler.
    
*   **Copy spanned cells**  
    
    The default implementation of the `CopyDataCommandHandler` does not handle the spanning of a spanned cell. Instead it copies every cell in the spanning as a single cell. The same is true for pasting via the `InternalPasteDataCommandHandler`. For several use cases this behavior is fine. But there are use cases where a spanned cell should be treated as a single cell, for example if the value in a cell that spans 6 rows should be pasted in a cell that has no spanning. The default implementation would paste the same value in 6 cells instead of a single cell. To support the copy of spanned cells as a single cell, the following command handler are introduced:
    
    *   `RowSpanningCopyDataCommandHandler`
    *   `RowSpanningPasteDataCommandHandler`
    
    The can be registered similar to the following snippet:
    
    ```java
    selectionLayer.registerCommandHandler( 
        new RowSpanningCopyDataCommandHandler( 
            selectionLayer, 
            natTable.getInternalCellClipboard())); 
    selectionLayer.registerCommandHandler( 
        new RowSpanningPasteDataCommandHandler( 
            selectionLayer, 
            natTable.getInternalCellClipboard()));
    ```

*   **Increased the extensibility of `PreserveSelectionModel`**  
    
    The `PreserveSelectionModel is modified to increase the extensibility by adding new methods that can be overriden. This gives the ability to customize checks and the behavior.
    
    With these extensions it was possible to implement the `SummaryRowPreserveSelectionModel` which can be used to combine the `PreserveSelectionModel` behavior with a summary row, which otherwise fails as the summary row is not part of the underlying data model.
    
*   **Reacting on print execution**  
    
    The `PrintListener` interface was introduced to react on print events. Implementations can be registered on `LayerPrinter` to get informed when a print operation starts or is finished.
    
    ```java
    viewportLayer.registerCommandHandler( 
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
        });
    ```

*   **Automatic row resizing on rendering**  
    
    There are several approaches to perform automatic auto resizing in NatTable. One approach is a to configure the `ICellPainter` that support auto resize to calculate the height or width on rendering. This will only perform a resize for cells that come into the visible area, but it has the downside that by default it only increases the cell dimensions. An automatic shrinking of cell dimensions is not supported as this would lead to concurrency issues. Another approach is to register a `PaintListener` that performs the auto resize operation when the table is painted. But so far that implied some internal knowledge of NatTable mechanisms and for row resizing also causes performance issues if not implemented carefully.
    
    To provide better auto row resizing support that is also able to shrink a row height if possible, the `AutoResizeRowPaintListener` is introduced. It internally uses the `AutoResizeHelper` that calculates the row heights asynchronously for the currently visible rows and triggers a `MultiRowResizeCommand` once the calculation is done. It also takes care of concurrent execution e.g. on scrolling, to avoid inconsistent states and avoids frequent resize commands.
    
    ```java
    natTable.addPaintListener( 
        new AutoResizeRowPaintListener( 
            natTable, 
            bodyLayerStack.getViewportLayer(), 
            bodyLayerStack.getBodyDataLayer()));
    ```

    Additionally the `AutoResizeRowsCommand` and the `AutoResizeColumnsCommand` where extended to simplify programmatically triggered auto resize actions. These commands can now be created using the NatTable instance and the column/row positions that should be resized. This way for example the auto resize of the column header row can simply be triggered using the following code:
    
    ```java
    natTable.doCommand(new AutoResizeRowsCommand(natTable, 0));
    ```

*   **Reset size configurations**  
    
    There are scenarios that require to reset an applied column width or row height configuration, e.g. when changing the content of a NatTable by exchanging the `IDataProvider`. It is also possible to reset the size configuration only for a specific column or row, which for example is used in the `ResizeColumnHideShowLayer` to show a column again.
    
    To support the reset of size configurations the following methods where introduced:
    
    *   `SizeConfig#reset()`
    *   `SizeConfig#resetConfiguredSize(int)`
    *   `DataLayer#resetColumnWidthConfiguration(boolean)`
    *   `DataLayer#resetColumnWidth(int, boolean)`
    *   `DataLayer#resetRowHeightConfiguration(boolean)`
    *   `DataLayer#resetRowHeight(int, boolean)`
    
    Additionally the following commands and command handler where introduced to reset the size configurations via command:
    
    *   `ColumnWidthResetCommand`
    *   `ColumnWidthResetCommandHandler`
    *   `RowHeightResetCommand`
    *   `RowHeightResetCommandHandler`
    
    The following example shows the usage:  
    _**Tutorial Examples -> Data -> ChangeDataProviderExample**_
    
*   **Reset reordering**  
    
    The `ColumnReorderLayer` and the `RowReorderLayer` are used in NatTable to support reordering of columns and rows. This can be triggered via UI interactions or programmatically. To support undoing reorder operations the feature to reset those layers is introduced. It will remove all applied reorder operations and bring those layers back to the state it would have at initialization.
    
    To support the reset of reordering the following methods where introduced:
    
    *   `ColumnReorderLayer#resetReorder()`
    *   `RowReorderLayer#resetReorder()`
    
    Additionally the following commands and command handler where introduced to reset reordering via command:
    
    *   `ResetColumnReorderCommand`
    *   `ResetColumnReorderCommandHandler`
    *   `ResetRowReorderCommand`
    *   `ResetRowReorderCommandHandler`
    
*   **Index-based multi-reorder**  
    
    The `MultiColumnReorderCommand` and the `MultiRowReorderCommand` are extended to support index-based reordering. This is useful for programmatical reording when columns/rows are hidden, which is used for example in the new performance column and row grouping for reordering groups with hidden elements.
    
    To treat the from positions as indexes, `setReorderByIndex(true)` needs to be set.
    
    **Note:**  
    Only the from positions will then be treated as indexes and a position-index-transformation will be skipped on traversing down the layer stack! The to position will always be treated as position!
    
*   **Added support to select all columns in a column group / all rows in a row group**  
    
    It is now possible to enable UI bindings that trigger a multi-column/multi-row selection when performing a click on the header cell.
    
    For the old column grouping these bindings can be enabled via `DefaultColumnGroupHeaderLayerConfiguration`. This can be done by creating the ColumnGroupHeaderLayer without the default configuration and then register the `DefaultColumnGroupHeaderLayerConfiguration` with enabled selection bindings. The default is `false` to avoid unwanted behavioral regressions in products when updating to NatTable 1.6.
    
    ```java
    ColumnGroupHeaderLayer columnGroupHeaderLayer = 
        new ColumnGroupHeaderLayer(columnHeaderLayer, selectionLayer, columnGroupModel, false); 
    columnGroupHeaderLayer.addConfiguration( 
        new DefaultColumnGroupHeaderLayerConfiguration(columnGroupModel, true));
    ```

    The new performance column grouping supports also supports column group selection bindings and has the same default to not having them enabled. To enable the column group selection bindings also the default configuration needs to be avoided and the `DefaultColumnGroupHeaderLayerConfiguration` from the `org.eclipse.nebula.widgets.nattable.group.performance.config` package needs to be created and registered with enabled selection bindings.
    
    ```java
    ColumnGroupHeaderLayer columnGroupHeaderLayer = 
        new ColumnGroupHeaderLayer(columnHeaderLayer, selectionLayer, false); 
    columnGroupHeaderLayer.addConfiguration( 
        new DefaultColumnGroupHeaderLayerConfiguration(true));
    ```

    To align the performance row grouping functionality to the new performance column grouping, the row group selection bindings can be enabled similarly.
    
    ```java
    RowGroupHeaderLayer rowGroupHeaderLayer = 
        new RowGroupHeaderLayer(rowHeaderLayer, selectionLayer, false); 
    rowGroupHeaderLayer.addConfiguration( 
        new DefaultRowGroupHeaderLayerConfiguration(true));
    ```

    To also support group selection bindings programmatically, the following actions, commands and command handler were added:
    
    *   `ViewportSelectColumnGroupAction`
    *   `ViewportSelectColumnGroupCommand`
    *   `ViewportSelectColumnGroupCommandHandler`
    *   `ViewportSelectRowGroupAction`
    *   `ViewportSelectRowGroupCommand`
    *   `ViewportSelectRowGroupCommandHandler`
    
*   **Added option to execute an export synchronously**  
    
    By default an export operation is performed asynchronously. As there might be use cases where a synchronous execution would be needed, new constructors where added to the `ExportCommand` and the `NatExporter` to specify if the export should be performed synchronously or asynchronously. The default is still asynchronous execution.
    
*   **Enhanced freeze options**  
    
    It is now possible to configure the `FreezeSelectionCommand` and the `FreezePositionCommand` to **include** the current selected or specified position in the freeze area. By default the cell for which the command is triggered is the first cell in the non-frozen area.
    
    To enable the include behavior, new constructors where added to the following classes with an additional _include_ parameter:
    
    *   `FreezeGridAction`
    *   `FreezeSelectionCommand`
    *   `FreezePositionCommand`
    
    The following snippet shows how to register custom freeze grid bindings that include the selected cell in the frozen area:
    
    ```java
    CompositeFreezeLayer compositeFreezeLayer = 
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
    });
    ```

    There are pre-defined menu items that can be added to column header, row header or a body menu to trigger freeze operations. The menu items can be simply added by using the corresponding methods in the `PopupMenuBuilder`. The related implementations can be found in `MenuItemProviders` in case a custom menu builder implementation is used.
    
    *   `PopupMenuBuilder#withFreezeColumnMenuItem()`
    *   `PopupMenuBuilder#withFreezeColumnMenuItem(String)`
    *   `PopupMenuBuilder#withFreezeRowMenuItem()`
    *   `PopupMenuBuilder#withFreezeRowMenuItem(String)`
    *   `PopupMenuBuilder#withFreezePositionMenuItem(boolean)`
    *   `PopupMenuBuilder#withFreezePositionMenuItem(String, boolean)`
    *   `PopupMenuBuilder#withUnfreezeMenuItem()`
    *   `PopupMenuBuilder#withUnfreezeMenuItem(String)`
    
    The snippet below is taken from the updated freeze example:  
    _**Tutorial Examples -> Layers -> FreezeExample**_
    
    ```java
    IMenuItemState freezeActiveState = new IMenuItemState() { 
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
    });
    ```

    The width of the freeze border can now be configured via `IFreezeConfigAttributes#SEPARATOR_WIDTH` configuration attribute.
    
    ```java
    configRegistry.registerConfigAttribute( 
        IFreezeConfigAttributes.SEPARATOR_WIDTH, 
        2);
    ```

    The `CompositeFreezeLayerPainter` can be configured to paint the freeze border over the whole table. By default the freeze border is only rendered in the body region, because the `CompositeFreezeLayer` is part of the body layer stack. To extend the freeze border to also paint over regions outside the body layer stack, the `CompositeFreezeLayerPainter` needs to be configured and registered differently.
    
    To paint the freeze border over the header regions in a simple grid composition, the `CompositeFreezeLayerPainter` can be registered on the `GridLayer` like this:
    
    ```java
    // register a freeze painter that renders also in the header regions 
    gridLayer.setLayerPainter( 
        new CompositeFreezeLayerPainter( 
            gridLayer, 
            bodyLayerStack.getCompositeFreezeLayer()));
    ```

    To paint the freeze border over the header regions and an additional region in a more complicated grid composition, e.g. with a fixed summary row, the following code can be used:
    
    ```java
    // create a composition that has the grid on top and the 
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
            ((SummaryRowBodyLayerStack) gridLayer.getBodyLayer()).getCompositeFreezeLayer(), 
            false); 
            
    // now we configure the column header layer and the row header 
    // layer as nested layers to shift the freeze lines to left 
    // and to the bottom so they are correctly aligned. 
    painter2.addNestedVerticalLayer(gridLayer.getColumnHeaderLayer()); 
    painter2.addNestedHorizontalLayer(gridLayer.getRowHeaderLayer()); 
    composite.setLayerPainter(painter2);
    ```

    The snippet above is taken from the following example:  
    _**Tutorial Examples -> Integration -> EditableFixedSummaryRowWithFreezeExample**_
    
    Also some modifications where performed to fix rendering issues in frozen state for column groups.
    
*   **Create `PopupMenuBuilder` with a provided `MenuManager`**  
    
    It is now possible to create a `PopupMenuBuilder` with an existing `MenuManager`. This way the instance can be created before a NatTable instance is available and can even be used to solve some issues with Eclipse 3.x based menus.
    
    **Note:**  
    If the `PopupMenuBuilder(MenuManager)` constructor is used, the menu can only be build via `PopupMenuBuilder#build(NatTable)`. Otherwise the generate menu can't be attached to the NatTable instance.
    
*   **Concurrency issue fixes in `FilterRowComboBoxDataProvider`**  
    
    There were several concurrency issues related to filtering. To fix those the `FilterRowComboBoxDataProvider` needed to be extended e.g. to disable event handling to avoid issues for Excel like filter combo boxes and introducing a lock for accessing the value cache. Additionally a method name typo was fixed and the method `removeCacheUpdateListener()` was introduced.
    
*   **Improvement in `ShowXxxInViewportCommand`**  
    
    There were several flaws when programmatically using a `ShowXxxInViewportCommand`s. By providing an `ILayer` and a position, people got confused about the position transformations and in some scenarios the transformation even broke the usage of those commands.
    
    To fix this the old constructors that take an `ILayer` as parameter are deprecated. Instead the constructors that only take position parameters should be used. Those positions need to match the `ILayer` on which the `ViewportLayer` is build on (typically the `SelectionLayer`).
    
    This change applies to the following commands:
    
    *   `ShowCellInViewportCommand`
    *   `ShowColumnInViewportCommand`
    *   `ShowRowInViewportCommand`
    
*   **Support for deleting row objects**  
    
    NatTable Core now contains default commands and command handler to delete rows.
    
    *   `RowDeleteCommand`
    *   `RowDeleteCommandHandler`
    *   `RowObjectDeleteCommand`
    *   `RowObjectDeleteCommandHandler`
    
    The `RowDeleteCommand` takes the row position to delete as parameter, while the `RowObjectDeleteCommand` takes the object as parameter that should be removed from the underlying data.
    
    The NatTable GlazedLists Extension contains respective command handlers that consider the `ReadWriteLock` in order to avoid concurrency issues.
    
    *   `GlazedListsRowDeleteCommandHandler`
    *   `GlazedListsRowObjectDeleteCommandHandler`
    
    The command handlers are NOT registered by default to any layer. To support delete row operations, the respective command handlers need to be registered:
    
    ```java
    bodyDataLayer.registerCommandHandler( 
        new RowDeleteCommandHandler<>(bodyDataProvider.getList()));
    ```
    
    ```java
    bodyDataLayer.registerCommandHandler( 
        new RowObjectDeleteCommandHandler<>(bodyDataProvider.getList()));
    ```
    
    ```java
    bodyDataLayer.registerCommandHandler( 
        new GlazedListsRowObjectDeleteCommandHandler<>(this.filterList));
    ```
    
    To delete a row either the row position or the row object need to be provided:
    
    ```java
    int rowPosition = MenuItemProviders.getNatEventData(event).getRowPosition(); 
    natTable.doCommand(new RowDeleteCommand(natTable, rowPosition));
    ```
    
    ```java
    int rowPosition = MenuItemProviders.getNatEventData(event).getRowPosition(); 
    int pos = LayerUtil.convertRowPosition(natTable, rowPosition, selectionLayer); 
    int idx = selectionLayer.getRowIndexByPosition(pos); 
    
    natTable.doCommand( 
        new RowObjectDeleteCommand<>( 
            bodyLayerStack.bodyDataProvider.getRowObject(idx)));
    ```
    
    The usage of the commands is shown in the following examples:  
    _**Tutorial Examples -> Data -> DataModificationExample**_  
    _**Tutorial Examples -> Integration -> EditableSortableGroupByWithFilterExample**_  
    _**Tutorial Examples -> Integration -> SortableGroupByWithComboBoxFilterExample**_
    
*   **Support for inserting row objects**  
    
    NatTable Core now contains default commands and command handler to insert rows.
    
    *   `RowInsertCommand`
    *   `RowInsertCommandHandler`
    
    The NatTable GlazedLists Extension contains respective command handlers that consider the `ReadWriteLock` in order to avoid concurrency issues.
    
    *   `GlazedListsRowInsertCommandHandler`
    
    The command handler is NOT registered by default to any layer. To support insert row operations, the respective command handler need to be registered:
    
    ```java
    bodyDataLayer.registerCommandHandler( 
        new RowInsertCommandHandler<>(bodyDataProvider.getList()));
    ```

    To insert a row the index to insert and the row object to insert need to be specified. In a body menu the code to insert a row could look like this:
    
    ```java
    int rowPosition = MenuItemProviders.getNatEventData(event).getRowPosition(); 
    int rowIndex = natTable.getRowIndexByPosition(rowPosition); 
    
    Person ralph = new Person(
        bodyDataLayer.getRowCount() + 1, 
        "Ralph", 
        "Wiggum", 
        Gender.MALE, 
        false, 
        new Date()); 
    natTable.doCommand(new RowInsertCommand<>(rowIndex + 1, ralph));
    ```

    The usage of the commands is shown in the following example:  
    _**Tutorial Examples -> Data -> DataModificationExample**_
    
*   **`GlazedListsSortModel#refresh()`**  
    
    The method `GlazedListsSortModel#refresh()` was introduced to be able to trigger a re-sort. Calling this method is needed for example when trying to add data to a NatTable that has an active GroupBy and an applied sorting on a column with groupby summary values. Without re-sorting the new elements in the list could be placed at the wrong position and breaking the tree structure as it is not possible to calculate the summary at insertion time.
    
*   **Deactivate GlazedLists list change handling**  
    
    It is possible to deactivate the list change handling in the `GlazedListsEventLayer`. If list changes happen while the handling is deactivated, the changes are still tracked, so once the list change handling is activated again, a refresh event is triggered. As in some scenarios firing a general event could lead to an unwanted behavior, e.g. when using the `RowReorderLayer` and inserting a single row, the reorder state gets reset.
    
    To support such cases also, it is now possible to discard possible event processing before activating the list change handling again. This can be done by calling `GlazedListsEventLayer#discardEventsToProcess()`. In such a case the caller of those methods need to fire the necessary refresh events in NatTable manually.
    
    Additionally the `DetailGlazedListsEventLayer` is extended to also support deactivating the list change handling.