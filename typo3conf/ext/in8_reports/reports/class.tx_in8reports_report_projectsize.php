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

class tx_in8reports_report_ProjectSize implements tx_reports_StatusProvider {

	// 150 MB
	protected $projectSizeOkThreshold   = 943718400;
	// 350 MB
	protected $projectSizeWarningThreshold   = 1073741824;

	/**
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$status = $this->getProjectSize();
		if (!empty($status)){
			$reports[] = $status;
			unset($status);
		}

		return $reports;
	}

	/**
	 * get Project Size
	 *
	 * @return $status
	 */
	protected function getProjectSize(){
		/* On récupère la configuration liée à l'extensions */
		$sysconf = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['in8_reports']);

		if ($sysconf['enableProjectSize']){

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
			$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.default.header').$documentRoot;
			$message	= '/!\ '.$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.default.message').$documentRoot.'/!\ ';
			$status		= tx_reports_reports_status_Status::ERROR;

			/* On vérifie qu'un chemin a été trouvé et qu'il s'agit bien d'un dossier existant */
			if (!empty($documentRoot) && is_dir($documentRoot)){

				/* On récupères les limites définits au projet si les valeurs existes */
				if ($sysconf['projectSizeOkThreshold'] && $sysconf['projectSizeOkThreshold'] != $this->projectSizeOkThreshold){
					$this->projectSizeOkThreshold = $sysconf['projectSizeOkThreshold'];
				}
				if ($sysconf['projectSizeWarningThreshold'] && $sysconf['projectSizeWarningThreshold'] != $this->projectSizeWarningThreshold){
					$this->projectSizeWarningThreshold = $sysconf['projectSizeWarningThreshold'];
				}

				/* On récupère la taille du projet */
				$projectSizename = (trim(shell_exec ('du -s --exclude="*.git/*" --exclude="*db_dev*" '.$documentRoot))*1024);
				/* On récupère la taille du projet lisible par un humain */
				$projectSizenameHuman = str_replace($documentRoot,'',trim(shell_exec ('du -sh --exclude="*.git/*" --exclude="*db_dev*" '.$documentRoot)));

				/* On définit un message d'erreur si on ne récupère pas la taille du projet */
				$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.sizeError.header');
				$message	= '/!\ '.$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.sizeError.message').$projectSizenameHuman.'/!\ ';
				$status		= tx_reports_reports_status_Status::ERROR;

				/* On définit un message en fonction de la taille du projet */
				if ($projectSizename > 0){
					/* On définit le status de l'alerte en fonction de la taille du projet */
					$status = $this->statusBySize($projectSizename);
					switch ($status) {
						case 1:
							/* On s'approche du quota définit */
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.warning.header');
							$message 	= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.warning.message').$projectSizenameHuman." /!\ "."(W: ".$this->byteSize($this->projectSizeOkThreshold).", E: ".$this->byteSize($this->projectSizeWarningThreshold).")";
							break;
						case 2:
							/* Dépassement du quota définit */
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.error.header');
							$message 	= "/!\ ".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.error.message').$projectSizenameHuman." /!\ "."(W: ".$this->byteSize($this->projectSizeOkThreshold).", E: ".$this->byteSize($this->projectSizeWarningThreshold).")";
							break;
						default:
							/* Tout va bien */
							$header 	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.ok.header');
							$message 	= "".$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.ok.message').$projectSizenameHuman.""."(W: ".$this->byteSize($this->projectSizeOkThreshold).", E: ".$this->byteSize($this->projectSizeWarningThreshold).")";
							break;
					}
				}
			}

			/* On définit le message final */
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:projectsize.title'),
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
		if ($file_size <= $this->projectSizeOkThreshold)
			$show_filesize = tx_reports_reports_status_Status::OK;
		elseif ($file_size <= $this->projectSizeWarningThreshold)
			$show_filesize = tx_reports_reports_status_Status::WARNING;
		else
			$show_filesize = tx_reports_reports_status_Status::ERROR;
		return $show_filesize;
	}
}