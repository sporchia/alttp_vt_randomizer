<?php
return [
	'header' => 'Ressources',
	'cards' => [
		'discord' => [
			'header' => 'Discord',
			'content' => [
				'<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer" role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
				'Rejoignez notre communauté Discord ! Nous comptons des gens sympathiques et serviables. Vous y trouverez des informations sur les événements communautaires, des mises à jour du Randomiseur ALttP, des guides utiles, des conseils et astuces, et bien plus ! Venez nous saluer et n’hésitez pas à jeter un oeil au canal #resources !',
			],
		],
		'learn' => [
			'header' => 'Vidéos d’apprentissage',
			'content' => [
				'<div class="center"><a class="btn btn-secondary btn-lg btn-xl" href="https://www.youtube.com/channel/UCBMMk0WJAeldNv4fI9juovA" role="button">Chaîne YouTube ALttP:R</a></div>',
				'Jetez un oeil à nos guides de routing, nos tutoriels sur les glitchs, les annonces de mise à jour, les annonces de tournois, et plus encore ! Intéressants autant pour les joueurs débutants qui veulent apprendre que pour les joueurs expérimentés cherchant à parfaire leurs compétences.',
			],
		],
		'external' => [
			'header' => 'Ressources Externes',
			'content' => [
				'<ul>'
					. '<li><a href="https://alttprlinks.page.link/QxvY" target="_blank" rel="noopener noreferrer">Ce qui peut dérouter les nouveaux venus</a> (c’est une bonne première lecture)</li>'
					. '<li><a href="https://alttprlinks.page.link/3vXm" target="_blank" rel="noopener noreferrer">Glossaire d’aide</a></li>'
					. '<li><a href="https://alttprlinks.page.link/HVFx" target="_blank" rel="noopener noreferrer">Ressources pour les glitchs</a></li>'
					. '<li><a href="https://alttprlinks.page.link/on1o" target="_blank" rel="noopener noreferrer">Trackers / HUDs</a></li>'
					. '<li><a href="http://alttp.mymm1.com/srl/" target="_blank" rel="noopener noreferrer">Débuter sur SRL</a></li>'
				. '</ul>',
			],
		],
		'pitfalls' => [
			'header' => 'Choses à savoir',
			'content' => [
				'<ul>'
					. '<li>Vous pouvez utiliser le bouton Y pour alterner entre les flèches d’argent et les flèches normales, le Boomerang bleu et le rouge, le Champignon et la Poudre Magique, et entre la Pelle et la Flûte.</li>'
					. '<li>Dans le Monde des Ténèbres, vous pouvez utiliser le Grappin au dessus de la rivière au nord de la Pyramide. Cherchez les herbes qui dessinent une flèche !</li>'
					. '<li>Si vous vous trouvez dans la Bumper Cave avec la Cape Magique mais sans le Grappin, essayez de passer en haut à gauche du précipice … aucun Grappin nécessaire !</li>'
					. '<li>La barrière d’Agahnim peut être traversée avec la Cape Magique ou détruite avec une épée améliorée (Master Sword minimum)</li>'
					. '<li>Si vous avez le Miroir Magique, le Desert Palace peut être atteint depuis Misery Mire sans le Livre de Mudora.</li>'
					. '<li>Le Médaillon de Bombos fait fondre les choses aussi bien que la Baguette de Feu, ce qui est très utile pour Ice Palace.</li>'
					. '<li>Vous pouvez traverser des petits précipices en rebondissant contre des objets ou des murs grâce aux Bottes de Pégase.</li>'
					. '<li>Sahasrahla vous donne son objet lorsque vous lui parlez avec le Pendentif du Courage (pendentif vert).</li>'
					. '<li>La Super Bombe (la Bombe rouge) n’apparaît que lorsque vous avez récupéré les cristaux 5 et 6.</li>'
					. '<li>Le forgeron et le coffre violet resteront avec vous même si vous Sauvegardez et Quittez.</li>'
					. '<li>Vous n’êtes jamais obligés de traverser une salle dans le noir; la lanterne sera accessible pour éclairer votre chemin, donc, allez la trouver !</li>'
					. '<li>Les clés peuvent ne pas être accessibles si elles ne sont pas requises pour finir le jeu. Par exemple, dans Skull Woods, la grande clé peut se trouver dans le grand coffre.</li>'
				. '</ul>',
			],
		],
		'changes' => [
			'header' => 'Différences',
			'sections' => [
				[
					'header' => 'Qu’est-ce qui a été mélangé ?',
					'content' => [
						'<ul>'
							. '<li>Pratiquement tous les endroits comportant des items uniques</li>'
							. '<li>Les Pendentifs et les Cristaux (vérifiez votre carte !)</li>'
							. '<li>Les médaillons requis pour Misery Mire et Turtle Rock</li>'
							. '<li>Les consommables laissés par les ennemis et les récompenses à tirer (par exemple : certains arbres)</li>'
						. '</ul>',
					],
				],
				[
					'header' => 'Qu’est-ce qui n’a pas changé ?',
					'content' => [
						'<ul>'
							. '<li>Tous les magasins à travers Hyrule</li>'
							. '<li>Le jeu du tir à l’arc et les divers jeux de coffres</li>'
							. '<li>Les petites clés sous des pots ou portées par des ennemis</li>'
						. '</ul>',
					],
				],
				[
					'header' => 'Qu’est-ce qui change du jeu original ?',
					'content' => [
						'Il y a quelques modifications par rapport au jeu original qui améliorent le gameplay et empêchent d’être bloqué. La version 1.0 Japonaise est utilisée comme base pour la ROM, elle permet l’utilisation de glitchs exclusifs dans certains modes de jeu avancés.',
						'<ul>'
							. '<li>Vous n’avez plus besoin de la Lanterne pour pousser le blason pendant le prologue.</li>'
							. '<li>Vous pouvez maintenant voir dans les salles dans le noir dans les égouts même si vous ne possédez pas la Lanterne (sauf en mode Ouvert).</li>'
							. '<li>Vous pouvez passer d’un item à l’autre lorsque deux items partagent le même emplacement en appuyant sur Y. Par exemple, vous pouvez porter en même temps la Pelle et la Flûte et passer de l’un à l’autre.</li>'
							. '<li>Le sous-menu des flacons ne s’ouvrira plus automatiquement. Vous pouvez l’ouvrir avec le bouton X ou faire défiler les flacons avec le bouton Y.</li>'
							. '<li>Les niveaux d’eau de Swamp Palace reviendront automatiquement à leur état initial lorsque vous sortirez de l’écran où se trouve l’entrée du donjon, à l’extérieur. Cela empêchera que vous soyez bloqués si vous avez englouti une clé dans le donjon.</li>'
							. '<li>Des symboles sont affichés en haut de l’écran de sélection des parties. Il s’agit d’un identifiant unique généré pour chaque seed, afin de vérifier que les joueurs utilisent la même. Ces symboles n’ont aucun autre intérêt.</li>'
							. '<li>La Pyramid Fairy et la Waterfall Fairy n’améliorent plus vos items. A la place, leurs grottes contiennent deux coffres qui comptent chacun comme correspondant aux améliorations qu’apportent les fées.</li>'
							. '<li>Le jeu de la pelle vous donnera obligatoirement l’item avant le 30ème coup de pelle.</li>'
							. '<li>Dans le Village of Outcasts, l’item du jeu des coffres est garanti à la première tentative (cela peut être le 1er ou de 2nd coffre).</li>'
						. '</ul>',
					],
				],
			],

		],
	],
];
