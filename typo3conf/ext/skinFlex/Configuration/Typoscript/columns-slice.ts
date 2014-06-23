tt_content.gridelements_pi1.20.10.setup.columns-slice < temp.columnsContainer
tt_content.gridelements_pi1.20.10.setup.columns-slice {
  prepend.10.10.10.stdWrap.noTrimWrap = | class="columns columns-slice|"|
  prepend.10.10{
    20 = COA
    20{
      stdWrap.noTrimWrap = | style="|"|

      10 = TEXT
      10{
        field = flexform_c0-bkgImg
        noTrimWrap = | background-image: url(uploads/skinFlex/columns/|);|
        required = 1
      }

      20 = TEXT
      20{
        field = flexform_c0-bkgPos
        noTrimWrap = | background-position: |;|
        required = 1
      }
    }
  }
  columns{
    0 < .default
    0.wrap.cObject {
      10{
        wrap = <div class="column |">
      }
    }
  }
}