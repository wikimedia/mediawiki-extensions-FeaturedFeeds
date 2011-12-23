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

/** Breton (Brezhoneg)
 * @author Y-M D
 */
$messages['br'] = array(
	'ffeed-fa-desc' => 'Ar pennadoù wellañ a gaver war {{SITENAME}}',
	'ffeed-onthisday-title' => '{{SITENAME}} Steudad "An devezh-se..."',
	'ffeed-onthisday-desc' => 'Darvoudoù istorel evit an devezh-mañ',
	'ffeed-onthisday-entry' => 'An deiz-se : {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => '{{SITENAME}} Neudennad "Ha gouzout a rit ?"',
	'ffeed-dyk-desc' => 'Deus danvez nevesañ {{SITENAME}}',
	'ffeed-dyk-entry' => 'Ha gouzout a rit ? :  {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => '{{SITENAME}} steudad arroudenn an devezh',
	'ffeed-motd-desc' => 'Un nebeut deus arroudennoù wellañ {{SITENAME}}',
	'ffeed-motd-entry' => 'Arroudenn an devezh deus {{SITENAME}} evit {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => '{{SITENAME}} steudad skeudenn an devezh',
	'ffeed-potd-desc' => 'Un nebeut re deus skeudennoù wellañ {{SITENAME}}',
	'ffeed-potd-entry' => 'Skeudenn an devezh deus {{SITENAME}} evit {{LOCALDAY}} {{LOCALMONTHNAME}}',
);

/** German (Deutsch)
 * @author Kghbln
 */
$messages['de'] = array(
	'ffeed-desc' => 'Ermöglicht gesonderte Feeds zu bestimmten Inhalten des Wikis',
	'ffeed-fa-title' => 'Feeds zu präsentierten Inhalten auf {{SITENAME}}',
	'ffeed-fa-desc' => 'Die besten Artikel auf {{SITENAME}}',
	'ffeed-fa-entry' => 'Am {{LOCALDAY}} {{LOCALMONTHNAME}} auf {{SITENAME}} präsentierter Artikel',
	'ffeed-onthisday-title' => 'Feed zu „An diesem Tag …“ auf {{SITENAME}}',
	'ffeed-onthisday-desc' => 'Historische Ereignisse dieses Tages',
	'ffeed-onthisday-entry' => 'An diesem Tag: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Feed zu „Schon gewusst?“ auf {{SITENAME}}',
	'ffeed-dyk-desc' => 'Die neuesten Inhalte auf {{SITENAME}}',
	'ffeed-dyk-entry' => '„Schon gewusst?“: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Feed zum Zitat des Tages auf {{SITENAME}}',
	'ffeed-motd-desc' => 'Einige der besten Zitate auf {{SITENAME}}',
	'ffeed-motd-entry' => 'Zitat des Tages am {{LOCALDAY}} {{LOCALMONTHNAME}} auf {{SITENAME}}',
	'ffeed-potd-title' => 'Feed zum Bild des Tages auf {{SITENAME}}',
	'ffeed-potd-desc' => 'Einige der besten Bilder auf {{SITENAME}}',
	'ffeed-potd-entry' => 'Bild des Tages am {{LOCALDAY}} {{LOCALMONTHNAME}} auf {{SITENAME}}',
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
	'ffeed-motd-entry' => '{{SITENAME}} - citat dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-potd-title' => '{{SITENAME}} - kanal wobraz dnja',
	'ffeed-potd-desc' => 'Někotare z nejlěpšych wobrazow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-potd-entry' => '{{SITENAME}} - wobraz dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
);

/** French (Français)
 * @author Gomoko
 */
$messages['fr'] = array(
	'ffeed-desc' => 'Ajoute des files de publication du contenu caractéristique du wiki',
	'ffeed-fa-title' => 'File des articles caractéristiques de {{SITENAME}}',
	'ffeed-fa-desc' => 'Meilleurs articles que {{SITENAME}} peut offrir',
	'ffeed-fa-entry' => 'Article vedette de {{SITENAME}} le {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => '{{SITENAME}} File «Ce jour-là..."',
	'ffeed-onthisday-desc' => 'Événements historiques sur cette journée',
	'ffeed-onthisday-entry' => 'Ce jour-là: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => '{{SITENAME}} File "Le savez-vous?"',
	'ffeed-dyk-desc' => 'Du contenu le plus récent de {{SITENAME}}',
	'ffeed-dyk-entry' => 'Le saviez-vous?: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => '{{SITENAME}} File citation du jour',
	'ffeed-motd-desc' => 'Quelques-unes de meilleurs citations sur {{SITENAME}}',
	'ffeed-motd-entry' => 'Citation du jour de {{SITENAME}} pour {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => '{{SITENAME}} File image du jour',
	'ffeed-potd-desc' => 'Quelques-unes des meilleures images de {{SITENAME}}',
	'ffeed-potd-entry' => 'Image du jour de {{SITENAME}} pour {{LOCALDAY}} {{LOCALMONTHNAME}}',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ffeed-desc' => 'Přidawa syndikaciske kanale wuběrneho wikiwobsaha.',
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

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'ffeed-fa-desc' => 'Déi bescht Artikelen déi {{SITENAME}} ze bidden huet',
	'ffeed-fa-entry' => 'Den  {{LOCALDAY}} {{LOCALMONTHNAME}} op {{SITENAME}} ausgezeechenten Artikel',
	'ffeed-onthisday-desc' => 'Historesch Evenementer op dësem Dag',
	'ffeed-onthisday-entry' => 'Op dësem Dag: {{LOCALMONTHNAME}} {{LOCALDAY}}',
	'ffeed-dyk-title' => '{{SITENAME}} "Vosst Dir schonn" Feed',
	'ffeed-dyk-entry' => 'Wosst Dir schonn?:  {{LOCALMONTHNAME}} {{LOCALDAY}}',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'ffeed-desc' => 'Додава канали за избрани содржини на викито.',
	'ffeed-fa-title' => 'Канал на избрани статии на {{SITENAME}}',
	'ffeed-fa-desc' => 'Најдобрите статии на {{SITENAME}}',
	'ffeed-fa-entry' => 'Избрана статија на {{SITENAME}} за {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Канал „На денешен ден...“ на {{SITENAME}}',
	'ffeed-onthisday-desc' => 'Историски настани што се случиле на денешен ден',
	'ffeed-onthisday-entry' => 'На денешен ден: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Канал „Дали сте знаеле?“ на {{SITENAME}}',
	'ffeed-dyk-desc' => 'Од најновите содржини на {{SITENAME}}',
	'ffeed-dyk-entry' => 'Дали сте знаеле?: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Канал за мисла на денот на {{SITENAME}}',
	'ffeed-motd-desc' => 'Наијнтересните мисли на {{SITENAME}}',
	'ffeed-motd-entry' => 'Мисла на денот за {{LOCALMONTHNAME}} {{LOCALDAY}} на {{SITENAME}}',
	'ffeed-potd-title' => 'Канал за слика на денот на {{SITENAME}}',
	'ffeed-potd-desc' => 'Најдобрите слики на {{SITENAME}}',
	'ffeed-potd-entry' => 'Слика на денот за {{LOCALMONTHNAME}} {{LOCALDAY}} на {{SITENAME}}',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'ffeed-desc' => 'Voegt feeds toe voor de uitgelichte inhoud van een wiki',
	'ffeed-fa-title' => 'Feed voor uitgelichte artikelen van {{SITENAME}}',
	'ffeed-fa-desc' => 'De beste artikelen van {{SITENAME}}',
	'ffeed-fa-entry' => 'Uitgelicht artikel van {{SITENAME}} op {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Feed voor "Op deze dag..." van {{SITENAME}}',
	'ffeed-onthisday-desc' => 'Historische gebeurtenissen op deze dag',
	'ffeed-onthisday-entry' => 'Op deze dag: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Feed voor "Wist u dat" van {{SITENAME}}',
	'ffeed-dyk-desc' => 'De nieuwste inhoud van {{SITENAME}}',
	'ffeed-dyk-entry' => 'Wist u dat?: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Feed voor uitspraak van de dag van {{SITENAME}}',
	'ffeed-motd-desc' => 'De beste uitspraken van {{SITENAME}}',
	'ffeed-motd-entry' => 'Uitspraak van de dag voor van {{LOCALDAY}} {{LOCALMONTHNAME}} van {{SITENAME}}',
	'ffeed-potd-title' => 'Feed voor afbeelding van de dag van {{SITENAME}}',
	'ffeed-potd-desc' => 'De beste afbeeldingen van {{SITENAME}}',
	'ffeed-potd-entry' => 'Afbeelding van de dag voor van {{LOCALDAY}} {{LOCALMONTHNAME}} van {{SITENAME}}',
);

