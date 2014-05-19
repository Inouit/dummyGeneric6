lib.logo = IMAGE
lib.logo {
	file    = {$filepaths.images}logo.gif
	altText = {$config.siteName}
    altText.insertData = 1
	stdWrap.typolink{
	  parameter = http://{$config.domain}/
	  extTarget  = _self
	}
  wrap = <div id="logo">|</div>
}