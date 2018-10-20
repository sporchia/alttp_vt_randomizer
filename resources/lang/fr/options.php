<?php
return [
	'header' => 'Options',
	'subheader' => 'Les nombreuses manières de jouer',
	'cards' => [
		'mode' => [
			'header' => __('randomizer.mode.title'),
			'sections' => [
				[
					'header' => __('randomizer.mode.options.standard'),
					'content' => [
						'Calqué sur le jeu de base : Link commence l’aventure dans son lit, reçoit une arme de son oncle (selon le paramétrage des épées, voir ci-dessous) et doit secourir la princesse Zelda avant de pouvoir continuer.',
					],
				],
				[
					'header' => __('randomizer.mode.options.open'),
					'content' => [
						'Dans ce mode de jeu vous débutez de la maison de Link ou au sanctuaire (au choix) et vous n’êtes pas obligés de compléter la séquence d’introduction avant de parcourir le monde d’Hyrule. Quelques points à noter :',
						'<ul>'
							. '<li>L’oncle de Link est déjà dans les égouts et possède un item.</li>'
							. '<li>Aucune salle obscure n’est éclairée, pas même les égouts.</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.mode.options.inverted'),
					'content' => [
						'Fatigué de la progression classique ? Nous avons le mode de jeu idéal pour vous !',
						'En inversé, Link débutera dans le monde des ténèbres pour terminer dans le monde de lumière.',
						'C’est un mode de jeu assez difficile que nous ne recommandons pas aux nouveaux joueurs : les ennemis du monde des ténèbres font très mal, surtout quand on a que 3 cœurs ...',
						'Dans les faits, ce mode de jeu apporte de nombreuses modifications :',
						'<ul>'
							. '<li>La maison de Link remplace le magasin de bombes du monde des ténèbres, et réciproquement.</li>'
							. '<li>Le ' . __('item.MagicMirror') . ' vous transporte du monde de la lumière vers celui des ténèbres.</li>'
							. '<li>La ' . __('item.OcarinaInactive') . ' ne fonctionne que dans le monde des ténèbres, mais devra quand même s’activer dans le monde de lumière.</li>'
							. '<li>Des modifications ont été apportées au terrain pour vous permettre d’atteindre certains endroits du monde de lumière qui nécessitaient le ' . __('item.MagicMirror') . '</li>'
							. '<li>Le vieil homme est maintenant perdu dans le monde des ténèbres, mais vous devrez le reconduire chez lui, dans le monde de lumière.</li>'
							. '<li>Les portails qui menaient au monde des ténèbres n’ont pas bougés, mais sont maintenant dans le monde des ténèbres et nécessitent les mêmes items pour les atteindre.</li>'
							. '<li>Agahnim a quitté le château d’Hyrule pour s’installer sur la montagne de la mort et a “oublié” d’en protéger l’accès. Oh, nous avons également ajouté des escaliers pour atteindre la montagne de la mort facilement dans le monde des ténèbres.</li>'
							. '<li>Suite à ce déménagement, la tour de Ganon a maintenant pris la place du château d’Hyrule, mais il vous faudra toujours 7 cristaux pour y pénétrer.</li>'
							. '<li>Le mur de Ice Palace est tombé, vous pourrez simplement y accéder à la nage.</li>'
							. '<li>Le sommet de Turtle Rock peut être atteint en escaladant simplement la queue de la tortue.</li>'
							. '<li>N’oubliez pas qu’un lapin est parfaitement capable de lire le ' . __('item.BookOfMudora') . ', ou d’interagir avec le monde qui l’entoure...</li>'
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
						'Toutes les améliorations d’épées sont aléatoires. Vous commencerez sans épée et il peut se passer du temps avant que vous en trouviez une. Utilisez des bombes, des buissons ou mêmes des panneaux pour vous défendre jusqu’à tomber sur une arme plus efficace.',
						'Si cette option est combinée au mode ' . __('randomizer.mode.options.standard') . ' ' . __('randomizer.mode.title') .' (voir ci-dessus), votre oncle vous offrira un des items suivants pour vous permettre de finir la séquence d’introduction :',
						'<ul>'
							. '<li>Épée (oui, c’est possible !)</li>'
							. '<li>Marteau</li>'
							. '<li>Arc, avec un plein de flèches</li>'
							. '<li>Un plein de Bombes</li>'
							. '<li>Baguette de Feu, avec un plein de magie</li>'
							. '<li>Canne de Somaria, avec un plein de magie</li>'
							. '<li>Canne de Byrna,  avec un plein de magie</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.weapons.options.uncle'),
					'content' => [
						'L’oncle de Link vous donnera nécessairement une épée, les améliorations restent aléatoires.',
					],
				],
				[
					'header' => __('randomizer.weapons.options.swordless'),
					'content' => [
						'Il n’y a aucune épée dans le jeu ! Cela implique quelques changements :',
						'<ul>'
							. '<li>Les épées ont été remplacées par des 20 rupees (verts).</li>'
							. '<li>La barrière de la tour d’Agahnim peut être détruite avec le marteau.</li>'
							. '<li>Le rideau à la fin de la tour d’Agahnim est déjà ouvert, tout comme les lierres de Skull Woods.</li>'
							. '<li>Les médaillons ne sont utilisables que pour ouvrir Misery Mire et Turtle Rock, ou pour progresser à l’intérieur de Ice Palace. En temps normal, ils nécessitent une épée.</li>'
							. '<li>Ganon prend maintenant des dégâts du marteau.</li>'
							. '<li>Les flèches d’argent sont disponibles dans tous les modes de difficultés.</li>'
							. '<li>Les stèles d’Ether et de Bombos nécessitent le livre de Mudora et le marteau.</li>'
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
						'Ce mode ne nécessite aucune connaissance particulière.',
						'Vous ne pourrez jamais vous retrouver bloqués, qu’importe la manière dont vous utilisez vos petites clés dans les donjons.',
						'Vous aurez peut-être besoin de sauvegarder et de quitter à certains moments, comme pour revenir dans le monde de lumière si vous n’avez pas trouvé le miroir.',
					],
				],
				[
					'header' => __('randomizer.logic.options.OverworldGlitches'),
					'content' => [
						'Ce mode de jeu vous demandera de connaître la plupart des glitchs, à l’exception des plus compliqués. Précisément, cette logique de jeu prévoit que le joueur est capable d’exécuter les glitchs suivants :',
						'<ul>'
							. '<li>Boot Clipping (sortir des limites grâce aux bottes)</li>'
							. '<li>Mirror Clipping (sortir des limites grâce au miroir)</li>'
							. '<li>Fake Flippers (nager sans les palmes)</li>'
							. '<li>Bunny Revival (annuler l’état de lapin pour redevenir Link)</li>'
							. '<li>Super Bunny (récupérer certaines capacités lorsque Link est en lapin)</li>'
							. '<li>Surfing Bunny (marcher sur l’eau profonde en lapin)</li>'
							. '<li>Walk on Water (marcher sur l’eau, tout court)</li>'
						. '</ul>',
						'Ce mode de jeu ne prend PAS en compte les choses suivantes :',
						'<ul>'
							. '<li>Bootless Clipping (sortir des limites sans les bottes, notamment en intérieur)</li>'
							. '<li>Mirror Screenwrap (faire défiler l’écran à l’aide du miroir)</li>'
							. '<li>YBA (utiliser une potion pour déclencher la flûte ou faire défiler l’écran)</li>'
							. '<li>Hovering (flotter à l’aide des bottes)</li>'
							. '<li>Naviguer les salles obscures sans lanterne</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.MajorGlitches'),
					'content' => [
						'Dans cette logique, nous supposons que vous maîtrisez tous les glitchs du jeu, à l’exception de l’Exploration Glitch. Ce mode de jeu est très difficile et présente également les modifications suivantes :',
						'<ul>'
							. '<li>Le faux monde des ténèbres n’est plus corrigé. Les cristaux apparaîtront toujours, ce qui peut entrer en conflit avec les pendentifs.</li>'
							. '<li>Le niveau de l’eau dans Swamp Palace ne redescend pas si vous sortez du donjon, sauf si vous le faites depuis la première salle.</li>'
							. '<li>Sauvegarder dans le monde des ténèbres vous renverra systématiquement à la pyramide si Agahnim a été battu.</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.None'),
					'content' => [
						'Les items peuvent être véritablement n’importe où et aucune sécurité n’est en place, bonne chance.',
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
						'Comme dans le jeu de base, votre objectif est d’obtenir les 7 cristaux pour aller affronter Ganon.',
					],
				],
				[
					'header' => __('randomizer.goal.options.dungeons'),
					'content' => [
						'Vous devrez battre les boss de chaque donjon, y compris les deux apparitions d’Agahnim, avant de pouvoir vous confronter à Ganon.',
					],
				],
				[
					'header' => __('randomizer.goal.options.pedestal'),
					'content' => [
						'Rassemblez les trois pendentifs et récupérez la Triforce au piédestal des bois perdus ! Vous aurez sans doute besoin de parcourir tout Hyrule pour y parvenir, et peut-être même de visiter la tour de Ganon.',
					],
				],
				[
					'header' => __('randomizer.goal.options.triforce-hunt'),
					'content' => [
						'La Triforce s’est séparée en 30 morceaux éparpillés un peu partout en Hyrule et vous devez en trouver 20 pour accomplir votre quête !',
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
						'Mode de difficulté recommandé aux joueurs débutants, ce mode rend l’aventure plus accessible.',
						'Trouver la seconde amélioration de magie vous fera passer de ½ à ¼ de magie.',
						'En mode standard, si l’oncle vous donne l’arc, des bombes, la baguette de feu, la canne de Somaria ou la canne de Byrna, Link aura munitions illimitées jusqu’à la fin de la séquence d’introduction.',
						'Consultez le tableau ci-dessous pour plus de détails.',
					],
				],
				[
					'header' => __('randomizer.difficulty.options.normal'),
					'content' => [
						'Ce mode de difficulté possède tous les items du jeu de base et aucune modification particulière.',
					],
				],
				[
					'header' => sprintf('%s, %s, et %s', __('randomizer.difficulty.options.hard'), __('randomizer.difficulty.options.expert'), __('randomizer.difficulty.options.insane')),
					'content' => [
						'À la recherche d’un défi ? Ces difficultés avancées testeront vos capacités ! Consultez le tableau pour plus d’informations.',
					],
				],
			],
			'comparison' => [
				'header' => 'Comparaison de difficulté',
				'maximum_health' => 'Santé maximale',
				'heart_containers' => 'Réceptacles de coeur',
				'heart_pieces' => 'Quarts de coeur',
				'maximum_mail' => 'Meilleure Tunique',
				'number_in_pool' => '# disponibles',
				'maximum_sword' => 'Meilleure Épée',
				'maximum_shield' => 'Meilleur Bouclier',
				'shields_store' => 'Boucliers achetables ?',
				'maximum_magic' => 'Magie maximale',
				'number_silvers' => 'Flèches d’Argent',
				'number_silvers_swordless' => 'Flèches d’Argent (sans épée)',
				'number_bottles' => 'Flacons',
				'number_lamps' => 'Lanternes',
				'potion_magic' => 'Soin des potions de magie',
				'potion_health' => 'Soin des potions de santé',
				'bug_net_fairy' => 'Fées Capturables ?',
				'powder_bubble' => 'Poudre sur les Antifées',
				'cape_consumption' => 'Consommation de la Cape',
				'byrna_invincible' => 'Byrna rend invincible ?',
				'stun_boomerang' => 'Les Boomerangs étourdissent ?',
				'stun_hookshot' => 'Le Grappin étourdit ?',
				'capacity_upgrade' => 'Extensions de Carquois & de Sac de Bombes',
				'drop_rates' => 'Chance de drop des ennemis',
				'quarter' => 'Quart',
				'half' => 'Moitié',
				'normal' => 'Normal',
				'shield_3' => 'Miroir',
				'shield_2' => 'Feu',
				'shield_1' => 'Simple',
				'none' => 'Aucun',
				'sword_4' => 'Or',
				'sword_3' => 'Trempée',
				'sword_2' => 'Master Sword',
				'mail_3' => 'Rouge',
				'mail_2' => 'Bleue',
				'mail_1' => 'Verte',
				'fairy' => 'Fée',
				'heart' => 'Cœur',
				'bee' => 'Abeilles',
				'yes' => 'Oui',
				'no' => 'Non',
				'tooltip' => [
					'silvers' => 'Les flèches d’argent ne fonctionnent que dans la pyramide de Ganon.',
					'bottles' => 'Une fois que 4 bouteilles ont été collectées, les bouteilles restantes deviendront des rubis.',
					'potion_magic' => 'Les potions rempliront 100% de magie dans Spike Cave.',
					'potion_health' => 'Les potions rempliront 20 coeurs à Spike Cave.',
				],
			],
		],
		'variation' => [
			'header' => __('randomizer.variation.title'),
			'sections' => [
				[
					'header' => __('randomizer.variation.options.none'),
					'content' => [
						'Aucune modification particulière, expérience de jeu standard.',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-race'),
					'content' => [
						'Votre temps est compté et votre objectif est de finir avec le meilleur chrono, mais ce ne sera pas si simple. Ce mode ajoute des items qui impacteront le chronomètre et finir premier ne vous garantira pas d’avoir le meilleur temps.',
						'Allez-vous foncer vers Ganon ou partir à la recherche de ces items ?',
						'Voici ce que nous avons ajouté :',
						'<ul>'
							. '<li>20 Horloges Vertes (moins 4 minutes)</li>'
							. '<li>10 Horloges Bleues (moins 2 minutes)</li>'
							. '<li>10 Horloges Rouges (plus 2 minutes)</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-ohko') . ' (Mort en un coup)',
					'content' => [
						'Dans cette variante, vous devrez faire attention au chronomètre.',
						'S’il atteint zéro, vous déclencherez le mode Zéro Cœurs dans lequel le moindre dégât vous sera fatal !',
						'Ramassez les horloges pour gagner du temps et ainsi retarder, voire inverser, l’état Zéro Cœurs... temporairement tout du moins.',
					],
					'ohko_table' => [
						'minutes' => 'minutes',
						'start_time' => 'Temps de départ',
						'green_clock' => 'Horloges Vertes (+4 minutes)',
						'red_clock' => 'Horloges Rouges (Chrono = 0)',
					],
				],
				[
					'header' => __('randomizer.variation.options.ohko') . ' (Mort en un coup)',
					'content' => [
						'Au moindre dégât encaissé, c’est le game over. Réservé à celles et ceux qui n’ont pas froid aux yeux ...',
					],
				],
				[
					'header' => __('randomizer.variation.options.key-sanity'),
					'content' => [
						'Vous voulez encore plus d’aléatoire ? Et un défi à votre hauteur ?',
						'Vous l’aurez voulu !',
						'Dans cette variante les cartes, les boussoles et les clés ne sont plus obligatoirement dans leur donjon respectif et vous allez devoir parcourir tout Hyrule pour trouver la petite clé qui vous fait défaut. Les clés présentes sous les pots et celles qui apparaissent en tuant des ennemis n’ont en revanche pas bougées.',
						'Les cartes et les boussoles ont été améliorées pour cette variante. La carte du monde ne vous donnera aucune information sur un donjon tant que vous n’avez pas trouvé sa carte (et si vous pensiez pouvoir vous repérer à la musique, mauvaise nouvelle, elle est aléatoire). Les boussoles quant à elles vous indiqueront combien de coffres vous avez ouvert dans le donjon. Par ailleurs, carte et boussole sont requis par la logique pour terminer les donjons.',
						'Nous avons quand même pensé à vous : les clés, cartes et boussoles vous indiqueront de quel donjon elles proviennent, et un tableau dans le menu de pause vous permettra de vous y retrouver.',
					],
				],
				[
					'header' => __('randomizer.variation.options.retro'),
					'content' => [
						'Basé sur le premier Legend of Zelda sur NES, cette variante implique de nombreux changements.',
						[
							'header' => 'Un Arc Coûteux',
							'content' => [
								'L’arc n’utilise plus des flèches mais des rupees !',
								'Tirer une flèche en bois vous coûte 10 rupees, tandis qu’une flèche d’argent vous en coûte 50.',
								'De plus, l’arc n’est fourni avec aucune munition : vous devrez trouver les flèches d’argent, ou acquérir les flèches de bois auprès d’un marchand pour pouvoir l’utiliser.',
							],
						],
						[
							'header' => 'Magasins',
							'content' => [
								'Cinq magasins sur un total de neuf posséderont un inventaire différent du jeu de base (le magasin de bombe et celui de la sorcière ne seront jamais modifiés). Ces nouveaux magasins proposeront les flèches de bois pour 80 rupees ainsi que des petites clés pour 100 rupees l’unité. Vous pourrez acheter autant de petite clé que vous le souhaitez.',
							],
						],
						[
							'header' => 'Petites clés',
							'content' => [
								'Les petites clés ne sont plus liées à leur donjon respectif et peuvent être trouvées partout dans le monde d’Hyrule. Les clés disponibles sous les pots ou qui apparaissent à la mort d’ennemis n’ont en revanche pas bougées.',
								'10 petites clés ont été retirées en difficulté Facile et Normale ; 15 en Difficile, Expert et Infernal. Vous devrez réfléchir avant d’utiliser vos clés, mais n’oubliez pas que vous pourrez en acheter en cas de besoin.',
							],
						],
						[
							'header' => 'Cavernes à Choix',
							'content' => [
								'Quatre maisons et cavernes qui ne mènent d’ordinaire à aucun item sont sélectionnées aléatoirement pour être remplacées par des cavernes à choix. À l’intérieur de celles-ci, le joueur aura le choix entre un réceptacle de cœur ou une potion bleue à boire immédiatement. Cela signifie qu’il y a plus de réceptacle de cœur que d’ordinaire, mais vous ne pourrez jamais avoir plus de 20 cœurs au total malgré tout.',
								'Une caverne ou maison supplémentaire vous mènera à un vieil homme mystérieux qui vous confiera une épée, mais le nombre d’épées dans le pool ne change pas.',
							],
						],
					],
				],
			],
		],
		'item_pool' => 'Groupe d’objets',
	],
];
