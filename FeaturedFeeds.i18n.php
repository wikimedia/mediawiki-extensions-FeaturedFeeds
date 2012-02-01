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
	'ffeed-desc' => "Adds syndication feeds of wiki's featured content",
	'ffeed-no-feed' => 'Feed not specified',
	'ffeed-feed-not-found' => 'Feed $1 not found',
	'ffeed-entry-not-found' => 'Feed entry for $1 not found',
	'ffeed-sidebar-section' => 'Featured content feeds',
	'ffeed-invalid-timestamp' => 'Invalid feed timestamp',

	# Featured Article
	'ffeed-featured-page' => '', # do not localise
	'ffeed-featured-title' => '{{SITENAME}} featured articles feed',
	'ffeed-featured-short-title' => 'Featured articles',
	'ffeed-featured-desc' => 'Best articles {{SITENAME}} has to offer',
	'ffeed-featured-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}} {{SITENAME}} featured article',

	# Good Article
	'ffeed-good-page' => '', # do not localise
	'ffeed-good-title' => '{{SITENAME}} good articles feed',
	'ffeed-good-short-title' => 'Good articles',
	'ffeed-good-desc' => 'Good articles {{SITENAME}} has to offer',
	'ffeed-good-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}} {{SITENAME}} good article',

	# On this day...
	'ffeed-onthisday-page' => '', # do not localise
	'ffeed-onthisday-title' => '{{SITENAME}} "On this day..." feed',
	'ffeed-onthisday-short-title' => 'On this day...',
	'ffeed-onthisday-desc' => 'Historical events on this day',
	'ffeed-onthisday-entry' => 'On this day: {{LOCALMONTHNAME}} {{LOCALDAY}}',

	# Did You Know?
	'ffeed-dyk-page' => '', # do not localise
	'ffeed-dyk-title' => '{{SITENAME}} "Did You Know?" feed',
	'ffeed-dyk-short-title' => 'Did you know?',
	'ffeed-dyk-desc' => "From {{SITENAME}}'s newest content",
	'ffeed-dyk-entry' => 'Did you know?: {{LOCALMONTHNAME}} {{LOCALDAY}}',

	// Media Of The Day
	'ffeed-motd-page' => '', # do not localise
	'ffeed-motd-title' => '{{SITENAME}} media of the day feed',
	'ffeed-motd-short-title' => 'Media of the day',
	'ffeed-motd-desc' => 'Some of the finest media on {{SITENAME}}',
	'ffeed-motd-entry' => '{{SITENAME}} media of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',

	# Picture Of The Day
	'ffeed-potd-page' => '', # do not localise
	'ffeed-potd-title' => '{{SITENAME}} picture of the day feed',
	'ffeed-potd-short-title' => 'Picture of the day',
	'ffeed-potd-desc' => 'Some of the finest images on {{SITENAME}}',
	'ffeed-potd-entry' => '{{SITENAME}} picture of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',

	# Quote of the Day
	'ffeed-qotd-page' => '', # do not localise
	'ffeed-qotd-title' => '{{SITENAME}} quote of the day feed',
	'ffeed-qotd-short-title' => 'Quote of the day',
	'ffeed-qotd-desc' => 'Some of the finest quotes on {{SITENAME}}',
	'ffeed-qotd-entry' => '{{SITENAME}} quote of the day for {{LOCALMONTHNAME}} {{LOCALDAY}}',
);

/** Message documentation (Message documentation)
 * @author Max Semenik
 * @author Mormegil
 */
$messages['qqq'] = array(
	'ffeed-desc' => '{{desc}}',
	'ffeed-feed-not-found' => '$1 is feed name',
	'ffeed-entry-not-found' => '$1 is date',
	'ffeed-featured-title' => 'Title of the Featured Articles [[w:web feed|syndication feed]]',
	'ffeed-featured-desc' => 'Description of the Featured Articles [[w:web feed|syndication feed]]',
	'ffeed-featured-entry' => "Title of day's entry in the Featured Articles [[w:web feed|syndication feed]]",
	'ffeed-onthisday-title' => 'Title of the "On this day..." [[w:web feed|syndication feed]]',
	'ffeed-onthisday-desc' => 'Description of the "On this day..." [[w:web feed|syndication feed]]',
	'ffeed-onthisday-entry' => 'Title of day\'s entry in the "On this day..." [[w:Web feed|syndication feeds]]',
	'ffeed-dyk-title' => 'Title of the "Did you know?" [[w:web feed|syndication feed]]',
	'ffeed-dyk-desc' => 'Description of the "Did you know?" [[w:web feed|syndication feed]]',
	'ffeed-dyk-entry' => 'Title of day\'s entry in the "Did you know?" [[w:Web feed|syndication feeds]]',
	'ffeed-motd-title' => 'Title of the Media of the Day [[w:web feed|syndication feed]]',
	'ffeed-motd-desc' => 'Description of the Media of the Day [[w:web feed|syndication feed]]',
	'ffeed-motd-entry' => "Title of day's entry in the Media of the Day [[w:web feed|syndication feed]]",
	'ffeed-potd-title' => 'Title of the Picture Of The Day [[w:web feed|syndication feed]]',
	'ffeed-potd-desc' => 'Description of the Picture Of The Day [[w:web feed|syndication feed]]',
	'ffeed-potd-entry' => "Title of day's entry in the Media of the Day [[w:web feed|syndication feed]]",
);

/** Asturian (Asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'ffeed-desc' => "Amiesta canales d'agregación del conteníu destacáu de la wiki",
	'ffeed-no-feed' => 'Nun se conseñó la canal',
	'ffeed-feed-not-found' => "Nun s'alcontró la canal $1",
	'ffeed-entry-not-found' => "Nun s'alcontró la entrada de la canal del $1",
	'ffeed-sidebar-section' => 'Canales de conteníu destacáu',
	'ffeed-invalid-timestamp' => "Marca d'hora de la canal inválida",
	'ffeed-featured-title' => 'Canal de los artículos destacaos de {{SITENAME}}',
	'ffeed-featured-short-title' => 'Artículos destacaos',
	'ffeed-featured-desc' => "Los meyores artículos qu'ufre {{SITENAME}}",
	'ffeed-featured-entry' => 'Artículu destacáu de {{SITENAME}} del {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Canal «Tal día como güei...» de {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'Tal día como güei...',
	'ffeed-onthisday-desc' => "Socesos históricos d'esti día",
	'ffeed-onthisday-entry' => 'Tal día como güei: {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Canal "Sabíes que...?" de {{SITENAME}}',
	'ffeed-dyk-short-title' => '¿Sabíes que...?',
	'ffeed-dyk-desc' => 'Del conteníu más nuevu de {{SITENAME}}',
	'ffeed-dyk-entry' => '¿Sabíes que...?: {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Canal multimedia del día de {{SITENAME}}',
	'ffeed-motd-short-title' => 'Multimedia del día',
	'ffeed-motd-desc' => 'Esbilla de la meyor multimedia de {{SITENAME}}',
	'ffeed-motd-entry' => 'Multimedia del día de {{SITENAME}} del {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => 'Canal imaxe del día de {{SITENAME}}',
	'ffeed-potd-short-title' => 'Imaxe del día',
	'ffeed-potd-desc' => 'Esbilla de les meyores imaxes de {{SITENAME}}',
	'ffeed-potd-entry' => 'Imaxe del día de {{SITENAME}} del {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-qotd-title' => 'Canal cita del día de {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Cita del día',
	'ffeed-qotd-desc' => 'Esbilla de les meyores cites de {{SITENAME}}',
	'ffeed-qotd-entry' => 'Cita del día de {{SITENAME}} del {{LOCALDAY}} de {{LOCALMONTHNAME}}',
);

/** Belarusian (Taraškievica orthography) (‪Беларуская (тарашкевіца)‬)
 * @author EugeneZelenko
 * @author Jim-by
 * @author Wizardist
 */
$messages['be-tarask'] = array(
	'ffeed-desc' => 'Дадае сындыкаваныя стужкі лепшага зьместу вікі',
	'ffeed-no-feed' => 'Стужка не пазначаная',
	'ffeed-feed-not-found' => 'Стужка $1 ня знойдзеная',
	'ffeed-entry-not-found' => 'Запіс ў стужцы за $1 ня знойдзены',
	'ffeed-featured-title' => 'Стужка з абранымі артыкуламі {{GRAMMAR:родны|{{SITENAME}}}}',
	'ffeed-featured-desc' => 'Найлепшыя артыкулы ў {{GRAMMAR:месны|{{SITENAME}}}}',
	'ffeed-featured-entry' => 'Абраны артыкул {{GRAMMAR:родны|{{SITENAME}}}} за {{LOCALDAY}} {{LOCALMONTHNAMEGEN}}',
	'ffeed-onthisday-title' => 'Стужка {{GRAMMAR:родны|{{SITENAME}}}} «Гэты дзень у гісторыі»',
	'ffeed-onthisday-desc' => 'Гістарычныя падзеі, якія адбыліся ў гэты дзень',
	'ffeed-onthisday-entry' => 'У гэты дзень, {{LOCALDAY}} {{LOCALMONTHNAMEGEN}}',
	'ffeed-dyk-title' => 'Стужка {{GRAMMAR:родны|{{SITENAME}}}} «Ці ведаеце Вы?»',
	'ffeed-dyk-desc' => 'З новых артыкулаў {{GRAMMAR:родны|{{SITENAME}}}}',
	'ffeed-dyk-entry' => 'Ці ведаеце Вы? ({{LOCALDAY}} {{LOCALMONTHNAMEGEN}})',
	'ffeed-motd-title' => 'Стужка {{GRAMMAR:родны|{{SITENAME}}}} «Цытата дня»',
	'ffeed-motd-desc' => 'Некаторыя з найлепшых цытатаў у {{GRAMMAR:месны|{{SITENAME}}}}',
	'ffeed-motd-entry' => 'Цытата дня ў {{GRAMMAR:месны|{{SITENAME}}}} за {{LOCALDAY}} {{LOCALMONTHNAMEGEN}}',
	'ffeed-potd-title' => 'Стужка {{GRAMMAR:родны|{{SITENAME}}}} «Выява дня»',
	'ffeed-potd-desc' => 'Некаторыя найлепшыя выявы ў {{GRAMMAR:родны|{{SITENAME}}}}',
	'ffeed-potd-entry' => 'Выява дня ў {{GRAMMAR:месны|{{SITENAME}}}} за {{LOCALDAY}} {{LOCALMONTHNAMEGEN}}',
);

/** Breton (Brezhoneg)
 * @author Y-M D
 */
$messages['br'] = array(
	'ffeed-featured-desc' => 'Ar pennadoù wellañ a gaver war {{SITENAME}}',
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

/** Czech (Česky)
 * @author Mormegil
 */
$messages['cs'] = array(
	'ffeed-desc' => 'Přidává syndikační kanály pro výběr z obsahu wiki',
	'ffeed-no-feed' => 'Nebyl uveden kanál',
	'ffeed-feed-not-found' => 'Kanál $1 nenalezen',
	'ffeed-entry-not-found' => 'Záznam kanálu pro $1 nenalezen',
	'ffeed-sidebar-section' => 'Kanály s vybraným obsahem',
	'ffeed-invalid-timestamp' => 'Neplatná časová značka kanálu',
	'ffeed-featured-title' => 'Kanál nejlepších článků {{grammar:2sg|{{SITENAME}}}}',
	'ffeed-featured-short-title' => 'Nejlepší články',
	'ffeed-featured-desc' => 'Nejlepší články, které může {{SITENAME}} nabídnout',
	'ffeed-featured-entry' => 'Článek dne {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}} na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-onthisday-title' => 'Kanál „Dnešek v minulosti“ na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-onthisday-short-title' => 'Dnešek v minulosti',
	'ffeed-onthisday-desc' => 'Historické události tento den',
	'ffeed-onthisday-entry' => '{{LOCALDAY}}. {{LOCALMONTHNAME}} v minulosti',
	'ffeed-dyk-title' => 'Kanál „Víte, že…?“ {{grammar:2sg|{{SITENAME}}}}',
	'ffeed-dyk-short-title' => 'Víte, že…?',
	'ffeed-dyk-desc' => 'Ze zajímavého obsahu {{grammar:2sg|{{SITENAME}}}}',
	'ffeed-dyk-entry' => '„Víte, že…?“ {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-motd-title' => 'Kanál souborů dne {{grammar:2sg|{{SITENAME}}}}',
	'ffeed-motd-short-title' => 'Soubor dne',
	'ffeed-motd-desc' => 'Nejlepší multimédia na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-motd-entry' => 'Soubor dne {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}} na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-potd-title' => 'Kanál obrázků dne {{grammar:2sg|{{SITENAME}}}}',
	'ffeed-potd-short-title' => 'Obrázek dne',
	'ffeed-potd-desc' => 'Nejlepší obrázky na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-potd-entry' => 'Obrázek dne {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}} na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-qotd-title' => 'Kanál citátů dne {{grammar:2sg|{{SITENAME}}}}',
	'ffeed-qotd-short-title' => 'Citát dne',
	'ffeed-qotd-desc' => 'Nejlepší citáty na {{grammar:6sg|{{SITENAME}}}}',
	'ffeed-qotd-entry' => 'Citát dne {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}} na {{grammar:6sg|{{SITENAME}}}}',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'ffeed-desc' => 'Ermöglicht gesonderte Feeds zu bestimmten Inhalten des Wikis',
	'ffeed-no-feed' => 'Es wurde kein Feed angegeben.',
	'ffeed-feed-not-found' => 'Feed $1 wurde nicht gefunden.',
	'ffeed-entry-not-found' => 'Feedeintrag $1 wurde nicht gefunden.',
	'ffeed-sidebar-section' => 'Feeds zu empfohlenen Inhalten',
	'ffeed-invalid-timestamp' => 'Ungültiger Feed-Zeitstempel',
	'ffeed-featured-title' => 'Feeds zu exzellenten Artikeln auf {{SITENAME}}',
	'ffeed-featured-short-title' => 'Exzellente Artikel',
	'ffeed-featured-desc' => 'Die exzellenten Artikel auf {{SITENAME}}',
	'ffeed-featured-entry' => 'Am {{LOCALDAY}}. {{LOCALMONTHNAME}} auf {{SITENAME}} exzellenter Artikel',
	'ffeed-good-title' => 'Feed zu den lesenswerten Artikeln auf {{SITENAME}}',
	'ffeed-good-short-title' => 'Lesenswerte Artikel',
	'ffeed-good-desc' => 'Die lesenswerten Artikel auf {{SITENAME}}',
	'ffeed-good-entry' => 'Am {{LOCALDAY}}. {{LOCALMONTHNAME}} auf {{SITENAME}} lesenswerter Artikel',
	'ffeed-onthisday-title' => 'Feed zu „An diesem Tag …“ auf {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'An diesem Tag …',
	'ffeed-onthisday-desc' => 'Historische Ereignisse dieses Tages',
	'ffeed-onthisday-entry' => 'An diesem Tag: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Feed zu „Schon gewusst?“ auf {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Schon gewusst?',
	'ffeed-dyk-desc' => 'Die neuesten Inhalte auf {{SITENAME}}',
	'ffeed-dyk-entry' => '„Schon gewusst?“: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Feed zur Mediendatei Zitat des Tages auf {{SITENAME}}',
	'ffeed-motd-short-title' => 'Mediendatei des Tages',
	'ffeed-motd-desc' => 'Einige der besten Mediendateien auf {{SITENAME}}',
	'ffeed-motd-entry' => 'Mediendatei des Tages am {{LOCALDAY}} {{LOCALMONTHNAME}} auf {{SITENAME}}',
	'ffeed-potd-title' => 'Feed zum Bild des Tages auf {{SITENAME}}',
	'ffeed-potd-short-title' => 'Bild des Tages',
	'ffeed-potd-desc' => 'Einige der besten Bilder auf {{SITENAME}}',
	'ffeed-potd-entry' => 'Bild des Tages am {{LOCALDAY}} {{LOCALMONTHNAME}} auf {{SITENAME}}',
	'ffeed-qotd-title' => 'Feed zum Zitat des Tages auf {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Zitat des Tages',
	'ffeed-qotd-desc' => 'Einige der besten Zitate auf {{SITENAME}}',
	'ffeed-qotd-entry' => 'Zitat des Tages am {{LOCALDAY}} {{LOCALMONTHNAME}} auf {{SITENAME}}',
);

/** Lower Sorbian (Dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'ffeed-desc' => 'Dodawa syndikaciske kanale wuběrnego wikiwopśimjeśa.',
	'ffeed-no-feed' => 'Kanal njepódany',
	'ffeed-feed-not-found' => 'Kanal $1 njenamakany',
	'ffeed-entry-not-found' => 'Kanalowy zapisk za $1 njenamakany',
	'ffeed-sidebar-section' => 'Kanale dopóruconych wopśimjeśow',
	'ffeed-invalid-timestamp' => 'Njepłaśiwy kanalowy casowy kołk',
	'ffeed-featured-title' => '{{SITENAME}} - kanal wuběrnych nastawkow',
	'ffeed-featured-short-title' => 'Dopórucone nastawki',
	'ffeed-featured-desc' => 'Nejlěpše nastawki, kótarež {{SITENAME}} póbitujo',
	'ffeed-featured-entry' => '{{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}  {{SITENAME}} - wuběrny nastawk',
	'ffeed-onthisday-title' => '{{SITENAME}} - kanal "Toś ten źeń..."',
	'ffeed-onthisday-short-title' => 'Toś ten źeń...',
	'ffeed-onthisday-desc' => 'Historiske tšojenja na toś ten źeń',
	'ffeed-onthisday-entry' => 'Toś ten źeń: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-dyk-title' => '{{SITENAME}} - kanal "Sćo wěželi, až...?"',
	'ffeed-dyk-short-title' => 'Sy južo wěźeł?',
	'ffeed-dyk-desc' => 'Nejnowše wopśimjeśe z {{GRAMMAR:genitiw|{{SITENAME}}}}',
	'ffeed-dyk-entry' => 'Sćo wěźeli, až...?: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-motd-title' => 'Kanal mediuma dnja na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-motd-short-title' => 'Medium dnja',
	'ffeed-motd-desc' => 'Někotare z nejlěpšych mediumow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-motd-entry' => '{{SITENAME}} - medium dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-potd-title' => '{{SITENAME}} - kanal wobraz dnja',
	'ffeed-potd-short-title' => 'Wobraz dnja',
	'ffeed-potd-desc' => 'Někotare z nejlěpšych wobrazow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-potd-entry' => '{{SITENAME}} - wobraz dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-qotd-title' => 'Kanal citata dnja na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-qotd-short-title' => 'Citat dnja',
	'ffeed-qotd-desc' => 'Někotare z nejlěpšych citatow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-qotd-entry' => '{{SITENAME}} - citat dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
);

/** French (Français)
 * @author Gomoko
 * @author Jean-Frédéric
 * @author Tpt
 */
$messages['fr'] = array(
	'ffeed-desc' => 'Ajoute des flux de publication du contenu du wiki',
	'ffeed-no-feed' => 'Source non spécifiée',
	'ffeed-feed-not-found' => 'Source $1 non trouvée',
	'ffeed-entry-not-found' => 'Entrée du flux pour $1 non trouvée',
	'ffeed-sidebar-section' => 'Alimentations de contenu caractéristique',
	'ffeed-invalid-timestamp' => "Horodatage d'alimentation invalide",
	'ffeed-featured-title' => "Liste d'articles labellisés de {{SITENAME}}",
	'ffeed-featured-short-title' => 'Articles en vedette',
	'ffeed-featured-desc' => 'Meilleurs articles que {{SITENAME}} peut offrir',
	'ffeed-featured-entry' => 'Article vedette de {{SITENAME}} le {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-good-title' => 'Alimentation des bons articles de {{SITENAME}}',
	'ffeed-good-short-title' => 'Bons articles',
	'ffeed-good-desc' => 'Bons articles que {{SITENAME}} peut offrir',
	'ffeed-good-entry' => 'Bon article de {{SITENAME}} {{LOCALMONTHNAME}} {{LOCALDAY}}',
	'ffeed-onthisday-title' => 'Flux "Ce jour-là..." de {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'Ce jour-là...',
	'ffeed-onthisday-desc' => 'Événements historiques sur cette journée',
	'ffeed-onthisday-entry' => 'Ce jour-là: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Le savez-vous ? de {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Le saviez-vous?',
	'ffeed-dyk-desc' => 'Du contenu le plus récent de {{SITENAME}}',
	'ffeed-dyk-entry' => 'Le saviez-vous ? {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Médias du jour de {{SITENAME}}',
	'ffeed-motd-short-title' => 'Les médias du jour.',
	'ffeed-motd-desc' => 'Quelques-uns des meilleurs médias sur {{SITENAME}}',
	'ffeed-motd-entry' => 'Média du jour de {{SITENAME}} pour le {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => 'Images du jour de {{SITENAME}}',
	'ffeed-potd-short-title' => 'Image du jour',
	'ffeed-potd-desc' => 'Quelques-unes des meilleures images de {{SITENAME}}',
	'ffeed-potd-entry' => 'Image du jour de {{SITENAME}} pour le {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-qotd-title' => 'Alimentation de la citation de {{SITENAME}} du jour',
	'ffeed-qotd-short-title' => 'Citation du jour',
	'ffeed-qotd-desc' => 'Quelques-unes de meilleurs citations sur {{SITENAME}}',
	'ffeed-qotd-entry' => 'Citation du jour de {{SITENAME}} pour le {{LOCALDAY}} {{LOCALMONTHNAME}}',
);

/** Galician (Galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'ffeed-desc' => 'Engade fontes de novas dos contidos destacados do wiki',
	'ffeed-no-feed' => 'Non se especificou a fonte de novas',
	'ffeed-feed-not-found' => 'Non se atopou a fonte de novas "$1"',
	'ffeed-entry-not-found' => 'Non se atopou a entrada da fonte de novas do día $1',
	'ffeed-sidebar-section' => 'Fontes de novas dos contidos destacados',
	'ffeed-invalid-timestamp' => 'A data e a hora da fonte de novas son incorrectas',
	'ffeed-featured-title' => 'Fonte de novas dos artigos destacados de {{SITENAME}}',
	'ffeed-featured-short-title' => 'Artigos destacados',
	'ffeed-featured-desc' => 'Os mellores artigos que ofrece {{SITENAME}}',
	'ffeed-featured-entry' => 'Artigo destacado de {{SITENAME}} o {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-good-title' => 'Fonte de novas dos artigos bos de {{SITENAME}}',
	'ffeed-good-short-title' => 'Artigos bos',
	'ffeed-good-desc' => 'Os bos artigos que ofrece {{SITENAME}}',
	'ffeed-good-entry' => 'Artigo bo de {{SITENAME}} o {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Fonte de novas "Tal día como hoxe no ano..." de {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'Tal día como hoxe no ano...',
	'ffeed-onthisday-desc' => 'Acontecementos históricos deste día',
	'ffeed-onthisday-entry' => 'Tal día como hoxe: {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Fonte de novas "Sabía que...?" de {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Sabía que...?',
	'ffeed-dyk-desc' => 'Dos contidos máis recentes de {{SITENAME}}',
	'ffeed-dyk-entry' => 'Sabía que...?: {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Fonte de novas do ficheiro multimedia do día de {{SITENAME}}',
	'ffeed-motd-short-title' => 'Ficheiro multimedia do día',
	'ffeed-motd-desc' => 'Un dos mellores ficheiros multimedia de {{SITENAME}}',
	'ffeed-motd-entry' => 'Ficheiro multimedia do día de {{SITENAME}} o {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => 'Fonte de novas da imaxe do día de {{SITENAME}}',
	'ffeed-potd-short-title' => 'Imaxe do día',
	'ffeed-potd-desc' => 'Unha das mellores imaxes de {{SITENAME}}',
	'ffeed-potd-entry' => 'Imaxe do día de {{SITENAME}} o {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-qotd-title' => 'Fonte de novas da cita do día de {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Cita do día',
	'ffeed-qotd-desc' => 'Unha das mellores citas de {{SITENAME}}',
	'ffeed-qotd-entry' => 'Cita do día de {{SITENAME}} o {{LOCALDAY}} de {{LOCALMONTHNAME}}',
);

/** Hebrew (עברית)
 * @author Amire80
 * @author Nirofir
 */
$messages['he'] = array(
	'ffeed-desc' => 'הוספת הזנה לתוכן מומלץ בוויקי',
	'ffeed-no-feed' => 'לא צוינה הזנה',
	'ffeed-feed-not-found' => 'ההזנה $1 לא נמצאה',
	'ffeed-entry-not-found' => 'לא נמצאה הזנה עבור $1',
	'ffeed-sidebar-section' => 'הזנות תוכן מומלץ',
	'ffeed-invalid-timestamp' => 'חותם זמן לא תקין להזנה',
	'ffeed-featured-title' => 'הזנת ערכים מומלצים ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-featured-short-title' => 'ערכים מומלצים',
	'ffeed-featured-desc' => 'הערכים הטובים ביותר שיש ל{{GRAMMAR:תחילית|{{SITENAME}}}} להציע',
	'ffeed-featured-entry' => 'ערך מומלץ ב{{GRAMMAR:תחילית|{{SITENAME}}}} ב־{{LOCALDAY}} ב{{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'הזנת "היום בהיסטוריה" ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-onthisday-short-title' => 'היום בהיסטוריה',
	'ffeed-onthisday-desc' => 'אירועים היסטוריים ביום הזה',
	'ffeed-onthisday-entry' => 'היום בהיסטוריה: {{LOCALDAY}} ב־{{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'הזנת "הידעת?" של {{SITENAME}}',
	'ffeed-dyk-short-title' => 'הידעת?',
	'ffeed-dyk-desc' => 'מבחר מהתוכן החדש ביותר באתר {{SITENAME}}',
	'ffeed-dyk-entry' => 'הידעת? – {{LOCALDAY}} ב{{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'הזנת קובץ המדיה של היום ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-motd-short-title' => 'קובץ המדיה הטוב של היום',
	'ffeed-motd-desc' => 'קובצי המדיה הטובים ביותר ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-motd-entry' => 'הזנת קובץ היום ב{{GRAMMAR:תחילית|{{SITENAME}}}} ב־{{LOCALDAY}} ב{{LOCALMONTHNAME}}',
	'ffeed-potd-title' => 'הזנת תמונת היום ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-potd-short-title' => 'תמונת היום',
	'ffeed-potd-desc' => 'מבחר מהתמונות הטובות ביותר ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-potd-entry' => 'תמונת היום ב{{GRAMMAR:תחילית|{{SITENAME}}}} עבור {{LOCALDAY}} ב{{LOCALMONTHNAME}}',
	'ffeed-qotd-title' => 'ציטוט היום ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-qotd-short-title' => 'ציטוט היום',
	'ffeed-qotd-desc' => 'הציטוטים הטובים ביותר ב{{GRAMMAR:תחילית|{{SITENAME}}}}',
	'ffeed-qotd-entry' => 'ציטוט היום ב{{GRAMMAR:תחילית|{{SITENAME}}}} ב־{{LOCALDAY}} ב{{LOCALMONTHNAME}}',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'ffeed-desc' => 'Přidawa syndikaciske kanale wuběrneho wikiwobsaha.',
	'ffeed-no-feed' => 'Kanal njepodaty',
	'ffeed-feed-not-found' => 'Kanal $1 njenamakany',
	'ffeed-entry-not-found' => 'Kanalowy zapisk za $1 njenamakany',
	'ffeed-sidebar-section' => 'Kanale doporučenych wobsahow',
	'ffeed-invalid-timestamp' => 'Njepłaćiwy kanalowy časowy kołk',
	'ffeed-featured-title' => '{{SITENAME}} - kanal wuběrnych nastawkow',
	'ffeed-featured-short-title' => 'Doporučene nastawki',
	'ffeed-featured-desc' => 'Najlěpše nastawki, kotrež {{SITENAME}} poskića',
	'ffeed-featured-entry' => '{{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}  {{SITENAME}} wuběrny nastawk',
	'ffeed-good-title' => '{{SITENAME}} - kanal dobrych nastawkow',
	'ffeed-good-short-title' => 'Dobre nstawki',
	'ffeed-good-desc' => 'Dobre nastawki, kotrež {{SITENAME}} dyrbi poskićić',
	'ffeed-good-entry' => '{{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}  {{SITENAME}} dobry nastawk',
	'ffeed-onthisday-title' => '{{SITENAME}} - kanal "Tutón dźeń..."',
	'ffeed-onthisday-short-title' => 'Tutón dźeń...',
	'ffeed-onthisday-desc' => 'Historiske podawki na tutón dźeń',
	'ffeed-onthisday-entry' => 'Tutón dźeń: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-dyk-title' => '{{SITENAME}} - kanal "Wěš ty, zo...?"',
	'ffeed-dyk-short-title' => 'Sy hižo wědźał?',
	'ffeed-dyk-desc' => 'Najnowši wobsah z {{GRAMMAR:genitiw|{{SITENAME}}}}',
	'ffeed-dyk-entry' => 'Wěš ty, zo...?: {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-motd-title' => 'Kanal medija dnja na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-motd-short-title' => 'Medij dnja',
	'ffeed-motd-desc' => 'Někotre z najlěpšich medijow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-motd-entry' => '{{SITENAME}} - medij dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-potd-title' => '{{SITENAME}} - kanal wobraz dnja',
	'ffeed-potd-short-title' => 'Wobraz dnja',
	'ffeed-potd-desc' => 'Někotre z najlěpšich wobrazow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-potd-entry' => '{{SITENAME}} - wobraz dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
	'ffeed-qotd-title' => 'Kanal citata dnja na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-qotd-short-title' => 'Citat dnja',
	'ffeed-qotd-desc' => 'Někotre z najlěpšich citatow na {{GRAMMAR:lokatiw|{{SITENAME}}}}',
	'ffeed-qotd-entry' => '{{SITENAME}} - medij dnja za {{LOCALDAY}}. {{LOCALMONTHNAMEGEN}}',
);

/** Interlingua (Interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'ffeed-desc' => 'Adde fluxos de syndication del contento eminente de iste wiki',
	'ffeed-no-feed' => 'Syndication non specificate',
	'ffeed-feed-not-found' => 'Syndication $1 non trovate',
	'ffeed-entry-not-found' => 'Entrata de syndication pro $1 non trovate',
	'ffeed-sidebar-section' => 'Syndicationes de contento eminente',
	'ffeed-invalid-timestamp' => 'Data e hora de syndication invalide',
	'ffeed-featured-title' => 'Syndication de articulos eminente de {{SITENAME}}',
	'ffeed-featured-short-title' => 'Articulos eminente',
	'ffeed-featured-desc' => 'Le melior articulos que {{SITENAME}} pote offerer',
	'ffeed-featured-entry' => 'Articulo eminente de {{SITENAME}} le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-good-title' => 'Syndication de bon articulos de {{SITENAME}}',
	'ffeed-good-short-title' => 'Bon articulos',
	'ffeed-good-desc' => 'Bon articulos que {{SITENAME}} pote offerer',
	'ffeed-good-entry' => 'Bon articulo de {{SITENAME}} le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Syndication "In iste die..." de {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'In iste die...',
	'ffeed-onthisday-desc' => 'Eventos historic in iste die',
	'ffeed-onthisday-entry' => 'In iste die: le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Syndication "Sapeva tu?" de {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Sapeva tu?',
	'ffeed-dyk-desc' => 'Del contento le plus recente de {{SITENAME}}',
	'ffeed-dyk-entry' => 'Sapeva tu?: le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Syndication "Multimedia del die" de {{SITENAME}}',
	'ffeed-motd-short-title' => 'Multimedia del die',
	'ffeed-motd-desc' => 'Alcunes del melior materiales in {{SITENAME}}',
	'ffeed-motd-entry' => 'Material del die de {{SITENAME}} le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => 'Syndication "Imagine del die" de {{SITENAME}}',
	'ffeed-potd-short-title' => 'Imagine del die',
	'ffeed-potd-desc' => 'Alcunes del melior imagines in {{SITENAME}}',
	'ffeed-potd-entry' => 'Imagine del die de {{SITENAME}} le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
	'ffeed-qotd-title' => 'Syndication "Citation del die" de {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Citation del die',
	'ffeed-qotd-desc' => 'Alcunes del melior citationes in {{SITENAME}}',
	'ffeed-qotd-entry' => 'Citation del die de {{SITENAME}} le {{LOCALDAY}} de {{LOCALMONTHNAME}}',
);

/** Korean (한국어)
 * @author Kwj2772
 */
$messages['ko'] = array(
	'ffeed-desc' => '위키의 알찬 컨텐츠에 대한 피드를 제공',
	'ffeed-no-feed' => '피드가 제시되지 않았습니다.',
	'ffeed-feed-not-found' => '$1 피드가 없습니다',
	'ffeed-entry-not-found' => '$1 피드 항목이 없습니다.',
	'ffeed-sidebar-section' => '알찬 컨텐츠 피드',
	'ffeed-invalid-timestamp' => '피드 타임스탬프가 잘못되었습니다.',
	'ffeed-featured-title' => '{{SITENAME}} 알찬 글 피드',
	'ffeed-featured-short-title' => '알찬 글',
	'ffeed-featured-desc' => '{{SITENAME}}이(가) 제공하는 최고의 문서',
	'ffeed-featured-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}}일 {{SITENAME}} 알찬 글',
	'ffeed-good-title' => '{{SITENAME}} 좋은 글 피드',
	'ffeed-good-short-title' => '좋은 글',
	'ffeed-good-desc' => '{{SITENAME}}에 등재된 고품질 문서',
	'ffeed-good-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}}일 {{SITENAME}} 좋은 글',
	'ffeed-onthisday-title' => '{{SITENAME}} "오늘의 역사..." 피드',
	'ffeed-onthisday-short-title' => '오늘의 역사...',
	'ffeed-onthisday-desc' => '이 날에 있었던 역사적 사건',
	'ffeed-onthisday-entry' => '오늘의 역사: {{LOCALMONTHNAME}} {{LOCALDAY}}일',
	'ffeed-dyk-title' => '{{SITENAME}} "알고 계십니까?" 피드',
	'ffeed-dyk-short-title' => '알고 계십니까?',
	'ffeed-dyk-desc' => '{{SITENAME}}의 최신 정보에서 가져온 것입니다.',
	'ffeed-dyk-entry' => '알고 계십니까?: {{LOCALMONTHNAME}} {{LOCALDAY}}일',
	'ffeed-motd-title' => '{{SITENAME}} 오늘의 미디어 피드',
	'ffeed-motd-short-title' => '오늘의 미디어',
	'ffeed-motd-desc' => '{{SITENAME}}의 가장 좋은 미디어 자료',
	'ffeed-motd-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}}일 {{SITENAME}} 오늘의 미디어',
	'ffeed-potd-title' => '{{SITENAME}} 오늘의 그림 피드',
	'ffeed-potd-short-title' => '오늘의 그림',
	'ffeed-potd-desc' => '{{SITENAME}}의 가장 좋은 그림',
	'ffeed-potd-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}}일 {{SITENAME}} 오늘의 그림',
	'ffeed-qotd-title' => '{{SITENAME}} 오늘의 명언 피드',
	'ffeed-qotd-short-title' => '오늘의 명언',
	'ffeed-qotd-desc' => '{{SITENAME}}에서 가장 좋은 명언 인용',
	'ffeed-qotd-entry' => '{{LOCALMONTHNAME}} {{LOCALDAY}}일 {{SITENAME}} 오늘의 명언',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'ffeed-no-feed' => 'Feed net spezifizéiert',
	'ffeed-feed-not-found' => 'De Feed $1 gouf net fonnt',
	'ffeed-featured-title' => 'Feed vun de recommandéierten Artikelen op {{SITENAME}}',
	'ffeed-featured-short-title' => 'Recommandéiert Artikelen',
	'ffeed-featured-desc' => 'Déi bescht Artikelen déi {{SITENAME}} ze bidden huet',
	'ffeed-featured-entry' => 'Den  {{LOCALDAY}} {{LOCALMONTHNAME}} op {{SITENAME}} ausgezeechenten Artikel',
	'ffeed-good-short-title' => 'Gutt Artikelen',
	'ffeed-good-desc' => 'Gutt Artikelen déi {{SITENAME}} ze bidden huet',
	'ffeed-onthisday-short-title' => 'Um Dag vun haut...',
	'ffeed-onthisday-desc' => 'Historesch Evenementer op dësem Dag',
	'ffeed-onthisday-entry' => 'Op dësem Dag: {{LOCALMONTHNAME}} {{LOCALDAY}}',
	'ffeed-dyk-title' => '{{SITENAME}} "Vosst Dir schonn" Feed',
	'ffeed-dyk-short-title' => 'Wosst Dir?',
	'ffeed-dyk-desc' => 'De rezensten Inhalt op {{SITENAME}}',
	'ffeed-dyk-entry' => 'Wosst Dir schonn?:  {{LOCALMONTHNAME}} {{LOCALDAY}}',
	'ffeed-motd-title' => '{{SITENAME}} Feed mam Medie-Fichier vum Dag',
	'ffeed-motd-short-title' => 'Medie-Fichier vum Dag',
	'ffeed-motd-desc' => 'E puer vun de beschte Medie-Fichieren op {{SITENAME}}',
	'ffeed-potd-short-title' => 'Bild vum Dag',
	'ffeed-potd-desc' => 'E puer vun de beschte Biller op {{SITENAME}}',
	'ffeed-qotd-title' => 'Feed vum Zitat vum Dag op {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Zitat vum Dag',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'ffeed-desc' => 'Додава канали за избрани содржини на викито.',
	'ffeed-no-feed' => 'Каналот не е укажан',
	'ffeed-feed-not-found' => 'Каналот $1 не е пронајден',
	'ffeed-entry-not-found' => 'Каналскиот запис за $1 не е пронајден',
	'ffeed-sidebar-section' => 'Канали за избрани содржини',
	'ffeed-invalid-timestamp' => 'Неважечки датум и време за емитувањето',
	'ffeed-featured-title' => 'Канал на избрани статии на {{SITENAME}}',
	'ffeed-featured-short-title' => 'Избрани статии',
	'ffeed-featured-desc' => 'Најдобрите статии на {{SITENAME}}',
	'ffeed-featured-entry' => 'Избрана статија на {{SITENAME}} за {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-good-title' => 'Канал на добри статии на {{SITENAME}}',
	'ffeed-good-short-title' => 'Добри статии',
	'ffeed-good-desc' => 'Добрите статии на {{SITENAME}}',
	'ffeed-good-entry' => 'Добра статија на {{SITENAME}} за {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Канал „На денешен ден...“ на {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'На денешен ден...',
	'ffeed-onthisday-desc' => 'Историски настани што се случиле на денешен ден',
	'ffeed-onthisday-entry' => 'На денешен ден: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Канал „Дали сте знаеле?“ на {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Дали сте знаеле?',
	'ffeed-dyk-desc' => 'Од најновите содржини на {{SITENAME}}',
	'ffeed-dyk-entry' => 'Дали сте знаеле?: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Канал за снимка на денот на {{SITENAME}}',
	'ffeed-motd-short-title' => 'Снимка на денот',
	'ffeed-motd-desc' => 'Најубавите снимки на {{SITENAME}}',
	'ffeed-motd-entry' => 'Снимка на денот за {{LOCALDAY}} {{LOCALMONTHNAME}} на {{SITENAME}}',
	'ffeed-potd-title' => 'Канал за слика на денот на {{SITENAME}}',
	'ffeed-potd-short-title' => 'Слика на денот',
	'ffeed-potd-desc' => 'Најдобрите слики на {{SITENAME}}',
	'ffeed-potd-entry' => 'Слика на денот за {{LOCALDAY}} {{LOCALMONTHNAME}} на {{SITENAME}}',
	'ffeed-qotd-title' => 'Канал за мисла на денот на {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Мисла на денот',
	'ffeed-qotd-desc' => 'Наијнтересните мисли на {{SITENAME}}',
	'ffeed-qotd-entry' => 'Мисла на денот за {{LOCALDAY}} {{LOCALMONTHNAME}} на {{SITENAME}}',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'ffeed-desc' => 'Menambahkan suapan sindiket kandungan pilihan wiki',
	'ffeed-no-feed' => 'Suapan tidak dinyatakan',
	'ffeed-feed-not-found' => 'Suapan $1 tidak dijumpai',
	'ffeed-entry-not-found' => 'Entri suapan pada $1 tidak dijumpai',
	'ffeed-sidebar-section' => 'Suapan kandungan pilihan',
	'ffeed-invalid-timestamp' => 'Cop masa suapan tidak sah',
	'ffeed-featured-title' => 'Suapan rencana pilihan {{SITENAME}}',
	'ffeed-featured-short-title' => 'Rencana pilihan',
	'ffeed-featured-desc' => 'Rencana-rencana terbaik yang ditawarkan oleh {{SITENAME}}',
	'ffeed-featured-entry' => 'Rencana pilihan {{SITENAME}} {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-good-title' => 'Suapan rencana berkualiti {{SITENAME}}',
	'ffeed-good-short-title' => 'Rencana berkualiti',
	'ffeed-good-desc' => 'Rencana-rencana berkualti yang ditawarkan oleh {{SITENAME}}',
	'ffeed-good-entry' => 'Rencana berkualiti {{SITENAME}} {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-onthisday-title' => 'Suapan "Hari ini dalam sejarah" {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'Hari ini dalam sejarah',
	'ffeed-onthisday-desc' => 'Peristiwa-peristiwa bersejarah pada hari ini',
	'ffeed-onthisday-entry' => 'Pada hari ini: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Suapan "Tahukah anda..." {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Tahukah anda...',
	'ffeed-dyk-desc' => 'Dari kandungan terbaru {{SITENAME}}',
	'ffeed-dyk-entry' => 'Tahukah anda...: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Suapan media pilihan {{SITENAME}}',
	'ffeed-motd-short-title' => 'Media pilihan',
	'ffeed-motd-desc' => 'Bahan-bahan media yang terbaik di {{SITENAME}}',
	'ffeed-motd-entry' => 'Bahan media pilihan {{SITENAME}} pada {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-potd-title' => 'Suapan gambar pilihan {{SITENAME}}',
	'ffeed-potd-short-title' => 'Gambar pilihan',
	'ffeed-potd-desc' => 'Gambar-gambar yang terbaik di {{SITENAME}}',
	'ffeed-potd-entry' => 'Gambar pilihan {{SITENAME}} pada {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-qotd-title' => 'Suapan petikan pilihan {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Petikan pilihan',
	'ffeed-qotd-desc' => 'Petikan-petikan yang paling menarik di {{SITENAME}}',
	'ffeed-qotd-entry' => 'Petikan pilihan {{SITENAME}} pada {{LOCALDAY}} {{LOCALMONTHNAME}}',
);

/** Dutch (Nederlands)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'ffeed-desc' => 'Voegt feeds toe voor de uitgelichte inhoud van een wiki',
	'ffeed-no-feed' => 'Er is geen feed opgegeven',
	'ffeed-feed-not-found' => 'De feed $1 bestaat niet',
	'ffeed-entry-not-found' => 'De feedvermelding $1 is niet gevonden',
	'ffeed-sidebar-section' => 'Feeds met uitgelichte inhoud',
	'ffeed-invalid-timestamp' => 'Ongeldige tijdstempel voor feed',
	'ffeed-featured-title' => 'Feed voor uitgelichte artikelen van {{SITENAME}}',
	'ffeed-featured-short-title' => 'Uitgelichte artikelen',
	'ffeed-featured-desc' => 'De beste artikelen van {{SITENAME}}',
	'ffeed-featured-entry' => 'Uitgelicht artikel van {{SITENAME}} op {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-good-title' => "Feed met goede pagina's voor {{SITENAME}}",
	'ffeed-good-short-title' => "Goede pagina's",
	'ffeed-good-desc' => "Goede pagina's die {{SITENAME}} te bieden heeft",
	'ffeed-good-entry' => 'Goede pagina van {{LOCALDAY}} {{LOCALMONTHNAME}} van {{SITENAME}}',
	'ffeed-onthisday-title' => 'Feed voor "Op deze dag..." van {{SITENAME}}',
	'ffeed-onthisday-short-title' => 'Op deze dag...',
	'ffeed-onthisday-desc' => 'Historische gebeurtenissen op deze dag',
	'ffeed-onthisday-entry' => 'Op deze dag: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-dyk-title' => 'Feed voor "Wist u dat" van {{SITENAME}}',
	'ffeed-dyk-short-title' => 'Wist u dat?',
	'ffeed-dyk-desc' => 'De nieuwste inhoud van {{SITENAME}}',
	'ffeed-dyk-entry' => 'Wist u dat?: {{LOCALDAY}} {{LOCALMONTHNAME}}',
	'ffeed-motd-title' => 'Feed voor media van de dag van {{SITENAME}}',
	'ffeed-motd-short-title' => 'Media van de dag',
	'ffeed-motd-desc' => 'De beste media van {{SITENAME}}',
	'ffeed-motd-entry' => 'Media van de dag voor van {{LOCALDAY}} {{LOCALMONTHNAME}} van {{SITENAME}}',
	'ffeed-potd-title' => 'Feed voor afbeelding van de dag van {{SITENAME}}',
	'ffeed-potd-short-title' => 'Foto van de dag',
	'ffeed-potd-desc' => 'De beste afbeeldingen van {{SITENAME}}',
	'ffeed-potd-entry' => 'Afbeelding van de dag voor van {{LOCALDAY}} {{LOCALMONTHNAME}} van {{SITENAME}}',
	'ffeed-qotd-title' => 'Feed voor uitspraak van de dag van {{SITENAME}}',
	'ffeed-qotd-short-title' => 'Citaat van de dag',
	'ffeed-qotd-desc' => 'De beste uitspraken van {{SITENAME}}',
	'ffeed-qotd-entry' => 'Uitspraak van de dag voor van {{LOCALDAY}} {{LOCALMONTHNAME}} van {{SITENAME}}',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'ffeed-featured-short-title' => 'విశేష వ్యాసాలు',
	'ffeed-onthisday-short-title' => 'ఈ రోజున&hellip;',
	'ffeed-onthisday-desc' => 'ఈ రోజు జరిగిన చారిత్రక ఘటనలు',
	'ffeed-dyk-short-title' => 'మీకు తెలుసా?',
	'ffeed-potd-short-title' => 'నేటి చిత్రం',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Liangent
 */
$messages['zh-hans'] = array(
	'ffeed-desc' => '为wiki的特色内容提供联合供稿',
	'ffeed-no-feed' => '没有指定供稿',
	'ffeed-feed-not-found' => '没有找到供稿$1',
	'ffeed-entry-not-found' => '找不到$1的供稿项目',
	'ffeed-sidebar-section' => '特色内容供稿',
	'ffeed-invalid-timestamp' => '无效时间戳',
	'ffeed-featured-title' => '{{SITENAME}}特色条目供稿',
	'ffeed-featured-short-title' => '特色条目',
	'ffeed-featured-desc' => '{{SITENAME}}上最佳的条目',
	'ffeed-featured-entry' => '{{SITENAME}}{{LOCALMONTHNAME}}{{LOCALDAY}}日特色条目',
	'ffeed-good-title' => '{{SITENAME}}优良条目供稿',
	'ffeed-good-short-title' => '优良条目',
	'ffeed-good-desc' => '{{SITENAME}}上较好的条目',
	'ffeed-good-entry' => '{{SITENAME}}{{LOCALMONTHNAME}}{{LOCALDAY}}日特色条目',
	'ffeed-onthisday-title' => '{{SITENAME}}“历史上的今天”供稿',
	'ffeed-onthisday-short-title' => '历史上的今天',
	'ffeed-onthisday-desc' => '这一天的历史事件',
	'ffeed-onthisday-entry' => '历史上的今天：{{LOCALMONTHNAME}}{{LOCALDAY}}日',
	'ffeed-dyk-title' => '{{SITENAME}}“你知道吗？”供稿',
	'ffeed-dyk-short-title' => '你知道吗？',
	'ffeed-dyk-desc' => '来自{{SITENAME}}的最新内容',
	'ffeed-dyk-entry' => '你知道吗？：{{LOCALMONTHNAME}}{{LOCALDAY}}日',
	'ffeed-motd-title' => '{{SITENAME}}每日媒体供稿',
	'ffeed-motd-short-title' => '每日媒体',
	'ffeed-motd-desc' => '{{SITENAME}}上最佳的一些媒体',
	'ffeed-motd-entry' => '{{SITENAME}}{{LOCALMONTHNAME}}{{LOCALDAY}}日的每日媒体',
	'ffeed-potd-title' => '{{SITENAME}}每日图片供稿',
	'ffeed-potd-short-title' => '每日图片',
	'ffeed-potd-desc' => '{{SITENAME}}上最佳的一些图片',
	'ffeed-potd-entry' => '{{SITENAME}}{{LOCALMONTHNAME}}{{LOCALDAY}}日的每日图片',
	'ffeed-qotd-title' => '{{SITENAME}}每日名言供稿',
	'ffeed-qotd-short-title' => '每日名言',
	'ffeed-qotd-desc' => '{{SITENAME}}上最佳的一些名言',
	'ffeed-qotd-entry' => '{{SITENAME}}{{LOCALMONTHNAME}}{{LOCALDAY}}日的每日名言',
);

