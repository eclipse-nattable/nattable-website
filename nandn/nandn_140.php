<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'
/*******************************************************************************
 * Copyright (c) 2016 Dirk Fauth and others.
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
	$pageTitle 		= "NatTable 1.4.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 1.4.0 release was mainly made possible by <a href="http://www-list.cea.fr/index.php/en/">CEA LIST</a>
in order to add new features to the <a href="https://eclipse.org/papyrus/">Papyrus project</a>. 
There were a lot of contributions in form of ideas, bug reports, discussions and even new features like 
formula support, fill drag handle, CSS styling and several more you can find in the following sections. 
We would like to thank CEA LIST for their commitment and support on developing the 1.4.0 release.</p>

<p>Almost every change in code is tracked via ticket in Bugzilla, so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 1.4.0 release, have a look 
<a href="https://bugs.eclipse.org/bugs/buglist.cgi?classification=Technology&list_id=8836815&product=NatTable&query_format=advanced&resolution=FIXED&target_milestone=1.4.0">here</a>.</p>

<h3>API changes</h3>
<ul>
	<li>
		Deprecated <span class="code">GlazedListsDataProvider</span> as the original intended performance boost can not be verified 
		using a current Java version. It also introduces several issues in a multi-threaded environment, since 
		<span class="code">GlazedListsDataProvider</span> is not thread-safe.
	</li>
	<li>
		Changed the visibility of <span class="code">DataLayer#setDataProvider(IDataProvider)</span> to public in order to make it easier to exchange the
		data shown in a NatTable. There is a new example in the NatTable Examples Application to demonstrate the exchange of the <span class="code">IDataProvider</span>:<br>
		<i><b>Tutorial Examples -&gt; Data -&gt; ChangeDataProviderExample</b></i> 
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>New NatTable Extensions</b><br/>
		There are now two additional NatTable Extensions available:
		<ul>
			<li><i>Eclipse 4 Extension</i><br>
			Contains CSS styling support and a general selection listener that works with the 
			<span class="code">ESelectionService</span>. To use this extension you need at least Eclipse Neon and Java 8.</li>
			<li><i>Nebula Extension</i><br>
			Contains integration support for the Nebula RichText control. To use this extension you need at least Eclipse Luna.</li>
		</ul>
		Details are explained below.
	</li>
	<li>
		<b>NatTable Feature Modifications</b><br/>
		The NatTable features now also include the third-party libraries they are making use of. This means for example that the GlazedLists
		Extension feature also contains the bundle <i>ca.odell.glazedlists</i>. This makes it easier to install and consume the NatTable features.
	</li>
	<li>
		<b>Extended copy &amp; paste support</b><br>
		Added support for copy &amp; paste within NatTable.<br>
		The following classes are created and used for internal copy &amp; paste:
		<ul>
			<li>
				<span class="code">InternalCellClipboard</span><br>
				Internal clipboard that is used to temporarily store copied cells for later paste actions. There is one instance created and referenced
				per NatTable instance.
			</li>
			<li>
				<span class="code">InternalCopyDataCommandHandler</span><br>
				<span class="code">ILayerCommandHandler</span> that handles the <span class="code">CopyDataToClipboardCommand</span> 
				and additionally stores the copied cells in the <span class="code">InternalCellClipboard</span>.
				Supports copy operations only for consecutive selections. Needs to be registered on a layer above the <span class="code">SelectionLayer</span>,
				e.g. the NatTable itself. For formula support the <span class="code">FormulaCopyDataCommandHandler</span> sub-class is provided.
			</li>
			<li>
				<span class="code">InternalPasteDataCommandHandler</span><br>
				<span class="code">ILayerCommandHandler</span> that handles the <span class="code">PasteDataCommand</span> 
				to paste the copied cells from the <span class="code">InternalCellClipboard</span>.
				Needs to be registered on a layer above the <span class="code">SelectionLayer</span>,
				e.g. the NatTable itself. For formula support the <span class="code">FormulaPasteDataCommandHandler</span> sub-class is provided.
			</li>
			<li>
				<span class="code">InternalClipboardStructuralChangeListener</span><br>
				<span class="code">ILayerListener</span> that clears the <span class="code">InternalCellClipboard</span> on structural changes.
			</li>
			<li>
				<span class="code">ClearClipboardAction</span><br>
				<span class="code">IKeyAction</span> that can be registered to clear the <span class="code">InternalCellClipboard</span>.
				The <span class="code">DefaultFormulaConfiguration</span> registers it for the ESC key.
			</li>
			<li>
				<span class="code">PasteDataAction</span><br>
				<span class="code">IKeyAction</span> that can be registered to paste data to the current selected position.
				The <span class="code">DefaultFormulaConfiguration</span> registers it for CTRL+V.
			</li>
			<li>
				<span class="code">PasteOrMoveSelectionAction</span><br>
				<span class="code">IKeyAction</span> that can be registered to paste data to the current selected position if there is something
				in the <span class="code">InternalCellClipboard</span>. Otherwise the selection anchor moves one position down.
				The <span class="code">DefaultFormulaConfiguration</span> registers it for ENTER.
			</li>
			<li>
				<span class="code">CopySelectionLayerPainter</span><br>
				Specialized <span class="code">SelectionLayerPainter</span> that is used to render a border around cells that are currently 
				stored in the <span class="code">InternalCellClipboard</span>. Needs to be set to the <span class="code">SelectionLayer</span>
				via <span class="code">SelectionLayer#setLayerPainter(ILayerPainter)</span>.
			</li>
		</ul>
	</li>
	<li>
		<b>Formula support</b><br/>
		Added formula support similar to the capabilities of well known spreadsheet applications.
		<p>
			To support formulas in NatTable the following classes where added:
			<ul>
				<li>
					<span class="code">FormulaParser</span><br/>
					The parser that is used to evaluate formulas and therefore the basic part of the formula support in NatTable.
					It supports the evaluation of basic mathematical operations and functions, and is able to evaluate cell references.
				</li>
				<li>
					<span class="code">FormulaDataProvider</span><br/>
					Wrapper around a base <span class="code">IDataProvider</span> that makes use of the <span class="code">FormulaParser</span> for 
					formula evaluation in case a formula/function is the cell value. The sub-class <span class="code">FormulaRowDataProvider</span> 
					that implements the <span class="code">IRowDataProvider</span> interface to support row based compositions.
					<div class="codeBlock">IDataProvider dataProvider = 
    new TwoDimensionalArrayDataProvider(new String[26][50]);
FormulaDataProvider formulaDataProvider = 
    new FormulaDataProvider(dataProvider);
DataLayer bodyDataLayer = 
    new DataLayer(formulaDataProvider);</div>
				</li>
				<li>
					<span class="code">FormulaEditDisplayConverter</span><br/>
					<span class="code">IDisplayConverter</span> that needs to be registered for <span class="code">DisplayMode#EDIT</span>
					in order to support editing of formulas while in normal mode the formula result will be shown.
				</li>
				<li>
					<span class="code">FormulaErrorReporter</span><br/>
					A <span class="code">FormulaErrorReporter</span> can be registered with the <span class="code">FormulaDataProvider</span>
					to be able to report formula evaluation errors to the user. The default implementation <span class="code">FormulaTooltipErrorReporter</span>
					reports the error to the user via tooltip.
					<div class="codeBlock">bodyLayer.getFormulaDataProvider().setErrorReporter(
    new FormulaTooltipErrorReporter(
        natTable, 
        bodyLayer.getDataLayer()));</div>
				</li>
				<li>
					<span class="code">FormulaCopyDataCommandHandler</span><br>
					<span class="code">FormulaPasteDataCommandHandler</span><br>
					<span class="code">FormulaFillHandlePasteCommandHandler</span><br>
					Special command handler implementations to handle copy&amp;paste and fill drag operations that update formulas relatively to the paste location.
				</li>
				<li>
					<span class="code">DisableFormulaEvaluationCommand</span><br>
					<span class="code">EnableFormulaEvaluationCommand</span><br>
					Commands to disable/enable formula evaluation at runtime. This can also be done directly via <span class="code">FormulaDataProvider</span>.
				</li>
				<li>
					<span class="code">DefaultFormulaConfiguration</span><br>
					Default configuration for formula integration to a NatTable.
					<div class="codeBlock">natTable.addConfiguration(
    new DefaultFormulaConfiguration(
        bodyLayer.getFormulaDataProvider(),
        bodyLayer.getSelectionLayer(),
        natTable.getInternalCellClipboard()));</div>
				</li>
			</ul>
		</p>
		<p>
			There is a new example in the NatTable Examples Application to demonstrate the formula support: <i><b>Tutorial Examples -&gt; Data -&gt; FormulaDataExample</b></i>
		</p>
		<p>
			A formula always starts with an equal sign (=) and is followed by math operations, cell references, numbers and functions,
			e.g. <i>=SUM(A0:A9)*0.5</i>. 
		</p>
		<p>
			The following arithmetic operators are supported to perform basic mathematical operations:
			<table>
		        <thead>
		          <tr>
		            <td>
		              <p>
		                <b>Arithmetic operator</b>
		              </p>
		            </td>
		            <td>
		              <p>
		                <b>Meaning</b>
		              </p>
		            </td>
		            <td>
		              <p>
		                <b>Example</b>
		              </p>
		            </td>
		          </tr>
		        </thead>
		        <tbody>
		          <tr>
		            <td>
		              + (plus sign)
		            </td>
		            <td>
		              Addition
		            </td>
		            <td>
		              3+3
		            </td>
		          </tr>
		          <tr>
		            <td>
		              – (minus sign)
		            </td>
		            <td>
		              Subtraction<br>Negation
		            </td>
		            <td>
		              3–1 <br>–1
		            </td>
		          </tr>
		          <tr>
		            <td>
		              * (asterisk)
		            </td>
		            <td>
		              Multiplication
		            </td>
		            <td>
		              3*3
		            </td>
		          </tr>
		          <tr>
		            <td>
		              / (forward slash)
		            </td>
		            <td>
		              Division 
		            </td>
		            <td>
		              3/3
		            </td>
		          </tr>
		          <tr>
		            <td>
		              ^ (caret)
		            </td>
		            <td>
		              Exponentiation
		            </td>
		            <td>
		              3^2
		            </td>
		          </tr>
		        </tbody>
		      </table> 
		</p>
		<p>
			It is possible to use cell references in formulas to perform calculations based on values in other cells or cell ranges.
			NatTable uses the same reference mechanism as in other well-known spreadsheet applications.
			<table>
		        <thead>
		          <tr>
		            <td>
		              <p>
		                <b>To refer to</b>
		              </p>
		            </td>
		            <td>
		              <p>
		                <b>Use</b>
		              </p>
		            </td>
		          </tr>
		        </thead>
		        <tbody>
		          <tr>
		            <td>
		              The cell in column A and row 10
		            </td>
		            <td>
		              A10
		            </td>
		          </tr>
		          <tr>
		            <td>
		              The range of cells in column A and rows 10 through 20
		            </td>
		            <td>
		              A10:A20
		            </td>
		          </tr>
		          <tr>
		            <td>
		              The range of cells in row 15 and columns B through E
		            </td>
		            <td>
		              B15:E15
		            </td>
		          </tr>
		          <tr>
		            <td>
		              All cells in row 5
		            </td>
		            <td>
		              5:5
		            </td>
		          </tr>
		          <tr>
		            <td>
		              All cells in rows 5 through 10
		            </td>
		            <td>
		              5:10
		            </td>
		          </tr>
		          <tr>
		            <td>
		              All cells in column H
		            </td>
		            <td>
		              H:H
		            </td>
		          </tr>
		          <tr>
		            <td>
		              All cells in columns H through J
		            </td>
		            <td>
		              H:J
		            </td>
		          </tr>
		          <tr>
		            <td>
		              The range of cells in columns A through E and rows 10 through 20
		            </td>
		            <td>
		              A10:E20
		            </td>
		          </tr>
		        </tbody>
		      </table> 
		</p>
		<p>
			Functions can be used to execute more complicated formulas. They start with the function name and have the values to deal with as parameters in 
			brackets. Note that multiple function parameters need to be separated by a semicolon (;), as the comma could be problematic for localized
			decimal values.
			The following functions are supported out of the box:
			<table>
		        <thead>
		          <tr>
		            <td>
		              <p>
		                <b>Function</b>
		              </p>
		            </td>
		            <td>
		              <p>
		                <b>Description</b>
		              </p>
		            </td>
		          </tr>
		        </thead>
		        <tbody>
		          <tr>
		            <td>
		              AVERAGE
		            </td>
		            <td>
		              Calculates the average of a list of supplied numbers.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              MOD
		            </td>
		            <td>
		              Calculates the remainder from a division between two supplied numbers.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              NEGATE
		            </td>
		            <td>
		              Negates the given value.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              POWER
		            </td>
		            <td>
		              Calculates the result of a given number raised to a supplied power.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              PRODUCT
		            </td>
		            <td>
		              Calculates the product of a supplied list of numbers.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              QUOTIENT
		            </td>
		            <td>
		              Calculates the quotient of a division.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              SQRT
		            </td>
		            <td>
		              Calculates the positive square root of a given number.
		            </td>
		          </tr>
		          <tr>
		            <td>
		              SUM
		            </td>
		            <td>
		              Calculates the sum of a supplied list of numbers.
		            </td>
		          </tr>
		        </tbody>
		      </table> 
		</p>
		<p>
			It is possible to add new functions by implementing one of the following classes:
			<ul>
				<li><span class="code">AbstractFunction</span></li>
				<li><span class="code">AbstractMathFunction</span></li>
				<li><span class="code">AbstractMathSingleValueFunction</span></li>
			</ul>
			and register it to via <span class="code">FormulaParser#registerFunction(String, Class<? extends AbstractFunction>)</span>.<br><br>
			<div class="codeBlock">// function that simply doubles the given value
public class DoubleFunction 
    extends AbstractMathSingleValueFunction {
    
    @Override
    public BigDecimal getValue() {
        return convertValue(getSingleValue().getValue())
            .multiply(BigDecimal.valueOf(2));
    }
}</div><br>
			<div class="codeBlock">this.formulaDataProvider
    .registerFunction("DOUBLE", DoubleFunction.class);</div>
		</p>
		<p>
			<b>Note:</b> As the instantiation of a function is done at runtime via reflection, the function class needs to be a public class
			with an empty default constructor!
		</p>
		<p>
			For exporting formulas the <span class="code">PoiExcelExporter</span> in the <i>Apache POI Extension</i> was extended. 
			It is now possible to set a <span class="code">FormulaParser</span> so formulas in NatTable are exported as Excel formulas.
		</p>
	</li>
	<li>
		<b>Fill drag handle</b><br/>
		Added the feature to add a fill drag handle similar to well known spreadsheet applications.
		This can be enabled by simply adding the <span class="code">FillHandleConfiguration</span> to a NatTable instance.
		<div class="codeBlock">natTable.addConfiguration(
    new FillHandleConfiguration(selectionLayer));</div>
		<p>
			<b>Note:</b> Ensure that the NatTable instance is editable in order to make the fill drag handle work. It is not intended 
			to update cells that are not editable.
		</p>
		<p>
			The <span class="code">FillHandleConfiguration</span> basically adds the following new elements:
			<ul>
				<li>
					<span class="code">FillHandleLayerPainter</span><br/>
					Specialized <span class="code">SelectionLayerPainter</span> that renders a selection handle on the bottom right of a consecutive selection.
				</li>
				<li>
					<span class="code">FillHandleMarkupListener</span><br/>
					Listener that will trigger a markup of the cell to which the fill drag handle should be bound.
				</li>
				<li>
					<span class="code">FillHandleEventMatcher</span><br/>
					<span class="code">MouseEventMatcher</span> that returns true in case the mouse moves over the fill drag handle rendered by 
					the <span class="code">FillHandleOverlayPainter</span>.
				</li>
				<li>
					<span class="code">FillHandleCursorAction</span><br/>
					Action that will change the cursor to a small cross to indicate fill drag behavior can be used.
				</li>
				<li>
					<span class="code">FillHandleDragMode</span><br/>
					<span class="code">IDragMode</span> that gets activated once the fill drag handle is dragged.
				</li>
				<li>
					<span class="code">FillHandlePasteCommand</span> &amp; <span class="code">FillHandlePasteCommandHandler</span><br/>
					<span class="code">ILayerCommandHandler</span> that handles the <span class="code">ILayerCommand</span> which is triggered on 
					releasing the fill drag handle.
					For formula support the <span class="code">FormulaFillHandlePasteCommandHandler</span> sub-class is provided.
				</li>
			</ul>
		</p>
		<p>
			It is possible to configure the fill drag handle via the following configuration attributes:
			<ul>
				<li><span class="code">FillHandleConfigAttributes#FILL_HANDLE_REGION_BORDER_STYLE</span><br/>
					the line style that should be used to render the border around cells that are contained in the fill area
				</li>
				<li><span class="code">FillHandleConfigAttributes#FILL_HANDLE_BORDER_STYLE</span><br/>
					the border style of the fill drag handle itself
				</li>
				<li><span class="code">FillHandleConfigAttributes#FILL_HANDLE_COLOR</span><br/>
					the color of the fill drag handle
				</li>
				<li><span class="code">FillHandleConfigAttributes#INCREMENT_DATE_FIELD</span><br/>
					the date field that should be incremented when inserting a series of date values via fill drag handle
				</li>
				<li><span class="code">FillHandleConfigAttributes#ALLOWED_FILL_DIRECTION</span><br/>
					the direction(s) that are allowed for the fill drag handle
				</li>
			</ul>
		</p>
		<p>
			The <i>FormulaDataExample</i> in the NatTable Examples Application also demonstrates the fill drag handle: <i><b>Tutorial Examples -&gt; Data -&gt; FormulaDataExample</b></i>
		</p>
		<p>
			The Papyrus team published a <a href="https://www.youtube.com/watch?v=LdP3-wIvWb8" target="_blank">video</a> to demonstrate the integration and adaption of the NatTable fill drag handle to Papyrus tables and trees.
		</p>
	</li>
	<li>
		<b>Delete support</b><br/>
		Added support to easily delete values from a NatTable. For this the following classes were added:
		<ul>
			<li>
				<span class="code">DeleteSelectionCommand</span><br>
				<span class="code">ILayerCommand</span> that is used to delete the values in the current selected cells.
			</li>
			<li>
				<span class="code">DeleteSelectionCommandHandler</span><br>
				<span class="code">ILayerCommandHandler</span> that handles the <span class="code">DeleteSelectionCommand</span> 
				Sets the values of the current selected cells to <i>null</i>.
				Needs to be registered a layer above the <span class="code">SelectionLayer</span>,
				e.g. the NatTable itself.
			</li>
			<li>
				<span class="code">DeleteSelectionAction</span><br>
				<span class="code">IKeyAction</span> that can be registered to trigger the <span class="code">DeleteSelectionCommand</span>.
				The <span class="code">DefaultFormulaConfiguration</span> registers it for the DEL key.
			</li>
		</ul>
	</li>
	<li>
		<b>Content proposal support in <span class="code">TextCellEditor</span></b><br/>
		Added support for content proposals via JFace <span class="code">IControlContentAdapter</span> and <span class="code">IContentProposalProvider</span>.
		The following snippet creates a <span class="code">TextCellEditor</span> that provides content proposal on pressing CTRL + SPACE.
		<p>
		<div class="codeBlock">TextCellEditor textEditor = new TextCellEditor();
    textEditor.enableContentProposal(
    new TextContentAdapter(),
    new SimpleContentProposalProvider(
        new String[] { "Flanders", "Simpson", "Smithers" }),
    KeyStroke.getInstance(SWT.CTRL, SWT.SPACE),
    null);</div>
    	</p>
    	<p>
        	Further information on JFace content proposals can be found in the <a href="http://help.eclipse.org/mars/index.jsp?topic=%2Forg.eclipse.platform.doc.isv%2Fguide%2Fjface_fieldassist.htm" target="_blank">Eclipse Help - Field Assist</a>
		</p>
	</li>
	<li>
		<b>Locale changes at runtime</b><br/>
		The NatTable messages class <span class="code">org.eclipse.nebula.widgets.nattable.Messages</span> now provides a static method
		<span class="code">changeLocale(Locale)</span> to support locale changes at runtime. This makes it possible to also re-localize
		the NatTable internal labels, e.g. for NatTable menu items.
		<p>
			NatTable currently only provides translations for English and German. Contributions of additional languages are welcome.
			Alternatively you can add or replace translation property files via fragments as documented widely.
		</p>
	</li>
	<li>
		<b>Grid line width configuration</b><br/>
		Added the <span class="code">ConfigAttribute</span> <span class="code">CellConfigAttributes#GRID_LINE_WIDTH</span> to support
		the configuration of the grid line width. This was mainly introduced because of print issues where grid lines where sometimes
		not rendered because of rounding issues related to 1px grid lines.
	</li>
	<li>
		<b>Auto resizing</b><br/>
		The <span class="code">AutoResizeHelper</span> was introduced to perform in-memory pre-rendering. It is used to perform auto-resizing
		with <span class="code">ICellPainter</span> that are configured to calculate the row height or column width based on the content.
		<p>
			The usage of the <span class="code">AutoResizeHelper</span> is important for printing if such dynamic size calculation painters are used
			and is therefore executed by the <span class="code">LayerPrinter</span>.
		</p>
		<p>
			<div class="codeBlock">AutoResizeHelper<br>&nbsp;&nbsp;&nbsp;&nbsp;.autoResize(natTable, natTable.getConfigRegistry());</div>
		</p>
	</li>
	<li>
		<b>Filterable comboboxes</b><br/>
		The <span class="code">NatCombo</span> and the combo box cell editors that are based on <span class="code">NatCombo</span> now support filters 
		similar to filterable viewers in JFace. Thanks to Ryan McHale who contributed that feature.
		<p>
			The filter can either be enabled directly via <span class="code">NatCombo</span> by setting the <span class="code">showDropdownFilter</span> 
			constructor parameter to <span class="code">true</span> or by setting the corresponding flag on the editor via 
			<span class="code">ComboBoxCellEditor#setShowDropdownFilter(boolean)</span>.
		</p>
		<p>
			<img align="middle" src="../images/filterable_filter.png" border="0" alt="Filterable Filter"/>
		</p>
	</li>
	<li>
		<b>Filter: Added wildcard support for regular expression filters</b><br/>
		Added the <span class="code">FilterRowRegularExpressionConverter</span> that supports simplified wildcard support for regular expression filters.
		This <span class="code">IDisplayConverter</span> will transform * to the regular expression (.*) and ? to the regular expression (.?).
		<p>
			<div class="codeBlock">configRegistry.registerConfigAttribute(
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
        + DataModelConstants.FIRSTNAME_COLUMN_POSITION);</div>
		</p>
	</li>
	<li>
		<b>Rich text support</b><br/>
		The new <i>NatTable Nebula Extension</i> contains support for integrating the 
		<a href="http://www.eclipse.org/nebula/widgets/richtext/richtext.php" target="_blank">Nebula RichText</a> control. With this integration it
		is possible to render HTML formatted text in NatTable cells.
		<p>
			There are three classes for integrating the Nebula RichText control:
			<ul>
				<li>
					<span class="code">RichTextCellPainter</span><br>
					<span class="code">ICellPainter</span> implementation that makes use of the <span class="code">org.eclipse.nebula.widgets.richtext.RichTextPainter</span>
					to render HTML formatted text.
					<div class="codeBlock">configRegistry.registerConfigAttribute(
    CellConfigAttributes.CELL_PAINTER,
    new BackgroundPainter(new RichTextCellPainter()));</div>
				</li>
				<li>
					<span class="code">RichTextCellEditor</span><br>
					<span class="code">ICellEditor</span> implementation that makes use of the <span class="code">org.eclipse.nebula.widgets.richtext.RichTextEditor</span>
					to edit HTML formatted text via Nebula RichText control.
					<div class="codeBlock">configRegistry.registerConfigAttribute(
    EditConfigAttributes.CELL_EDITOR,
    new RichTextCellEditor());</div>
    				The RichText editor control can be moved by dragging it from the upper left corner and resized by dragging the lower right corner.
				</li>
				<li>
					<span class="code">MarkupDisplayConverter</span><br>
					<span class="code">IDisplayConverter</span> implementation that wraps another <span class="code">IDisplayConverter</span> and is able to wrap 
					a value with HTML tags.
					<div class="codeBlock">MarkupDisplayConverter mc = new MarkupDisplayConverter();
mc.registerMarkup("Simpson", "&lt;em&gt;", "&lt;/em&gt;");
mc.registerMarkup("Smithers",
    "&lt;span style=\"background-color:rgb(255, 0, 0)\"&gt;&lt;strong&gt;&lt;s&gt;&lt;u&gt;",
    "&lt;/u&gt;&lt;/s&gt;&lt;/strong&gt;&lt;/span&gt;");

configRegistry.registerConfigAttribute(
    CellConfigAttributes.DISPLAY_CONVERTER,
    mc);</div>
				</li>
			</ul>
		</p>
		<p>
			There is a new example in the NatTable Examples Application to demonstrate the RichText integration:<br><i><b>Tutorial Examples -&gt; Configuration -&gt; NebulaRichTextIntegrationExample</b></i>
		</p>
		<p>
			<img align="middle" src="../images/richtext.png" border="0" alt="Nebula RichText Integration"/>
		</p>
		<p>
			<b>Note:</b> The <span class="code">RichTextCellEditor</span> is committed on pressing CTRL + ENTER.
		</p>
	</li>
	<li>
		<b>E4 Selection Listener</b><br/>
		The new <i>Eclipse 4 Extension</i> contains a default implementation of a selection listener that provides a selection via 
		<span class="code">ESelectionService</span>. It is an <span class="code">ILayerListener</span> implementation that needs to be
		registered on the <span class="code">SelectionLayer</span>.
		<p>
		<div class="codeBlock">E4SelectionListener<Person> esl = 
    new E4SelectionListener<>(
        service, 
        selectionLayer, 
        bodyRowDataProvider);
selectionLayer.addLayerListener(esl);</div>
        </p>
        <p>
        	By default it only reacts on full row selection and sends a <span class="code">List</span> of row object values. 
        	Therefore an Eclipse 4 selection listener could look like this.
        </p>
		<p>
		<div class="codeBlock">@Inject
@Optional
void handleSelection(
    @Named(IServiceConstants.ACTIVE_SELECTION) List<Person> selected) {
    
    if (selected != null) {
        // do something
    }
}</div>
        </p>
        <p>
        	This behavior can be changed to send only a single value or react on every cell selection. Check the API for further details.
        </p>

	</li>
	<li>
		<b>CSS styling</b><br/>
		<p>
			The new <i>Eclipse 4 Extension</i> contains support for CSS styling based on the Eclipse 4 CSS engine.
		</p>
		<p>
			The <a href="https://git.eclipse.org/c/nattable/org.eclipse.nebula.widgets.nattable.git/" target="_blank">NatTable repository</a> now contains an 
			additional example project <i>org.eclipse.nebula.widgets.nattable.examples.e4</i> based on Eclipse 4. There you can find several examples regarding
			different CSS styling capabilities, selection listener, popup menu configuration via application model. It will be further improved in the future
			and possibly published as downloadable application aswell.
		</p>
		<p>
			<b>Note:</b><br/>
			Styling a NatTable with CSS only works well with the CSS engine in Eclipse Neon M5 and upwards.
			The reason for this are the following tickets that have been resolved there:
			<ul>
				<li>
					<a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=479896">Bug 479896</a>
				</li>
				<li>
					<a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=484971">Bug 484971</a>
				</li>
			</ul>
		</p>
		<p>
			<b>CSS Selectors</b><br>
			<p>
				To create a CSS style definition, the general selector <span class="code">NatTable</span> can be used.
				Additionally a class or id based selector can be used. For example you can create a class based style definition
				<div class="codeBlock">.basic {
    cell-background-color: white;
    text-align: left;
}</div>
			</p>
			<p>
				And then configure that class for a NatTable instance via <span class="code">setData()</span>.
				<div class="codeBlock">natTable.setData(CSSSWTConstants.CSS_CLASS_NAME_KEY, "basic");</div>
			</p>
			
			<p>
				<b>Note:</b><br>
				If you want to use multiple NatTable instances in one application that should be styled differently, you should not use the
				general <i>NatTable</i> selector at all. The styles configured for the general selector will always win. Instead you need to use class
				or id selectors in the CSS style definition and the NatTable configuration. 
			</p>
			
			<p>
				For NatTable CSS styling pseudo classes are used to specify the NatTable <span class="code">DisplayMode</span>.
				The following table shows the pseudo classes that are supported for NatTable CSS styling:
				<table>
			        <thead>
			          <tr>
			            <td width="150px">
			              <p>
			                <b>CSS Pseudo Classes</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>Description</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td>
			              :normal
			            </td>
			            <td>
			              <span class="code">DisplayMode#NORMAL</span>. Doesn't need to be specified as this is the default.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              :select
			            </td>
			            <td>
			              <span class="code">DisplayMode#SELECT</span> used to specify the styling for selected cells.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              :edit
			            </td>
			            <td>
			              <span class="code">DisplayMode#EDIT</span> used to specify the styling of cells that are currently edited.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              :hover
			            </td>
			            <td>
			              <span class="code">DisplayMode#HOVER</span> used to specify the styling of cells that are hovered by the mouse.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              :select-hover
			            </td>
			            <td>
			              <span class="code">DisplayMode#SELECT_HOVER</span> used to specify the styling of selected cells that are hovered by the mouse.
			            </td>
			          </tr>
			        </tbody>
			    </table>
			</p>
			
			<p>
				<i>Child Selector</i><br>
				In NatTable conditional styling is achieved via configuration labels. These labels are added via <span class="code">IConfigLabelAccumulator</span>
				to cells. For CSS styling these labels can be used in child selectors via id or class based selector.
				<p>
					To inform the CSS engine about the available labels, the <span class="code">IConfigLabelProvider</span> interface was introduced, which
					extends the <span class="code">IConfigLabelAccumulator</span> interface. All NatTable default <span class="code">IConfigLabelAccumulator</span>
					are changed to <span class="code">IConfigLabelProvider</span> in order to support styling via child selectors. The labels used by a NatTable
					can be read via <span class="code">NatTable#getProvidedLabels()</span> which asks the underlying layers via <span class="code">AbstractLayer#getProvidedLabels()</span>.
					This means, if custom labels that are provided via custom <span class="code">IConfigLabelAccumulator</span> should be usable in CSS styling
					via child selectors, the <span class="code">IConfigLabelAccumulator</span> implementation needs to implement <span class="code">IConfigLabelProvider</span>.
				</p>
			</p>
			
			<p>
				The following table shows some examples for NatTable related CSS selectors:
				<table>
			        <thead>
			          <tr>
			            <td>
			              <p>
			                <b>CSS Selector</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>Description</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td>
			              NatTable
			            </td>
			            <td>
			              Style definitions for <span class="code">DisplayMode#NORMAL</span>. Applied to all NatTable instances.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              .basic
			            </td>
			            <td>
			              Style definitions for <span class="code">DisplayMode#NORMAL</span>. Applied to NatTable instances that have the CSS class <i>basic</i>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              .basic:select
			            </td>
			            <td>
			              Style definitions for <span class="code">DisplayMode#SELECT</span>, which means they are applied to selected cells in NatTable 
			              instances that have the CSS class <i>basic</i>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              .basic > .COLUMN_HEADER
			            </td>
			            <td>
			              Style definitions for <span class="code">DisplayMode#NORMAL</span>. Applied to cells with config label <i>COLUMN_HEADER</i> in 
			              NatTable instances that have the CSS class <i>basic</i>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              .basic > .COLUMN_HEADER:select
			            </td>
			            <td>
			              Style definitions for <span class="code">DisplayMode#SELECT</span> and config label <i>COLUMN_HEADER</i>. 
			              Applied to column header cells of columns that contain selected cells in NatTable instances that have the CSS class <i>basic</i>.
			            </td>
			          </tr>
			        </tbody>
			    </table>
			</p>
			
			<p>
				<b>CSS Properties</b><br>
				NatTable supports a wide range of CSS properties for style configuration. Most of them can be used on the table and the child level (child selector
				for label based configurations). A few can only be used on the table level, because they wouldn't have an effect for single cells.
				
				<p>
					The following table shows the general available CSS properties:
				</p>
				<p>
				<table>
			        <thead>
			          <tr>
			            <td>
			              <p>
			                <b>CSS Property</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>Description</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td width="200px">
			              border
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.BORDER_STYLE</span>. 
			              Triggers the usage of the <span class="code">LineBorderDecorator</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              border-color
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.BORDER_STYLE</span>. 
			              Triggers the usage of the <span class="code">LineBorderDecorator</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              border-style
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.BORDER_STYLE</span>. 
			              Triggers the usage of the <span class="code">LineBorderDecorator</span>.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              border-width
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.BORDER_STYLE</span>. 
			              Triggers the usage of the <span class="code">LineBorderDecorator</span>.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              cell-background-color
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes#BACKGROUND_COLOR</span>.
			              Triggers the usage of the <span class="code">BackgroundPainter</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              cell-background-image
			            </td>
			            <td>
			              CSS property for configuring a background based on an image.
			              Triggers the usage of the <span class="code">BackgroundImagePainter</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              color
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes#FOREGROUND_COLOR</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              column-width
			            </td>
			            <td>
			              CSS property to configure the column width. Available values are:
							<ul>
								<li><i>auto</i> - configure automatic width calculation for content painters
								</li>
								<li><i>percentage</i> - configure general percentage sizing</li>
								<li>percentage value (e.g. <i>20%</i>) - configure specific percentage sizing
								</li>
								<li>number value (e.g. <i>100px</i>) - configure column width</li>
							</ul>
			              <p>
							<b>Example:</b><br>
							<span class="code">column-width: 20%;</span>			              	
			              </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-background-color
			            </td>
			            <td>
			              CSS property for specifying the background color of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-color
			            </td>
			            <td>
			              CSS property for specifying the foreground color of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-font
			            </td>
			            <td>
			              CSS property for specifying the font of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-font-family
			            </td>
			            <td>
			              CSS property for specifying the font family of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-font-size
			            </td>
			            <td>
			              CSS property for specifying the font size of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-font-style
			            </td>
			            <td>
			              CSS property for specifying the font style of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              conversion-error-font-weight
			            </td>
			            <td>
			              CSS property for specifying the font weight of a text cell editor on conversion error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              converter
			            </td>
			            <td>
			              CSS property to configure the display converter. Possible values are:
							<ul>
								<li>boolean</li>
								<li>character</li>
								<li>date "[pattern]"</li>
								<li>default</li>
								<li>percentage</li>
								<li>byte</li>
								<li>short [format]</li>
								<li>int [format]</li>
								<li>long [format]</li>
								<li>big-int</li>
								<li>float [format] [min-fraction-digits] [max-fraction-digits]</li>
								<li>double [format] [min-fraction-digits] [max-fraction-digits]</li>
								<li>big-decimal [min-fraction-digits] [max-fraction-digits]</li>
							</ul>
			              <p>
							<b>Examples:</b><br>
							<span class="code">converter: int;</span><br>		              	
							<span class="code">converter: date "yyyy-MM-dd";</span><br>		              	
							<span class="code">converter: double 2 2;</span>
			              </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              decoration
			            </td>
			            <td>
			              CSS property to configure a decoration. Consists of 4 values:
							<ul>
								<li>the URI for the decorator icon</li>
								<li>number value for the spacing between base painter and decoration</li>
								<li>the edge to paint the decoration
								(top|right|bottom|left|top-right|top-left|bottom-right|bottom-left</li>
								<li><i>true</i>|<i>false</i> to configure decoration dependent rendering</li>
							</ul>
			              <p>
							<b>Example:</b><br>
							<span class="code">decoration:<br>&nbsp;&nbsp;&nbsp;&nbsp;left url('./logo_16.png') 5 true;</span>
			              </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              font
			            </td>
			            <td>
			              CSS property for specifying the font via <span class="code">CellStyleAttributes.FONT</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              font-family
			            </td>
			            <td>
			              CSS property for specifying the font family via <span class="code">CellStyleAttributes.FONT</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              font-size
			            </td>
			            <td>
			              CSS property for specifying the font size via <span class="code">CellStyleAttributes.FONT</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              font-style
			            </td>
			            <td>
			              CSS property for specifying the font style via <span class="code">CellStyleAttributes.FONT</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              font-weight
			            </td>
			            <td>
			              CSS property for specifying the font weight via <span class="code">CellStyleAttributes.FONT</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              grid-line-color
			            </td>
			            <td>
			              CSS property for the color of the grid lines.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              grid-line-width
			            </td>
			            <td>
			              CSS property for the width of the grid lines.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              image
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.IMAGE</span>. 
			              Triggers the usage of the <span class="code">ImagePainter</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              invert-icons
			            </td>
			            <td>
			              CSS property to configure whether default decorator icons should be inverted.<br> 
						  Available values: <i>true</i>, <i>false</i> 
			            </td>
			          </tr>
			          <tr>
			            <td>
			              padding
			            </td>
			            <td>
			              CSS property to specify cell padding. 
			              Triggers usage of the <span class="code">PaddingDecorator</span> if painter resolution is enabled.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              padding-bottom
			            </td>
			            <td>
			              CSS property to specify the bottom padding of a cell. 
			              Triggers usage of the <span class="code">PaddingDecorator</span> if painter resolution is enabled.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              padding-left
			            </td>
			            <td>
			              CSS property to specify the left padding of a cell. 
			              Triggers usage of the <span class="code">PaddingDecorator</span> if painter resolution is enabled.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              padding-right
			            </td>
			            <td>
			              CSS property to specify the right padding of a cell. 
			              Triggers usage of the <span class="code">PaddingDecorator</span> if painter resolution is enabled.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              padding-top
			            </td>
			            <td>
			              CSS property to specify the top padding of a cell. 
			              Triggers usage of the <span class="code">PaddingDecorator</span> if painter resolution is enabled.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              painter
			            </td>
			            <td>
			              CSS property for configuring the painter.<br>
			              Further information can be found below.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              painter-resolution
			            </td>
			            <td>
			              CSS property for enabling/disabling the automatic painter resolution based on CSS properties.<br>
						  Available values: <i>true</i>, <i>false</i><br>
			              Further information can be found below.
			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              password-echo-char
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.PASSWORD_ECHO_CHAR</span>. 
			              Does not trigger the usage of the <span class="code">PasswordTextPainter</span>. 
			              This needs to be done via additional <span class="code">IConfiguration</span> or painter CSS property.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              percentage-decorator-colors
			            </td>
			            <td>
			              CSS property for configuring the colors to use with the <span class="code">PercentageBarDecorator</span>.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              render-grid-lines
			            </td>
			            <td>
			              CSS property to specify whether grid lines should be rendered or not.<br>
			              Available values: <i>true</i>, <i>false</i>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              row-height
			            </td>
			            <td>
			              CSS property to configure the row height. Available values are:
							<ul>
								<li>auto - configure automatic height calculation for content painters
								</li>
								<li>percentage - configure general percentage sizing</li>
								<li>percentage value (e.g. 20%) - configure specific percentage sizing
								</li>
								<li>number value (e.g. 100px) - configure row height</li>
							</ul>
			              <p>
							<b>Example:</b><br>
							<span class="code">row-height: 20px;</span>			              	
			              </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              text-align
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.HORIZONTAL_ALIGNMENT</span>.
			            </td>
			          </tr>
			          <tr>
			            <td>
			              text-decoration
			            </td>
			            <td>
							<p>
				              CSS property for <span class="code">CellStyleAttributes.TEXT_DECORATION</span>. 
							</p>
							<p>
								Available values: <i>none</i>, <i>underline</i>, <i>line-through</i>
							</p>
							<p>
								Combinations are possible via space separated list. 
							</p>
			              <p>
							<b>Example:</b><br>
							<span class="code">text-decoration: underline line-through;</span>			              	
			              </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              text-direction
			            </td>
			            <td>
			              CSS property to specify whether text should be rendered horizontally or vertically. 
			              Default is <i>horizontal</i>.<br>
			              Triggers the usage of either <span class="code">TextPainter</span> or <span class="code">VerticalTextPainter</span>.<br>
						  Available values: <i>horizontal, vertical</i>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              text-trim
			            </td>
			            <td>
			              CSS property to specify whether text should be trimmed on rendering words or not.<br>
			              Default is <i>true</i>.<br>
			              Available values: <i>true</i>, <i>false</i>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              text-wrap
			            </td>
			            <td>
			              CSS property to specify whether text should be trimmed on rendering words or not.<br>
			              Default is <i>true</i>.<br>
			              Available values: <i>true</i>, <i>false</i>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-background-color
			            </td>
			            <td>
			              CSS property for specifying the background color of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-color
			            </td>
			            <td>
			              CSS property for specifying the foreground color of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-font
			            </td>
			            <td>
			              CSS property for specifying the font of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-font-family
			            </td>
			            <td>
			              CSS property for specifying the font family of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-font-size
			            </td>
			            <td>
			              CSS property for specifying the font size of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-font-style
			            </td>
			            <td>
			              CSS property for specifying the font style of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              validation-error-font-weight
			            </td>
			            <td>
			              CSS property for specifying the font weight of a text cell editor on validation error.			              
			            </td>
			          </tr>
			          <tr>
			            <td>
			              vertical-align
			            </td>
			            <td>
			              CSS property for <span class="code">CellStyleAttributes.VERTICAL_ALIGNMENT</span>.			              
			            </td>
			          </tr>
			        </tbody>
			    </table>
				</p>
				
				<p>
					The following table shows the CSS properties that are only available on table level (no child selector):
				</p>
				<table>
			        <thead>
			          <tr>
			            <td width="175px">
			              <p>
			                <b>CSS Property</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>Description</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td>
			              <p>background-color</p>
			            </td>
			            <td>
			              <p>CSS property for the NatTable background color. 
			              This has effect on the area that does not show cells or cells with a transparent background.</p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>background-image</p>
			            </td>
			            <td>
			              <p>CSS property for the NatTable background image. 
			              This has effect on the area that does not show cells or cells with a transparent background.</p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>fill-handle-border</p>
			            </td>
			            <td>
			              <p>CSS property to specify the border of the fill drag handle.</p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>fill-handle-color</p>
			            </td>
			            <td>
			              <p>CSS property to specify the color of the fill drag handle.</p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>fill-region-border</p>
			            </td>
			            <td>
			              <p>CSS property to specify the border style of the fill region.</p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>freeze-separator-color</p>
			            </td>
			            <td>
			              <p>CSS property for the color of the freeze separator.</p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>table-border-color</p>
			            </td>
			            <td>
			              <p>
			              	CSS property to specify the border color that is applied around the NatTable. 
			              	Triggers the usage of the <span class="code">NatTableBorderOverlayPainter</span> to apply borders on every side of the table.</p> 
						  <p>
							Setting the value <i>auto</i> will use the configured grid line color as the table border color. 
			              </p>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              <p>tree-structure-painter</p>
			            </td>
			            <td>
			              <p>
							CSS property for configuring the tree structure painter. Similar to <span class="code">painter</span> but specific for the 
							tree structure configuration as it registers a painter for <span class="code">TreeConfigAttributes.TREE_STRUCTURE_PAINTER</span>. 
			              </p>
			              <p>
							<b>Note:</b> The value should always end with <i>tree</i> to configure a valid tree structure painter. 
							It is mainly intended to configure the painter hierarchy (background and decorators) and whether to use inverted default icons 
							via <span class="code">invert-icons</span>. 
			              </p>
			              <p>
							<b>Note:</b> The content painter that should be wrapped by the tree structure painter does not need to be added here aswell 
							because it is evaluated dynamically.			              	
			              </p>
			              <p>
							<b>Example:</b><br>
							<span class="code">tree-structure-painter:<br>&nbsp;&nbsp;&nbsp;&nbsp;background padding tree;</span>			              	
			              </p>
			            </td>
			          </tr>
			        </tbody>
			    </table>
			</p>
			
			<p>
				<b>Painter Configuration</b><br>
				The painter configuration is something special to NatTable. Styling in NatTable is a combination of styles and painters. By default the 
				painters will be derived from the specified style, e.g. specifying an image will trigger the usage of the <span class="code">ImagePainter</span>.
				<p>
					There are several cases where this behavior is not intended. NatTable for example has its own inheritance model. If a painter is not found
					for a label and DisplayMode, first the configuration value is searched for the label and DisplayMode hierarchy, and afterwards without
					label but with a DisplayMode hierarchy. If painters are registered automatically for CSS style configurations, the NatTable internal
					inheritance does of course not work anymore, as no search is performed.
				</p>
				<p>
					The automatic painter registration can be turned off on every level by setting the following CSS property:
					<div class="codeBlock">painter-resolution: false;</div>
				</p>
				
				<p>
					Painters can also be configured explicitly via CSS property <span class="code">painter</span>.
					This will also disable the automatic painter resolution. 
					The pattern for configuring a painter is<br><br>
					<b><i>[background-painter]?[decorator]*[content-painter]?</i></b>,<br><br>
					although it mostly doesn't make sense to not configure a content painter.
				</p>
				<p>
					The following table lists the possible values for <b>background painters</b>:
				<table>
			        <thead>
			          <tr>
			            <td width="175px">
			              <p>
			                <b>CSS Painter Value</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>NatTable Painter</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td>
			              background
			            </td>
			            <td>
			              <span class="code">BackgroundPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              gradient-background
			            </td>
			            <td>
			              <span class="code">GradientBackgroundPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              image-background
			            </td>
			            <td>
			              <span class="code">BackgroundImagePainter</span>
			            </td>
			          </tr>
			        </tbody>
			    </table>
				</p>
				<p>
					The following table lists the possible values for <b>decorator painters</b>:
				<table>
			        <thead>
			          <tr>
			            <td width="175px">
			              <p>
			                <b>CSS Painter Value</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>NatTable Painter</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td>
			              beveled-border
			            </td>
			            <td>
			              <span class="code">BeveledBorderDecorator</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              column-group
			            </td>
			            <td>
			              <span class="code">ColumnGroupHeaderTextPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              custom-line-border
			            </td>
			            <td>
			              <span class="code">CustomLineBorderDecorator</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              decorator
			            </td>
			            <td>
			              <span class="code">CellPainterDecorator</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              line-border
			            </td>
			            <td>
			              <span class="code">LineBorderDecorator</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              padding
			            </td>
			            <td>
			              <span class="code">PaddingDecorator</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              row-group
			            </td>
			            <td>
			              <span class="code">RowGroupHeaderTextPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              sort-header
			            </td>
			            <td>
			              <span class="code">SortableHeaderTextPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              tree
			            </td>
			            <td>
			              <span class="code">IndentedTreeImagePainter</span>
			            </td>
			          </tr>
			        </tbody>
			    </table>
				</p>
				<p>
					The following table lists the possible values for <b>content painters</b>:
				<table>
			        <thead>
			          <tr>
			            <td width="175px">
			              <p>
			                <b>CSS Painter Value</b>
			              </p>
			            </td>
			            <td>
			              <p>
			                <b>NatTable Painter</b>
			              </p>
			            </td>
			          </tr>
			        </thead>
			        <tbody>
			          <tr>
			            <td>
			              checkbox
			            </td>
			            <td>
			              <span class="code">CheckBoxPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              combobox
			            </td>
			            <td>
			              <span class="code">ComboBoxPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              image
			            </td>
			            <td>
			              <span class="code">ImagePainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              password
			            </td>
			            <td>
			              <span class="code">PasswordTextPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              percentage
			            </td>
			            <td>
			              <span class="code">PercentageBarCellPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              table
			            </td>
			            <td>
			              <span class="code">TableCellPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              text
			            </td>
			            <td>
			              <span class="code">TextPainter</span><br>
			              <span class="code">VerticalTextPainter</span>
			            </td>
			          </tr>
			          <tr>
			            <td>
			              none
			            </td>
			            <td>
			              Special value to explicitly set no content painter. Needed because by default the <span class="code">TextPainter</span>
			              will be used as fallback in case an invalid value is specified as content painter.
			            </td>
			          </tr>
			        </tbody>
			    </table>
				</p>
				<p>
				The following example shows how to register a painter that renders a cell with gradient background and padding around a checkbox.
				<div class="codeBlock">painter: gradient-background padding checkbox;</div>
				</p>
				<p>
					<i>Custom Painters</i><br>
					It is also possible to use custom painters in NatTable CSS painter configurations. For this a <span class="code">CellPainterCreator</span>
					or <span class="code">CellPainterWrapperCreator</span>, that creates an instance of the custom painter, needs to be registered to the 
					<span class="code">CellPainterFactory</span>.
					<div class="codeBlock">CellPainterFactory
  .getInstance()
  .registerContentPainter("custom", (properties, underlying) -> {
      return new MyPainter();
});</div>
				</p>
			</p>
			
		</p>
	</li>
	<li>
		<b>Extended Print Support</b><br/>
		The following modifications and extension where added to the print function of NatTable:
		<ul>
			<li>
				<i>Pre-rendering</i><br>
				By default the new in-memory pre-rendering is enabled to ensure that content painters that dynamically calculate the row height or
				content width based on the content of the cell trigger the resize before printing. This behavior can be disabled via 
				<span class="code">LayerPrinter#disablePreRendering()</span> and enabled via <span class="code">LayerPrinter#enablePreRendering()</span>. 
			</li>
			<li>
				<i>Increased grid line width</i><br>
				On printing the grid line width will be increased to 2px in case no other explicit configuration is applied. This setting will be decreased
				again afterwards. The increase of the grid line width is necessary to correct printing issues where grid lines where sometimes not 
				rendered because of rounding issues.
			</li>
		</ul>
	</li>
</ul>
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