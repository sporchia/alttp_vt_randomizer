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
            'none' => 'Beatable',
        ],
    ],
    'glitches_required' => [
        'title' => 'Glitches Required',
        'options' => [
            'none' => 'None',
            'overworld_glitches' => 'Overworld Glitches',
            'major_glitches' => 'Major Glitches',
            'no_logic' => 'No Logic',
        ],
        'glitch_warning' => 'These settings require knowledge of Major Glitches<sup>**</sup>',
    ],
    'goal' => [
        'title' => 'Ziel',
        'options' => [
            'ganon' => 'Besiege Ganon',
            'fast_ganon' => 'Fast Ganon',
            'dungeons' => 'Alle Dungeons',
            'pedestal' => 'Master-Schwert Sockel',
            'triforce-hunt' => 'Triforce-Splitter',
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
            'open' => 'Offen',
            'inverted' => 'Invertiert',
            'retro' => 'Retro',
        ],
    ],
    "entrance_shuffle" => [
        'title' => 'Entrance Shuffle',
        'options' => [
            'none' => 'None',
            'simple' => 'Simpel',
            'restricted' => 'Beschränkt',
            'full' => 'Voll',
            'crossed' => 'Gekreuzt',
            'insanity' => 'Wahnsinn',
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
        'title' => 'Schwerter',
        'options' => [
            'randomized' => 'Zufällig',
            'assured' => 'Assured',
            'vanilla' => 'Vanilla',
            'swordless' => 'Schwertlos',
        ],
    ],
    'item_pool' => [
        'title' => 'Item Pool',
        'options' => [
            'easy' => 'Einfach',
            'normal' => 'Normal',
            'hard' => 'Schwer',
            'expert' => 'Experte',
            'crowd_control' => 'Crowd Control',
        ],
        'crowd_control_warning' => '<sup>*</sup> This setting is meant to be used with the Crowd Control Twitch extension. find out more: <a href="https://crowdcontrol.live/" target="_blank" rel=”noopener noreferrer”>https://crowdcontrol.live/</a>',
    ],
    'item_functionality' => [
        'title' => 'Item Functionality',
        'options' => [
            'easy' => 'Einfach',
            'normal' => 'Normal',
            'hard' => 'Schwer',
            'expert' => 'Experte',
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
            'easy' => 'Einfach',
            'hard' => 'Schwer',
            'expert' => 'Experte',
        ],
    ],
    'spoiler' => [
        'title' => 'Spoilers',
        'options' => [
            'off' => 'Disabled',
            'on' => 'Enabled',
            'generate' => 'Nur bei Generieren',
        ],
    ],
    'generate' => [
        'race' => 'Generiere ROM für Rennen',
        'race_warning' => '<span class="running-now">Spoilerfrei</span>',
        'spoiler_race' => 'ROM für Spoiler Rennen',
        'casual' => 'Generiere ROM',
        'back' => 'Change Settings',
        'regenerate' => 'Generate Again',
        'regenerate_tooltip' => 'Generate new game with same settings',
        'generating' => 'Generating...',
    ],
    'details' => [
        'title' => 'Spiel Details',
        'save_spoiler' => 'Speichere Spoiler',
        'save_rom' => 'Speichere Rom',
    ],
    // depricated
    'variation' => [
        'title' => 'Variation',
    ],
    'difficulty' => [
        'title' => 'Schwierigkeitsgrad',
        'options' => [
            'easy' => 'Einfach',
            'normal' => 'Normal',
            'hard' => 'Schwer',
            'expert' => 'Experte',
            'insane' => 'Wahnsinnig',
            'crowdControl' => 'Crowd Control',
        ],
    ],
];
