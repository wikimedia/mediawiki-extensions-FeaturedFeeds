<?php

/* 
 * Feed settings for WMF projects
 */

$wgHooks['FeaturedFeeds::getFeeds'][] = 'wfFeaturedFeedsWMF_getFeeds';

function wfFeaturedFeedsWMF_getFeeds( &$feeds ) {
	global $wgConf, $wgDBname;
	list( $site, $lang ) = $wgConf->siteFromDB( $wgDBname );
	switch ( $site ) {
		case 'wikipedia':
			$feeds += array(
				'featured' => array(
					'page' => 'ffeed-wp-featured-page',
					'feedName' => 'ffeed-wp-featured-title',
					'description' => 'ffeed-wp-featured-desc',
					'entryName' => 'ffeed-wp-featured-entry',
				),
				'onthisday' => array(
					'page' => 'ffeed-wp-onthisday-page',
					'feedName' => 'ffeed-wp-onthisday-title',
					'description' => 'ffeed-wp-onthisday-desc',
					'entryName' => 'ffeed-wp-onthisday-entry',
				),
			);
			break;
		case 'commons':
			$feeds['featured'] = array(
				'page' => 'ffeed-com-featured-page',
				'feedName' => 'ffeed-com-featured-title',
				'description' => 'ffeed-com-featured-desc',
				'entryName' => 'ffeed-com-featured-entry',
				'inUserLanguage' => true,
			);
			break;
	}
	return true;
}
