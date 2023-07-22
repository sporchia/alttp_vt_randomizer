<?php

namespace App\Http\Controllers;

use App\Graph\Item;
use App\Graph\World;
use App\Rom;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * Controller to handle all requests for front end configs. Basically this
 * informs the front end what the back end expects.
 */
class SettingsController extends Controller
{
    /** @var array */
    protected $items = [];
    /** @var array */
    protected $drops = [];

    /**
     * Create a new controller class.
     *
     * @return void
     */
    public function __construct()
    {
        $this->drops = config('item.drop');
        foreach (Arr::only(config('item'), ['advancement', 'nice', 'junk', 'dungeon']) as $group) {
            foreach ($group as $item => $value) {
                if (!isset($this->items[$item])) {
                    $this->items[$item] = 0;
                }
                $this->items[$item] += $value;
            }
        }
    }

    /**
     * Get item randomizer settings.
     *
     * @return array
     */
    public function item(): array
    {
        return config('alttp.randomizer.item');
    }

    /**
     * Get all customizer options (cached).
     *
     * @todo refactor this into smaller functions
     *
     * @return array
     */
    public function customizer(): array
    {
        return Cache::rememberForever('customizer_settings', function () {
            $world = new World(0);
            $items = collect(Item::all(0));
            return [
                'locations' => array_values($world->getWritableVertices()->map(function ($location) {
                    return [
                        'hash' => $location->name,
                        'name' => $location->name,
                        'region' => 'Unknown',
                        'class' => $location->type === 'refill' ? 'bottles'
                            : ($location->type === 'medallion' ? 'medallions'
                                : ($location->type === 'prize' ? 'prizes' : 'items')),
                    ];
                })->toArray()),
                'prizepacks' => [
                    ["name" => "1", "slots" => 8],
                    ["name" => "2", "slots" => 8],
                    ["name" => "3", "slots" => 8],
                    ["name" => "4", "slots" => 8],
                    ["name" => "5", "slots" => 8],
                    ["name" => "6", "slots" => 8],
                    ["name" => "7", "slots" => 8],
                    ["name" => "pull", "slots" => 3],
                    ["name" => "crab", "slots" => 2],
                    ["name" => "stun", "slots" => 1],
                    ["name" => "fish", "slots" => 1],
                ],
                'items' => array_values(array_merge(
                    [
                        ['value' => 'auto_fill', 'name' => 'item.Random', 'placed' => 0],
                        ['value' => 'BottleWithRandom', 'name' => 'item.BottleWithRandom', 'count' => 4, 'placed' => 0],
                    ],
                    $items->filter(function ($item) {
                        return !$item->meta
                            && !in_array($item->raw_name, [
                                'BigKey',
                                'Compass',
                                'Key',
                                'KeyGK',
                                'L2Sword',
                                'Map',
                                'MapLW',
                                'MapDW',
                                'BigKeyH1',
                                'KeyH1',
                                'CompassH1',
                                'MapH1',
                                'multiRNG',
                                'PowerStar',
                                'singleRNG',
                                'TwentyRupees2',
                                'HeartContainerNoAnimation',
                                'UncleSword',
                                'ShopKey',
                                'ShopArrow',
                                'ProgressiveBowAlternate',
                                'BombUpgrade50',
                                'ArrowUpgrade70',
                            ])
                            || $item == Item::get('Triforce', 0);
                    })->map(function ($item) {
                        return [
                            'value' => $item->name,
                            'name' => $item->i18n_name,
                            'count' => $this->items[$item->raw_name] ?? 0,
                            'placed' => 0,
                        ];
                    })->toArray()
                )),
                'prizes' => array_values(array_merge(
                    [
                        ['value' => 'auto_fill', 'name' => 'item.Random', 'placed' => 0],
                    ],
                    $items->filter(function ($item) {
                        return strpos($item->name, 'Pendant') !== false
                            || strpos($item->name, 'Crystal') !== false;
                    })->map(function ($item) {
                        return [
                            'value' => $item->name,
                            'name' => $item->i18n_name,
                            'count' => 0,
                            'placed' => 0,
                        ];
                    })->toArray()
                )),
                'medallions' => array_merge(
                    [
                        ['value' => 'auto_fill', 'name' => 'item.Random', 'placed' => 0],
                    ],
                    $items->filter(function ($item) {
                        return strpos($item->name, 'Medallion') !== false;
                    })->map(function ($item) {
                        return [
                            'value' => $item->name,
                            'name' => $item->i18n_name,
                            'count' => 0,
                            'placed' => 0,
                        ];
                    })->toArray()
                ),
                'bottles' => [
                    ['value' => 'auto_fill', 'name' => 'item.Random', 'placed' => 0],
                    ['value' => 'Bottle:0', 'name' => 'item.Bottle', 'count' => 0, 'placed' => 0],
                    ['value' => 'BottleWithRedPotion:0', 'name' => 'item.BottleWithRedPotion', 'count' => 0, 'placed' => 0],
                    ['value' => 'BottleWithGreenPotion:0', 'name' => 'item.BottleWithGreenPotion', 'count' => 0, 'placed' => 0],
                    ['value' => 'BottleWithBluePotion:0', 'name' => 'item.BottleWithBluePotion', 'count' => 0, 'placed' => 0],
                    ['value' => 'BottleWithBee:0', 'name' => 'item.BottleWithBee', 'count' => 0, 'placed' => 0],
                    ['value' => 'BottleWithGoldBee:0', 'name' => 'item.BottleWithGoldBee', 'count' => 0, 'placed' => 0],
                    ['value' => 'BottleWithFairy:0', 'name' => 'item.BottleWithFairy', 'count' => 0, 'placed' => 0],
                ],
                'droppables' => [
                    ['value' => 'auto_fill', 'name' => 'item.Random', 'placed' => 0],
                    ['value' => "Bee:0", 'name' => 'item.Bee', 'count' => 0, 'placed' => 0],
                    ['value' => "BeeGood:0", 'name' => 'item.BeeGood', 'count' => 0, 'placed' => 0],
                    ['value' => "Heart:0", 'name' => 'item.Heart', 'count' => 13, 'placed' => 0],
                    ['value' => "RupeeGreen:0", 'name' => 'item.RupeeGreen', 'count' => 9, 'placed' => 0],
                    ['value' => "RupeeBlue:0", 'name' => 'item.RupeeBlue', 'count' => 7, 'placed' => 0],
                    ['value' => "RupeeRed:0", 'name' => 'item.RupeeRed', 'count' => 6, 'placed' => 0],
                    ['value' => "BombRefill1:0", 'name' => 'item.BombRefill1', 'count' => 7, 'placed' => 0],
                    ['value' => "BombRefill4:0", 'name' => 'item.BombRefill4', 'count' => 1, 'placed' => 0],
                    ['value' => "BombRefill8:0", 'name' => 'item.BombRefill8', 'count' => 2, 'placed' => 0],
                    ['value' => "MagicRefillSmall:0", 'name' => 'item.MagicRefillSmall', 'count' => 6, 'placed' => 0],
                    ['value' => "MagicRefillFull:0", 'name' => 'item.MagicRefillFull', 'count' => 3, 'placed' => 0],
                    ['value' => "ArrowRefill5:0", 'name' => 'item.ArrowRefill5', 'count' => 5, 'placed' => 0],
                    ['value' => "ArrowRefill10:0", 'name' => 'item.ArrowRefill10', 'count' => 3, 'placed' => 0],
                    ['value' => "Fairy:0", 'name' => 'item.Fairy', 'count' => 1, 'placed' => 0],
                ],
            ];
        });
    }

    /**
     * Get information on the current ROM patch.
     *
     * @return array
     */
    public function rom(): array
    {
        return [
            'rom_hash' => Rom::HASH,
            'base_file' => sprintf('/bps/%s.bps', Rom::HASH),
        ];
    }

    /**
     * Get all current Link sprite options.
     *
     * @return array
     */
    public function sprites(): array
    {
        $url = config('filesystems.disks.images.url');
        return collect(config('sprites'))->map(fn ($info, $file) => [
            'name' => $info['name'],
            'author' => $info['author'],
            'version' => $info['version'],
            'file' => $url . '/' . $file,
            'preview' => $url . '/' . $file . '.png',
            'tags' => $info['tags'] ?? [],
            'usage' => $info['usage'] ?? []
        ])->values()->all();
    }
}
