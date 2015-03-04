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
	'url' => 'https://www.mediawiki.org/wiki/Extension:FeaturedFeeds',
	'descriptionmsg' => 'ffeed-desc',
);

$wgAutoloadClasses['ApiFeaturedFeeds'] = __DIR__ . '/ApiFeaturedFeeds.php';
$wgAutoloadClasses['FeaturedFeeds'] = __DIR__ . '/FeaturedFeeds.body.php';
$wgAutoloadClasses['FeaturedFeedChannel'] = __DIR__ . '/FeaturedFeeds.body.php';
$wgAutoloadClasses['FeaturedFeedItem'] = __DIR__ . '/FeaturedFeeds.body.php';
$wgAutoloadClasses['SpecialFeedItem'] = __DIR__ . '/SpecialFeedItem.php';

$wgMessagesDirs['FeaturedFeeds'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['FeaturedFeeds'] =  __DIR__ . '/FeaturedFeeds.i18n.php';
$wgExtensionMessagesFiles['FeaturedFeedsAliases'] =  __DIR__ . '/FeaturedFeeds.alias.php';

$wgSpecialPages['FeedItem'] = 'SpecialFeedItem';

$wgAPIModules['featuredfeed'] = 'ApiFeaturedFeeds';

$wgHooks['ArticleSaveComplete'][] = 'FeaturedFeeds::articleSaveComplete';
$wgHooks['BeforePageDisplay'][] = 'FeaturedFeeds::beforePageDisplay';
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'FeaturedFeeds::skinTemplateOutputPageBeforeExec';

/**
 * Configuration settings
 */

$wgFeaturedFeedsDefaults = array(
	'limit' => 10,
	'frequency' => 'daily',
	'inUserLanguage' => false,
);

$wgFeaturedFeeds = array();

/**
 * Whether links to feeds should appear in sidebar
 */
$wgDisplayFeedsInSidebar = true;
