<?php

class SpecialFeedItem extends UnlistedSpecialPage {
	public function __construct() {
		parent::__construct( 'FeedItem' );
	}

	public function execute( $par = '' ) {
		global $wgMemc;
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
			$out->showErrorPage( 'error', 'ffeed-feed-not-found', array( $feedName ) );
			return;
		}
		$feed = $feeds[$feedName];
		$date = FeaturedFeeds::startOfDay( wfTimestamp( TS_UNIX, $date ) );
		// First, search in the general cache
		foreach ( $feed->getFeedItems() as $item ) {
			if ( $item->getRawDate() == $date ) {
				$this->displayItem( $item );
				return;
			}
		}
		$key = wfMemcKey( 'featured', $feedName, $date, $feed->getLanguage()->getCode(),
			FeaturedFeedItem::CACHE_VERSION
		);
		$item = $wgMemc->get( $key );
		if ( !$item ) {
			$item = $feed->getFeedItem( $date );
			if ( $item ) {
				$wgMemc->set( $key, $item, 3600 * 24 );
			}
		}
		if ( $item ) {
			$this->displayItem( $item );
		} else {
			$out->showErrorPage( 'error', 'ffeed-entry-not-found',
				array( $this->getLanguage()->sprintfDate( $this->getUser()->getDatePreference(), $date ) )
			);
		}
	}

	private function displayItem( FeaturedFeedItem $item ) {
		$out = $this->getOutput();
		$out->setPageTitle( $item->getRawTitle() );
		$out->addHTML( $item->getRawText() );
	}
}
