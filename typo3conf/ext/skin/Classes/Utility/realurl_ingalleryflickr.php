<?php
$TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['postVarSets']['_DEFAULT'] = array_merge(
  $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DUMMY']['postVarSets']['_DEFAULT'],
  array(
        // Rewrite Album ingallery
    'album' => array(
      array(
        'GETvar' => 'tx_ingalleryflickr_pi1[album]',
        'lookUpTable' => array(
          'table' => 'tx_ingalleryflickr_domain_model_album',
          'id_field' => 'uid',
          'alias_field' => 'title',
          'addWhereClause' => ' AND NOT deleted',
          'useUniqueCache' => 1,
          'useUniqueCache_conf' => array(
            'strtolower' => 1,
            'spaceCharacter' => '-',
            ),
          ),
        ),
      ),
    'controller' => array(
      array(
        'GETvar' => 'tx_ingalleryflickr_pi1[controller]'
      ),
    ),
    'action' => array(
      array(
        'GETvar' => 'tx_ingalleryflickr_pi1[action]'
      ),
    ),
  )
);
?>