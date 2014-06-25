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

class tx_in8reports_report_GoogleWebmasterTools implements tx_reports_StatusProvider {

	/**
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$status = $this->checkGoogleWebmasterTools();
		if (!empty($status)){
			$reports[] = $status;
			unset($status);
		}

		return $reports;
	}

	/**
	 * check Google Webmaster Tools File
	 *
	 * @return $status
	 */
	protected function checkGoogleWebmasterTools(){
		/* On récupère la configuration liée à l'extensions */
		$sysconf = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['in8_reports']);

		if ($sysconf['enableCheckWebmasterTools']){

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
			$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.default.header').$documentRoot;
			$message	= '/!\ '.$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.default.message').$documentRoot.'/!\ ';
			$status		= tx_reports_reports_status_Status::ERROR;

			/* On vérifie qu'un chemin a été trouvé et qu'il s'agit bien d'un dossier existant */
			if (!empty($documentRoot) && is_dir($documentRoot)){

				/* On liste fichiers nommés google*.html */
				$googleFile = explode($documentRoot,trim(shell_exec ('ls '.$documentRoot.'/google*.html')));

				/* On définit le message d'erreur si aucun fichier n'est trouvé */
				$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.error.header');
				$message	= '/!\ '.$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.error.message').' /!\ ';
				$status		= tx_reports_reports_status_Status::ERROR;

				if (isset($googleFile) && is_array($googleFile) && count($googleFile) >0 ){
					/* On définit le message où tout va bien */
					$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.ok.header');
					$message	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.ok.message');
					$status		= tx_reports_reports_status_Status::OK;
				}
			}

			/* On définit le message final */
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:googlewebmastertools.title'),
				$header,
				$message,
				$status
			);

		}

		/* On retourne l'information à l'extension Reports */
		return $status;
	}
}