<?php

namespace ALttP;

use ALttP\Support\ItemCollection;

/**
 * An Item is any collectable thing in game.
 */
class Item
{
    protected $bytes;
    protected $name;
    protected $nice_name;
    protected $world;

    protected static $items;
    protected static $worlds = [];

    /**
     * Get the Item by name
     *
     * @param string $name Name of Item
     *
     * @throws \Exception if the Item doesn't exist
     *
     * @return Item
     */
    public static function get(string $name, World $world)
    {
        $items = static::all($world);
        $world_name = $name . ':' . $world->id;

        if (isset($items[$world_name])) {
            return $items[$world_name];
        }

        return static::getNice($name, $world);
    }

    /**
     * Get the Item by nice name
     *
     * @param string $name Name of Item
     * @param \ALttP\World  $world  World item belongs to
     *
     * @throws \Exception if the Item doesn't exist
     *
     * @return Item
     */
    public static function getNice(string $name, World $world)
    {
        $items = static::all($world);

        foreach ($items as $item) {
            if ($item->getNiceName() == $name) {
                return $item;
            }
        }

        throw new \Exception('Unknown Item: ' . $name);
    }

    /**
     * Clears the internal cache so we don't leak memory in testing.
     *
     * @return void
     */
    public static function clearCache(): void
    {
        static::$items = [];
        static::$worlds = [];
    }

    /**
     * Get the all known Items.
     *
     * @param \ALttP\World  $world  World items belongs to
     *
     * @return ItemCollection
     */
    public static function all(World $world)
    {
        if (isset(static::$items[$world->id])) {
            return static::$items[$world->id];
        }
        static::$worlds[$world->id] = $world;

        static::$items[$world->id] = new ItemCollection([
            new Item('Nothing', [0x5A], $world),
            new Item\Sword('L1Sword', [0x49], $world),
            new Item\Sword('L1SwordAndShield', [0x00], $world),
            new Item\Sword('L2Sword', [0x01], $world),
            new Item\Sword('MasterSword', [0x50], $world),
            new Item\Sword('L3Sword', [0x02], $world),
            new Item\Sword('L4Sword', [0x03], $world),
            new Item\Shield('BlueShield', [0x04], $world),
            new Item\Shield('RedShield', [0x05], $world),
            new Item\Shield('MirrorShield', [0x06], $world),
            new Item('FireRod', [0x07], $world),
            new Item('IceRod', [0x08], $world),
            new Item('Hammer', [0x09], $world),
            new Item('Hookshot', [0x0A], $world),
            new Item\Bow('Bow', [0x0B], $world),
            new Item('Boomerang', [0x0C], $world),
            new Item('Powder', [0x0D], $world),
            new Item\BottleContents('Bee', [0x0E], $world),
            new Item\Medallion('Bombos', [0x0f, 0x00, 't0' => 0x31, 't1' => 0x90, 't2' => 0x00, 'm0' => 0x31, 'm1' => 0x80, 'm2' => 0x00], $world),
            new Item\Medallion('Ether', [0x10, 0x01, 't0' => 0x31, 't1' => 0x98, 't2' => 0x00, 'm0' => 0x13, 'm1' => 0x9F, 'm2' => 0xF1], $world),
            new Item\Medallion('Quake', [0x11, 0x02, 't0' => 0x14, 't1' => 0xEF, 't2' => 0xC4, 'm0' => 0x31, 'm1' => 0x88, 'm2' => 0x00], $world),
            new Item('Lamp', [0x12], $world),
            new Item('Shovel', [0x13], $world),
            new Item('OcarinaInactive', [0x14], $world),
            new Item('CaneOfSomaria', [0x15], $world),
            new Item\Bottle('Bottle', [0x16], $world),
            new Item\Upgrade\Health('PieceOfHeart', [0x17], $world, .25),
            new Item('CaneOfByrna', [0x18], $world),
            new Item('Cape', [0x19], $world),
            new Item('MagicMirror', [0x1A], $world),
            new Item('PowerGlove', [0x1B], $world),
            new Item('TitansMitt', [0x1C], $world),
            new Item('BookOfMudora', [0x1D], $world),
            new Item('Flippers', [0x1E], $world),
            new Item('MoonPearl', [0x1F], $world),
            new Item('BugCatchingNet', [0x21], $world),
            new Item\Armor('BlueMail', [0x22], $world),
            new Item\Armor('RedMail', [0x23], $world),
            new Item\Key('Key', [0x24], $world),
            new Item\Compass('Compass', [0x25], $world),
            new Item\Upgrade\Health('HeartContainerNoAnimation', [0x26], $world, 1),
            new Item('Bomb', [0x27], $world),
            new Item('ThreeBombs', [0x28], $world),
            new Item('Mushroom', [0x29], $world),
            new Item('RedBoomerang', [0x2A], $world),
            new Item\Bottle('BottleWithRedPotion', [0x2B], $world),
            new Item\Bottle('BottleWithGreenPotion', [0x2C], $world),
            new Item\Bottle('BottleWithBluePotion', [0x2D], $world),
            new Item\BottleContents('RedPotion', [0x2E], $world),
            new Item\BottleContents('GreenPotion', [0x2F], $world),
            new Item\BottleContents('BluePotion', [0x30], $world),
            new Item('TenBombs', [0x31], $world),
            new Item\BigKey('BigKey', [0x32], $world),
            new Item\Map('Map', [0x33], $world),
            new Item('OneRupee', [0x34], $world),
            new Item('FiveRupees', [0x35], $world),
            new Item('TwentyRupees', [0x36], $world),
            new Item\Pendant('PendantOfCourage', [0x37, 0x04, 0x38, 0x62, 0x00, 0x69, 0x01], $world),
            new Item\Pendant('PendantOfWisdom', [0x38, 0x01, 0x32, 0x60, 0x00, 0x69, 0x03], $world),
            new Item\Pendant('PendantOfPower', [0x39, 0x02, 0x34, 0x60, 0x00, 0x69, 0x02], $world),
            new Item\Bow('BowAndArrows', [0x3A], $world),
            new Item\Bow('BowAndSilverArrows', [0x3B], $world),
            new Item\Bottle('BottleWithBee', [0x3C], $world),
            new Item\Bottle('BottleWithFairy', [0x3D], $world),
            new Item\Upgrade\Health('BossHeartContainer', [0x3E], $world, 1),
            new Item\Upgrade\Health('HeartContainer', [0x3F], $world, 1),
            new Item('OneHundredRupees', [0x40], $world),
            new Item('FiftyRupees', [0x41], $world),
            new Item('Heart', [0x42], $world),
            new Item\Arrow('Arrow', [0x43], $world),
            new Item\Arrow('TenArrows', [0x44], $world),
            new Item('SmallMagic', [0x45], $world),
            new Item('ThreeHundredRupees', [0x46], $world),
            new Item('TwentyRupees2', [0x47], $world),
            new Item\Bottle('BottleWithGoldBee', [0x48], $world),
            new Item('OcarinaActive', [0x4A], $world),
            new Item('PegasusBoots', [0x4B], $world),
            new Item\Upgrade\Bomb('BombUpgrade5', [0x51], $world),
            new Item\Upgrade\Bomb('BombUpgrade10', [0x52], $world),
            new Item\Upgrade\Bomb('BombUpgrade50', [0x4C], $world),
            new Item\Upgrade\Arrow('ArrowUpgrade5', [0x53], $world),
            new Item\Upgrade\Arrow('ArrowUpgrade10', [0x54], $world),
            new Item\Upgrade\Arrow('ArrowUpgrade70', [0x4D], $world),
            new Item\Upgrade\Magic('HalfMagic', [0x4E], $world),
            new Item\Upgrade\Magic('QuarterMagic', [0x4F], $world),
            new Item\Programmable('Programmable1', [0x55], $world),
            new Item\Programmable('Programmable2', [0x56], $world),
            new Item\Programmable('Programmable3', [0x57], $world),
            new Item('SilverArrowUpgrade', [0x58], $world),
            new Item('Rupoor', [0x59], $world),
            new Item('RedClock', [0x5B], $world),
            new Item('BlueClock', [0x5C], $world),
            new Item('GreenClock', [0x5D], $world),
            new Item\Sword('ProgressiveSword', [0x5E], $world),
            new Item\Shield('ProgressiveShield', [0x5F], $world),
            new Item\Armor('ProgressiveArmor', [0x60], $world),
            new Item('ProgressiveGlove', [0x61], $world),
            new Item('singleRNG', [0x62], $world),
            new Item('multiRNG', [0x63], $world),
            new Item\Bow('ProgressiveBow', [0x64], $world),
            new Item\Bow('ProgressiveBowAlternate', [0x65], $world),
            new Item\Event('Triforce', [0x6A], $world),
            new Item('PowerStar', [0x6B], $world),
            new Item('TriforcePiece', [0x6C], $world),
            new Item\Map('MapLW', [0x70], $world),
            new Item\Map('MapDW', [0x71], $world),
            new Item\Map('MapA2', [0x72], $world),
            new Item\Map('MapD7', [0x73], $world),
            new Item\Map('MapD4', [0x74], $world),
            new Item\Map('MapP3', [0x75], $world),
            new Item\Map('MapD5', [0x76], $world),
            new Item\Map('MapD3', [0x77], $world),
            new Item\Map('MapD6', [0x78], $world),
            new Item\Map('MapD1', [0x79], $world),
            new Item\Map('MapD2', [0x7A], $world),
            new Item\Map('MapA1', [0x7B], $world),
            new Item\Map('MapP2', [0x7C], $world),
            new Item\Map('MapP1', [0x7D], $world),
            new Item\Map('MapH1', [0x7E], $world),
            new Item\Map('MapH2', [0x7F], $world),
            new Item\Compass('CompassA2', [0x82], $world),
            new Item\Compass('CompassD7', [0x83], $world),
            new Item\Compass('CompassD4', [0x84], $world),
            new Item\Compass('CompassP3', [0x85], $world),
            new Item\Compass('CompassD5', [0x86], $world),
            new Item\Compass('CompassD3', [0x87], $world),
            new Item\Compass('CompassD6', [0x88], $world),
            new Item\Compass('CompassD1', [0x89], $world),
            new Item\Compass('CompassD2', [0x8A], $world),
            new Item\Compass('CompassA1', [0x8B], $world),
            new Item\Compass('CompassP2', [0x8C], $world),
            new Item\Compass('CompassP1', [0x8D], $world),
            new Item\Compass('CompassH1', [0x8E], $world),
            new Item\Compass('CompassH2', [0x8F], $world),
            new Item\BigKey('BigKeyA2', [0x92], $world),
            new Item\BigKey('BigKeyD7', [0x93], $world),
            new Item\BigKey('BigKeyD4', [0x94], $world),
            new Item\BigKey('BigKeyP3', [0x95], $world),
            new Item\BigKey('BigKeyD5', [0x96], $world),
            new Item\BigKey('BigKeyD3', [0x97], $world),
            new Item\BigKey('BigKeyD6', [0x98], $world),
            new Item\BigKey('BigKeyD1', [0x99], $world),
            new Item\BigKey('BigKeyD2', [0x9A], $world),
            new Item\BigKey('BigKeyA1', [0x9B], $world),
            new Item\BigKey('BigKeyP2', [0x9C], $world),
            new Item\BigKey('BigKeyP1', [0x9D], $world),
            new Item\BigKey('BigKeyH1', [0x9E], $world),
            new Item\BigKey('BigKeyH2', [0x9F], $world),
            new Item\Key('KeyH2', [0xA0], $world),
            new Item\Key('KeyH1', [0xA1], $world),
            new Item\Key('KeyP1', [0xA2], $world),
            new Item\Key('KeyP2', [0xA3], $world),
            new Item\Key('KeyA1', [0xA4], $world),
            new Item\Key('KeyD2', [0xA5], $world),
            new Item\Key('KeyD1', [0xA6], $world),
            new Item\Key('KeyD6', [0xA7], $world),
            new Item\Key('KeyD3', [0xA8], $world),
            new Item\Key('KeyD5', [0xA9], $world),
            new Item\Key('KeyP3', [0xAA], $world),
            new Item\Key('KeyD4', [0xAB], $world),
            new Item\Key('KeyD7', [0xAC], $world),
            new Item\Key('KeyA2', [0xAD], $world),
            new Item\Key('KeyGK', [0xAF], $world),
            new Item\Crystal('Crystal1', [null, 0x02, 0x34, 0x64, 0x40, 0x7F, 0x06], $world),
            new Item\Crystal('Crystal2', [null, 0x10, 0x34, 0x64, 0x40, 0x79, 0x06], $world),
            new Item\Crystal('Crystal3', [null, 0x40, 0x34, 0x64, 0x40, 0x6C, 0x06], $world),
            new Item\Crystal('Crystal4', [null, 0x20, 0x34, 0x64, 0x40, 0x6D, 0x06], $world),
            new Item\Crystal('Crystal5', [null, 0x04, 0x32, 0x64, 0x40, 0x6E, 0x06], $world),
            new Item\Crystal('Crystal6', [null, 0x01, 0x32, 0x64, 0x40, 0x6F, 0x06], $world),
            new Item\Crystal('Crystal7', [null, 0x08, 0x34, 0x64, 0x40, 0x7C, 0x06], $world),
            new Item\Event('RescueZelda', [null], $world),
            new Item\Event('DefeatAgahnim', [null], $world),
            new Item\Event('BigRedBomb', [null], $world),
            new Item\Event('DefeatAgahnim2', [null], $world),
            new Item\Event('DefeatGanon', [null], $world),
        ]);

        // Logical aliases
        static::$items[$world->id]->addItem(new ItemAlias('UncleSword', 'ProgressiveSword', $world));
        static::$items[$world->id]->addItem(new ItemAlias('ShopKey', 'KeyGK', $world));
        static::$items[$world->id]->addItem(new ItemAlias('ShopArrow', 'Arrow', $world));

        static::$items[$world->id]->setChecksForWorld($world->id);

        return static::all($world);
    }

    /**
     * Create a new Item
     *
     * @param string       $name  Unique name of item
     * @param array        $bytes data to write to Location addresses
     * @param \ALttP\World $world world for which the item belongs
     *
     * @return void
     */
    public function __construct(string $name, array $bytes, World $world)
    {
        $this->name = $name;
        $this->nice_name = 'item.' . $name;
        $this->bytes = $bytes;
        $this->world = $world;
    }

    /**
     * Get the target of this item, which happens to be this item.
     *
     * @return $this
     */
    public function getTarget()
    {
        return $this;
    }

    /**
     * Get an ItemAlias version of this.
     *
     * DO NOT USE: completely untested.
     *
     * @return ItemAlias
     */
    public function setTarget(Item $item)
    {
        return new ItemAlias($this->getName(), $item->getName(), $this->world);
    }

    /**
     * Get the raw name of this Item
     *
     * @return string
     */
    public function getRawName(): string
    {
        return $this->name;
    }

    /**
     * Get the name of this Item (with world ID)
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name . ':' . $this->world->id;
    }

    /**
     * Get the nice name of this Item
     *
     * @return string
     */
    public function getNiceName(): string
    {
        $formatted = __($this->nice_name);

        return is_string($formatted) ? $formatted : '';
    }

    /**
     * Get the i18n string of this Item
     *
     * @return string
     */
    public function getI18nName(): string
    {
        return $this->nice_name;
    }

    /**
     * Get the bytes to write
     *
     * @return array
     */
    public function getBytes()
    {
        return $this->bytes;
    }

    /**
     * Set the World the item belongs to.
     *
     * @param \ALttP\World $world world it can be used in
     *
     * @return $this
     */
    public function setWorld(World $world)
    {
        $this->world = $world;

        return $this;
    }

    /**
     * Get the world this item is usable in.
     *
     * @return \ALttP\World
     */
    public function getWorld()
    {
        return $this->world;
    }

    /**
     * serialized version of Item
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name . serialize($this->bytes);
    }
}
