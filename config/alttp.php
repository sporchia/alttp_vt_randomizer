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
			],
			'overflow' => [
				'Armor' => 'TwentyRupees',
				'Bottle' => 'TwentyRupees',
				'Shield' => 'TwentyRupees',
				'Sword' => 'TwentyRupees',
			],
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
			'ohko' => [
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'triforce-hunt' => [
				'item' => [
					'count' => [
						'TriforcePiece' => 30,
						'TwentyRupees' => 2,
						'FiveRupees' => 0,
					],
					'overflow' => [
						'replacement' => [
							'Armor' => 'TriforcePiece',
							'Bottle' => 'TriforcePiece',
							'Shield' => 'TriforcePiece',
							'Sword' => 'TriforcePiece',
						],
					],
					'Goal' => [
						'Required' => 10,
						'Icon' => 'triforce',
					],
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
			'ohko' => [
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'triforce-hunt' => [
				'item' => [
					'count' => [
						'TriforcePiece' => 30,
						'TwentyRupees' => 2,
						'FiveRupees' => 0,
					],
					'Goal' => [
						'Required' => 20,
						'Icon' => 'triforce',
					],
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
			'ohko' => [
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'triforce-hunt' => [
				'item' => [
					'count' => [
						'TriforcePiece' => 40,
						'FiveRupees' => 5,
						'Arrow' => 1,
						'Bomb' => 11,
					],
					'Goal' => [
						'Required' => 30,
						'Icon' => 'triforce',
					],
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
			'ohko' => [
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'triforce-hunt' => [
				'item' => [
					'count' => [
						'Arrow' => 5,
						'Bomb' => 23,
						'FiveRupees' => 5,
						'TriforcePiece' => 40,
					],
					'Goal' => [
						'Required' => 40,
						'Icon' => 'triforce',
					],
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
			'ohko' => [
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'triforce-hunt' => [
				'item' => [
					'count' => [
						'Arrow' => 1,
						'Bomb' => 4,
						'FiveRupees' => 0,
						'TriforcePiece' => 50,
					],
					'Goal' => [
						'Required' => 50,
						'Icon' => 'triforce',
					],
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
	'sprites' => [
		'link.1.spr' => 'Link',
		'4slink-armors.1.spr' => 'Four Swords Link',
		'boo.2.spr' => 'Boo',
		'boy.2.spr' => 'Boy',
		'cactuar.1.spr' => 'Cactuar',
		'cat.1.spr' => 'Cat',
		'catboo.1.spr' => 'Cat Boo',
		'cirno.1.spr' => 'Cirno',
		'darkboy.2.spr' => 'Dark Boy',
		'darkgirl.1.spr' => 'Dark Girl',
		'darklink.1.spr' => 'Dark Link',
		'shadowsaku.1.spr' => 'Dark Maple Queen',
		'darkswatchy.1.spr' => 'Dark Swatchy',
		'darkzelda.1.spr' => 'Dark Zelda',
		'darkzora.2.spr' => 'Dark Zora',
		'decidueye.1.spr' => 'Decidueye',
		'demonlink.1.spr' => 'Demon Link',
		'froglink.2.spr' => 'Frog',
		'ganondorf.1.spr' => 'Ganondorf',
		'garfield.1.spr' => 'Garfield',
		'girl.2.spr' => 'Girl',
		'headlesslink.1.spr' => 'Headless Link',
		'invisibleman.1.spr' => 'Invisible Man',
		'inkling.1.spr' => 'Inkling',
		'kirby-meta.2.spr' => 'Kirby',
		'kore8.1.spr' => 'Kore8',
		'littlepony.1.spr' => 'Pony',
		'luigi.1.spr' => 'Luigi',
		'maiden.2.spr' => 'Maiden',
		'maplequeen.1.spr' => 'Maple Queen',
		'mario-classic.1.spr' => 'Mario',
		'marisa.1.spr' => 'Marisa',
		'mikejones.2.spr' => 'Mike Jones',
		'minishcaplink.3.spr' => 'Minish Cap Link',
		'modernlink.1.spr' => 'Modern Link',
		'mog.1.spr' => 'Mog',
		'mouse.1.spr' => 'Mouse',
		'naturelink.1.spr' => 'Nature Link',
		'negativelink.1.spr' => 'Negative Link',
		'neonlink.1.spr' => 'Neon Link',
		'oldman.1.spr' => 'Old Man',
		'pinkribbonlink.1.spr' => 'Pink Ribbon Link',
		'popoi.1.spr' => 'Popoi',
		'pug.2.spr' => 'Pug',
		'purplechest-bottle.2.spr' => 'Purple Chest',
		'roykoopa.1.spr' => 'Roy Koopa',
		'rumia.1.spr' => 'Rumia',
		'samus.4.spr' => 'Samus',
		'sodacan.1.spr' => 'Soda Can',
		'staticlink.1.spr' => 'Static Link',
		'santalink.1.spr' => 'Santa Link',
		'superbunny.1.spr' => 'Super Bunny',
		'swatchy.1.spr' => 'Swatchy',
		'tingle.1.spr' => 'Tingle',
		'toad.1.spr' => 'Toad',
		'valeera.1.spr' => 'Valeera',
		'vitreous.1.spr' => 'Vitreous',
		'vivi.1.spr' => 'Vivi',
		'will.1.spr' => 'Will',
		'wizzrobe.4.spr' => 'Wizzrobe',
		'yunica.1.spr' => 'Yunica',
		'zelda.2.spr' => 'Zelda',
		'zerosuitsamus.1.spr' => 'Zero Suit Samus',
		'zora.1.spr' => 'Zora',
	],
	'randomizer' => [
		'entrance' => [
			'difficulties' => [
				'normal' => 'Normal',
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
				'triforce-hunt' => 'Triforce Piece Hunt',
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
				'triforce-hunt' => 'Triforce Piece Hunt',
				'key-sanity' => 'Key-sanity',
			],
		],
	],
	'base_rom' => [
		'rom_hash' => ALttP\Rom::HASH,
		'base_file' => elixir('js/base2current.json'),
	],
];
