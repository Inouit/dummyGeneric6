<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


$configuration = Tx_News_Utility_EmConfiguration::getSettings();
$ll = 'LLL:EXT:in_events/Resources/Private/Language/locallang_db.xml:';
$llNews = 'LLL:EXT:news/Resources/Private/Language/locallang_db.xml:';


$TCA['tx_news_domain_model_news']['interface'] = array_merge($TCA['tx_news_domain_model_news']['interface'], array(
	'showRecordFieldList' => 'cruser_id,pid,sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title,teaser,bodytext,datetime,archive,tx_inevents_from, tx_inevents_to, tx_inevents_furtherInfo, author,author_email,categories,related,type,keywords,media,internalurl,externalurl,istopnews,related_files,related_links,content_elements,tags,path_segment,alternative_title'
));

$TCA['tx_news_domain_model_news']['columns'] = array_merge($TCA['tx_news_domain_model_news']['columns'], array(
	'type' => array(
		'exclude' => 0,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:cms/locallang_tca.xml:pages.doktype_formlabel',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array($llNews . 'tx_news_domain_model_news.type.I.0', 0),
				array($llNews . 'tx_news_domain_model_news.type.I.1', 1),
				array($llNews . 'tx_news_domain_model_news.type.I.2', 2),
				array($ll . 'tx_news_domain_model_news.type.I.3', 3),
			),
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_inevents_from' => array(
		'exclude' => 0,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => $ll . 'tx_inevents_domain_model_event.tx_inevents_from',
		'displayCond' => 'FIELD:type:=:3',
		'config' => array(
			'type' => 'input',
			'size' => 12,
			'max' => 20,
			'eval' => 'datetime',
			'default' => mktime(date('H'), date('i'), 0, date('m'), date('d'), date('Y'))
		)
	),
	'tx_inevents_to' => array(
		'exclude' => 0,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => $ll . 'tx_inevents_domain_model_event.tx_inevents_to',
		'displayCond' => 'FIELD:type:=:3',
		'config' => array(
			'type' => 'input',
			'size' => 12,
			'max' => 20,
			'eval' => 'datetime',
			'default' => mktime(date('H'), date('i'), 0, date('m'), date('d'), date('Y'))
		)
	),
	'tx_inevents_furtherInfo' => array(
		'exclude' => 0,
		'l10n_mode' => 'noCopy',
		'label' => $ll . 'tx_inevents_domain_model_event.tx_inevents_furtherInfo',
		'displayCond' => 'FIELD:type:=:3',
		'config' => array(
			'type' => 'text',
			'cols' => 30,
			'rows' => 5,
			'softref' => 'rtehtmlarea_images,typolink_tag,images,email[subst],url',
			'wizards' => array(
				'_PADDING' => 2,
				'RTE' => array(
					'notNewRecords' => 1,
					'RTEonly' => 1,
					'type' => 'script',
					'title' => 'Full screen Rich Text Editing',
					'icon' => 'wizard_rte2.gif',
					'script' => 'wizard_rte.php',
				),
			),
		)
	),
));

$TCA['tx_news_domain_model_news']['types'] = array_merge($TCA['tx_news_domain_model_news']['types'], array(
	'3' => array(
		'showitem' => 'l10n_parent, l10n_diffsource,
				title;;paletteCore,;;;;2-2-2, teaser' . $teaserRteConfiguration . ',;;;;3-3-3,author;;paletteAuthor,datetime;;paletteArchive,--palette--;'.$ll.'tx_inevents_domain_model_event.paletteEvent;paletteEvent,tx_inevents_furtherInfo;;;richtext::rte_transform[flag=rte_disabled|mode=ts_css],
				bodytext;;;richtext::rte_transform[flag=rte_disabled|mode=ts_css],
				rte_disabled;LLL:EXT:cms/locallang_ttc.xml:rte_enabled_formlabel,
				content_elements,

			--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
				--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;paletteAccess,

			--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.options,categories,tags,
			--div--;' . $llNews . 'tx_news_domain_model_news.tabs.relations,media,related_files,related_links,related,related_from,
			--div--;LLL:EXT:cms/locallang_tca.xlf:pages.tabs.metadata,
				--palette--;LLL:EXT:cms/locallang_tca.xlf:pages.palettes.metatags;metatags,
				--palette--;' . $llNews . 'tx_news_domain_model_news.palettes.alternativeTitles;alternativeTitles,
			--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.extended,'
	),
));

$TCA['tx_news_domain_model_news']['palettes'] = array_merge($TCA['tx_news_domain_model_news']['palettes'], array(
	'paletteEvent' => array(
		'showitem' => 'tx_inevents_from,tx_inevents_to',
		'canNotCollapse' => TRUE
	),
));

?>