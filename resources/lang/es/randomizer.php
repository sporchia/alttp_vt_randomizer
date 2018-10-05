<?php
return [
	'title' => 'Randomizer de Objetos',
	'switch' => [
		'entrance' => 'Cambiar a randomizer de entradas',
	],
	'difficulty' => [
		'title' => 'Dificultad',
		'options' => [
			'easy' => 'Fácil',
			'normal' => 'Normal',
			'hard' => 'Difícil',
			'expert' => 'Experto',
			'insane' => 'Locura',
		],
	],
	'difficulty_adjustments' => [
		'title' => 'Dificultad “Fixes”',
		'options' => [
			-1 => 'Fácil',
			0 => 'Normal',
			1 => 'Difícil',
			2 => 'Experto',
			3 => 'Locura',
		],
	],
	'goal' => [
		'title' => 'Objetivo',
		'options' => [
			'ganon' => 'Derrotar a Ganon',
			'dungeons' => 'Todas las mazmorras',
			'pedestal' => 'Pedestal de la Espada Maestra',
			'triforce-hunt' => 'Piezas de la Trifuerza',
		],
	],
	'logic' => [
		'title' => 'Lógica',
		'options' => [
			'NoGlitches' => 'Sin Glitches',
			'OverworldGlitches' => 'Glitches de la Superfície',
			'MajorGlitches' => 'Glitches Mayores',
			'None' => 'Ninguna (tranquilo, todo está controlado)',
		],
		'glitch_warning' => 'Esta Lógica require conocimiento de Glithes Mayores<sup>**</sup>',
	],
	'mode' => [
		'title' => 'Tipo',
		'options' => [
			'standard' => 'Estándar',
			'open' => 'Abierto',
			'inverted' => 'Inverso',
		],
	],
	'weapons' => [
		'title' => 'Espadas',
		'options' => [
			'randomized' => 'Randomizadas',
			'uncle' => 'Tío Asegurado',
			'swordless' => 'Sin Espadas',
		],
	],
	'variation' => [
		'title' => 'Variación',
		'options' => [
			'none' => 'Ninguna',
			'timed-race' => 'Carrera cronometrada',
			'timed-ohko' => 'Muerte Súbita cronometrada',
			'ohko' => 'Muerte Súbita',
			'key-sanity' => 'Keysanity',
			'retro' => 'Retro',
		],
	],
	'generate' => [
		'race' => 'Generar ROM para carreras',
		'race_warning' => '<span class="running-now">sin spoilers</span>',
		'spoiler_race' => 'Generar ROM para carreras (con spoilers)',
		'casual' => 'Generar ROM',
	],
	'details' => [
		'title' => 'Detalles del juego',
		'save_spoiler' => 'Guardar spoiler',
		'save_rom' => 'Guardar ROM',
	],
];
