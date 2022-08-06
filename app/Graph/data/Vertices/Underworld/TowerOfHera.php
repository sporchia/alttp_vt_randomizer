<?php

use App\Sprite;

return [
    [
        'group' => 5,
        'name' => "Tower Of Hera - Entrance",
        'roomid' => 0x77,
        'type' => 'region',
        'inletid' => 0x33,
    ],
    [
        'name' => "Tower Of Hera - Exit",
        'roomid' => 0x77,
        'type' => 'exit',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Map Chest",
        'type' => 'chest',
        'addresses' => [0xE9AD],
        'itemset' => ['hera']
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Basement Door",
        'type' => 'keydoor',
        'key' => 'KeyP3',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Tile Room",
        'roomid' => 0x87,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Basement Corner",
        'roomid' => 0x87,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Hidden Chest",
        'roomid' => 0x87,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Moldorm Cage",
        'roomid' => 0x87,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Big Key Chest",
        'type' => 'chest',
        'addresses' => [0xE9E6],
        'itemset' => ['hera']
    ],
    [
        // @todo need to figure out how to model this properly
        'group' => 5,
        'name' => "Tower Of Hera - Tile Room - Key",
        'roomid' => 0x87,
        'type' => 'mob',
        'position_x' => 0x08,
        'position_y' => 0x1a,
        'position_z' => 0x00,
        'subtype' => 0x00,
        'sprite' => Sprite::get("Key"),
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Basement Cage",
        'type' => 'chest',
        'addresses' => [0x180162],
        'itemset' => ['hera']
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Beetle Gate",
        'roomid' => 0x31,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Beetle Gate - Shutter Door",
        'roomid' => 0x31,
        'type' => 'shutter',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Beetle Trap",
        'roomid' => 0x31,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Maze",
        'roomid' => 0x31,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Petting Zoo",
        'roomid' => 0x27,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Compass Chest",
        'type' => 'chest',
        'addresses' => [0xE9FB],
        'itemset' => ['hera']
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Bumper Room",
        'roomid' => 0x17,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Fairy Refill",
        'roomid' => 0xA7,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Petting Zoo - Ledge",
        'roomid' => 0x27,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Big Chest",
        'type' => 'bigchest',
        'addresses' => [0xE9F8],
        'itemset' => ['hera']
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Boss Room",
        'roomid' => 0x07,
        'type' => 'region',
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Boss",
        'addresses' => [0x180152],
        'type' => 'drop',
        'itemset' => ['hera'],
    ],
    [
        'group' => 5,
        'name' => "Tower Of Hera - Prize",
        'addresses' => [null, 0x120A5, 0x53F0A, 0x53F0B, 0x18005A, 0x18007A, 0xC706],
        'type' => 'prize',
        'itemset' => ['prize'],
    ],
];
