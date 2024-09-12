---
title: "NatTable 1.4.0 - New & Noteworthy"
date: 2016-06-01T00:00:00-00:00
summary: "Nebula NatTable 1.4.0 released"
categories: ["news"]
---

The NatTable 1.4.0 release was mainly made possible by [CEA LIST](http://www-list.cea.fr/index.php/en/) in order to add new features to the [Papyrus project](https://eclipse.org/papyrus/). There were a lot of contributions in form of ideas, bug reports, discussions and even new features like formula support, fill drag handle, CSS styling and several more you can find in the following sections. We would like to thank CEA LIST for their commitment and support on developing the 1.4.0 release.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.4.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.4.0).

### API changes

*   Deprecated `GlazedListsDataProvider` as the original intended performance boost can not be verified using a current Java version. It also introduces several issues in a multi-threaded environment, since `GlazedListsDataProvider` is not thread-safe.
*   Changed the visibility of `DataLayer#setDataProvider(IDataProvider)` to `public` in order to make it easier to exchange the data shown in a NatTable. There is a new example in the NatTable Examples Application to demonstrate the exchange of the `IDataProvider`:  
    _**Tutorial Examples -> Data -> ChangeDataProviderExample**_

### Enhancements and new features

*   **New NatTable Extensions**  
    There are now two additional NatTable Extensions available:
    *   _Eclipse 4 Extension_  
        Contains CSS styling support and a general selection listener that works with the `ESelectionService`. To use this extension you need at least Eclipse Neon and Java 8.
    *   _Nebula Extension_  
        Contains integration support for the Nebula RichText control. To use this extension you need at least Eclipse Luna.  
        Details are explained below.
*   **NatTable Feature Modifications**  
    The NatTable features now also include the third-party libraries they are making use of. This means for example that the GlazedLists Extension feature also contains the bundle _ca.odell.glazedlists_. This makes it easier to install and consume the NatTable features.
*   **Extended copy & paste support**  
    Added support for copy & paste within NatTable.  
    The following classes are created and used for internal copy & paste:
    *   `InternalCellClipboard`  
        Internal clipboard that is used to temporarily store copied cells for later paste actions. There is one instance created and referenced per NatTable instance.
    *   `InternalCopyDataCommandHandler`  
        `ILayerCommandHandler` that handles the `CopyDataToClipboardCommand` and additionally stores the copied cells in the `InternalCellClipboard`. Supports copy operations only for consecutive selections. Needs to be registered on a layer above the `SelectionLayer`, e.g. the NatTable itself. For formula support the `FormulaCopyDataCommandHandler` sub-class is provided.
    *   `InternalPasteDataCommandHandler`  
        `ILayerCommandHandler` that handles the `PasteDataCommand` to paste the copied cells from the `InternalCellClipboard`. Needs to be registered on a layer above the `SelectionLayer`, e.g. the NatTable itself. For formula support the `FormulaPasteDataCommandHandler` sub-class is provided.
    *   `InternalClipboardStructuralChangeListener`  
        `ILayerListener` that clears the `InternalCellClipboard` on structural changes.
    *   `ClearClipboardAction`  
        `IKeyAction` that can be registered to clear the `InternalCellClipboard`. The `DefaultFormulaConfiguration` registers it for the ESC key.
    *   `PasteDataAction`  
        `IKeyAction` that can be registered to paste data to the current selected position. The `DefaultFormulaConfiguration` registers it for CTRL+V.
    *   `PasteOrMoveSelectionAction`  
        `IKeyAction` that can be registered to paste data to the current selected position if there is something in the `InternalCellClipboard`. Otherwise the selection anchor moves one position down. The `DefaultFormulaConfiguration` registers it for ENTER.
    *   `CopySelectionLayerPainter`  
        Specialized `SelectionLayerPainter` that is used to render a border around cells that are currently stored in the `InternalCellClipboard`. Needs to be set to the `SelectionLayer` via `SelectionLayer#setLayerPainter(ILayerPainter)`.
*   **Formula support**  
    Added formula support similar to the capabilities of well known spreadsheet applications.
    
    To support formulas in NatTable the following classes where added:
    
    *   `FormulaParser`  
        The parser that is used to evaluate formulas and therefore the basic part of the formula support in NatTable. It supports the evaluation of basic mathematical operations and functions, and is able to evaluate cell references.
    *   `FormulaDataProvider`  
        Wrapper around a base `IDataProvider` that makes use of the `FormulaParser` for formula evaluation in case a formula/function is the cell value. The sub-class `FormulaRowDataProvider` that implements the `IRowDataProvider` interface to support row based compositions.
        
        ```java
        IDataProvider dataProvider = 
            new TwoDimensionalArrayDataProvider(new String[26][50]); 
        FormulaDataProvider formulaDataProvider = 
            new FormulaDataProvider(dataProvider); 
        DataLayer bodyDataLayer = 
            new DataLayer(formulaDataProvider);
        ```
    *   `FormulaEditDisplayConverter`  
        `IDisplayConverter` that needs to be registered for `DisplayMode#EDIT` in order to support editing of formulas while in normal mode the formula result will be shown.
    *   `FormulaErrorReporter`  
        A `FormulaErrorReporter` can be registered with the `FormulaDataProvider` to be able to report formula evaluation errors to the user. The default implementation `FormulaTooltipErrorReporter` reports the error to the user via tooltip.
        
        ```java
        bodyLayer.getFormulaDataProvider().setErrorReporter( 
            new FormulaTooltipErrorReporter( 
                natTable, 
                bodyLayer.getDataLayer()));
        ```
    *   `FormulaCopyDataCommandHandler`  
        `FormulaPasteDataCommandHandler`  
        `FormulaFillHandlePasteCommandHandler`  
        Special command handler implementations to handle copy&paste and fill drag operations that update formulas relatively to the paste location.
    *   `DisableFormulaEvaluationCommand`  
        `EnableFormulaEvaluationCommand`  
        Commands to disable/enable formula evaluation at runtime. This can also be done directly via `FormulaDataProvider`.
    *   `DefaultFormulaConfiguration`  
        Default configuration for formula integration to a NatTable.
        
        ```java
        natTable.addConfiguration( 
            new DefaultFormulaConfiguration( 
                bodyLayer.getFormulaDataProvider(), 
                bodyLayer.getSelectionLayer(), 
                natTable.getInternalCellClipboard()));
        ```
    
    There is a new example in the NatTable Examples Application to demonstrate the formula support: _**Tutorial Examples -> Data -> FormulaDataExample**_
    
    A formula always starts with an equal sign (=) and is followed by math operations, cell references, numbers and functions, e.g. _\=SUM(A0:A9)\*0.5_.
    
    The following arithmetic operators are supported to perform basic mathematical operations:
    
    | **Arithmetic operator** | **Meaning**               | **Example** |
    | ----------------------- | ------------------------- | ----------- |
    | \+ (plus sign)          | Addition                  | 3+3         |
    | – (minus sign)          | Subtraction  <br>Negation | 3–1  <br>–1 |
    | \* (asterisk)           | Multiplication            | 3\*3        |
    | / (forward slash)       | Division                  | 3/3         |
    | ^ (caret)               | Exponentiation            | 3^2         |
    
    It is possible to use cell references in formulas to perform calculations based on values in other cells or cell ranges. NatTable uses the same reference mechanism as in other well-known spreadsheet applications.
    
    | **To refer to**                                                  | **Use** |
    | ---------------------------------------------------------------- | ------- |
    | The cell in column A and row 10                                  | A10     |
    | The range of cells in column A and rows 10 through 20            | A10:A20 |
    | The range of cells in row 15 and columns B through E             | B15:E15 |
    | All cells in row 5                                               | 5:5     |
    | All cells in rows 5 through 10                                   | 5:10    |
    | All cells in column H                                            | H:H     |
    | All cells in columns H through J                                 | H:J     |
    | The range of cells in columns A through E and rows 10 through 20 | A10:E20 |
    
    Functions can be used to execute more complicated formulas. They start with the function name and have the values to deal with as parameters in brackets. Note that multiple function parameters need to be separated by a semicolon (;), as the comma could be problematic for localized decimal values. The following functions are supported out of the box:
    
    | **Function** | **Description**                                                        |
    | ------------ | ---------------------------------------------------------------------- |
    | AVERAGE      | Calculates the average of a list of supplied numbers.                  |
    | MOD          | Calculates the remainder from a division between two supplied numbers. |
    | NEGATE       | Negates the given value.                                               |
    | POWER        | Calculates the result of a given number raised to a supplied power.    |
    | PRODUCT      | Calculates the product of a supplied list of numbers.                  |
    | QUOTIENT     | Calculates the quotient of a division.                                 |
    | SQRT         | Calculates the positive square root of a given number.                 |
    | SUM          | Calculates the sum of a supplied list of numbers.                      |
    
    It is possible to add new functions by implementing one of the following classes:
    
    *   `AbstractFunction`
    *   `AbstractMathFunction`
    *   `AbstractMathSingleValueFunction`
    
    and register it to via `FormulaParser#registerFunction(String, Class)`.  
      
    ```java
    // function that simply doubles the given value 
    public class DoubleFunction extends AbstractMathSingleValueFunction { 
        @Override public BigDecimal getValue() { 
            return convertValue(getSingleValue().getValue()) 
                .multiply(BigDecimal.valueOf(2));
        } 
    }
    ```
      
    ```java
    this.formulaDataProvider .registerFunction("DOUBLE", DoubleFunction.class);
    ```

    **Note:**  
    As the instantiation of a function is done at runtime via reflection, the function class needs to be a public class with an empty default constructor!
    
    For exporting formulas the `PoiExcelExporter` in the _Apache POI Extension_ was extended. It is now possible to set a `FormulaParser` so formulas in NatTable are exported as Excel formulas.
    
*   **Fill drag handle**  
    Added the feature to add a fill drag handle similar to well known spreadsheet applications. This can be enabled by simply adding the `FillHandleConfiguration` to a NatTable instance.
    
    ```java
    natTable.addConfiguration( 
        new FillHandleConfiguration(selectionLayer));
    ```

    **Note:**  
    Ensure that the NatTable instance is editable in order to make the fill drag handle work. It is not intended to update cells that are not editable.
    
    The `FillHandleConfiguration` basically adds the following new elements:
    
    *   `FillHandleLayerPainter`  
        Specialized `SelectionLayerPainter` that renders a selection handle on the bottom right of a consecutive selection.
    *   `FillHandleMarkupListener`  
        Listener that will trigger a markup of the cell to which the fill drag handle should be bound.
    *   `FillHandleEventMatcher`  
        `MouseEventMatcher` that returns true in case the mouse moves over the fill drag handle rendered by the `FillHandleOverlayPainter`.
    *   `FillHandleCursorAction`  
        Action that will change the cursor to a small cross to indicate fill drag behavior can be used.
    *   `FillHandleDragMode`  
        `IDragMode` that gets activated once the fill drag handle is dragged.
    *   `FillHandlePasteCommand` & `FillHandlePasteCommandHandler`  
        `ILayerCommandHandler` that handles the `ILayerCommand` which is triggered on releasing the fill drag handle. For formula support the `FormulaFillHandlePasteCommandHandler` sub-class is provided.
    
    It is possible to configure the fill drag handle via the following configuration attributes:
    
    *   `FillHandleConfigAttributes#FILL_HANDLE_REGION_BORDER_STYLE`  
        the line style that should be used to render the border around cells that are contained in the fill area
    *   `FillHandleConfigAttributes#FILL_HANDLE_BORDER_STYLE`  
        the border style of the fill drag handle itself
    *   `FillHandleConfigAttributes#FILL_HANDLE_COLOR`  
        the color of the fill drag handle
    *   `FillHandleConfigAttributes#INCREMENT_DATE_FIELD`  
        the date field that should be incremented when inserting a series of date values via fill drag handle
    *   `FillHandleConfigAttributes#ALLOWED_FILL_DIRECTION`  
        the direction(s) that are allowed for the fill drag handle
    
    The _FormulaDataExample_ in the NatTable Examples Application also demonstrates the fill drag handle: _**Tutorial Examples -> Data -> FormulaDataExample**_
    
    The Papyrus team published a [video](https://www.youtube.com/watch?v=LdP3-wIvWb8) to demonstrate the integration and adaption of the NatTable fill drag handle to Papyrus tables and trees.
    
*   **Delete support**  
    Added support to easily delete values from a NatTable. For this the following classes were added:
    *   `DeleteSelectionCommand`  
        `ILayerCommand` that is used to delete the values in the current selected cells.
    *   `DeleteSelectionCommandHandler`  
        `ILayerCommandHandler` that handles the `DeleteSelectionCommand` Sets the values of the current selected cells to `null`. Needs to be registered a layer above the `SelectionLayer`, e.g. the NatTable itself.
    *   `DeleteSelectionAction`  
        `IKeyAction` that can be registered to trigger the `DeleteSelectionCommand`. The `DefaultFormulaConfiguration` registers it for the DEL key.
*   **Content proposal support in TextCellEditor**  
    Added support for content proposals via JFace `IControlContentAdapter` and `IContentProposalProvider`. The following snippet creates a `TextCellEditor` that provides content proposal on pressing CTRL + SPACE.
    
    ```java
    TextCellEditor textEditor = new TextCellEditor(); 
    textEditor.enableContentProposal( 
        new TextContentAdapter(), 
        new SimpleContentProposalProvider( 
            new String[] { "Flanders", "Simpson", "Smithers" }), 
        KeyStroke.getInstance(SWT.CTRL, SWT.SPACE), 
        null);
    ```

    Further information on JFace content proposals can be found in the [Eclipse Help - Field Assist](http://help.eclipse.org/mars/index.jsp?topic=%2Forg.eclipse.platform.doc.isv%2Fguide%2Fjface_fieldassist.htm)
    
*   **Locale changes at runtime**  
    The NatTable messages class `org.eclipse.nebula.widgets.nattable.Messages` now provides a static method `changeLocale(Locale)` to support locale changes at runtime. This makes it possible to also re-localize the NatTable internal labels, e.g. for NatTable menu items.
    
    NatTable currently only provides translations for English and German. Contributions of additional languages are welcome. Alternatively you can add or replace translation property files via fragments as documented widely.
    
*   **Grid line width configuration**  
    Added the `ConfigAttribute CellConfigAttributes#GRID_LINE_WIDTH` to support the configuration of the grid line width. This was mainly introduced because of print issues where grid lines where sometimes not rendered because of rounding issues related to 1px grid lines.
*   **Auto resizing**  
    The `AutoResizeHelper` was introduced to perform in-memory pre-rendering. It is used to perform auto-resizing with `ICellPainter` that are configured to calculate the row height or column width based on the content.
    
    The usage of the `AutoResizeHelper` is important for printing if such dynamic size calculation painters are used and is therefore executed by the `LayerPrinter`.
    
    ```java
    AutoResizeHelper  
        .autoResize(natTable, natTable.getConfigRegistry());
    ```
*   **Filterable comboboxes**  
    The NatCombo and the combo box cell editors that are based on NatCombo now support filters similar to filterable viewers in JFace. Thanks to Ryan McHale who contributed that feature.
    
    The filter can either be enabled directly via `NatCombo` by setting the `showDropdownFilter` constructor parameter to true or by setting the corresponding flag on the editor via `ComboBoxCellEditor#setShowDropdownFilter(boolean)`.
    
    {{< figure src="filterable_filter.png" alt="Filterable Filter">}}
    
*   **Filter: Added wildcard support for regular expression filters**  
    Added the `FilterRowRegularExpressionConverter` that supports simplified wildcard support for regular expression filters. This `IDisplayConverter` will transform \* to the regular expression (.\*) and ? to the regular expression (.?).
    
    ```java
    configRegistry.registerConfigAttribute( 
        FilterRowConfigAttributes.TEXT_MATCHING_MODE, 
        TextMatchingMode.REGULAR_EXPRESSION, 
        DisplayMode.NORMAL, 
        FilterRowDataLayer.FILTER_ROW_COLUMN_LABEL_PREFIX 
            + DataModelConstants.FIRSTNAME_COLUMN_POSITION); 

    configRegistry.registerConfigAttribute( 
        CellConfigAttributes.DISPLAY_CONVERTER, 
        new FilterRowRegularExpressionConverter(), 
        DisplayMode.NORMAL, 
        FilterRowDataLayer.FILTER_ROW_COLUMN_LABEL_PREFIX 
            + DataModelConstants.FIRSTNAME_COLUMN_POSITION);
    ```
*   **Rich text support**  
    The new _NatTable Nebula Extension_ contains support for integrating the [Nebula RichText](http://www.eclipse.org/nebula/widgets/richtext/richtext.php) control. With this integration it is possible to render HTML formatted text in NatTable cells.
    
    There are three classes for integrating the Nebula RichText control:
    
    *   `RichTextCellPainter`  
        `ICellPainter` implementation that makes use of the `org.eclipse.nebula.widgets.richtext.RichTextPainter` to render HTML formatted text.
        
        ```java
        configRegistry.registerConfigAttribute( 
            CellConfigAttributes.CELL_PAINTER, 
            new BackgroundPainter(new RichTextCellPainter()));
        ```
    *   `RichTextCellEditor`  
        `ICellEditor` implementation that makes use of the `org.eclipse.nebula.widgets.richtext.RichTextEditor` to edit HTML formatted text via Nebula RichText control.
        
        ```java
        configRegistry.registerConfigAttribute( 
            EditConfigAttributes.CELL_EDITOR, 
            new RichTextCellEditor());
        ```
        The RichText editor control can be moved by dragging it from the upper left corner and resized by dragging the lower right corner.
    *   `MarkupDisplayConverter`  
        `IDisplayConverter` implementation that wraps another `IDisplayConverter` and is able to wrap a value with HTML tags.
        
        ```java
        MarkupDisplayConverter mc = new MarkupDisplayConverter(); 
        mc.registerMarkup("Simpson", "<em>", "</em>"); 
        mc.registerMarkup("Smithers", 
            "<span style="background-color:rgb(255, 0, 0)"><strong><s><u>", 
            "</u></s></strong></span>"); 
        configRegistry.registerConfigAttribute( 
            CellConfigAttributes.DISPLAY_CONVERTER, 
            mc);
        ```
    
    There is a new example in the NatTable Examples Application to demonstrate the RichText integration:  
    _**Tutorial Examples -> Configuration -> NebulaRichTextIntegrationExample**_
    
    {{< figure src="richtext.png" alt="Nebula RichText Integration">}}
    
    **Note:**  
    The `RichTextCellEditor` is committed on pressing CTRL + ENTER.
    
*   **E4 Selection Listener**  
    The new _Eclipse 4 Extension_ contains a default implementation of a selection listener that provides a selection via `ESelectionService`. It is an `ILayerListener` implementation that needs to be registered on the `SelectionLayer`.
    
    ```java
    E4SelectionListener esl = new E4SelectionListener<>( 
        service, 
        selectionLayer, 
        bodyRowDataProvider); 
    selectionLayer.addLayerListener(esl);
    ```

    By default it only reacts on full row selection and sends a `List` of row object values. Therefore an Eclipse 4 selection listener could look like this.
    
    ```java
    @Inject
    @Optional 
    void handleSelection( 
        @Named(IServiceConstants.ACTIVE_SELECTION) List selected) { 

        if (selected != null) { 
            // do something 
        } 
    }
    ```

    This behavior can be changed to send only a single value or react on every cell selection. Check the API for further details.
    
*   **CSS styling**  
    
    The new _Eclipse 4 Extension_ contains support for CSS styling based on the Eclipse 4 CSS engine.
    
    The [NatTable repository](https://git.eclipse.org/c/nattable/org.eclipse.nebula.widgets.nattable.git/) now contains an additional example project _org.eclipse.nebula.widgets.nattable.examples.e4_ based on Eclipse 4. There you can find several examples regarding different CSS styling capabilities, selection listener, popup menu configuration via application model. It will be further improved in the future and possibly published as downloadable application aswell.
    
    **Note:**  
    Styling a NatTable with CSS only works well with the CSS engine in Eclipse Neon M5 and upwards. The reason for this are the following tickets that have been resolved there:
    
    *   [Bug 479896](https://bugs.eclipse.org/bugs/show_bug.cgi?id=479896)
    *   [Bug 484971](https://bugs.eclipse.org/bugs/show_bug.cgi?id=484971)
    
    **CSS Selectors**  
    
    To create a CSS style definition, the general selector NatTable can be used. Additionally a class or id based selector can be used. For example you can create a class based style definition
    
    ```css
    .basic { 
        cell-background-color: white; 
        text-align: left; 
    }
    ```

    And then configure that class for a NatTable instance via `setData()`.
    
    ```java
    natTable.setData(CSSSWTConstants.CSS_CLASS_NAME_KEY, "basic");
    ```
    
    **Note:**  
    If you want to use multiple NatTable instances in one application that should be styled differently, you should not use the general _NatTable_ selector at all. The styles configured for the general selector will always win. Instead you need to use class or id selectors in the CSS style definition and the NatTable configuration.
    
    For NatTable CSS styling pseudo classes are used to specify the NatTable `DisplayMode`. The following table shows the pseudo classes that are supported for NatTable CSS styling:
    
    | **CSS Pseudo Classes** | **Description**                                                                                         |
    | ---------------------- | ------------------------------------------------------------------------------------------------------- |
    | :normal                | `DisplayMode#NORMAL`. Doesn't need to be specified as this is the default.                              |
    | :select                | `DisplayMode#SELECT` used to specify the styling for selected cells.                                    |
    | :edit                  | `DisplayMode#EDIT` used to specify the styling of cells that are currently edited.                      |
    | :hover                 | `DisplayMode#HOVER` used to specify the styling of cells that are hovered by the mouse.                 |
    | :select-hover          | `DisplayMode#SELECT_HOVER` used to specify the styling of selected cells that are hovered by the mouse. |
    
    _Child Selector_  
    In NatTable conditional styling is achieved via configuration labels. These labels are added via `IConfigLabelAccumulator` to cells. For CSS styling these labels can be used in child selectors via id or class based selector.
    
    To inform the CSS engine about the available labels, the `IConfigLabelProvider` interface was introduced, which extends the `IConfigLabelAccumulator` interface. All NatTable default `IConfigLabelAccumulator` are changed to `IConfigLabelProvider` in order to support styling via child selectors. The labels used by a NatTable can be read via `NatTable#getProvidedLabels()` which asks the underlying layers via `AbstractLayer#getProvidedLabels()`. This means, if custom labels that are provided via custom `IConfigLabelAccumulator` should be usable in CSS styling via child selectors, the `IConfigLabelAccumulator` implementation needs to implement `IConfigLabelProvider`.
    
    The following table shows some examples for NatTable related CSS selectors:
    
    | **CSS Selector**                | **Description**                                                                                                                                                                                            |
    | ------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
    | NatTable                        | Style definitions for `DisplayMode#NORMAL`. Applied to all NatTable instances.                                                                                                                             |
    | .basic                          | Style definitions for `DisplayMode#NORMAL`. Applied to NatTable instances that have the CSS class _basic_.                                                                                                 |
    | .basic:select                   | Style definitions for `DisplayMode#SELECT`, which means they are applied to selected cells in NatTable instances that have the CSS class _basic_.                                                          |
    | .basic > .COLUMN\_HEADER        | Style definitions for `DisplayMode#NORMAL`. Applied to cells with config label _COLUMN\_HEADER_ in NatTable instances that have the CSS class _basic_.                                                     |
    | .basic > .COLUMN\_HEADER:select | Style definitions for `DisplayMode#SELECT` and config label _COLUMN\_HEADER_. Applied to column header cells of columns that contain selected cells in NatTable instances that have the CSS class _basic_. |
    
    **CSS Properties**  
    NatTable supports a wide range of CSS properties for style configuration. Most of them can be used on the table and the child level (child selector for label based configurations). A few can only be used on the table level, because they wouldn't have an effect for single cells.
    
    The following table shows the general available CSS properties:
    
    | **CSS Property**                  | **Description**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
    | --------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
    | border                            | CSS property for `CellStyleAttributes.BORDER_STYLE`. Triggers the usage of the `LineBorderDecorator`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
    | border-color                      | CSS property for `CellStyleAttributes.BORDER_STYLE`. Triggers the usage of the `LineBorderDecorator`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
    | border-style                      | CSS property for `CellStyleAttributes.BORDER_STYLE`. Triggers the usage of the `LineBorderDecorator`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
    | border-width                      | CSS property for `CellStyleAttributes.BORDER_STYLE`. Triggers the usage of the `LineBorderDecorator`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
    | cell-background-color             | CSS property for `CellStyleAttributes#BACKGROUND_COLOR`. Triggers the usage of the `BackgroundPainter`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
    | cell-background-image             | CSS property for configuring a background based on an image. Triggers the usage of the `BackgroundImagePainter`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
    | color                             | CSS property for `CellStyleAttributes#FOREGROUND_COLOR`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
    | column-width                      | CSS property to configure the column width. Available values are:<br><br>*   _auto_ - configure automatic width calculation for content painters<br>*   _percentage_ - configure general percentage sizing<br>*   percentage value (e.g. _20%_) - configure specific percentage sizing<br>*   number value (e.g. _100px_) - configure column width<br><br>**Example:**  <br>`column-width: 20%;`                                                                                                                                                                                                        |
    | conversion-error-background-color | CSS property for specifying the background color of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | conversion-error-color            | CSS property for specifying the foreground color of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | conversion-error-font             | CSS property for specifying the font of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
    | conversion-error-font-family      | CSS property for specifying the font family of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
    | conversion-error-font-size        | CSS property for specifying the font size of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | conversion-error-font-style       | CSS property for specifying the font style of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
    | conversion-error-font-weight      | CSS property for specifying the font weight of a text cell editor on conversion error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
    | converter                         | CSS property to configure the display converter. Possible values are:<br><br>*   boolean<br>*   character<br>*   date "\[pattern\]"<br>*   default<br>*   percentage<br>*   byte<br>*   short \[format\]<br>*   int \[format\]<br>*   long \[format\]<br>*   big-int<br>*   float \[format\] \[min-fraction-digits\] \[max-fraction-digits\]<br>*   double \[format\] \[min-fraction-digits\] \[max-fraction-digits\]<br>*   big-decimal \[min-fraction-digits\] \[max-fraction-digits\]<br><br>**Examples:**  <br>`converter: int;`  <br>`converter: date "yyyy-MM-dd";`  <br>`converter: double 2 2;` |
    | decoration                        | CSS property to configure a decoration. Consists of 4 values:<br><br>*   the URI for the decorator icon<br>*   number value for the spacing between base painter and decoration<br>*   the edge to paint the decoration (top\|right\|bottom\|left\|top-right\|top-left\|bottom-right\|bottom-left<br>*   _true_\|_false_ to configure decoration dependent rendering<br><br>**Example:**  <br>`decoration:`  <br>    `left url('./logo\_16.png') 5 true;`                                                                                                                                               |
    | font                              | CSS property for specifying the font via `CellStyleAttributes.FONT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | font-family                       | CSS property for specifying the font family via `CellStyleAttributes.FONT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | font-size                         | CSS property for specifying the font size via `CellStyleAttributes.FONT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
    | font-style                        | CSS property for specifying the font style via `CellStyleAttributes.FONT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
    | font-weight                       | CSS property for specifying the font weight via `CellStyleAttributes.FONT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | grid-line-color                   | CSS property for the color of the grid lines.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
    | grid-line-width                   | CSS property for the width of the grid lines.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
    | image                             | CSS property for `CellStyleAttributes.IMAGE`. Triggers the usage of the `ImagePainter`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
    | invert-icons                      | CSS property to configure whether default decorator icons should be inverted.  <br>Available values: _true_, _false_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | padding                           | CSS property to specify cell padding. Triggers usage of the `PaddingDecorator` if painter resolution is enabled.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
    | padding-bottom                    | CSS property to specify the bottom padding of a cell. Triggers usage of the `PaddingDecorator` if painter resolution is enabled.                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
    | padding-left                      | CSS property to specify the left padding of a cell. Triggers usage of the `PaddingDecorator` if painter resolution is enabled.                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
    | padding-right                     | CSS property to specify the right padding of a cell. Triggers usage of the `PaddingDecorator` if painter resolution is enabled.                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
    | padding-top                       | CSS property to specify the top padding of a cell. Triggers usage of the `PaddingDecorator` if painter resolution is enabled.                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
    | painter                           | CSS property for configuring the painter.  <br>Further information can be found below.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
    | painter-resolution                | CSS property for enabling/disabling the automatic painter resolution based on CSS properties.  <br>Available values: _true_, _false_  <br>Further information can be found below.                                                                                                                                                                                                                                                                                                                                                                                                                       |
    | password-echo-char                | CSS property for `CellStyleAttributes.PASSWORD_ECHO_CHAR`. Does not trigger the usage of the `PasswordTextPainter`. This needs to be done via additional `IConfiguration` or painter CSS property.                                                                                                                                                                                                                                                                                                                                                                                                      |
    | percentage-decorator-colors       | CSS property for configuring the colors to use with the `PercentageBarDecorator`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
    | render-grid-lines                 | CSS property to specify whether grid lines should be rendered or not.  <br>Available values: _true_, _false_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
    | row-height                        | CSS property to configure the row height. Available values are:<br><br>*   auto - configure automatic height calculation for content painters<br>*   percentage - configure general percentage sizing<br>*   percentage value (e.g. 20%) - configure specific percentage sizing<br>*   number value (e.g. 100px) - configure row height<br><br>**Example:**  <br>`row-height: 20px;`                                                                                                                                                                                                                    |
    | text-align                        | CSS property for `CellStyleAttributes.HORIZONTAL_ALIGNMENT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
    | text-decoration                   | CSS property for `CellStyleAttributes.TEXT_DECORATION`.<br><br>Available values: _none_, _underline_, _line-through_<br><br>Combinations are possible via space separated list.<br><br>**Example:**  <br>`text-decoration: underline line-through;`                                                                                                                                                                                                                                                                                                                                                     |
    | text-direction                    | CSS property to specify whether text should be rendered horizontally or vertically. Default is _horizontal_.  <br>Triggers the usage of either `TextPainter` or `VerticalTextPainter`.  <br>Available values: _horizontal, vertical_                                                                                                                                                                                                                                                                                                                                                                    |
    | text-trim                         | CSS property to specify whether text should be trimmed on rendering words or not.  <br>Default is _true_.  <br>Available values: _true_, _false_                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
    | text-wrap                         | CSS property to specify whether text should be trimmed on rendering words or not.  <br>Default is _true_.  <br>Available values: _true_, _false_                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
    | validation-error-background-color | CSS property for specifying the background color of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | validation-error-color            | CSS property for specifying the foreground color of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | validation-error-font             | CSS property for specifying the font of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
    | validation-error-font-family      | CSS property for specifying the font family of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
    | validation-error-font-size        | CSS property for specifying the font size of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | validation-error-font-style       | CSS property for specifying the font style of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
    | validation-error-font-weight      | CSS property for specifying the font weight of a text cell editor on validation error.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
    | vertical-align                    | CSS property for `CellStyleAttributes.VERTICAL_ALIGNMENT`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
    
    The following table shows the CSS properties that are only available on table level (no child selector):
    
    | **CSS Property**       | **Description**                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
    | ---------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
    | background-color       | CSS property for the NatTable background color. This has effect on the area that does not show cells or cells with a transparent background.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | background-image       | CSS property for the NatTable background image. This has effect on the area that does not show cells or cells with a transparent background.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | fill-handle-border     | CSS property to specify the border of the fill drag handle.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
    | fill-handle-color      | CSS property to specify the color of the fill drag handle.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
    | fill-region-border     | CSS property to specify the border style of the fill region.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | freeze-separator-color | CSS property for the color of the freeze separator.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
    | table-border-color     | CSS property to specify the border color that is applied around the NatTable. Triggers the usage of the `NatTableBorderOverlayPainter` to apply borders on every side of the table.<br><br>Setting the value _auto_ will use the configured grid line color as the table border color.                                                                                                                                                                                                                                                                                                                                                                                                                                          |
    | tree-structure-painter | CSS property for configuring the tree structure painter. Similar to painter but specific for the tree structure configuration as it registers a painter for `TreeConfigAttributes.TREE_STRUCTURE_PAINTER`.<br><br>**Note:** The value should always end with _tree_ to configure a valid tree structure painter. It is mainly intended to configure the painter hierarchy (background and decorators) and whether to use inverted default icons via `invert-icons`.<br><br>**Note:** The content painter that should be wrapped by the tree structure painter does not need to be added here aswell because it is evaluated dynamically.<br><br>**Example:**  <br>`tree-structure-painter:`  <br>    `background padding tree;` |
    
    **Painter Configuration**  
    The painter configuration is something special to NatTable. Styling in NatTable is a combination of styles and painters. By default the painters will be derived from the specified style, e.g. specifying an image will trigger the usage of the `ImagePainter`.
    
    There are several cases where this behavior is not intended. NatTable for example has its own inheritance model. If a painter is not found for a label and DisplayMode, first the configuration value is searched for the label and DisplayMode hierarchy, and afterwards without label but with a DisplayMode hierarchy. If painters are registered automatically for CSS style configurations, the NatTable internal inheritance does of course not work anymore, as no search is performed.
    
    The automatic painter registration can be turned off on every level by setting the following CSS property:
    
    ```css
    painter-resolution: false;
    ```

    Painters can also be configured explicitly via CSS property `painter`. This will also disable the automatic painter resolution. The pattern for configuring a painter is  
      
    **_\[background-painter\]?\[decorator\]\*\[content-painter\]?_**,  
      
    although it mostly doesn't make sense to not configure a content painter.
    
    The following table lists the possible values for **background painters**:
    
    | **CSS Painter Value** | **NatTable Painter**        |
    | --------------------- | --------------------------- |
    | background            | `BackgroundPainter`         |
    | gradient-background   | `GradientBackgroundPainter` |
    | image-background      | `BackgroundImagePainter`    |
    
    The following table lists the possible values for **decorator painters**:
    
    | **CSS Painter Value** | **NatTable Painter**           |
    | --------------------- | ------------------------------ |
    | beveled-border        | `BeveledBorderDecorator`       |
    | column-group          | `ColumnGroupHeaderTextPainter` |
    | custom-line-border    | `CustomLineBorderDecorator`    |
    | decorator             | `CellPainterDecorator`         |
    | line-border           | `LineBorderDecorator`          |
    | padding               | `PaddingDecorator`             |
    | row-group             | `RowGroupHeaderTextPainter`    |
    | sort-header           | `SortableHeaderTextPainter`    |
    | tree                  | `IndentedTreeImagePainter`     |
    
    The following table lists the possible values for **content painters**:
    
    | **CSS Painter Value** | **NatTable Painter**                                                                                                                                                               |
    | --------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
    | checkbox              | `CheckBoxPainter`                                                                                                                                                                  |
    | combobox              | `ComboBoxPainter`                                                                                                                                                                  |
    | image                 | `ImagePainter`                                                                                                                                                                     |
    | password              | `PasswordTextPainter`                                                                                                                                                              |
    | percentage            | `PercentageBarCellPainter`                                                                                                                                                         |
    | table                 | `TableCellPainter`                                                                                                                                                                 |
    | text                  | `TextPainter`  <br>`VerticalTextPainter`                                                                                                                                           |
    | none                  | Special value to explicitly set no content painter. Needed because by default the `TextPainter` will be used as fallback in case an invalid value is specified as content painter. |
    
    The following example shows how to register a painter that renders a cell with gradient background and padding around a checkbox.
    
    ```css
    painter: gradient-background padding checkbox;
    ```
    
    _Custom Painters_  
    It is also possible to use custom painters in NatTable CSS painter configurations. For this a `CellPainterCreator` or `CellPainterWrapperCreator`, that creates an instance of the custom painter, needs to be registered to the `CellPainterFactory`.
    
    ```java
    CellPainterFactory 
        .getInstance() 
        .registerContentPainter("custom", (properties, underlying) -> { 
            return new MyPainter(); 
        });
    ```

*   **Extended Print Support**  
    The following modifications and extension where added to the print function of NatTable:
    *   _Pre-rendering_  
        By default the new in-memory pre-rendering is enabled to ensure that content painters that dynamically calculate the row height or content width based on the content of the cell trigger the resize before printing. This behavior can be disabled via `LayerPrinter#disablePreRendering()` and enabled via `LayerPrinter#enablePreRendering()`.
    *   _Increased grid line width_  
        On printing the grid line width will be increased to 2px in case no other explicit configuration is applied. This setting will be decreased again afterwards. The increase of the grid line width is necessary to correct printing issues where grid lines where sometimes not rendered because of rounding issues.