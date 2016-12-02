<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2014 Dirk Fauth and others.
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
	$pageTitle 		= "NatTable 1.1.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>There are several changes in the infrastructure, the API and the feature set of Nebula NatTable with the 1.1.0 release. Here are the most important ones.</p>
<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.1.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.1.0">here</a>.</p>

<h3>Enhancements and new features</h3>
There are several enhancements and new features that were added to Nebula NatTable.
<ul>
	<li>Contribution - Active cell editor reference moved to NatTable instance
		<p>With this contribution by Michael Hei&szlig; the <span class="code">ActiveCellEditorRegistry</span> 
		is deprecated. The active cell editor reference is now stored as member of the NatTable instance
		to which the current active cell editor belongs to. This solves the issue of having
		a NatTable as editor control of a NatTable editor.</p>
		<p>If you are not using the <span class="code">ActiveCellEditorRegistry</span> in code outside the
		NatTable, you shouldn't notice this change directly.</p>
		The current active cell editor can be requested by calling
		<div class="codeBlock">NatTable#getActiveCellEditor()</div>
		You can also directly try to commit and close a current active cell editor by calling
		<div class="codeBlock">NatTable#commitAndCloseActiveCellEditor()</div>
	</li>
	<li>Contribution - Enhanced Search Dialog
		<p>With this contribution by Tom Hochstein, the search dialog that is shipped with NatTable
		to support searching within a table, is enhanced to look like the default search dialog
		in Eclipse. If a <span class="code">SelectionLayer</span> is involved in your layer stack, 
		you can open the search dialog via key combination CTRL+F</p>
		<img align="middle" src="../images/search_dialog.png" border="0" alt="Enhanced Search Dialog"/>
	</li>
	<li>Contribution - GroupBy summary values
		<p>With this contribution by Alexandre Pauzies it is now possible to add summary values for
		grouped items when the GroupBy feature is used in a NatTable grid.</p>
		
		<p>Similar to the summary row feature, the values are calculated by registering an instance
		of the new introduced <span class="code">IGroupBySummaryProvider</span> (e.g. 
		<span class="code">SummationGroupBySummaryProvider</span>) for the config attribute 
		<span class="code">GroupByConfigAttributes#GROUP_BY_SUMMARY_PROVIDER</span>.</p>

		<p><div class="codeBlock">configRegistry.registerConfigAttribute(
	GroupByConfigAttributes.GROUP_BY_SUMMARY_PROVIDER,
	new SummationGroupBySummaryProvider<ExtendedPersonWithAddress>(columnPropertyAccessor),
	DisplayMode.NORMAL, 
	GroupByDataLayer.GROUP_BY_COLUMN_PREFIX + 3);</div></p>

		To be able to register different styles for the summary values, two new
		labels will be added to the label stack of the cell in case a <span class="code">IGroupBySummaryProvider</span>
		is registered:
		<ul>
			<li><span class="code">GroupByDataLayer#GROUP_BY_SUMMARY</span></li>
			<li><span class="code">GroupByDataLayer#GROUP_BY_SUMMARY_COLUMN_PREFIX + COLUMN_INDEX</span></li>
		</ul>	

		<p>Additionally you are able to show the number of children in a group by configuring a pattern
		for the config attribute <span class="code">GroupByConfigAttributes#GROUP_BY_CHILD_COUNT_PATTERN</span>.
		The specified pattern will be added to the groupBy value, where the placeholder {0} will be
		replaced with the number of children in the list, while the placeholder {1} will be replaced
		with the number of direct children (without sub-children).</p>
		
		<p><div class="codeBlock">configRegistry.registerConfigAttribute(
	GroupByConfigAttributes.GROUP_BY_CHILD_COUNT_PATTERN,
	"[{0}] - ({1})");</div></p>
		
		<p><img align="middle" src="../images/groupby_summary.png" border="0" alt="GroupBy summary example"/></p>

		<b>Note:</b><br>To enable this new feature you need to use the <span class="code">GroupByDataLayer</span> 
		constructor that takes a <span class="code">IConfigRegistry</span> parameter. This is necessary to 
		enable the <span class="code">GroupByDataLayer</span> to access the configured 
		<span class="code">IGroupBySummaryProvider</span>
	</li>
	<li>Added GroupBy area configuration
		Added configuration attributes to be able to configure the GroupBy area.
		<ul>
			<li><span class="code">GroupByConfigAttributes#GROUP_BY_HINT</span><br>
			The text that should be rendered in the GroupBy area in case no grouping is applied.</li>
			<li><span class="code">GroupByConfigAttributes#GROUP_BY_HINT_STYLE</span><br>
			The style that should be used to render the hint in the GroupBy area.</li>
			<li><span class="code">GroupByConfigAttributes#GROUP_BY_HEADER_BACKGROUND_COLOR</span><br>
			The background color that should be used in the GroupBy area.</li>
		</ul>
		<p><div class="codeBlock">configRegistry.registerConfigAttribute(
	GroupByConfigAttributes.GROUP_BY_HINT,
	"Drag columns here");
	
Style hintStyle = new Style();
hintStyle.setAttributeValue(
	CellStyleAttributes.FONT, 
	GUIHelper.getFont(new FontData("Arial", 10, SWT.ITALIC)));
configRegistry.registerConfigAttribute(
	GroupByConfigAttributes.GROUP_BY_HINT_STYLE,
	hintStyle);</div></p>
		<img align="middle" src="../images/groupby_hint.png" border="0" alt="GroupBy hint example"/>
	</li>
	<li>Added functionality to collapse and expand all nodes in a tree<br>
	To execute that functionality the corresponding commands need to be fired through the layer stack:
	<p><div class="codeBlock">//collapse all nodes in a tree
natTable.doCommand(new TreeCollapseAllCommand());</div></p>
	<div class="codeBlock">//expand all nodes in a tree
natTable.doCommand(new TreeExpandAllCommand());</div></li>
	<li>Hover support
	Added two new DisplayModes to support hover styling:
	<ul>
	<li><span class="code">DisplayMode#HOVER</span><br>
	Applied by the <span class="code">HoverLayer</span> when the mouse moves over a cell in NatTable.</li>
	<li><span class="code">DisplayMode#SELECT_HOVER</span><br>
	Applied by the <span class="code">SelectionLayer</span> when the mouse moves over a selected cell in NatTable
	and the <span class="code">HoverLayer</span> is involved in the layer stack.</li>
	</ul>
	<p>Added the <span class="code">HoverLayer</span> which applies the <span class="code">DisplayMode#HOVER</span>
	when the mouse moves over a cell in NatTable and fires the necessary events to repaint that cell.</p>
	<span class="code">IModeEventHandler</span> additionally implements <span class="code">MouseTrackListener</span> 
	so it is possible to register ui bindings on mouseHover, mouseEnter and mouseExit.
	</li>
	<li>Added theme styling support<br>
	Created the abstract <span class="code">ThemeConfiguration</span> that specifies the theme configurations
	for NatTable core styling. It is technically a <span class="code">AbstractRegistryConfiguration</span> and can be 
	registered like	any other configuration. For theme support and enabling changing the theme at runtime, a 
	<span class="code">ThemeConfiguration</span> should be set to a NatTable instance via
	<p><div class="codeBlock">NatTable#setTheme(ThemeConfiguration)</div></p>
	<b>Note:</b><br>
	Calling <span class="code">setTheme()</span> need to be done <b>AFTER</b> <span class="code">NatTable#configure()</span> 
	is called. Otherwise the theme styling configuration would get overriden by layer configurations.
	
	<p>There are three default themes added to NatTable core:
	<ul>
	<li><span class="code">DefaultNatTableThemeConfiguration</span><br>
	This is the classic NatTable styling that is used by default for a long time.
	<img align="middle" src="../images/classic_theme.png" width="600" border="0" alt="Classic NatTable Theme"/></li>
	</li>
	<li><span class="code">ModernNatTableThemeConfiguration</span><br>
	A more modern looking NatTable.
	<img align="middle" src="../images/modern_theme.png" width="600" border="0" alt="Modern NatTable Theme"/></li>
	</li>
	<li><span class="code">DarkNatTableThemeConfiguration</span><br>
	A dark NatTable theme that extends the <span class="code">ModernNatTableThemeConfiguration</span>.
	<img align="middle" src="../images/dark_theme.png" width="600" border="0" alt="Dark NatTable Theme"/></li>
	</li>
	</ul>
	</p>
	<p>To create a custom theme you can directly extend the abstract <span class="code">ThemeConfiguration</span> or
	extend one of the default theme configurations.</p> 
	<p>You can add additional style information to a ThemeConfiguration via IThemeExtensions. This is useful for
	example to add conditional styling independent of a theme.</p>
	<p><div class="codeBlock">class ConditionalStylingThemeExtension implements IThemeExtension {

	@Override
	public void registerStyles(IConfigRegistry configRegistry) {
		//add custom styling
		IStyle femaleStyle = new Style();
		femaleStyle.setAttributeValue(
			CellStyleAttributes.BACKGROUND_COLOR, 
			GUIHelper.COLOR_YELLOW);
		femaleStyle.setAttributeValue(
			CellStyleAttributes.FOREGROUND_COLOR, 
			GUIHelper.COLOR_BLACK);
		configRegistry.registerConfigAttribute(
				CellConfigAttributes.CELL_STYLE, 
				femaleStyle,
				DisplayMode.NORMAL,
				FEMALE_LABEL);
	}

	@Override
	public void unregisterStyles(IConfigRegistry configRegistry) {
		//unregister custom styling
		configRegistry.unregisterConfigAttribute(
				CellConfigAttributes.CELL_STYLE, 
				DisplayMode.NORMAL,
				FEMALE_LABEL);
	}
}</div></p>
		<div class="codeBlock">ThemeConfiguration conditionalDarkTheme = new DarkNatTableThemeConfiguration();
conditionalDarkTheme.addThemeExtension(new ConditionalStylingThemeExtension());
natTable.setTheme(conditionalDarkTheme);</div>
	</li>
	<li>Enhanced the <span class="code">ViewportLayer</span> to support multiple viewports in one layer composition. 
	This is also called <i>split viewports</i>. For this the API was extended to support configuring the min and max 
	column position	the <span class="code">ViewportLayer</span> should handle. Also the API was extended to support 
	setting different scroller (e.g. <span class="code">Slider</span> or <span class="code">ScrollBar</span>)
	to the <span class="code">ViewportLayer</span>.<br>
	As this is a advanced feature, please see the various new examples that were added to the NatTable examples application
	for further details.
	<img align="middle" src="../images/split_viewport_example.png" border="0" alt="Split viewport example"/></li>
	<li>VerticalTextPainter update
		 <p>The <span class="code">VerticalTextPainter</span> is rewritten to use <span class="code">SWT.Transform</span> 
		 instead of rotating a temporary created image. This is to avoid shading effects on rendering.</p>
		 In case you are facing any issues you can still use the old implementation which is now
		 accessible via <span class="code">VerticalTextImagePainter</span>.
	</li>
	<li>Internal modification of several default painters to remove dependency to model objects<br>
	Instead of the hard dependency to model objects, the painters (e.g. <span class="code">ColumnGroupHeaderTextPainter</span>, 
	<span class="code">TreeImagePainter</span>) inspect the label stack. This was necessary to support theme 
	styling without model references.</li>
	<li>Internal modification of several default painters to add support whether the background should be
	painted by the painter directly or not. This is for example necessary if different background painter 
	should be used but the wrapped painters by default also render the background (e.g. <span class="code">PaddingDecorator</span>).</li>
	<li>Refactored export configuration attributes<br>
	Created <span class="code">ExportConfigAttributes</span> that contain export related config attributes and removed
	the old config attributes:
	<ul>
	<li><span class="code">ExportConfigAttributes#EXPORTER</span><br>
	Configure the <span class="code">ILayerExporter</span> that should be used to perform the export.<br> 
	<b><i>moved from <span class="code">ILayerExporter</span></i></b></li>
	<li><span class="code">ExportConfigAttributes#EXPORT_FORMATTER</span><br>
	Configure the export formatter to use.<br>
	<b><i>moved from <span class="code">CellConfigAttributes</span></i></b></li>
	<li><span class="code">ExportConfigAttributes#DATE_FORMAT</span>
	<br>New configuration attribute that allows specifying the date format that should be used on exporting.</li>
	</ul> 
	Also moved the default configuration for the formatter from <span class="code">DefaultNatTableStyleConfiguration</span> 
	to <span class="code">DefaultExportBindings</span>.</li>
	<li>Extended the <span class="code">PoiExcelExporter</span> to support configuration whether the background color should 
	be applied or not and if vertical text should be also exported vertical.
	<div class="codeBlock">PoiExcelExporter exporter = new HSSFExcelExporter();
//export vertical rendered text in NatTable also vertical to the export
exporter.setApplyVerticalTextConfiguration(true);
//do not apply the background color in the export
exporter.setApplyBackgroundColor(false);</div>
	</li>
	<li>Created <span class="code">TableCellPainter</span> and <span class="code">TableCellEditor</span>
	which allow rendering and editing of values that are contained in a flat collection or array in the data model.
	<div class="codeBlock">//register the TableCellPainter for the food collection in the data model
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
	_4221_CellPainterExample.COLUMN_ELEVEN_LABEL);</div></li>
	<img align="middle" src="../images/table_painter_editor.png" border="0" alt="TableCellPainter/TableCellEditor example"/>
	<li>Added two new CellConfigAttributes to configure grid line rendering
	<ul>
	<li><span class="code">CellConfigAttributes#GRID_LINE_COLOR</span><br>
	The color that should be used to render the grid lines.</li>
	<li><span class="code">CellConfigAttributes#RENDER_GRID_LINES</span><br>
	Flag to configure whether grid lines should be rendered or not. For example necessary to
	avoid rendering of grid lines when the <span class="code">BeveledBorderDecorator</span> is used in the 
	header (or render the grid lines for themes that doesn't use beveled borders)</li>
	</ul></li>
	<li>Created the <span class="code">NatTableBorderOverlayPainter</span> which can be used to render a border 
	around the NatTable. This is useful in case there are no headers as the layer painters do not render grid
	lines to the left and on top.
	<p><div class="codeBlock">natTable.addOverlayPainter(
	new NatTableBorderOverlayPainter(GUIHelper.COLOR_RED, true));</div></p>
	<b>Note:</b><br>The <span class="code">NatTableBorderOverlayPainter</span> also respects the newly introduced grid line color configuration
	that is set to the <span class="code">ConfigRegistry</span>.
	<img align="middle" src="../images/NatTableBorderOverlayPainter_example.png" border="0" alt="NatTableBorderOverlayPainter example"/>
	</li>
	<li>Extended the <span class="code">NatGridLayerPainter</span> to render fake row grid lines in case
	a default row height is set.
	<img align="middle" src="../images/NatGridLayerPainter_example.png" border="0" alt="NatGridLayerPainter example"/>
	</li>
	<li>Localization of default numeric converters<br>
	The <span class="code">NumericDisplayConverter</span> is now using <span class="code">NumberFormat</span> 
	for conversion instead of calling <span class="code">toString()</span>. You can also access and modify the set 
	<span class="code">NumberFormat</span> via 
	<div class="codeBlock">NumericDisplayConverter#getNumberFormat()</div> 
	or set a different
	<span class="code">NumberFormat</span> via 
	<div class="codeBlock">NumericDisplayConverter#setNumberFormat(NumberFormat)</div></li>
	<li>Introduced the <span class="code">CalculatedValueCache</span> that is used to cache calculated values
	like summary values in the SummaryRowLayer or the groupBy summary values.</li>
	<li>Extended the NatTable examples app with additional examples. It now has two sections:
		<ul>
			<li>Tutorial Examples<br>
				Examples that will be used in future tutorials and are mostly focused on one NatTable feature item.</li>
			<li>Classic Examples<br>
				Examples that are well known to NatTable users as they exist for a long time.</li>
		</ul>
		<p><img align="middle" src="../images/examples_structure.png" border="0" alt="NatTable examples structure"/></p>
		<b>Note:</b><br>
		If starting the new NatTable examples application out of Eclipse fails, delete the file <i>examples.index</i>
		in the src root folder so it gets re-created. This is necessary because the examples structure has changed!
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