<?php

namespace App\Services;

use App\Graph\World;
use App\Rom;

/**
 * Service class to create a spoilers based on a worlds item layout.
 */
class SpoilerService
{
    /**
     * Get spoiler data.
     *
     * @param World $world
     * @param array $meta etxra meta data to append to spoiler
     */
    public function getSpoiler(World $world, array $meta = []): array
    {
        $spoiler = [
            'Equipped' => [],
            'Locations' => [],
        ];

        $i = 0;
        foreach ($world->collected_items->toArray() as $item) {
            $location = sprintf("Equipment Slot %s", ++$i);
            $spoiler['Equipped'][$location] = $item->name;
        }

        foreach ($world->getWritableVertices() as $location) {
            $parts = explode(' - ', $location->name, 2);
            $group = isset($parts[1]) ? $parts[0] : 'Locations';
            $item = $location->item;
            $spoiler[$group][$location->name] = $item
                ? $item->name
                : 'Nothing';
        }
        foreach ($world->getLocationsOfType('mob') as $enemy) {
            $parts = explode(' - ', $enemy->name, 2);
            $group = isset($parts[1]) ? $parts[0] : 'Enemies';
            $spoiler[$group][$enemy->name] = $enemy->sprite->name;
        }

        // foreach ($this->getShops() as $shop) {
        //     if ($shop->getActive()) {
        //         $shop_data = [
        //             'location' => $shop->name,
        //             'type' => $shop instanceof Shop\TakeAny ? 'Take Any' : 'Shop',
        //         ];
        //         foreach ($shop->getInventory() as $slot => $item) {
        //             $shop_data["item_$slot"] = [
        //                 'item' => $item['item']->name,
        //                 'price' => $item['price'],
        //             ];
        //         }
        //         $this->spoiler['Shops'][] = $shop_data;
        //     }
        // }

        $spoiler['Bosses'] = [
            "Eastern Palace" => $world->getLocation("Eastern Palace - Boss")->enemizerBoss,
            "Desert Palace" => $world->getLocation("Desert Palace - Boss")->enemizerBoss,
            "Tower Of Hera" => $world->getLocation("Tower Of Hera - Boss")->enemizerBoss,
            "Hyrule Castle" => "Agahnim",
            "Palace Of Darkness" => $world->getLocation("Palace of Darkness - Boss")->enemizerBoss,
            "Swamp Palace" => $world->getLocation("Swamp Palace - Boss")->enemizerBoss,
            "Skull Woods" => $world->getLocation("Skull Woods - Boss")->enemizerBoss,
            "Thieves Town" => $world->getLocation("Thieves' Town - Boss")->enemizerBoss,
            "Ice Palace" => $world->getLocation("Ice Palace - Boss")->enemizerBoss,
            "Misery Mire" => $world->getLocation("Misery Mire - Boss")->enemizerBoss,
            "Turtle Rock" => $world->getLocation("Turtle Rock - Boss")->enemizerBoss,
            "Ganon's Tower Basement" => $world->getLocation("Ganon's Tower - Ice Armos")->enemizerBoss,
            "Ganon's Tower Middle" => $world->getLocation("Ganon's Tower - Lanmolas")->enemizerBoss,
            "Ganon's Tower Top" => $world->getLocation("Ganon's Tower - Moldorm")->enemizerBoss,
            "Ganon's Tower" => "Agahnim 2",
            "Ganon" => "Ganon",
        ];

        return array_merge($spoiler, [
            'meta' => array_merge($meta, [
                'item_placement' => $world->config('itemPlacement'),
                'item_pool' => $world->config('item.pool'),
                'item_functionality' => $world->config('item.functionality'),
                'dungeon_items' => $world->config('dungeonItems'),
                'logic' => $world->config('logic'),
                'accessibility' => $world->config('accessibility'),
                'rom_mode' => $world->config('rom.logicMode', $world->config('logic')),
                'goal' => $world->config('goal'),
                'build' => Rom::BUILD,
                'mode' => $world->config('mode.state'),
                'weapons' => $world->config('mode.weapons'),
                'world_id' => $world->id,
                'crystals_ganon' => $world->config('crystals.ganon'),
                'crystals_tower' => $world->config('crystals.tower'),
                'tournament' => $world->config('tournament', false),
                'difficulty_mode' => $world->config('rom.HardMode', 0),
                'size' => 2,
                'hints' => $world->config('spoil.Hints'),
                'spoilers' => $world->config('spoilers', 'off'),
                'allow_quickswap' => $world->config('allow_quickswap'),
                'enemizer.boss_shuffle' => $world->config('enemizer.bossShuffle'),
                'enemizer.enemy_shuffle' => $world->config('enemizer.enemyShuffle'),
                'enemizer.enemy_damage' => $world->config('enemizer.enemyDamage'),
                'enemizer.enemy_health' => $world->config('enemizer.enemyHealth'),
            ]),
        ]);
    }
}
