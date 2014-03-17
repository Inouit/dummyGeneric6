plugin.tx_news{
  persistence {
    storagePid = {$tx_news.news.storage}
  }
  settings {
    displayDummyIfNoMedia = 0
    cropMaxCharacters = 150
    defaultDetailPid = {$tx_news.news.singlePid}
    listPid = {$tx_news.news.singlePid}
    backPid = {$tx_news.news.singlePid}

    detail{
      showSocialShareButtons = 0
    }
  }
}

[globalVar = TSFE:id = {$page.homeID}]
  plugin.tx_news{
    view {
      templateRootPath = {$filepaths.extensions}/news/Resources/Private/Templates/
    }
  }
[end]



# plugin.tt_news {
#   pid_list = {$tt_news.pid_list}
#   singlePid = {$tt_news.singlePid}
#   backPid = {$tt_news.backPid}
#   useHRDates = 1
#   useHRDatesSingle = 0
#   substitutePagetitle = 1
#   useSPidFromCategory = 1
#   catExcludeList =
#   catTextMode = 1
#   maxCatTexts = 100
#   templateFile = {$filepaths.extensions}tt_news/base_lastest.html
#   general_stdWrap   >
#   limit = 10

#   allItems = TEXT
#   allItems{
#     data = LLL:EXT:skin/locallang.xml:tt_news.allItems
#   }

#   catSelect {
#     exclude = 1,3
#   }

#   pageBrowser {
#     hscText = 0
#     showFirstLast = 0
#     showResultCount = 0
#     dontLinkActivePage = 1
#   }

#   usePiBasePagebrowser = 0

#   displayLatest      {
#     date_stdWrap.strftime= %m.%d.%G
#   }

#   _LOCAL_LANG.en {
#     pi_list_browseresults_prev = &laquo;
#     pi_list_browseresults_next = &raquo;
#   }

#   displayLatest {
#     date_stdWrap.strftime= %m.%d.%G
#     subheader_stdWrap {
#       stripHtml = 1
#       wrap >
#       wrap = <p class="description">|</p>
#       append >
#       outerWrap >
#       crop >
#       parseFunc.nonTypoTagStdWrap.encapsLines.addAttributes.P = description
#     }

#     author_stdWrap >
#     author_stdWrap.wrap = |
#     preAuthor_stdWrap = |
#     author_stdWrap.required = 1
#     imageWrapIfAny = |
#     image {
#       file.maxW >
#       file.maxH >
#       file.width = 231c
#       file.height =
#       imageLinkWrap = 0
#       stdWrap >
#     }

#   }

#   displayList      {
#     date_stdWrap.strftime = %m.%d.%G
#     title_stdWrap.wrap = |
#     subheader_stdWrap {
#       stripHtml = 1
#       wrap = |
#       append >
#       crop >
#       parseFunc.nonTypoTagStdWrap.encapsLines.addAttributes.P = description
#     }
#     imageWrapIfAny = |
#     image {
#       file.maxW >
#       file.maxH >
#       file.width = 231c
#       file.height =
#       imageLinkWrap = 0
#       stdWrap >
#     }
#   }

#   displaySingle    {
#     date_stdWrap.strftime = %m.%d.%G
#     title_stdWrap.wrap = |
#     subheader_stdWrap {
#       stripHtml = 1
#       wrap = <p class="subHeader">|</p>
#       required = 1
#     }
#     specialCat_stdWrap {
#       stripHtml = 1
#       wrap = <div class="specialCat"><p>|</p></div>
#       required = 1
#     }
#     additionalContent_stdWrap{
#       parseFunc < lib.parseFunc_RTE
#       parseFunc.nonTypoTagStdWrap.encapsLines.addAttributes.P >
#       wrap = <div class="additionalContent">|</div>
#       required = 1
#     }
#     prevLink_stdWrap.wrap = |
#     nextLink_stdWrap.wrap = |
#     image {
#       file.maxW >
#       file.maxH >
#       file.width = 320m
#       file.height =
#       imageLinkWrap = 0
#       stdWrap >
#     }
#     caption_stdWrap >
#   }

#   displayXML {
#     rss2_tmplFile = EXT:tt_news/res/rss_2.tmpl
#     xmlFormat = rss2
#     xmlTitle = Flux RSS - {$config.siteName}
#     xmlLink = http://{$config.domain}/
#     xmlDesc = Latest news
#     xmlLang = fr
#     title_stdWrap.htmlSpecialChars = 1
#     title_stdWrap.htmlSpecialChars.preserveEntities = 1
#     subheader_stdWrap.stripHtml = 1
#     subheader_stdWrap.htmlSpecialChars = 1
#     subheader_stdWrap.htmlSpecialChars.preserveEntities = 1
#     subheader_stdWrap.crop = 100 | ... | 1
#     subheader_stdWrap.ifEmpty.field = bodytext
#     xmlLastBuildDate = 1
#   }

#   userPageBrowserFunc {
#     pagesBefore = 3
#     pagesAfter = 3
#   }
# }

# plugin.tt_news.mbl_newsevent {
#   showCurrentStartDate = 1
#   date_stdWrap.strftime = <span class="day">%d</span> <span class="month">%B</span>
#   templateFile = {$filepaths.extensions}tt_news/events_display_date_fr.html
# }

#[treeLevel = 0]
#plugin.tt_news.mbl_newsevent {
#  date_stdWrap.strftime = <span class="day">%d</span> <span class="month">%B</span>
#  templateFile = {$filepaths.extensions}tt_news/home/events_display_date.tmpl
#}
#[end]