<?php

use App\Sprite;

return [
    [
        'map' => 0x5e,
        'name' => "East Dark World Maze",
        'type' => 'region',
        'moonpearl' => true,
    ],
    [
        'map' => 0x5e,
        'name' => "East Dark World Maze - Kiki",
        'map' => 0x5e,
        'type' => 'mob', // used to be `follower`
        'position_x' => 0x15,
        'position_y' => 0x11,
        'sprite' => Sprite::get("Kiki"),
        'state' => [1, 2],
        'item' => 'LostKiki',
        'itemset' => ['event'],
    ],
];
