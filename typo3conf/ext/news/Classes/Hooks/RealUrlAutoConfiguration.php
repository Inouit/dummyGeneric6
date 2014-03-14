<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 WOLTER, Christoph <typo3@chrinet.de>
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


/**
 * AutoConfiguration-Hook for RealURL
 *
 * @author	WOLTER, Christoph <typo3@chrinet.de>
 * @package	TYPO3
 * @subpackage	tx_news
 */
class Tx_News_Hooks_RealUrlAutoConfiguration {

	/**
	 * Generates additional RealURL configuration and merges it with provided configuration
	 *
	 * @param       array $params Default configuration
	 * @param       tx_realurl_autoconfgen $pObj parent object
	 * @return      array Updated configuration
	 */
	function addNewsConfig($params, &$pObj) {

		/* Pr�fen ob tt_news verwendet wird und dann sicherheitshalber "tx_news" als uniqe postVar verwenden */
		$postVar = (t3lib_extMgm::isLoaded('tt_news') ? 'tx_news' : 'news');

		return array_merge_recursive($params['config'], array(
				'postVarSets' => array(
					'_DEFAULT' => array(
						$postVar => array(
							array(
								'GETvar' => 'tx_news_pi1[news]',
								'lookUpTable' => array(
									'table' => 'tx_news_domain_model_news',
									'id_field' => 'uid',
									'alias_field' => 'title',
									'useUniqueCache' => 1,
									'useUniqueCache_conf' => array(
										'strtolower' => 1,
										'spaceCharacter' => '-',
									),
								),
							),
						),
					)
				)
			)
		);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/news/Classes/Hooks/RealUrlAutoconf.php']) {
	require_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/news/Classes/Hooks/RealUrlAutoconf.php']);
}
