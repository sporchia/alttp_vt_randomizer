<?php

return [
	'v8' => [
		'output' => [
			'file' => [
				'name' => 'alttp - VT_%s_v8_%s.sfc',
				'spoiler' => 'alttp - VT_%s_v8_%s.txt',
			],
		],
		'item' => [
			'count' => [
				'ArrowUpgrade5' => 6,
				'ArrowUpgrade10' => 1,
				'ArrowUpgrade70' => 0,
				'BombUpgrade5' => 6,
				'BombUpgrade10' => 1,
				'BombUpgrade50' => 0,
				'SilverArrowUpgrade' => 1,
				'TwentyRupees' => 27,
			],
		],
		'prize' => [
			'crossWorld' => true,
		],
		'region' => [
			'bossNormalLocation' => true,
			'superBunnyDM' => false,
			'bonkItems' => true,
		],
		'spoil' => [
			'BootsLocation' => true,
		],
	],
	'v8_hard' => [
		'output' => [
			'file' => [
				'name' => 'alttp (hard) - VT_%s_v8_%s.sfc',
				'spoiler' => 'alttp (hard) - VT_%s_v8_%s.txt',
			],
		],
		'item' => [
			'count' => [
				'Arrow' => 10,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade70' => 0,
				'BlueMail' => 0,
				'BlueShield' => 0,
				'Bomb' => 5,
				'BombUpgrade5' => 0,
				'BombUpgrade10' => 0,
				'BombUpgrade50' => 0,
				'Boomerang' => 0,
				'BossHeartContainer' => 0,
				'BugCatchingNet' => 0,
				'ExtraBottles' => 0,
				'HeartContainer' => 0,
				'MagicUpgrade' => 0,
				'MirrorShield' => 0,
				'OneHundredRupees' => 2,
				'PieceOfHeart' => 16,
				'RedBoomerang' => 0,
				'RedMail' => 0,
				'RedShield' => 0,
				'StaffOfByrna' => 0,
				'TenArrows' => 1,
				'ThreeBombs' => 2,
				'ThreeHundredRupees' => 1,
				'TwentyRupees' => 5,
			],
		],
		'prize' => [
			'crossWorld' => true,
		],
		'region' => [
			'bossNormalLocation' => true,
			'CompassesMaps' => false,
			'superBunnyDM' => false,
			'bonkItems' => true,
			'RedMailByrnaCave' => true,
		],
		'rom' => [
			'HardMode' => true,
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
			'CompassesMaps' => false,
			'bossHeartsInPool' => false,
			'bossHaveKey' => false,
			'superBunnyDM' => false,
			'bonkItems' => false,
			'RedMailByrnaCave' => false, // this is for hard mode
		],
		'rom' => [
			'HardMode' => false,
		],
		'spoil' => [
			'BootsLocation' => false,
		],
		'sprite' => [
			'shufflePrizePack' => false,
		],
	],
];
