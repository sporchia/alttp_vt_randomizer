<?php

/**
 * This data is required for writing out the Enemy Sprite data, without these
 * entries the rom won't have items to place at these locations.
 */

use App\Sprite;

return [
    [
        'name' => "Thief Hideout - Heart Piece",
        'roomid' => 0xe1,
        'type' => 'mob',
        'position_x' => 0x17,
        'position_y' => 0x0d,
        'position_z' => 0x00,
        'sprite' => Sprite::get('HeartPiece'),
    ],
    [
        'name' => "Lumberjacks Cave - Heart Piece",
        'roomid' => 0xe2,
        'type' => 'mob',
        'position_x' => 0x13,
        'position_y' => 0x10,
        'position_z' => 0x00,
        'sprite' => Sprite::get('HeartPiece'),
    ],
    [
        'name' => "Spectacle Rock Cave Top - Heart Piece",
        'roomid' => 0xea,
        'type' => 'mob',
        'position_x' => 0x0b,
        'position_y' => 0x0b,
        'position_z' => 0x00,
        'sprite' => Sprite::get('HeartPiece'),
    ],
    [
        'name' => "Graveyard Cave - Hidden Room - Heart Piece",
        'roomid' => 0x11b,
        'type' => 'mob',
        'position_x' => 0x18,
        'position_y' => 0x09,
        'position_z' => 0x00,
        'sprite' => Sprite::get('HeartPiece'),
    ],
    [
        'name' => "Cave 45 Left - Heart Piece",
        'roomid' => 0x11b,
        'type' => 'mob',
        'position_x' => 0x05,
        'position_y' => 0x16,
        'position_z' => 0x01,
        'sprite' => Sprite::get('HeartPiece'),
    ],
    [
        'name' => "Checkerboard Cave - Heart Piece",
        'roomid' => 0x126,
        'type' => 'mob',
        'position_x' => 0x1c,
        'position_y' => 0x14,
        'position_z' => 0x00,
        'sprite' => Sprite::get('HeartPiece'),
    ],
    [
        'name' => "Peg Cave - Heart Piece",
        'roomid' => 0x127,
        'type' => 'mob',
        'position_x' => 0x07,
        'position_y' => 0x16,
        'position_z' => 0x00,
        'sprite' => Sprite::get('HeartPiece'),
    ],
];
