<?php
return [
	'header' => 'Qu’est ce que le Randomizer de Portes ?',
	'subheader' => 'Ce randomiseur suit globalement les règles standards du randomiseur d’items, mais introduit une nouvelle option “' . __('entrance.shuffle.title') . '”.',
	'cards' => [
		'simple' => [
			'header' => __('entrance.shuffle.options.simple'),
			'content' => [
				'Mélange les entrées des donjons entre elles. Si un donjon possède plusieurs entrées elles sont mélangées de telle sorte qu’elles restent toute dans la même zone.',
				'À l’exception de la montagne de la mort côté monde de lumière ou le mélange est plus permissif, les intérieurs sont également mélangés mais sont reliés au même endroit extérieur.',
			],
		],
		'restricted' => [
			'header' => __('entrance.shuffle.options.restricted'),
			'content' => [
				'Les entrées de donjons sont mélangées comme dans le mélange simple, mais les autres entrées sont connectées plus librement. Si une zone possède plusieurs entrées, elles sont toutes dans le même monde.',
			],
		],
		'full' => [
			'header' => __('entrance.shuffle.options.full'),
			'content' => [
				'Mélange les entrées de cavernes et de donjons entre elles. Si une zone possède plusieurs entrées, elles sont toutes dans le même monde.',
			],
		],
		'crossed' => [
			'header' => __('entrance.shuffle.options.crossed'),
			'content' => [
				'Mélange les entrées de cavernes et de donjons entre elles, mais les zones peuvent maintenant se croiser entre monde des ténèbres et monde de lumière.',
			],
		],
		'insanity' => [
			'header' => __('entrance.shuffle.options.insanity'),
			'content' => [
				'Sépare les entrées et les sorties des zones et mélange le tout. Les cavernes qui ne possèdent qu’une seule entrée dans le jeu de base ressortent quand même au même endroit.',
			],
		],
	],
];
