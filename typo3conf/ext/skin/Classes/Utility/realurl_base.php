<?php
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_realurl_pathsegment,alias,nav_title,title';
  $TYPO3_CONF_VARS['EXTCONF']['realurl'] = array();
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY'] = array();

  /***
  **** Initialisation
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['init'] = array(
      'enableCHashCache' => 1,
      'appendMissingSlash' => 'ifNotFile',
      'enableUrlDecodeCache' => 1,
      'enableUrlEncodeCache' => 1,
      'respectSimulateStaticURLs' => 0,
      'postVarSet_failureMode'=>'redirect_goodUpperDir',
      'emptyUrlReturnValue' => '/'
  );

  /***
  **** Paramètrage des redirections 301
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['redirects'] = array(
  );

  /***
  **** Paramètrage des redirections 301 avec des regex
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['redirects_regex'] = array(
  );


  /***
  **** Paramètrage des variables preset
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['preVars'] = array(
    'langValues' => array(
        'GETvar' => 'L',
        'valueMap' => array(),
        'noMatch' => 'bypass'
    ),
    array(
        'GETvar' => 'no_cache',
        'valueMap' => array(
          'no_cache' => 1,
        ),
        'noMatch' => 'bypass',
    )
  );

  /***
  **** Paramètrage de la réecriture des chemins
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['pagePath'] = array(
      'type' => 'user',
      'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
      'spaceCharacter' => '-',
      'languageGetVar' => 'L',
      'expireDays' => 7,
      'segTitleFieldList' => 'tx_realurl_pathsegment,alias,nav_title,title',
      'excludePageIds'      => null
  );

  /***
  **** Paramètrage de la réécriture d'url des varialbes GET
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['postVarSets'] = array(
      '_DEFAULT' => array()
  );

  /***
  **** Inclusion des règles de réécritures pour l'extensions in_gallery
  ***/
  require_once('realurl_ingalleryflickr.php');

  /***
  **** Paramètrage de la réécriture des url fixes : sitemap, RSS, print, ...
  ***/
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['fileName'] = array(
      'defaultToHTMLsuffixOnPrev'=> '.html',

      'index' => array(
          'news.xml' => array(
              'keyValues' => array(
                  'type' => 100,
              ),
          ),

          'events.xml' => array(
              'keyValues' => array(
                  'type' => 101,
              ),
          ),

          'sitemap.xml' => array(
              'keyValues' => array(
                  'type' => 200,
              ),
          ),
      )
  );

  /***
  **** Inclusion des règles de réécritures locales, par domaines
  ***/
  require_once('realurl_lang.php')
?>