<?php
return [
	'loader' => [
		'title' => 'Anfangen',
		'file_select' => 'ROM Datei auswählen',
		'content' => '<ol>'
				. '<li>Wähle die Rom Datei und lade sie ihn den Browser (Bitte nutze die <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> ROM mit einer .smc oder .sfc Endung)</li>'
				. '<li>Wähle die <a href="/de/options">' . __('navigation.options') . '</a> um auszuwählen wie Zufällig dein Spiel sein soll</li>'
				. '<li>Klicke ' . __('randomizer.generate.casual') . '</li>'
				. '<li>Dann speichere deine Rom und fang an zu spielen</li>'
			. '</ol>',
	],
	'info' => [
		'spoilerwarning' => 'WARNUNG: Der Generator des Spiels hat das Spoilerprotokoll angezeigt.',
		'logic' => __('randomizer.logic.title'),
		'build' => 'ROM build',
		'difficulty' => __('randomizer.difficulty.title'),
		'variation' => __('randomizer.variation.title'),
		'shuffle' => __('entrance.shuffle.title'),
		'mode' => __('randomizer.mode.title'),
		'weapons' => __('randomizer.weapons.title'),
		'goal' => __('randomizer.goal.title'),
		'permalink' => 'Permalink',
		'special' => 'Spezial',
		'notes' => 'Notizen',
		'generated' => 'Erstellt',
	],
	'settings' => [
		'heart_speed' => 'Herz Geschwindigkeit',
		'heart_speeds' => [
			'off' => 'Aus',
			'double' => 'Doppelte Geschwindigkeit',
			'normal' => 'Geschwindigkeit',
			'half' => 'Halbe Geschwindigkeit',
			'quarter' => 'Viertel Geschwindigkeit',
		],
		'menu_speed' => 'Menü Geschwindigkeit',
		'menu_speeds' => [
			'instant' => 'Instant',
			'fast' => 'Schnell',
			'normal' => 'Normal',
			'slow' => 'Langsam',
		],
		'heart_color' => 'Farbe der Herzen',
		'heart_colors' => [
			'blue' => 'Blau',
			'green' => 'Grün',
			'red' => 'Rot',
			'yellow' => 'Gelb',
		],
		'play_as' => 'Spiele als',
		'music' => 'Hintergrundmusik',
		'music_info' => '(setze zu "Keine" für <a href="https://alttprlinks.page.link/SjiP" target="_blank" rel="noopener noreferrer">MSU-1 Support</a>)',
		'quickswap' => 'Gegenstand Schnellwechsel',
		'race_warning' => 'Funktioniert nicht in einer Rom für Rennen',
	],
];
