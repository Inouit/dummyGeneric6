dummyGeneric6
=============

[![Join the chat at https://gitter.im/Inouit/dummyGeneric6](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Inouit/dummyGeneric6?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Dummy for typo3 6.2 or higher

User
====
Login/password information for default user in Backend is admin/password, don't forget to change that.

Local files
===========

/typo3conf/ext/skin/ext_typoscript_constants.txt
```
    [...]
    <INCLUDE_TYPOSCRIPT: source="FILE:EXT:skin/ext_typoscript_constants_local.txt">
```

/typo3conf/ext/skin/ext_typoscript_constants_local.txt
```
    config{
        domain = myDomain.com
        noCache = 1
    }
```

/typo3conf/ext/skin/Classes/Utility/realurl_lang.php
``` php
    require_once('realurl_local.php');

    [...]
```


/typo3conf/ext/skin/Classes/Utility/realurl_local.php
``` php
    // Define domains and theirs root pid
    $domains = array(
        'myDomain.com' => array('rootPid' => '1', 'langKey' => 'fr', 'langId' => '0'),
        // 'en.myDomain.com' => array('rootPid' => '1', 'langKey' => 'en', 'langId' => '1')
    );
```

/typo3conf/AdditionalConfiguration.php
```  php
    /***
    **** Database Configuration
    ***/
    $GLOBALS['TYPO3_CONF_VARS'] = array_merge($GLOBALS['TYPO3_CONF_VARS'], array(
      'DB' => array(
        'host'     => 'myHost',
        'password' => 'myPassword',
        'socket'   => '',
        'username' => 'myLogin',
        'database' => 'myDatabaseName';
      ),
    ));

    /***
    **** BE Configuration
    ***/
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug']                      = TRUE;
    $GLOBALS['TYPO3_CONF_VARS']['BE']['fileCreateMask']             = '0660';
    $GLOBALS['TYPO3_CONF_VARS']['BE']['folderCreateMask']           = '2770';
    $GLOBALS['TYPO3_CONF_VARS']['BE']['loginSecurityLevel']         = 'rsa';
    $GLOBALS['TYPO3_CONF_VARS']['BE']['versionNumberInFilename']    = '0';
    $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr']         = 'myEmail@myDomain.com';
    $GLOBALS['TYPO3_CONF_VARS']['BE']['warning_mode']               = '1';

    /***
    **** SYS Configuration
    ***/
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse']               = '1';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask']             = '127.0.0.1,::1';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors']         = 2;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog']  = TRUE;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug']              = 1;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel']        = 2;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['t3lib_cs_convMethod']   = 'mbstring';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['t3lib_cs_utils']        = 'mbstring';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['setDBinit']             = 'SET NAMES utf8;';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel']        = '4';

    /***
    **** GFX Configuration
    ***/
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['colorspace']                    = 'sRGB';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['enable_typo3temp_db_tracking']  = '1';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['gdlib']                         = '1';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['gdlib_png']                     = '0';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im']                            = '0';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_mask_temp_ext_gif']          = '0';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path']                       = '/usr/bin/';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw']                   = '/usr/bin/';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_useStripProfileByDefault']   = '0';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_v5effects']                  = 0;
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_version_5']                  = 'im6';
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['image_processing']              = 1;
    $GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality']                   = '100';
```