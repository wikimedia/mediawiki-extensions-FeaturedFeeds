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
	private HookContainer $hookContainer;

	public function __construct( HookContainer $hookContainer ) {
		$this->hookContainer = $hookContainer;
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
