<?php
return [
	'header' => 'What is the Entrance Randomizer?',
	'subheader' => 'The Entrance Randomizer allows you to twist the world upside down and play the game. It should mostly follow the standard VT rules for settings on everything, but it introduces a new option “' . __('entrance.shuffle.title') . '”.',
	'cards' => [
		'simple' => [
			'header' => __('entrance.shuffle.options.simple'),
			'content' => [
				'Shuffles dungeon entrances between each other and keeps all 4-entrance dungeons confined to one location such that dungeons will one to one swap with each other.',
				'Other than on Light World Death Mountain, interiors are shuffled but still connect the same points on the overworld. On Death Mountain, entrances are connected more freely.',
			],
		],
		'restricted' => [
			'header' => __('entrance.shuffle.options.restricted'),
			'content' => [
				'Uses dungeon shuffling from Simple but freely connects remaining entrances. Caves and dungeons with multiple entrances will be confined to one world.',
			],
		],
		'full' => [
			'header' => __('entrance.shuffle.options.full'),
			'content' => [
				'Mixes cave and dungeon entrances freely. Caves and dungeons with multiple entrances will be confined to one world.',
			],
		],
		'crossed' => [
			'header' => __('entrance.shuffle.options.crossed'),
			'content' => [
				'Mixes cave and dungeon entrances freely, but now connector caves and dungeons can link Light World and Dark World.',
			],
		],
		'insanity' => [
			'header' => __('entrance.shuffle.options.insanity'),
			'content' => [
				'Decouples entrances and exits from each other and shuffles them freely. Caves that were single entrance in vanilla still can only exit to the same location from which they were entered.',
			],
		],
	],
];
