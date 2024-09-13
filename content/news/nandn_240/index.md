---
title: "NatTable 2.4.0 - New & Noteworthy"
date: 2024-05-23T00:00:00-00:00
summary: "Nebula NatTable 2.4.0 released"
categories: ["news"]
---

The NatTable 2.4.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. We would like to thank everyone involved for their commitment and support on developing the 2.4.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Almost every change in code is tracked via [GitHub Issues](https://github.com/eclipse-nattable/nattable/milestone/3?closed=1), so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.4.0 release, have a look there.

### API changes

*   Several modifications were made to increase the extensibility of NatTable. Some additional methods are added and the visibility of some existing methods is increased. Existing code should work unchanged.  
    Below is the list of those methods, the details can be found in the _Enhancements and new features_ section.
    *   `DataChangeHandler#isDirty()`
    *   `DataChangeLayer#isDirty()`
    *   `TextCellEditor#getTextKeyListener()`
    *   `UiBindingRegistry#registerFirstMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction)`
    *   `UiBindingRegistry#registerMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction)`
    *   `UiBindingRegistry#registerFirstMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction, boolean)`
    *   `UiBindingRegistry#registerMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction, boolean)`
    *   `GroupByModel#addAllGroupByColumnIndexes(int...)`
    *   `GroupByModel#setGroupByColumnIndexes(int...)`
    *   `GroupByModel#removeAllGroupByColumnIndexes(int...)`
*   Below is the list of methods that are deprecated with the 2.4.0 release.
    *   `UiBindingRegistry#registerFirstMouseMoveBinding(IMouseEventMatcher, IMouseAction)`
    *   `UiBindingRegistry#registerMouseMoveBinding(IMouseEventMatcher, IMouseAction)`

### Enhancements and new features

*   **Mouse move binding improvements**  
    
    The mouse move binding handling is improved to be more specific in enter and exit matching. You now register the binding with a `IMouseEventMatcher` and a `IMouseAction` that should be executed once the matcher matches (enter), and a `IMouseAction` that should be executed once the matcher does not match anymore (exit). This way it is not necessary anymore to register additional cleanup move bindings, that are basically executed on every move, e.g. if the mouse cursor should change if it moves over an icon, it should reset if it is not over the icon anymore.
    
    This change simplifies the move binding registration, reduces the number of move bindings as there don't need to be additional cleanup bindings, and improves the general performance if multiple move bindings and cleanup bindings are registered, as there is no need to execute the cleanup bindings on every movement.
    
    ```java
    // Mouse move - Show resize cursor 
    uiBindingRegistry.registerFirstMouseMoveBinding( 
        new ColumnResizeEventMatcher(SWT.NONE, GridRegion.COLUMN_HEADER, 0), 
        new ColumnResizeCursorAction(), 
        new ClearCursorAction());
    ```

*   **GroupByModel - group multiple columns at once**  
    
    The `GroupByModel` now provides additional methods to make it easier to set a grouping by multiple columns programmatically at once.
    
*   **TextCellEditor - option to replace the IKeyListener**  
    
    It is now possible to extend the `TextCellEditor` and exchange the `IKeyListener` by overriding the new method `TextCellEditor#getTextKeyListener()`.
    
*   **General isDirty check**  
    
    The `DataChangeHandler` implementations and the `DataChangeLayer` now provide a method to check the dirty state in general. This is useful for example if you want to set the dirty state of a part in Eclipse if a value in the NatTable was changed.