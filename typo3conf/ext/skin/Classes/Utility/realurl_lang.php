<?php
  // Define domains and theirs root pid
  require_once('realurl_local.php');

  // Prepare L possible values
  // Comment those lines if you want to hide the en/, de/ prefix in your urls
  foreach ($domains as $domain => $params) {
    $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['preVars']['langValues']['valueMap'][$params['langKey']] = $params['langId'];
  }

  // Clone domains from _DUMMY conf
  foreach ($domains as $domain => $params) {
    $TYPO3_CONF_VARS['EXTCONF']['realurl'][$domain] = $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY'];
    $TYPO3_CONF_VARS['EXTCONF']['realurl'][$domain]['pagePath']['rootpage_id'] = $params['rootPid'];
  }

  // Unset the default configuration
  unset($TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']);
?>