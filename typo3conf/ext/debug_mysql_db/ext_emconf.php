<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "debug_mysql_db".
 *
 * Auto generated 14-04-2014 10:03
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Debug Mysql DB',
	'description' => 'Extends \\TYPO3\\CMS\\Core\\Database\\DatabaseConnection (former t3lib_db) to show Errors and Debug-Messages. Useful for viewing and debugging of sql-queries. Shows error messages if they occur. (For Typo3 V4.3-4.7 see versions 0.4.x)',
	'category' => 'misc',
	'shy' => 0,
	'version' => '0.5.2',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Stefan Geith',
	'author_email' => 'typo3dev2013@geithware.de',
	'author_company' => '',
	'CGLcompliance' => NULL,
	'CGLcompliance_note' => NULL,
	'constraints' => 
	array (
		'depends' => 
		array (
			'php' => '5.2.5-5.4.999',
			'typo3' => '6.1.0-6.2.999',
		),
		'conflicts' => 
		array (
			'dbal' => '0.0.0-0.0.0',
		),
		'suggests' => 
		array (
		),
	),
);

?>