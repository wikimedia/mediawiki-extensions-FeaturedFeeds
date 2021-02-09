<?php

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
		if ( $language !== false && !Language::isValidCode( $language ) ) {
			$language = false;
		}
		$feeds = FeaturedFeeds::getFeeds( $language, $this->getUser() );
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
		$availableFeeds = array_keys( FeaturedFeeds::getFeeds( false, $this->getUser() ) );
		return [
			'feedformat' => [
				ApiBase::PARAM_DFLT => 'rss',
				ApiBase::PARAM_TYPE => $feedFormatNames
			],
			'feed' => [
				ApiBase::PARAM_TYPE => $availableFeeds,
				ApiBase::PARAM_REQUIRED => true,
			],
			'language' => [
				ApiBase::PARAM_TYPE => 'string',
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
		$availableFeeds = array_keys( FeaturedFeeds::getFeeds( false, $this->getUser() ) );
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
