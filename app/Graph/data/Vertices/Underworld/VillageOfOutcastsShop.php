<?php

return [
    [
        'name' => "Village Of Outcasts Shop",
        'roomid' => 0x010F,
        'type' => 'shop',
        'shopkeeper' => 0xC1,
        'shopstyle' => 0x03,
        'inletid' => 0x60,
    ],
    [
        'name' => "Village Of Outcasts Shop - Exit",
        'roomid' => 0x010F,
        'type' => 'exit',
    ],
    [
        'name' => "Village Of Outcasts Shop - Left",
        'roomid' => 0x010F,
        'type' => 'shopitem',
        'item' => 'RedPotion',
        'cost' => 150,
        'itemset' => ['dw', 'shop'],
    ],
    [
        'name' => "Village Of Outcasts Shop - Middle",
        'roomid' => 0x010F,
        'type' => 'shopitem',
        'item' => 'BlueShield',
        'cost' => 50,
        'itemset' => ['dw', 'shop'],
    ],
    [
        'name' => "Village Of Outcasts Shop - Right",
        'roomid' => 0x010F,
        'type' => 'shopitem',
        'item' => 'TenBombs',
        'cost' => 50,
        'itemset' => ['dw', 'shop'],
    ],
];
