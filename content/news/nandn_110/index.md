---
title: "NatTable 1.1.0 - New & Noteworthy"
date: 2014-04-30T00:00:00-00:00
summary: "Nebula NatTable 1.1.0 released"
categories: ["news"]
---

There are several changes in the infrastructure, the API and the feature set of Nebula NatTable with the 1.1.0 release. Here are the most important ones.

Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.1.0 release, have a look [here](https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.1.0).

### Enhancements and new features

There are several enhancements and new features that were added to Nebula NatTable.

*   Contribution - Active cell editor reference moved to NatTable instance
    
    With this contribution by Michael Heiß the `ActiveCellEditorRegistry` is deprecated. The active cell editor reference is now stored as member of the NatTable instance to which the current active cell editor belongs to. This solves the issue of having a NatTable as editor control of a NatTable editor.
    
    If you are not using the `ActiveCellEditorRegistry` in code outside the NatTable, you shouldn't notice this change directly.
    
    The current active cell editor can be requested by calling
    
    ```java
    NatTable#getActiveCellEditor()
    ```

    You can also directly try to commit and close a current active cell editor by calling
    
    ```java
    NatTable#commitAndCloseActiveCellEditor()
    ```
    
*   Contribution - Enhanced Search Dialog
    
    With this contribution by Tom Hochstein, the search dialog that is shipped with NatTable to support searching within a table, is enhanced to look like the default search dialog in Eclipse. If a `SelectionLayer` is involved in your layer stack, you can open the search dialog via key combination CTRL+F
    
    {{< figure src="search_dialog.png" alt="Enhanced Search Dialog">}}

*   Contribution - GroupBy summary values
    
    With this contribution by Alexandre Pauzies it is now possible to add summary values for grouped items when the GroupBy feature is used in a NatTable grid.
    
    Similar to the summary row feature, the values are calculated by registering an instance of the new introduced `IGroupBySummaryProvider` (e.g. `SummationGroupBySummaryProvider`) for the config attribute `GroupByConfigAttributes#GROUP_BY_SUMMARY_PROVIDER`.
    
    ```java
    configRegistry.registerConfigAttribute( 
        GroupByConfigAttributes.GROUP_BY_SUMMARY_PROVIDER, 
        new SummationGroupBySummaryProvider(columnPropertyAccessor), 
        DisplayMode.NORMAL, 
        GroupByDataLayer.GROUP_BY_COLUMN_PREFIX + 3);
    ```

    To be able to register different styles for the summary values, two new labels will be added to the label stack of the cell in case a `IGroupBySummaryProvider` is registered:
    
    *   `GroupByDataLayer#GROUP_BY_SUMMARY`
    *   `GroupByDataLayer#GROUP_BY_SUMMARY_COLUMN_PREFIX + COLUMN_INDEX`
    
    Additionally you are able to show the number of children in a group by configuring a pattern for the config attribute `GroupByConfigAttributes#GROUP_BY_CHILD_COUNT_PATTERN`. The specified pattern will be added to the groupBy value, where the placeholder {0} will be replaced with the number of children in the list, while the placeholder {1} will be replaced with the number of direct children (without sub-children).
    
    ```java
    configRegistry.registerConfigAttribute( 
        GroupByConfigAttributes.GROUP_BY_CHILD_COUNT_PATTERN, 
        "\[{0}\] - ({1})");
    ```

    {{< figure src="groupby_summary.png" alt="GroupBy summary example">}}
    
    **Note:**  
    To enable this new feature you need to use the `GroupByDataLayer` constructor that takes a `IConfigRegistry` parameter. This is necessary to enable the `GroupByDataLayer` to access the configured `IGroupBySummaryProvider`
*   Added GroupBy area configuration Added configuration attributes to be able to configure the GroupBy area.
    
    *   `GroupByConfigAttributes#GROUP_BY_HINT`  
        The text that should be rendered in the GroupBy area in case no grouping is applied.
    *   `GroupByConfigAttributes#GROUP_BY_HINT_STYLE`  
        The style that should be used to render the hint in the GroupBy area.
    *   `GroupByConfigAttributes#GROUP_BY_HEADER_BACKGROUND_COLOR`  
        The background color that should be used in the GroupBy area.
    
    ```java
    configRegistry.registerConfigAttribute( 
        GroupByConfigAttributes.GROUP_BY_HINT, 
        "Drag columns here"); 
        
        Style hintStyle = new Style(); 
        hintStyle.setAttributeValue( 
            CellStyleAttributes.FONT, 
            GUIHelper.getFont(new FontData("Arial", 10, SWT.ITALIC))); 
        configRegistry.registerConfigAttribute( 
            GroupByConfigAttributes.GROUP_BY_HINT_STYLE, 
            hintStyle);
    ```

    {{< figure src="groupby_hint.png" alt="GroupBy hint example">}}
*   Added functionality to collapse and expand all nodes in a tree  
    To execute that functionality the corresponding commands need to be fired through the layer stack:
    
    ```java
    //collapse all nodes in a tree 
    natTable.doCommand(new TreeCollapseAllCommand());
    ```

    ```java
    //expand all nodes in a tree 
    natTable.doCommand(new TreeExpandAllCommand());
    ```

*   Hover support Added two new DisplayModes to support hover styling:
    
    *   `DisplayMode#HOVER`  
        Applied by the HoverLayer when the mouse moves over a cell in NatTable.
    *   `DisplayMode#SELECT_HOVER`  
        Applied by the `SelectionLayer` when the mouse moves over a selected cell in NatTable and the `HoverLayer` is involved in the layer stack.
    
    Added the `HoverLayer` which applies the `DisplayMode#HOVER` when the mouse moves over a cell in NatTable and fires the necessary events to repaint that cell.
    
    `IModeEventHandler` additionally implements `MouseTrackListener` so it is possible to register ui bindings on mouseHover, mouseEnter and mouseExit.
*   Added theme styling support  
    Created the abstract `ThemeConfiguration` that specifies the theme configurations for NatTable core styling. It is technically a `AbstractRegistryConfiguration` and can be registered like any other configuration. For theme support and enabling changing the theme at runtime, a `ThemeConfiguration` should be set to a NatTable instance via
    
    ```java
    NatTable#setTheme(ThemeConfiguration)
    ```

    **Note:**  
    Calling `setTheme()` need to be done **AFTER** `NatTable#configure()` is called. Otherwise the theme styling configuration would get overriden by layer configurations.
    
    There are three default themes added to NatTable core:
    
    *   `DefaultNatTableThemeConfiguration`  
        This is the classic NatTable styling that is used by default for a long time. 
        {{< figure src="classic_theme.png" alt="Classic NatTable Theme">}}
    *   `ModernNatTableThemeConfiguration`  
        A more modern looking NatTable. 
        {{< figure src="modern_theme.png" alt="Modern NatTable Theme">}}
    *   `DarkNatTableThemeConfiguration`  
        A dark NatTable theme that extends the `ModernNatTableThemeConfiguration`. 
        {{< figure src="dark_theme.png" alt="Dark NatTable Theme">}}
    
    To create a custom theme you can directly extend the abstract `ThemeConfiguration` or extend one of the default theme configurations.
    
    You can add additional style information to a `ThemeConfiguration` via `IThemeExtensions`. This is useful for example to add conditional styling independent of a theme.
    
    ```java
    class ConditionalStylingThemeExtension implements IThemeExtension { 
        @Override public void registerStyles(IConfigRegistry configRegistry) { 
            //add custom styling 
            IStyle femaleStyle = new Style(); 
            femaleStyle.setAttributeValue( 
                CellStyleAttributes.BACKGROUND_COLOR, 
                GUIHelper.COLOR_YELLOW); 
            femaleStyle.setAttributeValue( 
                CellStyleAttributes.FOREGROUND_COLOR, 
                GUIHelper.COLOR_BLACK); 
            configRegistry.registerConfigAttribute( 
                CellConfigAttributes.CELL_STYLE, femaleStyle, 
                DisplayMode.NORMAL, FEMALE_LABEL); 
        } 
        
        @Override public void unregisterStyles(IConfigRegistry configRegistry) { 
            //unregister custom styling 
            configRegistry.unregisterConfigAttribute( 
                CellConfigAttributes.CELL_STYLE, 
                DisplayMode.NORMAL, 
                FEMALE_LABEL); 
        } 
    }
    ```

    ```java
    ThemeConfiguration conditionalDarkTheme = new DarkNatTableThemeConfiguration(); 
    conditionalDarkTheme.addThemeExtension(new ConditionalStylingThemeExtension());
    natTable.setTheme(conditionalDarkTheme);
    ```
*   Enhanced the `ViewportLayer` to support multiple viewports in one layer composition. This is also called _split viewports_. For this the API was extended to support configuring the min and max column position the `ViewportLayer` should handle. Also the API was extended to support setting different scroller (e.g. `Slider` or `ScrollBar`) to the `ViewportLayer`.  
    As this is a advanced feature, please see the various new examples that were added to the NatTable examples application for further details. 
    {{< figure src="split_viewport_example.png" alt="Split viewport example">}}

*   `VerticalTextPainter` update
    
    The `VerticalTextPainter` is rewritten to use `SWT.Transform` instead of rotating a temporary created image. This is to avoid shading effects on rendering.
    
    In case you are facing any issues you can still use the old implementation which is now accessible via `VerticalTextImagePainter`.
*   Internal modification of several default painters to remove dependency to model objects  
    Instead of the hard dependency to model objects, the painters (e.g. `ColumnGroupHeaderTextPainter`, `TreeImagePainter`) inspect the label stack. This was necessary to support theme styling without model references.
*   Internal modification of several default painters to add support whether the background should be painted by the painter directly or not. This is for example necessary if different background painter should be used but the wrapped painters by default also render the background (e.g. `PaddingDecorator`).
*   Refactored export configuration attributes  
    Created `ExportConfigAttributes` that contain export related config attributes and removed the old config attributes:
    
    *   `ExportConfigAttributes#EXPORTER`  
        Configure the `ILayerExporter` that should be used to perform the export.  
        **_moved from ILayerExporter_**
    *   `ExportConfigAttributes#EXPORT_FORMATTER`  
        Configure the export formatter to use.  
        **_moved from CellConfigAttributes_**
    *   `ExportConfigAttributes#DATE_FORMAT`  
        New configuration attribute that allows specifying the date format that should be used on exporting.
    
    Also moved the default configuration for the formatter from `DefaultNatTableStyleConfiguration` to `DefaultExportBindings`.
*   Extended the `PoiExcelExporter` to support configuration whether the background color should be applied or not and if vertical text should be also exported vertical.
    
    ```java
    PoiExcelExporter exporter = new HSSFExcelExporter(); 
    //export vertical rendered text in NatTable also vertical to the export 
    exporter.setApplyVerticalTextConfiguration(true); 
    //do not apply the background color in the 
    export exporter.setApplyBackgroundColor(false);
    ```
*   Created `TableCellPainter` and `TableCellEditor` which allow rendering and editing of values that are contained in a flat collection or array in the data model.
    
    ```java
    //register the TableCellPainter for the food collection in the data model 
    configRegistry.registerConfigAttribute( 
        CellConfigAttributes.CELL_PAINTER, 
        new TableCellPainter(), 
        DisplayMode.NORMAL, 
        _4222_CellPainterExample.COLUMN_ELEVEN_LABEL); 
    //register the TableCellEditor for the food collection in the data model 
    configRegistry.registerConfigAttribute( 
        EditConfigAttributes.CELL_EDITOR, 
        new TableCellEditor(), 
        DisplayMode.NORMAL, 
        _4221_CellPainterExample.COLUMN_ELEVEN_LABEL);
    ```
    
{{< figure src="table_painter_editor.png" alt="TableCellPainter/TableCellEditor example">}}
*   Added two new `CellConfigAttributes` to configure grid line rendering
    *   `CellConfigAttributes#GRID_LINE_COLOR`  
        The color that should be used to render the grid lines.
    *   `CellConfigAttributes#RENDER_GRID_LINES`  
        Flag to configure whether grid lines should be rendered or not. For example necessary to avoid rendering of grid lines when the `BeveledBorderDecorator` is used in the header (or render the grid lines for themes that doesn't use beveled borders)
*   Created the `NatTableBorderOverlayPainter` which can be used to render a border around the NatTable. This is useful in case there are no headers as the layer painters do not render grid lines to the left and on top.
    
    ```java
    natTable.addOverlayPainter( 
        new NatTableBorderOverlayPainter(GUIHelper.COLOR_RED, true));
    ```

    **Note:**  
    The `NatTableBorderOverlayPainter` also respects the newly introduced grid line color configuration that is set to the `ConfigRegistry`. 
    {{< figure src="NatTableBorderOverlayPainter_example.png" alt="NatTableBorderOverlayPainter example">}}
*   Extended the `NatGridLayerPainter` to render fake row grid lines in case a default row height is set. 
    {{< figure src="NatGridLayerPainter_example.png" alt="NatGridLayerPainter example">}}
*   Localization of default numeric converters  
    The `NumericDisplayConverter` is now using `NumberFormat` for conversion instead of calling `toString()`. You can also access and modify the set `NumberFormat` via
    
    ```java
    NumericDisplayConverter#getNumberFormat()
    ```
    
    or set a different `NumberFormat` via
    
    ```java
    NumericDisplayConverter#setNumberFormat(NumberFormat)
    ```

*   Introduced the `CalculatedValueCache` that is used to cache calculated values like summary values in the `SummaryRowLayer` or the groupBy summary values.
*   Extended the NatTable examples app with additional examples. It now has two sections:
    
    *   Tutorial Examples  
        Examples that will be used in future tutorials and are mostly focused on one NatTable feature item.
    *   Classic Examples  
        Examples that are well known to NatTable users as they exist for a long time.
    
    {{< figure src="examples_structure.png" alt="NatTable examples structure">}}
    
    **Note:**  
    If starting the new NatTable examples application out of Eclipse fails, delete the file _examples.index_ in the src root folder so it gets re-created. This is necessary because the examples structure has changed!