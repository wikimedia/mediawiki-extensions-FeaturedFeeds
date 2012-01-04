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
	global $wgConf, $wgDBname;
	list( $site, $lang ) = $wgConf->siteFromDB( $wgDBname );
	$media = array(
		'potd' => array( // Picture Of The Day
			'page' => 'ffeed-potd-page',
			'title' => 'ffeed-potd-title',
			'description' => 'ffeed-potd-desc',
			'entryName' => 'ffeed-potd-entry',
		),
		'motd' => array( // Media Of The Day
			'page' => 'ffeed-motd-page',
			'title' => 'ffeed-motd-title',
			'description' => 'ffeed-motd-desc',
			'entryName' => 'ffeed-motd-entry',
		),
	);
	switch ( $site ) {
		case 'wikipedia':
			$feeds += array(
				'featured' => array(
					'page' => 'ffeed-fa-page',
					'title' => 'ffeed-fa-title',
					'description' => 'ffeed-fa-desc',
					'entryName' => 'ffeed-fa-entry',
				),
				'onthisday' => array(
					'page' => 'ffeed-onthisday-page',
					'title' => 'ffeed-onthisday-title',
					'description' => 'ffeed-onthisday-desc',
					'entryName' => 'ffeed-onthisday-entry',
				),
				'dyk' => array( // Did you know?
					'page' => 'ffeed-dyk-page',
					'title' => 'ffeed-dyk-title',
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
				'description' => 'ffeed-qotd-desc',
				'entryName' => 'ffeed-qotd-entry',
			);
			break;
	}
	return true;
}
