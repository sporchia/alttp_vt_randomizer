<?php
return [
    'header' => 'Opciones del randomizer',
    'subheader' => '¡Hay muchas formas distintas de jugar a ALttP:Randomizer!',
    'cards' => [
        'glitches_required' => [
            'header' => __('randomizer.glitches_required.title'),
            'sections' => [
                [
                    'header' => __('randomizer.glitches_required.options.none'),
                    'content' => [
                        'No necesitas ningún conocimiento sobre glitches.',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.overworld_glitches'),
                    'content' => [
                        'Necesitas conocimiento de ciertos glitches mayores (en la superfície del mundo) además de conocimiento de la mayoría de glitches menores. Específicamente:',
                        '<ul>'
                            . '<li><i>Clips</i> con botas en la superfície</li>'
                            . '<li><i>Clips</i> con el espejo en la superfície</li>'
                            . '<li>Reanimación en mazmorras como conejo</li>'
                            . '<li>Súper Conejo</li>'
                            . '<li>Surf como Conejo</li>'
                            . '<li>Andar sobre el agua</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.major_glitches'),
                    'content' => [
                        'Necesitas conocimiento de glitches mayores más avanzados. Específicamente:',
                        '<ul>'
                            . '<li>Overworld fake flutes</li>'
                            . '<li>Flauta falsa en la superfície</li>'
                            . '<li><i>Screenwraps</i> en la superfície</li>'
                            . '<li><i>Clips</i> en la superfície sin botas (incluyendo <i>clips</i> de un frame que requieren hacer <i>buffering</i>)</li>'
                            . '</ul>',
                        'También se introducen cambios adicionales:',
                        '<ul>'
                            . '<li>Los mundos falsos funcionan como en el juego original (por ejemplo, morir en una mazmorra del Mundo Oscuro sin haber derrotado a Agahnim te pone en un falso Mundo Oscuro)</li>'
                            . '<li>Los cristales siempre caerán sin importar conflictos con colgantes (una mejora de calidad de vida desde el original)</li>'
                            . '<li>Los niveles de agua en el Palacio del Pantano no bajan al salir de la pantalla (excepto la primera habitación)</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.glitches_required.options.no_logic'),
                    'content' => [
                        'No se aplica ningún tipo de lógica. Los objetos pueden estar en cualquier sitio. Puede ser imposible conseguir algunos objetos, pero por el poder que tienen los glitches es extremadamente raro que una partida sea incompletable. Esta opción generalmente requerirá uso extensivo de glitches que se excluyen de otras lógicas (incluyendo EG, glitches con puertas, y revivir como conejo en la superfície).',
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
                        'Pensado par anuevos jugadores o gente buscando una experiencia más casual. Existen restricciones lógicas para evitar que haya ítems en localizaciones poco conocidas que requieran conocimientos poco intuitivos para accederse (por ejemplo, acceder la Cueva del Rebotador sin el Gancho). Otras restricciones lógicas aseguran que no se requiere ejecución excesivamente difícil para progresar. Por ejemplo, si tienes que acabar una mazmorra del final del juego siempre tendrás acceso a varias mejoras de espada y defensa en algún lugar del mundo.',
                    ],
                ],
                [
                    'header' => __('randomizer.item_placement.options.advanced'),
                    'content' => [
                        'Pensado para jugadores regulares y participantes en carreras. La intención de esta opción es maximizar la colocación de ítems sin glitches. Hay una única excepción: no se tiene en cuenta atravesar salas oscuras. No se tiene ninguna otra consideración sobre conocimiento poco común o nivel de ejecución necesarios para acceder localizaciones. Se espera al jugar en esta opción que el jugador esté algo familiarizado con el juego original.',
                    ],
                ],
            ],
        ],
        'dungeon_items' => [
            'header' => __('randomizer.dungeon_items.title'),
            'sections' => [
                [
                    'header' => '',
                    'content' => [
                        'Cuando los mapas están barajados fuera de mazmorras, el mapa del mundo no enseñará los premios por completar cada mazmorra sin su mapa. Aún así, los mapas siempre estarán requeridos por lógica para completar mazmorras tanto en colocación de objetos básica y avanzada. El jefe de la mazmorra puede contener el mapa de la misma mazmorra.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.standard'),
                    'content' => [
                        'Todos los ítems de mazmorras están localizados dentro de su respectiva mazmorra, pero están randomizados dentro de ella.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mc'),
                    'content' => [
                        'Los mapas y brújulas no están encerrados en su propia mazmorra (aunque podrían acabar dentro igualmente). Todas las llaves siguen estando dentro de su propia mazmorra.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.mcs'),
                    'content' => [
                        'Los mapas, brújulas y llaves pequñas no están encerrados en su propia mazmorra (aunque podrían acabar dentro igualmente). Las llaves grandes siguen estando dentro de su propia mazmorra.',
                    ],
                ],
                [
                    'header' => __('randomizer.dungeon_items.options.full'),
                    'content' => [
                        'Los mapas, brújulas, llaves pequeñas y llaves grandes no están encerrados en su propia mazmorra (aunque podrían acabar dentro igualmente).',
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
                        'Esta opción asegura que todos los ítems de inventario pueden obtenerse, pero mantiene la posibilidad de que algunas llaves sean imposibles de obtener. Por ejemplo, las llaves grandes no necesarias podrían estar dentro de cofres grandes y algunas llaves pequeñas podrían estar detrás de puertas cerradas (que podrías no poder acceder según cómo uses tus llaves). En práctica acabarás pudiendo acceder casi todas las localizaciones con esta opción.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.locations'),
                    'content' => [
                        'Esta opción aseguro que todas las 216 localizaciones pueden accederse sin importar como se usen las llaves dentro de las mazmorras. Específicamente, las llaves grandes no pueden estar en cofres grandes, y algunos cofres detrás de puertas cerradas no pueden contener llaves pequeñas.',
                    ],
                ],
                [
                    'header' => __('randomizer.accessibility.options.none'),
                    'content' => [
                        'Esta opción solo asegura que el juego puede completarse. Puede que sea imposible conseguir objetos no requeridos (por ejemplo, el Cetro de Fuego cuando no es necesaria para acabar), e incluso entrar a mazmorras no requeridas.',
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
                        'Esta opción requiere completar la Torre de Ganon entera, además de derrotar a Ganon. El número de cristales necesarios para cada uno depende de los requerimientos elegidos.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.fast_ganon'),
                    'content' => [
                        'Esta opción solo requiere derrotar a Ganon y no completar la Torre de Ganon. Para que esto funcione, el agujero que lleva a Ganon es accesible permanentemente (excepto si las entradas también están randomizadas). El número de cristales necesarios depende de los requerimientos elegidos.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.dungeons'),
                    'content' => [
                        'Esta opción requiere completar todas las mazmorras. Esto incluye las 3 mazmorras en el Mundo de la Luz, las 7 en el Mundo Oscuro, la Torre de Agahnim y la Torre de Ganon.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.pedestal'),
                    'content' => [
                        'Esta opción requiere conseguir los 3 colgantes para poder conseguir la Trifuerza en el pedestal en Bosques Perdidos.',
                    ],
                ],
                [
                    'header' => __('randomizer.goal.options.triforce-hunt'),
                    'content' => [
                        '¡La Trifuerza se ha roto en 30 fragmentos esparcidos por todo Hyrule! Tienes que encontrar 20 de las 30 piezas y llevárselas a Murahdahla para recibir la Trifuerza. ¿Que preguntas quién es Murahdahala? ¡Pues obviamente es el hermano menor de Sahasrahla y Aginah! Ha vuelto de sus vacaciones en Lorule y puedes encontrarle pasando el rato en el patio del Castillo de Hyrule.',
                    ],
                ],
            ],
        ],
        'tower_open' => [
            'header' => __('randomizer.tower_open.title'),
            'content' => [
                'Esto te permite elegir el número de cristales necesarios para abrir la Torre de Ganon. Si se elige 0, la mazmorra es accesible desde el principio. Si se elige Aleatorio, habrá un cartel delante de la Torre de Ganon con el número de cristales necesarios. En Inverso este cartel estará fuera del Castillo de Hyrule.',
            ],
        ],
        'ganon_open' => [
            'header' => __('randomizer.ganon_open.title'),
            'content' => [
                'Esto te permite elegir el número de cristales necesarios para hacer que Ganon sea vulnerable a tus ataques. Si se elige 0, ¡se le puede derrotar a la que puedes llegar a él! Si se elige Aleatorio, habrá un cartel en la pirámide con el número de cristales necesarios. En Inverso este cartel estará fuera del Castillo de Hyrule.',
            ],
        ],
        'world_state' => [
            'header' => __('randomizer.world_state.title'),
            'sections' => [
                [
                    'header' => __('randomizer.world_state.options.standard'),
                    'content' => [
                        'Esta opción es la más parecida al juego original. Mantiene el prólogo inicial de rescatar a Zelda en el Castillo de Hyrule y llevarla al Santuario. Hay que completar esta sección antes de poder explorar Hyrule libremente. Tu tío te dará de forma garantizada un ítem que te permita acabar el prólogo (aunque no necesariamente será una espada). Tienes un cono de luz navegando las salas oscuras de las cloacas aunque no tengas la lámpara (pero futuras visitas a salas oscuras, incluídas las propias cloacas, estarán completamente a oscuras hasta encontrar la Lámpara).',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.open'),
                    'content' => [
                        'Esta opción empieza justo después de completar el prólogo inicial. Zelda ya ha sido rescatado y eres libre de empezar desde la casa de Link o el Santuario. Ningún cofre del Castillo de Hyrule ha sido abierto y puedes decidir cuándo visitarlo, si es que quieres.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.inverted'),
                    'content' => [
                        '¡En esta opción Link empieza en el Mundo Oscuro y tiene que encontrar el camino al Mundo de la Luz para derrotar a Ganon! Hay múltiples cambios importantes para que esto funcione:',
                        '<ul>'
                            . '<li>La Torre de Ganon y la de Agahnim han intercambiado su localización.</li>'
                            . '<li>Ganon ha abandonado la Pirámide y está escondiéndose debajo del Castillo de Hyrule.</li>'
                            . '<li>Todos los portales ahora te llevan del Mundo Oscuro al Mundo de la Luz.</li>'
                            . '<li>Link es un conejo en el Mundo de la Luz sin la Perla Lunar.</li>'
                            . '<li>El Espejo Mágico te transporta del Mundo de la Luz al Mundo Oscuro.</li>'
                            . '<li>Los cristales desbloquean la puerta a la rorre del Castillo de Hyrule, en lugar de la Torre de Ganon.</li>'
                            . '</ul>',
                        'Por otra parte, hay otras modificaciones al mundo del juego que eran necesarias para que este concepto funcionara correctamente:',
                        '<ul>'
                            . '<li>La casa de Link y la Tienda de Bombas han intercambiado su localización.</li>'
                            . '<li>La flauta solo funciona en el Mundo Oscuro pero debe ser activada en Kakariko.</li>'
                            . '<li>Muchas partes del terreno del Mundo de la Luz han sido modificadas para que sigan siendo accesibles sin poder usar el Espejo desde el Mundo Oscuro.</li>'
                            . '<li>Las cuevas en la Montaña de la Muerte han cambiado considerablemente. Ahora se puede acceder a la Montaña de la Muerte Oscura desde la parte central del Mundo Oscuro.</li>'
                            . '<li>El abuelo en la Montaña de la Muerte está perdido en el Mundo Oscuro, y hay que llevarlo a su casa en el Mundo de la Luz.</li>'
                            . '<li>La Montaña de la Muerte Oscura ahora tiene una escalera que da acceso a la Torre de Ganon y la parte este de la montaña.</li>'
                            . '<li>El Palacio de Hielo se puede acceder directamente desde el Mundo Oscuro.</li>'
                            . '<li>Roca Tortuga se puede acceder saltando desde su cola.</li>'
                            . '</ul>',
                        'Recuerda que Link conejo puede usar el Libro de Mudora, además de hablar con NPCs y conseguir ítems en el suelo. Las partidas en Inverso pueden ser <strong>muy díficiles</strong> por lo que recomendamos empezar con alguna otra opción.',
                    ],
                ],
                [
                    'header' => __('randomizer.world_state.options.retro'),
                    'content' => [
                        'Esta opción es un regreso al The Legend of Zelda original. Este concepto incluye:',
                        [
                            'header' => 'Arcos de Rupias',
                            'content' => [
                                '<ul>'
                                    . '<li>Ya no usan flechas como munición, ¡en su lugar usan Rupias!</li>'
                                    . '<li>El primer Arco Progresivo solo dispara Flechas de Madera.</li>'
                                    . '<li>El segundo Arco Progresivo puede disparar Flechas de Madera y Flechas de Plata.</li>'
                                    . '<li>Aún así, ningún Arco puede usarse hasta que compras un Carcaj de Rupias.</li>'
                                    . '<li>¡El Carcaj de Rupias cuesta 80 Rupias y solo aparece en una tienda elegida al azar!</li>'
                                    . '<li>Cada Flecha de Madera cuesta 10 Rupias y cada Flecha de Plata cuesta 50.</li>'
                                    . '</ul>',
                            ],
                        ],
                        [
                            'header' => 'Tiendas',
                            'content' => [
                                'Cinco tiendas de nueve posibles se eligen aleatoriamente para contener nuevos objetos. Esto no incluye la Tienda de Bombas o la Tienda de Pociones. Una de estas tiendas contendrá el Carcaj de Rupias a un precio de 80 Rupias. Adicionalmente, se pueden comprar llaves pequeñas en múltiples tiendas por 100 Rupias y no hay límite en cuántas pueden comprarse.',
                            ],
                        ],
                        [
                            'header' => 'Llaves pequeñas',
                            'content' => [
                                'Las llaves pequeñas dejan de ser específicas a mazmorras y pueden usarse para abrir puertas cerradas en cualquier mazmorra. Tampoco están encerradas en su propia mazmorra y pueden encontrarse  en cualquier sitio (como en la superfície). Las llaves debajo de vasijas y las que tienen enemigos se mantienen. Diez llaves se quitan de la reserva de objetos (quince en dificultades altas). Las llaves grandes, mapas y brújulas se mantienen dentro de sus propias mazmorras.',
                            ],
                        ],
                        [
                            'header' => 'Cuevas de Premio',
                            'content' => [
                                'Cinco cuevas/casas aleatorias de una sola entrada (que normalmente no lleven a un objeto) ahora contienen cuevas de premio. Cuatro de estas cuevas ofrecen al jugador le elección entre un Contenedor de Corazón y una Poción Azul, y la quinta lleva a una mejora de espada (que se quita de la reserva normal de objetos). Esto significa que solo hay 3 espadas en localizaciones regulares. Los Contenedores de Corazón son un bonus a los que ya hay en la reserva de objetos. Aún así, no es posible tener más de 20 corazones en total. La Poción Azul requiere que ya tengas una botella.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'entrance_shuffle' => [
            'header' => __('randomizer.entrance_shuffle.title'),
            'subheader' => [
                'Esta opción randomiza dónde te llevan las entradas. Por ejemplo, entrar a la tienda de Kakariko podría llevarte a una fuente de hadas. Diferentes tipos de entradas se agrupan juntas y entonces cada grupo se randomiza. La forma en que se agrupan depende de qué opción se elige. Las transiciones entre zonas del mundo nunca están randomizadas.',
                'Cuevas y mazmorras con múltiples entradas funcionan de forma específica, a menos que se diga lo contrario:',
                '<ul>'
                    . '<li>Todas las entradas se mantienen emparejadas. Esto significa que salir de una de estas cuevas/mazmorras te llevará de vuelta a por donde sea que entraste.</li>'
                    . '<li>Todas las entradas de una cueva/mazmorra con múltiples están confinadas a aparecer en el mismo mundo (no conectan el Mundo de la Luz con el Mundo Oscuro).</li>'
                    . '</ul>',
                'La casa de Link y la entrada superior que lleva a la parte trasera del bar en Kakariko no están randomizadas. Aún así, en ' . __('randomizer.world_state.options.inverted') . ' ' . __('randomizer.world_state.title') . ' la casa de Link (en el Mundo Oscuro) y la Tienda de Bombas (en el Mundo de la Luz) están randomizadas.',
            ],
            'sections' => [
                'none' => [
                    'header' => __('randomizer.entrance_shuffle.options.none'),
                    'content' => [
                        'No entrances are randomized. All entrances lead to their original locations.',
                    ],
                ],
                'simple' => [
                    'header' => __('randomizer.entrance_shuffle.options.simple'),
                    'content' => [
                        'Esta opción utiliza el máximo número de grupos de entrada por tipos. Esto restringe cómo de exhaustivamente se randomizan diferentes entrada con la intención de mantener las cosas simples.',
                        [
                            'header' => 'Mazmorras con una entrada',
                            'content' => [
                                'Todas las entradas están agrupas y randomizadas entre ellas. Esto incluye la sección final de Bosque de Osamentas (que lleva al jefe) pero no incluye ninguna otra de las entradas en la mazmorra.',
                            ],
                        ],
                        [
                            'header' => 'Mazmorras con múltiples entradas (sin Bosque de Osamentas)',
                            'content' => [
                                'Cada una de 4 entradas del Castillo de Hyrule, Palacio del Desierto y Roca Tortuga se agrupan entre ellas. Cada grupo de estos 4 se randomiza entre ellos utilizando mapeado estático. Por ejemplo, si el Castillo de Hyrule y el Palacio del Desierto están randomizados entre ellos, la entrada principal del Desierto lleva a la entrada principal del Castillo, la entrada izquierda del Desierto llevará a la entrada izquierda del Castillo, etc. Aún así, el Castillo de Hyrule no está randomizado en ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . '.',
                            ],
                        ],
                        [
                            'header' => 'Bosque de Osamentas (excluyendo la entrada final)',
                            'content' => [
                                'Todas las entradas (incluyendo los agujeros) se mantienen confinadas en la superfície del Bosque de Osamentas y se randomizan entre ellas. Las entradas en calaveras están randomizadas con otras entradas en calaveras; los agujeros están randomizados con agujeros.',
                            ],
                        ],
                        [
                            'header' => 'Cuevas de una entrada',
                            'content' => [
                                'Todas las entradas están agrupadas y randomizadas entre ellas. Esto no incluye nada en la Montaña de la Muerte del Mundo de la Luz. Ejemplo: casas.',
                            ],
                        ],
                        [
                            'header' => 'Cuevas de múltiples entradas',
                            'content' => [
                                'Todas las entradas están agrupadas y randomizadas entre ellas. Las localizaciones que originalmente consisten de dos entradas (como la casa del sabio de Kakariko) se mantienen conectadas entre ellas mediante una cueva con dos entradas. Esto no incluye nada en la Montaña de la Muerte del Mundo de la Luz.',
                            ],
                        ],
                        [
                            'header' => 'Montaña de la Muerte del Mundo de la Luz',
                            'content' => [
                                'Todas las entradas se mantienen confinadas en la Montaña de la Muerte del Mundo de la Luz y están randomizadas entre ellas. Nótese que la entrada a la Montaña de la Muerte (via la cueva donde está el hombre viejo) no está randomizada.',
                            ],
                        ],
                        [
                            'header' => 'Agujeros en la superfície (excluyendo los del Bosque de Osamentas)',
                            'content' => [
                                'Todos los agujeros están agrupados y randomizados entre ellos. Los agujeros y sus entradas de cueva asignadas se mantienen emparejados. Por ejemplo, caer en un agujero y salir te llevará a la cueva en la superfície asociada con ese agujero, sin importar a qué salas interiores llevase el agujero.',
                            ],
                        ],
                    ],
                ],
                'restricted' => [
                    'header' => __('randomizer.entrance_shuffle.options.restricted'),
                    'content' => [
                        'Como en ' . __('randomizer.entrance_shuffle.options.simple') . ' excepto que todas las entradas que no sean mazmorras (incluyendo todas las cuevas con una entrada, con múltiples entradas, y todas las de la Montaña de la Muerte) están agrupadas y randomizadas entre ellas. Esto incluye la entrada a la Montaña de la Muerte.',
                    ],
                ],
                'full' => [
                    'header' => __('randomizer.entrance_shuffle.options.full'),
                    'content' => [
                        'Como en ' . __('randomizer.entrance_shuffle.options.restricted') . ' excepto que todas las mazmorras (incluyendo de una y múltiples entradas) están también agrupadas con el resto de entradas y randomizadas entre ellas.',
                    ],
                ],
                'crossed' => [
                    'header' => __('randomizer.entrance_shuffle.options.crossed'),
                    'content' => [
                        'Como en ' . __('randomizer.entrance_shuffle.options.full') . ' excepto que cuevas y mazmorras con múltiples entradas dejan de estar confinadas a aparecer todas en el mismo mundo. Esto significa que pueden enlazar el Mundo de la Luz con el Mundo Oscuro.',
                    ],
                ],
                'insanity' => [
                    'header' => __('randomizer.entrance_shuffle.options.insanity'),
                    'content' => [
                        'Como en ' . __('randomizer.entrance_shuffle.options.crossed') . ' excepto que todas las entradas y agujeros están separados entre ellos (excluyendo cuevas de una sola entrada y todo en Bosque de Osamentas). Esto significa que salir por donde entraste te llevará a algún lugar completamente distinto. Aún así, todas las cuevas de una sola entrada solo pueden salir a la misma localización por la que se entraron. Todos los agujeros de la superfície dejan de estar emparejados. Todas las entradas en Bosque de Osamentas siguen estando confinadas a su región (excluyendo la entrada final).',
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
                        'Los jefes no están randomizados. Todos los jefes se mantienen en sus mazmorras originales.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.simple'),
                    'content' => [
                        'Todos los jefes originales (menos Agahnim y Ganon) están randomizados, incluyendo los 3 combates repetidos en Torre de Ganon. En otras palabras, habrá dos copias de Armos Max, Lanmolas, y Moldorm. Esto significa que la Torre de Ganon puede contener 3 jefes aleatorios.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.full'),
                    'content' => [
                        'Igual que ' . __('randomizer.boss_shuffle.options.simple') . ' excepto que los 3 jefes que aparecen dos veces se eligen aleatoriamente.',
                    ],
                ],
                [
                    'header' => __('randomizer.boss_shuffle.options.random'),
                    'content' => [
                        'Todos los jefes se eligen completamente al azar. Puede que veas uno de ellos múltiples veces y otros que nunca aparezcan.',
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
                        'Los enemigos no están randomizados. Todos los enemigos están en su sitio original.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.shuffled'),
                    'content' => [
                        'Todos los enemigos están randomizados, pero hay algunas cosas a tener en cuenta:',
                        '<ul>'
                            . '<li>No todos los enemigos pueden aparecer en cualquier sitio debido a limitaciones en el juego.</li>'
                            . '<li>Salas donde matar a todos los enemigos es necesario para avanzar nunca incluirá enemigos que necesiten armas específicas para matarse (por ejemplo, Mímicos requiriendo el Arco).</li>'
                            . '<li>Los ladrones ahora pueden matarse.</li>'
                            . '<li>Las salas de baldosas voladores no están randomizadas.</li>'
                            . '<li>Los enemigos bajo arbustos no están randomizados.</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_shuffle.options.random'),
                    'content' => [
                        'Igual que ' . __('randomizer.enemy_shuffle.options.shuffled') . '  excepto que los enemigos bajo arbustos, además de la posibilidad de que aparezcan, están randomizados. Esto puede no parecer una gran diferencia, pero en la práctica afecta la jugabilidad drásticamente. Además de esto, las salas de baldosas voladoras aparecen con patrones aleatorios y los ladrones tienen un 50% de probabilidades de ser mortales o invencibles.',
                    ],
                ],
            ],
        ],
        'hints' => [
            'header' => __('randomizer.hints.title'),
            'content' => [
                'Activa o desactiva las pistas que se pueden encontrar en las piedras telepáticas que hay por el mundo.',
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
                'silver' => 'Silver',
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
                    'silvers' => 'El modo Sin Espadas mantiene las Flechas de Plata, pero solo funcionan en la sala de Ganon.',
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
                        'Las cuatro Espadas Progresivas están colocadas aleatoriamente en el juego. Si esta opción se combina con ' . __('randomizer.world_state.options.standard') . ' ' . __('randomizer.world_state.title') . ' entonces tu Tío siempre tendrá una de estas armas:',
                        '<ul>'
                            . '<li>Espada</li>'
                            . '<li>Martillo</li>'
                            . '<li>Arco + Relleno completo de flechas</li>'
                            . '<li>10 Bombas</li>'
                            . '<li>Cetro de Fuego + Relleno completo de magia</li>'
                            . '<li>Vara de Somaria + Relleno completo de magia</li>'
                            . '<li>Vara de Byrna + Relleno completo de magia</li>'
                            . '</ul>',
                        'Si te acabas sin munición o magia, guardando y reiniciando te rellenará parcialmente para que puedas progresar.',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.assured'),
                    'content' => [
                        '¡Link empieza con una espada ya equipada! ¿La habrá tenido escondida bajo su almohada?',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.vanilla'),
                    'content' => [
                        'Las cuatro espadas están en sus localizaciones originales, que son:',
                        '<ul>'
                            . '<li>El Tío de Link</li>'
                            . '<li>Pedestal de la Espada Maestra</li>'
                            . '<li>Rescatando al herrero</li>'
                            . '<li>Hada en la Pirámide</li>'
                            . '</ul>',
                    ],
                ],
                [
                    'header' => __('randomizer.weapons.options.swordless'),
                    'content' => [
                        'Todas las espadas se eliminan del juego y se reemplazan con 20 rupias. Se introducen múltiples cambios para que esto funcione:',
                        '<ul>'
                            . '<li>Ganon puede ser dañado con el Martillo.</li>'
                            . '<li>Ambos Arcos Progresivos están siempre en la reserva de objetos.</li>'
                            . '<li>La barrera del murciélago delante de la Torre de Agahnim se puede romper con el Martillo.</li>'
                            . '<li>Las cortinas/enredaderas dentro de Bosque de Osamentas y la Torre de Agahnim están abiertas desde el principio.</li>'
                            . '<li>Las tabletas de Ether y Bombos requieren el Martillo y el Libro de Mudora.</li>'
                            . '<li>Los medallones solo se pueden usar para abrir Gruta de las Marismas y Roca Tortuga, o para progresar en el Palacio de Hielo. Solo funcionan donde sus emblemas lo indican.</li>'
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
                        'La vida de los enemigos no está randomizada.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.easy'),
                    'content' => [
                        'La vida de todos los enemigos estará en el rando de 1-4 HP (1-2 golpes con la Espada Normal).',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.hard'),
                    'content' => [
                        'La vida de todos los enemigos estará en el rando de 2-15 HP (1-8 golpes con la Espada Normal). La media de vida de los enemigos será por lo general mayor que la original.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_health.options.expert'),
                    'content' => [
                        'La vida de todos los enemigos estará en el rando de 2-30 HP (1-15 golpes con la Espada Normal). Prácticamente todos los enemigos tendrán muchísima más vida que en el original.',
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
                        'El daño que hacen los enemigos no está randomizado.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.shuffled'),
                    'content' => [
                        'El daño que hacen los enemigos está randomizado entre tipos de enemigos. Por ejemplo, el daño hecho por los Octoroks y Ganon puede intercambiarse, ¡por lo que los Octorok harían 8 corazones y Ganon solo 1! Las mejoras de armadura siguen funcionando para reducir daño.',
                    ],
                ],
                [
                    'header' => __('randomizer.enemy_damage.options.random'),
                    'content' => [
                        'El daño que hacen los enemigos es completamente aleatorio. Se elige un valor para cada mejora de armadura, por lo que no funcionan para reducir daño. No existe ninguna diferencia en lógica entre tipos de enemigos. Todos los enemigos podrían hacer daño masivo.',
                    ],
                ],
            ],
        ],
        'post_generation' => [
            'header' => 'Cosmetic Settings (post generation)',
            'cards' => [
                'heart_speed' => [
                    'header' => __('rom.settings.heart_speed'),
                    'content' => [
                        'Cambia la velocidad del sonido cuando Link tiene vida baja.',
                    ],
                ],
                'play_as' => [
                    'header' => __('rom.settings.play_as'),
                    'content' => [
                        'Cambia el <i>sprite</i> con el que juegas (por ejemplo, juega como una taza de té en lugar de Link).',
                    ],
                ],
                'menu_speed' => [
                    'header' => __('rom.settings.menu_speed'),
                    'content' => [
                        'Cambia la velocidad a la que se abre y cierra el menú de objetos. No está disponible para ROMs de carreras.',
                    ],
                ],
                'heart_color' => [
                    'header' => __('rom.settings.heart_color'),
                    'content' => [
                        'Cambia el color de tus corazones. Las elecciones están restringidas por limitaciones del juego.',
                    ],
                ],
                'music' => [
                    'header' => __('rom.settings.music'),
                    'content' => [
                        'Activa o desactiva la música de fondo original. No tienes que desactivar esto si deseas usar paquetes MSU-1. Si se deja activado y se está usando un paquete MSU-1, entonces la música originals se usará como una reserva y solo sonará si hay un error de carga del MSU-1 (en lugar de silencio).',
                    ],
                ],
                'quickswap' => [
                    'header' => __('rom.settings.quickswap'),
                    'content' => [
                        'Permite que el objeto equipado se cambie usando los botones L y R sin abrir el menú. No está disponible para ROMs de carreras (excepto cuando las entradas estén randomizadas).',
                    ],
                ],
                'palette_shuffle' => [
                    'header' => __('rom.settings.palette_shuffle'),
                    'content' => [
                        'Randomiza las paletas de color del juego. Esto significa que todo podria verse muy extraño. ¡Actívalo con cuidado!',
                    ],
                ],
                'reduce_flashing' => [
                    'header' => __('rom.settings.reduce_flashing'),
                    'content' => [
                        'Reduce severamente la intensidad de efectos del juego que parpadeen, o directamente los desactiva. Tener cuidado, tu sensibilidad a los efectos aun puede variar.',
                    ],
                ],
            ],
        ],
        'item_pool' => 'Reserva de Objetos',
    ],
];
