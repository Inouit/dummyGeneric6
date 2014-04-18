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

class tx_in8reports_report_DumpSql implements tx_reports_StatusProvider {

	/**
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$status = $this->checkDumpSQL();
		if (!empty($status)){
			$reports[] = $status;
			unset($status);
		}

		return $reports;
	}

	/**
	 * check dump SQL
	 *
	 * @return $status
	 */
	protected function checkDumpSQL(){
		/* On récupère la configuration liée à l'extensions */
		$sysconf = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['in8_reports']);

		if ($sysconf['enableCheckDumpSql']){

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
			$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:dumpsql.default.header');
			$message 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:dumpsql.default.message');
			$status 	= tx_reports_reports_status_Status::OK;

			/* On liste les éventuels dumps SQL */
			if($strExplode = trim(shell_exec ('ls '.$documentRoot.'/*sql'))){
				$dumpFile = explode($documentRoot, $strExplode);
			}

			/* On vérifie que le listing n'est pas vide et qu'une des entrées n'est pas vide */
			if ($dumpFile && is_array($dumpFile) && count($dumpFile) > 0){
				foreach ($dumpFile as $key => $file) {
					if (empty($file)){
						unset($dumpFile[$key]);
					}
				}
			}

			/* On ne tient pas compte du dump SQL destiné à la plateforme de développement */
			if ( strpos($documentRoot,'/dev/') !== false || strpos($documentRoot,'/preprod/') !== false ){
				if ($dumpFile && is_array($dumpFile) && count($dumpFile) > 0){
					foreach ($dumpFile as $key => $file) {
						if (strpos($file,"db_dev_typo3_") !== false){
							unset($dumpFile[$key]);
						}
					}
				}
			}

			/* On ne tient pas compte du fichier sqltrucate_cache s'il sagit du projet dummyGeneric qui est nécessaire au projet */
			if (strpos($documentRoot,'dummyGeneric') !== false ){
				if ($dumpFile && is_array($dumpFile) && count($dumpFile) > 0){
					foreach ($dumpFile as $key => $file) {
						if (strpos($file,"sqltrucate_cache.sql") !== false){
							unset($dumpFile[$key]);
						}
					}
				}
			}

			/* On vérifie la présence de dump SQL et on définit un message d'erreur */
			if (isset($dumpFile) && is_array($dumpFile) && count($dumpFile) >0 ){
				$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:dumpsql.error.header');
				$message 	= ' /!\ '.$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:dumpsql.error.message').' /!\ ';
				$status 	= tx_reports_reports_status_Status::ERROR;
			}

			/* On définit le message final */
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:dumpsql.title'),
				$header,
				$message,
				$status
			);

		}

		/* On retourne l'information à l'extension Reports */
		return $status;
	}
}
