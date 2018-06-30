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
				'HalfMagic' => 2,
				'Lamp' => 3,
				'FiveRupees' => 2,
				'Arrow' => 0,
				'SilverArrowUpgrade' => 2,
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
			'requireBetterBow' => true,
			'requireBetterSword' => true,
		],
		'rom' => [
			'compassOnPickup' => 'on',
			'HardMode' => -1,
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
					'freeItemMenu' => 0x0F,
				],
			],
			'retro' => [
				'region' => [
					'takeAnys' => true,
					'wildKeys' => true,
				],
				'rom' => [
					'genericKeys' => true,
					'rupeeBow' => true,
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
						'TwentyRupees' => 0,
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
						'TwentyRupees' => 0,
						'OneRupee' => 0,
						'FiveRupees' => 0,
						'ThreeBombs' => 0,
						'FiftyRupees' => 5,
						'OneHundredRupees' => 3,
						'ThreeHundredRupees' => 6,
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
					'freeItemMenu' => 0x0F,
				],
			],
			'retro' => [
				'item' => [
					'count' => [
						'KeyA2' => 0,
						'KeyD1' => 0,
						'TwentyRupees' => 38,
					],
				],
				'region' => [
					'takeAnys' => true,
					'wildKeys' => true,
				],
				'rom' => [
					'genericKeys' => true,
					'rupeeBow' => true,
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
						'TwentyRupees' => 0,
						'OneHundredRupees' => 4,
						'ThreeHundredRupees' => 5,
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
						'TwentyRupees' => 0,
						'OneRupee' => 0,
						'FiveRupees' => 0,
						'ThreeBombs' => 0,
						'OneHundredRupees' => 3,
						'ThreeHundredRupees' => 6,
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
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BossHeartContainer' => 6,
				'HeartContainer' => 0,
				'HalfMagic' => 0,
				'QuarterMagic' => 0,
				'SilverArrowUpgrade' => 1,
				'PieceOfHeart' => 20,
				'FiveRupees' => 28,
			],
			'overflow' => [
				'count' => [
					'Armor' => 1,
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
					'freeItemMenu' => 0x0F,
				],
			],
			'retro' => [
				'item' => [
					'count' => [
						'FiveRupees' => 43,
						'KeyA2' => 0,
						'KeyD1' => 0,
						'KeyD7' => 0,
						'KeyP3' => 0,
					],
				],
				'region' => [
					'takeAnys' => true,
					'wildKeys' => true,
				],
				'rom' => [
					'genericKeys' => true,
					'rupeeBow' => true,
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
						'FiveRupees' => 7,
						'GreenClock' => 20,
						'RedClock' => 1,
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
					'timerStart' => 7.5 * 60,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'FiveRupees' => 0,
						'TwentyRupees' => 16,
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
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
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BossHeartContainer' => 1,
				'HeartContainer' => 0,
				'HalfMagic' => 0,
				'QuarterMagic' => 0,
				'PieceOfHeart' => 20,
				'SilverArrowUpgrade' => 1,
				'FiveRupees' => 33,
			],
			'overflow' => [
				'count' => [
					'Armor' => 0,
					'Shield' => 1,
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
					'freeItemMenu' => 0x0F,
				],
			],
			'retro' => [
				'item' => [
					'count' => [
						'FiveRupees' => 48,
						'KeyA2' => 0,
						'KeyD1' => 0,
						'KeyD7' => 0,
						'KeyP3' => 0,
					],
				],
				'region' => [
					'takeAnys' => true,
					'wildKeys' => true,
				],
				'rom' => [
					'genericKeys' => true,
					'rupeeBow' => true,
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
						'FiveRupees' => 15,
						'GreenClock' => 15,
						'RedClock' => 3,
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
						'FiveRupees' => 0,
						'TwentyRupees' => 21,
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
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
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BossHeartContainer' => 0,
				'HeartContainer' => 0,
				'HalfMagic' => 0,
				'QuarterMagic' => 0,
				'SilverArrowUpgrade' => 0,
				'PieceOfHeart' => 0,
				'FiveRupees' => 55,
			],
			'overflow' => [
				'count' => [
					'Armor' => 0,
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
					'freeItemMenu' => 0x0F,
				],
			],
			'retro' => [
				'item' => [
					'count' => [
						'FiveRupees' => 70,
						'KeyA2' => 0,
						'KeyD1' => 0,
						'KeyD7' => 0,
						'KeyP3' => 0,
					],
				],
				'region' => [
					'takeAnys' => true,
					'wildKeys' => true,
				],
				'rom' => [
					'genericKeys' => true,
					'rupeeBow' => true,
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
						'FiveRupees' => 40,
						'GreenClock' => 10,
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
					'timerStart' => 0,
				],
			],
			'timed-race' => [
				'item' => [
					'count' => [
						'FiveRupees' => 15,
						'GreenClock' => 20,
						'BlueClock' => 10,
						'RedClock' => 10,
					],
					'value' => [
						'GreenClock' => 240, // reversed for stopwatch
						'BlueClock' => 120,
						'RedClock' => -120,
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
				'crystals' => 'Crystals',
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
				'crossed' => 'Crossed',
				'insanity' => 'Insanity',
			],
			'variations' => [
				'none' => 'None',
				'timed-race' => 'Timed Race',
				'timed-ohko' => 'Timed OHKO',
				'ohko' => 'OHKO',
				'triforce-hunt' => 'Triforce Piece Hunt',
				'key-sanity' => 'Key-sanity',
				'retro' => 'Retro',
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
			],
			'weapons' => [
				'randomized' => 'Randomized',
				'uncle' => 'Uncle Assured',
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
				-1 => 'Easy',
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
				],
				'weapons' => [
					'randomized' => 30,
					'uncle' => 50,
					'swordless' => 20,
				],
				'variations' => [
					'none' => 69,
					'timed-race' => 0,
					'timed-ohko' => 5,
					'ohko' => 1,
					'key-sanity' => 15,
					'retro' => 15,
				],
			],
		],
	],
];
