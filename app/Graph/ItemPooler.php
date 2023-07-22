<?php

declare(strict_types=1);

namespace App\Graph;

use Illuminate\Support\Arr;

/**
 * Get the sets of items to place.
 */
final class ItemPooler
{
    /**
     * Create new Item Pooler.
     * 
     * @param World[] $worlds worlds to get Item pools for
     */
    public function __construct(private array $worlds)
    {
        //
    }

    /**
     * Get list of all items in their weighted sets.
     */
    public function getPool(): array
    {
        $sets = [];

        foreach ($this->worlds as $world) {
            $world_set = array_merge_recursive(
                $this->getMedallions($world),
                $this->getPrizes($world),
                $this->getSmallKeys($world),
                $this->getBigKeys($world),
                $this->getMaps($world),
                $this->getCompasses($world),
                $this->getBottles($world),
                $this->getShopItems($world),
                [
                    '*' => [
                        // placing behind keys for now.
                        '_3' => [
                            Item::get('Hammer', $world->id),
                            Item::get('Hookshot', $world->id),
                            Item::get('Flippers', $world->id),
                            Item::get('FireRod', $world->id),
                            Item::get('IceRod', $world->id),
                            Item::get('ProgressiveBow', $world->id),
                            Item::get('ProgressiveBow', $world->id),
                            Item::get('ProgressiveSword', $world->id),
                            Item::get('ProgressiveSword', $world->id),
                            Item::get('ProgressiveShield', $world->id),
                            Item::get('ProgressiveShield', $world->id),
                            Item::get('ProgressiveShield', $world->id),
                            Item::get('PegasusBoots', $world->id),
                            Item::get('BookOfMudora', $world->id),
                            Item::get('ProgressiveGlove', $world->id),
                            Item::get('ProgressiveGlove', $world->id),
                            Item::get('CaneOfSomaria', $world->id),
                            Item::get('CaneOfByrna', $world->id),
                            Item::get('Cape', $world->id),
                            Item::get('Lamp', $world->id),
                            Item::get('Bombos', $world->id),
                            Item::get('Ether', $world->id),
                            Item::get('Quake', $world->id),
                            Item::get('Mushroom', $world->id),
                            Item::get('MoonPearl', $world->id),
                            Item::get('MagicMirror', $world->id),
                            Item::get('OcarinaInactive', $world->id),
                            Item::get('Shovel', $world->id),
                            Item::get('BugCatchingNet', $world->id),
                            Item::get('Powder', $world->id),
                            Item::get('HalfMagic', $world->id),
                        ],
                        '_9001' => array_merge(
                            array_fill(0, 2, Item::get('ProgressiveSword', $world->id)),
                            [Item::get('Boomerang', $world->id)],
                            [Item::get('RedBoomerang', $world->id)],
                            array_fill(0, 2, Item::get('ProgressiveArmor', $world->id)),
                            array_fill(0, 10, Item::get('BossHeartContainer', $world->id)),
                            [Item::get('HeartContainer', $world->id)],
                            array_fill(0, 24, Item::get('PieceOfHeart', $world->id)),
                        ),
                        // order here matters, items at end may get lopped off
                        // if too many items to place
                        '_9999' => array_merge(
                            [Item::get('Arrow', $world->id)],
                            array_fill(0, 12, Item::get('TenArrows', $world->id)),
                            array_fill(0, 17, Item::get('ThreeBombs', $world->id)),
                            array_fill(0, 2, Item::get('OneRupee', $world->id)),
                            array_fill(0, 4, Item::get('FiveRupees', $world->id)),
                            array_fill(0, 28, Item::get('TwentyRupees', $world->id)),
                            array_fill(0, 7, Item::get('FiftyRupees', $world->id)),
                            [Item::get('OneHundredRupees', $world->id)],
                            array_fill(0, 5, Item::get('ThreeHundredRupees', $world->id)),
                        ),
                    ],
                ]
            );

            if (
                $world->config('logic') !== 'None'
                && ($world->config('mode.state') === 'inverted'
                    || !in_array($world->config('logic'), ['OverworldGlitches', 'MajorGlitches']))
            ) {
                $crystal_ratio =  $world->config('crystals.tower', 7) / 7;
                if (in_array($world->config('goal'), ['triforce-hunt', 'pedestal'])) {
                    $fill_count = get_random_int((int) floor(15 * $crystal_ratio), (int) floor(25 * $crystal_ratio));
                } else {
                    $fill_count = get_random_int(0, (int) floor(15 * $crystal_ratio));
                }
                if ($fill_count > 0) {
                    $keys = (array) array_rand($world_set['*']['_9999'], $fill_count);
                    foreach ($keys as $key) {
                        $world_set['gt:' . $world->id]['_2'][] = $world_set['*']['_9999'][$key];
                        unset($world_set['*']['_9999'][$key]);
                    }
                }
            }

            $sets = array_merge_recursive(
                $sets,
                $world_set
            );
        }

        // array_merge_recursive can only work properly with string keys, so we
        // internally prepend with `_` but need to turn the keys back to ints
        // before we return the sets.
        foreach ($sets as $pkey => $set) {
            foreach ($set as $skey => $items) {
                unset($sets[$pkey][$skey]);
                $sets[$pkey][trim($skey, '_')] = $items;
            }
        }

        return $sets;
    }

    /**
     * Get Medallions meta locations for what ends up being required for TR/MM
     * entry.
     *
     * @param World $world world to get items for
     */
    private function getMedallions(World $world): array
    {
        return [
            'mm-medallion:' . $world->id => [
                '_0' => [
                    Item::get(['MireEntryBombos', 'MireEntryEther', 'MireEntryQuake'][get_random_int(0, 2)], $world->id),
                ],
            ],
            'tr-medallion:' . $world->id => [
                '_0' => [
                    Item::get(['TurtleRockEntryBombos', 'TurtleRockEntryEther', 'TurtleRockEntryQuake'][get_random_int(0, 2)], $world->id),
                ],
            ],
        ];
    }

    /**
     * Get Prizes for a world.
     *
     * @param World $world world to get items for
     */
    private function getPrizes(World $world): array
    {
        return [
            'prize:' . $world->id => [
                '_0' => [
                    Item::get('PendantOfCourage', $world->id),
                    Item::get('PendantOfWisdom', $world->id),
                    Item::get('PendantOfPower', $world->id),
                    Item::get('Crystal1', $world->id),
                    Item::get('Crystal2', $world->id),
                    Item::get('Crystal3', $world->id),
                    Item::get('Crystal4', $world->id),
                    Item::get('Crystal5', $world->id),
                    Item::get('Crystal6', $world->id),
                    Item::get('Crystal7', $world->id),
                ],
            ],
        ];
    }

    /**
     * Get Small keys for world in proper placement groups.
     *
     * @param World $world world to get items for
     */
    private function getSmallKeys(World $world): array
    {
        $keys = [
            'escape:' . $world->id => [
                '_1' => [Item::get('KeyH2', $world->id)],
            ],
            'desert:' . $world->id => [
                '_1' => [Item::get('KeyP2', $world->id)],
            ],
            'hera:' . $world->id => [
                '_1' => [Item::get('KeyP3', $world->id)],
            ],
            'agahnim:' . $world->id => [
                '_1' => array_fill(0, 2, Item::get('KeyA1', $world->id)),
            ],
            'pod:' . $world->id => [
                '_1' => array_fill(0, 6, Item::get('KeyD1', $world->id)),
            ],
            'swamp:' . $world->id => [
                '_1' => [Item::get('KeyD2', $world->id)],
            ],
            'skull:' . $world->id => [
                '_1' => array_fill(0, 3, Item::get('KeyD3', $world->id)),
            ],
            'thieves:' . $world->id => [
                '_1' => [Item::get('KeyD4', $world->id)],
            ],
            'ice:' . $world->id => [
                '_1' => array_fill(0, 2, Item::get('KeyD5', $world->id)),
            ],
            'mire:' . $world->id => [
                '_1' => array_fill(0, 3, Item::get('KeyD6', $world->id)),
            ],
            'turtlerock:' . $world->id => [
                '_1' => array_fill(0, 4, Item::get('KeyD7', $world->id)),
            ],
            'gt:' . $world->id => [
                '_1' => array_fill(0, 4, Item::get('KeyA2', $world->id)),
            ],
        ];

        if ($world->config('region.wildKeys', false)) {
            return [
                '*' => [
                    '_3' => Arr::flatten($keys),
                ],
            ];
        }

        return $keys;
    }

    /**
     * Get Big keys for world in proper placement groups.
     *
     * @param World $world world to get items for
     */
    private function getBigKeys(World $world): array
    {
        $big_keys = [
            'eastern:' . $world->id => [
                '_1' => [Item::get('BigKeyP1', $world->id)],
            ],
            'desert:' . $world->id => [
                '_1' => [Item::get('BigKeyP2', $world->id)],
            ],
            'hera:' . $world->id => [
                '_1' => [Item::get('BigKeyP3', $world->id)],
            ],
            'pod:' . $world->id => [
                '_1' => [Item::get('BigKeyD1', $world->id)],
            ],
            'swamp:' . $world->id => [
                '_2' => [Item::get('BigKeyD2', $world->id)],
            ],
            'skull:' . $world->id => [
                '_2' => [Item::get('BigKeyD3', $world->id)],
            ],
            'thieves:' . $world->id => [
                '_1' => [Item::get('BigKeyD4', $world->id)],
            ],
            'ice:' . $world->id => [
                '_1' => [Item::get('BigKeyD5', $world->id)],
            ],
            'mire:' . $world->id => [
                '_1' => [Item::get('BigKeyD6', $world->id)],
            ],
            'turtlerock:' . $world->id => [
                '_1' => [Item::get('BigKeyD7', $world->id)],
            ],
            'gt:' . $world->id => [
                '_0' => [Item::get('BigKeyA2', $world->id)],
            ],
        ];

        if ($world->config('region.wildBigKeys', false)) {
            return [
                '*' => [
                    '_3' => Arr::flatten($big_keys),
                ],
            ];
        }

        return $big_keys;
    }

    /**
     * Get Maps for world in proper placement groups.
     *
     * @param World $world world to get items for
     */
    private function getMaps(World $world): array
    {
        $maps = [
            'escape:' . $world->id => [
                '_9010' => [Item::get('MapH2', $world->id)],
            ],
            'eastern:' . $world->id => [
                '_9010' => [Item::get('MapP1', $world->id)],
            ],
            'desert:' . $world->id => [
                '_9010' => [Item::get('MapP2', $world->id)],
            ],
            'hera:' . $world->id => [
                '_9010' => [Item::get('MapP3', $world->id)],
            ],
            'pod:' . $world->id => [
                '_9010' => [Item::get('MapD1', $world->id)],
            ],
            'swamp:' . $world->id => [
                '_9010' => [Item::get('MapD2', $world->id)],
            ],
            'skull:' . $world->id => [
                '_9010' => [Item::get('MapD3', $world->id)],
            ],
            'thieves:' . $world->id => [
                '_9010' => [Item::get('MapD4', $world->id)],
            ],
            'ice:' . $world->id => [
                '_9010' => [Item::get('MapD5', $world->id)],
            ],
            'mire:' . $world->id => [
                '_9010' => [Item::get('MapD6', $world->id)],
            ],
            'turtlerock:' . $world->id => [
                '_9010' => [Item::get('MapD7', $world->id)],
            ],
            'gt:' . $world->id => [
                '_9010' => [Item::get('MapA2', $world->id)],
            ],
        ];

        if ($world->config('region.wildMaps', false)) {
            return [
                '*' => [
                    '_3' => Arr::flatten($maps),
                ],
            ];
        }

        if ($world->config('accessibility') === 'items') {
            $maps = array_map(fn ($parts) => ['_9999' => $parts['_9010']], $maps);
        }

        return $maps;
    }

    /**
     * Get Compasses for world in proper placement groups.
     *
     * @param World $world world to get items for
     */
    private function getCompasses(World $world): array
    {
        $compasses = [
            'eastern:' . $world->id => [
                '_9010' => [Item::get('CompassP1', $world->id)],
            ],
            'desert:' . $world->id => [
                '_9010' => [Item::get('CompassP2', $world->id)],
            ],
            'hera:' . $world->id => [
                '_9010' => [Item::get('CompassP3', $world->id)],
            ],
            'pod:' . $world->id => [
                '_9010' => [Item::get('CompassD1', $world->id)],
            ],
            'swamp:' . $world->id => [
                '_9010' => [Item::get('CompassD2', $world->id)],
            ],
            'skull:' . $world->id => [
                '_9010' => [Item::get('CompassD3', $world->id)],
            ],
            'thieves:' . $world->id => [
                '_9010' => [Item::get('CompassD4', $world->id)],
            ],
            'ice:' . $world->id => [
                '_9010' => [Item::get('CompassD5', $world->id)],
            ],
            'mire:' . $world->id => [
                '_9010' => [Item::get('CompassD6', $world->id)],
            ],
            'turtlerock:' . $world->id => [
                '_9010' => [Item::get('CompassD7', $world->id)],
            ],
            'gt:' . $world->id => [
                '_9010' => [Item::get('CompassA2', $world->id)],
            ],
        ];

        if ($world->config('region.wildCompasses', false)) {
            return [
                '*' => [
                    '_3' => Arr::flatten($compasses),
                ],
            ];
        }

        if ($world->config('accessibility') === 'items') {
            $compasses = array_map(fn ($parts) => ['_9999' => $parts['_9010']], $compasses);
        }

        return $compasses;
    }

    /**
     * Get Bottles for world in proper placement groups.
     *
     * @param World $world world to get items for
     */
    private function getBottles(World $world): array
    {
        $bottles = [
            'Bottle',
            'BottleWithRedPotion',
            'BottleWithGreenPotion',
            'BottleWithBluePotion',
            'BottleWithBee',
            'BottleWithGoldBee',
            'BottleWithFairy',
        ];

        return [
            'bottle:' . $world->id => [
                '_0' => [
                    Item::get('Fairy' . $bottles[get_random_int(0, count($bottles) - 1)], $world->id),
                    Item::get('Fairy' . $bottles[get_random_int(0, count($bottles) - 1)], $world->id),
                ],
            ],
            '*' => [
                '_3' => [
                    Item::get($bottles[get_random_int(0, count($bottles) - 1)], $world->id),
                ],
                '_9001' => [
                    Item::get($bottles[get_random_int(0, count($bottles) - 1)], $world->id),
                    Item::get($bottles[get_random_int(0, count($bottles) - 1)], $world->id),
                    Item::get($bottles[get_random_int(0, count($bottles) - 1)], $world->id),
                ],
            ],
        ];
    }

    /**
     * Get Shop Items for world in proper placement groups.
     * 
     * @todo verify these counts, they are definitely wrong
     *
     * @param World $world world to get items for
     */
    private function getShopItems(World $world): array
    {
        if ($world->config('region.shopSupply') !== 'shuffled') {
            return [];
        }

        return [
            '*' => [
                '_9999' => [
                    array_fill(0, 6, Item::get('RedPotion', $world->id)),
                    array_fill(0, 1, Item::get('GreenPotion', $world->id)),
                    array_fill(0, 6, Item::get('BluePotion', $world->id)),
                    array_fill(0, 10, Item::get('Heart', $world->id)),
                    array_fill(0, 10, Item::get('TenBombs', $world->id)),
                    array_fill(0, 2, Item::get('BlueShield', $world->id)),
                    array_fill(0, 1, Item::get('RedShield', $world->id)),
                ],
            ],
        ];
    }
}
