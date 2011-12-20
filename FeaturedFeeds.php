<?php
/*
 * Featured Feed extension by Max Semenik.
 * License: WTFPL 2.0
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not a valid entry point' );
}


$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'FeaturedFeeds',
	'author' => array( 'Max Semenik' ),
	'url' => '//mediawiki.org/wiki/Extension:FeaturedFeeds',
	'descriptionmsg' => 'ffeed-desc',
);

$dir = dirname( __FILE__ );

$wgAutoloadClasses['FeaturedFeeds'] = "$dir/FeaturedFeeds.body.php";
$wgAutoloadClasses['ApiFeaturedFeeds'] = "$dir/ApiFeaturedFeeds.php";

$wgExtensionMessagesFiles['FeaturedFeeds'] =  "$dir/FeaturedFeeds.i18n.php";

$wgAPIModules['featuredfeed'] = 'ApiFeaturedFeeds';

$wgHooks['BeforePageDisplay'][] = 'FeaturedFeeds::beforePageDisplay';

/**
 * Configuration settings
 */

$wgFeaturedFeedsDefaults = array(
	'limit' => 10,
	'inUserLanguage' => false,
);

$wgFeaturedFeeds = array();

