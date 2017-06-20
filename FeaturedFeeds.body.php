<?php

class FeaturedFeeds {
	private static $allInContLang = null;

	/**
	 * Returns the list of feeds
	 *
	 * @param $langCode string|bool Code of language to use or false if default
	 * @return array Feeds in format of 'name' => array of FeedItem
	 */
	public static function getFeeds( $langCode ) {
		global $wgLanguageCode;

		if ( !$langCode || self::allInContentLanguage() ) {
			$langCode = $wgLanguageCode;
		}
		static $cache = [];
		if ( isset( $cache[$langCode] ) ) {
			return $cache[$langCode];
		}

		$objectCache = ObjectCache::getMainWANInstance();
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
	 * @return Boolean
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
	 * @param OutputPage $out
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
	 * @param Skin $sk
	 * @param QuickTemplate $tpl
	 * @return Boolean
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
	public static function pageContentSaveComplete( $wikiPage ) {
		$title = $wikiPage->getTitle();
		$objectCache = ObjectCache::getMainWANInstance();
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
	 * @param $langCode string
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
	 * @param $timestamp
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
				wfSuppressWarnings();
				$tz = date_default_timezone_get();
				wfRestoreWarnings();
			}
			$timeZone = new DateTimeZone( $tz );
		}
		return $timeZone;
	}

	/**
	 * Returns the number of seconds a feed should stay in cache
	 *
	 * @return int: Time in seconds
	 */
	public static function getMaxAge() {
		$ts = new MWTimestamp();
		// add 10 seconds to cater for time deviation between servers
		$expiry = self::todaysStart() + 24 * 3600 - $ts->getTimestamp() + 10;
		return min( $expiry, 3600 );
	}
}

class FeaturedFeedChannel {
	/**
	 * Class version, incerement it when changing class internals.
	 */
	const VERSION = 1;

	/**
	 * @var ParserOptions
	 */
	private static $parserOptions = null;
	/**
	 * @var Parser
	 */
	private static $parser;
	private $languageCode;

	private $name;
	private $options;
	private $items = false;
	private $page = false;
	private $entryName;
	private $titleForParse;

	public $title = false;
	public $shortTitle;
	public $description;

	/**
	 * @param $name string
	 * @param $options array
	 * @param $lang Language
	 */
	public function __construct( $name, $options, $lang ) {
		global $wgContLang;

		self::staticInit();
		$this->name = $name;
		$this->options = $options;
		if ( $options['inUserLanguage'] ) {
			$this->languageCode = $lang->getCode();
		} else {
			$this->languageCode = $wgContLang->getCode();
		}
	}

	private static function staticInit() {
		if ( !self::$parserOptions ) {
			self::$parserOptions = new ParserOptions();
			self::$parserOptions->setEditSection( false );
			self::$parser = new Parser();
		}
	}

	public function __wakeup() {
		self::staticInit();
	}

	/**
	 * @param $key string
	 * @return Message
	 */
	private function msg( $key ) {
		return wfMessage( $key )->inLanguage( $this->languageCode );
	}

	/**
	 * @return bool
	 */
	public function isOK() {
		$this->init();
		return $this->page !== false;
	}

	/**
	 * Returns language used by the feed
	 * @return Language
	 */
	public function getLanguage() {
		// factory() is cached
		return Language::factory( $this->languageCode );
	}

	public function init() {
		global $wgLanguageCode;
		if ( $this->title !== false ) {
			return;
		}
		$this->title = $this->msg( $this->options['title'] )->text();
		$this->shortTitle = $this->msg( $this->options['short-title'] )->text();
		$this->description = $this->msg( $this->options['description'] )->text();
		$pageMsg = $this->msg( $this->options['page'] )->params( $this->languageCode );
		if ( $pageMsg->isDisabled() ) {
			// fall back manually, messages can be existent but empty
			if ( $this->languageCode != $wgLanguageCode ) {
				$pageMsg = wfMessage( $this->options['page'] )
					->params( $this->languageCode )
					->inContentLanguage();
			}
		}
		if ( $pageMsg->isDisabled() ) {
			return;
		}
		$this->page = $pageMsg->plain();
		$this->page = str_replace( '$LANGUAGE', $this->languageCode, $this->page );
		$this->entryName = $this->msg( $this->options['entryName'] )->plain();
	}

	/**
	 * @return array
	 */
	public function getFeedItems() {
		$this->init();
		if ( $this->items === false ) {
			$this->items = [];
			switch ( $this->options['frequency'] ) {
				case 'daily':
					$ratio = 1;
					$baseTime = FeaturedFeeds::todaysStart();
					break;
				case 'weekly':
					$ratio = 7;
					$baseTime = FeaturedFeeds::startOfThisWeek();
					break;
				default:
					throw new Exception( "'{$this->options['frequency']}' is not a valid frequency" );
			}
			for ( $i = 1 - $this->options['limit']; $i <= 0; $i++ ) {
				$timestamp = $baseTime + $i * $ratio * 24 * 3600;
				$item = $this->getFeedItem( $timestamp );
				if ( $item ) {
					$this->items[] = $item;
				}
			}
		}
		return $this->items;
	}

	/**
	 *
	 * @param int $date
	 * @return FeaturedFeedItem
	 */
	public function getFeedItem( $date ) {
		self::$parserOptions->setTimestamp( $date );
		self::$parserOptions->setUserLang( $this->getLanguage() );

		if ( !isset( $this->titleForParse ) ) {
			// parsing with such title makes stuff like {{CURRENTMONTH}} localised
			$this->titleForParse = Title::newFromText( 'MediaWiki:Dummy/' . $this->languageCode );
		}

		$titleText = self::$parser->transformMsg(
			$this->page, self::$parserOptions, $this->titleForParse );
		$title = Title::newFromText( $titleText );
		if ( !$title ) {
			return false;
		}
		$rev = Revision::newFromTitle( $title );
		if ( !$rev ) {
			return false; // page does not exist
		}
		$text = ContentHandler::getContentText( $rev->getContent() );
		if ( !$text ) {
			return false;
		}
		$text = self::$parser->parse( $text, $title, self::$parserOptions )->getText();
		$ts = new MWTimestamp( $date );
		$url = SpecialPage::getTitleFor( 'FeedItem',
			$this->name . '/' . $ts->getTimestamp( TS_MW ) . '/' . $this->languageCode
		)->getFullURL();

		return new FeaturedFeedItem(
			self::$parser->transformMsg( $this->entryName, self::$parserOptions, $this->titleForParse ),
			wfExpandUrl( $url ),
			$text,
			$date
		);
	}

	/**
	 * Returns a URL to the feed
	 *
	 * @param $format string Feed format, 'rss' or 'atom'
	 * @return String
	 */
	public function getURL( $format ) {
		global $wgContLang;

		$options = [
			'action' => 'featuredfeed',
			'feed' => $this->name,
			'feedformat' => $format,
		];
		if ( $this->options['inUserLanguage'] && $this->languageCode != $wgContLang->getCode() ) {
			$options['language'] = $this->languageCode;
		}
		return wfScript( 'api' ) . '?' . wfArrayToCgi( $options );
	}
}

class FeaturedFeedItem extends FeedItem {
	public function __construct( $title, $url, $text, $date ) {
		parent::__construct( $title, $text, $url, $date );
	}

	public function getRawDate() {
		return $this->date;
	}

	public function getRawTitle() {
		return $this->title;
	}

	public function getRawUrl() {
		return $this->url;
	}

	public function getRawText() {
		return $this->description;
	}
}
