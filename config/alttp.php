<?php

return [
	'easy' => [
		'item' => [
			'count' => [
				'ProgressiveSword' => 8,
				'ProgressiveShield' => 6,
				'ProgressiveArmor' => 4,
				'Bottles' => 8,
				'TwentyRupees' => 14,
				'HalfMagicUpgrade' => 2,
				'Lamp' => 3,
				'FiveRupees' => 2,
			],
			'overflow' => [
				'Armor' => 'TwentyRupees',
				'Bottle' => 'TwentyRupees',
				'Shield' => 'TwentyRupees',
				'Sword' => 'TwentyRupees',
			],
			'require' => [
				'Lamp' => 3,
			],
		],
		'region' => [
			'requireBetterEquipment' => true,
		],
		'rom' => [
			'compassOnPickup' => 'on',
		],
		'variations' => [
			'key-sanity' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
					'wildMaps' => true,
					'wildCompasses' => true,
				],
				'rom' => [
					'mapOnPickup' => true,
					'freeItemText' => true,
					'freeItemMenu' => true,
				],
			],
			'retro' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
				],
				'rom' => [
					'freeItemMenu' => true,
					'genericKeys' => true,
				],
			],
			'ohko' => [
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'timed-ohko' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneRupee' => 0,
						'FiftyRupees' => 5,
						'ThreeHundredRupees' => 7,
						'GreenClock' => 17,
					],
					'overflow' => [ // 13 things
						'replacement' => [
							'Armor' => 'GreenClock',
							'Bottle' => 'GreenClock',
							'Shield' => 'GreenClock',
							'Sword' => 'GreenClock',
						],
					],
					'value' => [
						'GreenClock' => 240,
					],
				],
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 20 * 60,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneRupee' => 0, // 2 : 2
						'FiveRupees' => 0, // 4 : 20
						'ThreeBombs' => 0, // 10
						'FiftyRupees' => 5,
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 6, // 4 + 600
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
						'BombUpgrade5' => 2,
						'BombUpgrade10' => 3,
					],
				],
				'rom' => [
					'timerMode' => 'stopwatch',
					'timerStart' => 0,
				],
			],
		],
	],
	'normal' => [
		'variations' => [
			'key-sanity' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
					'wildMaps' => true,
					'wildCompasses' => true,
				],
				'rom' => [
					'mapOnPickup' => true,
					'compassOnPickup' => 'pickup',
					'freeItemText' => true,
					'freeItemMenu' => true,
				],
			],
			'retro' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
				],
				'rom' => [
					'freeItemMenu' => true,
					'genericKeys' => true,
				],
			],
			'ohko' => [
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'timed-ohko' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneHundredRupees' => 4, // 1 : + 200
						'ThreeHundredRupees' => 5, // 4 + 300
						'GreenClock' => 25,
					],
					'value' => [
						'GreenClock' => 240,
					],
				],
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 10 * 60,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneRupee' => 0, // 2 : 2
						'FiveRupees' => 0, // 4 : 20
						'ThreeBombs' => 0, // 10
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 6, // 4 + 600
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
						'BombUpgrade5' => 2,
						'BombUpgrade10' => 3,
					],
				],
				'rom' => [
					'timerMode' => 'stopwatch',
					'timerStart' => 0,
				],
			],
		],
	],
	'hard' => [
		'item' => [
			'count' => [
				'Arrow' => 20,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade70' => 0,
				'Bomb' => 17,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BombUpgrade50' => 0,
				'Boomerang' => 0,
				'BossHeartContainer' => 5,
				'OneRupee' => 5,
				'FiveRupees' => 20,
				'FiftyRupees' => 5,
				'HeartContainer' => 0,
				'MagicUpgrade' => 0,
				'HalfMagicUpgrade' => 0,
				'QuarterMagicUpgrade' => 0,
				'OneHundredRupees' => 3,
				'RedBoomerang' => 0,
				'TenArrows' => 5,
				'ThreeBombs' => 5,
				'ThreeHundredRupees' => 1,
				'TwentyRupees' => 5,
				'SilverArrowUpgrade' => 1,
			],
			'overflow' => [
				'count' => [
					'Armor' => 1,
					'Bottle' => 2,
					'Shield' => 2,
					'Sword' => 3,
				],
			],
		],
		'rom' => [
			'HardMode' => 1,
		],
		'variations' => [
			'key-sanity' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
					'wildMaps' => true,
					'wildCompasses' => true,
				],
				'rom' => [
					'mapOnPickup' => true,
					'compassOnPickup' => 'pickup',
					'freeItemText' => true,
					'freeItemMenu' => true,
				],
			],
			'retro' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
				],
				'rom' => [
					'freeItemMenu' => true,
					'genericKeys' => true,
				],
			],
			'ohko' => [
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'timed-ohko' => [
				'item' => [
					'count' => [
						'OneRupee' => 12,
						'TwentyRupees' => 0, // 28 : 560
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 5, // 4 + 300
						'Arrow' => 1,
						'Bomb' => 10,
						'GreenClock' => 20,
					],
					'value' => [
						'GreenClock' => 240,
					],
				],
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 5 * 60,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneRupee' => 0, // 2 : 2
						'FiveRupees' => 0, // 4 : 20
						'ThreeBombs' => 0, // 10
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 6, // 4 + 600
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
						'Bomb' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
						'BombUpgrade5' => 2,
						'BombUpgrade10' => 3,
					],
				],
				'rom' => [
					'timerMode' => 'stopwatch',
					'timerStart' => 0,
				],
			],
		],
	],
	'expert' => [
		'item' => [
			'count' => [
				'Arrow' => 33,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade70' => 0,
				'Bomb' => 30,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BombUpgrade50' => 0,
				'Boomerang' => 0,
				'BossHeartContainer' => 0,
				'OneRupee' => 5,
				'FiveRupees' => 10,
				'FiftyRupees' => 4,
				'HeartContainer' => 0,
				'HalfMagicUpgrade' => 0,
				'QuarterMagicUpgrade' => 0,
				'MagicUpgrade' => 0,
				'OneHundredRupees' => 1,
				'RedBoomerang' => 0,
				'TenArrows' => 1,
				'ThreeBombs' => 1,
				'ThreeHundredRupees' => 1,
				'TwentyRupees' => 6,
				'SilverArrowUpgrade' => 0,
			],
			'overflow' => [
				'count' => [
					'Armor' => 0,
					'Bottle' => 1,
					'Shield' => 0,
					'Sword' => 2,
				],
			],
		],
		'rom' => [
			'HardMode' => 2,
		],
		'variations' => [
			'key-sanity' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
					'wildMaps' => true,
					'wildCompasses' => true,
				],
				'rom' => [
					'mapOnPickup' => true,
					'compassOnPickup' => 'pickup',
					'freeItemText' => true,
					'freeItemMenu' => true,
				],
			],
			'retro' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
				],
				'rom' => [
					'freeItemMenu' => true,
					'genericKeys' => true,
				],
			],
			'ohko' => [
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'timed-ohko' => [
				'item' => [
					'count' => [
						'OneRupee' => 13,
						'TwentyRupees' => 10, // 28 : 560
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 5, // 4 + 300
						'GreenClock' => 20,
						'RedClock' => 5,
					],
					'value' => [
						'GreenClock' => 240,
						'RedClock' => - 32400,
					],
				],
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 5 * 60,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneRupee' => 0, // 2 : 2
						'FiveRupees' => 0, // 4 : 20
						'ThreeBombs' => 0, // 10
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 6, // 4 + 600
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
						'BombUpgrade5' => 2,
						'BombUpgrade10' => 3,
					],
				],
				'rom' => [
					'timerMode' => 'stopwatch',
					'timerStart' => 0,
				],
			],
		],
	],
	'insane' => [
		'item' => [
			'count' => [
				'Arrow' => 30,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade70' => 0,
				'Bomb' => 25,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BombUpgrade50' => 0,
				'Boomerang' => 0,
				'BossHeartContainer' => 0,
				'OneRupee' => 30,
				'FiveRupees' => 10,
				'FiftyRupees' => 4,
				'HeartContainer' => 0,
				'HalfMagicUpgrade' => 0,
				'QuarterMagicUpgrade' => 0,
				'MagicUpgrade' => 0,
				'OneHundredRupees' => 4,
				'RedBoomerang' => 0,
				'TenArrows' => 1,
				'ThreeBombs' => 1,
				'ThreeHundredRupees' => 5,
				'TwentyRupees' => 6,
				'SilverArrowUpgrade' => 0,
				'PieceOfHeart' => 0,
			],
			'overflow' => [
				'count' => [
					'Armor' => 0,
					'Bottle' => 1,
					'Shield' => 0,
					'Sword' => 2,
				],
			],
		],
		'rom' => [
			'HardMode' => 3,
		],
		'variations' => [
			'key-sanity' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
					'wildMaps' => true,
					'wildCompasses' => true,
				],
				'rom' => [
					'mapOnPickup' => true,
					'compassOnPickup' => 'pickup',
					'freeItemText' => true,
					'freeItemMenu' => true,
				],
			],
			'retro' => [
				'region' => [
					'wildKeys' => true,
					'wildBigKeys' => true,
				],
				'rom' => [
					'freeItemMenu' => true,
					'genericKeys' => true,
				],
			],
			'ohko' => [
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'timed-ohko' => [
				'item' => [
					'count' => [
						'OneRupee' => 13,
						'TwentyRupees' => 10, // 28 : 560
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 5, // 4 + 300
						'GreenClock' => 20,
						'RedClock' => 5,
					],
					'value' => [
						'GreenClock' => 240,
						'RedClock' => - 32400,
					],
				],
				'region' => [
					'cantTakeDamage' => true,
				],
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 5 * 60,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 0, // 28 : 560
						'OneRupee' => 0, // 2 : 2
						'FiveRupees' => 0, // 4 : 20
						'ThreeBombs' => 0, // 10
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 6, // 4 + 600
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
						'BombUpgrade5' => 2,
						'BombUpgrade10' => 3,
					],
				],
				'rom' => [
					'timerMode' => 'stopwatch',
					'timerStart' => 0,
				],
			],
		],
	],
	'custom' => [
		'prize' => [
			'crossWorld' => false,
			'shufflePendants' => false,
			'shuffleCrystals' => false,
		],
		'region' => [
			'bossNormalLocation' => false,
			'pyramidBowUpgrade' => false,
			'bossHaveKey' => false,
			'forceUncleSword' => false,
			'forceSkullWoodsKey' => false,
			'wildKeys' => false,
			'wildBigKeys' => false,
			'wildMaps' => false,
			'wildCompasses' => false,
		],
		'rom' => [
			'HardMode' => 0,
		],
		'spoil' => [
			'BootsLocation' => false,
		],
		'sprite' => [
			'shufflePrizePack' => false,
			'shuffleOverworldBonkPrizes' => false,
		],
	],
	'vanilla' => [
		'prize' => [
			'crossWorld' => false,
			'shufflePendants' => false,
			'shuffleCrystals' => false,
		],
		'region' => [
			'swordsInPool' => false,
			'pyramidBowUpgrade' => true,
			'forceUncleSword' => true,
			'forceSkullWoodsKey' => true,
			'wildKeys' => false,
			'wildBigKeys' => false,
			'wildMaps' => false,
			'wildCompasses' => false,
		],
		'rom' => [
			'HardMode' => 0,
		],
		'sprite' => [
			'shufflePrizePack' => false,
			'shuffleOverworldBonkPrizes' => false,
		],
	],
	'goals' => [
		'triforce-hunt' => [
			'item' => [
				'count' => [
					'TriforcePiece' => 30,
				],
				'Goal' => [
					'Required' => 20,
					'Icon' => 'triforce',
				],
			],
		],
	],
	'randomizer' => [
		'entrance' => [
			'difficulties' => [
				'easy' => 'Easy',
				'normal' => 'Normal',
				'hard' => 'Hard',
				'expert' => 'Expert',
				'insane' => 'Insane',
			],
			'goals' => [
				'ganon' => 'Defeat Ganon',
				'dungeons' => 'All Dungeons',
				'pedestal' => 'Master Sword Pedestal',
				'triforce-hunt' => 'Triforce Pieces',
			],
			'logics' => [
				'NoMajorGlitches' => 'No Glitches',
			],
			'modes' => [
				'open' => 'Open',
				'swordless' => 'Swordless',
			],
			'shuffles' => [
				'simple' => 'Simple',
				'restricted' => 'Restricted',
				'full' => 'Full',
				'madness' => 'Madness',
				'insanity' => 'Insanity',
			],
			'variations' => [
				'none' => 'None',
				'timed-race' => 'Timed Race',
				'timed-ohko' => 'Timed OHKO',
				'ohko' => 'OHKO',
				'triforce-hunt' => 'Triforce Piece Hunt',
				'key-sanity' => 'Key-sanity',
			],
		],
		'item' => [
			'difficulties' => [
				'easy' => 'Easy',
				'normal' => 'Normal',
				'hard' => 'Hard',
				'expert' => 'Expert',
				'insane' => 'Insane',
			],
			'goals' => [
				'ganon' => 'Defeat Ganon',
				'dungeons' => 'All Dungeons',
				'pedestal' => 'Master Sword Pedestal',
				'triforce-hunt' => 'Triforce Pieces',
			],
			'logics' => [
				'NoMajorGlitches' => 'No Glitches',
				'OverworldGlitches' => 'Overworld Glitches',
				'MajorGlitches' => 'Major Glitches',
			],
			'modes' => [
				'standard' => 'Standard',
				'open' => 'Open',
				'swordless' => 'Swordless',
			],
			'variations' => [
				'none' => 'None',
				'timed-race' => 'Timed Race',
				'timed-ohko' => 'Timed OHKO',
				'ohko' => 'OHKO',
				'key-sanity' => 'Key-sanity',
				'retro' => 'Retro',
			],
			'difficulty_adjustments' => [
				0 => 'Normal',
				1 => 'Hard',
				2 => 'Expert',
				3 => 'Insane',
			],
		],
		'daily_weights' => [
			'item' => [
				'difficulties' => [
					'easy' => 20,
					'normal' => 60,
					'hard' => 10,
					'expert' => 7,
					'insane' => 3,
				],
				'goals' => [
					'ganon' => 60,
					'dungeons' => 10,
					'pedestal' => 20,
					'triforce-hunt' => 10,
				],
				'logics' => [
					'NoMajorGlitches' => 85,
					'OverworldGlitches' => 13,
					'MajorGlitches' => 2,
				],
				'modes' => [
					'standard' => 40,
					'open' => 40,
					'swordless' => 20,
				],
				'variations' => [
					'none' => 69,
					'timed-race' => 0,
					'timed-ohko' => 5,
					'ohko' => 1,
					'key-sanity' => 15,
				],
			],
		],
	],
];
