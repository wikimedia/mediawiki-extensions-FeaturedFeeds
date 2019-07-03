<?php

use MediaWiki\MediaWikiServices;

class FeaturedFeeds {
	private static $allInContLang = null;

	/**
	 * Returns the list of feeds
	 *
	 * @param string|bool $langCode Code of language to use or false if default
	 * @return array Feeds in format of 'name' => array of FeedItem
	 */
	public static function getFeeds( $langCode ) {
		global $wgLanguageCode;

		if ( !$langCode
			|| self::allInContentLanguage()
			|| !Language::isValidBuiltInCode( $langCode )
		) {
			$langCode = $wgLanguageCode;
		}
		static $cache = [];
		if ( isset( $cache[$langCode] ) ) {
			return $cache[$langCode];
		}

		$objectCache = MediaWikiServices::getInstance()->getMainWANObjectCache();
		$key = self::getCacheKey( $langCode );

		// Fetch the list of feed items from cache, considering it
		// a miss if the cache is from before the last feed related
		// message change. The "*" key is touched whenever a relevant
		// message changes. This slow explicit delete() of ~360 keys.
		$curTTL = null;
		$depKeys = [ self::getCacheKey( '*' ) ];
		$feeds = $objectCache->get( $key, $curTTL, $depKeys );
		if ( !$feeds || $curTTL <= 0 ) {
			$feeds = self::getFeedsInternal( $langCode );
			$objectCache->set( $key, $feeds, self::getMaxAge() );
		}

		$cache[$langCode] = $feeds;
		return $feeds;
	}

	/**
	 * Returns cache key for a given language
	 * @param String $langCode: Feed language code
	 * @return String
	 */
	private static function getCacheKey( $langCode ) {
		return wfMemcKey( 'featured-feeds', FeaturedFeedChannel::VERSION, $langCode );
	}

	/**
	 * Returns fully prepared feed definitions
	 * @return Array
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
		if ( is_null( self::$allInContLang ) ) {
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
			/** @var FeaturedFeedChannel $feed */
			foreach ( self::getFeeds( $out->getLanguage()->getCode() ) as $feed ) {
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
	 * SkinTemplateOutputPageBeforeExec hook handler
	 * @param Skin &$sk
	 * @param QuickTemplate &$tpl
	 * @return bool
	 */
	public static function skinTemplateOutputPageBeforeExec( &$sk, &$tpl ) {
		global $wgDisplayFeedsInSidebar, $wgAdvertisedFeedTypes;

		if ( ( $wgDisplayFeedsInSidebar
			|| !wfMessage( 'ffeed-enable-sidebar-links' )->inContentLanguage()->isDisabled()
			) && $sk->getContext()->getTitle()->isMainPage()
		) {
			$feeds = self::getFeeds( $sk->getContext()->getLanguage()->getCode() );
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
				$tpl->data['sidebar']['ffeed-sidebar-section'] = $links;
			}
		}
		return true;
	}

	/**
	 * Purges cache on message edit
	 *
	 * @param WikiPage $wikiPage
	 * @return bool
	 */
	public static function pageContentSaveComplete( WikiPage $wikiPage ) {
		$title = $wikiPage->getTitle();
		$objectCache = MediaWikiServices::getInstance()->getMainWANObjectCache();
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
						$objectCache->touchCheckKey( self::getCacheKey( '*' ) );
						return true;
					}
				}
			}
		}
		return true;
	}

	/**
	 * @param string $langCode
	 * @return array
	 * @throws Exception
	 */
	private static function getFeedsInternal( $langCode ) {
		$feedDefs = self::getFeedDefinitions();

		$feeds = [];
		$requestedLang = Language::factory( $langCode );
		foreach ( $feedDefs as $name => $opts ) {
			$feed = new FeaturedFeedChannel( $name, $opts, $requestedLang );
			if ( !$feed->isOK() ) {
				continue;
			}
			$feed->getFeedItems();
			$feeds[$name] = $feed;
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
	 * @param string $timestamp
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
				Wikimedia\suppressWarnings();
				$tz = date_default_timezone_get();
				Wikimedia\restoreWarnings();
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
		$expiry = self::todaysStart() + 24 * 3600 - $ts->getTimestamp() + 10;
		return min( $expiry, 3600 );
	}
}
