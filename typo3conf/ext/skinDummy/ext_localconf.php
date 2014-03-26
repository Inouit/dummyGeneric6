<?php
	$_EXTCONF = unserialize($_EXTCONF);

  //  # Setup TS automatic generation
	$tsDirectory = 'Configuration/Typoscript/';
  Tx_SkinDummy_Utility_Typoscript::autoGenerateSetup($_EXTKEY, array($tsDirectory.'extensions', $tsDirectory.'blocks', $tsDirectory.'menus', $tsDirectory.'page', $tsDirectory.'templates'));
?>