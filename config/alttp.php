<?php

return [
	'normal' => [
	],
	'triforcepieces' => [
		'item' => [
			'count' => [
				'TriforcePiece' => 12,
				'TwentyRupees' => 16,
			],
			'Goal' => [
				'Required' => 10,
				'Icon' => 'triforce',
			],
		],
	],
	'freerange' => [
		'rom' => [
			'mapOnPickup' => true,
			'compassOnPickup' => true,
		],
		'region' => [
			'mapsInDungeons' => false,
			'compassesInDungeons' => false,
		],
	],
	'timed' => [
		'item' => [
			'count' => [
				'TwentyRupees' => 0, // 28 : 560
				'OneRupee' => 0, // 2 : 2
				'FiveRupees' => 0, // 4 : 20
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
		'rom' => [
			'timerMode' => 'countdown-stop',
			'timerStart' => 45 * 60,
		],
	],
	'ohko' => [
		'rom' => [
			'timerMode' => 'countdown-ohko',
			'timerStart' => 0,
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
				'SilverArrowUpgrade' => 1,
			],
		],
		'rom' => [
			'HardMode' => 1,
		],
	],
	'expert' => [
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
			],
		],
		'rom' => [
			'HardMode' => 2,
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
