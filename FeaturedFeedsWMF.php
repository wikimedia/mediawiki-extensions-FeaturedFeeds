<?php
/* 
 * Feed settings for WMF projects
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not a valid entry point' );
}

$wgHooks['FeaturedFeeds::getFeeds'][] = 'wfFeaturedFeedsWMF_getFeeds';

function wfFeaturedFeedsWMF_getFeeds( &$feeds ) {
	global $wgConf, $wgDBname;
	list( $site, $lang ) = $wgConf->siteFromDB( $wgDBname );
	$media = array(
		'potd' => array( // Picture Of The Day
			'page' => 'ffeed-potd-page',
			'feedName' => 'ffeed-potd-title',
			'description' => 'ffeed-potd-desc',
			'entryName' => 'ffeed-potd-entry',
		),
		'motd' => array( // Media Of The Day
			'page' => 'ffeed-motd-page',
			'feedName' => 'ffeed-motd-title',
			'description' => 'ffeed-motd-desc',
			'entryName' => 'ffeed-motd-entry',
		),
	);
	switch ( $site ) {
		case 'wikipedia':
			$feeds += array(
				'featured' => array(
					'page' => 'ffeed-fa-page',
					'feedName' => 'ffeed-fa-title',
					'description' => 'ffeed-fa-desc',
					'entryName' => 'ffeed-fa-entry',
				),
				'onthisday' => array(
					'page' => 'ffeed-onthisday-page',
					'feedName' => 'ffeed-onthisday-title',
					'description' => 'ffeed-onthisday-desc',
					'entryName' => 'ffeed-onthisday-entry',
				),
			);
			$feeds += $media;
			break;
		case 'commons':
			$feeds += $media;
			break;
	}
	return true;
}
