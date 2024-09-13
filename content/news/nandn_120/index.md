---
title: "NatTable 1.2.0 - New & Noteworthy"
date: 2015-01-28T00:00:00-00:00
summary: "Nebula NatTable 1.2.0 released"
categories: ["news"]
---

The NatTable 1.2.0 release was mainly made possible by [UBS](http://www.ubs.com/). There were a lot of contributions in form of ideas, bug reports, discussions and even new features like traversal handling, scaling for high resolutions and several more you can find in the following sections. We would like to thank UBS for their commitment and support on developing the 1.2.0 release.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.2.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.2.0).

### Dependencies

*   Removed dependency to [Apache Commons Lang](http://commons.apache.org/proper/commons-lang/). It was used internally and caused issues for consumers of NatTable when setting up a target definition with newer versions of the Eclipse Platform.
*   Replaced the dependency to _org.eclipse.core.runtime_ bundle with _org.eclipse.equinox.common_ to have a smaller set on dependent plugins. The dependency to the _org.eclipse.equinox.common_ bundle is required by [JFace](https://wiki.eclipse.org/JFace), which is used for several NatTable dialogs.

### API changes

*   Added `ISortModel#getColumnComparator(int)` which is necessary to retrieve the `Comparator` for column values in order to be able to sort a tree according to the configured sorting.
*   Added `ICellEditor#activateOnTraversal(IConfigRegistry, List)` to be able to configure if an editor should be activated on traversal or not. Necessary because a checkbox shouldn't change it's value when automatically activated after committing a value in an adjacent editor. The `CheckBoxCellEditor` always returns `false`. The abstract implementations will check the newly introduced `EditConfigAttributes#ACTIVATE_EDITOR_ON_TRAVERSAL` configuration attribute or return `true` in case there is no such configuration attribute set.
*   Renamed `AggregrateConfigLabelAccumulator` to `AggregateConfigLabelAccumulator`.
*   Renamed `ITreeRowModel#isCollapseable()` to `ITreeRowModel#isCollapsible()`.
*   Added `ITreeRowModel#expandToLevel(int)`, `ITreeRowModel#expandToLevel(int, int)` and `ITreeRowModel#expandToLevel(T, int)` to be able to expand a tree to a certain level.
*   Deprecated `ITreeData#formatDataForDepth(int, int)`, `ITreeData#formatDataForDepth(int, T)` and `ITreeRowModel#getObjectAtIndexAndDepth(int, int)` which were used by `TreeExportFormatter`. Since it now correctly uses the configured `IDisplayConverter` to convert the values, these methods are not called from the framework anymore.
*   Deprecated all expand/collapse related methods in `GlazedListTreeData` and moved them to `GlazedListTreeRowModel` where they should reside correctly.
*   `ISelectionModel` now extends `ILayerEventHandler<IStructuralChangeEvent>` in order to be able to handle structural changes correctly dependent on the internal selection storage.
*   Deprecated `ColumnGroupMenuItemProviders` and moved the methods to the general `MenuItemProviders`.
*   Changed `MoveSelectionCommandHandler` _moveLastSelectedXxx_ method parameters from int to `ITraversalStrategy`.

### Enhancements and new features

*   **Scaling support for high resolution displays**  
    Introduced `IDpiConverter` and `AbstractDpiConverter` that are used in conjunction with the newly introduced `ConfigureScalingCommand` to inform `ILayer` and `SizeConfig` instances about the scaling calculations that need to be performed. Extended the `GUIHelper` for several methods related to scaling calculations and added the support for upscaled images. To add different images for different DPI settings, simply put images whose names are prefixed with the DPI values to the same place as the base image.
    
    The following shows how to provide a set of images that are used on scaling. The file _checkbox.png_ will be used for 96 DPI, the others specify their DPI setting in the filename.
    
    *   checkbox.png
    *   checkbox\_120\_120.png
    *   checkbox\_128\_128.png
    *   checkbox\_144\_144.png
    *   checkbox\_192\_192.png
    *   checkbox\_288\_288.png
    
    If no image is found for the current DPI value, the base image will be upscaled.
    
*   **Fixed summary row**  
    Introduced the `FixedSummaryRowLayer` that renders a summary row at a fixed position if added to a `CompositeLayer`. It can be configured for usage within a simple horizontal composition aswell as for usage within a grid.  
      
    
    The following code shows how to add a fixed summary row above the viewport of a simple NatTable without column and row header.
    
    ```java
    // Plug in the FixedSummaryRowLayer 
    FixedSummaryRowLayer summaryRowLayer = 
        new FixedSummaryRowLayer(dataLayer, viewportLayer, configRegistry, false); 
    // configure that the horizontal dimensional dependency 
    // is not a CompositeLayer that adds an additional column 
    summaryRowLayer.setHorizontalCompositeDependency(false); 
    CompositeLayer composite = new CompositeLayer(1, 2); 
    composite.setChildLayer("SUMMARY", summaryRowLayer, 0, 0); 
    composite.setChildLayer(GridRegion.BODY, viewportLayer, 0, 1);
    ```

    The following code shows how to add a fixed summary row at the bottom of a grid.
    
    ```java
    // create the FixedGridSummaryRowLayer 
    FixedSummaryRowLayer summaryRowLayer = 
        new FixedSummaryRowLayer( gridLayer.getBodyDataLayer(), gridLayer, configRegistry, false); 
    // set the summary label that should be shown in the row header
    summaryRowLayer.setSummaryRowLabel("\\u2211"); 
    // create a composition that has the grid on top and the summary 
    // row at the bottom 
    CompositeLayer composite = new CompositeLayer(1, 2); 
    composite.setChildLayer("GRID", gridLayer, 0, 0); 
    composite.setChildLayer(SUMMARY\_REGION, summaryRowLayer, 0, 1);
    ```

    In case the `FixedSummaryRowLayer` should be shown in a grid on top of the body stack below the column header, the layer composition needs some additional modifications. The `CompositeLayer` needs to be top most layer in the body region (which is typically the `ViewportLayer`). The row header layer needs to be of type `FixedSummaryRowHeaderLayer` in order to render the row header cell for the additional summary row on top.  
      
    You will find examples in the _NatTable Examples Application_ in  
    _Tutorial Examples -> Layers -> SummaryRow_  
    that show in detail how to setup a layer composition with a fixed summary row.
    
*   **Traversal strategy**  
    Introduced `ITraversalStrategy` to be able to configure editing traversal and selection movement details. In short this means that you are able to specify if the selection anchor should cycle if moved over a table border and if the selection/focus should jump over cells.
    
    An `ITraversalStrategy` specifies a `TraversalScope`, if the traversal should cycle, the step count and whether the target is valid. There are four default implementations that are only different for `TraversalScope` and cycle configuration. All are configured for step count = 1 and accepting every target cell as valid.
    
    *   `ITraversalStrategy#AXIS_TRAVERSAL_STRATEGY`  
        TraversalScope = AXIS  
        cycle = false  
        On traversal we only see the current row/column and will stop at a table border. This is the known default behavior in NatTable.
    *   `ITraversalStrategy#AXIS_CYCLE_TRAVERSAL_STRATEGY`  
        TraversalScope#AXIS  
        cycle = true  
        On traversal we only see the current row/column. On moving over a table border, the selection will move to the opposite side. E.g. moving over the last column in row 2 will set the selection to the first column in the same row.
    *   `ITraversalStrategy#TABLE_TRAVERSAL_STRATEGY`  
        TraversalScope#TABLE  
        cycle = false  
        On traversal we see the whole table. On moving over a table border, the selection will move to the opposite side by an additional row/column. E.g. moving to the right over the last column in row 2 will set the selection to the first column in the next row.  
        Since cycle is set to `false`, the traversal will stop at table borders (last column/last row or first column/first row).
    *   `ITraversalStrategy#TABLE_CYCLE_TRAVERSAL_STRATEGY`  
        TraversalScope#TABLE  
        cycle = true  
        On traversal we see the whole table. On moving over a table border, the selection will move to the opposite side by an additional row/column. E.g. moving to the right over the last column in row 2 will set the selection to the first column in the next row.  
        Since cycle is set to _true_, the traversal will jump over the table borders, e.g. on moving over the last column/last row cell in a table, the selection will jump to the first column/first row cell in the table.
    
    To specify a custom `ITraversalStrategy` a custom `MoveSelectionCommandHandler` needs to be registered. By default a `MoveSelectionCommandHandler` with `ITraversalStrategy#AXIS_TRAVERSAL_STRATEGY` is registered for the `SelectionLayer`. To override that behavior you can either exchange the `DefaultSelectionLayerConfiguration` or register the command handler on a layer above the `SelectionLayer`, e.g. the `ViewportLayer`. This will exchange the traversal settings globally.
    
    ```java
    // register a MoveCellSelectionCommandHandler with 
    // TABLE_CYCLE_TRAVERSAL_STRATEGY 
    viewportLayer.registerCommandHandler( 
        new MoveCellSelectionCommandHandler( 
            selectionLayer, 
            ITraversalStrategy.TABLE_CYCLE_TRAVERSAL_STRATEGY));
    ```

    Note that it is even possible to register different `ITraversalStrategy` for horizontal and vertical movements.
    
    The global `ITraversalStrategy` settings in the `MoveSelectionCommandHandler` can be overridden for a single command by executing a `MoveSelectionCommand` with customized settings.
    
    Via `EditTraversalStrategy` you are able to wrap a `ITraversalStrategy` and add the ability to check for editable state. Using the `EditTraversalStrategy` in conjunction with edit configurations for opening the adjacent editor on commit or editing traversal, the focus will jump to the next editable cell.
    
*   **SelectionModel updates**  
    As already stated in the **API changes** section, `ISelectionModel` now extends `ILayerEventHandler<IStructuralChangeEvent>`. Doing this we introduced a tight connection between the `ISelectionModel` and the handling of structural changes to update the selection. These two were loosely coupled before, which lead to several issues when exchanging the `ISelectionModel`.  
      
    **Note:**  
    If you used the `PreserveSelectionStructuralChangeEventHandler` workaround in previous versions for not clearing the selection on structural changes, you will notice that this workaround will not work anymore. If you still need that behavior, you are now able to achieve the same by configuring and setting a `SelectionModel` instance like this:
    
    ```java
    SelectionModel model = new SelectionModel(selectionLayer); 
    // configure to not clear the selection on structural changes 
    model.setClearSelectionOnChange(false); 
    selectionLayer.setSelectionModel(model);
    ```

    If you expect that the selection should update and move with structural changes (e.g. sorting), try to use the `PreserveSelectionModel`.
*   **PopupMenuBuilder - DisposeListener**  
    The `PopupMenuBuilder` now adds the necessary `DisposeListener` to the NatTable on calling `PopupMenuBuilder#build()`. It is not necessary anymore to register such a listener in a configuration yourself.
*   **PopupMenuBuilder - MenuManager**  
    The `PopupMenuBuilder` now internally uses a `MenuManager` for creating and handling MenuItems. This way it is possible to combine Eclipse popup menus with NatTable configurations in conjunction with using core expressions for visibility. Additionally the `PopupMenuAction` now sets the `NatEventData` to the `Menu` data map for the key `MenuItemProviders#NAT_EVENT_DATA_KEY`. This change was necessary because the Eclipse 4 `MenuManagerRenderer` is setting the `MenuManager` reference to the `Menu` data map without a key.
*   **PopupMenuBuilder - IMenuItemState**  
    With the internal usage of `MenuManager` it is now also possible to configure visibility and enablement of NatTable menu items. To configure these states the `IMenuItemState` was introduced. It can be registered for an ID that points to a menu item. All default NatTable menu items are now identifiable via ID, which are available as constants in `PopupMenuBuilder`. The following code creates a menu containing the debug menu item that is only visible for columns at column position > 1.
    
    ```java
    Menu debugMenu = new PopupMenuBuilder(natTable) 
        .withInspectLabelsMenuItem() 
        .withEnabledState( 
            PopupMenuBuilder.INSPECT_LABEL_MENU_ITEM_ID, 
            new IMenuItemState() { 
                @Override public boolean isActive(NatEventData natEventData) { 
                    return natEventData.getColumnPosition() > 1; 
                } 
            }) 
        .build();
    ```

*   **DisplayModeMouseEventMatcher**  
    Introduced the `DisplayModeMouseEventMatcher` that allows to register a UI binding for a `DisplayMode`. Using the `DisplayModeMouseEventMatcher` for example allows to register different actions on performing a right click on a selected cell or a non selected cell.
*   **Tree - identification of tree column (index/position)**  
    The `TreeLayer` always specifies the first column to be the tree column. It is now possible to specify whether the column index or the column position should be used to determine the tree column. The default is to use the column position, which means that reordering another column to become the first column in a grid, will make that column the tree column. Changing the behavior to use the column index for tree column determination, column reordering will lead to also reordering the tree column.  
    The following code will change the identification of the tree column from column position to column index:
    
    ```java
    treeLayer.setUseTreeColumnIndex(true);
    ```

*   **Tree - expand to level**  
    It is now possible to expand nodes in a tree to a certain level. For this the `ITreeRowModel`.
    
    ```java
    // expand all nodes to level 2 
    natTable.doCommand(new TreeExpandToLevelCommand(2)); 
    // expand node at index 5 to level 2 
    natTable.doCommand(new TreeExpandToLevelCommand(5, 2));
    ```

*   **Tree - expand/collapse by key**  
    It is now possible to expand and collapse tree nodes via key interaction. For this the `TreeExpandCollapseKeyAction` was introduced. On registering the default `TreeLayerExpandCollapseKeyBindings` this action will be bound to the space key. Note that the binding requires the `SelectionLayer` and the `TreeLayer` to work correctly.
    
    ```java
    // adds the key bindings that allows pressing space bar to 
    // expand/collapse tree nodes 
    natTable.addConfiguration( 
        new TreeLayerExpandCollapseKeyBindings( 
            bodyLayerStack.getTreeLayer(), 
            bodyLayerStack.getSelectionLayer()));
    ```

*   **GroupBy feature enhancements/corrections**  
    There were numerous bug reports regarding the groupBy feature. They were mostly related to the usage of the wrong `IDisplayConverter` or the wrong `Comparator`. To solve the issues regarding the `IDisplayConverter` issues, the `GroupByDisplayConverter` was introduced. It is registered by default via `GroupByDataLayerConfiguration`. If you are not using the default configuration, you need to ensure to register it in your custom configuration in order to solve the converter issues.
    
    To solve the issues related to sorting, it is necessary to enrich the `GroupByDataLayer` with additional information. The `ISortModel` is needed to retrieve the correct `Comparator`, the `TreeLayer` is needed to be able to determine the tree column in order to be able to sort the tree nodes, and the `GroupByDataLayer` reference is needed to be able to sort by summary values. The necessary references can be set using the newly introduced initialize method.
    
    ```java
    // connect ISortModel, TreeLayer and GroupByDataLayer to the 
    // Comparator to support sorting by groupBy summary values 
    bodyLayerStack.getBodyDataLayer().initializeTreeComparator( 
        sortHeaderLayer.getSortModel(), 
        bodyLayerStack.getTreeLayer(), 
        true);
    ```

    This is also the reason for the API change in `ISortModel`.
    
*   **Excel Export - Exporter configuration**  
    It is now possible to configure the charset and the sheet name to use when exporting a NatTable using the core `ExcelExporter`. The following code will for example register an `ExcelExporter` that exports a NatTable in UTF-8, setting the sheet name of the Excel sheet to _My data_.
    
    ```java
    ExcelExporter exporter = new ExcelExporter(); 
    exporter.setCharset("UTF-8"); 
    exporter.setSheetname("My data"); 
    configRegistry.registerConfigAttribute( 
        ExportConfigAttributes.EXPORTER, 
        exporter);
    ```

    The `PoiExcelExporter` in the Apache POI extension now also allows to set the sheet name.
*   The `CalculatedValueCache`, that is internally used for the calculation and caching of summary values, is now using the `ConcurrentHashMap` to avoid concurrency issues related to the usage of `HashMap`. See [here](http://mailinator.blogspot.ch/2009/06/beautiful-race-condition.html) for a more detailed description on that issue.