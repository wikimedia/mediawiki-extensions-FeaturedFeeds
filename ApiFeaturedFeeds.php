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

		$language = isset( $params['language'] ) ? $params['language'] : false;
		if ( $language !== false && !Language::isValidCode( $language ) ) {
			$this->dieUsage( 'Invalid language code', 'language-invalid' );
		}
		$feeds = FeaturedFeeds::getFeeds( $language );
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
			'language' => array(
				ApiBase::PARAM_TYPE => 'string',
			)
		);
	}

	public function getParamDescription() {
		return array(
			'feedformat' => 'The format of the feed',
			'channel' => 'Feed channel',
			'language' => 'Feed language code. Ignored by some feeds.'
		);
	}

	public function getDescription() {
		return 'Returns a user contributions feed';
	}

	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
			array( 'code' => 'feed-invalid', 'info' => 'Invalid subscription feed type' ),
			array( 'code' => 'language-invalid', 'info' => 'Invalid language code' ),
		) );
	}

	public function getExamples() {
		global $wgVersion;
		// attempt to find a valid channel name
		// if none available, just use an example value
		$availableFeeds = array_keys( FeaturedFeeds::getFeeds( false ) );
		$channel = reset( $availableFeeds );
		if ( !$channel ) {
			$channel = 'featured';
		}

		if ( version_compare( $wgVersion, '1.19alpha', '>=' ) ) {
			return array(
				"api.php?action=featuredfeed&channel=$channel" => "Retrieve feed for channel `$channel'",
			);
		} else {
			return array(
				"Retrieve feed for channel `$channel'",
				"    api.php?action=featuredfeed&channel=$channel",
			);
		}
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}
}
