<?php

// phpcs:disable MediaWiki.NamingConventions.LowerCamelFunctionsName.FunctionName

namespace MediaWiki\Extension\FeaturedFeeds\Hooks;

use MediaWiki\HookContainer\HookContainer;

/**
 * This is a hook runner class, see docs/Hooks.md in core.
 * @internal
 */
class HookRunner implements
	FeaturedFeedsGetFeedsHook
{
	public function __construct( private readonly HookContainer $hookContainer ) {
	}

	/**
	 * @inheritDoc
	 */
	public function onFeaturedFeeds__getFeeds( array &$feedDefs ) {
		return $this->hookContainer->run(
			'FeaturedFeeds::getFeeds',
			[ &$feedDefs ]
		);
	}
}
