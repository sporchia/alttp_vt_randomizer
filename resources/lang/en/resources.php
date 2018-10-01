<?php
return [
	'header' => 'Resources',
	'cards' => [
		'discord' => [
			'header' => 'Discord',
			'content' => [
				'<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer" role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
				'Join our Discord community! We’ve got friendly and helpful people, community event news, ALttP: Randomizer updates, helpful guides, tips, and tricks, and more! Come say hello, and checkout the #resources channel!',
			],
		],
		'learn' => [
			'header' => 'Learn-to-Play Videos',
			'content' => [
				'<div class="center"><a class="btn btn-secondary btn-lg btn-xl" href="https://www.youtube.com/channel/UCBMMk0WJAeldNv4fI9juovA" role="button">ALttP:R Youtube Channel</a></div>',
				'Check out our routing guides, glitch tutorials, update announcements, tournament highlights, and more! Great for both new players looking to learn the ropes, and experienced runners looking to hone their skills!',
			],
		],
		'external' => [
			'header' => 'External Resources',
			'content' => [
				'<ul>'
					. '<li><a href="https://alttprlinks.page.link/QxvY" target="_blank" rel="noopener noreferrer">Common things that stump newcomers</a> (this is a good first read)</li>'
					. '<li><a href="https://alttprlinks.page.link/3vXm" target="_blank" rel="noopener noreferrer">General help glossary</a></li>'
					. '<li><a href="https://alttprlinks.page.link/HVFx" target="_blank" rel="noopener noreferrer">Glitch Resources</a></li>'
					. '<li><a href="https://alttprlinks.page.link/on1o" target="_blank" rel="noopener noreferrer">Trackers / HUDs</a></li>'
					. '<li><a href="http://alttp.mymm1.com/srl/" target="_blank" rel="noopener noreferrer">Getting started on SRL</a></li>'
				. '</ul>',
			],
		],
		'pitfalls' => [
			'header' => 'Common Pitfalls',
			'content' => [
				'<ul>'
					. '<li>You can use the Y button to swap between Silver Arrows and Normal Arrows, the Red and Blue Boomerangs, the Mushroom and the Magic Powder, and the Shovel and the Flute.</li>'
					. '<li>In the dark world, you can hookshot over the river north of the pyramid. Look for the arrow made out of grass!</li>'
					. '<li>If you find yourself at bumper cave with the Cape but without the Hookshot, try walking over the top left of the gap—no Hookshot needed!</li>'
					. '<li>Agahnim’s barrier can be bypassed with the Magic Cape or destroyed with an upgraded sword.</li>'
					. '<li>If you have the Magic Mirror, Desert Palace can be reached from Misery Mire without the Book of Mudora.</li>'
					. '<li>Bombos melts things as well as the Fire Rod, which is useful in Ice Palace.</li>'
					. '<li>You can cross small gaps by rebounding off of walls or objects using the Pegasus Boots.</li>'
					. '<li>Sahasrahla gives you his item when you speak to him with the Pendant of Courage.</li>'
					. '<li>The Super Bomb spawns when you have acquired crystals 5 and 6.</li>'
					. '<li>The Smith and the Purple Chest will stay following you through Save and Quit.</li>'
					. '<li>You are never required to navigate a dark room; the lamp will be available to light your way, so go out and find it!</li>'
					. '<li>Keys might not be accessible if they are not required to finish the game. For instance, the Skull Woods big key might be in the big chest.</li>'
				. '</ul>',
			],
		],
		'changes' => [
			'header' => 'Differences',
			'sections' => [
				[
					'header' => 'What has been randomized?',
					'content' => [
						'<ul>'
							. '<li>Nearly all unique item locations</li>'
							. '<li>Pendants and crystals (check your map!)</li>'
							. '<li>The medallions required to open Misery Mire and Turtle Rock</li>'
							. '<li>Enemy drops and prize pulls (e.g. trees)</li>'
						. '</ul>',
					],
				],
				[
					'header' => 'What has stayed the same?',
					'content' => [
						'<ul>'
							. '<li>All shops throughout Hyrule</li>'
							. '<li>The archery game and various rupee chest games</li>'
							. '<li>Small keys underneath pots or held by enemies</li>'
						. '</ul>',
					],
				],
				[
					'header' => 'What changed from the original game?',
					'content' => [
						'There are a few changes from the original game which enhance gameplay and prevent you from getting stuck. The Japanese 1.0 version is used as a base ROM because it allows use of some exclusive glitches in some of the advanced game modes.',
						'<ul>'
							. '<li>You no longer need the Lamp to push the bookshelf during the prologue.</li>'
							. '<li>You can now see in dark rooms in the Sewers without the Lamp (except in Open mode).</li>'
							. '<li>You can toggle between items which share the same slot in the menu by pressing Y. For example, you can now hold both the Shovel and Flute and switch between them.</li>'
							. '<li>The submenu for the Bottles no longer automatically opens. You can open it with X or toggle between bottles with Y.</li>'
							. '<li>The water levels within Swamp Palace will always revert to being drained when you exit the overworld screen. This prevents you from accidentally drowning keys underwater and getting stuck!</li>'
							. '<li>The file select screen has a random row of symbols at the top. These are a unique identifier for each seed generated to ensure that all racers have the correct file loaded. They do not have any other relevance.</li>'
							. '<li>The Pyramid and Waterfall of Wishing Faeries no longer upgrade your items. Instead their caves contains two chests each which account for the usual upgrades having been shuffled into the mix.</li>'
							. '<li>You’re guaranteed to get the digging game item by the 30th dig.</li>'
							. '<li>You’re guaranteed to get the Village of Outcasts chest game item on the 1st attempt (can be 1st or 2nd chest).</li>'
						. '</ul>',
					],
				],
			],

		],
	],
];
