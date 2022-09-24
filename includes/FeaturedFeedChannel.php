<?php

namespace MediaWiki\Extension\FeaturedFeeds;

use Exception;
use Language;
use MediaWiki\MediaWikiServices;
use MediaWiki\Revision\SlotRecord;
use Message;
use MWTimestamp;
use Parser;
use ParserOptions;
use SpecialPage;
use TextContent;
use Title;

class FeaturedFeedChannel {
	/**
	 * Class version, increment it when changing class internals.
	 */
	public const VERSION = 2;

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
	private $entryName = false;
	private $titleForParse = false;

	public $title = false;
	public $shortTitle = false;
	public $description = false;

	/**
	 * @param string $name
	 * @param array $options
	 * @param string $languageCode
	 */
	public function __construct( $name, $options, $languageCode ) {
		if ( !self::$parser ) {
			self::$parser = MediaWikiServices::getInstance()->getParserFactory()->create();
		}

		$this->name = $name;
		$this->options = $options;
		if ( $options['inUserLanguage'] ) {
			$this->languageCode = $languageCode;
		} else {
			$contLang = MediaWikiServices::getInstance()->getContentLanguage();
			$this->languageCode = $contLang->getCode();
		}
	}

	public static function fromArray( array $array ) {
		$channel = new FeaturedFeedChannel(
			$array['name'],
			$array['options'],
			$array['lang']
		);

		if ( $array['items'] !== false ) {
			$channel->items = [];
			foreach ( $array['items'] as $item ) {
				$channel->items[] = FeaturedFeedItem::fromArray( $item );
			}
		}

		$channel->page = $array['page'];
		$channel->entryName = $array['entryName'];
		$channel->titleForParse = $array['titleForParse'];
		$channel->title = $array['title'];
		$channel->shortTitle = $array['shortTitle'];
		$channel->description = $array['description'];

		return $channel;
	}

	public function toArray(): array {
		$items = false;
		if ( $this->items !== false ) {
			$items = [];

			foreach ( $this->items as $item ) {
				$items[] = $item->toArray();
			}
		}

		return [
			'name' => $this->name,
			'options' => $this->options,
			'lang' => $this->languageCode,
			'items' => $items,
			'page' => $this->page,
			'entryName' => $this->entryName,
			'titleForParse' => $this->titleForParse,
			'title' => $this->title,
			'shortTitle' => $this->shortTitle,
			'description' => $this->description,
		];
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
		return MediaWikiServices::getInstance()->getLanguageFactory()
			->getLanguage( $this->languageCode );
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
		$parserOptions = ParserOptions::newFromAnon();
		$parserOptions->setTimestamp( $timestamp );
		$parserOptions->setUserLang( $this->getLanguage() );

		if ( $this->titleForParse === false ) {
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

		$content = $rev->getContent( SlotRecord::MAIN );
		$text = ( $content instanceof TextContent ) ? $content->getText() : null;

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
