<?php

$extensionPath = t3lib_extMgm::extPath('in8_reports');
return array(
	'tx_in8reports_report_blacklistextensions' => $extensionPath . 'reports/class.tx_in8reports_report_blacklistextensions.php',
	'tx_in8reports_report_databasesize' => $extensionPath . 'reports/class.tx_in8reports_report_databasesize.php',
	'tx_in8reports_report_dumpsql' => $extensionPath . 'reports/class.tx_in8reports_report_dumpsql.php',
	'tx_in8reports_report_googlewebmastertools' => $extensionPath . 'reports/class.tx_in8reports_report_googlewebmastertools.php',
	'tx_in8reports_report_projectsize' => $extensionPath . 'reports/class.tx_in8reports_report_projectsize.php',
	'tx_in8reports_report_syslogstatus' => $extensionPath . 'reports/class.tx_in8reports_report_syslogstatus.php',
);
?>