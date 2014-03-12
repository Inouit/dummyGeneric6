<?php

/**
 * Tools for dummy skin
 *
 * @author	Grégory Copin <gcopin@inouit.com>
 * @package	TYPO3
 * @subpackage tx_skinDummy
 */
 class Tx_SkinDummy_Utility_Typoscript {

	/**
	* Auto generate the ext_typoscript_setup file
	*
	* @param	array	$folders: folders to check
	*
	*****************************************************************************/
  	public static function autoGenerateSetup($key, $folders){
  		$ext_path = t3lib_extMgm::extPath($key);
  		$setup = '';
  		$eol = '
';

  		if($folders && count($folders)) {
  			foreach ($folders as $folder) {
  				if (is_dir($ext_path.$folder) && $handle = opendir($ext_path.$folder)) {
				    $setup .= '### Include directory '.$folder.$eol;
				    $files = array();

					while ($files[] = readdir($handle));
					sort($files);
					closedir($handle);

				    foreach ($files as $file) {
				        if($file!='.' && $file!='..' && $extension = strrchr($file,'.') && (strrchr($file,'.') == '.ts' ) || strrchr($file,'.') == '.txt' ) {

				        	$setup .= '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$key.'/'.$folder.'/'.$file.'">'.$eol;
				        }
				    }
				}
  			}

  			if($setup != '') {
  				t3lib_div::writeFile($ext_path.'ext_typoscript_setup.txt',$setup);
  			}
  		}
  	}
 }

 ?>
