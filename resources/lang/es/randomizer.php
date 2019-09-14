<?php
return [
    'title' => 'Randomizer',
    'preset' => [
        'title' => 'Select Preset',
        'customize' => 'Customize',
        'options' => [
            'default' => 'Default',
            'beginner' => 'Beginner',
            'veetorp' => 'OWG (Veetorp’s Favorite)',
            'crosskeys' => 'Crosskeys',
            'quick' => 'Super Quick',
            'nightmare' => 'Nightmare',
            'custom' => 'Custom',
        ],
    ],
    'placement' => [
        'title' => 'Item Placement',
    ],
    'item_placement' => [
        'title' => 'Item Placement',
        'options' => [
            'basic' => 'Basic',
            'advanced' => 'Advanced',
        ],
    ],
    'dungeon_items' => [
        'title' => 'Dungeon Items',
        'options' => [
            'standard' => 'Standard',
            'mc' => 'Maps/Compasses',
            'mcs' => 'Maps/Compasses/Small Keys',
            'full' => 'Keysanity',
        ],
    ],
    'accessibility' => [
        'title' => 'Accessibility',
        'options' => [
            'items' => '100% Inventory',
            'locations' => '100% Locations',
            'none' => 'Not Guaranteed',
        ],
    ],
    'glitches_required' => [
        'title' => 'Glitches Required',
        'options' => [
            'none' => 'None',
            'overworld_glitches' => 'Glitches de la Superfície',
            'major_glitches' => 'Glitches Mayore',
            'no_logic' => 'No Logic',
        ],
        'glitch_warning' => 'Esta Lógica require conocimiento de Glithes Mayores<sup>**</sup>',
    ],
    'goal' => [
        'title' => 'Objetivo',
        'options' => [
            'ganon' => 'Derrotar a Ganon',
            'fast_ganon' => 'Fast Ganon',
            'dungeons' => 'Todas las mazmorras',
            'pedestal' => 'Pedestal de la Espada Maestra',
            'triforce-hunt' => 'Piezas de la Trifuerza',
        ],
    ],
    'tower_open' => [
        'title' => 'Open Tower',
        'options' => [
            '0' => '0 Crystals',
            '1' => '1 Crystal',
            '2' => '2 Crystals',
            '3' => '3 Crystals',
            '4' => '4 Crystals',
            '5' => '5 Crystals',
            '6' => '6 Crystals',
            '7' => '7 Crystals',
            'random' => 'Random'
        ],
    ],
    'ganon_open' => [
        'title' => 'Ganon Vulnerable',
        'options' => [
            '0' => '0 Crystals',
            '1' => '1 Crystal',
            '2' => '2 Crystals',
            '3' => '3 Crystals',
            '4' => '4 Crystals',
            '5' => '5 Crystals',
            '6' => '6 Crystals',
            '7' => '7 Crystals',
            'random' => 'Random'
        ],
    ],
    'gameplay' => [
        'title' => 'Gameplay',
    ],
    "world_state" => [
        'title' => 'World State',
        'options' => [
            'standard' => 'Estándar',
            'open' => 'Abierto',
            'inverted' => 'Inverso',
            'retro' => 'Retro',
        ],
    ],
    "entrance_shuffle" => [
        'title' => 'Entrance Shuffle',
        'options' => [
            'none' => 'None',
            'simple' => 'Simple',
            'restricted' => 'Restringido',
            'full' => 'Completo',
            'crossed' => 'Cruzado',
            'insanity' => 'Locura',
        ],
    ],
    "boss_shuffle" => [
        'title' => 'Boss Shuffle',
        'options' => [
            'none' => 'None',
            'simple' => 'Simple',
            'full' => 'Full',
            'random' => 'Random',
        ],
    ],
    "enemy_shuffle" => [
        'title' => 'Enemy Shuffle',
        'options' => [
            'none' => 'None',
            'shuffled' => 'Shuffled',
            'random' => 'Random',
    ],
],
"hints" => [
    'title' => 'Hints',
    'options' => [
        'on' => 'On',
        'off' => 'Off',
    ],
],
    'weapons' => [
        'title' => 'Espadas',
        'options' => [
            'randomized' => 'Randomizadas',
            'assured' => 'Assured',
            'vanilla' => 'Vanilla',
            'swordless' => 'Sin Espadas',
        ],
    ],
    'item_pool' => [
        'title' => 'Item Pool',
        'options' => [
            'easy' => 'Fácil',
            'normal' => 'Normal',
            'hard' => 'Difícil',
            'expert' => 'Experto',
            'crowd_control' => 'Crowd Control',
        ],
        'crowd_control_warning' => '<sup>*</sup> This setting is meant to be used with the Crowd Control Twitch extension. find out more: <a href="https://crowdcontrol.live/" target="_blank" rel=”noopener noreferrer”>https://crowdcontrol.live/</a>',
    ],
    'item_functionality' => [
        'title' => 'Item Functionality',
        'options' => [
            'easy' => 'Fácil',
            'normal' => 'Normal',
            'hard' => 'Difícil',
            'expert' => 'Experto',
        ],
    ],
    'enemy_damage' => [
        'title' => 'Enemy Damage',
        'options' => [
            'default' => 'Default',
            'shuffled' => 'Shuffled',
            'random' => 'Random',
        ],
    ],
    'enemy_health' => [
        'title' => 'Enemy Health',
        'options' => [
            'default' => 'Default',
            'easy' => 'Fácil',
            'hard' => 'Difícil',
            'expert' => 'Experto',
        ],
    ],
    'generate' => [
        'race' => 'Generar ROM para carreras',
        'race_warning' => '<span class="running-now">sin spoilers</span>',
        'spoiler_race' => 'Generar ROM para carreras (con spoilers)',
        'back' => 'Change Settings',
        'regenerate' => 'Generate Again',
        'regenerate_tooltip' => 'Generate new game with same settings',
        'generating' => 'Generating...',
    ],
    'details' => [
        'title' => 'Detalles del juego',
        'save_spoiler' => 'Guardar spoiler',
        'save_rom' => 'Guardar ROM',
    ],
    // depricated
    'variation' => [
        'title' => 'Variación',
    ],
    'difficulty' => [
        'title' => 'Dificultad',
        'options' => [
            'easy' => 'Fácil',
            'normal' => 'Normal',
            'hard' => 'Difícil',
            'expert' => 'Experto',
            'insane' => 'Locura',
            'crowdControl' => 'Crowd Control',
        ],
    ],
];
