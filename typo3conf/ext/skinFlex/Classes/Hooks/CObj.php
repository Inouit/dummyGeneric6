<?php
namespace Inouit\skinFlex\Hooks;


class CObj implements \TYPO3\CMS\Frontend\ContentObject\ContentObjectGetSingleHookInterface {

  protected $cObj;

  public function getSingleContentObject($contentObjectName, array $configuration, $TypoScriptKey, \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer &$parentObject) {
    $this->cObj =& $parentObject;
    switch($contentObjectName) {
      case 'FLEXFORM_SECTION':
        $content = $this->FLEXFORM_SECTION($configuration);
        break;
    }

    return $content;
  }


  public function FLEXFORM_SECTION(array $conf) {
    $sectionArray = $this->cObj->getData($conf['rootPath'], $this->cObj->data);
    $content = '';
    if ($this->cObj->checkIf($conf['if.'])) {
      $counter = 1;
      foreach ($sectionArray as $index => $section) {
        $GLOBALS['TSFE']->register['FFSECTION_COUNTER'] = $counter++;
        $this->cObj->sectionRootPath = $conf['rootPath'] . '/' . $index;
        $content .= $this->cObj->cObjGet($conf);
      }

      if ($conf['wrap']) {
        $content = $this->cObj->wrap($content, $conf['wrap']);
      }
      if ($conf['stdWrap.']) {
        $content = $this->cObj->stdWrap($content, $conf['stdWrap.']);
      }
    }

    return $content;
  }


}