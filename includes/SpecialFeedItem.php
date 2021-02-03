<?php

use MediaWiki\MediaWikiServices;

class SpecialFeedItem extends UnlistedSpecialPage {
	public function __construct() {
		parent::__construct( 'FeedItem' );
	}

	public function execute( $par = '' ) {
		$this->setHeaders();
		$out = $this->getOutput();
		$parts = explode( '/', $par );
		if ( count( $parts ) != 3 ) {
			$out->showErrorPage( 'error', 'ffeed-no-feed' );
			return;
		}
		list( $feedName, $date, $langCode ) = $parts;
		$feeds = FeaturedFeeds::getFeeds( $langCode );
		if ( !isset( $feeds[$feedName] ) ) {
			$out->showErrorPage( 'error', 'ffeed-feed-not-found', [ $feedName ] );
			return;
		}
		$feed = $feeds[$feedName];
		$timestamp = $this->parseTimestamp( $date );
		if ( !$timestamp ) {
			$out->showErrorPage( 'error', 'ffeed-invalid-timestamp' );
			return;
		}
		$date = FeaturedFeeds::startOfDay( $timestamp );
		// First, search in the general cache
		foreach ( $feed->getFeedItems() as $item ) {
			if ( $item->getRawDate() == $date ) {
				$this->displayItem( $item );
				return;
			}
		}

		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();

		$item = $cache->getWithSetCallback(
			$cache->makeKey(
				'featured-feed',
				$feedName,
				$date,
				$feed->getLanguage()->getCode()
			),
			$cache::TTL_DAY,
			function () use ( $feed, $date ) {
				return $feed->getFeedItem( $date )->toArray();
			},
			[ 'version' => FeaturedFeedChannel::VERSION ]
		);

		if ( $item ) {
			$this->displayItem( FeaturedFeedItem::fromArray( $item ) );
		} else {
			$out->showErrorPage( 'error', 'ffeed-entry-not-found',
				[ $this->getLanguage()->date( wfTimestamp( TS_UNIX, $date ), false, false ) ]
			);
		}
	}

	private function parseTimestamp( $date ) {
		if ( strlen( $date ) !== 14 ) {
			return false;
		}
		try {
			$ts = new MWTimestamp( $date );
		} catch ( Exception $ex ) {
			return false;
		}
		return $ts->getTimestamp();
	}

	private function displayItem( FeaturedFeedItem $item ) {
		$out = $this->getOutput();
		$out->setPageTitle( $item->getRawTitle() );
		$out->addHTML( $item->getRawText() );
	}
}
