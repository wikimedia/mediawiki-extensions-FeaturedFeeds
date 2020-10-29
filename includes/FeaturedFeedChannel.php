<?php

use MediaWiki\MediaWikiServices;
use MediaWiki\Revision\SlotRecord;

class FeaturedFeedChannel {
	/**
	 * Class version, incerement it when changing class internals.
	 */
	public const VERSION = 1;

	/**
	 * @var Parser
	 */
	private static $parser;
	private $languageCode;

	private $name;
	private $options;
	/**
	 * @var FeaturedFeedItem[]|false
	 */
	private $items = false;
	private $page = false;
	private $entryName;
	private $titleForParse;

	public $title = false;
	public $shortTitle;
	public $description;

	/** @var User */
	private $user;

	/**
	 * @param string $name
	 * @param array $options
	 * @param Language $lang
	 * @param User $user
	 */
	public function __construct( $name, $options, $lang, User $user ) {
		self::staticInit();
		$this->name = $name;
		$this->options = $options;
		if ( $options['inUserLanguage'] ) {
			$this->languageCode = $lang->getCode();
		} else {
			$contLang = MediaWikiServices::getInstance()->getContentLanguage();
			$this->languageCode = $contLang->getCode();
		}
		$this->user = $user;
	}

	private static function staticInit() {
		if ( !self::$parser ) {
			self::$parser = MediaWikiServices::getInstance()->getParserFactory()->create();
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
	 * @return FeaturedFeedItem[]
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
	 * @return FeaturedFeedItem|false
	 */
	public function getFeedItem( $date ) {
		$ts = new MWTimestamp( $date );
		$timestamp = $ts->getTimestamp( TS_MW );
		$parserOptions = new ParserOptions( $this->user );
		$parserOptions->setTimestamp( $timestamp );
		$parserOptions->setUserLang( $this->getLanguage() );

		if ( !isset( $this->titleForParse ) ) {
			// parsing with such title makes stuff like {{CURRENTMONTH}} localised
			$this->titleForParse = Title::newFromText( 'MediaWiki:Dummy/' . $this->languageCode );
		}

		$titleText = self::$parser->transformMsg(
			$this->page, $parserOptions, $this->titleForParse );
		$title = Title::newFromText( $titleText );
		if ( !$title ) {
			return false;
		}
		$rev = MediaWikiServices::getInstance()->getRevisionLookup()
			->getRevisionByTitle( $title );
		if ( !$rev ) {
			// Page does not exist
			return false;
		}
		$text = ContentHandler::getContentText( $rev->getContent( SlotRecord::MAIN ) );
		if ( !$text ) {
			return false;
		}
		$text = self::$parser->parse( $text, $title, $parserOptions )->getText( [
			'enableSectionEditLinks' => false,
		] );
		$url = SpecialPage::getTitleFor( 'FeedItem',
			$this->name . '/' . $timestamp . '/' . $this->languageCode
		)->getFullURL();

		return new FeaturedFeedItem(
			self::$parser->transformMsg( $this->entryName, $parserOptions, $this->titleForParse ),
			wfExpandUrl( $url ),
			$text,
			$timestamp
		);
	}

	/**
	 * Returns a URL to the feed
	 *
	 * @param string $format Feed format, 'rss' or 'atom'
	 * @return string
	 */
	public function getURL( $format ) {
		$contLang = MediaWikiServices::getInstance()->getContentLanguage();

		$options = [
			'action' => 'featuredfeed',
			'feed' => $this->name,
			'feedformat' => $format,
		];
		if ( $this->options['inUserLanguage'] && $this->languageCode != $contLang->getCode() ) {
			$options['language'] = $this->languageCode;
		}
		return wfScript( 'api' ) . '?' . wfArrayToCgi( $options );
	}
}
