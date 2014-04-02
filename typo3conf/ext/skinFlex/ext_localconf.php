<?php
	$_EXTCONF = unserialize($_EXTCONF);

  // Hooks
  $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['GridElementsTeam\Gridelements\Hooks\DrawItem'] = array(
    'className' => 'Inouit\skinFlex\Hooks\DrawItem',
  );

  // # columns 50 50
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-50-50.ts">');
  // # columns 30 70
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-30-70.ts">');
  // # columns 70 30
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-70-30.ts">');
  // # columns 33 33 33
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-33-33-33.ts">');
  // # Image Caption
 \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/imageCaption.ts">');
 // ## insert here
?>