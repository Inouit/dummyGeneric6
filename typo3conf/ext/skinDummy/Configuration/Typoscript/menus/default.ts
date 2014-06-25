menu.default = HMENU
menu.default{
  special = directory
  special.value = {$page.homeID}
  #wrap = <ul class="nav">|</ul>
  1 = TMENU
  1{
    noBlur = 1
    stdWrap.wrap = <ul>|</ul>

    NO = 1
    NO{
        wrapItemAndSub = <li class="page-{field:uid}">|</li>
        wrapItemAndSub.insertData = 1
    }

    CUR < .NO
    CUR{
        wrapItemAndSub = <li class="page-{field:uid} active current">|</li>
    }

    ACT < .NO
    ACT{
        wrapItemAndSub = <li class="page-{field:uid} active">|</li>
    }
  }
}