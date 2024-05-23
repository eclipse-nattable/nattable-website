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
	$pageTitle 		= "NatTable 2.4.0 - New &amp; Noteworthy";
	
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="../style2.css"/>');

	$html  = <<<EOHTML
<div id="midcolumn">
	<div id="doccontent">

<h2>$pageTitle</h2>
<p>
The NatTable 2.4.0 release was made possible by several companies that provided and sponsored ideas, bug reports, discussions and new features you can find in the following sections. 
We would like to thank everyone involved for their commitment and support on developing the 2.4.0 release.</p>
<p>
Of course we would also like to thank our contributors for adding new functions and fixing issues.
</p>
<p>Almost every change in code is tracked via [GitHub Issues](https://github.com/eclipse-nattable/nattable/milestone/3?closed=1), so if you are curious about the details and all the bugs that are fixed and enhancements that were added with the 2.4.0 release, have a look there.</p>

<h3>API changes</h3>
<ul>
	<li>
		Several modifications were made to increase the extensibility of NatTable.
		Some additional methods are added and the visibility of some existing methods is increased. 
		Existing code should work unchanged.<br>
		Below is the list of those methods, the details can be found in the <i>Enhancements and new features</i> section.
		<ul>
			<li><span class="code">DataChangeHandler#isDirty()</span></li>
			<li><span class="code">DataChangeLayer#isDirty()</span></li>
			<li><span class="code">TextCellEditor#getTextKeyListener()</span></li>
			<li><span class="code">UiBindingRegistry#registerFirstMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction)</span></li>
			<li><span class="code">UiBindingRegistry#registerMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction)</span></li>
			<li><span class="code">UiBindingRegistry#registerFirstMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction, boolean)</span></li>
			<li><span class="code">UiBindingRegistry#registerMouseMoveBinding(IMouseEventMatcher, IMouseAction, IMouseAction, boolean)</span></li>
			
			<li><span class="code">GroupByModel#addAllGroupByColumnIndexes(int...)</span></li>
			<li><span class="code">GroupByModel#setGroupByColumnIndexes(int...)</span></li>
			<li><span class="code">GroupByModel#removeAllGroupByColumnIndexes(int...)</span></li>
		</ul>
	</li>
	<li>
		Below is the list of methods that are deprecated with the 2.4.0 release.
		<ul>
			<li><span class="code">UiBindingRegistry#registerFirstMouseMoveBinding(IMouseEventMatcher, IMouseAction)</span></li>
			<li><span class="code">UiBindingRegistry#registerMouseMoveBinding(IMouseEventMatcher, IMouseAction)</span></li>
		</ul>
	</li>
</ul>

<h3>Enhancements and new features</h3>
<ul>
	<li>
		<b>Mouse move binding improvements</b><br/>
		<p>
			The mouse move binding handling is improved to be more specific in enter and exit matching. You now register the binding with a <code>IMouseEventMatcher</code> 
			and a <code>IMouseAction</code> that should be executed once the matcher matches (enter), and a <code>IMouseAction</code> that should be executed once the 
			matcher does not match anymore (exit). This way it is not necessary anymore to register additional cleanup move bindings, that are basically executed on every
			move, e.g. if the mouse cursor should change if it moves over an icon, it should reset if it is not over the icon anymore.
		</p>  
		<p>
			This change simplifies the move binding registration, reduces the number of move bindings as there don't need to be additional cleanup bindings, and improves
			the general performance if multiple move bindings and cleanup bindings are registered, as there is no need to execute the cleanup bindings on every movement.  
		</p>  
		</p>  
			
			<div class="codeBlock">// Mouse move - Show resize cursor
uiBindingRegistry.registerFirstMouseMoveBinding(
        new ColumnResizeEventMatcher(SWT.NONE, GridRegion.COLUMN_HEADER, 0),
        new ColumnResizeCursorAction(),
        new ClearCursorAction());</div>			
		</p>
	</li>
	<li>
		<b>GroupByModel - group multiple columns at once</b><br/>
		<p>
			The <code>GroupByModel</code> now provides additional methods to make it easier to set a grouping by multiple columns programmatically at once.
		</p>
	</li>
	<li>
		<b>TextCellEditor - option to replace the IKeyListener</b><br/>
		<p>
			It is now possible to extend the <code>TextCellEditor</code> and exchange the <code>IKeyListener</code> by overriding the new method <code>TextCellEditor#getTextKeyListener()</code>.
		</p>
	</li>
	<li>
		<b>General isDirty check</b><br/>
		<p>
			The <code>DataChangeHandler</code> implementations and the <code>DataChangeLayer</code> now provide a method to check the dirty state in general. This is useful for example
			if you want to set the dirty state of a part in Eclipse if a value in the NatTable was changed.
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