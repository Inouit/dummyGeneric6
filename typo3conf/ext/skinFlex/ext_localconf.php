<?php
	$_EXTCONF = unserialize($_EXTCONF);

  // # slice
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-slice.ts">');
  // # columns 50 50
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-50-50.ts">');
  // # columns 33 66
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-33-66.ts">');
  // # columns 66 33
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-66-33.ts">');
  // # columns 33 33 33
  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skinFlex/Configuration/TSconfig/columns-33-33-33.ts">');
 // ## insert here
?>