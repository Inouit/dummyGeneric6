temp.addthis{
	facebook	= IMAGE
	facebook	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_fb_off.png
		altText				= Facebook
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_facebook"
			extTarget	= _blank
			title	 	= Envoyer &agrave; Facebook
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	google_plus	= IMAGE
	google_plus	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_gplus_off.png
		altText				= Google+
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_google_plusone" g:plusone:annotation="none"
			extTarget	= _blank
			title	 	= Envoyer &agrave; Google+
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	google_plus_share	= IMAGE
	google_plus_share	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_gplus_off.png
		altText				= Google+ Share
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_google_plusone_share"
			extTarget	= _blank
			title	 	= Envoyer &agrave; Google+ Share
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	twitter	= IMAGE
	twitter	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_twitter_off.png
		altText				= Twitter
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_twitter"
			extTarget	= _blank
			title	 	= Envoyer &agrave; twitter
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	linkedin	= IMAGE
	linkedin	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_linkedin_off.png
		altText				= LinkedIn
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_linkedin"
			extTarget	= _blank
			title	 	= Partager sur LinkedIn
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	print	= IMAGE
	print	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_print_off.png
		altText				= Imprimer
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_print"
			extTarget	= _blank
			title	 	= Imprimer la page
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	email	= IMAGE
	email	{
		file 				= EXT:skinDummy/Resources/Public/img/addthis/ico_envoyer_off.png
		altText				= Envoyer
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_email"
			extTarget	= _blank
			title	 	= Envoyer &agrave; un ami
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	more	= IMAGE
	more	{
		file 				= EXT:in_addthis/res/gfx/more_off.gif
		altText				= Partage
		params				= class="hover"
		stdWrap.typolink	{
			ATagParams	= class="addthis_button_compact"
			extTarget	= _blank
			title	 	= Partager
			parameter	= http://www.addthis.com/bookmark.php
		}
	}

	jsSrc = TEXT
	jsSrc.value = <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-519b323a56db4ae9"></script>
}

menu.addthis = COA
menu.addthis{
	wrap = <div class="addthis_toolbox addthis_default_style addthis_32x32_style">|</div>
	1 < temp.addthis.facebook
	2 < temp.addthis.twitter
	3 < temp.addthis.google_plus_share
	4 < temp.addthis.email
	5 < temp.addthis.print
	6 < temp.addthis.jsSrc
}