<?php
return [
	'header' => 'Qu’est ce que le Randomizer d’Entrée?',
	'subheader' => 'Le Randomizer d’entrées vous permet de tourner le monde à l’envers et de jouer. Il devrait principalement suivre les règles VT standard pour les paramètres sur tout, mais il introduit une nouvelle option “' . __('entrance.shuffle.title') . '”.',
	'cards' => [
		'simple' => [
			'header' => __('entrance.shuffle.options.simple'),
			'content' => [
				'Mélangez les entrées des donjons les unes aux autres et conservez tous les donjons à 4 entrées confinés à un endroit tel que les donjons échangent les uns avec les autres.',
				'En dehors de Light World Death Mountain, les intérieurs sont mélangés mais connectent toujours les mêmes points sur le monde extérieur. Sur la Montagne de la Mort, les entrées sont connectées plus librement.',
			],
		],
		'restricted' => [
			'header' => __('entrance.shuffle.options.restricted'),
			'content' => [
				'Utilise le mélangeur de donjon à partir du mode Simple mais connecte librement les entrées restantes. Les grottes et les donjons avec des entrées multiples seront confinés à un seul monde.',
			],
		],
		'full' => [
			'header' => __('entrance.shuffle.options.full'),
			'content' => [
				'Mélange librement les entrées des grottes et des donjons. Les grottes et les donjons avec des entrées multiples seront confinés à un seul monde.',
			],
		],
		'crossed' => [
			'header' => __('entrance.shuffle.options.crossed'),
			'content' => [
				'Mélange librement les entrées des grottes et des donjons, mais à présent, les grottes et les donjons des connecteurs peuvent relier Light World et Dark World.',
			],
		],
		'insanity' => [
			'header' => __('entrance.shuffle.options.insanity'),
			'content' => [
				'Découple les entrées et les sorties les unes des autres et les mélange librement. Les grottes qui étaient une seule entrée ne peuvent toujours sortir qu’au même endroit d’où elles sont entrées.',
			],
		],
	],
];
