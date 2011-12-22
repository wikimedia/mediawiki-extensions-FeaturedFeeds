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
	'ffeed-desc' => "Adds syndication feeds of wiki's featured contents",

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

	# Did You Know?
	'ffeed-dyk-page' => '', # do not localise
	'ffeed-dyk-title' => '{{SITENAME}} "Did You Know?" feed',
	'ffeed-dyk-desc' => "From {{SITENAME}}'s newest content",
	'ffeed-dyk-entry' => 'Did you know?: {{LOCALMONTHNAME}} {{LOCALDAY}}',

	// Media Of The Day
	'ffeed-motd-page' => '', # do not localise
	'ffeed-motd-title' => '{{SITENAME}} media of the day feed',
	'ffeed-motd-desc' => 'Some of the finest media on {{SITENAME}}',
	'ffeed-motd-entry' => '{{SITENAME}} media of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',

	# Picture Of The Day
	'ffeed-potd-page' => '', # do not localise
	'ffeed-potd-title' => '{{SITENAME}} picture of the day feed',
	'ffeed-potd-desc' => 'Some of the finest images on {{SITENAME}}',
	'ffeed-potd-entry' => '{{SITENAME}} picture of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',

	# Quote of the Day
	'ffeed-motd-page' => '', # do not localise
	'ffeed-motd-title' => '{{SITENAME}} quote of the day feed',
	'ffeed-motd-desc' => 'Some of the finest quotes on {{SITENAME}}',
	'ffeed-motd-entry' => '{{SITENAME}} quote of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',
);

/** Message documentation (Message documentation)
 * @author Max Semenik
 */
$messages['qqq'] = array(
	'ffeed-desc' => '{{desc}}',
	'ffeed-fa-title' => 'Title of the Featured Articles [[w:web feed|syndication feed]]',
	'ffeed-fa-desc' => 'Description of the Featured Articles [[w:web feed|syndication feed]]',
	'ffeed-fa-entry' => "Title of day's entry in the Featured Articles [[w:web feed|syndication feed]]",
	'ffeed-onthisday-title' => 'Title of the "On this day..." [[w:web feed|syndication feed]]',
	'ffeed-onthisday-desc' => 'Description of the "On this day..." [[w:web feed|syndication feed]]',
	'ffeed-onthisday-entry' => 'Title of day\'s entry in the "On this day..." [[w:web feed|syndication feeds]',
	'ffeed-dyk-title' => 'Title of the "Did you know?" [[w:web feed|syndication feed]]',
	'ffeed-dyk-desc' => 'Description of the "Did you know?" [[w:web feed|syndication feed]]',
	'ffeed-dyk-entry' => 'Title of day\'s entry in the "Did you know?" [[w:web feed|syndication feeds]',
	'ffeed-motd-title' => 'Title of the Media of the Day [[w:web feed|syndication feed]]',
	'ffeed-motd-desc' => 'Description of the Media of the Day [[w:web feed|syndication feed]]',
	'ffeed-motd-entry' => "Title of day's entry in the Media of the Day [[w:web feed|syndication feed]]",
	'ffeed-potd-title' => 'Title of the Picture Of The Day [[w:web feed|syndication feed]]',
	'ffeed-potd-desc' => 'Description of the Picture Of The Day [[w:web feed|syndication feed]]',
	'ffeed-potd-entry' => "Title of day's entry in the Media of the Day [[w:web feed|syndication feed]]",
);

/** Lower Sorbian (Dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'ffeed-desc' => 'Dodawa syndikaciske kanale wuběrnego wikiwopśimjeśa.',
	'ffeed-fa-title' => '{{SITENAME}} - kanal wuběrnych nastawkow',
	'ffeed-fa-desc' => 'Nejlěpše nastawki, kótarež {{SITENAME}} póbitujo',
	'ffeed-fa-entry' => '{{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}  {{SITENAME}} - wuběrny nastawk',
	'ffeed-onthisday-title' => '{{SITENAME}} - kanal "Toś ten źeń..."',
	'ffeed-onthisday-desc' => 'Historiske tšojenja na toś ten źeń',
	'ffeed-onthisday-entry' => 'Toś ten źeń: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-dyk-title' => '{{SITENAME}} - kanal "Sćo wěželi, až...?"',
	'ffeed-dyk-desc' => 'Nejnowše wopśimjeśe z {{GRAMMAR:genitiw|{{SITENAME}}}}',
	'ffeed-dyk-entry' => 'Sćo wěźeli, až...?: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-motd-title' => '{{SITENAME}} - kanal citata dnja',
	'ffeed-motd-desc' => 'Někotare z nejlěpšych citatow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ffeed-desc' => 'Přidawa syndikaciske kanale wuběrneho wikijoweho wobsaha.',
	'ffeed-fa-title' => '{{SITENAME}} - kanal wuběrnych nastawkow',
	'ffeed-fa-desc' => 'Najlěpše nastawki, kotrež {{SITENAME}} poskića',
	'ffeed-fa-entry' => '{{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}  {{SITENAME}} wuběrny nastawk',
	'ffeed-onthisday-title' => '{{SITENAME}} - kanal "Tutón dźeń..."',
	'ffeed-onthisday-desc' => 'Historiske podawki na tutón dźeń',
	'ffeed-onthisday-entry' => 'Tutón dźeń: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-dyk-title' => '{{SITENAME}} - kanal "Wěš ty, zo...?"',
	'ffeed-dyk-desc' => 'Najnowši wobsah z {{GRAMMAR:genitiw|{{SITENAME}}}}',
	'ffeed-dyk-entry' => 'Wěš ty, zo...?: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-motd-title' => '{{SITENAME}} - kanal citata dnja',
	'ffeed-motd-desc' => 'Někotre z najlěpšich citatow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-motd-entry' => '{{SITENAME}} - citat dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-potd-title' => '{{SITENAME}} - kanal wobraz dnja',
	'ffeed-potd-desc' => 'Někotre z najlěpšich wobrazow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-potd-entry' => '{{SITENAME}} - wobraz dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
);

