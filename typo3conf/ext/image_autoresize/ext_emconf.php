<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "image_autoresize".
 *
 * Auto generated 07-04-2014 11:52
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Resize images automatically',
	'description' => 'Simplify the way your editors may upload their images: no complex local procedure needed, let TYPO3 automatically resize down their huge images/pictures on-the-fly during upload (or using a scheduler task for batch processing) and according to your own business rules (directory/groups). This will highly reduce the footprint on your server and speed-up response time if lots of images are rendered (e.g., in a gallery). Features an EXIF/IPTC extractor to ensure metadata may be used by the FAL indexer even if not preserved upon resizing.',
	'category' => 'be',
	'shy' => 0,
	'version' => '1.5.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => 'mod1',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Xavier Perseguers (Causal)',
	'author_email' => 'xavier@causal.ch',
	'author_company' => 'Causal SÃ rl',
	'CGLcompliance' => NULL,
	'CGLcompliance_note' => NULL,
	'constraints' => 
	array (
		'depends' => 
		array (
			'php' => '5.3.3-5.5.99',
			'typo3' => '4.5.0-6.2.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

?>