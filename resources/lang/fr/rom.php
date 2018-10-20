<?php
return [
	'loader' => [
		'title' => 'Pour commencer',
		'file_select' => 'Sélectionnez le fichier ROM',
		'content' => '<ol>'
				. '<li>Sélectionnez votre fichier ROM et chargez-le dans le navigateur (utilisez une ROM <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> avec une extension .smc ou .sfc)</li>'
				. '<li>Sélectionnez les <a href="/fr/options">' . __('navigation.options') . '</a> pour déterminer de quelle façon le jeu sera randomisé</li>'
				. '<li>Cliquez sur ' . __('randomizer.generate.casual') . '</li>'
				. '<li>Ensuite, sauvegardez votre rom et commencez à jouer</li>'
			. '</ol>',
	],
	'info' => [
		'logic' => __('randomizer.logic.title'),
		'build' => 'Création de ROM',
		'difficulty' => __('randomizer.difficulty.title'),
		'variation' => __('randomizer.variation.title'),
		'shuffle' => __('entrance.shuffle.title'),
		'mode' => __('randomizer.mode.title'),
		'weapons' => __('randomizer.weapons.title'),
		'goal' => __('randomizer.goal.title'),
		'permalink' => 'Lien permanent',
		'special' => 'Spécial',
		'notes' => 'Remarques',
		'generated' => 'Créé',
	],
	'settings' => [
		'heart_speed' => 'Bip de vie faible',
		'heart_speeds' => [
			'off' => 'Éteint',
			'double' => 'Vitesse Double',
			'normal' => 'Vitesse Normale',
			'half' => 'Moitié de Vitesse',
			'quarter' => 'Quart de Vitesse',
		],
		'menu_speed' => 'Vitesse du menu',
		'menu_speeds' => [
			'instant' => 'Immédiat',
			'fast' => 'Rapide',
			'normal' => 'Normal',
			'slow' => 'Lent',
		],
		'heart_color' => 'Couleur des coeurs',
		'heart_colors' => [
			'blue' => 'Bleu',
			'green' => 'Vert',
			'red' => 'Rouge',
			'yellow' => 'Jaune',
		],
		'play_as' => 'Jouer en tant que',
		'music' => 'Musique de fond',
		'music_info' => '(définie sur "Non" pour <a href="https://alttprlinks.page.link/SjiP" target="_blank" rel="noopener noreferrer">le support MSU-1</a>)',
		'quickswap' => 'Changement rapide d’objets',
		'race_warning' => 'Ne fonctionne pas dans les ROMs de course',
	],
];
