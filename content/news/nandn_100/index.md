---
title: "NatTable 1.0.0 - New & Noteworthy"
date: 2013-05-29T00:00:00-00:00
summary: "Nebula NatTable 1.0.0 released"
categories: ["news"]
---

There are several changes in the infrastructure, the API and the feature set of Nebula NatTable with the 1.0.0 release. Here are the most important ones.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed with the 1.0.0 release have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?list_id=5573174&resolution=FIXED&classification=Technology&query_format=advanced&component=Core&target_milestone=1.0.0&product=NatTable)

### Infrastructure

There are several infrastructural changes in Nebula NatTable.

*   Update of third-party dependency to [GlazedLists](http://www.glazedlists.com/) 1.9
*   Update of third-party dependency to [Apache POI](http://poi.apache.org/) 3.9
*   Modification of the target-platform to replace local library dependencies with Software Site dependencies. This is possible because GlazedLists and Apache POI are now integrated in [Eclipse Orbit](http://www.eclipse.org/orbit/) as OSGi bundles
*   Providing a fully functional p2 update site for NatTable core, its extensions and the corresponding source bundles. See the [download section](http://eclipse.org/nattable/download.php) for details
*   Providing p2 update sites for [SNAPSHOT builds](http://download.eclipse.org/nattable/snapshots/) that are created after changes in the repository occured
*   Publishing the [API Javadoc](http://download.eclipse.org/nattable/releases/1.0.0/apidocs/). Still not complete

### Enhancements and new features

There are several enhancements and new features that were added to Nebula NatTable.

*   Smooth/continuous scrolling of the viewport  
    Before 1.0.0 on scrolling the viewport jumped cell-wise, now scrolling is performed pixel-wise which increases the user experience on scrolling. It also enables the user to scroll large cells that does not fit into the viewport which was not possible before. You do not have to change any of your code to enable this enhancement.
*   Introduced the `AbstractHeaderMenuConfiguration` to make it easier to create new header menus. This one also adds a corner header menu to solve the issue to restore from a state where all columns where hidden.
*   Dialog for managing NatTable states  
    NatTable supports saving and loading of states via `saveState()` and `loadState()` which are working on `java.util.Properties` objects. With NatTable 1.0.0 the state handling was corrected for some layers and added to layers that did not support state handling before. For convenience also a dialog is added that can be used to manage different state sets. To make use of it you need to register the necessary command handler like this:
    
    ```java
    DisplayPersistenceDialogCommandHandler handler = 
        new DisplayPersistenceDialogCommandHandler(); 
    gridLayer.registerCommandHandler(handler);
    ```

    To open the dialog you could add the corresponding menu item to the column header menu like this:
    
    ```java
    natTable.addConfiguration( 
        new HeaderMenuConfiguration(natTable) { 
            @Override protected PopupMenuBuilder createColumnHeaderMenu(NatTable natTable) { 
                return super.createColumnHeaderMenu(natTable) 
                    .withStateManagerMenuItemProvider(); } });
    ```
      
    {{< figure src="viewManagementDialog.png" alt="View Configuration Management Dialog">}}

*   Major refactoring of the editing behaviour  
    We cleaned up the API to prepare for the next generation and made things clearer and stabilized the process for additional features, e.g. creating editors that open in subdialogs, even making use of SWT and JFace dialogs (e.g. FileDialogCellEditor which opens the SWT FileDialog). Additionally with several bugfixes these are quite some tickets that have been fixed. In this forum topic you can find a list of what has been done at this point: [http://www.eclipse.org/forums/index.php/t/452211/](http://www.eclipse.org/forums/index.php/t/452211/)  
    You should only notice these changes in your code if you implemented custom editors. If you created custom editors than check the ICellEditor interface, the AbstractCellEditor and the AbstractDialogCellEditor for details.
*   Added new `EditConfigAttributes`
    
    | `EditConfigAttributes` | Datatype              | Description                                                                                                                                                                                                                           |
    | ---------------------- | --------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
    | `OPEN_IN_DIALOG`       | `Boolean`             | Configure if a cell should be edited inline or in a dialog. Default is `false` for editing inline.                                                                                                                                    |
    | `OPEN_ADJACENT_EDITOR` | `Boolean`             | Configure if the adjacent editor should be opened after committing the value in the current active editor. Will only be interpreted for inline editing. Default is `false` for not opening the adjacent editor.                       |
    | `SUPPORT_MULTI_EDIT`   | `Boolean`             | Configure if the editor supports multi-edit by pressing F2 when multiple cells are selected that have the same editor configured. Default is `true`, which will open a subdialog for multi-editing if the prerequisites match.        |
    | `EDIT_DIALOG_SETTINGS` | `Map<String, Object>` | Configure the appearance of the subdialog that is used for editing. This includes shell title, icon, location, size, resizable state and a custom message. The keys that are supported by this map are specified in `ICellEditDialog` |
    
*   Enhanced the `NatCombo` to support free editing and multiple selection with and without checkboxes in the dropdown part. These configuration can be applied via style bits `SWT.READ_ONLY` for not enabling free editing, `SWT.MULTI` for multi selection behaviour and `SWT.CHECK` for rendering checkboxes. `ComboBoxCellEditors` need to be configured via boolean properties `freeEdit`, `multiselect` and `useCheckbox`.
*   Deprecation of `BodyCellEditorMouseEventMatcher` which needed to be registered in the edit bindings for every `ICellEditor` implementation and replaced it with a more general `CellEditorMouseEventMatcher`. Doing this allows to add new ICellEditors more easily without needing to modify the edit bindings everytime.
*   Corrected and enhanced the tick update handling that is added to NatTable instances with the `DefaultTickUpdateConfiguration` that is part of the `DefaultSelectionLayerConfiguration`. This one allows to increase/decrease number values by using the + and - keys of your keypad.
*   Excel like filter row  
    With this you are able to add a filter row to your NatTable that looks like in Excel, providing the same functionality. It collects all available values in the columns and will filter those values that are not checked in the dropdown.  
    {{< figure src="excelFilter.png" alt="Excel like filter row">}}
      
    To add it to your NatTable use the following code that assumes your body layer stack contains a `GlazedListsEventLayer` and a `FilterList` that wraps the main list:

```java
ComboBoxFilterRowHeaderComposite filterRowHeaderLayer = 
    new ComboBoxFilterRowHeaderComposite(
        bodyLayerStack.getFilterList(), 
        bodyLayerStack.getGlazedListsEventLayer(),
        bodyLayerStack.getSortedList(), 
        columnPropertyAccessor, 
        columnHeaderLayer, 
        columnHeaderDataProvider, 
        configRegistry);
```

*   Added several layers to add support for row reordering and row hide/show according to the column functionality
    *   `RowReorderLayer`
    *   `RowHideShowLayer`
    *   `GlazedListsRowHideShowLayer` to support hiding of rows in a GlazedLists manner.  
        As this layer operates with filters based on row id's, this layer introduced the dependency to `org.apache.commons.codec` and `org.apache.commons.codec.binary` to support persistance of states.
    *   `DetailGlazedListsEventLayer` to transport detail information on GlazedLists changes
*   Extended the API of the `TextPainter` and `VerticalTextPainter` to specify whether the height and/or width should be calculated by content. This is done by using new constructors that allow that explicit configuration.
*   Corrected key modifier in default key bindings from `SWT.CONTROL` to `SWT.MOD1` to correct the key bindings on Mac
*   Several API modifications to increase the flexibility on configuring and extending NatTable classes, e.g. setting the images for expand/collapse in trees. Such modifications are always documented via Javadoc, so have a look at the Javadoc or the detailed list of fixed tickets to find out more.