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

class tx_in8reports_report_SyslogStatus implements tx_reports_StatusProvider {

	/**
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$status = $this->getErrorSyslog();
		if (!empty($status)){
			$reports[] = $status;
			unset($status);
		}

		return $reports;
	}

	protected function getErrorSyslog(){
		/* On récupère la configuration liée à l'extensions */
		$sysconf = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['in8_reports']);

		if ($sysconf['enableCheckSyslog']){

			/* On définit un message par défaut */
			$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:syslogstatus.default.header');
			$message	= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:syslogstatus.default.message');
			$status		= tx_reports_reports_status_Status::OK;

			/* On supprime de manière automatique certaines erreurs que l'on n'ai pas en mesure de corriger mais qui n'ont aucune incidence sur le bon fonctionnement du projet */

			/*Core: Error handler (FE): PHP Warning: Invalid argument supplied for foreach() in %typo3conf/ext/powermail/lib/class.tx_powermail_markers.php line %*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (FE)%typo3conf/ext/powermail/lib/class.tx_powermail_markers.php%"');

			/*Core: Error handler (BE): PHP Warning: filemtime() [<a href='function.filemtime'>function.filemtime</a>]: stat failed for %/typo3temp/extensions.xml.gz in %/typo3/sysext/em/classes/index.php line %*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (BE): PHP Warning: filemtime%" AND details LIKE "%typo3temp/extensions.xml.gz%"');

			/*Core: Error handler (BE): PHP Warning: include() [<a href='function.include'>function.include</a>]: Failed opening '%typo3conf/temp_CACHED_%' for inclusion (include_path='.:/usr/local/php5.3-cgi/lib/php') in %typo3/init.php line %*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%): PHP Warning: include%" AND details LIKE "%typo3conf/temp_CACHED_%"');

			/*Core: Error handler (FE): PHP Warning: filemtime() [<a href='function.filemtime'>function.filemtime</a>]: stat failed for %typo3conf/temp_CACHED_% in %typo3/sysext/cms/tslib/class.tslib_fe.php line %*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (FE): PHP Warning: filemtime%" AND details LIKE "%typo3conf/temp_CACHED_%"');

			/*Core: Error handler (BE): PHP Warning: XMLReader::read(): An Error Occured while reading in %typo3/sysext/em/classes/parser/class.tx_em_parser_extensionxmlpullparser.php line %*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (BE): PHP Warning: XMLReader::read%" AND details LIKE "%typo3/sysext/em/classes/parser/class.tx_em_parser_extensionxmlpullparser.php%"');

			/*Core: Error handler (%): PHP Warning: fopen(%typo3temp/tx_ncstaticfilecache/%htaccess) [<a href='function.fopen'>function.fopen</a>]: failed to open stream: No such file or directory in %typo3/src/typo3_src-%/t3lib/class.t3lib_div.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%): PHP Warning: fopen(%typo3temp/tx_ncstaticfilecache/%"');

			/*Core: Error handler (%): PHP Warning: unlink(%typo3temp/locks/*) [<a href='function.unlink'>function.unlink</a>]: No such file or directory in %src/typo3_src-4.5.17/t3lib/class.t3lib_lock.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%): PHP Warning: unlink(%typo3temp/locks/%"');

			/*Core: Error handler (%): PHP Warning: filemtime() [<a href='function.filemtime'>function.filemtime</a>]: stat failed for /%/uploads/% in %src/typo3_src-%/t3lib/class.t3lib_befunc.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%): PHP Warning: filemtime() [<a href=\'function.filemtime\'>function.filemtime</a>]: stat failed for /%/uploads/% in %src/typo3_src-%/t3lib/class.t3lib_befunc.php line%"');

			/*Core: Error handler (FE): PHP Warning: fread() [<a href='function.fread'>function.fread</a>]: Length parameter must be greater than 0 in %typo3conf/ext/in_info_meteo/pi1/class.tx_ininfometeo_pi1.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (FE): PHP Warning: fread() [<a href=\'function.fread\'>function.fread</a>]: Length parameter must be greater than 0 in %typo3conf/ext/in_info_meteo/pi1/class.tx_ininfometeo_pi1.php line%"');

			/*Core: Error handler (FE): PHP Warning: is_dir() [<a href=\'function.is-dir\'>function.is-dir</a>]: Unable to find the wrapper &quot;cgi-http&quot; - did you forget to enable it when you configured PHP? in %src/typo3_src-%/t3lib/class.t3lib_div.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (FE): PHP Warning: is_dir() [<a href=\'function.is-dir\'>function.is-dir</a>]: Unable to find the wrapper &quot;%&quot; - did you forget to enable it when you configured PHP? in %src/typo3_src-%/t3lib/class.t3lib_div.php line%"');

			/*Core: Error handler (BE): PHP Warning: json_encode() [<a href='function.json-encode'>function.json-encode</a>]: Invalid UTF-8 sequence in argument in /opt/nfs/www-data/typo3/src/typo3_src-4.5.32/typo3/classes/class.typo3ajax.php line 279*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (BE): PHP Warning: json_encode() [<a href=\'function.json-encode\'>function.json-encode</a>]: Invalid UTF-8 sequence in argument in %src/typo3_src-%/typo3/classes/class.typo3ajax.php line %"');

			/*Core: Error handler (FE): PHP Warning: parse_url(http://) [<a href='function.parse-url'>function.parse-url</a>]: Unable to parse URL in /opt/nfs/www-data/typo3/src/typo3_src-4.5.17/typo3/sysext/cms/tslib/class.tslib_content.php line 5562*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%)%typo3_src-4.5.17/%"');

			/*Core: Error handler (%): PHP Warning: Invalid argument supplied for foreach() in %src/typo3_src-4.5.23/t3lib/class.t3lib_spritemanager.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%)%typo3_src-4.5.23/%"');

			/*Core: Error handler (FE): PHP Warning: file_get_contents(%typo3temp/scriptmerger/uncompressed/javascript_%.min.js) [<a href='function.file-get-contents'>function.file-get-contents</a>]: failed to open stream: No such file or directory in %/typo3conf/ext/scriptmerger/class.tx_scriptmerger.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%): PHP Warning: file_get_contents(%typo3temp/%) [<a href=\'function.file-get-contents\'>function.file-get-contents</a>]: failed to open stream: No such file or directory in %/typo3conf/ext/scriptmerger/class.tx_scriptmerger.php line%"');

			/*Core: Error handler (%): PHP Warning: fread() [<a href='function.fread'>function.fread</a>]: Length parameter must be greater than 0 in %typo3conf/ext/in_info_meteo/pi1/class.tx_ininfometeo_pi1.php line%*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "Core: Error handler (%): PHP Warning: fread() [<a href=\'function.fread\'>function.fread</a>]: Length parameter must be greater than 0 in %typo3conf/ext/in_info_meteo/pi1/class.tx_ininfometeo_pi1.php line%"');

			/*Core: Error handler (FE): PHP Warning: is_dir() [<a href='function.is-dir'>function.is-dir</a>]: Unable to find the wrapper &quot;ttp&quot; - did you forget to enable it when you configured PHP? in /opt/nfs/www-data/typo3/src/typo3_src4.5/t3lib/class.t3lib_div.php line 1270*/
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('sys_log', 'details LIKE "%Unable to find the wrapper &quot;ttp&quot;%"');

			/* On définit et éxecute la requête SQL */
			$sC = array(
				'SELECT' => 'count(*) as count',
				'FROM' =>'sys_log',
				'WHERE' =>'details LIKE "Core: Error%"',
				'GROUP_BY' =>'',
				'ORDER_BY' =>'',
				'LIMIT' =>''
			);
			$errors = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery($sC['SELECT'], $sC['FROM'], $sC['WHERE'], $sC['GROUP_BY'], $sC['ORDER_BY'], $sC['LIMIT']));

			/* On définit et éxecute la requête SQL */
			$sCD = array(
				'SELECT' => 'count(DISTINCT details) as count',
				'FROM' =>'sys_log',
				'WHERE' =>'details LIKE "Core: Error%"',
				'GROUP_BY' =>'',
				'ORDER_BY' =>'',
				'LIMIT' =>''
			);
			$errorsD = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->exec_SELECTquery($sCD['SELECT'], $sCD['FROM'], $sCD['WHERE'], $sCD['GROUP_BY'], $sCD['ORDER_BY'], $sCD['LIMIT']));


			/* On regarde le nbr d'erreurs remontées et on définit un message d'alerte */
			if ($errors['count'] > 0){
				$header		= $GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:syslogstatus.error.header');
				$message	= "/!\ ".$errors['count'].$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:syslogstatus.error.message')." (".$errorsD['count']." Distinct)/!\ ";
				$status		= tx_reports_reports_status_Status::ERROR;
			}

			/* On définit le message final */
			$status = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				$GLOBALS['LANG']->sL('LLL:EXT:in8_reports/locallang.xml:syslogstatus.title'),
				$header,
				$message,
				$status
			);

		}

		/* On retourne l'information à l'extension Reports */
		return $status;
	}
}