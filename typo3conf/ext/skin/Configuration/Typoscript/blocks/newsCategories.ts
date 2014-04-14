lib.newsCategories = USER
lib.newsCategories {
  userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
  pluginName = Pi1
  extensionName = InNews
  controller = Category
  vendorName = Inouit
  action = list
  switchableControllerActions {
    Category {
      1 = list
    }
  }

  settings =< plugin.tx_innews.settings
  persistence =< plugin.tx_innews.persistence
  view =< plugin.tx_innews.view
  update =< plugin.tx_innews.update
}