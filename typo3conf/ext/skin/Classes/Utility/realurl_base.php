<?php
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
  **** Paramètrage des redirections 301
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
  **** Paramètrage des redirections 301
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
      '_DUMMY' => array()
  );

  /***
  **** Inclusion des règles de réécritures pour l'extensions tt_news
  ***/
  // require_once('realurl_ttnews.php');

  /***
  **** Inclusion des règles de réécritures pour l'extensions in_gallery
  ***/
  // require_once('realurl_ingallery.php');

  /***
  **** Inclusion des règles de réécritures pour l'extensions in_documents
  ***/
  // require_once('realurl_indocuments.php');

  /***
  **** Paramètrage de la réécriture d'url des varialbes GET
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