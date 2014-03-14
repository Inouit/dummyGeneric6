page {
  # Inlude JavaScript files
  includeJSFooterlibs {
    powermailJQuery = {$filepaths.js}components/jquery.powermailHook.js
    powermailJQuery.external = 0

    powermailJQueryUi.external = 0
    powermailJQueryUi = {$filepaths.js}components/jquery-ui.min.js
  }

  includeJS {
    jquery = {$filepaths.js}components/jquery/jquery.min.js
  }
}