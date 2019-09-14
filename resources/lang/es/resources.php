<?php
return [
    'header' => 'Recursos',
    'cards' => [
        'discord' => [
            'header' => 'Discord',
            'content' => [
                '<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer" role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
                '¡Únete a nuestra comunidad de Discord! Tenemos gente amistosa y dispuesta a ayudar, noticias de eventos de la comunidad, actualizaciones de ALttP: Randomizer, guías, consejos, trucos, ¡y más! ¡Ven a decir hola y entra al canal #resources!',
            ],
        ],
        'learn' => [
            'header' => 'Vídeos para Aprender a Jugar',
            'content' => [
                '<div class="center"><a class="btn btn-secondary btn-lg btn-xl" href="https://www.youtube.com/channel/UCBMMk0WJAeldNv4fI9juovA" role="button">Canal de YouTube de ALttP:R</a></div>',
                '¡Mira nuestras guías sobre rutas, tutoriales de glitches, anuncios de nuevas actualizaciones, momentos destacados de torneos, y más! ¡Perfecto tanto para nuevos jugadores buscando aprender como para runners con experiencia buscando refinar sus habilidades! (Tutoriales en inglés)',
            ],
        ],
        'external' => [
            'header' => 'Recursos Externos (en inglés)',
            'content' => [
                '<ul>'
                    . '<li><a href="https://alttprlinks.page.link/QxvY" target="_blank" rel="noopener noreferrer">Cosas comunes que nuevos jugadores necesitan saber</a> (una buena primera lectura)</li>'
                    . '<li><a href="https://alttprlinks.page.link/3vXm" target="_blank" rel="noopener noreferrer">Glosario general de ayuda</a></li>'
                    . '<li><a href="https://alttprlinks.page.link/HVFx" target="_blank" rel="noopener noreferrer">Recursos sobre glitches</a></li>'
                    . '<li><a href="https://alttprlinks.page.link/on1o" target="_blank" rel="noopener noreferrer"><i>Trackers</i> / HUDs</a></li>'
                    . '<li><a href="http://alttp.mymm1.com/srl/" target="_blank" rel="noopener noreferrer">Empezar en SRL</a></li>'
                . '</ul>',
            ],
        ],
        'pitfalls' => [
            'header' => 'Errores Comunes',
            'content' => [
                '<ul>'
                    . '<li>Puedes usar el botón Y para cambiar entre Flechas de Plata y Flechas Normales, los Bumeranes Rojo y Azul, la Seta con los Polvos Mágicos, y la Pala con la Flauta.</li>'
                    . '<li>En el Mundo Oscuro, puedes usar el Gancho para atravesar el río al norta de la pirámide. ¡Busca una flecha hecha con hierba!</li>'
                    . '<li>Si te encuentras en la cueva del rebotador con la Capa y sin el Gancho, intenta caminar por la esquina superior izquierda del agujero. ¡No necesitas el Gancho!</li>'
                    . '<li>La barrera de Agahnim puede atravesarse con la Capa Mágica o destruída con una espada mejorada.</li>'
                    . '<li>Si tienes el Espejo Mágico, el Palacio del Desierto puede entrarse desde la Gruta de las Marismas sin necesidad de tener el Libro de Mudora.</li>'
                    . '<li>El medallón Bombos derrite cosas como lo haría el Cetro de Fuego, lo cual es útil en el Palacio de Hielo.</li>'
                    . '<li>Puedes cruzar agujeros pequeños a base de rebotar en paredes u objetos con las Botas de Pegaso.</li>'
                    . '<li>Sahasrahla te da su ítem cuando le hablas una vez tengas el Colgante del Valor.</li>'
                    . '<li>La Súper Bomba aparece cuando consigues los cristales 5 y 6.</li>'
                    . '<li>El Herrero y el Cofre Morado seguirán contigo aunque guardes y salgas.</li>'
                    . '<li>Nunca estás obligado a atravesar una sala oscura; la lámpara estará disponible para iluminarte, ¡ve a buscarla!</li>'
                    . '<li>Algunas llaves podrían no ser accesibles si no son necesarias para acabar el juego. Por ejemplo, la Llave Grande del Bosque de Osamentas podría estar en el cofre grande.</li>'
                . '</ul>',
            ],
        ],
        'changes' => [
            'header' => 'Diferencias',
            'sections' => [
                [
                    'header' => '¿Qué ha sido randomizado?',
                    'content' => [
                        '<ul>'
                            . '<li>Casi todas las localizaciones únicas para ítems</li>'
                            . '<li>Colgantes y cristales (consulta tu mapa)</li>'
                            . '<li>Los medallones necesarios para entrar a la Gruta de las Marismas y Roca Tortuga</li>'
                            . '<li>Drops de enemigos y otros premios (p.ej. árboles)</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => '¿Qué se mantiene igual?',
                    'content' => [
                        '<ul>'
                            . '<li>Todas las tiendas en Hyrule</li>'
                            . '<li>El minijuego de tiro con arco y varios minijuegos de encontrar rupias en cofres</li>'
                            . '<li>Llaves pequeñas debajo de vasijas o en posesión de enemigos</li>'
                        . '</ul>',
                    ],
                ],
                [
                    'header' => '¿Qué ha cambiado del juego original?',
                    'content' => [
                        'Hay algunos cambios respecto al juego original para mejorar el gameplay y prevenir que puedas quedarte atascado. Se usa la versión 1.0 japonesa como base para la ROM porque permite usar algunos glitches exclusivos para algunos modos de juego avanzados.',
                        '<ul>'
                            . '<li>No se necesita la Lámpara para empujar la estantería durante el prólogo.</li>'
                            . '<li>Se puede ver en las salas oscuras de las Cloacas sin la Lámpara (excepto en modo Abierto).</li>'
                            . '<li>Puedes cambiar entre ítems que usan el mismo espacio en el inventario pulsando Y. Por ejemplo, ahora puedes tener tanto la Pala como la Flauta y cambiar entre ambos a placer.</li>'
                            . '<li>El submenú para las Botellas no se abre automáticamente. Puede abrirse pulsando X o cambiar entre las botellas conseguidas con Y.</li>'
                            . '<li>Los niveles de agua en el Palacio del Pantano siempre volverán a estar secos al salir de su zona en la superfície. ¡Esto previene inundar llaves accidentalmente y quedarse atascado!</li>'
                            . '<li>La pantalla para elegir partida tiene una línea de símbolos aleatorios encima. Esto es un identificador único para cada semilla generada para asegurarse que todos los corredores tienen la ROM correcta. No tienen otro significado.</li>'
                            . '<li>Las Hadas en la Pirámide y la Cascada no mejoran tus ítems. En su lugar las cuevas contienen dos cofres, cada uno en lugar de una de las mejoras que se han añadido al resto de objetos.</li>'
                            . '<li>Conseguir el ítem del minijuego de cavar está garantizado en los primeros 30 intentos.</li>'
                            . '<li>Conseguir el ítem del minijuego de cofres en la Aldea de los Bandidos está garantizado en el primer intento (puede ser 1r o 2o cofre).</li>'
                        . '</ul>',
                    ],
                ],
            ],

        ],
    ],
];
