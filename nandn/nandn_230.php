<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2024 Dirk Fauth and others.
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
	$pageTitle 		= "NatTable 2.3.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 2.3.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. 
We would like to thank everyone involved for their commitment and support on developing the 2.3.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>
Despite the enhancements and new features there are several bugfixes related to issues on filtering.
</p>
<p>Almost every change in code is tracked via [GitHub Issues](https://github.com/eclipse-nattable/nattable/milestone/2?closed=1), so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.3.0 release, have a look there.</p>

<h3>API changes</h3>
<ul>
	<li>
		Several modifications were made to increase the extensibility of NatTable.
		Some additional methods are added and the visibility of some existing methods is increased. 
		Existing code should work unchanged.<br>
		Below is the list of those methods, the details can be found in the <i>Enhancements and new features</i> section.
		<ul>
			<li><span class="code">AbstractTextPainter#isCutText()</span></li>
			<li><span class="code">AbstractTextPainter#setCutText(boolean)</span></li>
			<li><span class="code">ColumnGroupsCommandHandler#getPositionsToProcess()</span></li>
			<li><span class="code">ComboBoxCellEditor#isFocusOnDropdownFilter()</span></li>
			<li><span class="code">ComboBoxCellEditor#isLinkItemAndCheckbox()</span></li>
			<li><span class="code">ComboBoxCellEditor#setFocusOnDropdownFilter(boolean)</span></li>
			<li><span class="code">ComboBoxCellEditor#setLinkItemAndCheckbox(boolean)</span></li>
			<li><span class="code">EditSelectionCommandHandler#getCellsForEditing(SelectionLayer, IUniqueIndexLayer, IConfigRegistry, boolean)</span></li>
			<li><span class="code">EditSelectionCommandHandler#handleOnlyAllSelectedEditable(IConfigRegistry)</span></li>
			<li><span class="code">EditUtils#getEditableCellsInSelection(SelectionLayer, IConfigRegistry)</span></li>
			<li><span class="code">EditUtils#getEditableCellsInSelection(SelectionLayer, IUniqueIndexLayer, IConfigRegistry)</span></li>
			<li><span class="code">EditUtils#isCellEditable(ILayerCell, IConfigRegistry)</span></li>
			<li><span class="code">EditUtils#isCellEditable(ILayerCell, IConfigRegistry)</span></li>
			<li><span class="code">ExportCommand#isUseProgressDialog()</span></li>
			<li><span class="code">ExportCommand#setUseProgressDialog(getExporter)</span></li>
			<li><span class="code">FilterRowComboBoxCellEditor#addNatComboListener(FilterNatCombo)</span></li>
			<li><span class="code">FilterRowComboBoxCellEditor#configureDropdownFilter(boolean, boolean, boolean)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#configureComparator(ILayer, IConfigRegistry)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#getColumnComparator(int)</span></li>
			<li><span class="code">FilterRowComboBoxDataProvider#setContentFilter(Predicate)</span></li>
			<li><span class="code">LabelStack#hasAllLabels(String[])</span></li>
			<li><span class="code">LabelStack#hasAllLabels(List)</span></li>
			<li><span class="code">MarkupDisplayConverter#getMarkupProcessors(ILayerCell)</span></li>
			<li><span class="code">MarkupDisplayConverter#registerMarkupForLabel(String, String, String, String...)</span></li>
			<li><span class="code">MarkupDisplayConverter#registerMarkupForLabel(String, String, String, List)</span></li>
			<li><span class="code">MarkupDisplayConverter#registerRegexMarkupForLabel(String, String, String, String...)</span></li>
			<li><span class="code">MarkupDisplayConverter#registerRegexMarkupForLabel(String, String, String, List)</span></li>
			<li><span class="code">MarkupDisplayConverter#registerMarkupForLabel(MarkupProcessor, String...)</span></li>
			<li><span class="code">MarkupDisplayConverter#registerMarkupForLabel(MarkupProcessor, List)</span></li>
			<li><span class="code">MarkupDisplayConverter#unregisterMarkupForLabel(String...)</span></li>
			<li><span class="code">NatCombo#showDropdownControl(boolean, boolean)</span></li>
			<li><span class="code">NatExporter#exportLayer(ILayerExporter, OutputStream, IProgressMonitor, String, ILayer, IConfigRegistry, boolean)</span></li>
			<li><span class="code">NatExporter#exportLayer(ITableExporter, OutputStream, IProgressMonitor, ILayer, IConfigRegistry)</span></li>
			<li><span class="code">NatExporter#finalizeExportProcess(ILayer, IClientAreaProvider)</span></li>
			<li><span class="code">NatExporter#getProgressMonitorDialog()</span></li>
			<li><span class="code">NatExporter#getExportSubTaskName()</span></li>
			<li><span class="code">NatExporter#getPrepareSubTaskName()</span></li>
			<li><span class="code">NatExporter#isUseProgressDialog()</span></li>
			<li><span class="code">NatExporter#prepareExportProcess(ILayer, IConfigRegistry)</span></li>
			<li><span class="code">NatExporter#setUseProgressDialog(boolean)</span></li>
			<li><span class="code">NatGridLayerPainter#doCommand(ILayer, RowSizeConfigurationCommand)</span></li>
			<li><span class="code">NatGridLayerPainter#getConfiguredDefaultRowHeight()</span></li>
			<li><span class="code">NatGridLayerPainter#registerCommandHandler()</span></li>
			<li><span class="code">NatGridLayerPainter#unregisterCommandHandler()</span></li>
			<li><span class="code">PercentageBarDecorator#convertDataType(ILayerCell, IConfigRegistry)</span></li>
			<li><span class="code">PopupMenuBuilder#build(boolean)</span></li>
			<li><span class="code">PopupMenuBuilder#buildSubMenu()</span></li>
			<li><span class="code">PopupMenuBuilder#getNatEventData()</span></li>
			<li><span class="code">PopupMenuBuilder#isEnabled(String)</span></li>
			<li><span class="code">PopupMenuBuilder#isVisible(String)</span></li>
			<li><span class="code">PopupMenuBuilder#withSubMenu(String)</span></li>
			<li><span class="code">PopupMenuBuilder#withSubMenu(String, String)</span></li>
			<li><span class="code">PopupMenuBuilder#withSubMenu(String, String, ImageDescriptor)</span></li>
			<li><span class="code">RowGroupsCommandHandler#getPositionsToProcess()</span></li>
			<li><span class="code">SearchDialog - increased visibility to several fields and methods and added methods to make it extensible and localizable</span></li>
			<li><span class="code">SortIconPainter#setSortImages(List, List)</span></li>
			<li><span class="code">SortIconPainter#setSortImages(List, List)</span></li>
		</ul>
		
		Below is the list of new constructors
		<ul>
			<li><span class="code">ColumnGroupsCommandHandler(ColumnGroupHeaderLayer, SelectionLayer, boolean)</span></li>
			<li><span class="code">ComboBoxFilterRowHeaderComposite(ComboBoxGlazedListsFilterStrategy, FilterRowComboBoxDataProvider, ILayer, FilterRowDataLayer, IConfigRegistry, boolean)</span></li>
			<li><span class="code">ExportCommand(IConfigRegistry, Shell, boolean, boolean)</span></li>
			<li><span class="code">ExportCommand(IConfigRegistry, Shell, boolean, boolean, ILayerExporter)</span></li>
			<li><span class="code">FilterNatCombo(Composite, IStyle, int, int, boolean, boolean)</span></li>
			<li><span class="code">FilterNatCombo(Composite, IStyle, int, int, Image, boolean, boolean)</span></li>
			<li><span class="code">FilterRowDataLayer(IFilterStrategy, ILayer, IDataProvider, IConfigRegistry, boolean)</span></li>
			<li><span class="code">FilterRowHeaderComposite(ILayer, FilterRowDataLayer)</span></li>
			<li><span class="code">NatCombo(Composite, IStyle, int, int, boolean, boolean)</span></li>
			<li><span class="code">NatCombo(Composite, IStyle, int, int, Image, boolean, boolean)</span></li>
			<li><span class="code">NatExporter(Shell, boolean, boolean)</span></li>
			<li><span class="code">NatGridLayerPainter(NatTable, int, boolean)</span></li>
			<li><span class="code">NatGridLayerPainter(NatTable, Color, int, boolean)</span></li>
			<li><span class="code">PopupMenuBuilder(NatTable, PopupMenuBuilder, Menu)</span></li>
			<li><span class="code">PopupMenuBuilder(NatTable, PopupMenuBuilder, MenuManager)</span></li>
			<li><span class="code">RowGroupsCommandHandler(RowGroupHeaderLayer, SelectionLayer, boolean)</span></li>
			<li><span class="code">SearchAction(SearchDialogCreator)</span></li>
			<li><span class="code">SearchAction(NatTable, IDialogSettings, SearchDialogCreator)</span></li>
		</ul>

		Below is the list of new constants
		<ul>
			<li><span class="code">AbstractTextPainter#NEW_LINE_PATTERN</span></li>
			<li><span class="code">EditConfigAttributes#MULTI_EDIT_ALL_SELECTED_EDITABLE</span></li>
		</ul>

		Below is the list of new classes
		<ul>
			<li><span class="code">ColumnDragMode</span></li>
			<li><span class="code">FilterNatCombo#LinkItemAndCheckboxMouseListener</span></li>
			<li><span class="code">MarkupDisplayConverter#MarkupValueForLabels</span></li>
			<li><span class="code">RowDragMode</span></li>
			<li><span class="code">SearchAction#SearchDialogCreator</span></li>
		</ul>
	</li>
	<li>
		Since Eclipse Oxygen M5 added fields are also reported as API break. The reason is that adopters that extend such classes might themselves added new fields with the same name.
		Therefore adding a field with the same name in the base class could lead to issues in the sub-class. The NatTable project did never consider adding new public or protected fields
		to a class as a breaking change, and therefore it was used widely to extend the functionality. In order to help adopters to check if they would be affected, we list the added fields
		and methods with increased visibility here. The explanations can be taken from the sections below, although not every change is tracked there as some changes where required for
		bugfixing.
		<ul>
			<li><span class="code">MarkupDisplayConverter#markupsForLabels</span></li>
			<li><span class="code">NatCombo#linkItemAndCheckbox</span></li>
			<li><span class="code">PopupMenuBuilder#parentBuilder</span></li>
			<li><span class="code">SearchDialog - increased visibility to several fields and methods and added methods to make it extensible and localizable</span></li>
		</ul>
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>Context Menu - Add support for adding sub menus</b><br/>
		<p>
			It is now possible to configure sub menus via the <span class="code">PopupMenuBuilder</span>.
			
			<div class="codeBlock">this.bodyMenu = new PopupMenuBuilder(natTable)
    .withInspectLabelsMenuItem()
    .withSubMenu("Freeze")
        .withFreezeColumnMenuItem()
        .withFreezeRowMenuItem()
        .withFreezePositionMenuItem(true)
        .withUnfreezeMenuItem()
        .buildSubMenu()
    .build(true);</div>			
		</p>
	</li>
	<li>
		<b>MarkupDisplayConverter - Register markups for labels</b><br/>
		<p>
			It is now possible to register markups via the <span class="code">MarkupDisplayConverter</span> also for labels. This makes it possible to create combinations of
			general markups (e.g. search result highlighting) in combination with special label based formatting (e.g. background color or font style for a column).
		</p>
	</li>
	<li>
		<b>NatExporter/ExportCommand - Report progress via ProgressMonitorDialog</b><br/>
		<p>
			By default the progress of an export is either not reported to a user, or shown in a tiny custom progress shell. You can now configure that the progress should be
			reported via <span class="code">ProgressMonitorDialog</span>. The easiest way to achieve this, is to execute a <span class="code">ExportCommand</span> with the
			corresponding configuration.
		</p>
		<p>
			Additionally it is now possible to pass the <span class="code">ILayerExporter</span> to use with the <span class="code">ExportCommand</span>, which makes it easier
			to offer different export functions in one NatTable instance:
			<div class="codeBlock">return super.createCornerMenu(natTable)
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
                }
            });

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
        .buildSubMenu();</div>
		</p>
	</li>
	<li>
		<b>Improve usability with checkbox editors</b><br/>
		<p>
			There are some small enhancements that could improve the usability of the <span class="code">NatCombo</span>, the <span class="code">FilterNatCombo</span> 
			and the cell editors that use these controls.
			<ol>
			<li>Link item and checkbox<br>
			If checkboxes are used in the dropdown (e.g. in the Excel-like filter dropdown), the user needed to select the checkbox to enable or disable 
			a filter value. It is now configurable if a click on the item shouled also change the checkbox state.
			</li>
			<li>Trigger multi-selection on key interaction (SPACE)<br>
			If checkboxes are used in the dropdown (e.g. in the Excel-like filter dropdown), and a users moves the selection in the dropdown via arrow keys and 
			triggers a multi-selection via CTRL or SHIFT modifier key, and then presses SPACE, now all selected items change the checkbox state.
			</li>
			<li>Set focus on the filter control of the combobox<br>
			It is possible to add a filter textbox to the dropdown, so the user can filter the possible values. It is now possible to configure if the focus 
			should be set on the filterbox instead of the dropdown. 
			This is also possible for the textbox if free editing is enabled on a <span class="code">NatCombo</span>.
			</li>
			<li>Disable selection state in <i>Select All</i> and <i>Add to selection</i> items<br>
			The <span class="code">FilterNatCombo</span> adds two additional items, <i>Select All</i> and, if configured, <i>Add to selection</i>. 
			Both items are internally separated <span class="code">CheckboxTableViewer</span> and therefore do not share a selection model with the main 
			dropdown that shows the content. For the user this is not visible, as it looks like a single list of items. Previously on clicking items in the dropdown and the 
			additional items, it looked like there are multiple selections active. Now the additional items in the <span class="code">FilterNatCombo</span>
			do not show a selection, to make it clear that there is only a single selection, and the additional items are not itself selectable. They can only be 
			clicked to change the state of the main content.</li>
			</ol>
		</p>
	</li>
	<li>
		<b>Extensibility and Internationalization</b><br/>
		<p>
			Several classes have been extended to:
			<ul>
			<li>Allow further customization by sub-classing</li>
			<li>Allow internationalization</li>
			</ul>
			Especially the <span class="code">SearchDialog</span> is now extensible and it is possible to create a simplified search dialog, which can be opened via 
			<span class="code">SearchAction#SearchDialogCreator</span>.
		</p>
	</li>
	<li>
		<b>Multi-edit with non-editable cells</b><br/>
		<p>
			Typically it is not possible to trigger editing for multiple cells, if not all selected cells are editable. In huge tables where some cells might not be editable,
			this can become an issue for a user. Therefore we introduced a new configuration attribute <span class="code">EditConfigAttributes#MULTI_EDIT_ALL_SELECTED_EDITABLE</span>.
			If not set, it is interpreted as <span class="code">true</span>, which is the current default behavior. Setting it to <span class="code">false</span> allows 
			multi-editing even if cells that are not editable are selected.
			<div class="codeBlock">configRegistry.registerConfigAttribute(
    EditConfigAttributes.MULTI_EDIT_ALL_SELECTED_EDITABLE,
    Boolean.FALSE);</div>
			The cells that are not editable are then simply skipped in the processing.			
		</p>
	</li>
	<li>
		<b>NatGridLayerPainter - handle row height changes</b><br/>
		<p>
			The <span class="code">NatGridLayerPainter</span> is now also a <span class="code">ILayerCommandHandler</span> for the 
			<span class="code">RowSizeConfigurationCommand</span>, so if a <span class="code">RowSizeConfigurationCommand</span> is executed, 
			the fake rows take the new row height. It now also respects dynamic scaling changes.
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