<?php
return [
	'header' => 'Commencez Votre Aventure!',
	'subheader' => 'Vous voulez tester vos compétences dans un Hyrule mélangé? Vous êtes arrivé au bon endroit!',
	'cards' => [
		'discord' => [
			'header' => '1. Rejoignez notre communauté Discord',
			'content' => [
				'<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer"role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
				'Rejoignez notre communauté Discord! Nous avons des gens sympathiques et serviables, des nouvelles sur les événements communautaires, des mises à jour ALttP: Randomizer, des guides utiles, des trucs et astuces, et plus encore! Viens dire bonjour!',
			]
		],
		'rom' => [
			'header' => '2. Obtenez la ROM',
			'content' => [
				'Vous aurez besoin de la ROM de base. Ce devrait être une ROM <span class="font-weight-bold">Zelda no Densetsu: Kamigami no Triforce v1.0</span>. Ne vous inquiétez pas si vous ne pouvez pas lire le japonais; Le processus de correction fournit du texte en anglais tout en conservant les glitches propres à la version originale.',
				'Si vous rencontrez des problèmes, demandez à  <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>!',
			]
		],
		'randomize' => [
			'header' => '3. Choisissez Vos Options de Jeu',
			'content' => [
				'Rendez-vous sur <a href="/randomizer" target="_blank" rel="noopener noreferrer">' . __('navigation.randomizer') . '</a> et fournissez votre ROM. L’écran suivant affichera une variété d’options de jeu. Pour vos premiers essais, nous vous recommandons de remplacer «' . __('randomizer.difficulty.title') . '» par «' . __('randomizer.difficulty.options.easy') . '» et de laisser les autres paramètres tels quels. Cliquez ensuite sur «' . __('randomizer.generate.casual') . '» et vous recevrez un nouveau jeu aléatoire!',
				'Vous trouverez un guide plus détaillé de toutes les options disponibles <a href="/options">ici</a>.',
			]
		],
		'emulator' => [
			'header' => '4. Obtenez un Moyen de Jouer',
			'content' => [
				'Tout d’abord, vous aurez besoin de quelque chose pour lancer votre nouveau jeu. Nous vous recommandons d’utiliser un émulateur. Un émulateur est un programme qui réplique étroitement le matériel SNES, vous permettant d’exécuter des jeux SNES sur votre ordinateur. Vous pouvez obtenir l’émulateur recommandé, SNES9x, sur leur site Web <a href="http://www.snes9x.com/" target="_blank" rel="noopener noreferrer">ici</a>.',
				'Bien que vous puissiez jouer avec votre clavier, une manette vous garantit une meilleure expérience. Bien que la plupart des manettes USB fonctionnent, nous vous recommandons une <a href="https://www.amazon.com/dp/B002B9XB0E" target="_blank" rel="noopener noreferrer">iBuffalo Classic USB Gamepad</a> ou un <a href="https://www.amazon.com/dp/B00Y0LUQFE" target="_blank" rel="noopener noreferrer">8Bitdo SFC30 Wireless Bluetooth Controller</a>.',
				'Il existe d’autres méthodes prises en charge, notamment sur le matériel SNES d’origine. Il existe également certains émulateurs, tels que zsnes, qui ne fonctionneront pas correctement avec le randomiseur. Rejoignez-nous sur <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a> pour en savoir plus!',
				'REMARQUE POUR LES JOUEURS SNESMINI: Renommez votre fichier ROM pour qu’il contienne 61 caractères ou moins, car SNESMini ne peut pas gérer les noms de fichiers longs.',
			]
		],
		'play' => [
			'header' => '5. Jouer!',
			'content' => [
				'Vous êtes enfin prêt à partir! La meilleure façon d’apprendre est de charger votre nouvelle ROM et de commencer à jouer. Si vous avez l’impression d’être coincé, consultez la liste des pièges les plus courants ou consultez le site <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>.',
				'<ul>'
					. '<li>Vous pouvez utiliser le bouton Y pour basculer entre les flèches d’argent et les flèches normales, les boomerangs rouges et bleus, le champignon et la poudre magique, la pelle et la flûte.</li>'
					. '<li>Vous pouvez sauvegarder et quitter avec la Grenouille ou Coffre Violet qui vous suit pour le ramener dans le monde de la lumière sans le Mirror.</li>'
					. '<li>Dans le monde des ténèbres, vous pouvez survoler avec le grappin la rivière au nord de la pyramide. Cherchez la flèche faite d’herbe!</li>'
					. '<li>Vous pouvez utiliser les bottes pour rebondir dans les murs, les blocs et les pots, vous faisant reculer pour traverser un trou.</li>'
					. '<li>Si vous vous trouvez dans une grotte avec la Cape mais sans le Grappin, essayez de marcher en haut à gauche du trou, aucun Grappin n’est nécessaire!</li>'
					. '<li>Les clés peuvent ne pas être accessibles si elles ne sont pas nécessaires pour terminer le jeu. Par exemple, la grande clé de Skull Woods pourrait être dans le grand coffre.</li>'
				. '</ul>',
				'N’oubliez pas de consulter les <a href="/resources">' . __('navigation.resources') . '</a> complètes avec des tutoriels et d’autres astuces!',
			]
		],
	],
];
