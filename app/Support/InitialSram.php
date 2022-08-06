<?php

declare(strict_types=1);

namespace App\Support;

use App\Graph\Inventory;

/**
 * Wrapper class around an array holding an initial SRAM table which
 * is written to the ROM and copied on new save file creation. The class has
 * methods to alter the initial SRAM state and a get_initial_sram method which
 * produces an array of ints with values 0-255 and a length the size of SRAM_SIZE.
 */
final class InitialSram
{
    const SRAM_SIZE = 0x500;
    const ROOM_DATA = 0x000;
    const OVERWORLD_DATA = 0x280;
    private $initial_sram_bytes = [];

    /**
     * Constructor that fills the array with zeroes, pre-opens Kakariko bomb
     * hut and brewery, and sets default ability flags.
     */
    function __construct()
    {
        $this->initial_sram_bytes = array_fill(0, $this::SRAM_SIZE, 0);
        $this->initial_sram_bytes[$this::ROOM_DATA + 0x20D] = 0xF0;
        $this->initial_sram_bytes[$this::ROOM_DATA + 0x20F] = 0xF0;
        $this->initial_sram_bytes[0x379] = 0b01101000;
        $this->initial_sram_bytes[0x401] = 0xFF;
        $this->initial_sram_bytes[0x402] = 0xFF;
    }

    /**
     * Sets an index to a value in the initial SRAM table using a bitwise OR
     *
     * @throws \Exception if the index is greater than SRAM_SIZE or the value
     * is less than zero or greater than 255
     */
    function setValue(int $idx, int $val)
    {
        if ($idx > $this::SRAM_SIZE) {
            throw new \Exception("Initial SRAM index out of bounds: " . $idx);
        }
        if ($val > 255 || $val < 0) {
            throw new \Exception("Initial SRAM value out of bounds: " . $val);
        }

        $this->initial_sram_bytes[$idx] |= $val;
    }

    /**
     * Gets a value
     */
    function getValue(int $idx)
    {
        return $this->initial_sram_bytes[$idx];
    }

    // Room data

    /**
     * Pre-opens Aga Tower curtains
     */
    public function preOpenAgaCurtains()
    {
        $this->setValue($this::ROOM_DATA + 0x61, 0x80);
    }

    /**
     * Pre-opens Skull Woods curtains
     */
    public function preOpenSkullWoodsCurtains()
    {
        $this->setValue($this::ROOM_DATA + 0x93, 0x80);
    }

    // Overworld data

    /**
     * Pre-opens Hyrule Castle Gate
     */
    public function preOpenCastleGate()
    {
        $this->setValue($this::OVERWORLD_DATA + 0x1B, 0x20);
    }

    /**
     * Pre-opens Ganon's Tower
     */

    public function preOpenGanonsTower()
    {
        $this->setValue($this::OVERWORLD_DATA + 0x43, 0x20);
    }

    /**
     * Pre-opens pyramid hole
     */
    public function preOpenPyramid()
    {
        $this->setValue($this::OVERWORLD_DATA + 0x5B, 0x20);
    }

    /**
     * set the items passed in as Link's starting equipment
     *
     * @param Inventory $items items to equip Link with
     * @param array $config 
     */
    public function setStartingEquipment(Inventory $items, $config)
    {
        $starting_rupees = 0;
        $starting_arrow_capacity_upgrades = 0;
        $starting_bomb_capacity_upgrades = 0;
        // starting heart containers
        if ($items->heartCount(0) < 1) {
            $this->initial_sram_bytes[0x36C] = 0x18;
            $this->initial_sram_bytes[0x36D] = 0x18;
        }

        foreach ($items->all() as $item) {
            switch (explode(':', $item)[0]) {
                case 'L1Sword':
                    $this->initial_sram_bytes[0x359] = 0x01;
                    $this->initial_sram_bytes[0x417] = 0x01;
                    break;
                case 'L1SwordAndShield':
                    $this->initial_sram_bytes[0x359] = 0x01;
                    $this->initial_sram_bytes[0x35A] = 0x01;
                    $this->initial_sram_bytes[0x417] = 0x01;
                    $this->initial_sram_bytes[0x422] = 0x01;
                    break;
                case 'L2Sword':
                case 'MasterSword':
                    $this->initial_sram_bytes[0x359] = 0x02;
                    $this->initial_sram_bytes[0x417] = 0x02;
                    break;
                case 'L3Sword':
                    $this->initial_sram_bytes[0x359] = 0x03;
                    $this->initial_sram_bytes[0x417] = 0x03;
                    break;
                case 'L4Sword':
                    $this->initial_sram_bytes[0x359] = 0x04;
                    $this->initial_sram_bytes[0x417] = 0x04;
                    break;
                case 'BlueShield':
                    $this->initial_sram_bytes[0x35A] = 0x01;
                    $this->initial_sram_bytes[0x422] = 0x01;
                    break;
                case 'RedShield':
                    $this->initial_sram_bytes[0x35A] = 0x02;
                    $this->initial_sram_bytes[0x422] = 0x02;
                    break;
                case 'MirrorShield':
                    $this->initial_sram_bytes[0x35A] = 0x03;
                    $this->initial_sram_bytes[0x422] = 0x03;
                    break;
                case 'FireRod':
                    $this->initial_sram_bytes[0x345] = 0x01;
                    break;
                case 'IceRod':
                    $this->initial_sram_bytes[0x346] = 0x01;
                    break;
                case 'Hammer':
                    $this->initial_sram_bytes[0x34B] = 0x01;
                    break;
                case 'Hookshot':
                    $this->initial_sram_bytes[0x342] = 0x01;
                    break;
                case 'Bow':
                    $this->initial_sram_bytes[0x340] = 0x01;
                    if ($config['rom.rupeeBow'] == false) {
                        $this->initial_sram_bytes[0x38E] |= 0b10000000;
                    }
                    break;
                case 'BowAndArrows':
                    $this->initial_sram_bytes[0x340] = 0x02;
                    $this->initial_sram_bytes[0x38E] |= 0b10000000;
                    if ($config['rom.rupeeBow'] == true) {
                        $this->initial_sram_bytes[0x377] = 0x01;
                    }
                    break;
                case 'SilverArrowUpgrade':
                    $this->initial_sram_bytes[0x38E] |= 0b01000000;
                    if ($config['rom.rupeeBow'] == true) {
                        $this->initial_sram_bytes[0x377] = 0x01;
                    }
                    break;
                case 'BowAndSilverArrows':
                    $this->initial_sram_bytes[0x340] = 0x04;
                    $this->initial_sram_bytes[0x38E] |= 0b01000000;
                    if ($config['rom.rupeeBow'] == true) {
                        $this->initial_sram_bytes[0x377] = 0x01;
                    } else {
                        $this->initial_sram_bytes[0x38E] |= 0b10000000;
                    }
                    break;
                case 'Progressivebow':
                    min($this->initial_sram_bytes[0x340] + 2, 4);
                    if ($config['rom.rupeeBow'] == true) {
                        $this->initial_sram_bytes[0x377] = 0x01;
                    } else {
                        $this->initial_sram_bytes[0x38E] = 0b10000000;
                    }
                    break;
                case 'Boomerang':
                    $this->initial_sram_bytes[0x341] = 0x01;
                    $this->initial_sram_bytes[0x38C] |= 0b10000000;
                    break;
                case 'RedBoomerang':
                    $this->initial_sram_bytes[0x341] = 0x02;
                    $this->initial_sram_bytes[0x38C] |= 0b01000000;
                    break;
                case 'Mushroom':
                    $this->initial_sram_bytes[0x344] = 0x01;
                    $this->initial_sram_bytes[0x38C] |= 0b00101000;
                    break;
                case 'Powder':
                    $this->initial_sram_bytes[0x344] = 0x02;
                    $this->initial_sram_bytes[0x38C] |= 0b00010000;
                    break;
                case 'Bombos':
                    $this->initial_sram_bytes[0x347] = 0x01;
                    break;
                case 'Ether':
                    $this->initial_sram_bytes[0x348] = 0x01;
                    break;
                case 'Quake':
                    $this->initial_sram_bytes[0x349] = 0x01;
                    break;
                case 'Lamp':
                    $this->initial_sram_bytes[0x34A] = 0x01;
                    break;
                case 'Shovel':
                    $this->initial_sram_bytes[0x34C] = 0x01;
                    $this->initial_sram_bytes[0x38C] |= 0b00000100;
                    break;
                case 'OcarinaInactive':
                    $this->initial_sram_bytes[0x34C] = 0x02;
                    $this->initial_sram_bytes[0x38C] |= 0b00000010;
                    break;
                case 'OcarinaActive':
                    $this->initial_sram_bytes[0x34C] = 0x03;
                    $this->initial_sram_bytes[0x38C] |= 0b00000001;
                    break;
                case 'CaneOfSomaria':
                    $this->initial_sram_bytes[0x350] = 0x01;
                    break;
                case 'Bottle':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x02;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'BottleWithRedPotion':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x03;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'BottleWithGreenPotion':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x04;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'BottleWithBluePotion':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x05;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'BottleWithBee':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x07;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'BottleWithFairy':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x06;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'BottleWithGoldBee':
                    if ($this->initial_sram_bytes[0x34F] < 4) {
                        $this->initial_sram_bytes[0x35C + $this->initial_sram_bytes[0x34F]] = 0x08;
                        $this->initial_sram_bytes[0x34F] += 1;
                    }
                    break;
                case 'CaneOfByrna':
                    $this->initial_sram_bytes[0x351] = 0x01;
                    break;
                case 'Cape':
                    $this->initial_sram_bytes[0x352] = 0x01;
                    break;
                case 'MagicMirror':
                    $this->initial_sram_bytes[0x353] = 0x02;
                    break;
                case 'PowerGlove':
                    $this->initial_sram_bytes[0x354] = 0x01;
                    break;
                case 'TitansMitt':
                    $this->initial_sram_bytes[0x354] = 0x02;
                    break;
                case 'BookOfMudora':
                    $this->initial_sram_bytes[0x34E] = 0x01;
                    break;
                case 'Flippers':
                    $this->initial_sram_bytes[0x356] = 0x01;
                    $this->initial_sram_bytes[0x379] |= 0b00000010;
                    break;
                case 'MoonPearl':
                    $this->initial_sram_bytes[0x357] = 0x01;
                    break;
                case 'BugCatchingNet':
                    $this->initial_sram_bytes[0x34D] = 0x01;
                    break;
                case 'BlueMail':
                    $this->initial_sram_bytes[0x35B] = 0x01;
                    $this->initial_sram_bytes[0x46E] = 0x01;
                    break;
                case 'RedMail':
                    $this->initial_sram_bytes[0x35B] = 0x02;
                    $this->initial_sram_bytes[0x46E] = 0x02;
                    break;
                case 'Bomb':
                    $this->initial_sram_bytes[0x343] = min($this->initial_sram_bytes[0x343] + 1, 99);
                    $this->initial_sram_bytes[0x38D] |= 0b00000010;
                    break;
                case 'ThreeBombs':
                    $this->initial_sram_bytes[0x343] = min($this->initial_sram_bytes[0x343] + 3, 99);
                    $this->initial_sram_bytes[0x38D] |= 0b00000010;
                    break;
                case 'TenBombs':
                    $this->initial_sram_bytes[0x343] = min($this->initial_sram_bytes[0x343] + 10, 99);
                    $this->initial_sram_bytes[0x38D] |= 0b00000010;
                    break;
                case 'OneRupee':
                    $starting_rupees += 1;
                    break;
                case 'FiveRupees':
                    $starting_rupees += 5;
                    break;
                case 'TwentyRupees':
                case 'TwentyRupees2':
                    $starting_rupees += 20;
                    break;
                case 'FiftyRupees':
                    $starting_rupees += 50;
                    break;
                case 'OneHundredRupees':
                    $starting_rupees += 100;
                    break;
                case 'PendantOfCourage':
                    $this->initial_sram_bytes[0x374] |= 0b00000100;
                    $this->initial_sram_bytes[0x429] = min($this->initial_sram_bytes[0x429] + 1, 3);
                    break;
                case 'PendantOfWisdom':
                    $this->initial_sram_bytes[0x374] |= 0b00000001;
                    $this->initial_sram_bytes[0x429] = min($this->initial_sram_bytes[0x429] + 1, 3);
                    break;
                case 'PendantOfPower':
                    $this->initial_sram_bytes[0x374] |= 0b00000010;
                    $this->initial_sram_bytes[0x429] = min($this->initial_sram_bytes[0x429] + 1, 3);
                    break;
                case 'HeartContainerNoAnimation':
                case 'BossHeartContainer':
                case 'HeartContainer':
                    $this->initial_sram_bytes[0x36C] = min($this->initial_sram_bytes[0x36C] + 0x08, 0xA0);
                    $this->initial_sram_bytes[0x36D] = min($this->initial_sram_bytes[0x36D] + 0x08, 0xA0);
                    break;
                case 'PieceOfHeart':
                    $this->initial_sram_bytes[0x36B] += 1;
                    if ($this->initial_sram_bytes[0x36B] >= 4) {
                        $this->initial_sram_bytes[0x36C] = min($this->initial_sram_bytes[0x36C] + (0x08 * floor($this->initial_sram_bytes[0x36B] / 4)), 0xA0);
                        $this->initial_sram_bytes[0x36B] %= 4;
                    }
                    break;
                case 'Heart':
                    $this->initial_sram_bytes[0x36D] = min($this->initial_sram_bytes[0x36D] + 0x08, 0xA0);
                    break;
                case 'Arrow':
                    $this->initial_sram_bytes[0x377] = min($this->initial_sram_bytes[0x377] + 1, 99);
                    break;
                case 'TenArrows':
                    $this->initial_sram_bytes[0x377] = min($this->initial_sram_bytes[0x377] + 10, 99);
                    break;
                case 'SmallMagic':
                    $this->initial_sram_bytes[0x36E] = min($this->initial_sram_bytes[0x36E] + 0x10, 0x80);
                    break;
                case 'ThreeHundredRupees':
                    $starting_rupees += 300;
                    break;
                case 'PegasusBoots':
                    $this->initial_sram_bytes[0x355] = 0x01;
                    $this->initial_sram_bytes[0x379] |= 0b00000100;
                    break;
                case 'BombUpgrade5':
                    $starting_bomb_capacity_upgrades += 5;
                    break;
                case 'BombUpgrade10':
                    $starting_bomb_capacity_upgrades += 10;
                    break;
                case 'ArrowUpgrade5':
                    $starting_arrow_capacity_upgrades += 5;
                    break;
                case 'ArrowUpgrade10':
                    $starting_arrow_capacity_upgrades += 10;
                    break;
                case 'HalfMagic':
                    $this->initial_sram_bytes[0x37B] = 0x01;
                    break;
                case 'QuarterMagic':
                    $this->initial_sram_bytes[0x37B] = 0x02;
                    break;
                case 'ProgressiveSword':
                    $this->initial_sram_bytes[0x359] = min($this->initial_sram_bytes[0x359] + 1, 4);
                    break;
                case 'ProgressiveShield':
                    $this->initial_sram_bytes[0x35A] = min($this->initial_sram_bytes[0x35A] + 1, 3);
                    break;
                case 'ProgressiveArmor':
                    $this->initial_sram_bytes[0x35B] = min($this->initial_sram_bytes[0x35B] + 1, 2);
                    break;
                case 'ProgressiveGlove':
                    $this->initial_sram_bytes[0x354] = min($this->initial_sram_bytes[0x354] + 1, 2);
                    break;
                case 'MapLW':
                    $this->initial_sram_bytes[0x368] |= 0b00000001;
                    break;
                case 'MapDW':
                    $this->initial_sram_bytes[0x368] |= 0b00000010;
                    break;
                case 'MapA2':
                    $this->initial_sram_bytes[0x368] |= 0b00000100;
                    break;
                case 'MapD7':
                    $this->initial_sram_bytes[0x368] |= 0b00001000;
                    break;
                case 'MapD4':
                    $this->initial_sram_bytes[0x368] |= 0b00010000;
                    break;
                case 'MapP3':
                    $this->initial_sram_bytes[0x368] |= 0b00100000;
                    break;
                case 'MapD5':
                    $this->initial_sram_bytes[0x368] |= 0b01000000;
                    break;
                case 'MapD3':
                    $this->initial_sram_bytes[0x368] |= 0b10000000;
                    break;
                case 'MapD6':
                    $this->initial_sram_bytes[0x369] |= 0b00000001;
                    break;
                case 'MapD1':
                    $this->initial_sram_bytes[0x369] |= 0b00000010;
                    break;
                case 'MapD2':
                    $this->initial_sram_bytes[0x369] |= 0b00000100;
                    break;
                case 'MapA1':
                    $this->initial_sram_bytes[0x369] |= 0b00001000;
                    break;
                case 'MapP2':
                    $this->initial_sram_bytes[0x369] |= 0b00010000;
                    break;
                case 'MapP1':
                    $this->initial_sram_bytes[0x369] |= 0b00100000;
                    break;
                case 'MapH1':
                case 'MapH2':
                    $this->initial_sram_bytes[0x369] |= 0b11000000;
                    break;
                case 'CompassA2':
                    $this->initial_sram_bytes[0x364] |= 0b00000100;
                    break;
                case 'CompassD7':
                    $this->initial_sram_bytes[0x364] |= 0b00001000;
                    break;
                case 'CompassD4':
                    $this->initial_sram_bytes[0x364] |= 0b00010000;
                    break;
                case 'CompassP3':
                    $this->initial_sram_bytes[0x364] |= 0b00100000;
                    break;
                case 'CompassD5':
                    $this->initial_sram_bytes[0x364] |= 0b01000000;
                    break;
                case 'CompassD3':
                    $this->initial_sram_bytes[0x364] |= 0b10000000;
                    break;
                case 'CompassD6':
                    $this->initial_sram_bytes[0x365] |= 0b00000001;
                    break;
                case 'CompassD1':
                    $this->initial_sram_bytes[0x365] |= 0b00000010;
                    break;
                case 'CompassD2':
                    $this->initial_sram_bytes[0x365] |= 0b00000100;
                    break;
                case 'CompassA1':
                    $this->initial_sram_bytes[0x365] |= 0b00001000;
                    break;
                case 'CompassP2':
                    $this->initial_sram_bytes[0x365] |= 0b00010000;
                    break;
                case 'CompassP1':
                    $this->initial_sram_bytes[0x365] |= 0b00100000;
                    break;
                case 'CompassH1':
                case 'CompassH2':
                    $this->initial_sram_bytes[0x365] |= 0b11000000;
                    break;
                case 'BigKeyA2':
                    $this->initial_sram_bytes[0x366] |= 0b00000100;
                    break;
                case 'BigKeyD7':
                    $this->initial_sram_bytes[0x366] |= 0b00001000;
                    break;
                case 'BigKeyD4':
                    $this->initial_sram_bytes[0x366] |= 0b00010000;
                    break;
                case 'BigKeyP3':
                    $this->initial_sram_bytes[0x366] |= 0b00100000;
                    break;
                case 'BigKeyD5':
                    $this->initial_sram_bytes[0x366] |= 0b01000000;
                    break;
                case 'BigKeyD3':
                    $this->initial_sram_bytes[0x366] |= 0b10000000;
                    break;
                case 'BigKeyD6':
                    $this->initial_sram_bytes[0x367] |= 0b00000001;
                    break;
                case 'BigKeyD1':
                    $this->initial_sram_bytes[0x367] |= 0b00000010;
                    break;
                case 'BigKeyD2':
                    $this->initial_sram_bytes[0x367] |= 0b00000100;
                    break;
                case 'BigKeyA1':
                    $this->initial_sram_bytes[0x367] |= 0b00001000;
                    break;
                case 'BigKeyP2':
                    $this->initial_sram_bytes[0x367] |= 0b00010000;
                    break;
                case 'BigKeyP1':
                    $this->initial_sram_bytes[0x367] |= 0b00100000;
                    break;
                case 'BigKeyH1':
                case 'BigKeyH2':
                    $this->initial_sram_bytes[0x367] |= 0b11000000;
                    break;
                case 'KeyH1':
                case 'KeyH2':
                    $this->initial_sram_bytes[0x37C] += 1;
                    $this->initial_sram_bytes[0x37D] += 1;
                    break;
                case 'KeyP1':
                    $this->initial_sram_bytes[0x37E] += 1;
                    break;
                case 'KeyP2':
                    $this->initial_sram_bytes[0x37F] += 1;
                    break;
                case 'KeyA1':
                    $this->initial_sram_bytes[0x380] += 1;
                    break;
                case 'KeyD2':
                    $this->initial_sram_bytes[0x381] += 1;
                    break;
                case 'KeyD1':
                    $this->initial_sram_bytes[0x382] += 1;
                    break;
                case 'KeyD6':
                    $this->initial_sram_bytes[0x383] += 1;
                    break;
                case 'KeyD3':
                    $this->initial_sram_bytes[0x384] += 1;
                    break;
                case 'KeyD5':
                    $this->initial_sram_bytes[0x385] += 1;
                    break;
                case 'KeyP3':
                    $this->initial_sram_bytes[0x386] += 1;
                    break;
                case 'KeyD4':
                    $this->initial_sram_bytes[0x387] += 1;
                    break;
                case 'KeyD7':
                    $this->initial_sram_bytes[0x388] += 1;
                    break;
                case 'KeyA2':
                    $this->initial_sram_bytes[0x389] += 1;
                    break;
                case 'Crystal1':
                    $this->initial_sram_bytes[0x37A] |= 0b00000010;
                    break;
                case 'Crystal2':
                    $this->initial_sram_bytes[0x37A] |= 0b00010000;
                    break;
                case 'Crystal3':
                    $this->initial_sram_bytes[0x37A] |= 0b01000000;
                    break;
                case 'Crystal4':
                    $this->initial_sram_bytes[0x37A] |= 0b00100000;
                    break;
                case 'Crystal5':
                    $this->initial_sram_bytes[0x37A] |= 0b00000100;
                    break;
                case 'Crystal6':
                    $this->initial_sram_bytes[0x37A] |= 0b00000001;
                    break;
                case 'Crystal7':
                    $this->initial_sram_bytes[0x37A] |= 0b00001000;
                    break;
            }
        }
        $this->initial_sram_bytes[0x362] = $this->initial_sram_bytes[0x360] = $starting_rupees & 0xFF;
        $this->initial_sram_bytes[0x363] = $this->initial_sram_bytes[0x361] = $starting_rupees >> 8;

        // Set counters and highest equipment values
        $this->initial_sram_bytes[0x471] = count_set_bits($this->initial_sram_bytes[0x37A]);
        $this->initial_sram_bytes[0x429] = count_set_bits($this->initial_sram_bytes[0x374]);
        $this->initial_sram_bytes[0x417] = $this->initial_sram_bytes[0x359];
        $this->initial_sram_bytes[0x422] = $this->initial_sram_bytes[0x35A];
        $this->initial_sram_bytes[0x46E] = $this->initial_sram_bytes[0x35B];

        $this->setValue(0x370, $starting_arrow_capacity_upgrades);
        $this->setValue(0x371, $starting_bomb_capacity_upgrades);

        if ($config['mode.weapons'] == 'swordless') {
            $this->initial_sram_bytes[0x359] = 0xFF;
            $this->initial_sram_bytes[0x417] = 0x00;
        }
    }

    /**
     * Set the initial progress indicator.
     *
     * @param int $indicator set to 0x00 for standard, 0x02 for open. See sram.asm
     * for further documentation.
     */
    public function setProgressIndicator(int $indicator)
    {
        $this->setValue(0x3C5, $indicator);
    }

    /**
     * Set the initial progress flags.
     *
     * @param int $flags set to 0x00 for standard, 0x14 for open. See sram.asm for
     * further documentation.
     */
    public function setProgressFlags(int $flags)
    {
        $this->setValue(0x3C6, $flags);
    }

    /**
     * Set the initial starting entrance.
     *
     * @param int $entrance set to 0x00 for standard, 0x01 for open. See sram.asm for
     * further documentation.
     */
    public function setStartingEntrance(int $entrance)
    {
        $this->setValue(0x3C8, $entrance);
    }

    /**
     * Set starting timer.
     *
     * @param int $seconds
     */
    public function setStartingTimer(int $seconds)
    {
        $bytes = unpack("C*", pack("V", $seconds * 60));
        $this->initial_sram_bytes[0x454] = $bytes[1];
        $this->initial_sram_bytes[0x455] = $bytes[2];
        $this->initial_sram_bytes[0x456] = $bytes[3];
        $this->initial_sram_bytes[0x457] = $bytes[4];
    }

    /**
     * Set swordless mode. Removes curtains and sets starting sword to 0xFF.
     */
    public function setSwordlessCurtains()
    {
        $this->setValue($this::ROOM_DATA + 0x61, 0x80);
        $this->setValue($this::ROOM_DATA + 0x93, 0x80);
    }

    /**
     * Set instant post-aga world state
     *
     * param string $state world state
     */
    public function setInstantPostAga(string $state)
    {
        switch ($state) {
            case 'standard':
                $this->setValue(0x3C5, 0x80);
                $this->setValue($this::OVERWORLD_DATA + 0x02, 0x20);
                break;
            case 'open':
            case 'retro':
            case 'inverted':
            default:
                $this->setValue(0x3C5, 0x03);
                $this->setValue($this::OVERWORLD_DATA + 0x02, 0x20);
                break;
        }
    }

    /**
     * Gets final initial SRAM table.
     *
     * @throws \Exception if the size exceeds SRAM_SIZE
     *
     * @return array
     */
    function getInitialSram()
    {
        $table_size = count($this->initial_sram_bytes);
        if ($table_size !== $this::SRAM_SIZE) {
            throw new \Exception("Initial SRAM table exceeds size limit: " . $table_size);
        }

        return $this->initial_sram_bytes;
    }
}
