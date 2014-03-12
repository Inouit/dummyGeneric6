<?php
	$_EXTCONF = unserialize($_EXTCONF);

	$tsDirectory = 'Configuration/Typoscript/';
    Tx_SkinDummy_Utility_Typoscript::autoGenerateSetup($_EXTKEY, array($tsDirectory.'extensions', $tsDirectory.'blocks', $tsDirectory.'menus', $tsDirectory.'page', $tsDirectory.'templates', $tsDirectory.'languages'));
?>