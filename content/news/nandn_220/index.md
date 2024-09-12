---
title: "NatTable 2.2.0 - New & Noteworthy"
date: 2023-06-30T00:00:00-00:00
summary: "Nebula NatTable 2.2.0 released"
categories: ["news"]
---

The NatTable 2.2.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. The 2.2.0 release mainly contains some extensions and fixes in the area of filtering. We would like to thank everyone involved for their commitment and support on developing the 2.2.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Despite the enhancements and new features there are several bugfixes related to issues on filtering.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.2.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=2.2.0).

### Maven Central

Because of a mistake in the publishing process, the 2.2.0 artefacts in Maven Central are incorrect. To consume the correct NatTable 2.2.0 artefacts, you need to consume version 2.2.0.1, e.g. [NatTable Core 2.2.0.1](https://repo1.maven.org/maven2/org/eclipse/nebula/widgets/nattable/org.eclipse.nebula.widgets.nattable.core/2.2.0.1/)".

### API changes

*   Several modifications were made to increase the extensibility of NatTable. Some additional methods are added and the visibility of some existing methods is increased. Existing code should work unchanged.  
    Below is the list of those methods, the details can be found in the _Enhancements and new features_ section.
    
    *   `ComboBoxCellEditor#getComboBoxDataProvider()`
    *   `ComboBoxFilterUtils#isFilterActive(FilterRowDataLayer, IComboBoxDataProvider, IConfigRegistry)`
    *   `FilterNatCombo#createAddToFilterItemViewer()`
    *   `FilterNatCombo#updateAddToFilterVisibility(TableItem)`
    *   `FilterNatCombo#resetAddToFilter(TableItem)`
    *   `FilterNatCombo#isFilterActive()`
    *   `FilterNatCombo#getSelectAllLabel()`
    *   `FilterNatCombo#getAddToFilterLabel()`
    *   `FilterRowComboBoxCellEditor#isApplyFilterOnDropdownFilter()`
    *   `FilterRowComboBoxCellEditor#isCloseOnEnterInDropdownFilter()`
    *   `FilterRowComboBoxDataProvider#isFilterApplied()`
    *   `ComboBoxFilterRowHeaderComposite#setAllValuesSelected(boolean)`
    
    Below is the list of new constructors
    *   `FilterRowMouseEventMatcher(int)`
*   Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name. Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for bugfixing.
    *   `FilterNatCombo#addToFilterItemViewer`
    *   `FilterNatCombo#initialSelection`

### Enhancements and new features

*   **Filter content on filtering the combobox content**  
    
    The `NatCombo` is extended to support registering a `ModifyListener` and a `KeyListener` on the dropdown filter textfield, which can be used to filter the dropdown content. This way it is possible to directly trigger a filter operation on the NatTable when the filter dropdown content is filtered.
    
    This feature was already introduced with 2.1.0. But with the implementation there it was not possible to extend an existing filter by applying a different filter in the opened dropdown, as the filter was always replaced. With 2.2.0 the filter dropdown will show an additional entry _Add current selection to filter_ which allows to update the NatTable filter instead of simply replacing it.
    
    The following example contains a demonstration on the usage:  
    _**Tutorial Examples -> Integration -> SortableAllFilterPerformanceColumnGroupExample**_
    
*   **Context menu on filter row cells**  
    
    The `FilterRowMouseEventMatcher` was extended to support the check for the clicked mouse button. This way it is now possible to open the column header context menu on right click in the filterrow, instead of activating the filter editor.
    
*   **FilterNatCombo / FilterRowComboBoxCellEditor**  
    
    The visibility of several methods and properties got increased to support better subclassing of those two classes.
    
*   **ComboBoxFilterUtils - check for applied filter**  
    
    There is now a helper method that can be used to check if a filter is applied based on the current filter state. Additionally it is of course also possible to check if a filter is applied by comparing the size of the FilterList with the size of the underlying base list.