<?php
return [
	'header' => 'Opciones',
	'subheader' => '¡Hay muchas formas distintas de jugar a ALttP:Randomizer!',
	'cards' => [
		'mode' => [
			'header' => __('randomizer.mode.title'),
			'sections' => [
				[
					'header' => __('randomizer.mode.options.standard'),
					'content' => [
						'Este modo es lo más parecido al juego original. Empiezas en la cama de Link, consigues un arma de tu tío (dependiendo de tus opción para Espadas, explicadas abajo), y rescatas a Zelda antes de continuar con el resto del juego.',
					],
				],
				[
					'header' => __('randomizer.mode.options.open'),
					'content' => [
						'Este modo empieza con la opción de empezar en tu casa o en el santuario, y eres libre para explorar. Hay unas cuantas características de este modo a tener en cuenta:',
						'<ul>'
							. '<li>El tío ya está en las cloacas del castillo y tiene un ítem.</li>'
							. '<li>Las salas oscuras no tienen un cono de luz por defecto, ni siquiera las cloacas.</li>'
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
							. '<li>The old man has decided to “get lost” the Dark World. You’ll still have to return him to his cave in the Light World</li>'
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
						'Todas las mejoras de espada están randomizadas. No empezarás con una espada, y puede que tardes un tiempo en tener una. ¡Las bombas son una buena arma inicial, al igual que arbustos y señales! Usa cualquier ítem que te encuentres para defenderte.',
						'Si esta opción se combina con el Modo Estándar (ver arriba), tu tío te dará encantado uno de los siguientes ítems para asegurar que puedes completar la secuencia de escape:',
						'<ul>'
							. '<li>Mejora de espada (sí, sigue siendo posible)</li>'
							. '<li>Martillo</li>'
							. '<li>Arco + Repuesto Entero de Flechas</li>'
							. '<li>Repuesto Entero de Bombas</li>'
							. '<li>Cetro de fuego + Relleno Entero de Magia</li>'
							. '<li>Vara de Somaria + Relleno Entero de Magia</li>'
							. '<li>Vara of Byrna + Relleno Entero de Magia</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.weapons.options.uncle'),
					'content' => [
						'Tu tío siempre tiene una espada. El resto de mejoras están randomizadas.',
					],
				],
				[
					'header' => __('randomizer.weapons.options.swordless'),
					'content' => [
						'Todas las espadas han desaparecido del juego. Ya que el juego espera uque tengas una espada, para este Modo Sin Espadas se hacen los siguientes cambios:',
						'<ul>'
							. '<li>Las espadas se cambian por cuatro copias de 20 rupias (una rupia verde con un "20" al lado).</li>'
							. '<li>La barrera que bloquea el acceso a la Torre de Agahnim puede romperse con el Martillo.</li>'
							. '<li>Las cortinas bloqueando el progreso en la Torre de Agahnim están pre-abiertas, al igual que las enredaderas en Bosque de Osamentas.</li>'
							. '<li>Los medallones solo se pueden usar para abrir la Gruta de Las Marismas o Roca Tortuga, o para progresar en el Palacio de Hielo. Normalmente requerirían una espada para usarse.</li>'
							. '<li>Ganon ahora recibe daño del Martillo.</li>'
							. '<li>Las Flechas de Plata están disponibles en todas las dificultades.</li>'
							. '<li>Las tabletas de Ether y Bombos requieren el Martillo y el Libro de Mudora.</li>'
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
						'Este modo no require conocimiento avanzado del juego. Está diseñado como si estuvieras jugando al juego original por primera vez.',
						'En este modo se previene que puedas quedarte atascado, sin importar cómo uses las llaves pequeñas en mazmorras.',
						'Puede que estés obligado a guardar y salir en ciertas situaciones, como para volver al Mundo de la Luz cuando estás en el Mundo Oscuro sin el Espejo.',
					],
				],
				[
					'header' => __('randomizer.logic.options.OverworldGlitches'),
					'content' => [
						'Este modo <span class="running-now">requiere</span> algunos de los glitches de la superfície más fáciles de ejecutar. ¡Es más difícil que simplemente usar Aletas Falsas para visitar al vagabundo! Los dos tipos de glitches mayores que se necesitan son:',
						'<ul>'
							. '<li><i>Clipping</i> con las botas en la superfície</li>'
							. '<li><i>Clipping</i> con el espejo (<i>DMD</i>, <i>TR Middle Clip</i>, y <i>Fluteless Mire</i>)</li>'
						. '</ul>',
						'La mayoría de glitches menores también se tienen en cuenta:',
						'<ul>'
							. '<li>Aletas Falsas (da acceso al Palacio de Hielo, al Rey Zora, a la Pieza de Corazón del Lago Hylia, y al Vagabundo sin tener las Aletas)</li>'
							. '<li><i>Bunny Revival</i> en mazmorras (da acceso al Palacio de Hielo sin la Perla Lunar)</li>'
							. '<li><i>Bunny Revival</i> en la superfície (da acceso a la Gruta de las Marismas y a la caseta a su lado sin la Perla Lunar y sin hacer <i>DMD</i>)</li>'
							. '<li><i>Super Bunny</i> (da acceso a dos cofres en la Montaña de la Muerte en el Mundo Oscuro sin la Perla Lunar)</li>'
							. '<li><i>Surfing Bunny</i> (da acceso a la Pieza de Corazón del Lago Hylia sin la Perla Lunar)</li>'
							. '<li>Caminar sobre el agua (da acceso a la Pieza de Corazón de la Región de los Zora sin las Aletas)</li>'
						. '</ul>',
						'Los siguientes glitches NO se tienen en cuenta en la lógica, por lo que nunca estarás forzado a usarlos:',
						'<ul>'
							. '<li><i>Clips</i> sin las Botas</li>'
							. '<li><i>Screenwraps</i> con el Espejo</li>'
							. '<li><i>YBAs</i> en la superfície</li>'
							. '<li><i>Clips</i> en el submundo</li>'
							. '<li>Navegar por salas oscuras</li>'
							. '<li><i>Hovering</i></li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.MajorGlitches'),
					'content' => [
						'Este modo tiene en cuenta absolutamente todo menos <i>EG</i> y <i>semi-EG</i>. Este modo es extremadamente difícil y require conocimiento avanzado de glitches mayores, incluyendo:',
						'<ul>'
							. '<li><i>YBA</i> en la superfície</li>'
							. '<li><i>Clippear</i> fuera de limites</li>'
							. '<li><i>Screenwraps</i></li>'
						. '</ul>',
						'Se han hecho algunos cambios adicionales para que el juego funcione correctamente bajo esta lógica:',
						'<ul>'
							. '<li>El Mundo Oscuro falso no está arreglado. Los cristales siempre caerán, sin importar conflictos con colgantes</li>'
							. '<li>Los niveles de agua en el Palacio del Pantano no bajan al salir de su pantalla en la superfície, excepto la primera sala.</li>'
							. '<li>Siempre vuelves a la pirámide al guardar y cargar en el Mundo Oscuro tras derrotar a Agahnim.</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.logic.options.None'),
					'content' => [
						'No existe ningún seguro sobre donde acaban los ítems, buena suerte si juegas esta opción.',
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
						'Básicamente como el juego normal, tu meta será conseguir los siete cristales, subir por la Torre de Ganon, y derrotar a Ganon',
					],
				],
				[
					'header' => __('randomizer.goal.options.dungeons'),
					'content' => [
						'Necesitarás derrotar a todos los jefes en las mazmorras de Hyrule, incluyendo ambas versiones de Agahnim. Solo entonces puedes retar a Ganon.',
					],
				],
				[
					'header' => __('randomizer.goal.options.pedestal'),
					'content' => [
						'¡Consigue los Colgantes del Valor, la Sabiduría y el Poder, y consigue la Trifuerza en el pedestal! Ojo, puede que tengas que aventurarte por todo Hyrule, incluyendo la Torre de Ganon, para poder completar esta aventura.',
					],
				],
				[
					'header' => __('randomizer.goal.options.triforce-hunt'),
					'content' => [
						'¡La Trifuerza se ha roto en 30 fragmentps esparcidos por todo Hyrule! ¡Consigue 20 piezas fragmentos para ganar!',
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
						'Modo recomendado para nuevos jugadores. "Fácil", hace que viajar por Hyrule sea un poco más seguro.',
						'Encontrar la segunda ½ Magia la mejora a ¼ Magia.',
						'En Modo Estándar, si tu tío tiene el Arco, las Bombas, el Cetro de Fuego, la Vara de Somaria, o la Vara de Byrna, Link tendrá munición ilimitada para ese ítem durante toda la secuencia de escape.',
						'Ver la tabla de Comparación de Dificultad más abajo para detalles completos.',
					],
				],
				[
					'header' => __('randomizer.difficulty.options.normal'),
					'content' => [
						'En este modo encontrarás todos los ítems que hay en el juego original.',
					],
				],
				[
					'header' => sprintf('%s, %s, and %s', __('randomizer.difficulty.options.hard'), __('randomizer.difficulty.options.expert'), __('randomizer.difficulty.options.insane')),
					'content' => [
						'¿Buscas un reto? ¡Estas dificultades avanzadas ajustan el juego incluso más para poner a prueba tus habilidades! Mira la comparación abajo para más detalles.',
					],
				],
				[
					'header' => __('randomizer.goal.options.triforce-hunt'),
					'content' => [
						'¡La Trifuerza se ha roto en 30 fragmentps esparcidos por todo Hyrule! ¡Consigue 20 piezas fragmentos para ganar!',
					],
				],
			],
			'comparison' => [
				'header' => 'Comparación de Dificultad',
				'maximum_health' => 'Vida Máxima',
				'heart_containers' => 'Contenedores de Corazón',
				'heart_pieces' => 'Piezas de Corazón',
				'maximum_mail' => 'Armadura Máxima',
				'number_in_pool' => '# en Reserva',
				'maximum_sword' => 'Espada Máxima',
				'maximum_shield' => 'Escudo Máximo',
				'shields_store' => 'Puedes Comprar Escudos',
				'maximum_magic' => 'Máxima Capacidad de Magia',
				'number_silvers' => '# de Flechas de Plata',
				'number_silvers_swordless' => '# de Flechas de Plata (Sin Espadas)',
				'number_bottles' => '# de Botellas',
				'number_lamps' => '# de Lámparas',
				'potion_magic' => 'Recuperación de Magia con Botellas',
				'potion_health' => 'Recuperación de Vida con Botellas',
				'bug_net_fairy' => 'Cazamariposas Captura Hadas',
				'powder_bubble' => 'Polvo Mágico en Bubbles',
				'cape_consumption' => 'Ratio de Uso de Magia de la Capa',
				'byrna_invincible' => 'Byrna Da Invencibilidad',
				'stun_boomerang' => 'Bumerán Aturde Enemigos',
				'stun_hookshot' => 'Gancho Aturde Enemigos',
				'capacity_upgrade' => 'Mejoras de Capacidad de Flechas / Bombas',
				'drop_rates' => '<i>Drop Rates</i> de Enemigos',
				'quarter' => 'Cuarto',
				'half' => 'Medio',
				'normal' => 'Normal',
				'shield_3' => 'Espejo',
				'shield_2' => 'Rojo',
				'shield_1' => 'Pequeño',
				'none' => 'Ninguno',
				'sword_4' => 'Dorada',
				'sword_3' => 'Templada',
				'sword_2' => 'Maestra',
				'mail_3' => 'Roja',
				'mail_2' => 'Azul',
				'mail_1' => 'Verde',
				'fairy' => 'Hada',
				'heart' => 'Corazón',
				'bee' => 'Abejas',
				'yes' => 'Sí',
				'no' => 'No',
				'tooltip' => [
					'silvers' => 'Las Flechas de Plata solo funcionan en la sala de Ganon.',
					'bottles' => 'Una vez las 4 Botellas se hayan encontrado, el resto de Botellas se convierten en rupias.',
					'potion_magic' => 'Las pociones rellenan 100% de la magia en la Cueva de los Pinchos.',
					'potion_health' => 'Las pociones rellenan 20 corazones en la Cueva de los Pinchos.',
				],
			],
		],
		'variation' => [
			'header' => __('randomizer.variation.title'),
			'sections' => [
				[
					'header' => __('randomizer.variation.options.none'),
					'content' => [
						'Lo más parecido al juego normal.',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-race'),
					'content' => [
						'El cronómetro empieza en 0, con el objetivo de acabar el juego con el mejor tiempo posible. Hay ítems por el mundo que afectarán al cronómetro, por lo que acabar primero no significa necesariamente ser el ganador.',
						'¿Gastarás tu tiempo buscando un reloj para bajar tu tiempo, o irás corriendo hacia el final?',
						'Los siguientes objetos se añaden a la reserva:',
						'<ul>'
							. '<li>20 Relojes Verdes que restan 4 minutes del cronómetro</li>'
							. '<li>10 Relojes Azules que restan 2 minutos del cronómetro</li>'
							. '<li>10 Relojes Rojos que suman 2 minutos al cronómetro</li>'
						. '</ul>',
					],
				],
				[
					'header' => __('randomizer.variation.options.timed-ohko') . ' (One Hit Kockout)',
					'content' => [
						'En este modo empiezas con tiempo en tu cronómetro, y cualquier reloj verde encontrado le añade tiempo.',
						'Si tu cronómetro llega a 0, entras en Muerte Súbita, en que cualquier golpe te mata.',
						'¡No te desesperes! Si estás en Muerte Súbita y encuentras otro reloj, saldrás de ese modo y conseguirás más tiempo para tu reloj, sin importar cuánto tiempo lleves en Muerte Súbita.',
					],
					'ohko_table' => [
						'minutes' => 'minutos',
						'start_time' => 'Tiempo Inicial',
						'green_clock' => 'Relojes Verdes (+4 minutos)',
						'red_clock' => 'Relojes Rojos (Muerte Súbita directa)',
					],
				],
				[
					'header' => __('randomizer.variation.options.ohko') . ' (One Hit Kockout)',
					'content' => [
						'Recibe daño, y Link estira la pata. No apto para cardíacos.',
					],
				],
				[
					'header' => __('randomizer.variation.options.key-sanity'),
					'content' => [
						'¿El juego no es suficientemente aleatorio para ti? ¿Buscando un reto de verdad?',
						'¡DE ACUERDO!',
						'¡Todos los Mapas, Brújulas y Llaves encontradas en cofres ya no están ligadas a sus mazmorras!',
						'Necesitarás buscar por todas partes para encontrar las llaves que necesitas para progresar por cada mazmorra. Las llaves encontradas en enemigos o bajo vasijas siguen en su sitio.',
						'Adicionalmente, Mapas y Brújulas tienen más valor: Tu mapa del mundo no enseñará información de ninguna mazmorra hasta que consigas el mapa de alguna (y si creías que la música podría guiarte, lo sentimos, eso también ha sido randomizado). Las Brújulas, por su parte, enseñan cuántos cofres has abierto en una mazmorra una vez la consigas.',
						'Te estarás preguntando como sabes qué llave / mapa / brújula has encontrado. No te preocupes: Habrá un texto que te permite saber a qué mazmorra pertenece. El menú también tiene una tabla para ayudarte a no perder la cuenta.',
						'Mapas y Brújulas se requieren por la lógica para poder completar sus respectivas mazmorras.',
					],
				],
				[
					'header' => __('randomizer.variation.options.retro'),
					'content' => [
						'Un regreso al primer juego de The Legend of Zelda, ' . __('randomizer.variation.title') . ' ' . __('randomizer.variation.options.retro') . ' nos enlaza incluso más al pasado.',
						[
							'header' => 'Arco de Rupias',
							'content' => [
								'El arco ya no usa flechas como munición. En su lugar, ¡usa rupias! Cada Flecha de Madera cuesta 10 rupias, mientras que cada Flecha de Plata cuesta 50.',
								'Las Flechas de Madera son independientes del Arco, como las Flechas de Plata; necesitas conseguir tanto el Arco como uno de los dos tipos de flecha para poder usar el Arco.',
								'Las Flechas de Madera ahora son un objeto a conseguir, y deben comprarse una sola vez en una tienda. NO están disponibles en cofres normales o en cualquier sitio fuera de tiendas.',
								'Si encuentras las Flechas de Plata sin haber comprado las Flechas de Madera, solo podrás disparar Flechas de Plata.',
							],
						],
						[
							'header' => 'Tiendas por el Mundo',
							'content' => [
								'Cinco tiendas de nueve posibles se eligen al azar cuando se genera la ROM para tener nuevos productos. Esto NO incluye la Tienda de Súper Bombas o la Tienda de Pociones de la bruja. La Flecha de Madera estará a la venta por 80 rupias, y habrá Llaves Pequeñas disponibles a 100 rupias la pieza. Las Llaves Pequeñas pueden comprarse múltiples veces.',
							],
						],
						[
							'header' => 'Llaves Pequeñas',
							'content' => [
								'Las Llaves Pequeñas ya no son específicas a cada mazmorra. Ahora están mezcladas entre el resto de ítems, y pueden encontrarse fuera de mazmorras. Las llaves encontradas en enemigos o bajo vasijas siguen en su sitio.',
								'Diez llaves se quitan de la reserva de objetos en Fácl y Normal; de quitan quince en Difícil, Experto y Locura. Piénsalo con calma antes de usar tus llaves, ¡y recuerda que siempre puedes comprarlas si te quedas atascado!',
								'Llaves Grandes, Mapas, y Brújulas se mantienen específicos a cada mazmorra y no se han randomizado fuera de ellas.',
							],
						],
						[
							'header' => 'Cuevas de Premio',
							'content' => [
								'Cuatro cuevas con una entrada y casas que no llevan a algún ítem elegidas aleatoriamente llevan a Cuevas de Premio donde los jugadores pueden elegir entre un Contenedor de Corazón o una Poción Azul. Los Contenedores de Corazón no se han movido de la reservas general y bonus de objetos. Aún así, no es posible tener más de 20 corazones a la vez.',
								'Una cueva aleatoria de una sola entrada contiene un misterioso pero familiar hombre viejo con una mejora de espada. Esta mejora existe en lugar de otra en la reserva de objetos.',
							],
						],
					],
				],
			],
		],
		'item_pool' => 'Reserva de Objetos',
	],
];
