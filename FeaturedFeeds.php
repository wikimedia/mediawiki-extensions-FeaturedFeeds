<?php
if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'FeaturedFeeds' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['FeaturedFeeds'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['FeaturedFeedsAliases'] = __DIR__ . '/FeaturedFeeds.alias.php';
	/* wfWarn(
		'Deprecated PHP entry point used for FeaturedFeeds extension. ' .
		'Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	); */
	return;
} else {
	die( 'This version of the FeaturedFeeds extension requires MediaWiki 1.25+' );
}
