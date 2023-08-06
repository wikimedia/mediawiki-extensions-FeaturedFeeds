<?php

// phpcs:disable MediaWiki.NamingConventions.LowerCamelFunctionsName.FunctionName

namespace MediaWiki\Extension\FeaturedFeeds\Hooks;

/**
 * This is a hook handler interface, see docs/Hooks.md in core.
 * Use the hook name "FeaturedFeeds::getFeeds" to register handlers implementing this interface.
 *
 * @stable to implement
 * @ingroup Hooks
 */
interface FeaturedFeedsGetFeedsHook {
	/**
	 * Adjust definition for featured feeds
	 *
	 * @param array &$feedDefs
	 * @return bool|void True or no return value to continue or false to abort
	 */
	public function onFeaturedFeeds__getFeeds( array &$feedDefs );
}
