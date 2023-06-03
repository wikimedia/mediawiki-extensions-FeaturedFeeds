<?php

namespace MediaWiki\Extension\FeaturedFeeds\Tests\Unit;

use MediaWiki\Extension\FeaturedFeeds\Hooks\HookRunner;
use MediaWiki\Tests\HookContainer\HookRunnerTestBase;

/**
 * @covers \MediaWiki\Extension\FeaturedFeeds\Hooks\HookRunner
 */
class HookRunnerTest extends HookRunnerTestBase {

	public static function provideHookRunners() {
		yield HookRunner::class => [ HookRunner::class ];
	}
}
