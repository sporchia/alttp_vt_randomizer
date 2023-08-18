<?php

namespace ALttP;

use ALttP\Services\PlaythroughService;
use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;
use ALttP\Support\ShopCollection;
use ALttP\Sprite\Droppable;
use ErrorException;

/**
 * This is the container for all the regions and locations one can find items
 * in the game.
 */
abstract class World
{
    /** @var int */
    protected static $max_world = 1;
    /** @var int */
    public $id = 0;
    /** @var \ALttP\Seed */
    protected $seed;
    /** @var array */
    protected $regions = [];
    /** @var \ALttP\Support\LocationCollection */
    protected $locations;
    /** @var \ALttP\Support\ShopCollection */
    protected $shops;
    /** @var callable */
    protected $win_condition;
    /** @var \ALttP\Support\LocationCollection */
    protected $collectable_locations;
    /** @var \ALttP\Support\ItemCollection */
    protected $pre_collected_items;
    /** @var array */
    protected $prizepacks;
    /** @var \ALttP\Region */
    protected $equipped_region;
    /** @var array */
    protected $texts = [];
    /** @var array */
    protected $credits = [];
    /** @var array */
    protected $config = [];
    /** @var array */
    private $collected_locations = [];
    /** @var array|null */
    protected $override_patch = null;
    /** @var array */
    protected $spoiler = [];

    /**
     * Create a new world and initialize all of the Regions within it
     *
     * @param int    $id      Id of this world
     * @param array  $config  config for this world
     *
     * @return void
     */
    public function __construct(int $id = 0, array $config = [])
    {
        $this->id = $id;
        $this->config = array_merge([
            'difficulty' => 'normal',
            'logic' => 'NoGlitches',
            'goal' => 'ganon',
        ], $config);

        $this->pre_collected_items = new ItemCollection;
        $this->equipped_region = new Region($this);
        $this->seed = new Seed;
        $this->locations = new LocationCollection;
        $this->shops = new ShopCollection;

        $this->prizepacks = [
            '0' => new Drops\PrizePack('0', 8),
            '1' => new Drops\PrizePack('1', 8),
            '2' => new Drops\PrizePack('2', 8),
            '3' => new Drops\PrizePack('3', 8),
            '4' => new Drops\PrizePack('4', 8),
            '5' => new Drops\PrizePack('5', 8),
            '6' => new Drops\PrizePack('6', 8),
            'pull' => new Drops\PrizePack('pull', 3),
            'crab' => new Drops\PrizePack('crab', 2),
            'stun' => new Drops\PrizePack('stun', 1),
            'fish' => new Drops\PrizePack('fish', 1),
        ];

        // Initialize the Logic and Prizes for each Region that has them and
        // fill our LocationsCollection
        foreach ($this->regions as $region) {
            if ($this->config('logic') !== 'NoLogic') {
                $region->initalize();
            }
            $this->locations = $this->locations->merge($region->getLocations());
            $this->shops = $this->shops->merge($region->getShops());
        }
        $this->locations->setChecksForWorld($this->id);

        $this->win_condition = function ($collected_items) {
            $collected_items->setChecksForWorld($this->id);
            return $collected_items->has('Triforce')
                || ($this->regions['North East Light World']->canEnter($this->locations, $collected_items) &&
                    ($this->config('goal', 'ganon') == 'triforce-hunt' && $collected_items->has('TriforcePiece', $this->config('item.Goal.Required'))));
        };

        // Handle configuration options that map to switches.
        $free_item_text = $this->config('rom.freeItemText', 0x00);
        $free_item_menu = $this->config('rom.freeItemMenu', 0x00);
        switch ($this->config('dungeonItems')) {
            case 'full':
                $this->config['region.wildBigKeys'] = true;
                $free_item_text |= 0x18;
                $free_item_menu |= 0x02;
                // no break
            case 'mcs':
                $this->config['region.wildKeys'] = true;
                $free_item_text |= 0x11;
                $free_item_menu |= 0x01;
                // no break
            case 'mc':
                $this->config['region.wildMaps'] = true;
                $this->config['rom.mapOnPickup'] = true;
                $this->config['region.wildCompasses'] = true;
                $this->config['rom.dungeonCount'] = 'pickup';
                $free_item_text |= 0x16;
                $free_item_menu |= 0x0C;
        }

        $glitched_logic = (in_array($this->config('logic', 'NoGlitches'), ['HybridMajorGlitches', 'MajorGlitches', 'NoLogic'])
            || $this->config('canOneFrameClipUW', false));

        if ($glitched_logic) {
            $free_item_menu |= 0x10;
        }

        $this->config['rom.freeItemText'] = $free_item_text;
        $this->config['rom.freeItemMenu'] = $free_item_menu;

        $wild_keys = $this->config('region.wildKeys', false);
        $wild_big_keys = $this->config('region.wildBigKeys', false);
        $wild_compasses = $this->config('region.wildCompasses', false);
        $wild_maps = $this->config('region.wildMaps', false);

        $this->config['rom.vanillaKeys'] = $this->config('rom.vanillaKeys', (!$wild_keys && $glitched_logic));
        $this->config['rom.vanillaBigKeys'] = $this->config('rom.vanillaBigKeys', (!$wild_big_keys && $glitched_logic));
        $this->config['rom.vanillaCompasses'] = $this->config('rom.vanillaCompasses', (!$wild_compasses && $glitched_logic));
        $this->config['rom.vanillaMaps'] = $this->config('rom.vanillaMaps', (!$wild_maps && $glitched_logic));

        # handle empty config values that might be sent from customizer
        if ($this->config('item.overflow.count.Sword', null) === '') {
            unset($this->config['item.overflow.count.Sword']);
        }
        if ($this->config('item.overflow.count.Armor', null) === '') {
            unset($this->config['item.overflow.count.Armor']);
        }
        if ($this->config('item.overflow.count.Shield', null) === '') {
            unset($this->config['item.overflow.count.Shield']);
        }
        if ($this->config('item.overflow.count.Bow', null) === '') {
            unset($this->config['item.overflow.count.Bow']);
        }
        if ($this->config('item.overflow.count.BossHeartContainer', null) === '') {
            unset($this->config['item.overflow.count.BossHeartContainer']);
        }
        if ($this->config('item.overflow.count.PieceOfHeart', null) === '') {
            unset($this->config['item.overflow.count.PieceOfHeart']);
        }

        switch ($this->config('item.pool')) {
            case 'superexpert':
                $this->config['item.overflow.count.Sword'] = 2;
                $this->config['item.overflow.count.Armor'] = 0;
                $this->config['item.overflow.count.Shield'] = 0;
                $this->config['item.overflow.count.Bow'] = 1;
                $this->config['item.overflow.count.BossHeartContainer'] = 0;
                $this->config['item.overflow.count.PieceOfHeart'] = 0;
                $this->config['shops.HardMode'] = true;

                break;
            case 'expert':
                $this->config['item.overflow.count.Sword'] = 2;
                $this->config['item.overflow.count.Armor'] = 0;
                $this->config['item.overflow.count.Shield'] = 1;
                $this->config['item.overflow.count.Bow'] = 1;
                $this->config['item.overflow.count.BossHeartContainer'] = 2;
                $this->config['item.overflow.count.PieceOfHeart'] = 8;
                $this->config['shops.HardMode'] = true;

                break;
            case 'hard':
                $this->config['item.overflow.count.Sword'] = 3;
                $this->config['item.overflow.count.Armor'] = 0;
                $this->config['item.overflow.count.Shield'] = 2;
                $this->config['item.overflow.count.Bow'] = 1;
                $this->config['item.overflow.count.BossHeartContainer'] = 6;
                $this->config['item.overflow.count.PieceOfHeart'] = 16;
                $this->config['shops.HardMode'] = true;

                break;
            case 'crowd_control':
                $this->config['item.overflow.count.Sword'] = 4;
                $this->config['item.overflow.count.Armor'] = 1;
                $this->config['item.overflow.count.Shield'] = 0;
                $this->config['item.overflow.count.Bow'] = 1;
                $this->config['item.overflow.count.BossHeartContainer'] = 1;
                $this->config['item.overflow.count.PieceOfHeart'] = 20;
                $this->config['item.count.BugCatchingNet'] = 0;
                $this->config['item.count.HalfMagic'] = 0;
                $this->config['item.count.CaneOfByrna'] = 0;
                $this->config['item.count.Cape'] = 0;
                $this->config['item.count.TwentyRupees2'] = 4;
        }

        switch ($this->config('item.functionality')) {
            case 'superexpert':
                $this->config['rom.CapeMagicUsage.Normal'] = 0x01;
                $this->config['rom.CapeMagicUsage.Half'] = 0x02;
                $this->config['rom.CapeMagicUsage.Quarter'] = 0x02;
                $this->config['rom.CaneOfByrnaInvulnerability'] = false;
                $this->config['rom.PowderedSpriteFairyPrize'] = 0x79; // bees
                $this->config['rom.BottleFill.Health'] = 0x00; // nothing
                $this->config['rom.BottleFill.Magic'] = 0x00; // nothing
                $this->config['rom.CatchableFairies'] = false;
                $this->config['rom.CatchableBees'] = true;
                $this->config['rom.StunItems'] = 0x00;
                $this->config['rom.SilversOnlyAtGanon'] = true;
                $this->config['rom.NoFarieDrops'] = true;
                break;
            case 'expert':
                $this->config['rom.CapeMagicUsage.Normal'] = 0x02;
                $this->config['rom.CapeMagicUsage.Half'] = 0x04;
                $this->config['rom.CapeMagicUsage.Quarter'] = 0x08;
                $this->config['rom.CaneOfByrnaInvulnerability'] = false;
                $this->config['rom.PowderedSpriteFairyPrize'] = 0xD8; // 1 heart
                $this->config['rom.BottleFill.Health'] = 0x20; // 4 hearts
                $this->config['rom.BottleFill.Magic'] = 0x20; // 1/4 magic refills
                $this->config['rom.CatchableFairies'] = false;
                $this->config['rom.CatchableBees'] = true;
                $this->config['rom.StunItems'] = 0x00;
                $this->config['rom.SilversOnlyAtGanon'] = true;
                $this->config['rom.NoFarieDrops'] = true;
                break;
            case 'hard':
                $this->config['rom.CapeMagicUsage.Normal'] = 0x02;
                $this->config['rom.CapeMagicUsage.Half'] = 0x04;
                $this->config['rom.CapeMagicUsage.Quarter'] = 0x08;
                $this->config['rom.CaneOfByrnaInvulnerability'] = false;
                $this->config['rom.PowderedSpriteFairyPrize'] = 0xD8; // 1 heart
                $this->config['rom.BottleFill.Health'] = 0x38; // 7 hearts
                $this->config['rom.BottleFill.Magic'] = 0x40; // 1/2 magic refills
                $this->config['rom.CatchableFairies'] = false;
                $this->config['rom.CatchableBees'] = true;
                $this->config['rom.StunItems'] = 0x02;
                $this->config['rom.SilversOnlyAtGanon'] = true;
                $this->config['rom.NoFarieDrops'] = true;
                break;
        }

        $this->config['region.requireBetterBow'] = false;
        $this->config['region.requireBetterSword'] = false;

        if ($this->config('itemPlacement') === 'basic') {
            $this->config['region.requireBetterBow'] = true;
            $this->config['region.requireBetterSword'] = true;
        }

        // In swordless mode silvers are 100% required
        if ($this->config('mode.weapons') === 'swordless') {
            $this->config['region.requireBetterBow'] = true;
            $this->config['item.overflow.count.Bow'] = 2;
        }

        if ($this->config('itemPlacement') === 'basic') {
            $this->config['region.forceSkullWoodsKey'] = true;
        }
    }

    /**
     * Create a new World class with the given requirements.
     *
     * @param string  $type    type of world to create
     * @param array   $config  config options for this world
     *
     * @return \ALttP\World
     */
    public static function factory(string $type = 'standard', array $config = []): World
    {
        $config = array_merge($config, [
            'mode.state' => $type,
        ]);

        switch ($type) {
            case 'open':
                return new World\Open(static::$max_world++, $config);
            case 'inverted':
                return new World\Inverted(static::$max_world++, $config);
            case 'retro':
                return new World\Retro(static::$max_world++, $config);
            case 'standard':
            default:
                return new World\Standard(static::$max_world++, $config);
        }
    }

    /**
     * Get the collection for pre-collected items.
     *
     * @return \ALttP\Support\ItemCollection
     */
    public function getPreCollectedItems(): ItemCollection
    {
        return $this->pre_collected_items;
    }

    /**
     * Set the collection for pre-collected items.
     *
     * @param \ALttP\Support\ItemCollection $items collection of items that have been pre-collected
     *
     * @return $this
     */
    public function setPreCollectedItems(ItemCollection $items): self
    {
        $this->pre_collected_items = $items;
        $this->pre_collected_items->setChecksForWorld($this->id);

        return $this;
    }

    /**
     * Add a pre-collected Item
     *
     * @param \ALttP\Item $item item to add
     *
     * @return $this
     */
    public function addPreCollectedItem(Item $item): self
    {
        $this->pre_collected_items->addItem($item);

        return $this;
    }

    /**
     * Get a copy of this world with items in locations.
     *
     * @return static
     */
    public function copy()
    {
        $copy = new static($this->id, $this->config);
        $copy->locations->setChecksForWorld($this->id);

        foreach ($this->locations as $name => $location) {
            $copy->locations[$name]->setItem($location->getItem());
        }
        foreach ($this->shops as $name => $shop) {
            $copy->shops[$name] = $shop->copy();
        }
        $boss_locations = [
            ['Eastern Palace', ''],
            ['Desert Palace', ''],
            ['Tower of Hera', ''],
            ['Palace of Darkness', ''],
            ['Swamp Palace', ''],
            ['Skull Woods', ''],
            ['Thieves Town', ''],
            ['Ice Palace', ''],
            ['Misery Mire', ''],
            ['Turtle Rock', ''],
            ['Ganons Tower', 'bottom'],
            ['Ganons Tower', 'middle'],
            ['Ganons Tower', 'top'],
        ];
        foreach ($boss_locations as $location) {
            $copy->getRegion($location[0])->setBoss($this->getRegion($location[0])->getBoss($location[1]), $location[1]);
        }

        $copy->setPreCollectedItems($this->pre_collected_items->copy());

        return $copy;
    }


    /**
     * Determine the junk fill range of Ganon's Tower for this world. This
     * accounts for the number of crystals needed to enter.
     *
     * @return array
     */
    public function getGanonsTowerJunkFillRange(): array
    {
        if (
            $this->config['logic'] === 'NoLogic'
            || ($this->config['mode.state'] !== 'inverted'
                && in_array($this->config['logic'], ['OverworldGlitches', 'HybridMajorGlitches', 'MajorGlitches']))
        ) {
            return [0, 0];
        }

        if ($this->config['goal'] == 'triforce-hunt' || $this->config['goal'] == 'pedestal') {
            return [
                floor(15 * $this->config('crystals.tower') / 7),
                floor(25 * $this->config('crystals.tower') / 7),
            ];
        }

        return [0, floor(15 * $this->config('crystals.tower') / 7)];
    }

    /**
     * Get the function that determines the win condition for this world.
     *
     * @return callable
     */
    public function getWinCondition()
    {
        return $this->win_condition;
    }

    /**
     * Determine if this World is beatable
     *
     * @param \ALttP\Support\ItemCollection $collected precollected items for consideration
     *
     * @return bool
     */
    public function checkWinCondition(ItemCollection $collected = null)
    {
        return $this->getWinCondition()($this->collectItems($collected));
    }

    /**
     * Get config value based on the currently set rules
     *
     * @todo we need to stop relying on the Laravel global config and have per world configs
     *
     * @param string $key dot notation key of config
     * @param mixed|null $default value to return if $key is not found
     *
     * @return mixed
     */
    public function config(string $key, $default = null)
    {
        if (!array_key_exists($key, $this->config)) {
            $this->config[$key] = config(
                "alttp.goals.{$this->config['goal']}.$key",
                config(
                    "alttp.$key",
                    config(
                        "logic.{$this->config['logic']}.$key",
                        config($key, null)
                    )
                )
            );
        }

        return $this->config[$key] ?? $default;
    }

    /**
     * Get a region by Key name
     *
     * @param string $name Name of region to return
     *
     * @throws ErrorException
     *
     * @return Region
     */
    public function getRegion(string $name)
    {
        return $this->regions[$name];
    }

    /**
     * Get all the Regions in this world
     *
     * @return array
     */
    public function getRegions(): array
    {
        return $this->regions;
    }

    /**
     * Get all the Locations in all Regions in this world
     *
     * @return \ALttP\Support\LocationCollection
     */
    public function getLocations(): LocationCollection
    {
        return $this->locations;
    }

    /**
     * Get all the prizes for the prize packs in this world
     *
     * @return array
     */
    public function getPrizePacks(): array
    {
        return $this->prizepacks;
    }

    /**
     * Get Locations considered collectable. I.E. can contain items that Link can have.
     * This is cached for faster retrevial
     *
     * @return ALttP\Support\LocationCollection
     */
    public function getCollectableLocations(): LocationCollection
    {
        if ($this->collectable_locations === null) {
            $this->collectable_locations = $this->locations->filter(function ($location) {
                return !$location instanceof Location\Medallion
                    && !$location instanceof Location\Fountain
                    && !($this->collected_locations[$location->getName()] ?? false);
            })->merge($this->shops->getLocations());
        }

        return $this->collectable_locations;
    }

    /**
     * Get total item locations. This includes everything with the "item get" animmation
     * except for dungeon prizes and shop items.
     *
     * @return int
     */
    public function getTotalItemCount(): int
    {
        return count($this->getCollectableLocations()) - 45;
    }

    /**
     * Collect the items in the world, you may pass in a set of pre-collected items.
     * This also checks for shop items.
     *
     * @todo this is collecting multiple events? like 2x Triforices.
     *
     * @param \ALttP\Support\ItemCollection|null  $collected  precollected items for consideration in out collecting
     *
     * @return \ALttP\Support\ItemCollection
     */
    public function collectItems(?ItemCollection $collected = null): ItemCollection
    {
        $my_items = $collected ?? new ItemCollection;
        $my_items = $my_items->merge($this->pre_collected_items);
        $my_items->setChecksForWorld($this->id);
        $available_locations = $this->getCollectableLocations()->filter(function ($location) {
            return $location->hasItem();
        });

        do {
            $search_locations = $available_locations->filter(function ($location) use ($my_items) {
                return !($this->collected_locations[$location->getName()] ?? false) && $location->canAccess($my_items);
            });

            foreach ($search_locations as $location) {
                $this->collected_locations[$location->getName()] = true;
            }

            $available_locations = $available_locations->diff($search_locations);

            $found_items = $search_locations->getItems();
            $my_items = $my_items->merge($found_items);
        } while ($found_items->count() > 0);

        return $my_items;
    }

    /**
     * Collect the items in the world, you may pass in a set of pre-collected items.
     * This also checks for shop items.
     *
     * @param \ALttP\Support\ItemCollection $collected precollected items for consideration in out collecting
     *
     * @return \ALttP\Support\ItemCollection
     */
    public function collectOtherItems(ItemCollection $collected): ItemCollection
    {
        $my_items = $collected ?? new ItemCollection($this->pre_collected_items);
        $my_items->setChecksForWorld($this->id);
        $found = new ItemCollection();
        $available_locations = $this->getCollectableLocations();

        do {
            $search_locations = $available_locations->filter(function ($location) use ($my_items) {
                return $location->hasItem()
                    && !($this->collected_locations[$location->getName()] ?? false) && $location->canAccess($my_items);
            });

            foreach ($search_locations as $location) {
                $this->collected_locations[$location->getName()] = true;
            }

            $available_locations = $available_locations->diff($search_locations);

            $found_items = $search_locations->getItems();
            $my_items = $my_items->merge($found_items);
            $found = $found->merge($found_items);
        } while ($found_items->count() > 0);

        return $found;
    }

    /**
     * Get the count of currently touched locations in search.
     *
     * @todo thinking we should move this out to a collect items service for SOC
     *
     * @return int
     */
    public function getCollectedLocationsCount(): int
    {
        return count($this->collected_locations);
    }

    public function getCollectedLocations()
    {
        return $this->collected_locations;
    }

    /**
     * Reset the locations considered collected.
     *
     * @return void
     */
    public function resetCollectedLocations(): void
    {
        $this->collected_locations = [];
    }

    /**
     * Determine the spheres that locations are in based on the items in the
     * world.
     *
     * @todo consider a re-factor to match the collectItems method of reducing
     * the available_locations instead of using found_locations.
     *
     * @return array
     */
    public function getLocationSpheres(): array
    {
        $sphere = 0;
        $location_sphere = [0 => new LocationCollection()];
        $my_items = $this->pre_collected_items;
        $i = 0;
        foreach ($my_items as $item) {
            $location = new Location(sprintf("Equipment Slot %s", ++$i), [], null, $this->equipped_region);
            $location->setItem($item);
            $location_sphere[0]->addItem($location);
        }
        $found_locations = new LocationCollection();
        do {
            $sphere++;
            $available_locations = $this->getCollectableLocations()->filter(function ($location) use ($my_items, $found_locations) {
                return $location->hasItem()
                    && !$found_locations->contains($location)
                    && $location->canAccess($my_items);
            });
            $location_sphere[$sphere] = $available_locations;

            $found_items = $available_locations->getItems();
            $found_locations = $found_locations->merge($available_locations);

            $my_items = $my_items->merge($found_items);
        } while ($found_items->count() > 0);

        return $location_sphere;
    }

    /**
     * Get Location in this world by name
     *
     * @param string $name name of the Location
     *
     * @return \ALttP\Location
     */
    public function getLocation(string $name): Location
    {
        return $this->locations[$name];
    }

    /**
     * Get all the Locations in this Region that do not have an Item assigned
     *
     * @return \ALttP\Support\LocationCollection
     */
    public function getEmptyLocations(): LocationCollection
    {
        return $this->locations->filter(function ($location) {
            return !$location->hasItem();
        });
    }

    /**
     * Get all the Locations that contain the requested Item
     *
     * @param \ALttP\Item|null $item item we are looking for
     *
     * @return \ALttP\Support\LocationCollection
     */
    public function getLocationsWithItem(?Item $item = null): LocationCollection
    {
        return $this->locations->locationsWithItem($item);
    }

    /**
     * Get all the Regions that contain the requested Item
     *
     * @param \ALttP\Item|null $item item we are looking for
     *
     * @return array
     */
    public function getRegionsWithItem(?Item $item = null): array
    {
        return $this->getLocationsWithItem($item)->getRegions();
    }

    /**
     * Set a drop in a PrizePackSlot in a given PrizePack.
     *
     * @param string                   $pack  the prize pack to set the drop in
     * @param int                      $ind   the index of the drop to set
     * @param \ALttP\Sprite\Droppable  $drop  the name of the drop to set
     *
     * @return void
     */
    public function setDrop(string $pack, int $ind, Droppable $drop): void
    {
        $this->prizepacks[$pack]->getDrops()[$ind]->setDrop($drop);
    }

    /**
     * Get all the drops in the prize packs as an array.
     *
     * @return array
     */
    public function getAllDrops(): array
    {
        $drops = [];
        foreach ($this->prizepacks as $pack) {
            $drops = array_merge($drops, $pack->getDrops());
        }
        return $drops;
    }

    /**
     * Get all the drops that are empty in the prize packs as an array.
     *
     * @return array
     */
    public function getEmptyDropSlots(): array
    {
        $emptyDrops = [];
        foreach ($this->prizepacks as $pack) {
            $emptyDrops = array_merge($emptyDrops, $pack->getEmptyDrops());
        }
        return $emptyDrops;
    }

    /**
     * Get all the Shops in all Regions in this world.
     *
     * @return \ALttP\Support\ShopCollection
     */
    public function getShops(): ShopCollection
    {
        return $this->shops;
    }

    /**
     * Get Shop in this world by name
     *
     * @param string $name name of the Shop
     *
     * @return \ALttP\Shop
     */
    public function getShop(string $name): Shop
    {
        return $this->shops[$name];
    }

    /**
     * Get an array of Item's necessary for giving access to more locations as
     * well as completing the game.
     *
     * @return array
     */
    public function getAdvancementItems(): array
    {
        $items = [];

        foreach ($this->config('item.advancement') as $item_name => $count) {
            $loop = min($this->config('item.count.' . $item_name, $count), 216);
            for ($i = 0; $i < $loop; ++$i) {
                $items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name, $this);
            }
        }

        return $items;
    }

    /**
     * Get all the Items to insert into the Locations Available.
     *
     * @return array
     */
    public function getNiceItems(): array
    {
        $items = [];

        foreach ($this->config('item.nice') as $item_name => $count) {
            $loop = min($this->config('item.count.' . $item_name, $count), 216);
            for ($i = 0; $i < $loop; ++$i) {
                $items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name, $this);
            }
        }

        return $items;
    }

    /**
     * Get all the Items to insert into the Locations Available.
     *
     * @return array
     */
    public function getItemPool(): array
    {
        $items = [];

        foreach ($this->config('item.junk') as $item_name => $count) {
            $loop = min($this->config('item.count.' . $item_name, $count), 216);
            for ($i = 0; $i < $loop; ++$i) {
                $items[] = $item_name == 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name, $this);
            }
        }

        return $items;
    }

    /**
     * Get all the Items to insert into the Locations Available.
     *
     * @return array
     */
    public function getDungeonPool(): array
    {
        $items = [];

        foreach ($this->config('item.dungeon') as $item_name => $count) {
            $loop = min($this->config('item.count.' . $item_name, $count), 216);
            for ($i = 0; $i < $loop; ++$i) {
                $items[] = $item_name === 'BottleWithRandom' ? $this->getBottle() : Item::get($item_name, $this);
            }
        }

        return $items;
    }

    /**
     * Get all the drops to insert into the PrizePackSlots Available, should be
     * randomly shuffled.
     *
     * @return array
     */
    public function getDropsPool(): array
    {
        $drops = [];

        foreach ($this->config('item.drop') as $sprite_name => $count) {
            $loop = min($this->config('drop.count.' . $sprite_name, $count), 63);
            for ($i = 0; $i < $loop; ++$i) {
                $drops[] = Sprite::get($sprite_name);
            }
        }

        return fy_shuffle($drops);
    }

    /**
     * Get a random bottle item.
     *
     * @param bool  $filled  return only a filled bottle
     *
     * @return \ALttP\Item
     */
    public function getBottle(bool $filled = false): Item
    {
        $bottles = [
            Item::get('Bottle', $this),
            Item::get('BottleWithRedPotion', $this),
            Item::get('BottleWithGreenPotion', $this),
            Item::get('BottleWithBluePotion', $this),
            Item::get('BottleWithBee', $this),
            Item::get('BottleWithGoldBee', $this),
            Item::get('BottleWithFairy', $this),
        ];

        return $bottles[get_random_int($filled ? 1 : 0, count($bottles) - (($this->config('rom.CatchableFairies', true)) ? 1 : 2))];
    }

    /**
     * Set a specific spoiler for this world.
     *
     * @param array  $spoiler  spoiler to use
     *
     * @return void
     */
    public function setSpoiler(array $spoiler): void
    {
        $this->spoiler = $spoiler;
    }

    /**
     * Get the current spoiler for this seed.
     *
     * @param array  $meta  passthrough data to add to meta
     *
     * @return array
     */
    public function getSpoiler(array $meta = []): array
    {
        if ($this->config('entrances') === 'none') {
            if (count($this->pre_collected_items)) {
                $i = 0;
                foreach ($this->pre_collected_items as $item) {
                    if (
                        $item instanceof Item\Upgrade\Arrow
                        || $item instanceof Item\Upgrade\Bomb
                        || $item instanceof Item\Event
                    ) {
                        continue;
                    }

                    $location = sprintf("Equipment Slot %s", ++$i);
                    $this->spoiler['Equipped'][$location] = $item->getTarget()->getName();
                }
            }

            foreach ($this->getRegions() as $region) {
                $name = $region->getName();
                if (!isset($this->spoiler[$name])) {
                    $this->spoiler[$name] = [];
                }
                $region->getLocations()->each(function ($location) use ($name) {
                    if (
                        $location instanceof Location\Prize\Event
                        || $location instanceof Location\Trade
                    ) {
                        return;
                    }
                    if ($location->hasItem()) {
                        $item = $location->getItem();
                        $this->spoiler[$name][$location->getName()] = $this->config('rom.genericKeys', false) && $item instanceof Item\Key
                            ? 'Key'
                            : $item->getTarget()->getName();
                    } else {
                        $this->spoiler[$name][$location->getName()] = 'Nothing';
                    }
                });
            }
            foreach ($this->getShops() as $shop) {
                if ($shop->getActive()) {
                    $shop_data = [
                        'location' => $shop->getName(),
                        'type' => $shop instanceof Shop\TakeAny ? 'Take Any' : 'Shop',
                    ];
                    foreach ($shop->getInventory() as $slot => $item) {
                        $shop_data["item_$slot"] = [
                            'item' => $item['item']->getName(),
                            'price' => $item['price'],
                        ];
                    }
                    $this->spoiler['Shops'][] = $shop_data;
                }
            }
            $this->spoiler['playthrough'] = (new PlaythroughService)->getPlayThrough($this);
        }

        $this->spoiler['meta'] = array_merge($this->spoiler['meta'] ?? [], $meta, [
            'item_placement' => $this->config('itemPlacement'),
            'item_pool' => $this->config('item.pool'),
            'item_functionality' => $this->config('item.functionality'),
            'dungeon_items' => $this->config('dungeonItems'),
            'logic' => $this->config('logic'),
            'accessibility' => $this->config('accessibility'),
            'rom_mode' => $this->config('rom.logicMode', $this->config('logic')),
            'goal' => $this->config('goal'),
            'build' => Rom::BUILD,
            'mode' => $this->config('mode.state'),
            'weapons' => $this->config('mode.weapons'),
            'world_id' => $this->id,
            'crystals_ganon' => $this->config('crystals.ganon'),
            'crystals_tower' => $this->config('crystals.tower'),
            'tournament' => $this->config('tournament', false),
            'size' => 2,
            'hints' => $this->config('spoil.Hints'),
            'spoilers' => $this->config('spoilers', 'off'),
            'allow_quickswap' => $this->config('allow_quickswap', true),
            'pseudoboots' => $this->config('pseudoboots', false),
            'enemizer.boss_shuffle' => $this->config('enemizer.bossShuffle'),
            'enemizer.enemy_shuffle' => $this->config('enemizer.enemyShuffle'),
            'enemizer.enemy_damage' => $this->config('enemizer.enemyDamage'),
            'enemizer.enemy_health' => $this->config('enemizer.enemyHealth'),
            'enemizer.pot_shuffle' => $this->config('enemizer.potShuffle'),
        ]);

        $this->spoiler['Bosses'] = [
            "Eastern Palace" => $this->getRegion('Eastern Palace')->getBoss('')->getName(),
            "Desert Palace" => $this->getRegion('Desert Palace')->getBoss('')->getName(),
            "Tower Of Hera" => $this->getRegion('Tower of Hera')->getBoss('')->getName(),
            "Hyrule Castle" => "Agahnim",
            "Palace Of Darkness" => $this->getRegion('Palace of Darkness')->getBoss('')->getName(),
            "Swamp Palace" => $this->getRegion('Swamp Palace')->getBoss('')->getName(),
            "Skull Woods" => $this->getRegion('Skull Woods')->getBoss('')->getName(),
            "Thieves Town" => $this->getRegion('Thieves Town')->getBoss('')->getName(),
            "Ice Palace" => $this->getRegion('Ice Palace')->getBoss('')->getName(),
            "Misery Mire" => $this->getRegion('Misery Mire')->getBoss('')->getName(),
            "Turtle Rock" => $this->getRegion('Turtle Rock')->getBoss('')->getName(),
            "Ganons Tower Basement" => $this->getRegion('Ganons Tower')->getBoss('bottom')->getName(),
            "Ganons Tower Middle" => $this->getRegion('Ganons Tower')->getBoss('middle')->getName(),
            "Ganons Tower Top" => $this->getRegion('Ganons Tower')->getBoss('top')->getName(),
            "Ganons Tower" => "Agahnim 2",
            "Ganon" => "Ganon"
        ];

        $this->seed->spoiler = json_encode($this->spoiler);

        return $this->spoiler;
    }

    /**
     * Set an override patch to write to the ROM, in case randomization was done
     * in an alternate fashion.
     *
     * @param array  $patch  patch data to overwrite with
     *
     * @return void
     */
    public function setOverridePatch(array $patch): void
    {
        $this->override_patch = $patch;
    }

    /**
     * write the current generated data to the ROM. If an override patch is set
     * it will use that instead.
     *
     * @param \ALttP\Rom   $rom   ROM to write data to
     * @param bool         $save  save seed record
     *
     * @return \ALttP\Rom
     */
    public function writeToRom(Rom $rom, bool $save = false): Rom
    {
        if ($this->override_patch !== null) {
            foreach ($this->override_patch as $writes) {
                foreach ($writes as $address => $bytes) {
                    $rom->write($address, pack('C*', ...$bytes));
                }
            }

            // misc patches for inverted ER until we can update ER
            if ($this->config('mode.state') === 'inverted') {
                // remove diggable light world portals
                $rom->write(snes_to_pc(0x1BC428), pack('C*', 0x00));
                $rom->write(snes_to_pc(0x1BC43A), pack('C*', 0x00));
                $rom->write(snes_to_pc(0x1BC590), pack('C*', 0x00));
                $rom->write(snes_to_pc(0x1BC5A1), pack('C*', 0x00));
                $rom->write(snes_to_pc(0x1BC5B1), pack('C*', 0x00));
                $rom->write(snes_to_pc(0x1BC5C7), pack('C*', 0x00));
            }

            $rom->setPseudoBoots($this->config('pseudoboots', false));

            if ($save) {
                $hash = $this->saveSeedRecord();

                $rom->setSeedString(str_pad(sprintf("VT %s", $hash), 21, ' '));

                $rom->setStartScreenHash($this->config('override_start_screen', false) ?: $this->seed->hashArray());

                $this->seed->patch = json_encode($rom->getWriteLog());
                $this->seed->save();
            }

            return $rom;
        }

        foreach ($this->texts as $key => $value) {
            $rom->setText($key, $value);
        }
        foreach ($this->credits as $key => $value) {
            $rom->setCredit($key, $value);
        }

        if (!$this->config('multiworld', false)) {
            foreach ($this->getRegions() as $region) {
                $region->getLocations()->getNonEmptyLocations()->each(function ($location) use ($rom) {
                    $location->writeItem($rom);
                });
                // Clear out remaining locations if the pool was smaller than number of locations
                $region->getLocations()->getEmptyLocations()->each(function ($location) use ($rom) {
                    $location->setItem(Item::get('Nothing', $this));
                    $location->writeItem($rom);
                });
            }
        }

        if ($this->config('mode.state') === 'standard') {
            $this->setEscapeFills($rom);
        }

        $rom->setGoalRequiredCount($this->config('item.Goal.Required', 0) ?: 0);
        $rom->setGoalIcon($this->config('item.Goal.Icon', 'triforce'));

        // Set item functionality settings
        $rom->setCaneOfByrnaSpikeCaveUsage();
        $rom->setCapeSpikeCaveUsage();
        $rom->setByrnaCaveSpikeDamage(0x08);
        // Bryna magic amount used per "cycle"
        $rom->write(0x45C42, pack('C*', 0x04, 0x02, 0x01));

        $rom->setCapeRegularMagicUsage(
            $this->config('rom.CapeMagicUsage.Normal', 0x04),
            $this->config('rom.CapeMagicUsage.Half', 0x08),
            $this->config('rom.CapeMagicUsage.Quarter', 0x10),
        );
        $rom->setCaneOfByrnaInvulnerability($this->config('rom.CaneOfByrnaInvulnerability', true));
        $rom->setPowderedSpriteFairyPrize($this->config('rom.PowderedSpriteFairyPrize', 0xE3));
        $rom->setBottleFills([$this->config('rom.BottleFill.Health', 0xA0), $this->config('rom.BottleFill.Magic', 0x80)]);
        $rom->setCatchableFairies($this->config('rom.CatchableFairies', true));
        $rom->setCatchableBees($this->config('rom.CatchableBees', true));
        $rom->setStunItems($this->config('rom.StunItems', 0x03));
        $rom->setSilversOnlyAtGanon($this->config('rom.SilversOnlyAtGanon', false));

        $rom->setRupoorValue($this->config('item.value.Rupoor', 0) ?: 0);

        $rom->setGanonAgahnimRng($this->config('rom.GanonAgRNG', 'table'));

        $rom->setTowerCrystalRequirement($this->config('crystals.tower', 7));
        $rom->setGanonCrystalRequirement($this->config('crystals.ganon', 7));

        // testing features
        $rom->setGenericKeys($this->config('rom.genericKeys', false));
        $rom->setupCustomShops($this->getShops());
        $rom->setRupeeArrow($this->config('rom.rupeeBow', false));
        $rom->setWishingWellChests(true);
        $rom->setWishingWellUpgrade(false);
        $rom->setHyliaFairyShop(true);
        $rom->setRestrictFairyPonds(true);
        $rom->setLimitProgressiveSword(
            $this->config('item.overflow.count.Sword', 4),
            Item::get($this->config('item.overflow.replacement.Sword', 'TwentyRupees2'), $this)->getBytes()[0]
        );
        $rom->setLimitProgressiveShield(
            $this->config('item.overflow.count.Shield', 3),
            Item::get($this->config('item.overflow.replacement.Shield', 'TwentyRupees2'), $this)->getBytes()[0]
        );
        $rom->setLimitProgressiveArmor(
            $this->config('item.overflow.count.Armor', 2),
            Item::get($this->config('item.overflow.replacement.Armor', 'TwentyRupees2'), $this)->getBytes()[0]
        );
        $rom->setLimitBottle(
            $this->config('item.overflow.count.Bottle', 4),
            Item::get($this->config('item.overflow.replacement.Bottle', 'TwentyRupees2'), $this)->getBytes()[0]
        );
        $rom->setLimitProgressiveBow(
            $this->config('item.overflow.count.Bow', 2),
            Item::get($this->config('item.overflow.replacement.Bow', 'TwentyRupees2'), $this)->getBytes()[0]
        );

        $rom->setSilversEquip('collection');
        $rom->setSubstitutions([
            0x12, 0x01, 0x35, 0xFF, // lamp -> 5 rupees
            0x51, 0x06, 0x52, 0xFF, // 6 +5 bomb upgrades -> +10 bomb upgrade
            0x53, 0x06, 0x54, 0xFF, // 6 +5 arrow upgrades -> +10 arrow upgrade
            0x58, 0x01, $this->config('rom.rupeeBow', false) ? 0x36 : 0x43, 0xFF, // silver arrows -> 1 arrow
            0x3E, $this->config('item.overflow.count.BossHeartContainer', 10), Item::get($this->config('item.overflow.replacement.BossHeartContainer', 'TwentyRupees2'), $this)->getBytes()[0], 0xFF, // boss heart -> 20 rupees
            0x17, $this->config('item.overflow.count.PieceOfHeart', 24), Item::get($this->config('item.overflow.replacement.PieceOfHeart', 'TwentyRupees2'), $this)->getBytes()[0], 0xFF, // piece of heart -> 20 rupees
        ]);

        switch ($this->config['goal']) {
            case 'triforce-hunt':
                $rom->enableTriforceTurnIn(true);

                // no break
            case 'pedestal':
                $rom->setGanonInvincible('yes');
                break;
            case 'dungeons':
                $rom->setGanonInvincible('dungeons');
                break;
            case 'ganonhunt':
                $rom->initial_sram->preOpenPyramid();
                $rom->setGanonInvincible('triforce_pieces');
                break;
            case 'fast_ganon':
                $rom->initial_sram->preOpenPyramid();
                $rom->setGanonInvincible('crystals_only');
            case 'completionist':
                $rom->setGanonInvincible('completionist');
                break;

            default:
                $rom->setGanonInvincible('crystals_only');
        }

        if ($this->config('rom.mapOnPickup', false)) {
            $green_pendant_region = $this->getLocationsWithItem(Item::get('PendantOfCourage', $this))->first()->getRegion();

            $rom->setMapRevealSahasrahla($green_pendant_region->getMapReveal());

            $crystal5_region = $this->getLocationsWithItem(Item::get('Crystal5', $this))->first()->getRegion();
            $crystal6_region = $this->getLocationsWithItem(Item::get('Crystal6', $this))->first()->getRegion();

            $rom->setMapRevealBombShop($crystal5_region->getMapReveal() | $crystal6_region->getMapReveal());
        }

        $rom->setMapMode($this->config('rom.mapOnPickup', false));
        $rom->setCompassMode($this->config('rom.dungeonCount', 'off'));
        $rom->setCompassCountTotals();
        $rom->setFreeItemTextMode($this->config('rom.freeItemText', 0x00));
        $rom->setFreeItemMenu($this->config('rom.freeItemMenu', 0x00));
        $rom->setDiggingGameRng(get_random_int(1, 30));

        $rom->writeRNGBlock(function () {
            return get_random_int(0, 0x100);
        });

        $this->writePrizePacksToRom($rom);

        $rom->setPyramidFairyChests($this->config('region.swordsInPool', true));
        $rom->setSmithyQuickItemGive($this->config('region.swordsInPool', true));

        $rom->setGameState($this->config('mode.state'));
        $rom->setSwordlessMode($this->config('mode.weapons') === 'swordless');
        if ($this->config('mode.state') !== 'inverted') {
            switch ($this->config('rom.logicMode', $this->config['logic'])) {
                case 'MajorGlitches':
                case 'HybridMajorGlitches':
                case 'NoLogic':
                case 'OverworldGlitches':
                    $rom->setLockAgahnimDoorInEscape(false);
                    break;
                case 'NoGlitches':
                default:
                    $rom->setLockAgahnimDoorInEscape(true);
                    break;
            }
        }

        if (!$this->getLocation("Link's Uncle")->getItem() instanceof Item\Sword) {
            $rom->removeUnclesSword();
        }
        if (
            !$this->getLocation("Link's Uncle")->getItem() instanceof Item\Shield
            || !$this->getLocation("Link's Uncle")->hasItem(Item::get('L1SwordAndShield', $this))
        ) {
            $rom->removeUnclesShield();
        }

        $rom->initial_sram->setStartingEquipment($this->pre_collected_items, $this->config);
        $rom->setBallNChainDungeon(0x02);
        $rom->setCapacityUpgradeFills([
            $this->config('item.value.BombUpgrade5', 50),
            $this->config('item.value.BombUpgrade10', 50),
            $this->config('item.value.ArrowUpgrade5', 70),
            $this->config('item.value.ArrowUpgrade10', 70),
        ]);

        // currently has to be after compass mode, as this will override compass mode.
        $rom->setClockMode($this->config('rom.timerMode', 'off'));

        $rom->setBlueClock($this->config('item.value.BlueClock', 0) ?: 0);
        $rom->setRedClock($this->config('item.value.RedClock', 0) ?: 0);
        $rom->setGreenClock($this->config('item.value.GreenClock', 0) ?: 0);
        $rom->initial_sram->setStartingTimer($this->config('rom.timerStart', 0) ?: 0);

        switch ($this->config('rom.logicMode', $this->config['logic'])) {
            case 'HybridMajorGlitches':
            case 'MajorGlitches':
            case 'NoLogic':
                $rom->setSwampWaterLevel(false);
                $rom->setPreAgahnimDarkWorldDeathInDungeon(false);
                $rom->setSaveAndQuitFromBossRoom(true);
                $rom->setWorldOnAgahnimDeath(false);
                $rom->setRandomizerSeedType('MajorGlitches');
                $rom->setWarningFlags(bindec('01100000'));
                $rom->setAllowAccidentalMajorGlitch(true);
                $rom->setSQEGFix(false);
                $rom->setZeldaMirrorFix(false);
                break;
            case 'OverworldGlitches':
                $rom->setPreAgahnimDarkWorldDeathInDungeon(false);
                $rom->setSaveAndQuitFromBossRoom(true);
                $rom->setWorldOnAgahnimDeath(false);
                $rom->setRandomizerSeedType('OverworldGlitches');
                $rom->setWarningFlags(bindec('01000000'));
                $rom->setAllowAccidentalMajorGlitch(true);
                $rom->setSQEGFix(false);
                $rom->setZeldaMirrorFix(false);
                break;
            case 'NoGlitches':
            default:
                $rom->setSaveAndQuitFromBossRoom(true);
                $rom->setWorldOnAgahnimDeath(true);
                $rom->setAllowAccidentalMajorGlitch(false);
                $rom->setSQEGFix(true);
                $rom->setZeldaMirrorFix(true);
                break;
        }

        $triforce_hud = in_array($this->config('goal', 'ganon'), ['triforce-hunt', 'ganonhunt']);
        $rom->enableHudItemCounter($triforce_hud ? false : $this->config('rom.hudItemCounter', $this->config['goal'] == 'completionist'));

        if ($this->config('crystals.tower') === 0) {
            $rom->initial_sram->preOpenGanonsTower();
        }

        $rom->setGameType('item');

        $rom->setMysteryMasking($this->config('spoilers', 'on') === 'mystery');

        $rom->setPseudoBoots($this->config('pseudoboots', false));

        $rom->writeCredits();
        $rom->writeText();
        $rom->writeInitialSram();
        $rom->setTotalItemCount($this->getTotalItemCount());

        if ($save) {
            $hash = $this->saveSeedRecord();

            $rom->setSeedString(str_pad(sprintf("VT %s", $hash), 21, ' '));

            $rom->setStartScreenHash($this->config('override_start_screen', false) ?: $this->seed->hashArray());

            $this->seed->patch = json_encode($rom->getWriteLog());
            $this->seed->save();
        }

        return $rom;
    }

    /**
     * Set the ammo given for escape, based on available weapons
     *
     * @param \ALttP\Rom   $rom   Rom to write data to
     *
     * @return void
     */
    public function setEscapeFills(Rom $rom)
    {
        $uncle_items = new ItemCollection;
        $uncle_items->setChecksForWorld($this->id);
        $uncle_items = $uncle_items->addItem($this->getLocation("Link's Uncle")->getItem());

        // Add starting items if uncle doesn't have a weapon.  Temporarily disable ignoreCanKillEscapeThings for this check
        $ignoreCanKillEscapeThings = $this->config('ignoreCanKillEscapeThings', false);
        $this->config['ignoreCanKillEscapeThings'] = false;
        if (!$uncle_items->canKillEscapeThings($this)) {
            $uncle_items = $uncle_items->merge($this->getPreCollectedItems());
        }
        $this->config['ignoreCanKillEscapeThings'] = $ignoreCanKillEscapeThings;

        if ($uncle_items->hasSword() || $uncle_items->has('Hammer')) {
            $rom->setEscapeFills(0b00000000);
            $rom->setUncleSpawnRefills(0, 0, 0);
            $rom->setZeldaSpawnRefills(0, 0, 0);
            $rom->setMantleSpawnRefills(0, 0, 0);
        } elseif (
            $uncle_items->has('FireRod')
            || $uncle_items->has('CaneOfSomaria')
            || ($uncle_items->has('CaneOfByrna') && $this->config('enemizer.enemyHealth', 'default') == 'default')
        ) {
            $rom->setEscapeFills(0b00000100);
            $rom->setUncleSpawnRefills(
                $this->config('rom.EscapeRefills.Uncle.Magic', 0x80),
                0,
                0
            );
            $rom->setZeldaSpawnRefills(
                $this->config('rom.EscapeRefills.Zelda.Magic', 0x20),
                0,
                0
            );
            $rom->setMantleSpawnRefills(
                $this->config('rom.EscapeRefills.Mantle.Magic', 0x20),
                0,
                0
            );
            if ($this->config('rom.EscapeAssist', false)) {
                $rom->setEscapeAssist(0b00000100);
            }
        } elseif ($uncle_items->canShootArrows($this)) {
            $rom->setEscapeFills(0b00000001);
            $rom->setUncleSpawnRefills(
                0,
                0,
                $this->config('rom.EscapeRefills.Uncle.Arrows', 70)
            );
            $rom->setZeldaSpawnRefills(
                0,
                0,
                $this->config('rom.EscapeRefills.Zelda.Arrows', 10)
            );
            $rom->setMantleSpawnRefills(
                0,
                0,
                $this->config('rom.EscapeRefills.Mantle.Arrows', 10)
            );
            if ($this->config('rom.EscapeAssist', false)) {
                $rom->setEscapeAssist(0b00000001);
            }
        } elseif ($uncle_items->has('TenBombs') || $this->config('logic') !== 'NoLogic') {
            // TenBombs, or give player bombs if uncle was plando'd to not have a weapon.
            $rom->setEscapeFills(0b00000010);
            $rom->setUncleSpawnRefills(
                0,
                $this->config('rom.EscapeRefills.Uncle.Bombs', 50),
                0
            );
            $rom->setZeldaSpawnRefills(
                0,
                $this->config('rom.EscapeRefills.Zelda.Bombs', 3),
                0
            );
            $rom->setMantleSpawnRefills(
                0,
                $this->config('rom.EscapeRefills.Mantle.Bombs', 3),
                0
            );
            if ($this->config('rom.EscapeAssist', false)) {
                $rom->setEscapeAssist(0b00000010);
            }
        }
    }

    /**
     * This is a quick hack to get prizes shuffled, will adjust later when we model sprites.
     * this now also handles prize pull trees.
     *
     * @param \ALttP\Rom  $rom  ROM to write data to
     *
     * @return void
     */
    public function writePrizePacksToRom(Rom $rom): void
    {
        $emptyDrops = $this->getEmptyDropSlots();
        $drop_pool = $this->getDropsPool();

        for ($i = 0; $i < count($emptyDrops); $i++) {
            $curDrop = $drop_pool[$i];
            $emptyDrops[$i]->setDrop($curDrop);
        }

        $drop_bytes = array_map(function ($prize) {
            return $prize->getDrop()->getBytes()[0];
        }, $this->getAllDrops());

        // hard+ does not allow fairies/full magics
        if ($this->config('rom.NoFarieDrops', false)) {
            $drop_bytes = str_replace([0xE0, 0xE3], [0xDF, 0xD8], $drop_bytes);
        }

        if ($this->config('rom.rupeeBow', false)) {
            $drop_bytes = str_replace([0xE1, 0xE2], [0xDA, 0xDB], $drop_bytes);
            $rom->setOverworldDigPrizes([
                0xB2, 0xD8, 0xD8, 0xD8,
                0xD8, 0xD8, 0xD8, 0xD8, 0xD8,
                0xD9, 0xD9, 0xD9, 0xD9, 0xD9,
                0xDA, 0xDA, 0xDA, 0xDA, 0xDA,
                0xDB, 0xDB, 0xDB, 0xDB, 0xDB,
                0xDC, 0xDC, 0xDC, 0xDC, 0xDC,
                0xDD, 0xDD, 0xDD, 0xDD, 0xDD,
                0xDE, 0xDE, 0xDE, 0xDE, 0xDE,
                0xDF, 0xDF, 0xDF, 0xDF, 0xDF,
                0xE0, 0xE0, 0xE0, 0xE0, 0xE0,
                0xDA, 0xDA, 0xDA, 0xDA, 0xDA,
                0xDB, 0xDB, 0xDB, 0xDB, 0xDB,
                0xE3, 0xE3, 0xE3, 0xE3, 0xE3,
            ]);
        }

        // write to prize packs
        $rom->write(0x37A78, pack('C*', ...array_slice($drop_bytes, 0, 56)));

        // write to trees
        $rom->setPullTreePrizes($drop_bytes[56], $drop_bytes[57], $drop_bytes[58]);

        // write to prize crab
        $rom->setRupeeCrabPrizes($drop_bytes[59], $drop_bytes[60]);

        // write to stunned
        $rom->setStunnedSpritePrize($drop_bytes[61]);

        // write to saved fish
        $rom->setFishSavePrize($drop_bytes[62]);
    }

    /**
     * Update the Texts array for writing.
     *
     * @param string  $key    where to write the text
     * @param string  $value  the text to write
     *
     * @return void
     */
    public function setText(string $key, string $value): void
    {
        $this->texts[$key] = $value;
    }

    /**
     * Update the Credits array for writing.
     *
     * @param string  $key    where to write the text
     * @param string  $value  the text to write
     *
     * @return void
     */
    public function setCredit(string $key, string $value): void
    {
        $this->credits[$key] = $value;
    }

    /**
     * Save a seed record to DB.
     *
     * @return string hash of record
     */
    public function saveSeedRecord(): string
    {
        $this->seed->logic = Randomizer::LOGIC;
        $this->seed->game_mode = $this->config['logic'];
        $this->seed->build = Rom::BUILD;
        $this->seed->save();

        return $this->seed->hash;
    }

    /**
     * Get the current Seed record.
     *
     * @return \ALttP\Seed
     */
    public function getSeedRecord(): Seed
    {
        return $this->seed;
    }

    /**
     * Update patch of seed record to DB.
     *
     * @param array  $patch  new patch that will be applies
     *
     * @return void
     */
    public function updateSeedRecordPatch(array $patch): void
    {
        $this->seed->patch = json_encode($patch);
        $this->seed->save();
    }

    /**
     * Determine if this world requires Enemizer.
     *
     * @return bool
     */
    public function isEnemized(): bool
    {
        return $this->config('enemizer.bossShuffle') != 'none'
            || $this->config('enemizer.enemyShuffle') != 'none'
            || $this->config('enemizer.enemyDamage') != 'default'
            || $this->config('enemizer.enemyHealth') != 'default'
            || $this->config('enemizer.potShuffle') != 'off';
    }

    /**
     * Get a World config value for testing.
     *
     * @return string|int|bool
     */
    public function testGetConfig(string $config): string|int|bool
    {
        return $this->config[$config];
    }

    /**
     * Get a World config clone for testing.
     *
     * @return array
     */
    public function testGetConfigClone(): array
    {
        $config_clone = $this->config;
        return $config_clone;
    }

    /**
     * Set a World config value for testing.
     *
     * @return void
     */
    public function testSetConfig(string $config, string|int|bool $value): void
    {
        $this->config[$config] = $value;
    }
}
