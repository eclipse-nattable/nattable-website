<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2017 Dirk Fauth and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Dirk Fauth <dirk.fauth@googlemail.com> - initial API and implementation
 *******************************************************************************/ 

	$pageKeywords	= "eclipse, project, nattable, grid";
	$pageAuthor		= "Dirk Fauth";
	$pageTitle 		= "NatTable 1.5.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 1.5.0 release was mainly made possible by Siemens in order to extend the NatTable features on printing and exporting. 
There were a lot of contributions in form of ideas, bug reports, discussions and even new features like fit-to-page scaling on printing,
correct page breaks, repeating column headers, image exports and several more you can find in the following sections. 
We would like to thank Siemens for their commitment and support on developing the 1.5.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>
Despite the enhancements and new features there are numerous bugfixes related to issues on concurrency, scaling or performance for NatTables with huge column sets.
</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.5.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.5.0">here</a>.</p>

<h3>API changes</h3>
<ul>
	<li>Several modifications were made to increase the extensibility of NatTable.
	Some additional methods are added and the visibility of some existing methods is increased. 
	Existing code should work unchanged.<br>
	The details can be found in the <i>Enhancements and new features</i> section.
	</li>
	<li>
	Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name.
	Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields
	to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields
	here. The explanations can be taken from the sections below.
	<ul>
	<li><span class="code">AbstractTextPainter#lineSpacing</span></li>
	<li><span class="code">AbstractTextPainter#wordWrapping</span></li>
	<li><span class="code">AutoResizeHelper#prevArea</span></li>
	<li><span class="code">ColumnReorderLayer#indexPositionMapping</span></li>
	<li><span class="code">DefaultNatTableThemeConfiguration#copyBorderStyle</span></li>
	<li><span class="code">DefaultNatTableThemeConfiguration#fillHandleBorderStyle</span></li>
	<li><span class="code">DefaultNatTableThemeConfiguration#fillHandleColor</span></li>
	<li><span class="code">DefaultNatTableThemeConfiguration#fillHandleRegionBorderStyle</span></li>
	<li><span class="code">FileOutputStreamProvider#extFilterIndex</span></li>
	<li><span class="code">NatExporter#exportSucceeded</span></li>
	<li><span class="code">NatExporter#openResult</span></li>
	<li><span class="code">NatExporter#preRender</span></li>
	<li><span class="code">NatTable#eventListenerLock</span></li>
	<li><span class="code">PopupMenuBuilder#EXPORT_IMAGE_MENU_ITEM_ID</span></li>
	<li><span class="code">RichTextCellEditor#editorConfiguration</span></li>
	<li><span class="code">RichTextCellPainter#calculateByTextHeight</span></li>
	<li><span class="code">RichTextCellPainter#calculateByTextLength</span></li>
	<li><span class="code">RowReorderLayer#indexPositionMapping</span></li>
	</ul>
	</li>
</ul>

<h3>Behavioural changes</h3>
<ul>
	<li>We added auto-scrolling support for column and row reordering, cell selection and fill handle dragging.
	For column reordering the existing behavior so far was to start auto-scrolling if the mouse cursor was moved on dragging to the
	table edges, where the area was about 10 pixels that triggered auto-scrolling. Instead the auto-scrolling is now triggered if you move to
	the borders, where the area has increased to 25 pixels, where the amount of pixels is scaled to the DPI settings of the screen. Additionally
	the scrolling speed is increased the more the mouse cursor moves over the border of the table.
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>NatTable Examples Application</b><br/>
		<p>
		The NatTable Examples Application is now provided as an Eclipse 4 RCP application. It contains all available examples, also the Eclipse 4 related ones.
		</p>
		<p>
		<img align="middle" width="125%" src="../images/nattable_examples.png" border="0" alt="NatTable Examples Application"/>
		</p>
		<p>
		We decided to discontinue the plain SWT Webstart application because of various issues on multiple
		operating systems. The plain SWT application is still provided, but not directly executable via Webstart. For more information have a look at 
		<a href="../documentation.php?page=examples_application">NatTable Examples Application</a>
		</p>
	</li>
	<li>
		<b>Export - Increased extensibility of the exporter framework</b><br/>
		To make it easier to create custom exporters and to execute an export for different exporters, the exporter framework was extended.
		Two new interfaces are introduced:
		<ul>
			<li><span class="code">IExporter</span> - Base interface for exporters.</li>
			<li><span class="code">ITableExporter</span> - Exporter interface that makes it possible to implement the export functionality completely internally.</li>
		</ul>
		While the existing <span class="code">ILayerExporter</span> is intended to export the data and therefore the NatTable is exported cell by cell, the newly
		introduced <span class="code">ITableExporter</span> allows to implement the export based on the whole table.
		<p>
		There are new methods in <span class="code">NatExporter</span> that take either an 
		<span class="code">ITableExporter</span> or an <span class="code">ILayerExporter</span>. Additionally there are methods that will resolve the exporter to use
		out of the <span class="code">IConfigRegistry</span>. The <span class="code">ITableExporter</span> can be configured via the new 
		<span class="code">ExportConfigAttributes#TABLE_EXPORTER</span> config attribute.
		</p>
	</li>
	<li>
		<b>Export - Additional default exporter implementations</b><br/>
		We received two contributions related to exporting:
		<ul>
		<li><span class="code">CsvExporter</span> - this exporter was contributed by Uwe Peuker and can be used to export the content of a NatTable to a CSV file.</li>
		<li><span class="code">ImageExporter</span> - this exporter was contributed by Thanh Liem PHAN and can be used to export a NatTable to an image. This exporter needs to be used with care. Because of OS
		restrictions it is not possible to export huge NatTables to an image. It will result in SWT exceptions.</li>
		</ul>
		<p>
		In this context Uwe Peuker additionally contributed the <span class="code">FilePathOutputStreamProvider</span> to perform an export to a prior specified file instead of asking on export.
		</p>
		<p>
		Thanh Liem PHAN also contributed a default configuration <span class="code">DefaultImageExportBindings</span> to easily add the image export capability and bind it to <i>CTRL + I</i>. 
		The <span class="code">PopupMenuBuilder</span> was also extended for a new method <span class="code">withExportToImageMenuItem()</span> to be able to add a menu item to a NatTable header menu.
		</p>
	</li>
	<li>
		<b>Export - Possibility to report export errors to the user</b><br/>
		Errors that occur on exporting a NatTable are no longer only logged.
		They are propagated wrapped in a <span class="code">RuntimeException</span> to the calling <span class="code">NatExporter</span>.
		For handling the exceptions <span class="code">NatExporter#handleExportException(Exception)</span> is introduced, 
		that by defaults logs the exception and opens the also newly introduced <span class="code">ExceptionDialog</span>.<br>
		To customize the behavior you can extend <span class="code">NatExporter</span> and override <span class="code">handleExportException(Exception)</span>.
	</li>
	<li>
		<b>Export - Configurability if export should be opened or not</b><br/>
		By default the export result will be opened by launching the operating system executable associated with the file.
		This behavior can be changed via <span class="code">NatExporter#setOpenResult(boolean)</span>.
	</li>
	<li>
		<b>Export - Configurability if the NatTable should be pre-rendered in-memory</b><br/>
		The <span class="code">NatExporter</span> can be configured for in-memory pre-rendering. It is used to ensure that cell dimensions that are calculated
		on rendering are applied before the export. This feature is enabled by default and can be disabled via <span class="code">NatExporter#disablePreRendering()</span>.
		To enable it again <span class="code">NatExporter#enablePreRendering()</span> can be used.
		<p>
		This feature is mostly needed to make the export of cell dimensions work correctly in any case. If dynamic cell dimensions are not used the export performance 
		can be increased by disabling the pre-rendering.
		</p>
	</li>
	<li>
		<b>Export - POI Extension - Respect text wrapping</b><br/>
		<p>Via <span class="code">NatExporter#setApplyTextWrapping(boolean)</span> it is possible to configure whether the exporter should check for text wrapping
		configuration in NatTable text painters and apply the corresponding style attribute in the export, or not.</p>
		<p>
		<b>Note:</b><br>As showing text wrapping in NatTable is not a style information but a configured via painter implementation, the check whether text is
		wrapped needs to be done via reflection. Therefore enabling this configuration could cause performance issues. As wrapped text is not the default case
		and the effect on performance might be negative, this configuration is disabled by default.
		</p>
	</li>
	<li>
		<b>Export - POI Extension - Export cell dimensions</b><br/>
		Via <span class="code">NatExporter#setApplyCellDimensions(boolean)</span> it is possible to configure whether the exporter should apply the cell 
		dimensions to the same size configuration the NatTable shows. This feature is disabled by default.
		<p>
		It is also possible to enable this feature only for rows or columns via <span class="code">NatExporter#setApplyRowHeights(boolean)</span>
		and <span class="code">NatExporter#setApplyColumnWidths(boolean)</span>.
		</p>
	</li>
	<li>
		<b>Export - POI Extension - Apply borders on export</b><br/>
		Via <span class="code">NatExporter#setApplyCellBorders(boolean)</span> it is possible to configure this exporter whether it should render cell borders 
		on all cells. This should typically be enabled if background colors should be applied to make the cell borders visible. It is disabled by default.
	</li>
	<li>
		<b>Export - POI Extension - Export multiple tables on one sheet</b><br/>
		Via <span class="code">NatExporter#setExportOnSameSheet(boolean)</span> it is possible to configure whether multiple NatTable instances should be exported
		on the same sheet or on different sheets. Exporting each NatTable instance on a separate sheet is the default.
	</li>
	<li>
		<b>Export - POI Extension - Export images</b><br/>
		<p>It is now possible to also export images to the resulting Excel sheet. For this an <span class="code">IExportFormatter</span> needs to be registered that 
		returns an <span class="code">InputStream</span>. The following snippet shows a simple <span class="code">IExportFormatter</span> that exports the checkbox
		images for boolean values.
		<div class="codeBlock">class ExampleExportFormatter implements IExportFormatter {
    @Override
    public Object formatForExport(
	    ILayerCell cell, IConfigRegistry configRegistry) {
        
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
}</div></p>
		<p>
		<b>Note:</b><br>The <span class="code">InputStream</span> is closed internally on processing the export. So it is not necessary to deal with that in the outside.
		</p>
	</li>
	<li>
		<b>Print - Fit to page</b><br/>
		It is now possible to configure printing so the NatTable is scaled to fit to a single page.
		To make this configurable the configuration attribute <span class="code">PrintConfigAttributes#FITTING_MODE</span> for type <span class="code">Direction</span> was introduced.
		It can take the following values:
		<ul>
			<li><span class="code">Direction#NONE</span> - no content related scaling, simple DPI scaling (default)</li>
			<li><span class="code">Direction#HORIZONTAL</span> - the content is scaled so that all columns are printed on one page</li>
			<li><span class="code">Direction#VERTICAL</span> - the content is scaled so that all rows are printed on one page</li>
			<li><span class="code">Direction#BOTH</span> - the content is scaled so that all columns and rows are printed on one page</li>
		</ul>
		In combination with <span class="code">PrintConfigAttributes#FITTING_MODE</span> it is possible to configure stretching via <span class="code">PrintConfigAttributes#STRETCH</span>
		which takes a <span class="code">Boolean</span> value. This configuration can be used for example on printing multiple NatTable instances with different dimensions, that should fit
		horizontally. By default both instances will share the same scaling, which results in one table not taking the whole available space. By enabling stretching the smaller table will
		be stretched to take the whole available space.
	</li>
	<li>
		<b>Print - Page break on cell border</b><br/>
		<p>The page break on printing is now on cell borders, not inside a cell anymore. The print result is therefore better readable.</p>
		<p><b><u>Note:</u></b><br>For spanned cells the page break is not calculated on the cell border.</p>
	</li>
	<li>
		<b>Print - Multi NatTable print</b><br/>
		<p>
		It is now possible to add multiple NatTable instances to one print job. This can be done via <span class="code">LayerPrinter#addPrintTarget(ILayer, IConfigRegistry)</span>.
		Via <span class="code">LayerPrinter#joinPrintTargets(boolean)</span> it is possible to configure whether the tables should be printed consecutively or if each table should
		be started on a new page (default).<br>
		The following snippet demonstrates how to print two tables consecutively:
			<div class="codeBlock">LayerPrinter printer = 
    new LayerPrinter(headerTable, headerTable.getConfigRegistry());
printer.addPrintTarget(bodyTable, bodyTable.getConfigRegistry());
printer.joinPrintTargets(true);
printer.print(headerTable.getShell());</div>
		</p>
		<p>
		Additionally it is possible to configure that the first table registered with the <span class="code">LayerPrinter</span> is repeated. This makes it for example possible to create layouts where a
		fixed header table with meta information can be used as print header. This behavior can be specified via <span class="code">LayerPrinter</span> constructor parameter <span class="code">repeat</span>.
		</p>
	</li>
	<li>
		<b>Print - Repeat column header on every page</b><br/>
		<p>
		The <span class="code">LayerPrinter</span> can be configured to repeat for example the column header on every print page. For a single table this can be configured via constructor parameter.
			<div class="codeBlock">LayerPrinter printer = 
    new LayerPrinter(
        natTable,
        ((GridLayer) natTable.getLayer()).getColumnHeaderLayer(),
        natTable.getConfigRegistry());
printer.print(headerTable.getShell());</div>
		</p>
		<p>
		To repeat the header of a table in a multi-table print, e.g. have a header table and a body table and the header of the body table should be repeated, there is a new method 
		<span class="code">LayerPrinter#addPrintTarget(ILayer, ILayer, IConfigRegistry)</span> that allows to specify the repeat header layer for a print target.
			<div class="codeBlock">LayerPrinter printer = 
    new LayerPrinter(headerTable, headerTable.getConfigRegistry());
printer.addPrintTarget(
    bodyTable,
    ((GridLayer) bodyTable.getLayer()).getColumnHeaderLayer(),
    bodyTable.getConfigRegistry());
printer.print(headerTable.getShell());</div></p>
	</li>
	<li>
		<b>Print - New MultiPrintExample</b><br/>
		<p>The NatTable Examples Application contains a new example to experiment with the different configurations on printing multiple NatTable instances:<br>
		<i><b>Tutorial Examples -&gt; AdditionalFunctions -&gt; MultiPrintExample</b></i></p>
		<p>
			<img align="middle" src="../images/multi_print_example.png" border="0" alt="MultiPrintExample"/>
		</p>
	</li>
	<li>
		<b>Print - Show total page count in footer</b><br/>
		It is now possible to configure how the page numbers should be rendered on the print footer. Additionally to the current page number, the total page count
		can be added. The page information can be modified via the newly introduced <span class="code">PrintConfigAttributes#FOOTER_PAGE_PATTERN</span>. It can contain 
		two placeholders:
		<ul>
		<li>{0} - the current page</li>
		<li>{1} - the total page count</li>
		</ul>
		<p>
		The following snippet registers a custom footer page pattern:
			<div class="codeBlock">configRegistry.registerConfigAttribute(
    PrintConfigAttributes.FOOTER_PAGE_PATTERN,
    "Page {0} of {1}");</div>
		</p>
		<p>
		As the total page count calculation can be time consuming for more complicated table setups (e.g. dynamic calculated row heights for huge data sets), the total page
		count calculation can be enabled or disabled via <span class="code">LayerPrinter#enablePageCountCalculation()/span> and <span class="code">LayerPrinter#disablePageCountCalculation()/span>
		</p>
	</li>
	<li>
		<b>Print - Configurable footer appearance</b><br/>
		The print footer appearance can be configured via the following new configuration attributes:
		<ul>
		<li><span class="code">PrintConfigAttributes#DATE_FORMAT</span> - the date/time pattern for the print date. The default value is <i>EEE, d MMM yyyy HH:mm a</i></li>
		<li><span class="code">PrintConfigAttributes#FOOTER_HEIGHT</span> - the value for the footer height in DPI. The default value is 300</li>
		<li><span class="code">PrintConfigAttributes#FOOTER_STYLE</span> - the <span class="code">IStyle</span> to configure foreground, background and font to use in the footer</li>
		</ul>
	</li>
	<li>
		<b>ReflectiveColumnPropertyAccessor enhanced to support inheritance in model objects</b><br/>
		The <span class="code">ReflectiveColumnPropertyAccessor</span> is now able to correctly handle model objects of different types with the same base type.
	</li>
	<li>
		<b>Localization</b><br/>
		We received a contribution for additional Locales. NatTable contains now translations for the following Locales:
		<ul>
		<li>en (base)</li>
		<li>de</li>
		<li>es</li>
		<li>fr</li>
		<li>it</li>
		<li>ja</li>
		<li>ko</li>
		<li>zh_CN</li>
		<li>zh_TW</li>
		</ul>
	</li>
	<li>
		<b>Configure the refresh interval</b><br/>
		Internally the <span class="code">EventConflaterChain</span> is used to conflate events in NatTable to reduce the number of repaint operations. To improve the appearance the refresh
		interval was changed to 20ms down from 100ms. If this setting is not sufficient for some use cases it is possible to specify a custom <span class="code">EventConflaterChain</span>
		via new NatTable constructor.
	</li>
	<li>
		<b>Clear applied static filters in DefaultGlazedListsStaticFilterStrategy</b><br/>
		Applied static filters that are set via <span class="code">DefaultGlazedListsStaticFilterStrategy</span> can now be cleared via 
		<span class="code">DefaultGlazedListsStaticFilterStrategy#clearStaticFilter()</span>.
	</li>
	<li>
		<b>Introduced AbstractRegionCommands</b><br/>
		With the introduction of the <span class="code">AbstractRegionCommand</span> it is now possible to create commands that are only processed in a specified region of a layer composition.
		The <span class="code">RowSizeConfigurationCommand</span> and <span class="code">ColumnSizeConfigurationCommand</span> are now extending the <span class="code">AbstractRegionCommand</span>, which
		makes it possible to configure cell dimensions only for a specific region via CSS, which leads to setting the default dimensions instead of applying values for each row.
		<p>
		<div class="codeBlock">.modern > .BODY {
    row-height: 50px;
}</div></p>
	</li>
	<li>
		<b>Add support for word wrapping in text painters</b><br/>
		<p>The text painters now support word wrapping additionally to the long existing text wrapping feature. That means it can be enabled that words are wrapped in between, instead only wrapping
		text for whole words. Word wrapping can be enabled via <span class="code">AbstractRegionCommand#setWordWrapping(boolean)</span>. By default this feature is disabled, 
		as it could have negative impact on the rendering performance.
		</p>
		<p>
		<b>Note:</b><br>If word wrapping is enabled, features like automatic size calculation by text length and text wrapping are ignored.
		</p>
		<p>
		Word wrapping can also be enabled via CSS
		<div class="codeBlock">.modern > .BODY {
    word-wrap: true;
}</div>
		</p>
	</li>
	<li>
		<b>Configure additional line spacing in text painters</b><br/>
		<p>
		The text painters now support to specify additional line spacing for multi line text. Via <span class="code">AbstractRegionCommand#setLineSpacing(int)</span>
		the number of pixels that should be added between lines can be specified. The default value is 0.
		</p>
		<p>
		Line spacing can also be configured via CSS
		<div class="codeBlock">.modern > .BODY {
    line-spacing: 10px;
}</div>
		</p>
	</li>
	<li>
		<b>Border mode</b><br/>
		<p>We received a very nice contribution by Loris Securo to extend the border rendering. 
		There are numerous bugfixes for rendering of borders with bigger width. And the border styling was enhanced
		to specify the where the border should be rendered: inside the cell (<i>internal</i>), on the cell border / grid lines (<i>centered</i> default)
		or around the cell (<i>external</i>). Programmatically this can be specified by setting the newly introduced <span class="code">BorderModeEnum</span>
		as value to the <span class="code">BorderStyle</span>.
		</p>
		<p>
		<b>Note:</b><br>The <span class="code">BorderModeEnum</span> is currently only supported by rendering the selection border 
		(style label <span class="code">SelectionStyleLabels#SELECTION_ANCHOR_GRID_LINE_STYLE</span> for <span class="code">DisplayMode#SELECT</span>), 
		the fill handle region border (style label <span class="code">FillHandleConfigAttributes#FILL_HANDLE_REGION_BORDER_STYLE</span>) and
		the fill handle border (style label <span class="code">FillHandleConfigAttributes#FILL_HANDLE_BORDER_STYLE</span>).
		</p>
		<p>
		The border mode can also be configured via CSS. For this the CSS properties <span class="code">border</span>, <span class="code">fill-region-border</span> 
		and <span class="code">fill-handle-border</span> were extended to support the additional border mode values <span class="code">centered|internal|external</span>.
		Additionally the new CSS property <span class="code">border-mode</span> was introduced that accepts the same values.
		</p>
		<p>
		The following snippet shows some example usages:
		<div class="codeBlock">.basic > .selectionAnchorGridLine:select {
	border-color: black;
	border-style: dashdot;
	border-width: 4px;
	border-mode: internal;
}

.basic {
	fill-region-border: 2px blue solid external;
}</div>
		</p>
	</li>
	<li>
		<b>Nebula Extension - Added editor based on CDateTime</b><br/>
		The Nebula Extension now contains the <span class="code">CDateTimeCellEditor</span> that makes use of the Nebula CDateTime widget for editing date and time values in a NatTable.
	</li>
	<li>
		<b>Nebula Extension - Updated to RichText 1.2</b><br/>
		<p>We updated to Nebula RichText 1.2 in order to receive some fixes and configuration enhancements that where applied to that widget.</p>
		<p><b><u>Note:</u></b><br>This introduces an updated dependency to Nebula 1.2 for the Nebula Extension.</p>
	</li>
	<li>
		<b>Nebula Extension - Extended MarkupDisplayConverter to support customized stylings</b><br/>
		<p>
		With the introduction of the <span class="code">RegexMarkupValue</span> and the extension of the <span class="code">MarkupDisplayConverter</span> it is possible to configure
		dynamic highlights based on the <span class="code">RichTextCellPainter</span>.
		</p>
		<p>
		The following snippet shows the creation and registration of such a converter
		<div class="codeBlock">RegexMarkupValue regexMarkup = new RegexMarkupValue("",
        "&lt;span style=\"background-color:rgb(255, 255, 0)\"&gt;",
        "&lt;/span&gt;");

natTable.addConfiguration(new DefaultNatTableStyleConfiguration() {
    {
        this.cellPainter = new BackgroundPainter(
                new PaddingDecorator(new RichTextCellPainter(), 2));
    }

    @Override
    public void configureRegistry(IConfigRegistry configRegistry) {
        super.configureRegistry(configRegistry);

        // markup for highlighting
        MarkupDisplayConverter markupConverter = 
                new MarkupDisplayConverter();
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
</div>
		</p>
		<p>
		Via <span class="code">RegexMarkupValue#setRegexValue(String)</span> it is possible to set the value that should be highlighted dynamically.
		<div class="codeBlock">regexMarkup.setRegexValue(text.isEmpty() ? "" : "(" + text + ")");</div>
		</p>
		<p>
			The NatTable Examples Application contains a new example to show the configuration and possible usage of the <span class="code">MarkupDisplayConverter</span> extension:<br>
			<i><b>Tutorial Examples -&gt; GlazedLists -&gt; Filter -&gt; SingleFieldFilterExample</b></i>
		</p>
		<p>
			<img align="middle" src="../images/single_field_filter.png" border="0" alt="Single Field Filter Example"/>
		</p>
	</li>
</ul>

	</div>
</div>

<div id="rightcolumn">

</div>
EOHTML;
	# Generate the web page
	$App->AddExtraHtmlHeader("<style>
.homeitem p {margin-bottom : 5px;}
</style>");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>