<?php

namespace MediaWiki\Extension\FeaturedFeeds;

use DateTime;
use DateTimeZone;
use Exception;
use Hooks;
use MediaWiki\MediaWikiServices;
use MWTimestamp;
use OutputPage;
use Skin;
use Title;
use WANObjectCache;
use Wikimedia\AtEase\AtEase;
use WikiPage;

class FeaturedFeeds {
	private static $allInContLang = null;

	/**
	 * Returns the list of feeds
	 *
	 * @param string|bool $langCode Code of language to use or false if default
	 * @return FeaturedFeedChannel[] Feeds in format of ('name' => FeedItem)
	 */
	public static function getFeeds( $langCode ) {
		global $wgLanguageCode;

		if (
			!$langCode ||
			self::allInContentLanguage() ||
			!MediaWikiServices::getInstance()->getLanguageNameUtils()->isValidBuiltInCode( $langCode )
		) {
			$langCode = $wgLanguageCode;
		}

		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();

		$feeds = $cache->getWithSetCallback(
			self::getCacheKey( $cache, $langCode ),
			self::getMaxAge(),
			function () use ( $langCode ) {
				return self::getFeedsInternal( $langCode );
			},
			[
				// The "*" key is touched whenever a relevant message changes.
				// This avoids a slow explicit delete() of ~360 keys.
				'checkKeys' => [ self::getCacheKey( $cache, '*' ) ],
				// Avoid I/O from repeated access
				'pcGroup' => 'FeaturedFeeds:100',
				'pcTTL' => $cache::TTL_PROC_LONG
			]
		);

		return self::getFeedsFromCached( $feeds );
	}

	/**
	 * Returns cache key for a given language
	 * @param WANObjectCache $cache
	 * @param string $langCode Feed language code
	 * @return string
	 */
	private static function getCacheKey( WANObjectCache $cache, $langCode ) {
		return $cache->makeKey( 'featured-feeds', FeaturedFeedChannel::VERSION, $langCode );
	}

	/**
	 * Returns fully prepared feed definitions
	 * @return array[]
	 */
	private static function getFeedDefinitions() {
		global $wgFeaturedFeeds, $wgFeaturedFeedsDefaults;
		static $feedDefs = false;
		if ( $feedDefs === false ) {
			$feedDefs = $wgFeaturedFeeds;
			Hooks::run( 'FeaturedFeeds::getFeeds', [ &$feedDefs ] );

			// fill defaults
			self::$allInContLang = true;
			foreach ( $feedDefs as $name => $opts ) {
				foreach ( $wgFeaturedFeedsDefaults as $setting => $value ) {
					if ( !isset( $opts[$setting] ) ) {
						$feedDefs[$name][$setting] = $value;
					}
				}
				self::$allInContLang = self::$allInContLang && !$feedDefs[$name]['inUserLanguage'];
			}
		}
		return $feedDefs;
	}

	/**
	 * Returns whether all feeds are in content language
	 * @return bool
	 */
	public static function allInContentLanguage() {
		if ( self::$allInContLang === null ) {
			self::getFeedDefinitions();
		}
		return self::$allInContLang;
	}

	/**
	 * Adds feeds to the page header
	 *
	 * @param OutputPage &$out
	 * @return bool
	 */
	public static function beforePageDisplay( OutputPage &$out ) {
		global $wgAdvertisedFeedTypes;
		if ( $out->getTitle()->isMainPage() ) {
			$feeds = self::getFeedsQuick( $out->getLanguage()->getCode() );
			/** @var FeaturedFeedChannel $feed */
			foreach ( $feeds as $feed ) {
				foreach ( $wgAdvertisedFeedTypes as $type ) {
					$out->addLink( [
						'rel' => 'alternate',
						'type' => "application/$type+xml",
						'title' => $feed->title,
						'href' => $feed->getURL( $type ),
					] );
				}
			}
		}
		return true;
	}

	/**
	 * SidebarBeforeOutput hook handler
	 *
	 * @param Skin $skin
	 * @param array &$sidebar
	 */
	public static function onSidebarBeforeOutput( Skin $skin, &$sidebar ) {
		global $wgDisplayFeedsInSidebar, $wgAdvertisedFeedTypes;

		if ( !$skin->getTitle()->isMainPage() ) {
			return;
		}

		$msgDisabled = $skin->msg( 'ffeed-enable-sidebar-links' )->inContentLanguage()->isDisabled();

		if ( !$wgDisplayFeedsInSidebar || $msgDisabled ) {
			return;
		}

		$feeds = self::getFeedsQuick( $skin->getLanguage()->getCode() );
		$links = [];
		$format = $wgAdvertisedFeedTypes[0]; // @fixme:
		/** @var FeaturedFeedChannel $feed */
		foreach ( $feeds as $feed ) {
			$links[] = [
				'href' => $feed->getURL( $format ),
				'title' => $feed->title,
				'text' => $feed->shortTitle,
			];
		}

		if ( count( $links ) ) {
			$sidebar['ffeed-sidebar-section'] = $links;
		}
	}

	/**
	 * Purges cache on message edit
	 *
	 * @note used for both PageContentSaveComplete (before mediawiki 1.35) and PageSaveComplete
	 * (starting with 1.35); both hooks pass extra parameters, but only the wikipage is needed
	 *
	 * @param WikiPage $wikiPage
	 * @return bool
	 */
	public static function onPageSaveComplete( WikiPage $wikiPage ) {
		$title = $wikiPage->getTitle();
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();
		// Although message names are configurable and can be set not to start with 'Ffeed', we
		// make a shortcut here to avoid running these checks on every NS_MEDIAWIKI edit
		if ( $title->getNamespace() == NS_MEDIAWIKI && strpos( $title->getText(), 'Ffeed-' ) === 0 ) {
			$baseTitle = Title::makeTitle( NS_MEDIAWIKI, $title->getBaseText() );
			$messages  = [ 'page', 'title', 'short-title', 'description', 'entryName' ];
			foreach ( self::getFeedDefinitions() as $feed ) {
				foreach ( $messages as $msgType ) {
					$nt = Title::makeTitleSafe( NS_MEDIAWIKI, $feed[$msgType] );
					if ( $nt->equals( $baseTitle ) ) {
						wfDebug( "FeaturedFeeds-related page {$title->getFullText()} edited, purging cache\n" );
						$cache->touchCheckKey( self::getCacheKey( $cache, '*' ) );
						return true;
					}
				}
			}
		}
		return true;
	}

	/**
	 * Get all the feed objects without loading the items
	 *
	 * @param string $langCode
	 * @return FeaturedFeedChannel[]
	 * @throws Exception
	 */
	private static function getFeedsQuick( $langCode ) {
		$feedDefs = self::getFeedDefinitions();

		$feeds = [];
		foreach ( $feedDefs as $name => $opts ) {
			$feed = new FeaturedFeedChannel( $name, $opts, $langCode );
			if ( !$feed->isOK() ) {
				continue;
			}
			$feeds[$name] = $feed;
		}

		return $feeds;
	}

	/**
	 * @param string $langCode
	 * @return array[]
	 * @throws Exception
	 */
	private static function getFeedsInternal( $langCode ) {
		$feeds = self::getFeedsQuick( $langCode );
		$toCache = [];

		foreach ( $feeds as $name => $feed ) {
			$feed->getFeedItems();
			$toCache[$name] = $feed->toArray();
		}

		return $toCache;
	}

	/**
	 * @param array[] $cached
	 * @return FeaturedFeedChannel[]
	 */
	private static function getFeedsFromCached( array $cached ): array {
		$feeds = [];

		foreach ( $cached as $name => $array ) {
			$feeds[$name] = FeaturedFeedChannel::fromArray( $array );
		}

		return $feeds;
	}

	/**
	 * Returns the Unix timestamp of current day's first second
	 *
	 * @return int Timestamp
	 */
	public static function todaysStart() {
		static $time = false;
		if ( !$time ) {
			$time = self::startOfDay( time() );
		}
		return $time;
	}

	/**
	 * Returns the Unix timestamp of current week's first second
	 *
	 * @return int Timestamp
	 */
	public static function startOfThisWeek() {
		static $time = false;
		if ( !$time ) {
			$dt = new DateTime( 'this week', self::getTimezone() );
			$dt->setTime( 0, 0, 0 );
			$time = $dt->getTimestamp();
		}
		return $time;
	}

	/**
	 * Returns the Unix timestamp of current day's first second
	 *
	 * @param string|int $timestamp
	 * @return int Timestamp
	 */
	public static function startOfDay( $timestamp ) {
		$dt = new DateTime( "@$timestamp", self::getTimezone() );
		$dt->setTime( 0, 0, 0 );
		return $dt->getTimestamp();
	}

	/**
	 * @return DateTimeZone
	 */
	private static function getTimezone() {
		global $wgLocaltimezone;
		static $timeZone;

		if ( $timeZone === null ) {
			if ( isset( $wgLocaltimezone ) ) {
				$tz = $wgLocaltimezone;
			} else {
				AtEase::suppressWarnings();
				$tz = date_default_timezone_get();
				AtEase::restoreWarnings();
			}
			$timeZone = new DateTimeZone( $tz );
		}
		return $timeZone;
	}

	/**
	 * Returns the number of seconds a feed should stay in cache
	 *
	 * @return int Time in seconds
	 */
	public static function getMaxAge() {
		$ts = new MWTimestamp();
		// add 10 seconds to cater for time deviation between servers
		$expiry = self::todaysStart() + 24 * 3600 - (int)$ts->getTimestamp() + 10;
		return min( $expiry, 3600 );
	}
}
