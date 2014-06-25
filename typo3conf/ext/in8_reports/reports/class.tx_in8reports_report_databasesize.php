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

class tx_in8reports_report_DatabaseSize implements tx_reports_StatusProvider {

	// 150 MB
	protected $dbSizeOkThreshold   = 157286400;
	// 350 MB
	protected $dbSizeWarningThreshold   = 367001600;

	/**
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$status = $this->getDatabaseSize();
		if (!empty($status)){
			$reports[] = $status;
			unset($status);
		}

		return $reports;
	}

	/**
	 * Get database size
	 *
	 * @return $status
	 */
	protected function getDatabaseSize(){
		/* On récupère la configuration liée à l'extensions */
		$sysconf = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['in8_reports']);

		$versionBranch = $this->getTypo3Branch();

		if ($sysconf['enableDatabaseSize']){

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

			/* On récupère le chemin absolu vers le fichier de configuration du projet contenant le nom de la BDD */
			if ($versionBranch == 4){
				$localconf = $documentRoot.'/typo3conf/localconf_local.php';
				if ( ! file_exists($localconf) ){
					$localconf = $documentRoot.'/typo3conf/localconf.php';
				}
			}
			if ($versionBranch == 6){
				$localconf = $documentRoot.'/typo3conf/AdditionalConfiguration.php';
			}

			/* On définit un message par défaut */
			$message 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.default.header');
			$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.default.message');
			$status 	= tx_reports_reports_status_Status::ERROR;

			/* On vérifie que le fichier existe bien avant de faire quoi que ce soit */
			if ( file_exists($localconf) ){

				/* On récupères les limites définits au projet si les valeurs existes */
				if ($sysconf['dbSizeOkThreshold'] && $sysconf['dbSizeOkThreshold'] != $this->dbSizeOkThreshold){
					$this->dbSizeOkThreshold = $sysconf['dbSizeOkThreshold'];
				}
				if ($sysconf['dbSizeWarningThreshold'] && $sysconf['dbSizeWarningThreshold'] != $this->dbSizeWarningThreshold){
					$this->dbSizeWarningThreshold = $sysconf['dbSizeWarningThreshold'];
				}

				if ($versionBranch == 4){
					$findDb = "typo_db =";
				}
				if ($versionBranch == 6){
					$findDb = "database";
				}
				/* On récupère le nom de la BDD */
				$dbname = trim(shell_exec ('while read line; do  dbname=$(echo "$line" | grep "'.$findDb.'"); if [ ! -z "$dbname" ]; then echo $dbname | cut -d " " -f3; fi | cut -d "\'" -f2;  done < '.$localconf));

				/* On définit et éxecute la requête SQL */
				$sC = array(
					'SELECT' => 'sum(data_length+index_length) AS "size_db"',
					'FROM' =>'information_schema.tables ',
					'WHERE' =>'table_schema =  "'.$dbname.'"',
					'GROUP_BY' =>'table_schema',
					'ORDER_BY' =>'',
					'LIMIT' =>''
				);
				$size = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery($sC['SELECT'], $sC['FROM'], $sC['WHERE'], $sC['GROUP_BY'], $sC['ORDER_BY'], $sC['LIMIT']));

				/* On s'assure que l'on récupère bien la taille du projet */
				if ($size['size_db'] > 0){
					/* On définit le status de l'alerte en fonction de la taille de la BDD */
					$status = $this->statusBySize($size['size_db']);
					switch ($status) {
						case 1:
							/* On s'approche du quota définit */
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.warning.header');
							$message 	= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.warning.message').$dbname.": ".$this->byteSize($size['size_db'])." /!\ "."(W: ".$this->byteSize($this->dbSizeOkThreshold).", E: ".$this->byteSize($this->dbSizeWarningThreshold).")";
							break;
						case 2:
							/* Dépassement du quota définit */
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.error.header');
							$message 	= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.error.message').$dbname.": ".$this->byteSize($size['size_db'])." /!\ "."(W: ".$this->byteSize($this->dbSizeOkThreshold).", E: ".$this->byteSize($this->dbSizeWarningThreshold).")";
							break;

						default:
							/* Tout va bien */
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.ok.header');
							$message 	= "".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.ok.message').$dbname.": ".$this->byteSize($size['size_db']).""."(W: ".$this->byteSize($this->dbSizeOkThreshold).", E: ".$this->byteSize($this->dbSizeWarningThreshold).")";
							break;
					}
				}else{
					/* On signale une erreur rencontrer - base de données vide */
					$message 	= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.ok.message').$dbname.": ".$this->byteSize($size['size_db'])." /!\ ";
					$header 	= 'Calcul Error';
				}
			}

			/* On définit le message final */
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:databasesize.title'),
				$header,
				$message,
				$status
			);

		}

		/* On retourne l'information à l'extension Reports */
		return $status;
	}

	/**
	 * Get size human readable
	 *
	 * @return $show_filesize
	 */
	protected function byteSize($file_size) {
		$file_size = $file_size - 1;
		if ($file_size >= 1099511627776)
			$show_filesize = number_format(($file_size / 1099511627776), 2) . " TB";
		elseif ($file_size >= 1073741824)
			$show_filesize = number_format(($file_size / 1073741824), 2) . " GB";
		elseif ($file_size >= 1048576)
			$show_filesize = number_format(($file_size / 1048576), 2) . " MB";
		elseif ($file_size >= 1024)
			$show_filesize = number_format(($file_size / 1024), 2) . " KB";
		elseif ($file_size > 0)
			$show_filesize = $file_size . " b";
		elseif ($file_size == 0 || $file_size == -1)
			$show_filesize = "0 b";
		return $show_filesize;
	}

	/**
	 * Get status
	 *
	 * @return $status
	 */
	protected function statusBySize($file_size) {
		$file_size = $file_size - 1;
		if ($file_size <= $this->dbSizeOkThreshold)
			$status = tx_reports_reports_status_Status::OK;
		elseif ($file_size <= $this->dbSizeWarningThreshold)
			$status = tx_reports_reports_status_Status::WARNING;
		else
			$status = tx_reports_reports_status_Status::ERROR;
		return $status;
	}

	protected function getTypo3Branch() {
		$version = explode('.',TYPO3_version);
		return $version[0];
	}
}