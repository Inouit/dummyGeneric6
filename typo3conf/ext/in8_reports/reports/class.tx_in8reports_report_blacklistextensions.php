<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2012 Ingo Renner <ingo@typo3.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class tx_in8reports_report_BlackListExtensions implements tx_reports_StatusProvider {

	/**
	 * findOne
	 *
	 * @boolean
	 */
	protected $findOne = false;

	/**
	 * listExtBlackLIst
	 *
	 * @array
	 */
	protected $listExtBlackLIst   = array(
		/* Ext Security Fail */
		't3quixplorer',
		'mm_dam_filelist',
		'realurlmanagement',

		/* Ext prohibited in Prod */
		'phpmyadmin',
		'debug_mysql_db',
		'crawler',
		'jb_gd_resize',

		/* Ext Sources of bugs */
		'jq_fancybox',
		'date2cal',
		'nh_tvdragndrop',

		/* Ext not used */
		'evo_nginx_boost',
		'danp_realurlconfigurator',
	);

	/**
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$status = $this->checkBlackListExtensions();
		if (!empty($status)){
			$reports[] = $status;
			unset($status);
		}

		return $reports;
	}

	/**
	 * Check blacklist extensions
	 *
	 * @return $status
	 */
	protected function checkBlackListExtensions(){
		/* On récupère la configuration liée à l'extensions */
		$sysconf = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['in8_reports']);

		if ($sysconf['enableBlaclistExtensions']){

			/* On récupère le chemin absolu du projet */
			$documentRoot = '';
			if ( empty($documentRoot) && t3lib_div::getIndpEnv('TYPO3_DOCUMENT_ROOT') != ''){
				$documentRoot = trim(t3lib_div::getIndpEnv('TYPO3_DOCUMENT_ROOT'));
			}
			if (empty($documentRoot) && !empty($_SERVER['DOCUMENT_ROOT'])){
				$documentRoot = trim($_SERVER['DOCUMENT_ROOT']);
			}
			if (empty($documentRoot)){
				$documentRoot = PATH_site;
			}

			/* On définit un message par défaut */
			$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.default.header');
			$message 	= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.default.message').$documentRoot." /!\ ";
			$status 	= tx_reports_reports_status_Status::ERROR;


			/* On vérifie qu'un chemin a été trouvé et qu'il s'agit bien d'un dossier existant */
			if (!empty($documentRoot) && is_dir($documentRoot)){
				/* On récupère le chemin absolu du dossier listant les extensions */
				$pathExt = $documentRoot.'/typo3conf/ext/';

				/* On récupère la configuration de l'extensions si celle-ci a été renseigné */
				if ($sysconf['listExtBlackLIst']){
					$this->listExtBlackLIst = explode(',', $sysconf['listExtBlackLIst']);
				}
				/* On définit le message où tout va bien */
				$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.ok.header');
				$message 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.ok.message');
				$status 	= tx_reports_reports_status_Status::OK;
				/* On parcours le dossier des extensions */
				if ($listExt = opendir($pathExt)) {
					while (false !== ($entry = readdir($listExt))) {
						/* On recherche la présence des extensions bannies */
						if (in_array($entry,$this->listExtBlackLIst)){
							/* On définit le message signalant l'extension identifiée */
							if (!$this->findOne){
								$message 	= '';
								$this->findOne = true;
							}
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.error.header');
							$message	.= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.error.message')."<strong>$entry</strong> /!\ <br />";
							$status 	= tx_reports_reports_status_Status::ERROR;
						}
					}
					closedir($listExt);
				}
			}

			/* On définit le message final */
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:blacklistextensions.title').' ('.count($this->listExtBlackLIst).')',
				$header,
				$message,
				$status
			);

		}

		/* On retourne l'information à l'extension Reports */
		return $status;
	}
}