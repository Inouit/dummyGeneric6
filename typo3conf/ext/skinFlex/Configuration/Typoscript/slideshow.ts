page.includeCSS.slideshow = EXT:skinFlex/Resources/Public/css/slideshow.css

tt_content.gridelements_pi1.20.10.setup.slideshow {
  prepend = COA
  prepend {
    5 = < lib.stdheader

    10 = FLEXFORM_SECTION
    10 {
      rootPath = section:images/el

      10 = IMAGE
      10{
        file.import.data = section_item:image/el/file
        file.import.wrap = uploads/skinFlex/slideshow/
        stdWrap.typolink.parameter.data = section_item:image/el/link
      }

      20 = TEXT
      20{
        data = section_item:image/el/caption
        required = 1
        wrap = <p class="caption">|</p>
        stdWrap.typolink.parameter.data = section_item:image/el/link
      }
    }
  }

  outerWrap = <div class="slideshow">|</div>
  outerWrap.insertData = 1

}