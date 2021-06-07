<?php
/*******************************************************************************
 * Copyright (c) 2009 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *
 *******************************************************************************/

	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());

	$localVersion = false;

	# Define these here, or in _projectCommon.php for site-wide values
	$pageKeywords	= "eclipse, project, nattable, grid";
	$pageAuthor		= "Dirk Fauth, Stephan Wahlbrink";
	$pageTitle 		= "NatTable - Documentation";

	$page = 'start';
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	}

	// 	# Paste your HTML content between the EOHTML markers!
	$html = file_get_contents('documentation/' . $page . '.html');

	#$html .= file_get_contents('documentation/navigation.html');

	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="style.css"/>');
	$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="style2.css"/>');

	# Generate documentation navigation
	$Nav->addNavSeparator('Documentation', '/nattable/documentation.php');
	$Nav->addCustomNav('Contribution Guide', '/nattable/documentation.php?page=contribution_guide', '_self', 4);
	$Nav->addCustomNav('Getting started', '/nattable/documentation.php?page=getting_started', '_self', 3);
	$Nav->addCustomNav('Basics', '/nattable/documentation.php?page=basics', '_self', 4);
	$Nav->addCustomNav('Layers', '/nattable/documentation.php?page=layer', '_self', 4);
	$Nav->addCustomNav('Configuration', '/nattable/documentation.php?page=configuration', '_self', 4);
	$Nav->addCustomNav('Data access', '/nattable/documentation.php?page=data', '_self', 4);
	$Nav->addCustomNav('Styling', '/nattable/documentation.php?page=styling', '_self', 4);
	$Nav->addCustomNav('Editing', '/nattable/documentation.php?page=editing', '_self', 4);
	$Nav->addCustomNav('UI Bindings', '/nattable/documentation.php?page=binding', '_self', 4);
	$Nav->addCustomNav('Selection', '/nattable/documentation.php?page=selection', '_self', 4);
	$Nav->addCustomNav('Sorting', '/nattable/documentation.php?page=sorting', '_self', 4);
	$Nav->addCustomNav('Filtering', '/nattable/documentation.php?page=filtering', '_self', 4);
	$Nav->addCustomNav('Trees', '/nattable/documentation.php?page=tree', '_self', 4);
	$Nav->addCustomNav('Grouping', '/nattable/documentation.php?page=grouping', '_self', 4);
	$Nav->addCustomNav('Freeze', '/nattable/documentation.php?page=freeze', '_self', 4);
	$Nav->addCustomNav('Summary row', '/nattable/documentation.php?page=summary_row', '_self', 4);
	$Nav->addCustomNav('Context menus', '/nattable/documentation.php?page=context', '_self', 4);
	$Nav->addCustomNav('Custom commands', '/nattable/documentation.php?page=commands', '_self', 4);
	$Nav->addCustomNav('Persistence', '/nattable/documentation.php?page=persistence', '_self', 4);
	$Nav->addCustomNav('Examples', '/nattable/documentation.php?page=examples', '_self', 4);
	$Nav->addCustomNav('FAQ', '/nattable/documentation.php?page=faq', '_self', 4);
	$Nav->addCustomNav('Related articles', '/nattable/documentation.php?page=articles', '_self', 4);
	$Nav->addCustomNav('API Javadoc', 'http://download.eclipse.org/nattable/releases/2.0.1/apidocs', '_self', 4);

	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);

?>
