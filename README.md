dummyGeneric6
=============

Dummy for typo3 6.2 or higher

Local files
===========

/typo3conf/AdditionalConfiguration.php

    <?php
    $GLOBALS['TYPO3_CONF_VARS'] = array_merge($GLOBALS['TYPO3_CONF_VARS'], array(
      'DB' => array(
        'database' => 'local_typo3_dummyGeneric6',
        'host' => 'localhost',
        'password' => 'password',
        'socket' => '',
        'username' => 'login',
      ),
    ));

/ext_typoscript_constants_local.txt

    config{
        domain = dummyGeneric6.local.inouit.com
        noCache = 1
    }