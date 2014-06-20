tt_content.gridelements_pi1.20.10.setup.columns-66-33 < temp.columnsContainer
tt_content.gridelements_pi1.20.10.setup.columns-66-33 {
  prepend.10.10.10.stdWrap.noTrimWrap = | class="columns columns-66-33|"|
  columns{
    0 < .default
    0.wrap.cObject {
      10{
        wrap = <div class="column-66 column|">
      }
    }
    1 < .0
    1.wrap.cObject {
      10{ # class
        wrap = <div class="column-33 column|">
        10.if.isTrue.field = flexform_c1-columnWithPadding
      }
      20{ # style
        10.field = flexform_c1-bkgImg
        20.field = flexform_c1-bkgPos
      }
    }
  }
}