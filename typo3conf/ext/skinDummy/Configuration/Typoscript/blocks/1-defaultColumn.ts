lib.defaultColumn = CONTENT
lib.defaultColumn {
	table = tt_content
	select {
		orderBy = sorting
 		where = colPos = 0
 		languageField = sys_language_uid
	}
	wrap=<!--TYPO3SEARCH_begin-->|<!--TYPO3SEARCH_end-->
}