<?php
return [
	'header' => 'Was ist der Entrance Randomizer?',
	'subheader' => 'Der Entrance Randomizer erlaubt dir die Welt auf den Kopf zu stellen und das Spiel dennoch zu spielen. Es folgt zumeist den Standard VT Regeln für die Einstellungen für alles, aber es führt eine neue Option ein “' . __('entrance.shuffle.title') . '”.',
	'cards' => [
		'simple' => [
			'header' => __('entrance.shuffle.options.simple'),
			'content' => [
				'Mischt die Dungeon Eingänge untereinander und behällt alle Dungeons mit 4 Eingängen an einem Platz so dass die Dungeons eins zu eins untereinander getauscht werden.',
				'Anders als auf dem Todesberg in der Lichtwelt, wo die Innenräume gemischt werden, aber immer noch zum dem gleichen Punkt auf der Oberwelt verbunden sind. Auf dem Todesberg sind die Eingänge freier miteinander verbunden.',
			],
		],
		'restricted' => [
			'header' => __('entrance.shuffle.options.restricted'),
			'content' => [
				'Nutz die gleiche Mischung für Dungeons wie Simpel, aber die restlichen Eingänge sind freier miteinander verbunden. Höhlen und Dungeon mit mehreren Eingängen sind auf eine Welt beschränkt.',
			],
		],
		'full' => [
			'header' => __('entrance.shuffle.options.full'),
			'content' => [
				'Mischt Höhlen und Dungeon Eingänge uneingeschränkt. Höhlen und Dungeon mit mehreren Eingängen sind auf eine Welt beschränkt.',
			],
		],
		'crossed' => [
			'header' => __('entrance.shuffle.options.crossed'),
			'content' => [
				'Mischt Höhlen und Dungeon Eingänge uneingeschränkt, aber Verbindungshöhlen und Dungeons können nun die Lichtwelt und Schattenwelt miteinander verbinden.',
			],
		],
		'insanity' => [
			'header' => __('entrance.shuffle.options.insanity'),
			'content' => [
				'Entkoppelt Eingänge und Ausgänge und mischt sie uneingeschränkt. Höhlen die im Original Spiel nur einen Eingang haben, können nur an der selben Stelle verlassen werden wo man sie betreten hat.',
			],
		],
	],
];
