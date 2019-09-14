<?php
return [
    'header' => 'Opciones',
    'subheader' => '¡Hay muchas formas distintas de jugar a ALttP:Randomizer!',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'Este modo no require conocimiento avanzado del juego. Está diseñado como si estuvieras jugando al juego original por primera vez.',
                        'En este modo se previene que puedas quedarte atascado, sin importar cómo uses las llaves pequeñas en mazmorras.',
                        'Puede que estés obligado a guardar y salir en ciertas situaciones, como para volver al Mundo de la Luz cuando estás en el Mundo Oscuro sin el Espejo.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
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
                            . '<li><i>YBAs</i> en la superfície</li>'
                            . '<li><i>Clips</i> en el submundo</li>'
                            . '<li>Navegar por salas oscuras</li>'
                            . '<li><i>Hovering</i></li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.major_glitches'),
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
                    'header' => __('randomizer.glitches_required.options.no_logic'),
                    'content' => [
                        'No existe ningún seguro sobre donde acaban los ítems, buena suerte si juegas esta opción.',
                    ],
                ],
            ],
        ],
        'item_placement' => [
            'header' => __('randomizer.item_placement.title'),
            'sections' => [
                [
                    'header' => __('randomizer.item_placement.options.basic'),
                    'content' => [
                        'This is mostly aimed at newer players.',
                    ],
                ],
                [
                    'header' => __('randomizer.item_placement.options.advanced'),
                    'content' => [
                        'The intention of this setting is to maximise glitchless item placement reach. An exception is made to prevent navigation through dark rooms. No other consideration is given to the difficulty of execution or obscurity of item placements. The expectation is a player choosing this setting is decently familiar and practiced with the original game and/or No Major Glitches speedrun.',
                    ],
                ],
            ],
        ],
        'dungeon_items' => [
            'header' => __('randomizer.dungeon_items.title'),
            'sections' => [
                [
                    'header' => __('randomizer.dungeon_items.options.standard'),
                    'content' => [
                        'All dungeons items are locked to their respective dungeons.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mc'),
                    'content' => [
                        'Maps and compasses are randomized freely into the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mcs'),
                    'content' => [
                        'Maps, compasses and small keys are randomized freely into the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.full'),
                    'content' => [
                        'Maps, compasses, small keys and big keys are randomized freely in to the world.',
                    ],
                ],
            ],
        ],
        'accessibility' => [
            'header' => __('randomizer.accessibility.title'),
            'sections' => [
                [
                    'header' => __('randomizer.accessibility.options.items'),
                    'content' => [
                        '<ul>'
                            . '<li>It is <strong>not</strong> guaranteed that you can reach every item location</li>'
                            . '<li>It is guaranteed that you can obtain every unique inventory item</li>'
                            . '<li>It is <strong>not</strong> guaranteed that you can obtain all small/big keys</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.locations'),
                    'content' => [
                        '<ul>'
                            . '<li>It is guaranteed that you can reach every item location</li>'
                            . '<li>It is guaranteed that you can obtain every unique inventory item</li>'
                            . '<li>It is guaranteed that you can obtain all small/big keys</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.none'),
                    'content' => [
                        '<ul>'
                            . '<li>It is <strong>not</strong> guaranteed that you can reach every item location</li>'
                            . '<li>It is <strong>not</strong> guaranteed that you can obtain every unique inventory item</li>'
                            . '<li>It is <strong>not</strong> guaranteed that you can obtain all small/big keys</li>'
                            . '</ul>',
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
                    'header' => __('randomizer.goal.options.fast_ganon'),
                    'content' => [
                        'Similar to ' . __('randomizer.goal.options.ganon') . ', your goal will be to collect all required crystals and defeat Ganon, however defeating Agahnihm at the top of Ganon’s Tower is not necessarily required. Thus, if entrance shuffle is not enabled, the entrance to Ganon will already be open.',
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
                        'The Triforce has been shattered and scattered into 30 pieces throughout Hyrule! Collect 20 pieces and take them to <del>Sahasrahla</del> to win!',
                        'Wait? Who do we take these silly pieces to? Well Murahdahla of course!',
                        'Who’s Murahdahla? I hear you ask. Murahdahla is the younger brother of Sahasrahla and Aginah. Back from vacation in Lorule. He has some mystic powers so be sure to have a chat with him in the Castle Courtyard.',
                    ],
                ],
            ],
        ],
        'tower_open' => [
            'header' => __('randomizer.tower_open.title'),
            'sections' => [
                [
                    'header' => '0 - 7',
                    'content' => [
                        'Pick the number of Crystals required to open the way to Ganon’s Tower.',
                    ],
                ],
                [
                    'header' => __('randomizer.tower_open.options.random'),
                    'content' => [
                        'This will pick a random value from above for entry into Ganon’s Tower.',
                    ],
                ],
            ],
        ],
        'ganon_open' => [
            'header' => __('randomizer.ganon_open.title'),
            'sections' => [
                [
                    'header' => '0 - 7',
                    'content' => [
                        'Pick the number of Crystals required to defeat to Ganon.',
                    ],
                ],
                [
                    'header' => __('randomizer.ganon_open.options.random'),
                    'content' => [
                        'This will pick a random value from above to defeat Ganon.',
                    ],
                ],
            ],
        ],
        'world_state' => [
            'header' => __('randomizer.world_state.title'),
            'sections' => [
                [
                    'header' => __('randomizer.world_state.options.standard'),
                    'content' => [
                        'Este modo es lo más parecido al juego original. Empiezas en la cama de Link, consigues un arma de tu tío (dependiendo de tus opción para Espadas, explicadas abajo), y rescatas a Zelda antes de continuar con el resto del juego.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'Este modo empieza con la opción de empezar en tu casa o en el santuario, y eres libre para explorar. Hay unas cuantas características de este modo a tener en cuenta:',
                        '<ul>'
                            . '<li>El tío ya está en las cloacas del castillo y tiene un ítem.</li>'
                            . '<li>Las salas oscuras no tienen un cono de luz por defecto, ni siquiera las cloacas.</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
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
                            . '<li>Since Agahnim decided to move on up, that means Ganon’s Tower came on down to Hyrule Castle, that center door being in the entrance, you’ll still need the required crystals to enter though</li>'
                            . '<li>Ice Palace tore down the wall so you can swim there pretty early now</li>'
                            . '<li>Remember a bunny can use the ' . __('item.BookOfMudora') . ' as well as talk to people, and collect items it sees lying on the ground</li>'
                            . '<li>The top of Turtle Rock can be accessed by walking on it’s tail</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
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
        'entrance_shuffle' => [
            'header' => __('randomizer.entrance_shuffle.title'),
            'subheader' => 'El Randomizer de Entradas te permite poner el mundo patas arriba y jugar al juego.',
            'sections' => [
                'none' => [
                    'header' => __('randomizer.entrance_shuffle.options.none'),
                    'content' => [
                        'No entrance shuffling is applied.',
                    ],
                ],
                'simple' => [
                    'header' => __('randomizer.entrance_shuffle.options.simple'),
                    'content' => [
                        'Mezcla las entradas a mazmorras entre ellas y mantiene todas las mazmorras con 4 entradas en una sola localización, de forma que las mazmorras se intercambian completamente entre ellas.',
                        'Aparte de la Montaña de la Muerte en el Mundo de la Luz, los interiores están randomizados pero siguen conectando a los mismos puntos en en mapa. En la Montaña de la Muerte, las entradas están conectadas de forma más libre.',
                    ],
                ],
                'basic' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'Utiliza la mezcla de mazmorras de "Simple", pero conecta de forma libre el resto de entradas. Las cuevas y mazmorras con múltiples entradas estarán restringidas al mismo mundo.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'Mezcla entradas de cuevas y mazmorras libremente. Las cuevas y mazmorras con múltiples entradas estarán restringidas al mismo mundo.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'Mezcla entradas de cuevas y mazmorras libremente, pero las cuevas o mazmorras con las que conecten pueden ir tanto al Mundo de la Luz como al Mundo Oscuro.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'Separa entradas de sus salidad y las mezcla de forma libre. Las cuevas con una sola entrada en <i>vanilla</i> solo pueden salir por la misma localización en la que se entraron.',
                    ],
                ],
            ],
        ],
        'bosses' => [
            'header' => __('randomizer.boss_shuffle.title'),
            'sections' => [
                [
                    'header' => __('randomizer.boss_shuffle.options.none'),
                    'content' => [
                        'Bosses will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.simple'),
                    'content' => [
                        'The normal number of each boss shuffled in their different locations, so expect to see armos knights, lanmolas, and moldorm twice.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.full'),
                    'content' => [
                        'Similar to ' . __('randomizer.boss_shuffle.options.simple') . ', except that 3 bosses are chosen at random to be seen twice.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.random'),
                    'content' => [
                        'All bosses chosen at random, you may see any boss multiple times as well as not see a boss at all.',
                    ],
                ],
            ],
        ],
        'enemy_shuffle' => [
            'header' => __('randomizer.enemy_shuffle.title'),
            'sections' => [
                [
                    'header' => __('randomizer.enemy_shuffle.options.none'),
                    'content' => [
                        'Enemies will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.shuffled'),
                    'content' => [
                        'Enemies are shuffled, Thieves are killable, Tile rooms are not random, Enemies are not random under bushes.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.random'),
                    'content' => [
                        'Anything goes with enemies.',
                    ],
                ],
            ],
        ],
        'hints' => [
            'header' => __('randomizer.hints.title'),
            'content' => [
                'Enable or disable the hints found on telepathic tiles throughout the world.',
            ],
        ],
        'difficulty' => [
            'header' => __('randomizer.difficulty.title'),
            'item_pool' => __('randomizer.item_pool.title'),
            'item_functionality' => __('randomizer.item_functionality.title'),
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
                    'header' => __('randomizer.weapons.options.assured'),
                    'content' => [
                        'Link starts with a sword in his hands, prepared to take on the world.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.vanilla'),
                    'content' => [
                        'Link will be able to find the four swords in their regular locations.',
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
        'enemy_health' => [
            'header' => __('randomizer.enemy_health.title'),
            'sections' => [
                [
                    'header' => __('randomizer.enemy_health.options.default'),
                    'content' => [
                        'Enemy Health will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.easy'),
                    'content' => [
                        'All enemy health will be in the 1-4 hp range.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.hard'),
                    'content' => [
                        'All enemy health will be in the 2-15 hp range.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.expert'),
                    'content' => [
                        'All enemy health will be in the 2-30 hp range.',
                    ],
                ],
            ],
        ],
        'enemy_damage' => [
            'header' => __('randomizer.enemy_damage.title'),
            'sections' => [
                [
                    'header' => __('randomizer.enemy_damage.options.default'),
                    'content' => [
                        'Enemy damage will not be randomized in any way.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.shuffled'),
                    'content' => [
                        'The damage enemies do will be shuffled.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.random'),
                    'content' => [
                        'The damage enemies do will be completely randomized.',
                    ],
                ],
            ],
        ],
        'post_generation' => [
            'header' => 'Post Generation (cosmetic)',
            'cards' => [
                'heart_speed' => [
                    'header' => __('rom.settings.heart_speed'),
                    'content' => [
                        'Change the heart beep speed when Link is low on health.',
                    ],
                ],
                'play_as' => [
                    'header' => __('rom.settings.play_as'),
                    'content' => [
                        'You may choose a new sprite for Link and enjoy Hyrule as this character.',
                    ],
                ],
                'menu_speed' => [
                    'header' => __('rom.settings.menu_speed'),
                    'content' => [
                        'Only allowed in some configurations, When available this will allow you to set the speed of the menu opening and closing.',
                    ],
                ],
                'heart_color' => [
                    'header' => __('rom.settings.heart_color'),
                    'content' => [
                        'For players with color-blindness, we have a few options so they know how much health they have.',
                    ],
                ],
                'music' => [
                    'header' => __('rom.settings.music'),
                    'content' => [
                        'Enable or disable the background music so you can listen to your our sweet tracks.',
                    ],
                ],
                'quickswap' => [
                    'header' => __('rom.settings.quickswap'),
                    'content' => [
                        'Only allowed in some configurations, When available this will allow you to use L and R buttons to change items without opening the menu.',
                    ],
                ],
                'palette_shuffle' => [
                    'header' => __('rom.settings.palette_shuffle'),
                    'content' => [
                        'Shuffles the colors of the game around, an Enemizer staple.',
                    ],
                ],
            ],
        ],
        'item_pool' => 'Reserva de Objetos',
    ],
];
