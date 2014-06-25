<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {

	// registering reports
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['Inouit Reports'] = array(
		'tx_in8reports_report_BlackListExtensions',
		'tx_in8reports_report_DatabaseSize',
		'tx_in8reports_report_DumpSql',
		'tx_in8reports_report_GoogleWebmasterTools',
		'tx_in8reports_report_ProjectSize',
		'tx_in8reports_report_SyslogStatus',
	);

}