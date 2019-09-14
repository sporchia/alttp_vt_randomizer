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
            'overworld_glitches' => 'Glitches Monde Extérieur',
            'major_glitches' => 'Glitches Majeurs',
            'no_logic' => 'No Logic',
        ],
        'glitch_warning' => 'Cette logique nécessite la connaissance des glitches majeurs<sup>**</sup>',
    ],
    'goal' => [
        'title' => 'Objectif',
        'options' => [
            'ganon' => 'Vaincre Ganon',
            'fast_ganon' => 'Fast Ganon',
            'dungeons' => 'Tous les Donjons',
            'pedestal' => 'Piédestal de la Master Sword',
            'triforce-hunt' => 'Morceaux de Triforce ',
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
            'standard' => 'Standard',
            'open' => 'Ouvert',
            'inverted' => 'Inversé',
            'retro' => 'Retro',
        ],
    ],
    "entrance_shuffle" => [
        'title' => 'Entrance Shuffle',
        'options' => [
            'none' => 'None',
            'simple' => 'Simple',
            'restricted' => 'Restreint',
            'full' => 'Complet',
            'crossed' => 'Croisé',
            'insanity' => 'Insensé',
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
        'title' => 'Épées',
        'options' => [
            'randomized' => 'Randomisées',
            'assured' => 'Assurés',
            'vanilla' => 'Vanilla',
            'swordless' => 'Sans Épée',
        ],
    ],
    'item_pool' => [
        'title' => 'Item Pool',
        'options' => [
            'easy' => 'Easy',
            'normal' => 'Normal',
            'hard' => 'Difficile',
            'expert' => 'Expert',
            'crowd_control' => 'Crowd Control',
        ],
        'crowd_control_warning' => '<sup>*</sup> This setting is meant to be used with the Crowd Control Twitch extension. find out more: <a href="https://crowdcontrol.live/" target="_blank" rel=”noopener noreferrer”>https://crowdcontrol.live/</a>',
    ],
    'item_functionality' => [
        'title' => 'Item Functionality',
        'options' => [
            'easy' => 'Easy',
            'normal' => 'Normal',
            'hard' => 'Difficile',
            'expert' => 'Expert',
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
            'easy' => 'Easy',
            'hard' => 'Difficile',
            'expert' => 'Expert',
        ],
    ],
    'generate' => [
        'race' => 'Générer une ROM de Course',
        'race_warning' => 'Les spoilers ne seront <span class="running-now">jamais</span> disponibles pour cette option.',
        'spoiler_race' => 'Spoiler de la ROM de Course',
        'back' => 'Change Settings',
        'regenerate' => 'Generate Again',
        'regenerate_tooltip' => 'Generate new game with same settings',
        'generating' => 'Generating...',
    ],
    'details' => [
        'title' => 'Détails du jeu',
        'save_spoiler' => 'Enregistrer le spoiler',
        'save_rom' => 'Sauvegarder la ROM',
    ],
    // depricated
    'variation' => [
        'title' => 'Variation',
        ],
    'difficulty' => [
        'title' => 'Difficulté',
        'options' => [
            'easy' => 'Easy',
            'normal' => 'Normal',
            'hard' => 'Difficile',
            'expert' => 'Expert',
            'insane' => 'Insensé',
            'crowdControl' => 'Crowd Control',
        ],
    ],
];
