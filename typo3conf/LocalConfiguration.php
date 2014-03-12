<?php
return array(
	'BE' => array(
		'debug' => '1',
		'explicitADmode' => 'explicitAllow',
		'installToolPassword' => '$P$CD4OthEhrPgXDC16sYBkmk7xF4klbf0',
		'loginSecurityLevel' => 'rsa',
		'versionNumberInFilename' => '0',
	),
	'DB' => array(
		'extTablesDefinitionScript' => 'extTables.php',
	),
	'EXT' => array(
		'extConf' => array(
			'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
			'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:0;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
			'skin' => 'a:0:{}',
			'skinDummy' => 'a:0:{}',
			'skinProject' => 'a:0:{}',
			'weeaar_googlesitemap' => 'a:0:{}',
		),
	),
	'FE' => array(
		'debug' => '1',
		'loginSecurityLevel' => 'rsa',
	),
	'GFX' => array(
		'colorspace' => 'sRGB',
		'im' => 1,
		'im_mask_temp_ext_gif' => 1,
		'im_path' => '/usr/bin/',
		'im_path_lzw' => '/usr/bin/',
		'im_v5effects' => 1,
		'im_version_5' => 'im6',
		'image_processing' => 1,
		'jpg_quality' => '80',
	),
	'SYS' => array(
		'caching' => array(
			'cacheConfigurations' => array(
				'extbase_object' => array(),
			),
		),
		'compat_version' => '6.2',
		'devIPmask' => '',
		'displayErrors' => FALSE,
		'enableDeprecationLog' => FALSE,
		'encryptionKey' => '252d761a8ecf9e54d5797612075d4f930b84038175a284dee3d6224e711e11be5d67cf6666d96c7f93bc4b8dd45fdffb',
		'isInitialInstallationInProgress' => FALSE,
		'sitename' => 'Dummy Generic 6',
		'sqlDebug' => 0,
		'systemLogLevel' => 2,
		't3lib_cs_convMethod' => 'mbstring',
		't3lib_cs_utils' => 'mbstring',
	),
);
?>