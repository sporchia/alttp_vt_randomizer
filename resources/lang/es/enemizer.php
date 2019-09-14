<?php
return [
    'title' => 'Enemizer',
    'enable' => 'Activar Enemizer',
    'disable' => 'Desactivar Enemizer',
    'enemy_health' => [
        'title' => 'Vida de enemigos',
        'options' => [
            0 => 'Normal',
            1 => 'Fácil (1-4 hp)',
            2 => 'Medio (2-15 hp)',
            3 => 'Difícil (2-30 hp)',
            4 => 'Locura (4-50 hp)',
        ],
    ],
    'enemy_damage' => [
        'title' => 'Daño de enemigos',
        'options' => [
            'off' => 'Normal',
            'shuffle' => 'Aleatorio',
            'chaos' => 'Caos',
        ],
    ],
    'bosses' => [
        'title' => 'Jefes',
        'options' => [
            'off' => 'Normal',
            'basic' => 'Básico',
            'normal' => 'Normal',
            'chaos' => 'Caos',
        ],
    ],
    'palette_shuffle' => 'Paleta aleatorias',
    'pot_shuffle' => 'Vasijas aleatorias',
    'enemy_shuffle' => 'Enemigos aleatorios',
];
