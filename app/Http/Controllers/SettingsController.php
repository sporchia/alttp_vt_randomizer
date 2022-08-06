<?php

namespace App\Http\Controllers;

use App\Graph\Item;
use App\Graph\Randomizer;
use App\Rom;
use App\Sprite;
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
            $rand = new Randomizer();
            $world = $rand->getWorld(0);
            $items = collect(Item::all(0));
            $sprites = Sprite::all();
            return [
                'locations' => array_values($world->getWritableVertices()->map(function ($location) {
                    return [
                        'hash' => $location->getAttribute('name'),
                        'name' => $location->getAttribute('name'),
                        'region' => 'Unknown',
                        'class' => $location->getAttribute('type') === 'refill' ? 'bottles'
                            : ($location->getAttribute('type') === 'medallion' ? 'medallions'
                                : ($location->getAttribute('type') === 'prize' ? 'prizes' : 'items')),
                    ];
                })->toArray()),
                'prizepacks' => array_values(array_map(function ($pack) {
                    return [
                        'name' => $pack->name,
                        'slots' => count($pack->getDrops()),
                    ];
                }, $world->getPrizePacks())),
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
                'droppables' => array_merge(
                    [
                        ['value' => 'auto_fill', 'name' => 'item.Random', 'placed' => 0],
                    ],
                    $sprites->filter(function ($sprite) {
                        return $sprite instanceof Sprite\Droppable;
                    })->map(function ($item) {
                        return [
                            'value' => $item->name,
                            'name' => $item->nice_name,
                            'count' => $this->drops[$item->name] ?? 0,
                            'placed' => 0,
                        ];
                    })->values()->toArray()
                ),
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
        return collect(config('sprites'))->map(function ($info, $file) {
            return [
                'name' => $info['name'],
                'author' => $info['author'],
                'version' => $info['version'],
                'file' => 'https://alttpr-assets.s3.us-east-2.amazonaws.com/' . $file,
                'preview' => 'https://alttpr-assets.s3.us-east-2.amazonaws.com/' . $file . '.png',
                'tags' => $info['tags'] ?? [],
                'usage' => $info['usage'] ?? []
            ];
        })->values()->all();
    }
}
