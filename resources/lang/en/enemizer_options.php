<?php
return [
	'header' => 'What is the Enemizer?',
	'subheader' => 'The Enemizer allows you to randomize the enemies and bosses in the game as well as some other options for alternate shuffling.',
	'cards' => [
		'enemy_health' => [
			'header' => __('enemizer.enemy_health.title'),
			'sections' => [
				[
					'header' => __('enemizer.enemy_health.options.0'),
					'content' => [
						'Enemy Health will not be randomized in any way.',
					],
				],
				[
					'header' => __('enemizer.enemy_health.options.1'),
					'content' => [
						'All enemy health will be in the 1-4 hp range.',
					],
				],
				[
					'header' => __('enemizer.enemy_health.options.2'),
					'content' => [
						'All enemy health will be in the 2-15 hp range.',
					],
				],
				[
					'header' => __('enemizer.enemy_health.options.3'),
					'content' => [
						'All enemy health will be in the 2-30 hp range.',
					],
				],
				[
					'header' => __('enemizer.enemy_health.options.4'),
					'content' => [
						'All enemy health will be in the 4-50 hp range.',
					],
				],
			],
		],
		'enemy_damage' => [
			'header' => __('enemizer.enemy_damage.title'),
			'sections' => [
				[
					'header' => __('enemizer.enemy_damage.options.off'),
					'content' => [
						'Enemy damage will not be randomized in any way.',
					],
				],
				[
					'header' => __('enemizer.enemy_damage.options.shuffle'),
					'content' => [
						'The damage enemies do will be shuffled.',
					],
				],
				[
					'header' => __('enemizer.enemy_damage.options.chaos'),
					'content' => [
						'The damage enemies do will be completely randomized.',
					],
				],
			],
		],
		'bosses' => [
			'header' => __('enemizer.bosses.title'),
			'sections' => [
				[
					'header' => __('enemizer.bosses.options.off'),
					'content' => [
						'Bosses will not be randomized in any way.',
					],
				],
				[
					'header' => __('enemizer.bosses.options.basic'),
					'content' => [
						'The normal number of each boss shuffled in their different locations, so expect to see armos knights, lanmolas, and moldorm twice.',
					],
				],
				[
					'header' => __('enemizer.bosses.options.normal'),
					'content' => [
						'Similar to ' . __('enemizer.bosses.options.basic') . ', except that 3 bosses are chosen at random to be seen twice.',
					],
				],
				[
					'header' => __('enemizer.bosses.options.chaos'),
					'content' => [
						'All bosses chosen at random, you may see any boss multiple times as well as not see a boss at all.',
					],
				],
			],
		],
		'enemy_shuffle' => [
			'header' => __('enemizer.enemy_shuffle'),
			'content' => [
				'This mixes up all the enemies in dungeons and on the overworld.',
			],
		],
		'pot_shuffle' => [
			'header' => __('enemizer.pot_shuffle'),
			'content' => [
				'Shuffles the contents under pots to keep you guessing where keys and other consumables are.',
			],
		],
		'palette_shuffle' => [
			'header' => __('enemizer.palette_shuffle'),
			'content' => [
				'Shuffles the colors of the game around, an Enemizer staple.',
			],
		],
	],
];
