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
			'star-hunt' => [
				'item' => [
					'count' => [
						'PowerStar' => 30,
						'TwentyRupees' => 2,
						'FiveRupees' => 0,
					],
					'overflow' => [
						'replacement' => [
							'Armor' => 'PowerStar',
							'Bottle' => 'PowerStar',
							'Shield' => 'PowerStar',
							'Sword' => 'PowerStar',
						],
					],
					'Goal' => [
						'Required' => 10,
						'Icon' => 'star',
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
						'GreenClock' => 300,
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
	'normal' => [
		'variations' => [
			'ohko' => [
				'rom' => [
					'timerMode' => 'countdown-ohko',
					'timerStart' => 0,
				],
			],
			'star-hunt' => [
				'item' => [
					'count' => [
						'PowerStar' => 30,
						'TwentyRupees' => 2,
						'FiveRupees' => 0,
					],
					'Goal' => [
						'Required' => 20,
						'Icon' => 'star',
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
						'GreenClock' => 300,
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
				'BossHeartContainer' => 0,
				'BugCatchingNet' => 0,
				'OneRupee' => 5,
				'FiveRupees' => 25,
				'FiftyRupees' => 5,
				'HeartContainer' => 0,
				'MagicUpgrade' => 0,
				'HalfMagicUpgrade' => 0,
				'QuarterMagicUpgrade' => 0,
				'OneHundredRupees' => 3,
				'RedBoomerang' => 0,
				'CaneOfByrna' => 0,
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
			'star-hunt' => [
				'item' => [
					'count' => [
						'PowerStar' => 40,
						'FiveRupees' => 5,
						'Arrow' => 5,
					],
					'Goal' => [
						'Required' => 30,
						'Icon' => 'star',
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
						'GreenClock' => 300,
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
				'BugCatchingNet' => 0,
				'OneRupee' => 5,
				'FiveRupees' => 25,
				'FiftyRupees' => 3,
				'HeartContainer' => 0,
				'HalfMagicUpgrade' => 0,
				'QuarterMagicUpgrade' => 0,
				'MagicUpgrade' => 0,
				'OneHundredRupees' => 1,
				'PieceOfHeart' => 12,
				'RedBoomerang' => 0,
				'CaneOfByrna' => 0,
				'TenArrows' => 1,
				'ThreeBombs' => 1,
				'ThreeHundredRupees' => 1,
				'TwentyRupees' => 5,
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
			'star-hunt' => [
				'item' => [
					'count' => [
						'Arrow' => 5,
						'Bomb' => 5,
						'FiveRupees' => 5,
						'PowerStar' => 40,
					],
					'Goal' => [
						'Required' => 40,
						'Icon' => 'star',
					],
				],
			],
			'timed-ohko' => [
				'item' => [
					'count' => [
						'TwentyRupees' => 10, // 28 : 560
						'OneHundredRupees' => 3, // 1 : + 200
						'ThreeHundredRupees' => 5, // 4 + 300
						'GreenClock' => 15,
					],
					'value' => [
						'GreenClock' => 300,
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
		'boo.2.spr' => 'Boo',
		'boy.2.spr' => 'Boy',
		'catboo.1.spr' => 'Cat Boo',
		'darklink.1.spr' => 'Dark Link',
		'decidueye.1.spr' => 'Decidueye',
		'demonlink.1.spr' => 'Demon Link',
		'froglink.2.spr' => 'Frog',
		'girl.2.spr' => 'Girl',
		'invisibleman.1.spr' => 'Invisible Man',
		'littlepony.1.spr' => 'Pony',
		'maplequeen.1.spr' => 'Maple Queen',
		'mikejones.1.spr' => 'Mike Jones',
		'minishcaplink.2.spr' => 'Minish Cap Link',
		'mog.1.spr' => 'Mog',
		'oldman.1.spr' => 'Old Man',
		'rumia.1.spr' => 'Rumia',
		'samus.3.spr' => 'Samus',
		'superbunny.1.spr' => 'Super Bunny',
		'swatchy.1.spr' => 'Swatchy',
		'toad.1.spr' => 'Toad',
		'wizzrobe.4.spr' => 'Wizzrobe',
		'zelda.1.spr' => 'Zelda',
		'zora.1.spr' => 'Zora',
	],
];
