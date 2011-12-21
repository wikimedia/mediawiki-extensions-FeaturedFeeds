<?php

class FeaturedFeeds {

	/**
	 * Returns the list of feeds
	 * 
	 * @param $langCode string||bool Code of language to use or false if default
	 * @return array Feeds in format of 'name' => array of FeedItem
	 */
	public static function getFeeds( $langCode ) {
		global $wgMemc, $wgContLang;
		
		if ( !$langCode ) {
			$langCode = $wgContLang->getCode();
		}
		static $cache = array();
		if ( isset( $cache[$langCode] ) ) {
			return $cache[$langCode];
		}

		$key = wfMemcKey( 'featured-feeds', $langCode );
		$feeds = $wgMemc->get( $key );
		
		if ( !$feeds ) {
			$feeds = self::getFeedsInternal( $langCode );
			// add 10 seconds to cater for time deviation between servers
			$expiry = self::todaysStart() + 24 * 3600 - wfTimestamp() + 10;
			$wgMemc->set( $key, $feeds, min( $expiry, 3600 ) );
		}
		$cache[$langCode] = $feeds;
		return $feeds;
	}

	/**
	 * Adds feeds to the page header
	 * 
	 * @param OutputPage $out
	 * @return bool
	 */
	public static function beforePageDisplay( OutputPage &$out ) {
		global $wgAdvertisedFeedTypes;
		if ( $out->getTitle()->isMainPage() ) {
			foreach ( self::getFeeds( $out->getLanguage()->getCode() ) as $feed ) {
				foreach ( $wgAdvertisedFeedTypes as $type ) {
					$out->addLink( array(
						'rel' => 'alternate',
						'type' => "application/$type+xml",
						'title' => $feed['title'],
						'href' => self::getFeedURL( $feed, $type ),
					) );
				}
			}
		}
		return true;
	}

	private static function getFeedsInternal( $langCode ) {
		global $wgFeaturedFeeds, $wgFeaturedFeedsDefaults, $wgContLang;
		
		$feedDefs = $wgFeaturedFeeds;
		wfRunHooks( 'FeaturedFeeds::getFeeds', array( &$feedDefs ) );

		// fill defaults
		foreach ( $feedDefs as $name => $opts ) {
			foreach ( $wgFeaturedFeedsDefaults as $setting => $value ) {
				if ( !isset( $opts[$setting] ) ) {
					$feedDefs[$name][$setting] = $value;
				}
			}
		}
		
		$feeds = array();
		$parserOptions = new ParserOptions();
		$title = Title::newMainPage();
		$requestedLang = Language::factory( $langCode );
		$parser = new Parser();
		foreach ( $feedDefs as $name => $opts ) {
			$feed = array( 'name' => $name );

			$pageMsg = wfMessage( $opts['page'] )->inContentLanguage();
			if ( $pageMsg->isDisabled() ) {
				continue;
			}
			$page = $pageMsg->plain();

			$feed['inUserLanguage'] = $opts['inUserLanguage'];
			$lang = $opts['inUserLanguage'] ? $requestedLang : $wgContLang;
			$feed['language'] = $lang->getCode();
			$feed['title'] = wfMessage( $opts['title'] )->inLanguage( $lang )->text();
			$feed['description'] = wfMessage( $opts['description'] )->inLanguage( $lang )->text();
			$entryName = wfMessage( $opts['entryName'] )->inLanguage( $lang )->plain();
			$feed['entries'] = array();

			$parserOptions->setUserLang( $lang );
			for ( $i = 1 - $opts['limit']; $i <= 0; $i++ ) {
				$time = self::todaysStart() + $i * 24 * 3600;
				$parserOptions->setTimestamp( $time );

				$titleText = $parser->transformMsg( $page, $parserOptions );
				$title = Title::newFromText( $titleText );
				if ( !$title ) {
					throw new MWException( "Invalid page name $titleText" );
				}
				$rev = Revision::newFromTitle( $title );
				if ( !$rev ) {
					continue; // page does not exist
				}
				$text = $rev->getText();
				if ( !$text ) {
					continue;
				}
				$text = $parser->parse( $text, $title, $parserOptions )->getText();
				$feed['entries'][] = new FeedItem(
					$parser->transformMsg( $entryName, $parserOptions ),
					$text,
					wfExpandUrl( $title->getFullURL() ),
					$time
				);
			}

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
			global $wgLocaltimezone;
			if ( isset( $wgLocaltimezone ) ) {
				$tz = new DateTimeZone( $wgLocaltimezone );
			} else {
				$tz = new DateTimeZone( date_default_timezone_get() );
			}
			$dt = new DateTime( 'now', $tz );
			$dt->setTime( 0, 0, 0 );
			$time = $dt->getTimestamp();
		}
		return $time;
	}

	/**
	 * Returns a URL to the feed
	 * 
	 * @param Array $feed: Feed description returned by getFeeds()
	 * @param type $format: Feed format, 'rss' or 'atom'
	 * @return String 
	 */
	public static function getFeedURL( $feed, $format ) {
		global $wgContLang;

		$options = array(
			'action' => 'featuredfeed',
			'feed' => $feed['name'],
			'feedformat' => $format,
		);
		if ( $feed['inUserLanguage'] && $feed['language'] != $wgContLang->getCode() ) {
			$options['language'] = $feed['language'];
		}
		return wfScript( 'api' ) . '?' . wfArrayToCGI( $options );
	}
}