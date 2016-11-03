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
			if ( is_callable( array( $this, 'dieWithError' ) ) ) {
				$this->dieWithError( 'feed-invalid' );
			} else {
				$this->dieUsage( 'Invalid subscription feed type', 'feed-invalid' );
			}
		}

		$language = isset( $params['language'] ) ? $params['language'] : false;
		if ( $language !== false && !Language::isValidCode( $language ) ) {
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
		return array (
			'feedformat' => array(
				ApiBase::PARAM_DFLT => 'rss',
				ApiBase::PARAM_TYPE => $feedFormatNames
			),
			'feed' => array(
				ApiBase::PARAM_TYPE => $availableFeeds,
				ApiBase::PARAM_REQUIRED => true,
			),
			'language' => array(
				ApiBase::PARAM_TYPE => 'string',
			)
		);
	}

	/**
	 * @see ApiBase::getExamplesMessages()
	 */
	protected function getExamplesMessages() {
		// attempt to find a valid feed name
		// if none available, just use an example value
		$availableFeeds = array_keys( FeaturedFeeds::getFeeds( false ) );
		$feed = reset( $availableFeeds );
		if ( !$feed ) {
			$feed = 'featured';
		}

		return array(
			"action=featuredfeed&feed=$feed"
				=> array( 'apihelp-featuredfeed-example-1', $feed ),
		);
	}
}
