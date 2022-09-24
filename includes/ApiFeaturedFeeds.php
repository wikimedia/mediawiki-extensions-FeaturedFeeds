<?php

namespace MediaWiki\Extension\FeaturedFeeds;

use ApiBase;
use ApiFormatFeedWrapper;
use MediaWiki\MediaWikiServices;
use Title;
use Wikimedia\ParamValidator\ParamValidator;

class ApiFeaturedFeeds extends ApiBase {
	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
	}

	/**
	 * This module uses a custom feed wrapper printer.
	 *
	 * @return ApiFormatFeedWrapper
	 */
	public function getCustomPrinter() {
		return new ApiFormatFeedWrapper( $this->getMain() );
	}

	public function execute() {
		$params = $this->extractRequestParams();

		global $wgFeedClasses;

		if ( !isset( $wgFeedClasses[$params['feedformat']] ) ) {
			$this->dieWithError( 'feed-invalid' );
		}

		$language = $params['language'] ?? false;
		if ( $language !== false &&
			!MediaWikiServices::getInstance()->getLanguageNameUtils()->isValidCode( $language )
		) {
			$language = false;
		}
		$feeds = FeaturedFeeds::getFeeds( $language );
		$ourFeed = $feeds[$params['feed']];

		$feedClass = new $wgFeedClasses[$params['feedformat']] (
			$ourFeed->title,
			$ourFeed->description,
			wfExpandUrl( Title::newMainPage()->getFullURL() )
		);

		ApiFormatFeedWrapper::setResult( $this->getResult(), $feedClass, $ourFeed->getFeedItems() );

		// Cache stuff in squids
		$this->getMain()->setCacheMode( 'public' );
		$this->getMain()->setCacheMaxAge( FeaturedFeeds::getMaxAge() );
	}

	public function getAllowedParams() {
		global $wgFeedClasses;
		$feedFormatNames = array_keys( $wgFeedClasses );
		$availableFeeds = array_keys( FeaturedFeeds::getFeeds( false ) );
		return [
			'feedformat' => [
				ParamValidator::PARAM_DEFAULT => 'rss',
				ParamValidator::PARAM_TYPE => $feedFormatNames
			],
			'feed' => [
				ParamValidator::PARAM_TYPE => $availableFeeds,
				ParamValidator::PARAM_REQUIRED => true,
			],
			'language' => [
				ParamValidator::PARAM_TYPE => 'string',
			]
		];
	}

	/**
	 * @see ApiBase::getExamplesMessages()
	 * @return array
	 */
	protected function getExamplesMessages() {
		// attempt to find a valid feed name
		// if none available, just use an example value
		$availableFeeds = array_keys( FeaturedFeeds::getFeeds( false ) );
		$feed = reset( $availableFeeds );
		if ( !$feed ) {
			$feed = 'featured';
		}

		return [
			"action=featuredfeed&feed=$feed"
				=> [ 'apihelp-featuredfeed-example-1', $feed ],
		];
	}
}
