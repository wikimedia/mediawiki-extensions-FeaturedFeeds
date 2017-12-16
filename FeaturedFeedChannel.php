<?php

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
	 * @param string $name
	 * @param array $options
	 * @param Language $lang
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
			if ( !defined( 'ParserOutput::SUPPORTS_STATELESS_TRANSFORMS' ) ) {
				self::$parserOptions->setEditSection( false );
			}
			self::$parser = new Parser();
		}
	}

	public function __wakeup() {
		self::staticInit();
	}

	/**
	 * @param string $key
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
		$text = self::$parser->parse( $text, $title, self::$parserOptions )->getText( [
			'enableSectionEditLinks' => false,
		] );
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
	 * @param string $format Feed format, 'rss' or 'atom'
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
