<?php

return [
	'v7' => [
		'output' => [
			'file' => [
				'name' => 'ALttP - VT_%s_v7_%s.sfc',
				'spoiler' => 'ALttP - VT_%s_v7_%s.txt',
			],
		],
		'item' => [
			'count' => [
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade70' => 1,
				'BombUpgrade10' => 0,
				'BombUpgrade5' => 0,
				'BombUpgrade50' => 1,
				'TenArrows' => 11,
				'ThreeBombs' => 17,
				'TwentyRupees' => 24,
			],
		],
		'prize' => [
			'crossWorld' => false,
		],
		'region' => [
			'bossHaveKey' => false,
		],
		'spoil' => [
			'BootsLocation' => false,
		],
	],
	'v7_hard' => [
		'output' => [
			'file' => [
				'name' => 'alttp (hard) - VT_%s_v7_%s.sfc',
				'spoiler' => 'alttp (hard) - VT_%s_v7_%s.txt',
			],
		],
		'item' => [
			'count' => [
				'Arrow' => 10,
				'ArrowUpgrade10' => 0,
				'ArrowUpgrade5' => 0,
				'ArrowUpgrade70' => 0,
				'BlueMail' => 0,
				'Bomb' => 5,
				'BombUpgrade10' => 0,
				'BombUpgrade5' => 0,
				'BombUpgrade50' => 0,
				'Boomerang' => 0,
				'BossHeartContainer' => 5,
				'BugCatchingNet' => 0,
				'ExtraBottles' => 0,
				'HeartContainer' => 0,
				'MirrorShield' => 0,
				'OneHundredRupees' => 2,
				'PieceOfHeart' => 12,
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
			'crossWorld' => false,
		],
		'region' => [
			'bossHaveKey' => false,
		],
		'spoil' => [
			'BootsLocation' => false,
		],
	],
	'v8' => [
		'output' => [
			'file' => [
				'name' => 'alttp - VT_%s_v8_%s.sfc',
				'spoiler' => 'alttp - VT_%s_v8_%s.txt',
			],
		],
		'item' => [
			'count' => [
				'ArrowUpgrade10' => 1,
				'ArrowUpgrade5' => 6,
				'ArrowUpgrade70' => 0,
				'BombUpgrade10' => 1,
				'BombUpgrade5' => 6,
				'BombUpgrade50' => 0,
				'TenArrows' => 7,
				'ThreeBombs' => 12,
				'TwentyRupees' => 23,
			],
		],
		'prize' => [
			'crossWorld' => true,
		],
		'region' => [
			'bossNormalLocation' => true,
		],
		'spoil' => [
			'BootsLocation' => true,
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
		],
		'spoil' => [
			'BootsLocation' => false,
		],
	],
];
