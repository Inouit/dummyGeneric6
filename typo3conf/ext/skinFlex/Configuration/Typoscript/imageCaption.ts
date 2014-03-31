page.includeCSS.imageCaption = EXT:skinFlex/Resources/Public/css/imageCaption.css

tt_content.gridelements_pi1.20.10.setup.imageCaption {
  prepend = COA
  prepend {
    5 = < lib.stdheader

    10 = IMAGE
    10{
      file.import.field = flexform_file
      file.import.wrap = uploads/skinFlex/imageCaption/
    }

    20 = TEXT
    20{
      field = flexform_title
      wrap = <p class="caption">|</p>
    }

  }

  outerWrap = <div class="imageCaption">|</div>
  outerWrap.insertData = 1

}