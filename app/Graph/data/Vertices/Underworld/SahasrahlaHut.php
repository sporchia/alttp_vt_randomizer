<?php

use App\Sprite;

return [
    [
        'name' => "Sahasrahla's Room",
        'roomid' => 0x0105,
        'type' => 'region',
        'inletid' => 0x45,
    ],
    [
        'name' => "Sahasrahla's Room - Exit",
        'roomid' => 0x0105,
        'type' => 'exit',
    ],
    [
        'name' => "Sahasrahla's Closet",
        'roomid' => 0x0105,
        'type' => 'region',
    ],
    [
        'name' => "Sahasrahla's Hut - Left",
        'roomid' => 0x0105,
        'addresses' => [0xEA82],
        'type' => 'chest',
        'itemset' => ['lw'],
    ],
    [
        'name' => "Sahasrahla's Hut - Middle",
        'roomid' => 0x0105,
        'addresses' => [0xEA85],
        'type' => 'chest',
        'itemset' => ['lw'],
    ],
    [
        'name' => "Sahasrahla's Hut - Right",
        'roomid' => 0x0105,
        'addresses' => [0xEA88],
        'type' => 'chest',
        'itemset' => ['lw'],
    ],
    [
        'name' => "Sahasrahla's Hut - Sahasrahla Sprite",
        'roomid' => 0x0105,
        'type' => 'mob',
        'position_x' => 0x07,
        'position_y' => 0x18,
        'position_z' => 0x00,
        'subtype' => 0x00,
        'sprite' => Sprite::get("Sahasrahla"),
    ],
    [
        'name' => "Sahasrahla's Hut - Sahasrahla",
        'roomid' => 0x0105,
        'addresses' => [0x2F1FC],
        'type' => 'npc',
        'itemset' => ['lw', 'argh'],
    ],
];
