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
			$wgMemc->set( $key, $feeds, 3600 ); //FIXME
		}
		$cache[$langCode] = $feeds;
		return $feeds;
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
			$feed = array( 'channel' => $name );

			$pageMsg = wfMessage( $opts['page'] )->inContentLanguage();
			if ( $pageMsg->isDisabled() ) {
				continue;
			}
			$page = $pageMsg->plain();

			$feed['inUserLanguage'] = $opts['inUserLanguage'];
			$lang = $opts['inUserLanguage'] ? $requestedLang : $wgContLang;
			$feed['language'] = $lang->getCode();
			$feed['name'] = wfMessage( $opts['feedName'] )->inLanguage( $lang )->text();
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
			$time = wfTimestamp( TS_UNIX, substr( wfTimestamp( TS_MW ), 0, 8 ) . '000000' );
		}
		return $time;
	}

	public static function getFeedURL( $feed, $format ) {
		global $wgContLang;

		$options = array(
			'action' => 'featuredfeed',
			'channel' => $feed['channel'],
			'feedformat' => $format,
		);
		if ( $feed['inUserLanguage'] && $feed['language'] != $wgContLang->getCode() ) {
			$options['language'] = $feed['language'];
		}
		return wfScript( 'api' ) . '?' . wfArrayToCGI( $options );
	}

	public static function beforePageDisplay( OutputPage &$out ) {
//		global $wgFeedClasses;
//		if ( $out->getTitle()->isMainPage() ) {
//			foreach ( self::getFeeds( $out->getLanguage()->getCode() ) as $name => $feed ) {
//				foreach ( array_keys( $wgFeedClasses ) as $format ) {
//					$out->addFeedLink( $format, FeaturedFeeds::getFeedURL( $feed, $format ) );
//				}
//			}
//		}
		return true;
	}
}