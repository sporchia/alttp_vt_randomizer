<?php
return [
	'header' => 'Options',
	'subheader' => 'There are many ways to play ALttP:Randomizer!',
	'cards' => [
		'mode' => [
			'header' => __('randomizer.mode.title'),
			'sections' => [
				[
					'header' => __('randomizer.mode.options.standard'),
					'content' => [
						'This mode is closest to the original game. You will start in Link’s bed, get a weapon from Uncle (depending on your Swords option, see below), and rescue Zelda before continuing with the rest of the game.',
					],
				],
				[
					'header' => __('randomizer.mode.options.open'),
					'content' => [
						'This mode starts with the option to start in your house or the sanctuary, and you are free to explore. There are a few point to note in this mode:',
						'<ul>'
							. '<li>Uncle is already in the sewers and has an item.</li>'
							. '<li>Dark rooms don’t get a free light cone, not even the sewers.</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.mode.options.inverted'),
					'content' => [
						'Tired of starting in the Light World and working your way to Ganon on top of Death Mountain? Well have we got the mode for you!',
						'Introducing inverted, the game state where we flip the game on its head just to really mess with things.',
						'This mode is really hard in the beginning so we really don’t suggest it for your first playthrough. Enemies in the Dark World hit like a truck, well a bunch of trucks really, and starting with 3 hearts is enough to get gone in a single hit or two',
						'But what does this all mean? Well we had to make some serious modifications to the game to have Link start in the Dark World and get to the light world to complete the game:',
						'<ul>'
							. '<li>Link’s house is now located in the place that the Bomb shop used to reside</li>'
							. '<li>The Bomb shop has been transported to the light world where Link’s house used to be</li>'
							. '<li>The ' . __('item.MagicMirror') . ' works in the Light World to take you back to the Dark World</li>'
							. '<li>The ' . __('item.OcarinaInactive') . ' only works in the Dark World, but you still have to find a way to activate it in the Light world</li>'
							. '<li>Lots of terrain in the Light World has been modified to allow you to get to those pesky ' . __('item.MagicMirror') . ' locations</li>'
							. '<li>The old man has decided to “get lost” in the Dark World. You’ll still have to return him to his cave in the Light World</li>'
							. '<li>Portals? All the ones you used to see in the Light World will be in the Dark World with the same requirements to use them</li>'
							. '<li>Agahnim has really gotten tired of his place in Hyrule Castle and decided to move on up to the Tower formally known as Ganon’s on Dark Death Mountain. No silly bat barrier to get in, oh and he added some stairs so you can get to East Dark Death Mountain or his place pretty quickly</li>'
							. '<li>Since Agahnim decided to move on up, that means Ganon’s Tower came on down to Hyrule Castle, that center door being in the entrance, you’ll still need those 7 crystals though</li>'
							. '<li>Ice Palace tore down the wall so you can swim there pretty early now</li>'
							. '<li>Remember a bunny can use the ' . __('item.BookOfMudora') . ' as well as talk to people, and collect items it sees lying on the ground</li>'
							. '<li>The top of Turtle Rock can be accessed by walking on it’s tail</li>'
						. '</ul>',
					],
				],
			],
		],
		'weapons' => [
			'header' => __('randomizer.weapons.title'),
			'sections' => [
				[
					'header' => __('randomizer.weapons.options.randomized'),
					'content' => [
						'All sword upgrades are randomized. You won’t start with a sword, and it might be a while before you find one. Bombs are a great early weapon, as are bushes and signs! Use whatever items you find to defend yourself.',
						'If this option is combined with Standard Mode (see above), your uncle will graciously give you one of the following items to ensure you can complete the escape sequence:',
						'<ul>'
							. '<li>Sword Upgrade (yes, it’s still possible)</li>'
							. '<li>Hammer</li>'
							. '<li>Bow + Full Arrow Refill</li>'
							. '<li>Full Bomb Refill</li>'
							. '<li>Fire Rod + Full Magic Refill</li>'
							. '<li>Cane of Somaria + Full Magic Refill</li>'
							. '<li>Cane of Byrna + Full Magic Refill</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.weapons.options.uncle'),
					'content' => [
						'Uncle always has a sword. The remaining upgrades are randomized.',
					],
				],
				[
					'header' => __('randomizer.weapons.options.swordless'),
					'content' => [
						'All swords are removed from the game. Because the game expects you to have a sword, the following changes are present only in swordless mode:',
						'<ul>'
							. '<li>Swords have been replaced with four copies of 20 rupees (a green rupee sprite with “20” on it).</li>'
							. '<li>The barrier blocking access to Agahnim’s Tower can be broken with the Hammer.</li>'
							. '<li>The curtains blocking progress in Agahnim’s Tower are pre-opened, as are the vines in Skull Woods.</li>'
							. '<li>Medallions can only be used to open Misery Mire or Turtle Rock, or to progress through Ice Palace. Normally, they require a sword to use.</li>'
							. '<li>Ganon now takes damage from the hammer.</li>'
							. '<li>Silver arrows are available in all difficulties.</li>'
							. '<li>Ether and Bombos tablets require the Hammer and Book of Mudora.</li>'
						. '</ul>',
					],
				],
			],
		],
		'logic' => [
			'header' => __('randomizer.logic.title'),
			'sections' => [
				[
					'header' => __('randomizer.logic.options.NoGlitches'),
					'content' => [
						'This mode requires no advanced knowledge of the game. It’s designed as if you were playing the original game for the first time.',
						'Under this mode, you’re prevented from getting stuck anywhere, regardless of how you use small keys within dungeons.',
						'You may be required to save and quit in certain situations, like getting back to the light world when you’re in the dark world without the mirror.',
					],
				],
				[
					'header' => __('randomizer.logic.options.OverworldGlitches'),
					'content' => [
						'This mode <span class="running-now">requires</span> some of the easier-to-execute overworld glitches. It’s more difficult than simply using fake flippers to visit the hobo! The two types of major glitches are required:',
						'<ul>'
							. '<li>Overworld boots clipping</li>'
							. '<li>Mirror clipping (DMD, TR Middle Clip, and Fluteless Mire)</li>'
						. '</ul>',
						'Most minor glitches are also accounted for:',
						'<ul>'
							. '<li>Fake Flippers (allows access to Ice Palace, King Zora, Lake Hylia Heart Piece, and Hobo without Flippers)</li>'
							. '<li>Dungeon Bunny Revival (allows access to Ice Palace without the Moon Pearl)</li>'
							. '<li>Overworld Bunny Revival (allows access to Misery Mire and Misery Mire shed without the Moon Pearl and without doing DMD)</li>'
							. '<li>Super Bunny (allows access to two chests in Dark World Death Mountain without the Moon Pearl)</li>'
							. '<li>Surfing Bunny (allows access to Lake Hylia Heart Piece without the Moon Pearl)</li>'
							. '<li>Walk on Water (allows access to Zora’s Domain Ledge Heart Piece without the Flippers)</li>'
						. '</ul>',
						'The following are NOT accounted for by the logic, so you’ll never be forced to do any:',
						'<ul>'
							. '<li>Bootless Clips</li>'
							. '<li>Mirror Screenwraps</li>'
							. '<li>Overworld YBAs</li>'
							. '<li>Underworld Clips</li>'
							. '<li>Dark Room Navigation</li>'
							. '<li>Hovering</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.MajorGlitches'),
					'content' => [
						'This mode accounts for everything besides EG and semi-EG. This mode is extremely difficult and requires advanced knowledge of major glitches, including:',
						'<ul>'
							. '<li>Overworld YBA</li>'
							. '<li>Clipping out of bounds</li>'
							. '<li>Screenwraps</li>'
						. '</ul>',
						'Some additional changes have been made in order to ensure that the game functions correctly under this logic:',
						'<ul>'
							. '<li>The fake dark world is no longer patched out. Crystals always drop, irrespective of pendant conflicts.</li>'
							. '<li>Swamp Palace water levels do not drain when you exit the overworld screen, except for the first room.</li>'
							. '<li>You will always save and quit to the Pyramid after defeating Agahnim when in the Dark World.</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.None'),
					'content' => [
						'There is seriously no checking whatsoever of where items end up, Good Luck if you try this option.',
					],
				],
			],
		],
		'goal' => [
			'header' => __('randomizer.goal.title'),
			'sections' => [
				[
					'header' => __('randomizer.goal.options.ganon'),
					'content' => [
						'Just like the vanilla game, your goal will be to collect all seven crystals, fight your way through Ganon’s Tower, and defeat Ganon.',
					],
				],
				[
					'header' => __('entrance.goal.options.crystals'),
					'content' => [
						'Similar to ' . __('randomizer.goal.options.ganon') . ', your goal will be to collect all seven crystals and defeat Ganon, but you might not have to fight your way through Ganon’s Tower.',
					],
				],
				[
					'header' => __('randomizer.goal.options.dungeons'),
					'content' => [
						'You’ll need to defeat all of Hyrule’s dungeon bosses, including both incarnations of Agahnim. Only once they’re defeated will you be able to face Ganon.',
					],
				],
				[
					'header' => __('randomizer.goal.options.pedestal'),
					'content' => [
						'Collect the Pendants of Courage, Wisdom, and Power, and pull the Triforce from the Pedestal! Beware, you may have to venture all over Hyrule, including Ganon’s Tower, in order to complete your quest.',
					],
				],
				[
					'header' => __('randomizer.goal.options.triforce-hunt'),
					'content' => [
						'The Triforce has been shattered and scattered into 30 pieces throughout Hyrule! Collect 20 pieces to win!',
					],
				],
			],
		],
		'difficulty' => [
			'header' => __('randomizer.difficulty.title'),
			'sections' => [
				[
					'header' => __('randomizer.difficulty.options.easy'),
					'content' => [
						'This mode is recommended for newer players. Easy makes travelling through Hyrule a little safer.',
						'Finding the second ½ Magic will upgrade you to ¼ Magic.',
						'While in Standard Mode, if Uncle has the Bow, Bombs, Fire Rod, Cane of Somaria, or Cane of Byrna, Link will be granted unlimited ammo for that item for the duration of the escape sequence.',
						'See the Difficulty Comparison table below for full details.',
					],
				],
				[
					'header' => __('randomizer.difficulty.options.normal'),
					'content' => [
						'In this mode you’ll find all the items from the original game.',
					],
				],
				[
					'header' => sprintf('%s, %s, and %s', __('randomizer.difficulty.options.hard'), __('randomizer.difficulty.options.expert'), __('randomizer.difficulty.options.insane')),
					'content' => [
						'Looking for a challenge? These advanced difficulties adjust the game even further to test your skills! Check out the comparison below for details.',
					],
				],
				[
					'header' => __('randomizer.difficulty.options.crowdControl'),
					'content' => [
						'A special difficulty intended for use with the Crowd Control Twitch extension.',
                        'The item pool is based on the Hard difficulty but with special considerations for what’s available in the the Crowd Control shop.',
                        'Find out more at <a href="https://crowdcontrol.live/" target="_blank" rel="noopener noreferrer">crowdcontrol.live</a>',
					],
				],
			],
			'comparison' => [
				'header' => 'Difficulty Comparison',
				'maximum_health' => 'Maximum Health',
				'heart_containers' => 'Heart Containers',
				'heart_pieces' => 'Heart Pieces',
				'maximum_mail' => 'Maximum Mail',
				'number_in_pool' => '# in Pool',
				'maximum_sword' => 'Maximum Sword',
				'maximum_shield' => 'Maximum Shield',
				'shields_store' => 'Shields Purchasable',
				'maximum_magic' => 'Maximum Magic Capacity',
				'number_silvers' => '# of Silver Arrows',
				'number_silvers_swordless' => '# of Silver Arrows (Swordless)',
				'number_bottles' => '# of Bottles',
				'number_lamps' => '# of Lamps',
				'potion_magic' => 'Potion Magic Refill',
				'potion_health' => 'Potion Hearts Refill',
				'bug_net_fairy' => 'Bug Net Catches Faeries',
				'powder_bubble' => 'Magic Powder on Bubbles',
				'cape_consumption' => 'Cape Magic Consumption Rate',
				'byrna_invincible' => 'Byrna Grants Invincibility',
				'stun_boomerang' => 'Boomerangs Stun Enemies',
				'stun_hookshot' => 'Hookshot Stuns Enemies',
				'capacity_upgrade' => 'Arrow / Bomb Capacity Upgrades',
				'drop_rates' => 'Enemy Drop Rates',
				'quarter' => 'Quarter',
				'half' => 'Half',
				'normal' => 'Normal',
				'shield_3' => 'Mirror',
				'shield_2' => 'Fire',
				'shield_1' => 'Fighter’s',
				'none' => 'None',
				'sword_4' => 'Gold',
				'sword_3' => 'Tempered',
				'sword_2' => 'Master',
				'mail_3' => 'Red',
				'mail_2' => 'Blue',
				'mail_1' => 'Green',
				'fairy' => 'Faerie',
				'heart' => 'Heart',
				'bee' => 'Bees',
				'yes' => 'Yes',
				'no' => 'No',
				'tooltip' => [
					'silvers' => 'Silver Arrows only function in Ganon’s room.',
					'bottles' => 'Once 4 Bottles have been collected, the remaining Bottles will revert to rupees.',
					'potion_magic' => 'Potions will fill 100% magic in Spike Cave.',
					'potion_health' => 'Potions will fill 20 hearts in Spike Cave.',
				],
			],
		],
		'variation' => [
			'header' => __('randomizer.variation.title'),
			'sections' => [
				[
					'header' => __('randomizer.variation.options.none'),
					'content' => [
						'The closest option to the vanilla game.',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-race'),
					'content' => [
						'The timer counts up from 0, with the goal being to finish the game with the best time on the timer. There are items throughout the world that will affect your timer, so finishing first doesn’t necessarily mean you’re the winner.',
						'Do you spend time looking for a clock to get your timer down, or do you race to the end?',
						'The following items have been added to the item pool:',
						'<ul>'
							. '<li>20 Green Clocks that subtract 4 minutes from the timer</li>'
							. '<li>10 Blue Clocks that subtract 2 minutes from the timer</li>'
							. '<li>10 Red Clocks that add 2 minutes to the timer</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-ohko') . ' (One Hit Knockout)',
					'content' => [
						'In this mode you start with time on the timer, and found green clocks add time to the timer.',
						'If your timer reaches zero, you’ll enter One Hit Knockout mode, where anything will kill you.',
						'Don’t despair, though. If you are in OHKO mode and find another clock, you’ll exit OHKO mode and get time on your clock, no matter how long you’ve been in OHKO mode.',
					],
					'ohko_table' => [
						'minutes' => 'minutes',
						'start_time' => 'Starting Time',
						'green_clock' => 'Green Clocks (+4 minutes)',
						'red_clock' => 'Red Clocks (instant OHKO)',
					],
				],
				[
					'header' => __('randomizer.variation.options.ohko') . ' (One Hit Knockout)',
					'content' => [
						'Take any damage, and Link is a goner. Not for the faint of heart.',
					],
				],
				[
					'header' => __('randomizer.variation.options.key-sanity'),
					'content' => [
						'Game not random enough for you? Looking for the real challenge?',
						'FINE!',
						'All Maps, Compasses, and Keys found in chests are no longer tied to their dungeons!',
						'You will have to search high and low to find the keys you need to progress in dungeons. Keys found on enemies or under pots will remain the same.',
						'Also, Maps and Compasses worth more: Your overworld map won’t show any dungeon information until you collect the map for that dungeon (and if you thought the music would get you by, think again, that’s been randomized). Compasses, well, those will show you how many chests you have checked in a dungeon after you collect it.',
						'You’re probably wondering how you know which key / map / compass you found. We’ve got you covered: There will be a text box that lets you know which dungeon it belongs to. The menu will also have a table to help you if you lose track.',
						'Maps and Compasses are required by the logic to complete their respective dungeons.',
					],
				],
				[
					'header' => __('randomizer.variation.options.retro'),
					'content' => [
						'A callback to the first entry in the Legend of Zelda series, ' . __('randomizer.variation.options.retro') . ' ' . __('randomizer.variation.title') . ' links us even closer to the past.',
						[
							'header' => 'Rupee Bow',
							'content' => [
								'The Bow no longer uses arrows for ammo. Instead it uses rupees! Each Wooden Arrow costs 10 rupees to fire while each Silver Arrow costs 50 rupees.',
								'Wooden Arrows are now independent of the Bow, just like Silver Arrows; you must acquire both the Bow and either Wooden Arrows or Silver Arrows in order to use the Bow.',
								'The Wooden Arrows are now an item to be acquired, and must be bought, once, from a shop. They are NOT available in regular chests or anywhere outside of shops.',
								'If you find Silver Arrows without buying Wooden Arrows, you will only be able to fire Silver Arrows.',
							],
						],
						[
							'header' => 'Overworld Shops',
							'content' => [
								'Five shops out of a possible nine will be randomly chosen when the ROM is generated to have new stock. This does NOT include the Big Bomb Shop or the Witch’s Potion Shop. The Wooden Arrow item will be available for 80 rupees, and Small Keys will be available for 100 rupees each. Small Keys will be able to be purchased multiple times.',
							],
						],
						[
							'header' => 'Small Keys',
							'content' => [
								'Small Keys are no longer dungeon-specific. They are now shuffled into the general item pool and will be found outside of dungeons. Keys under pots or dropped by enemies have not been changed.',
								'Ten keys have been removed from the item pool in Easy and Normal modes; fifteen have been removed from Hard, Expert, and Insane modes. Think carefully before using keys, and remember you can purchase some if you get stuck!',
								'Big Keys, Maps, and Compasses remain dungeon-specific and have not been randomized outside their dungeons.',
							],
						],
						[
							'header' => 'Take-Any Caves',
							'content' => [
								'Four random single-entrace caves and houses which do not lead to an item location now lead to Take-Any Caves where players are given a choice between a Heart Container or Blue Potion refill. The Heart Containers have not been removed from the general item pool; they are bonus heart containers. However, you will not be able to have more than 20 hearts at once.',
								'One random single-entrace cave will contain a mysterious yet familiar old man with a sword upgrade. This sword upgrade takes the place of one in the item pool.',
							],
						],
					],
				],
			],
		],
		'item_pool' => 'Item Pool',
	],
];
