<?php

return [
	'normal' => [
		'region' => [
			'superBunnyDM' => false,
		],
		'spoil' => [
			'BootsLocation' => true,
		],
	],
	'timed' => [
		'item' => [
			'count' => [
				'TwentyRupees' => 0, // 28 : 560
				'OneRupee' => 0, // 2 : 2
				'FiveRupees' => 0, // 4 : 200
				'ThreeBombs' => 0, // 10
				'OneHundredRupees' => 3, // 1 : + 200
				'ThreeHundredRupees' => 6, // 4 + 600
				'GreenClock' => 25,
				'RedClock' => 15,
			],
			'value' => [
				'GreenClock' => 300,
				'RedClock' => -150,
				'BombUpgrade5' => 2,
				'BombUpgrade10' => 3,
			],
		],
		'region' => [
			'superBunnyDM' => false,
		],
		'rom' => [
			'timerMode' => 'countdown-stop',
			'timerStart' => 45 * 60,
		],
		'spoil' => [
			'BootsLocation' => true,
		],
	],
	'timed-race' => [
		'item' => [
			'count' => [
				'TwentyRupees' => 0, // 28 : 560
				'OneRupee' => 0, // 2 : 2
				'FiveRupees' => 0, // 4 : 200
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
		'region' => [
			'superBunnyDM' => false,
		],
		'rom' => [
			'timerMode' => 'stopwatch',
			'timerStart' => 0,
		],
		'spoil' => [
			'BootsLocation' => true,
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
				'ExtraBottles' => 1,
				'OneRupee' => 5,
				'FiveRupees' => 25,
				'FiftyRupees' => 5,
				'HeartContainer' => 0,
				'MagicUpgrade' => 0,
				'MirrorShield' => 0,
				'OneHundredRupees' => 3,
				'RedBoomerang' => 0,
				'RedMail' => 0,
				'CaneOfByrna' => 0,
				'TenArrows' => 5,
				'ThreeBombs' => 5,
				'ThreeHundredRupees' => 1,
				'TwentyRupees' => 10,
				'L4Sword' => 0,
				'SilverArrowUpgrade' => 0,
				'Rupoor' => 20,
			],
		],
		'region' => [
			'CompassesMaps' => false,
			'superBunnyDM' => false,
		],
		'rom' => [
			'HardMode' => 1,
		],
		'spoil' => [
			'BootsLocation' => false,
		],
	],
	'masochist' => [
		'item' => [
			'count' => [
				'Arrow' => 10,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade70' => 0,
				'BlueMail' => 0,
				'BlueShield' => 0,
				'Bomb' => 10,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BombUpgrade50' => 0,
				'Boomerang' => 0,
				'BossHeartContainer' => 0,
				'BugCatchingNet' => 0,
				'ExtraBottles' => 0,
				'OneRupee' => 5,
				'FiveRupees' => 25,
				'FiftyRupees' => 3,
				'HeartContainer' => 0,
				'MagicUpgrade' => 0,
				'MirrorShield' => 0,
				'OneHundredRupees' => 1,
				'PieceOfHeart' => 12,
				'RedBoomerang' => 0,
				'RedMail' => 0,
				'RedShield' => 0,
				'CaneOfByrna' => 0,
				'TenArrows' => 1,
				'ThreeBombs' => 1,
				'ThreeHundredRupees' => 1,
				'TwentyRupees' => 5,
				'L3Sword' => 0,
				'L4Sword' => 0,
				'SilverArrowUpgrade' => 0,
				'Rupoor' => 20,
			],
		],
		'region' => [
			'CompassesMaps' => false,
			'superBunnyDM' => false,
		],
		'rom' => [
			'HardMode' => 2,
		],
		'spoil' => [
			'BootsLocation' => false,
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
			'swordShuffle' => false,
			'swordsInPool' => false,
			'pyramidBowUpgrade' => false,
			'CompassesMaps' => false,
			'bossHeartsInPool' => false,
			'bossHaveKey' => false,
			'superBunnyDM' => false,
			'bonkItems' => false,
		],
		'rom' => [
			'HardMode' => 0,
		],
		'spoil' => [
			'BootsLocation' => false,
		],
		'sprite' => [
			'shufflePrizePack' => false,
		],
	],
];
