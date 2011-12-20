<?php
/**
 * Internationalisation file for FeaturedFeeds extension.
 *
 * @file
 * @ingroup Extensions
 */

$messages = array();

/** English
 * @author Max Semenik
 */
$messages['en'] = array(
	'ffeed-desc' => 'Adds syndication feeds of wiki\'s featured content.',

	# Featured Article
	'ffeed-fa-page' => '', # do not localise
	'ffeed-fa-title' => '{{SITENAME}} featured articles feed',
	'ffeed-fa-desc' => 'Best articles {{SITENAME}} has to offer',
	'ffeed-fa-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}} {{SITENAME}} featured article',

	# On this day...
	'ffeed-onthisday-page' => '', # do not localise
	'ffeed-onthisday-title' => '{{SITENAME}} "On this day..." feed',
	'ffeed-onthisday-desc' => 'Historical events on this day',
	'ffeed-onthisday-entry' => 'On this day: {{LOCALMONTHNAME}} {{LOCALDAY}}',

	// Media Of The Day
	'ffeed-motd-page' => '', # do not localise
	'ffeed-motd-title' => '{{SITENAME}} media of the day feed',
	'ffeed-motd-desc' => 'Some of the finest media on {{SITENAME}}',
	'ffeed-motd-entry' => '{{SITENAME}} Media of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',

	# Picture Of The Day
	'ffeed-potd-page' => '', # do not localise
	'ffeed-potd-title' => '{{SITENAME}} Picture of the day feed',
	'ffeed-potd-desc' => 'Some of the finest images on {{SITENAME}}',
	'ffeed-potd-entry' => '{{SITENAME}} Picture of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',
);
