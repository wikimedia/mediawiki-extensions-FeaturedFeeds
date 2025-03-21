<?php

namespace MediaWiki\Extension\FeaturedFeeds;

use MediaWiki\SpecialPage\UnlistedSpecialPage;
use MediaWiki\Utils\MWTimestamp;
use Wikimedia\ObjectCache\WANObjectCache;

class SpecialFeedItem extends UnlistedSpecialPage {

	/** @var WANObjectCache */
	private $wanObjectCache;

	/**
	 * @param WANObjectCache $wanObjectCache
	 */
	public function __construct(
		WANObjectCache $wanObjectCache
	) {
		parent::__construct( 'FeedItem' );
		$this->wanObjectCache = $wanObjectCache;
	}

	/** @inheritDoc */
	public function execute( $par = '' ) {
		$this->setHeaders();
		$out = $this->getOutput();
		$parts = explode( '/', $par ?? '' );
		if ( count( $parts ) != 3 ) {
			$out->showErrorPage( 'error', 'ffeed-no-feed' );
			return;
		}
		[ $feedName, $date, $langCode ] = $parts;
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

		$cache = $this->wanObjectCache;

		$item = $cache->getWithSetCallback(
			$cache->makeKey(
				'featured-feed',
				$feedName,
				$date,
				$feed->getLanguage()->getCode()
			),
			$cache::TTL_DAY,
			static function () use ( $feed, $date ) {
				$item = $feed->getFeedItem( $date );

				if ( $item ) {
					return $item->toArray();
				}

				return false;
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

	/**
	 * @param string $date
	 * @return string|false
	 */
	private function parseTimestamp( $date ) {
		if ( strlen( $date ) !== 14 ) {
			return false;
		}
		return MWTimestamp::convert( TS_UNIX, $date );
	}

	private function displayItem( FeaturedFeedItem $item ) {
		$out = $this->getOutput();
		$out->setPageTitle( $item->getRawTitle() );
		$out->addHTML( $item->getRawText() );
	}
}
