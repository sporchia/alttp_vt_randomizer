<?php
return [
	'header' => '¿Qué es el Randomizer de Entradas?',
	'subheader' => 'El Randomizer de Entradas te permite poner el mundo patas arriba y jugar al juego. Debería seguir las normas estándar de VT para todas las opciones, pero introduce le nueva opción “' . __('entrance.shuffle.title') . '”.',
	'cards' => [
		'simple' => [
			'header' => __('entrance.shuffle.options.simple'),
			'content' => [
				'Mezcla las entradas a mazmorras entre ellas y mantiene todas las mazmorras con 4 entradas en una sola localización, de forma que las mazmorras se intercambian completamente entre ellas.',
				'Aparte de la Montaña de la Muerte en el Mundo de la Luz, los interiores están randomizados pero siguen conectando a los mismos puntos en en mapa. En la Montaña de la Muerte, las entradas están conectadas de forma más libre.',
			],
		],
		'restricted' => [
			'header' => __('entrance.shuffle.options.restricted'),
			'content' => [
				'Utiliza la mezcla de mazmorras de "Simple", pero conecta de forma libre el resto de entradas. Las cuevas y mazmorras con múltiples entradas estarán restringidas al mismo mundo.',
			],
		],
		'full' => [
			'header' => __('entrance.shuffle.options.full'),
			'content' => [
				'Mezcla entradas de cuevas y mazmorras libremente. Las cuevas y mazmorras con múltiples entradas estarán restringidas al mismo mundo.',
			],
		],
		'crossed' => [
			'header' => __('entrance.shuffle.options.crossed'),
			'content' => [
				'Mezcla entradas de cuevas y mazmorras libremente, pero las cuevas o mazmorras con las que conecten pueden ir tanto al Mundo de la Luz como al Mundo Oscuro.',
			],
		],
		'insanity' => [
			'header' => __('entrance.shuffle.options.insanity'),
			'content' => [
				'Separa entradas de sus salidad y las mezcla de forma libre. Las cuevas con una sola entrada en <i>vanilla</i> solo pueden salir por la misma localización en la que se entraron.',
			],
		],
	],
];
