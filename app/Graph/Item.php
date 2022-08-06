<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * An Item is any collectable thing in game.
 */
final class Item
{
    /** @var array<int> */
    public readonly array $bytes;
    public readonly string $raw_name;
    public readonly string $name;
    public readonly string $nice_name;
    public readonly string $i18n_name;
    public readonly int $world_id;
    public bool $meta = false;
    /** @var array<array<Item>> */
    private static array $items;

    /**
     * Get the Item by name
     *
     * @param string $name Name of Item
     * @param int $world_id World item belongs to
     */
    public static function get(string $name, int $world_id): self
    {
        $items = static::all($world_id);
        $world_name = $name . ':' . $world_id;

        if (isset($items[$world_name])) {
            return $items[$world_name];
        }

        // allow made up items
        $item = new Item($name, [null], $world_id);
        $item->meta = true;
        self::$items[$world_id][$item->name] = $item;

        return $item;
    }

    /**
     * Get the all known Items.
     *
     * @param int $world_id World item belongs to
     */
    public static function all(int $world_id): array
    {
        if (isset(static::$items[$world_id])) {
            return static::$items[$world_id];
        }

        static::$items[$world_id] = [];

        foreach ([
            new Item('Nothing', [0x5A], $world_id),
            new Item('L1Sword', [0x49], $world_id),
            new Item('L1SwordAndShield', [0x00], $world_id),
            new Item('L2Sword', [0x01], $world_id),
            new Item('MasterSword', [0x50], $world_id),
            new Item('L3Sword', [0x02], $world_id),
            new Item('L4Sword', [0x03], $world_id),
            new Item('BlueShield', [0x04], $world_id),
            new Item('RedShield', [0x05], $world_id),
            new Item('MirrorShield', [0x06], $world_id),
            new Item('FireRod', [0x07], $world_id),
            new Item('IceRod', [0x08], $world_id),
            new Item('Hammer', [0x09], $world_id),
            new Item('Hookshot', [0x0A], $world_id),
            new Item('Bow', [0x0B], $world_id),
            new Item('Boomerang', [0x0C], $world_id),
            new Item('Powder', [0x0D], $world_id),
            new Item('Bee', [0x0E], $world_id),
            new Item('Bombos', [0x0f, 0x00, 't0' => 0x31, 't1' => 0x90, 't2' => 0x00, 'm0' => 0x31, 'm1' => 0x80, 'm2' => 0x00], $world_id),
            new Item('Ether', [0x10, 0x01, 't0' => 0x31, 't1' => 0x98, 't2' => 0x00, 'm0' => 0x13, 'm1' => 0x9F, 'm2' => 0xF1], $world_id),
            new Item('Quake', [0x11, 0x02, 't0' => 0x14, 't1' => 0xEF, 't2' => 0xC4, 'm0' => 0x31, 'm1' => 0x88, 'm2' => 0x00], $world_id),
            new Item('Lamp', [0x12], $world_id),
            new Item('Shovel', [0x13], $world_id),
            new Item('OcarinaInactive', [0x14], $world_id),
            new Item('CaneOfSomaria', [0x15], $world_id),
            new Item('Bottle', [0x16], $world_id),
            new Item('FairyBottle', [0x16], $world_id),
            new Item('PieceOfHeart', [0x17], $world_id, .25),
            new Item('CaneOfByrna', [0x18], $world_id),
            new Item('Cape', [0x19], $world_id),
            new Item('MagicMirror', [0x1A], $world_id),
            new Item('PowerGlove', [0x1B], $world_id),
            new Item('TitansMitt', [0x1C], $world_id),
            new Item('BookOfMudora', [0x1D], $world_id),
            new Item('Flippers', [0x1E], $world_id),
            new Item('MoonPearl', [0x1F], $world_id),
            new Item('BugCatchingNet', [0x21], $world_id),
            new Item('BlueMail', [0x22], $world_id),
            new Item('RedMail', [0x23], $world_id),
            new Item('Key', [0x24], $world_id),
            new Item('Compass', [0x25], $world_id),
            new Item('HeartContainerNoAnimation', [0x26], $world_id, 1),
            new Item('Bomb', [0x27], $world_id),
            new Item('ThreeBombs', [0x28], $world_id),
            new Item('Mushroom', [0x29], $world_id),
            new Item('RedBoomerang', [0x2A], $world_id),
            new Item('BottleWithRedPotion', [0x2B], $world_id),
            new Item('FairyBottleWithRedPotion', [0x2B], $world_id),
            new Item('BottleWithGreenPotion', [0x2C], $world_id),
            new Item('FairyBottleWithGreenPotion', [0x2C], $world_id),
            new Item('BottleWithBluePotion', [0x2D], $world_id),
            new Item('FairyBottleWithBluePotion', [0x2D], $world_id),
            new Item('RedPotion', [0x2E], $world_id),
            new Item('GreenPotion', [0x2F], $world_id),
            new Item('BluePotion', [0x30], $world_id),
            new Item('TenBombs', [0x31], $world_id),
            new Item('BigKey', [0x32], $world_id),
            new Item('Map', [0x33], $world_id),
            new Item('OneRupee', [0x34], $world_id),
            new Item('FiveRupees', [0x35], $world_id),
            new Item('TwentyRupees', [0x36], $world_id),
            new Item('PendantOfCourage', [0x37, 0x04, 0x38, 0x62, 0x00, 0x69, 0x01], $world_id),
            new Item('PendantOfWisdom', [0x38, 0x01, 0x32, 0x60, 0x00, 0x69, 0x03], $world_id),
            new Item('PendantOfPower', [0x39, 0x02, 0x34, 0x60, 0x00, 0x69, 0x02], $world_id),
            new Item('BowAndArrows', [0x3A], $world_id),
            new Item('BowAndSilverArrows', [0x3B], $world_id),
            new Item('BottleWithBee', [0x3C], $world_id),
            new Item('FairyBottleWithBee', [0x3C], $world_id),
            new Item('BottleWithFairy', [0x3D], $world_id),
            new Item('FairyBottleWithFairy', [0x3D], $world_id),
            new Item('BossHeartContainer', [0x3E], $world_id, 1),
            new Item('HeartContainer', [0x3F], $world_id, 1),
            new Item('OneHundredRupees', [0x40], $world_id),
            new Item('FiftyRupees', [0x41], $world_id),
            new Item('Heart', [0x42], $world_id),
            new Item('Arrow', [0x43], $world_id),
            new Item('ShopArrow', [0x43], $world_id),
            new Item('TenArrows', [0x44], $world_id),
            new Item('SmallMagic', [0x45], $world_id),
            new Item('ThreeHundredRupees', [0x46], $world_id),
            new Item('TwentyRupees2', [0x47], $world_id),
            new Item('BottleWithGoldBee', [0x48], $world_id),
            new Item('FairyBottleWithGoldBee', [0x48], $world_id),
            new Item('OcarinaActive', [0x4A], $world_id),
            new Item('PegasusBoots', [0x4B], $world_id),
            new Item('BombUpgrade5', [0x51], $world_id),
            new Item('BombUpgrade10', [0x52], $world_id),
            new Item('BombUpgrade50', [0x4C], $world_id),
            new Item('ArrowUpgrade5', [0x53], $world_id),
            new Item('ArrowUpgrade10', [0x54], $world_id),
            new Item('ArrowUpgrade70', [0x4D], $world_id),
            new Item('HalfMagic', [0x4E], $world_id),
            new Item('QuarterMagic', [0x4F], $world_id),
            new Item('Programmable1', [0x55], $world_id),
            new Item('Programmable2', [0x56], $world_id),
            new Item('Programmable3', [0x57], $world_id),
            new Item('SilverArrowUpgrade', [0x58], $world_id),
            new Item('Rupoor', [0x59], $world_id),
            new Item('RedClock', [0x5B], $world_id),
            new Item('BlueClock', [0x5C], $world_id),
            new Item('GreenClock', [0x5D], $world_id),
            new Item('ProgressiveSword', [0x5E], $world_id),
            new Item('UncleSword', [0x5E], $world_id),
            new Item('ProgressiveShield', [0x5F], $world_id),
            new Item('ProgressiveArmor', [0x60], $world_id),
            new Item('ProgressiveGlove', [0x61], $world_id),
            new Item('singleRNG', [0x62], $world_id),
            new Item('multiRNG', [0x63], $world_id),
            new Item('ProgressiveBow', [0x64], $world_id),
            new Item('ProgressiveBowAlternate', [0x65], $world_id),
            new Item('Triforce', [0x6A], $world_id),
            new Item('PowerStar', [0x6B], $world_id),
            new Item('TriforcePiece', [0x6C], $world_id),
            new Item('MapLW', [0x70], $world_id),
            new Item('MapDW', [0x71], $world_id),
            new Item('MapA2', [0x72], $world_id),
            new Item('MapD7', [0x73], $world_id),
            new Item('MapD4', [0x74], $world_id),
            new Item('MapP3', [0x75], $world_id),
            new Item('MapD5', [0x76], $world_id),
            new Item('MapD3', [0x77], $world_id),
            new Item('MapD6', [0x78], $world_id),
            new Item('MapD1', [0x79], $world_id),
            new Item('MapD2', [0x7A], $world_id),
            new Item('MapA1', [0x7B], $world_id),
            new Item('MapP2', [0x7C], $world_id),
            new Item('MapP1', [0x7D], $world_id),
            new Item('MapH1', [0x7E], $world_id),
            new Item('MapH2', [0x7F], $world_id),
            new Item('CompassA2', [0x82], $world_id),
            new Item('CompassD7', [0x83], $world_id),
            new Item('CompassD4', [0x84], $world_id),
            new Item('CompassP3', [0x85], $world_id),
            new Item('CompassD5', [0x86], $world_id),
            new Item('CompassD3', [0x87], $world_id),
            new Item('CompassD6', [0x88], $world_id),
            new Item('CompassD1', [0x89], $world_id),
            new Item('CompassD2', [0x8A], $world_id),
            new Item('CompassA1', [0x8B], $world_id),
            new Item('CompassP2', [0x8C], $world_id),
            new Item('CompassP1', [0x8D], $world_id),
            new Item('CompassH1', [0x8E], $world_id),
            new Item('CompassH2', [0x8F], $world_id),
            new Item('BigKeyA2', [0x92], $world_id),
            new Item('BigKeyD7', [0x93], $world_id),
            new Item('BigKeyD4', [0x94], $world_id),
            new Item('BigKeyP3', [0x95], $world_id),
            new Item('BigKeyD5', [0x96], $world_id),
            new Item('BigKeyD3', [0x97], $world_id),
            new Item('BigKeyD6', [0x98], $world_id),
            new Item('BigKeyD1', [0x99], $world_id),
            new Item('BigKeyD2', [0x9A], $world_id),
            new Item('BigKeyA1', [0x9B], $world_id),
            new Item('BigKeyP2', [0x9C], $world_id),
            new Item('BigKeyP1', [0x9D], $world_id),
            new Item('BigKeyH1', [0x9E], $world_id),
            new Item('BigKeyH2', [0x9F], $world_id),
            new Item('KeyH2', [0xA0], $world_id),
            new Item('KeyH1', [0xA1], $world_id),
            new Item('KeyP1', [0xA2], $world_id),
            new Item('KeyP2', [0xA3], $world_id),
            new Item('KeyA1', [0xA4], $world_id),
            new Item('KeyD2', [0xA5], $world_id),
            new Item('KeyD1', [0xA6], $world_id),
            new Item('KeyD6', [0xA7], $world_id),
            new Item('KeyD3', [0xA8], $world_id),
            new Item('KeyD5', [0xA9], $world_id),
            new Item('KeyP3', [0xAA], $world_id),
            new Item('KeyD4', [0xAB], $world_id),
            new Item('KeyD7', [0xAC], $world_id),
            new Item('KeyA2', [0xAD], $world_id),
            new Item('KeyGK', [0xAF], $world_id),
            new Item('ShopKey', [0xAF], $world_id),
            new Item('Crystal1', [null, 0x02, 0x34, 0x64, 0x40, 0x7F, 0x06], $world_id),
            new Item('Crystal2', [null, 0x10, 0x34, 0x64, 0x40, 0x79, 0x06], $world_id),
            new Item('Crystal3', [null, 0x40, 0x34, 0x64, 0x40, 0x6C, 0x06], $world_id),
            new Item('Crystal4', [null, 0x20, 0x34, 0x64, 0x40, 0x6D, 0x06], $world_id),
            new Item('Crystal5', [null, 0x04, 0x32, 0x64, 0x40, 0x6E, 0x06], $world_id),
            new Item('Crystal6', [null, 0x01, 0x32, 0x64, 0x40, 0x6F, 0x06], $world_id),
            new Item('Crystal7', [null, 0x08, 0x34, 0x64, 0x40, 0x7C, 0x06], $world_id),
            new Item('DefeatGanon', [null], $world_id),
        ] as $item) {
            static::$items[$world_id][$item->name] = $item;
        }

        return static::all($world_id);
    }

    /**
     * Create a new Item.
     *
     * @param string $name Unique name of item
     * @param array $bytes data to write to Location addresses
     * @param int $world_id world for which the item belongs
     *
     * @return void
     */
    public function __construct(string $name, array $bytes, int $world_id)
    {
        $this->raw_name = $name;
        $this->name = $name . ':' . $world_id;;
        $this->i18n_name = 'item.' . $name;
        $formatted = __($this->i18n_name);
        $this->nice_name = is_string($formatted) ? $formatted : '';
        $this->bytes = $bytes;
        $this->world_id = $world_id;
    }

    /**
     * serialized version of Item.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
