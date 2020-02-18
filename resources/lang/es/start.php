<?php
return [
    'header' => '¡Comienza tu Aventura!',
    'subheader' => '¿Quieres probar tus habilidades en un Hyrule aleatorio? ¡Has entrado al sitio adecuado!',
    'cards' => [
        'discord' => [
            'header' => '1. Únete a nuestra comunidad de Discord',
            'content' => [
                '<div class="center"><a class="btn btn-primary btn-lg btn-xl" href="https://discord.gg/alttprandomizer" rel="noopener noreferrer"role="button" target="_blank">' . __('navigation.discord') . '</a></div>',
                '¡Entra a nuestra comunidad de Discord! ¡Tenemos gente amistosa y dispuesta a ayudar, noticias de eventos de la comunidad, actualizaciones de ALttP: Randomizer, guías, consejos, trucos, ¡y más! ¡Ven a decir hola!',
            ]
        ],
        'rom' => [
            'header' => '2. Consigue la ROM',
            'content' => [
                'Necesitarás la ROM base. Debería ser una ROM <span class="font-weight-bold">Zelda no Densetsu: Kamigami no Triforce v1.0</span>. No te preocupes si no puedes leer japonés, el proceso de parcheado pone textos en inglés manteniendo los glitches únicos de la versión original intactos.',
                'Si encuentras algún problema, ¡pregunta en <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>!',
            ]
        ],
        'randomize' => [
            'header' => '3. Elige las Opciones de tu Juego',
            'content' => [
                'Ve a <a href="/randomizer" target="_blank" rel="noopener noreferrer">' . __('navigation.randomizer') . '</a> y proporciona tu ROM. La siguiente pantalla enseñará una variedad de opciones de juego. Para tus primeras partidas, recomendamos cambiar “' . __('randomizer.difficulty.title') . '” a “' . __('randomizer.difficulty.options.easy') . '” y dejar el resto como está. Haz click entonces en “' . __('randomizer.generate.spoiler_race') . '” y conseguirás un fresco nuevo juego randomizado!',
                'Para una guía en profundidad de todas las opciones disponibles, puedes entrar <a href="/options">aquí</a>.',
            ]
        ],
        'emulator' => [
            'header' => '4. Consigue una Forma de Jugar',
            'content' => [
                'Primero, necesitarás algo donde jugar tu nuevo y fresco juego. Recomendamos usar un emulador. Un emulador es un programa que replica de forma fiel el hardware de una SNES, permitiendo que puedas jugar juegos de SNES en tu ordenador. Puedes conseguir el emulador que recomendamos, SNES9x, en su <a href="http://www.snes9x.com/" target="_blank" rel="noopener noreferrer">página web</a>.',
                'Aunque puedes jugar usando solo tu teclado, un mando te dará una mejor experiencia de juego. La mayoría de mandos USB funcionarán, pero recomendamos un <a href="https://www.amazon.com/dp/B002B9XB0E" target="_blank" rel="noopener noreferrer">Gamepad iBuffalo USB Clásico</a> o un <a href="https://www.amazon.com/dp/B074HBQ78V" target="_blank" rel="noopener noreferrer">Mando Bluetooth Wireless 8Bitdo SFC30</a>.',
                'Hay otras formas de jugar, incluyendo en una SNES original. También hay ciertos emuladores, como zsnes, que no funcionarán correctamente con el randomizer. ¡Únete a nosotros en <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a> para aprender más!',
                'NOTA PARA JUGADORES EN SNES MINI: Cambia el nombre al archivo ROM para que tenga 61 carácteres o menos, ya que la SNES Mini no funciona con nombres de archivos largos.',
            ]
        ],
        'play' => [
            'header' => '5. ¡Ponte a jugar!',
            'content' => [
                '¡Ya estás listo para empezar! La mejor forma de aprender es cargar tu nueva ROM y empezar a jugar. Si crees que estás atascado, mira esta lista de errores comunes, o pregunta en <a href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">Discord</a>.',
                '<ul>'
                    . '<li>Puedes usar el botón Y para cambiar entre Flechas de Plata y Flechas Normales, los Bumeranes Rojo y Azul, la Seta con los Polvos Mágicos, y la Pala con la Flauta.</li>'
                    . '<li>Puedes guardar y salir con el Herrero o el Cofre Morado siguiéndote para llevarlos de vuelta al Mundo de la Luz sin el Espejo.</li>'
                    . '<li>En el Mundo Oscuro, puedes usar el Gancho para atravesar el río al norta de la pirámide. ¡Busca una flecha hecha con hierba!</li>'
                    . '<li>Puedes usar las botas para correr contra paredes, bloques, o vasijas, lanzándote hacia atrás, para poder cruzar agujeros.</li>'
                    . '<li>Si te encuentras en la cueva del rebotador con la Capa y sin el Gancho, intenta caminar por la esquina superior izquierda del agujero. ¡No necesitas el Gancho!</li>'
                    . '<li>Algunas llaves podrían no ser accesibles si no son necesarias para acabar el juego. Por ejemplo, la Llave Grande del Bosque de Osamentas podría estar en el cofre grande.</li>'
                    . '<li>La barrera de Agahnim puede atravesarse con la Capa Mágica o destruída con una espada mejorada.</li>'
                    . '</ul>',
                '¡No olvides mirar la sección de <a href="/resources">' . __('navigation.resources') . '</a> para más tutoriales y consejos!',
            ]
        ],
    ],
];
