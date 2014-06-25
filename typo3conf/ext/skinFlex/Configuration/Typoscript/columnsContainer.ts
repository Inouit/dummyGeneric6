temp.gridelements.defaultGridSetup {
  columns {
    default {
      renderObj = COA
      renderObj {
        10 = LOAD_REGISTER
        20 =< tt_content
        30 = RESTORE_REGISTER
      }

      wrap.cObject = COA
      wrap.cObject {
        10 = COA
        10{
          wrap = <div class="column|">

          # padding for this column
          10 = TEXT
          10{
            value = columnWithPadding
            noTrimWrap = | ||
            if.isTrue.field = flexform_c0-columnWithPadding
          }
        }

        20 = COA
        20{
          wrap = <div class="columnContent"  style="|">
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

        30 = TEXT
        30.value = |

        40 = TEXT
        40.value = </div>

        50 = TEXT
        50.value = </div>
      }
    }
  }
}

temp.columnsContainer < temp.gridelements.defaultGridSetup
temp.columnsContainer {
  prepend = COA
  prepend {
    1 = INCLUDE_JS_FOOTER
    1{
      jquery = EXT:skinFlex/Resources/Public/js/jquery.min.js
      columnHeight = EXT:skinFlex/Resources/Public/js/columnHeight.js
    }

    10 = COA
    10 {
      5 =< lib.stdheader

      10 = COA
      10 {
        wrap = <div |>

        # Class
        10 = COA
        10{
          stdWrap.noTrimWrap = | class="columns|"|

          # top border
          10 = TEXT
          10{
            value = topBorder
            noTrimWrap = | ||
            if.isTrue.field = flexform_topBorder
          }

          # bottom border
          20 = TEXT
          20{
            value = bottomBorder
            noTrimWrap = | ||
            if.isTrue.field = flexform_bottomBorder
          }

          # left border
          30 = TEXT
          30{
            value = leftBorder
            noTrimWrap = | ||
            if.isTrue.field = flexform_leftBorder
          }

          # right border
          40 = TEXT
          40{
            value = rightBorder
            noTrimWrap = | ||
            if.isTrue.field = flexform_rightBorder
          }

          # bordered container
          50 = TEXT
          50{
            value = separationBorder
            noTrimWrap = | ||
            if.isTrue.field = flexform_separationBorder
          }

          # margin for this slice
          60 = TEXT
          60{
            value = sliceWithMargin
            noTrimWrap = | ||
            if.isTrue.field = flexform_sliceWithMargin
          }

          # additionalStyle
          70 = TEXT
          70{
            field = flexform_additionalStyle
            noTrimWrap = | ||
          }

          # extended container
          80 = TEXT
          80{
            value = extended
            noTrimWrap = | ||
            if.isTrue.field = flexform_extend
          }

          # force columns height
          90 = TEXT
          90{
            value = forceEqualHeights
            noTrimWrap = | ||
            if.isTrue.field = flexform_forceEqualHeights
          }
        }
      }
    }
  }

  append = TEXT
  append.value = </div>
}