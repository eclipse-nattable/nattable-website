---
title: "NatTable 2.5.0 - New & Noteworthy"
date: 2024-11-28T00:00:00-00:00
summary: "Nebula NatTable 2.5.0 released"
categories: ["news"]
---

The NatTable 2.5.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. We would like to thank everyone involved for their commitment and support on developing the 2.5.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Almost every change in code is tracked via [GitHub Issues](https://github.com/eclipse-nattable/nattable/milestone/4?closed=1), so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.5.0 release, have a look there.

### API changes

The following modifications to the API were made. Several new classes and interfaces were introduced to support new features. The details can be found in the _Enhancements and new features_ section.

Below is the list of new classes and interfaces

* `DefaultGlazedListsFilterStrategy#ColumnSetMatcherEditor`
* `FillHandleActionHelper`
* `FillHandleBoundsProvider`
* `FillHandleColumnAction`
* `FillHandleCompositeFreezeLayerPainter`
* `FillHandleLayerPainterHelper`
* `FormulaFillHandleActionHelper`
* `FormulaFillHandleColumnAction`
* `GlazedListsLockHelper`
* `GroupByModelListener`
* `IDragModeWithKeySupport`
* `XSSFExcelExporter`

Below is the list of new constructors

* `DefaultFormulaConfiguration(FormulaDataProvider, SelectionLayer, InternalCellClipboard, FillHandleBoundsProvider)`
* `FillHandleConfiguration(SelectionLayer, FillHandleBoundsProvider)`
* `FillHandleEventMatcher(FillHandleBoundsProvider)`

Below is the list of new constants

* `FillHandleConfigAttributes#FILL_HANDLE_SIZE`

Below is the list of new fields

* `FillHandleEventMatcher#fillHandleBoundsProvider`

Below is the list of new methods

* `CompositeLayer#processLayerPainterInformation(ILayerPainter)`
* `DefaultGlazedListsFilterStrategy#getSetMatcherEditor(Integer, Set<String>, IDisplayConverter)`
* `FillHandleLayerPainter#getHandleSize(IConfigRegistry)`
* `GraphicsUtils#getInternalBounds(Rectangle, BorderStyle)`
* `NatCombo#getItemIndex(String)`
* `GroupByModel#addGroupByModelListener(GroupByModelListener)`
* `GroupByModel#fireGroupByModelChange()`
* `GroupByModel#removeGroupByModelListener(GroupByModelListener)`

Below is the list of deprecated constructors

* `FillHandleEventMatcher(FillHandleLayerPainter)`


### Enhancements and new features

*   **Fill handle improvements**  
    
    There are several improvements for the fill handle:
    1. Make it work correctly in combination with the freeze functionality  
       To support the combination of the fill handle and the freeze functionality, the following changes were introduced:

       - Added a new interface `FillHandleBoundsProvider`
       - Added a new helper class `FillHandleLayerPainterHelper` to retrieve fill handle configurations
       - Extended `CompositeLayer#CompositeLayerPainter` and added the method `processLayerPainterInformation(ILayerPainterpainter)` which is called after each sub layer painter
       - Added a new class `FillHandleCompositeFreezeLayerPainter` that makes use of the new `processLayerPainterInformation()` method to store the fill handle bounds from all 4 freeze regions once, and to paint the fill handle over the freeze border
       - Added new constructors in`DefaultFormulaConfiguration` and `FillHandleConfiguration` that additionally takes a `FillHandleBoundsProvider` that should be used with the matcher

        To make the combination of freeze and fill handle work correctly, the `FillHandleCompositeFreezeLayerPainter` needs to be used and configured:

       ```java
       this.compositeFreezeLayerPainter = new FillHandleCompositeFreezeLayerPainter(this.compositeFreezeLayer);
       this.compositeFreezeLayer.setLayerPainter(this.compositeFreezeLayerPainter);

       ... 

       natTable.addConfiguration(
               new FillHandleConfiguration(
                       bodyLayer.getSelectionLayer(),
                       bodyLayer.getCompositeFreezeLayerPainter()));

       natTable.addConfiguration(
               new DefaultFormulaConfiguration(
                       bodyLayer.getFormulaDataProvider(),
                       bodyLayer.getSelectionLayer(),
                       natTable.getInternalCellClipboard(),
                       bodyLayer.getCompositeFreezeLayerPainter()));
       ```

    2. Add option to configure the fill handle size  
       Added the new `ConfigAttribute<Point> FillHandleConfigAttributes#FILL_HANDLE_SIZE` to be able to configure the size of the fill handle.
    3. Added an option to configure a double click action  
       In Excel a double click on the fill handle triggers an automatic fill process for the whole column. To support this also in NatTable, the following changes were introduced:
       - Added a new helper classes `FillHandleActionHelper` and `FormulaFillHandleActionHelper ` for the fill handle menu
       - Added a new classes `FillHandleColumnAction` and `FormulaFillHandleColumnAction` that can be registered on double clicks on the fill handle to trigger an automatic fill operation.
       - Updated the `FillHandleDragMode` to use the `FillHandleActionHelper`
       - Updated the `FormulaFillHandleDragMode` to use the `FormulaFillHandleActionHelper`
       - Updated the `FillHandleConfiguration` to register the `FillHandleColumnAction` on double click by default
       - Updated the `DefaultFormulaConfiguration` to register the `FormulaFillHandleColumnAction` on double click by default


*   **Key interactions in drag mode**  
    
    When an `IDragMode` is active, it was not possible to interact via key press. The following modifications where introduced to solve this:

    1. The `DragModeEventHandler` now implements `keyPressed(KeyEvent)` and `keyReleased(KeyEvent)`
    2. Pressing **ESC** will now in general cancel an active `IDragMode`
    3. The `IDragModeWithKeySupport` interface is introduced. Using this interface it is possible to create a custom drag mode that is able to react on key interactions.
    
    The [_5084_StructuralRowReorderWithoutRowHeaderExample](https://github.com/eclipse-nattable/nattable/blob/master/org.eclipse.nebula.widgets.nattable.examples/src/org/eclipse/nebula/widgets/nattable/examples/_500_Layers/_508_Reorder/_5084_StructuralRowReorderWithoutRowHeaderExample.java) contains an `IDragModeWithKeySupport` that lets you switch from reorder to copy while dragging in item if you press the **CTRL** modifier key.

*   **Add support for exporting to XLSX**  
    
    The _NatTable Apache POI Extension_ now supports exporting to XSSF, which is the POI Project's pure Java implementation of the Excel 2007 OOXML (.xlsx) file format.

    The following Plug-ins were added to the _org.eclipse.nebula.widgets.nattable.extension.poi.feature_ to add this:
    - _org.apache.poi.ooxml_
    - _org.apache.poi.ooxml.schemas_
    - _org.apache.commons.commons-compress_
    - _org.apache.xmlbeans_

    To export to the Excel 2007 OOXML format, you simply need to use the new `XSSFExcelExporter`:
    ```java
    PoiExcelExporter exporter = new XSSFExcelExporter();
    exporter.setApplyVerticalTextConfiguration(true);
    exporter.setApplyBackgroundColor(false);
    natTable.doCommand(
            new ExportCommand(
                    natTable.getConfigRegistry(),
                    natTable.getShell(),
                    false,
                    false,
                    exporter));
    ```

There is a new example [`_819_FormulaDataWithFreezeExample`](https://github.com/eclipse-nattable/nattable/blob/master/org.eclipse.nebula.widgets.nattable.examples/src/org/eclipse/nebula/widgets/nattable/examples/_800_Integration/_819_FormulaDataWithFreezeExample.java) that shows the combination of formula support, fill handle, freeze, the export to XLSX and showing the JFace `ProgressDialog` on export.

* **Performance updates for Excel-like filter row**

Several improvements for the Excel-like filter row where introduced to improve the performance when opening a filter combobox. 
Doing this also uncovered a possible deadlock situation when updating the content of the underlying GlazedLists datamodel.
To solve this, the `Lock#lock()` calls in NatTable code are replaced with `Lock#tryLock()` in a loop. 
To make it easier for NatTable users to adopt the same approach, the `GlazedListsLockHelper` was introduced. 

If you have code in your project that looks like this:

```java
bodyLayerStack.getSortedList().getReadWriteLock().writeLock().lock();
try {
    // deactivate
    bodyLayerStack.getGlazedListsEventLayer().deactivate();
    // clear
    bodyLayerStack.getSortedList().clear();
    // addall
    bodyLayerStack.getSortedList().addAll(PersonService.getExtendedPersonsWithAddress(1000));
} finally {
    bodyLayerStack.getSortedList().getReadWriteLock().writeLock().unlock();
    // activate
    bodyLayerStack.getGlazedListsEventLayer().activate();
}
```

You can replace it by using the `GlazedListsLockHelper` like this:

```java
GlazedListsLockHelper.performWriteOperation(
    bodyLayerStack.getSortedList().getReadWriteLock(),
    () -> {
        // deactivate
        bodyLayerStack.getGlazedListsEventLayer().deactivate();
        // clear
        bodyLayerStack.getSortedList().clear();
        // addall
        bodyLayerStack.getSortedList().addAll(PersonService.getExtendedPersonsWithAddress(1000));
    },
    () -> {
        // activate
        bodyLayerStack.getGlazedListsEventLayer().activate();
    });
```