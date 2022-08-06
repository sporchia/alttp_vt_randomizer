<?php

return [
    [
        'map' => 0x3b,
        'name' => "Wetlands Dam",
        'type' => 'region',
        'moonpearl' => false,
    ],
    [
        'map' => 0x3b,
        'name' => "Floodgate - In",
        'type' => 'entrance',
        'entranceid' => 0x4d,
    ],
    [
        'name' => "Floodgate",
        'roomid' => 0x010b,
        'type' => 'region',
        'inletid' => 0x4e,    
    ],
    [
        'map' => 0x3b,
        'name' => "Floodgate Chest",
        'addresses' => [0xE98C],
        'type' => 'chest',
        'itemset' => ['lw'],
    ],
    [
        'map' => 0x3b,
        'name' => "Sunken Treasure",
        'addresses' => [0x180145],
        'type' => 'standing',
        'itemset' => ['lw'],
    ],
];
