<?php

return [
	'easy' => [
		'item' => [
			'count' => [
				'MasterSword' => 2,
				'L3Sword' => 3,
				'L4Sword' => 2,
				'BlueShield' => 2,
				'RedShield' => 2,
				'MirrorShield' => 2,
				'BlueMail' => 2,
				'RedMail' => 2,
				'ExtraBottles' => 7,
				'TwentyRupees' => 15,
			],
			'overflow' => [
				'Armor' => 'TwentyRupees',
				'Bottle' => 'TwentyRupees',
				'Shield' => 'TwentyRupees',
				'Sword' => 'TwentyRupees',
			],
		],
		'variations' => [
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
						'OneHundredRupees' => 3, // 1 : + 200
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
				'Bomb' => 10,
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
						'TwentyRupees' => 0, // 28 : 560
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 5, // 4 + 300
						'Arrow' => 1,
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
				'Arrow' => 10,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade70' => 0,
				'Bomb' => 10,
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
						'Bomb' => 5,
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
		'item' => [
			'progressiveArmor' => false,
			'progressiveGloves' => false,
			'progressiveShields' => false,
			'progressiveSwords' => false,
		],
		'prize' => [
			'crossWorld' => false,
			'shufflePendants' => false,
			'shuffleCrystals' => false,
		],
		'region' => [
			'bossNormalLocation' => false,
			'swordShuffle' => false,
			'swordsInPool' => false,
			'pyramidBowUpgrade' => false,
			'CompassesMaps' => false,
			'bossHeartsInPool' => false,
			'bossHaveKey' => false,
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
		'catboo.1.spr' => 'Cat Boo',
		'darkboy.2.spr' => 'Dark Boy',
		'darkgirl.1.spr' => 'Dark Girl',
		'darklink.1.spr' => 'Dark Link',
		'darkswatchy.1.spr' => 'Dark Swatchy',
		'darkzelda.1.spr' => 'Dark Zelda',
		'darkzora.2.spr' => 'Dark Zora',
		'decidueye.1.spr' => 'Decidueye',
		'demonlink.1.spr' => 'Demon Link',
		'froglink.2.spr' => 'Frog',
		'girl.2.spr' => 'Girl',
		'invisibleman.1.spr' => 'Invisible Man',
		'kirby-meta.1.spr' => 'Kirby',
		'littlepony.1.spr' => 'Pony',
		'maiden.1.spr' => 'Maiden',
		'maplequeen.1.spr' => 'Maple Queen',
		'marisa.1.spr' => 'Marisa',
		'mikejones.2.spr' => 'Mike Jones',
		'minishcaplink.2.spr' => 'Minish Cap Link',
		'mog.1.spr' => 'Mog',
		'oldman.1.spr' => 'Old Man',
		'purplechest-bottle.2.spr' => 'Purple Chest',
		'roykoopa.1.spr' => 'Roy Koopa',
		'rumia.1.spr' => 'Rumia',
		'samus.4.spr' => 'Samus',
		'santalink.1.spr' => 'Santa Link',
		'superbunny.1.spr' => 'Super Bunny',
		'swatchy.1.spr' => 'Swatchy',
		'toad.1.spr' => 'Toad',
		'wizzrobe.4.spr' => 'Wizzrobe',
		'zelda.2.spr' => 'Zelda',
		'zora.1.spr' => 'Zora',
	],
];
