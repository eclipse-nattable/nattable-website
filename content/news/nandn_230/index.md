---
title: "NatTable 2.3.0 - New & Noteworthy"
date: 2024-02-19T00:00:00-00:00
summary: "Nebula NatTable 2.3.0 released"
categories: ["news"]
---

The NatTable 2.3.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. We would like to thank everyone involved for their commitment and support on developing the 2.3.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Despite the enhancements and new features there are several bugfixes related to issues on filtering.

Almost every change in code is tracked via [GitHub Issues](https://github.com/eclipse-nattable/nattable/milestone/2?closed=1), so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.3.0 release, have a look there.

### API changes

*   Several modifications were made to increase the extensibility of NatTable. Some additional methods are added and the visibility of some existing methods is increased. Existing code should work unchanged.  
    Below is the list of those methods, the details can be found in the _Enhancements and new features_ section.
    
    *   `AbstractTextPainter#isCutText()`
    *   `AbstractTextPainter#setCutText(boolean)`
    *   `ColumnGroupsCommandHandler#getPositionsToProcess()`
    *   `ComboBoxCellEditor#isFocusOnDropdownFilter()`
    *   `ComboBoxCellEditor#isLinkItemAndCheckbox()`
    *   `ComboBoxCellEditor#setFocusOnDropdownFilter(boolean)`
    *   `ComboBoxCellEditor#setLinkItemAndCheckbox(boolean)`
    *   `EditSelectionCommandHandler#getCellsForEditing(SelectionLayer, IUniqueIndexLayer, IConfigRegistry, boolean)`
    *   `EditSelectionCommandHandler#handleOnlyAllSelectedEditable(IConfigRegistry)`
    *   `EditUtils#getEditableCellsInSelection(SelectionLayer, IConfigRegistry)`
    *   `EditUtils#getEditableCellsInSelection(SelectionLayer, IUniqueIndexLayer, IConfigRegistry)`
    *   `EditUtils#isCellEditable(ILayerCell, IConfigRegistry)`
    *   `EditUtils#isCellEditable(ILayerCell, IConfigRegistry)`
    *   `ExportCommand#isUseProgressDialog()`
    *   `ExportCommand#setUseProgressDialog(getExporter)`
    *   `FilterRowComboBoxCellEditor#addNatComboListener(FilterNatCombo)`
    *   `FilterRowComboBoxCellEditor#configureDropdownFilter(boolean, boolean, boolean)`
    *   `FilterRowComboBoxDataProvider#configureComparator(ILayer, IConfigRegistry)`
    *   `FilterRowComboBoxDataProvider#getColumnComparator(int)`
    *   `FilterRowComboBoxDataProvider#setContentFilter(Predicate)`
    *   `LabelStack#hasAllLabels(String[])`
    *   `LabelStack#hasAllLabels(List)`
    *   `MarkupDisplayConverter#getMarkupProcessors(ILayerCell)`
    *   `MarkupDisplayConverter#registerMarkupForLabel(String, String, String, String...)`
    *   `MarkupDisplayConverter#registerMarkupForLabel(String, String, String, List)`
    *   `MarkupDisplayConverter#registerRegexMarkupForLabel(String, String, String, String...)`
    *   `MarkupDisplayConverter#registerRegexMarkupForLabel(String, String, String, List)`
    *   `MarkupDisplayConverter#registerMarkupForLabel(MarkupProcessor, String...)`
    *   `MarkupDisplayConverter#registerMarkupForLabel(MarkupProcessor, List)`
    *   `MarkupDisplayConverter#unregisterMarkupForLabel(String...)`
    *   `NatCombo#showDropdownControl(boolean, boolean)`
    *   `NatExporter#exportLayer(ILayerExporter, OutputStream, IProgressMonitor, String, ILayer, IConfigRegistry, boolean)`
    *   `NatExporter#exportLayer(ITableExporter, OutputStream, IProgressMonitor, ILayer, IConfigRegistry)`
    *   `NatExporter#finalizeExportProcess(ILayer, IClientAreaProvider)`
    *   `NatExporter#getProgressMonitorDialog()`
    *   `NatExporter#getExportSubTaskName()`
    *   `NatExporter#getPrepareSubTaskName()`
    *   `NatExporter#isUseProgressDialog()`
    *   `NatExporter#prepareExportProcess(ILayer, IConfigRegistry)`
    *   `NatExporter#setUseProgressDialog(boolean)`
    *   `NatGridLayerPainter#doCommand(ILayer, RowSizeConfigurationCommand)`
    *   `NatGridLayerPainter#getConfiguredDefaultRowHeight()`
    *   `NatGridLayerPainter#registerCommandHandler()`
    *   `NatGridLayerPainter#unregisterCommandHandler()`
    *   `PercentageBarDecorator#convertDataType(ILayerCell, IConfigRegistry)`
    *   `PopupMenuBuilder#build(boolean)`
    *   `PopupMenuBuilder#buildSubMenu()`
    *   `PopupMenuBuilder#getNatEventData()`
    *   `PopupMenuBuilder#isEnabled(String)`
    *   `PopupMenuBuilder#isVisible(String)`
    *   `PopupMenuBuilder#withSubMenu(String)`
    *   `PopupMenuBuilder#withSubMenu(String, String)`
    *   `PopupMenuBuilder#withSubMenu(String, String, ImageDescriptor)`
    *   `RowGroupsCommandHandler#getPositionsToProcess()`
    *   `SearchDialog - increased visibility to several fields and methods and added methods to make it extensible and localizable`
    *   `SortIconPainter#setSortImages(List, List)`
    *   `SortIconPainter#setSortImages(List, List)`
    
    Below is the list of new constructors
    
    *   `ColumnGroupsCommandHandler(ColumnGroupHeaderLayer, SelectionLayer, boolean)`
    *   `ComboBoxFilterRowHeaderComposite(ComboBoxGlazedListsFilterStrategy, FilterRowComboBoxDataProvider, ILayer, FilterRowDataLayer, IConfigRegistry, boolean)`
    *   `ExportCommand(IConfigRegistry, Shell, boolean, boolean)`
    *   `ExportCommand(IConfigRegistry, Shell, boolean, boolean, ILayerExporter)`
    *   `FilterNatCombo(Composite, IStyle, int, int, boolean, boolean)`
    *   `FilterNatCombo(Composite, IStyle, int, int, Image, boolean, boolean)`
    *   `FilterRowDataLayer(IFilterStrategy, ILayer, IDataProvider, IConfigRegistry, boolean)`
    *   `FilterRowHeaderComposite(ILayer, FilterRowDataLayer)`
    *   `NatCombo(Composite, IStyle, int, int, boolean, boolean)`
    *   `NatCombo(Composite, IStyle, int, int, Image, boolean, boolean)`
    *   `NatExporter(Shell, boolean, boolean)`
    *   `NatGridLayerPainter(NatTable, int, boolean)`
    *   `NatGridLayerPainter(NatTable, Color, int, boolean)`
    *   `PopupMenuBuilder(NatTable, PopupMenuBuilder, Menu)`
    *   `PopupMenuBuilder(NatTable, PopupMenuBuilder, MenuManager)`
    *   `RowGroupsCommandHandler(RowGroupHeaderLayer, SelectionLayer, boolean)`
    *   `SearchAction(SearchDialogCreator)`
    *   `SearchAction(NatTable, IDialogSettings, SearchDialogCreator)`
    
    Below is the list of new constants
    
    *   `AbstractTextPainter#NEW_LINE_PATTERN`
    *   `EditConfigAttributes#MULTI_EDIT_ALL_SELECTED_EDITABLE`
    
    Below is the list of new classes
    *   `ColumnDragMode`
    *   `FilterNatCombo#LinkItemAndCheckboxMouseListener`
    *   `MarkupDisplayConverter#MarkupValueForLabels`
    *   `RowDragMode`
    *   `SearchAction#SearchDialogCreator`
*   Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name. Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for bugfixing.
    *   `MarkupDisplayConverter#markupsForLabels`
    *   `NatCombo#linkItemAndCheckbox`
    *   `PopupMenuBuilder#parentBuilder`
    *   `SearchDialog - increased visibility to several fields and methods and added methods to make it extensible and localizable`

### Enhancements and new features

*   **Context Menu - Add support for adding sub menus**  
    
    It is now possible to configure sub menus via the `PopupMenuBuilder`.
    
    ```java
    this.bodyMenu = new PopupMenuBuilder(natTable) 
        .withInspectLabelsMenuItem() 
        .withSubMenu("Freeze") 
            .withFreezeColumnMenuItem() 
            .withFreezeRowMenuItem() 
            .withFreezePositionMenuItem(true) 
            .withUnfreezeMenuItem() 
            .buildSubMenu() 
        .build(true);
    ```

*   **MarkupDisplayConverter - Register markups for labels**  
    
    It is now possible to register markups via the `MarkupDisplayConverter` also for labels. This makes it possible to create combinations of general markups (e.g. search result highlighting) in combination with special label based formatting (e.g. background color or font style for a column).
    
*   **NatExporter/ExportCommand - Report progress via ProgressMonitorDialog**  
    
    By default the progress of an export is either not reported to a user, or shown in a tiny custom progress shell. You can now configure that the progress should be reported via `ProgressMonitorDialog`. The easiest way to achieve this, is to execute a `ExportCommand` with the corresponding configuration.
    
    Additionally it is now possible to pass the `ILayerExporter` to use with the `ExportCommand`, which makes it easier to offer different export functions in one NatTable instance:
    
    ```java
    return super.createCornerMenu(natTable) 
        .withStateManagerMenuItemProvider() 
        .withClearAllFilters() 
        .withSubMenu("Export") 
            .withMenuItemProvider((natTable1, popupMenu) -> { 
                MenuItem export = new MenuItem(popupMenu, SWT.PUSH); 
                export.setText(Messages.getLocalizedMessage("Export to CSV")); 
                export.setEnabled(true); 
                export.addSelectionListener(new SelectionAdapter() { 
                    @Override 
                    public void widgetSelected(SelectionEvent e) { 
                        natTable.doCommand( 
                            new ExportCommand( 
                                natTable.getConfigRegistry(), 
                                natTable.getShell(), 
                                true, 
                                true, 
                                new CsvExporter())); 
                    } }); 
                }) 
            .withMenuItemProvider((natTable1, popupMenu) -> { 
                MenuItem export = new MenuItem(popupMenu, SWT.PUSH); 
                export.setText(Messages.getLocalizedMessage("Export to Excel")); 
                export.setEnabled(true); 
                export.addSelectionListener(new SelectionAdapter() { 
                    @Override 
                    public void widgetSelected(SelectionEvent e) { 
                        natTable.doCommand( 
                            new ExportCommand( 
                                natTable.getConfigRegistry(), 
                                natTable.getShell(), 
                                true, 
                                true)); 
                    } 
                }); 
            }) 
            .withExportToImageMenuItem() 
            .buildSubMenu();
    ```

*   **Improve usability with checkbox editors**  
    
    There are some small enhancements that could improve the usability of the `NatCombo`, the `FilterNatCombo` and the cell editors that use these controls.
    
    1.  Link item and checkbox  
        If checkboxes are used in the dropdown (e.g. in the Excel-like filter dropdown), the user needed to select the checkbox to enable or disable a filter value. It is now configurable if a click on the item shouled also change the checkbox state.
    2.  Trigger multi-selection on key interaction (SPACE)  
        If checkboxes are used in the dropdown (e.g. in the Excel-like filter dropdown), and a users moves the selection in the dropdown via arrow keys and triggers a multi-selection via CTRL or SHIFT modifier key, and then presses SPACE, now all selected items change the checkbox state.
    3.  Set focus on the filter control of the combobox  
        It is possible to add a filter textbox to the dropdown, so the user can filter the possible values. It is now possible to configure if the focus should be set on the filterbox instead of the dropdown. This is also possible for the textbox if free editing is enabled on a `NatCombo`.
    4.  Disable selection state in _Select All_ and _Add to selection_ items  
        The `FilterNatCombo` adds two additional items, _Select All_ and, if configured, _Add to selection_. Both items are internally separated `CheckboxTableViewer` and therefore do not share a selection model with the main dropdown that shows the content. For the user this is not visible, as it looks like a single list of items. Previously on clicking items in the dropdown and the additional items, it looked like there are multiple selections active. Now the additional items in the `FilterNatCombo` do not show a selection, to make it clear that there is only a single selection, and the additional items are not itself selectable. They can only be clicked to change the state of the main content.
    
*   **Extensibility and Internationalization**  
    
    Several classes have been extended to:
    
    *   Allow further customization by sub-classing
    *   Allow internationalization
    
    Especially the `SearchDialog` is now extensible and it is possible to create a simplified search dialog, which can be opened via `SearchAction#SearchDialogCreator`.
    
*   **Multi-edit with non-editable cells**  
    
    Typically it is not possible to trigger editing for multiple cells, if not all selected cells are editable. In huge tables where some cells might not be editable, this can become an issue for a user. Therefore we introduced a new configuration attribute `EditConfigAttributes#MULTI_EDIT_ALL_SELECTED_EDITABLE`. If not set, it is interpreted as `true`, which is the current default behavior. Setting it to `false` allows multi-editing even if cells that are not editable are selected.
    
    ```java
    configRegistry.registerConfigAttribute( 
        EditConfigAttributes.MULTI_EDIT_ALL_SELECTED_EDITABLE, 
        Boolean.FALSE);
    ```

    The cells that are not editable are then simply skipped in the processing.
    
*   **NatGridLayerPainter - handle row height changes**  
    
    The `NatGridLayerPainter` is now also a `ILayerCommandHandler` for the `RowSizeConfigurationCommand`, so if a `RowSizeConfigurationCommand` is executed, the fake rows take the new row height. It now also respects dynamic scaling changes.