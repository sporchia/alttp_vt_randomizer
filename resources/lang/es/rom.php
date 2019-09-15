<?php
return [
    'loader' => [
        'title' => 'Empezar a Jugar',
        'file_select' => 'Selecciona archivo ROM',
        'content' => '<ol>'
                . '<li>Selecciona tu archivo ROM y cárgalo en tu navegador (Por favor, usa una ROM <strong>Zelda no Densetsu: Kamigami no Triforce v1.0</strong> con extensión .smc o .sfc)</li>'
                . '<li>Selecciona las <a href="/en/options">' . __('navigation.options') . '</a> para cómo quieres que tu juego sea randomizado</li>'
                . '<li>Haz click en ' . __('randomizer.generate.race') . '</li>'
                . '<li>Guarda tu ROM y ponte a jugar</li>'
            . '</ol>',
    ],
    'info' => [
        'spoilerwarning' => 'ADVERTENCIA: El generador de este juego ha visto el registro de spoiler.',
        'logic' => __('randomizer.glitches_required.title'),
        'build' => 'Build de la ROM',
        'difficulty' => __('randomizer.difficulty.title'),
        'variation' => __('randomizer.variation.title'),
        'shuffle' => __('randomizer.entrance_shuffle.title'),
        'mode' => __('randomizer.world_state.title'),
        'weapons' => __('randomizer.weapons.title'),
        'goal' => __('randomizer.goal.title'),
        'permalink' => 'Enlace permanente',
        'special' => 'Especial',
        'notes' => 'Notas',
        'generated' => 'Creada',
    ],
    'settings' => [
        'heart_speed' => 'Velocidad de Corazones',
        'heart_speeds' => [
            'off' => 'Desactivado',
            'double' => 'Velocidad Doble',
            'normal' => 'Velocidad Normal',
            'half' => 'Media Velocidad',
            'quarter' => 'Cuarto de Velocidad',
        ],
        'menu_speed' => 'Velocidad de Menú',
        'menu_speeds' => [
            'instant' => 'Instantáneo',
            'fast' => 'Rápido',
            'normal' => 'Normal',
            'slow' => 'Lento',
        ],
        'heart_color' => 'Color de Corazones',
        'heart_colors' => [
            'blue' => 'Azul',
            'green' => 'Verde',
            'red' => 'Rojo',
            'yellow' => 'Amarillo',
        ],
        'play_as' => 'Jugar Como',
        'music' => 'Música de fondo',
        'music_info' => '(poner en "No" para <a href="https://alttprlinks.page.link/SjiP" target="_blank" rel="noopener noreferrer">soporte con MSU-1</a>)',
        'quickswap' => 'Cambio Rápido de Objetos',
        'palette_shuffle' => 'Paletas aleatorias',
        'race_warning' => 'No funciona en ROMs para carreras',
    ],
];
