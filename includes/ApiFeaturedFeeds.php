<?php

namespace MediaWiki\Extension\FeaturedFeeds;

use MediaWiki\Api\ApiBase;
use MediaWiki\Api\ApiFormatFeedWrapper;
use MediaWiki\Api\ApiMain;
use MediaWiki\Languages\LanguageNameUtils;
use MediaWiki\MainConfigNames;
use MediaWiki\Title\Title;
use Wikimedia\ParamValidator\ParamValidator;

class ApiFeaturedFeeds extends ApiBase {
	private LanguageNameUtils $languageNameUtils;

	public function __construct(
		ApiMain $main,
		string $action,
		LanguageNameUtils $languageNameUtils
	) {
		parent::__construct( $main, $action );
		$this->languageNameUtils = $languageNameUtils;
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

		$feedClasses = $this->getConfig()->get( MainConfigNames::FeedClasses );

		if ( !isset( $feedClasses[$params['feedformat']] ) ) {
			$this->dieWithError( 'feed-invalid' );
		}

		$language = $params['language'] ?? false;
		if ( $language !== false &&
			!$this->languageNameUtils->isValidCode( $language )
		) {
			$language = false;
		}
		$feeds = FeaturedFeeds::getFeeds( $language );
		$ourFeed = $feeds[$params['feed']];

		$feedClass = new $feedClasses[$params['feedformat']] (
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
		$feedFormatNames = array_keys( $this->getConfig()->get( MainConfigNames::FeedClasses ) );
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
