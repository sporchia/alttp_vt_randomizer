<?php

return [
    [
        'name' => "Kakariko Shop",
        'roomid' => 0x011f,
        'type' => 'shop',
        'shopkeeper' => 0xA0,
        'shopstyle' => 0x03,
        'inletid' => 0x46,
    ],
    [
        'name' => "Kakariko Shop - Exit",
        'roomid' => 0x011f,
        'type' => 'exit',
    ],
    [
        'name' => "Kakariko Shop - Left",
        'roomid' => 0x011f,
        'type' => 'shopitem',
        'item' => 'RedPotion',
        'cost' => 150,
        'itemset' => ['lw', 'shop'],
    ],
    [
        'name' => "Kakariko Shop - Middle",
        'roomid' => 0x011f,
        'type' => 'shopitem',
        'item' => 'Heart',
        'cost' => 10,
        'itemset' => ['lw', 'shop'],
    ],
    [
        'name' => "Kakariko Shop - Right",
        'roomid' => 0x011f,
        'type' => 'shopitem',
        'item' => 'TenBombs',
        'cost' => 50,
        'itemset' => ['lw', 'shop'],
    ],
];
