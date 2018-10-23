<?php
return [
	'title' => 'Item Randomizer',
	'switch' => [
		'entrance' => 'Switch to Entrance Randomizer',
	],
	'difficulty' => [
		'title' => 'Difficulty',
		'options' => [
			'easy' => 'Easy',
			'normal' => 'Normal',
			'hard' => 'Hard',
			'expert' => 'Expert',
			'insane' => 'Insane',
		],
	],
	'difficulty_adjustments' => [
		'title' => 'Difficulty “Fixes”',
		'options' => [
			-1 => 'Easy',
			0 => 'Normal',
			1 => 'Hard',
			2 => 'Expert',
			3 => 'Insane',
		],
	],
	'goal' => [
		'title' => 'Goal',
		'options' => [
			'ganon' => 'Defeat Ganon',
			'dungeons' => 'All Dungeons',
			'pedestal' => 'Master Sword Pedestal',
			'triforce-hunt' => 'Triforce Pieces',
		],
	],
	'logic' => [
		'title' => 'Logic',
		'options' => [
			'NoGlitches' => 'No Glitches',
			'OverworldGlitches' => 'Overworld Glitches',
			'MajorGlitches' => 'Major Glitches',
			'None' => 'None (I know what I’m doing)',
		],
		'glitch_warning' => 'This Logic requires knowledge of Major Glitches<sup>**</sup>',
	],
	'mode' => [
		'title' => 'State',
		'options' => [
			'standard' => 'Standard',
			'open' => 'Open',
			'inverted' => 'Inverted',
		],
	],
	'weapons' => [
		'title' => 'Swords',
		'options' => [
			'randomized' => 'Randomized',
			'uncle' => 'Uncle Assured',
			'swordless' => 'Swordless',
		],
	],
	'variation' => [
		'title' => 'Variation',
		'options' => [
			'none' => 'None',
			'timed-race' => 'Timed Race',
			'timed-ohko' => 'Timed OHKO',
			'ohko' => 'OHKO',
			'key-sanity' => 'Keysanity',
			'retro' => 'Retro',
		],
		'ohko_enemizer_warning' => 'OHKO may not be completable with Enemizer enabled<sup>**</sup>',
	],
	'generate' => [
		'race' => 'Generate Race ROM',
		'race_warning' => 'Spoilers will <span class="running-now">never</span> be available for this option.',
		'spoiler_race' => 'Spoiler Race ROM',
		'casual' => 'Generate ROM',
		'back' => 'Change Settings',
		'regenerate' => 'Generate Again',
		'regenerate_tooltip' => 'Generate new game with same settings',
		'generating' => 'Generating...',
	],
	'details' => [
		'title' => 'Game Details',
		'save_spoiler' => 'Save Spoiler',
		'save_rom' => 'Save Rom',
	],
];
