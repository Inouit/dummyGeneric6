page.10.default = FLUIDTEMPLATE
page.10.default{
  partialRootPath = {$filepaths.partials}
  layoutRootPath = {$filepaths.layouts}

  variables {
    searchFormAction = TEXT
    searchFormAction{
      typolink.parameter = {$page.searchResultID}
      typolink.returnLast = url
    }
  }
}