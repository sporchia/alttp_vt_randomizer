<?php

return [
    [
        'name' => "Lumberjack Shop",
        'roomid' => 0x010F,
        'type' => 'shop',
        'shopkeeper' => 0xC1,
        'shopstyle' => 0x03,
        'inletid' => 0x60,
    ],
    [
        'name' => "Lumberjack Shop - Exit",
        'roomid' => 0x010F,
        'type' => 'exit',
    ],
    [
        'name' => "Lumberjack Shop - Left",
        'roomid' => 0x010F,
        'type' => 'shopitem',
        'item' => 'RedPotion',
        'cost' => 150,
        'itemset' => ['lw', 'shop'],
    ],
    [
        'name' => "Lumberjack Shop - Middle",
        'roomid' => 0x010F,
        'type' => 'shopitem',
        'item' => 'BlueShield',
        'cost' => 50,
        'itemset' => ['lw', 'shop'],
    ],
    [
        'name' => "Lumberjack Shop - Right",
        'roomid' => 0x010F,
        'type' => 'shopitem',
        'item' => 'TenBombs',
        'cost' => 50,
        'itemset' => ['lw', 'shop'],
    ],
];
