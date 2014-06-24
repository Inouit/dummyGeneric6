<?php
	$_EXTCONF = unserialize($_EXTCONF);

  // # Page TSConfig
  t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:skin/ext_pageTSConfig.txt">');

	//  # Setup TS automatic generation
  $tsDirectory = 'Configuration/Typoscript/';
  Tx_SkinDummy_Utility_Typoscript::autoGenerateSetup($_EXTKEY, array($tsDirectory.'extensions', $tsDirectory.'menus', $tsDirectory.'blocks', $tsDirectory.'page', $tsDirectory.'templates', $tsDirectory.'languages'));
?>