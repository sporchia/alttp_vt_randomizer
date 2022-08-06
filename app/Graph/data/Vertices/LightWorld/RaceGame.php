<?php

return [
    [
        'map' => 0x28,
        'name' => "Race Game",
        'type' => 'region',
        'moonpearl' => false,
    ],
    [
        'map' => 0x28,
        'name' => "Maze Race Start",
        'type' => 'region',
        'moonpearl' => false,
    ],
    [
        'map' => 0x28,
        'name' => "Brothers House Left - In",
        'type' => 'entrance',
        'entranceid' => 0x0e, 
    ],
    [
        'map' => 0x28,
        'name' => "Brothers House Left - Out",
        'type' => 'outlet',
        'outletid' => 0x10, 
    ],
    [
        'map' => 0x28,
        'name' => "Maze Race",
        'addresses' => [0x180142],
        'type' => 'standing',
        'itemset' => ['lw'],
    ],
];
