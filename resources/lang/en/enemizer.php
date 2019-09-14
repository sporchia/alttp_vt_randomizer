<?php
return [
    'title' => 'Enemizer',
    'enable' => 'Enable Enemizer',
    'disable' => 'Disable Enemizer',
    'enemy_health' => [
        'title' => 'Enemy Health',
        'options' => [
            0 => 'Default',
            1 => 'Easy (1-4 hp)',
            2 => 'Normal (2-15 hp)',
            3 => 'Hard (2-30 hp)',
            4 => 'Brick Wall (4-50 hp)',
        ],
    ],
    'enemy_damage' => [
        'title' => 'Enemy Damage',
        'options' => [
            'off' => 'Default',
            'shuffle' => 'Shuffled',
            'chaos' => 'Chaos',
        ],
    ],
    'bosses' => [
        'title' => 'Boss Shuffle',
        'options' => [
            'off' => 'Off',
            'basic' => 'Simple',
            'normal' => 'Full',
            'chaos' => 'Chaos',
        ],
    ],
    'palette_shuffle' => 'Palette Shuffle',
    'pot_shuffle' => 'Pot Shuffle',
    'enemy_shuffle' => 'Enemy Shuffle',
];
