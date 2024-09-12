---
title: "NatTable 1.5.0 - New & Noteworthy"
date: 2017-03-20T00:00:00-00:00
summary: "Nebula NatTable 1.5.0 released"
categories: ["news"]
---

The NatTable 1.5.0 release was mainly made possible by Siemens in order to extend the NatTable features on printing and exporting. There were a lot of contributions in form of ideas, bug reports, discussions and even new features like fit-to-page scaling on printing, correct page breaks, repeating column headers, image exports and several more you can find in the following sections. We would like to thank Siemens for their commitment and support on developing the 1.5.0 release.

Of course we would also like to thank our contributors for adding new functions and fixing issues.

Despite the enhancements and new features there are numerous bugfixes related to issues on concurrency, scaling or performance for NatTables with huge column sets.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.5.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.5.0).

### API changes

*   Several modifications were made to increase the extensibility of NatTable. Some additional methods are added and the visibility of some existing methods is increased. Existing code should work unchanged.  
    The details can be found in the _Enhancements and new features_ section.
*   Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name. Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields here. The explanations can be taken from the sections below.
    *   `AbstractTextPainter#lineSpacing`
    *   `AbstractTextPainter#wordWrapping`
    *   `AutoResizeHelper#prevArea`
    *   `ColumnReorderLayer#indexPositionMapping`
    *   `DefaultNatTableThemeConfiguration#copyBorderStyle`
    *   `DefaultNatTableThemeConfiguration#fillHandleBorderStyle`
    *   `DefaultNatTableThemeConfiguration#fillHandleColor`
    *   `DefaultNatTableThemeConfiguration#fillHandleRegionBorderStyle`
    *   `FileOutputStreamProvider#extFilterIndex`
    *   `NatExporter#exportSucceeded`
    *   `NatExporter#openResult`
    *   `NatExporter#preRender`
    *   `NatTable#eventListenerLock`
    *   `PopupMenuBuilder#EXPORT_IMAGE_MENU_ITEM_ID`
    *   `RichTextCellEditor#editorConfiguration`
    *   `RichTextCellPainter#calculateByTextHeight`
    *   `RichTextCellPainter#calculateByTextLength`
    *   `RowReorderLayer#indexPositionMapping`

### Behavioural changes

*   We added auto-scrolling support for column and row reordering, cell selection and fill handle dragging. For column reordering the existing behavior so far was to start auto-scrolling if the mouse cursor was moved on dragging to the table edges, where the area was about 10 pixels that triggered auto-scrolling. Instead the auto-scrolling is now triggered if you move to the borders, where the area has increased to 25 pixels, where the amount of pixels is scaled to the DPI settings of the screen. Additionally the scrolling speed is increased the more the mouse cursor moves over the border of the table.

### Enhancements and new features

*   **NatTable Examples Application**  
    
    The NatTable Examples Application is now provided as an Eclipse 4 RCP application. It contains all available examples, also the Eclipse 4 related ones.
    
    {{< figure src="nattable_examples.png" alt="NatTable Examples Application">}}
    
    We decided to discontinue the plain SWT Webstart application because of various issues on multiple operating systems. The plain SWT application is still provided, but not directly executable via Webstart. For more information have a look at [NatTable Examples Application]({{< ref "/examples" >}})
    
*   **Export - Increased extensibility of the exporter framework**  
    To make it easier to create custom exporters and to execute an export for different exporters, the exporter framework was extended. Two new interfaces are introduced:
    
    *   `IExporter` - Base interface for exporters.
    *   `ITableExporter` - Exporter interface that makes it possible to implement the export functionality completely internally.
    
    While the existing `ILayerExporter` is intended to export the data and therefore the NatTable is exported cell by cell, the newly introduced `ITableExporter` allows to implement the export based on the whole table.
    
    There are new methods in `NatExporter` that take either an `ITableExporter` or an `ILayerExporter`. Additionally there are methods that will resolve the exporter to use out of the `IConfigRegistry`. The `ITableExporter` can be configured via the new `ExportConfigAttributes#TABLE_EXPORTER` config attribute.
    
*   **Export - Additional default exporter implementations**  
    We received two contributions related to exporting:
    
    *   `CsvExporter` - this exporter was contributed by Uwe Peuker and can be used to export the content of a NatTable to a CSV file.
    *   `ImageExporter` - this exporter was contributed by Thanh Liem PHAN and can be used to export a NatTable to an image. This exporter needs to be used with care. Because of OS restrictions it is not possible to export huge NatTables to an image. It will result in SWT exceptions.
    
    In this context Uwe Peuker additionally contributed the `FilePathOutputStreamProvider` to perform an export to a prior specified file instead of asking on export.
    
    Thanh Liem PHAN also contributed a default configuration `DefaultImageExportBindings` to easily add the image export capability and bind it to _CTRL + I_. The `PopupMenuBuilder` was also extended for a new method `withExportToImageMenuItem()` to be able to add a menu item to a NatTable header menu.
    
*   **Export - Possibility to report export errors to the user**  
    Errors that occur on exporting a NatTable are no longer only logged. They are propagated wrapped in a `RuntimeException` to the calling `NatExporter`. For handling the exceptions `NatExporter#handleExportException(Exception)` is introduced, that by defaults logs the exception and opens the also newly introduced `ExceptionDialog`.  
    To customize the behavior you can extend `NatExporter` and override `handleExportException(Exception)`.
*   **Export - Configurability if export should be opened or not**  
    By default the export result will be opened by launching the operating system executable associated with the file. This behavior can be changed via `NatExporter#setOpenResult(boolean)`.
*   **Export - Configurability if the NatTable should be pre-rendered in-memory**  
    The `NatExporter` can be configured for in-memory pre-rendering. It is used to ensure that cell dimensions that are calculated on rendering are applied before the export. This feature is enabled by default and can be disabled via `NatExporter#disablePreRendering()`. To enable it again `NatExporter#enablePreRendering()` can be used.
    
    This feature is mostly needed to make the export of cell dimensions work correctly in any case. If dynamic cell dimensions are not used the export performance can be increased by disabling the pre-rendering.
    
*   **Export - POI Extension - Respect text wrapping**  
    
    Via `NatExporter#setApplyTextWrapping(boolean)` it is possible to configure whether the exporter should check for text wrapping configuration in NatTable text painters and apply the corresponding style attribute in the export, or not.
    
    **Note:**  
    As showing text wrapping in NatTable is not a style information but a configured via painter implementation, the check whether text is wrapped needs to be done via reflection. Therefore enabling this configuration could cause performance issues. As wrapped text is not the default case and the effect on performance might be negative, this configuration is disabled by default.
    
*   **Export - POI Extension - Export cell dimensions**  
    Via `NatExporter#setApplyCellDimensions(boolean)` it is possible to configure whether the exporter should apply the cell dimensions to the same size configuration the NatTable shows. This feature is disabled by default.
    
    It is also possible to enable this feature only for rows or columns via `NatExporter#setApplyRowHeights(boolean)` and `NatExporter#setApplyColumnWidths(boolean)`.
    
*   **Export - POI Extension - Apply borders on export**  
    Via `NatExporter#setApplyCellBorders(boolean)` it is possible to configure this exporter whether it should render cell borders on all cells. This should typically be enabled if background colors should be applied to make the cell borders visible. It is disabled by default.
*   **Export - POI Extension - Export multiple tables on one sheet**  
    Via `NatExporter#setExportOnSameSheet(boolean)` it is possible to configure whether multiple NatTable instances should be exported on the same sheet or on different sheets. Exporting each NatTable instance on a separate sheet is the default.
*   **Export - POI Extension - Export images**  
    
    It is now possible to also export images to the resulting Excel sheet. For this an `IExportFormatter` needs to be registered that returns an `InputStream`. The following snippet shows a simple `IExportFormatter` that exports the checkbox images for boolean values.
    
    ```java
    class ExampleExportFormatter implements IExportFormatter { 
        @Override public Object formatForExport( ILayerCell cell, IConfigRegistry configRegistry) { 
            Object data = cell.getDataValue(); 
            if (data != null) { 
                try { 
                    if (data instanceof Boolean) { 
                        if ((Boolean) data) { 
                            return GUIHelper 
                            .getInternalImageUrl("checked") 
                            .openStream(); 
                        } 
                        return GUIHelper 
                            .getInternalImageUrl("unchecked") 
                            .openStream(); 
                    } else { 
                        return data.toString(); 
                    } 
                } catch (Exception e) { 
                    return data.toString(); 
                } 
            } 
            return ""; 
        } 
    }
    ```

    **Note:**  
    The `InputStream` is closed internally on processing the export. So it is not necessary to deal with that in the outside.
    
*   **Print - Fit to page**  
    It is now possible to configure printing so the NatTable is scaled to fit to a single page. To make this configurable the configuration attribute `PrintConfigAttributes#FITTING_MODE` for type `Direction` was introduced. It can take the following values:
    
    *   `Direction#NONE` - no content related scaling, simple DPI scaling (default)
    *   `Direction#HORIZONTAL` - the content is scaled so that all columns are printed on one page
    *   `Direction#VERTICAL` - the content is scaled so that all rows are printed on one page
    *   `Direction#BOTH` - the content is scaled so that all columns and rows are printed on one page
    
    In combination with `PrintConfigAttributes#FITTING_MODE` it is possible to configure stretching via `PrintConfigAttributes#STRETCH` which takes a Boolean value. This configuration can be used for example on printing multiple NatTable instances with different dimensions, that should fit horizontally. By default both instances will share the same scaling, which results in one table not taking the whole available space. By enabling stretching the smaller table will be stretched to take the whole available space.
*   **Print - Page break on cell border**  
    
    The page break on printing is now on cell borders, not inside a cell anymore. The print result is therefore better readable.
    
    **Note:**  
    For spanned cells the page break is not calculated on the cell border.
    
*   **Print - Multi NatTable print**  
    
    It is now possible to add multiple NatTable instances to one print job. This can be done via `LayerPrinter#addPrintTarget(ILayer, IConfigRegistry)`. Via `LayerPrinter#joinPrintTargets(boolean)` it is possible to configure whether the tables should be printed consecutively or if each table should be started on a new page (default).  
    The following snippet demonstrates how to print two tables consecutively:
    
    ```java
    LayerPrinter printer = 
        new LayerPrinter(headerTable, headerTable.getConfigRegistry()); 
    printer.addPrintTarget(bodyTable, bodyTable.getConfigRegistry()); 
    printer.joinPrintTargets(true); 
    printer.print(headerTable.getShell());
    ```

    Additionally it is possible to configure that the first table registered with the `LayerPrinter` is repeated. This makes it for example possible to create layouts where a fixed header table with meta information can be used as print header. This behavior can be specified via `LayerPrinter` constructor parameter repeat.
    
*   **Print - Repeat column header on every page**  
    
    The `LayerPrinter` can be configured to repeat for example the column header on every print page. For a single table this can be configured via constructor parameter.
    
    ```java
    LayerPrinter printer = 
        new LayerPrinter( 
            natTable, 
            ((GridLayer) natTable.getLayer()).getColumnHeaderLayer(), 
            natTable.getConfigRegistry()); 
    printer.print(headerTable.getShell());
    ```

    To repeat the header of a table in a multi-table print, e.g. have a header table and a body table and the header of the body table should be repeated, there is a new method `LayerPrinter#addPrintTarget(ILayer, ILayer, IConfigRegistry)` that allows to specify the repeat header layer for a print target.
    
    ```java
    LayerPrinter printer = 
        new LayerPrinter(headerTable, headerTable.getConfigRegistry()); 
    printer.addPrintTarget( 
        bodyTable, 
        ((GridLayer) bodyTable.getLayer()).getColumnHeaderLayer(), 
        bodyTable.getConfigRegistry()); 
    printer.print(headerTable.getShell());
    ```
    
*   **Print - New MultiPrintExample**  
    
    The NatTable Examples Application contains a new example to experiment with the different configurations on printing multiple NatTable instances:  
    _**Tutorial Examples -> AdditionalFunctions -> MultiPrintExample**_
    
    {{< figure src="multi_print_example.png" alt="MultiPrintExample">}}
    
*   **Print - Show total page count in footer**  
    It is now possible to configure how the page numbers should be rendered on the print footer. Additionally to the current page number, the total page count can be added. The page information can be modified via the newly introduced `PrintConfigAttributes#FOOTER_PAGE_PATTERN`. It can contain two placeholders:
    
    *   {0} - the current page
    *   {1} - the total page count
    
    The following snippet registers a custom footer page pattern:
    
    ```java
    configRegistry.registerConfigAttribute( 
        PrintConfigAttributes.FOOTER_PAGE_PATTERN, 
        "Page {0} of {1}");
    ```

    As the total page count calculation can be time consuming for more complicated table setups (e.g. dynamic calculated row heights for huge data sets), the total page count calculation can be enabled or disabled via `LayerPrinter#enablePageCountCalculation()` and `LayerPrinter#disablePageCountCalculation()`
    
*   **Print - Configurable footer appearance**  
    The print footer appearance can be configured via the following new configuration attributes:
    *   `PrintConfigAttributes#DATE_FORMAT` - the date/time pattern for the print date. The default value is _EEE, d MMM yyyy HH:mm a_
    *   `PrintConfigAttributes#FOOTER_HEIGHT` - the value for the footer height in DPI. The default value is 300
    *   `PrintConfigAttributes#FOOTER_STYLE` - the IStyle to configure foreground, background and font to use in the footer
*   **ReflectiveColumnPropertyAccessor enhanced to support inheritance in model objects**  
    The `ReflectiveColumnPropertyAccessor` is now able to correctly handle model objects of different types with the same base type.
*   **Localization**  
    We received a contribution for additional Locales. NatTable contains now translations for the following Locales:
    *   en (base)
    *   de
    *   es
    *   fr
    *   it
    *   ja
    *   ko
    *   zh\_CN
    *   zh\_TW
*   **Configure the refresh interval**  
    Internally the `EventConflaterChain` is used to conflate events in NatTable to reduce the number of repaint operations. To improve the appearance the refresh interval was changed to 20ms down from 100ms. If this setting is not sufficient for some use cases it is possible to specify a custom `EventConflaterChain` via new NatTable constructor.
*   **Clear applied static filters in DefaultGlazedListsStaticFilterStrategy**  
    Applied static filters that are set via `DefaultGlazedListsStaticFilterStrategy` can now be cleared via `DefaultGlazedListsStaticFilterStrategy#clearStaticFilter()`.
*   **Introduced AbstractRegionCommands**  
    With the introduction of the `AbstractRegionCommand` it is now possible to create commands that are only processed in a specified region of a layer composition. The `RowSizeConfigurationCommand` and `ColumnSizeConfigurationCommand` are now extending the `AbstractRegionCommand`, which makes it possible to configure cell dimensions only for a specific region via CSS, which leads to setting the default dimensions instead of applying values for each row.
    
    ```css
    .modern > .BODY { 
        row-height: 50px; 
    }
    ```

*   **Add support for word wrapping in text painters**  
    
    The text painters now support word wrapping additionally to the long existing text wrapping feature. That means it can be enabled that words are wrapped in between, instead only wrapping text for whole words. Word wrapping can be enabled via `AbstractRegionCommand#setWordWrapping(boolean)`. By default this feature is disabled, as it could have negative impact on the rendering performance.
    
    **Note:**  
    If word wrapping is enabled, features like automatic size calculation by text length and text wrapping are ignored.
    
    Word wrapping can also be enabled via CSS
    
    ```css
    .modern > .BODY { 
        word-wrap: true; 
    }
    ```

*   **Configure additional line spacing in text painters**  
    
    The text painters now support to specify additional line spacing for multi line text. Via `AbstractRegionCommand#setLineSpacing(int)` the number of pixels that should be added between lines can be specified. The default value is 0.
    
    Line spacing can also be configured via CSS
    
    ```css
    .modern > .BODY { 
        line-spacing: 10px; 
    }
    ```

*   **Border mode**  
    
    We received a very nice contribution by Loris Securo to extend the border rendering. There are numerous bugfixes for rendering of borders with bigger width. And the border styling was enhanced to specify the where the border should be rendered: inside the cell (_internal_), on the cell border / grid lines (_centered_ default) or around the cell (_external_). Programmatically this can be specified by setting the newly introduced `BorderModeEnum` as value to the `BorderStyle`.
    
    **Note:**  
    The `BorderModeEnum` is currently only supported by rendering the selection border (style label `SelectionStyleLabels#SELECTION_ANCHOR_GRID_LINE_STYLE` for `DisplayMode#SELECT`), the fill handle region border (style label `FillHandleConfigAttributes#FILL_HANDLE_REGION_BORDER_STYLE`) and the fill handle border (style label `FillHandleConfigAttributes#FILL_HANDLE_BORDER_STYLE`).
    
    The border mode can also be configured via CSS. For this the CSS properties `border`, `fill-region-border` and `fill-handle-border` were extended to support the additional border mode values `centered|internal|external`. Additionally the new CSS property `border-mode` was introduced that accepts the same values.
    
    The following snippet shows some example usages:
    
    ```css
    .basic > .selectionAnchorGridLine:select { 
        border-color: black; 
        border-style: dashdot; 
        border-width: 4px; 
        border-mode: internal; 
    } 
    
    .basic { 
        fill-region-border: 2px blue solid external; 
    }
    ```

*   **Nebula Extension - Added editor based on CDateTime**  
    The Nebula Extension now contains the `CDateTimeCellEditor` that makes use of the Nebula CDateTime widget for editing date and time values in a NatTable.
*   **Nebula Extension - Updated to RichText 1.2**  
    
    We updated to Nebula RichText 1.2 in order to receive some fixes and configuration enhancements that where applied to that widget.
    
    **Note:**  
    This introduces an updated dependency to Nebula 1.2 for the Nebula Extension.
    
*   **Nebula Extension - Extended MarkupDisplayConverter to support customized stylings**  
    
    With the introduction of the `RegexMarkupValue` and the extension of the `MarkupDisplayConverter` it is possible to configure dynamic highlights based on the `RichTextCellPainter`.
    
    The following snippet shows the creation and registration of such a converter
    
    ```java
    RegexMarkupValue regexMarkup = 
        new RegexMarkupValue(
            "", 
            "<span style="background-color:rgb(255, 255, 0)">", 
            "</span>"); 
    natTable.addConfiguration(
        new DefaultNatTableStyleConfiguration() { 
            { 
                this.cellPainter = new BackgroundPainter( 
                    new PaddingDecorator(new RichTextCellPainter(), 2)); 
            } 
            
            @Override public void configureRegistry(IConfigRegistry configRegistry) { 
                super.configureRegistry(configRegistry); 
                // markup for highlighting 
                MarkupDisplayConverter markupConverter = new MarkupDisplayConverter(); 
                markupConverter.registerMarkup("highlight", regexMarkup); 
                // register markup display converter for normal 
                // displaymode in the body 
                configRegistry.registerConfigAttribute( 
                    CellConfigAttributes.DISPLAY_CONVERTER, 
                    markupConverter, 
                    DisplayMode.NORMAL, 
                    GridRegion.BODY); 
            } 
        });
    ```

    Via `RegexMarkupValue#setRegexValue(String)` it is possible to set the value that should be highlighted dynamically.
    
    ```java
    regexMarkup.setRegexValue(text.isEmpty() ? "" : "(" + text + ")");
    ```

    The NatTable Examples Application contains a new example to show the configuration and possible usage of the `MarkupDisplayConverter` extension:  
    _**Tutorial Examples -> GlazedLists -> Filter -> SingleFieldFilterExample**_
    
    {{< figure src="single_field_filter.png" alt="Single Field Filter Example">}}