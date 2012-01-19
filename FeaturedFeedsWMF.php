<?php
/* 
 * Feed settings for WMF projects
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not a valid entry point' );
}

$wgHooks['FeaturedFeeds::getFeeds'][] = 'wfFeaturedFeedsWMF_getFeeds';

/**
 * @param $feeds array
 * @return bool
 */
function wfFeaturedFeedsWMF_getFeeds( &$feeds ) {
	global $wgConf;
	list( $site, $lang ) = $wgConf->siteFromDB( wfGetDB( DB_SLAVE )->getDBname() );
	$media = array(
		'potd' => array( // Picture Of The Day
			'page' => 'ffeed-potd-page',
			'title' => 'ffeed-potd-title',
			'short-title' => 'ffeed-potd-short-title',
			'description' => 'ffeed-potd-desc',
			'entryName' => 'ffeed-potd-entry',
		),
		'motd' => array( // Media Of The Day
			'page' => 'ffeed-motd-page',
			'title' => 'ffeed-motd-title',
			'short-title' => 'ffeed-motd-short-title',
			'description' => 'ffeed-motd-desc',
			'entryName' => 'ffeed-motd-entry',
		),
	);
	switch ( $site ) {
		case 'wikipedia':
			$feeds += array(
				'featured' => array(
					'page' => 'ffeed-featured-page',
					'title' => 'ffeed-featured-title',
					'short-title' => 'ffeed-featured-short-title',
					'description' => 'ffeed-featured-desc',
					'entryName' => 'ffeed-featured-entry',
				),
				'onthisday' => array(
					'page' => 'ffeed-onthisday-page',
					'title' => 'ffeed-onthisday-title',
					'short-title' => 'ffeed-onthisday-short-title',
					'description' => 'ffeed-onthisday-desc',
					'entryName' => 'ffeed-onthisday-entry',
				),
				'dyk' => array( // Did you know?
					'page' => 'ffeed-dyk-page',
					'title' => 'ffeed-dyk-title',
					'short-title' => 'ffeed-dyk-short-title',
					'description' => 'ffeed-dyk-desc',
					'entryName' => 'ffeed-dyk-entry',
				),
			);
			$feeds += $media;
			break;
		case 'commons':
			$feeds += $media;
			$feeds['potd']['inUserLanguage'] = true;
			$feeds['motd']['inUserLanguage'] = true;
			break;
		case 'wikiquote':
			$feeds['qotd'] = array( // Quote of the Day
				'page' => 'ffeed-qotd-page',
				'title' => 'ffeed-qotd-title',
				'short-title' => 'ffeed-qotd-short-title',
				'description' => 'ffeed-qotd-desc',
				'entryName' => 'ffeed-qotd-entry',
			);
			break;
	}
	return true;
}
