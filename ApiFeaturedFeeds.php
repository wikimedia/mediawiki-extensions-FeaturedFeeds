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
			$this->dieUsage( 'Invalid subscription feed type', 'feed-invalid' );
		}

		$feeds = FeaturedFeeds::getFeeds( false );
		$ourFeed = $feeds[$params['channel']];

		$feedClass = new $wgFeedClasses[$params['feedformat']] (
			$ourFeed['name'],
			$ourFeed['description'],
			FeaturedFeeds::getFeedURL( $ourFeed, $params['feedformat'] )
		);

		ApiFormatFeedWrapper::setResult( $this->getResult(), $feedClass, $ourFeed['entries'] );
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
			'channel' => array(
				ApiBase::PARAM_TYPE => $availableFeeds,
				ApiBase::PARAM_REQUIRED => true,
			),
		);
	}

	public function getParamDescription() {
		return array(
			'feedformat' => 'The format of the feed',
			'channel' => 'Feed channel',
		);
	}

	public function getDescription() {
		return 'Returns a user contributions feed';
	}

	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
			array( 'code' => 'feed-invalid', 'info' => 'Invalid subscription feed type' ),
		) );
	}

	public function getExamples() {
		return array(
			'api.php?action=featuredfeed&channel=featured', //@todo
		);
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}
}