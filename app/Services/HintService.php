<?php

namespace ALttP\Services;

use ALttP\Item;
use ALttP\Location;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * Service class to add hints to a series of worlds.
 */
class HintService
{
    /** @var array */
    protected $worlds;
    /** @var array */
    protected $advancement_items;
    /** @var array */
    protected $joke_hints;

    /**
     * Create a new hint service.
     *
     * @param array  $worlds             worlds to create hints for
     * @param array  $advancement_items  items considered for advancment
     *
     * @return void
     */
    public function __construct(array $worlds, array $advancement_items)
    {
        $this->worlds = $worlds;
        $this->advancement_items = $advancement_items;
        $this->joke_hints = cache()->rememberForever('joke_hints', function () {
            return array_filter(explode(
                "\n-\n",
                (string) preg_replace(
                    '/^-\n/',
                    '',
                    (string) preg_replace('/\r\n/', "\n", (string) file_get_contents(base_path('strings/hint.txt')))
                )
            ));
        });
    }

    /**
     * Add hints to worlds
     *
     * @return void
     */
    public function applyHints(): void
    {
        foreach ($this->worlds as $world) {
            if ($world->config('spoil.Hints') !== 'on') {
                $world->setText('sign_north_of_links_house', "Randomizer v31\n\n>    -veetorp");
                continue;
            }

            $tiles = fy_shuffle([
                'telepathic_tile_eastern_palace',
                'telepathic_tile_tower_of_hera_floor_4',
                'telepathic_tile_spectacle_rock',
                'telepathic_tile_swamp_entrance',
                'telepathic_tile_thieves_town_upstairs',
                'telepathic_tile_misery_mire',
                'telepathic_tile_palace_of_darkness',
                'telepathic_tile_desert_bonk_torch_room',
                'telepathic_tile_castle_tower',
                'telepathic_tile_ice_large_room',
                'telepathic_tile_turtle_rock',
                'telepathic_tile_ice_entrace',
                'telepathic_tile_ice_stalfos_knights_room',
                'telepathic_tile_tower_of_hera_entrance',
                'telepathic_tile_south_east_darkworld_cave',
            ]);
            $locations = fy_shuffle([
                "Sahasrahla",
                "Mimic Cave",
                "Catfish",
                "Graveyard Ledge",
                "Purple Chest",
                "Tower of Hera - Big Key Chest",
                "Swamp Palace - Big Chest",
                ["Misery Mire - Big Key Chest", "Misery Mire - Compass Chest"],
                ["Swamp Palace - Big Key Chest", "Swamp Palace - West Chest"],
                ["Pyramid Fairy - Left", "Pyramid Fairy - Right"],
            ]);

            if ($world->config('region.wildBigKeys', false)) {
                $gtbk_location = $world->getLocationsWithItem(Item::get('BigKeyA2', $world))->first();

                if ($gtbk_location) {
                    $tile = array_pop($tiles);
                    $gtbk_hint = $gtbk_location->getHint();

                    Log::debug("$tile: $gtbk_hint");
                    $world->setText($tile, $gtbk_hint);
                }
            }

            $boots_location = $world->getLocationsWithItem(Item::get('PegasusBoots', $world))->first();
            if ($boots_location) {
                $tile = array_pop($tiles);
                $boots_hint = $boots_location->getHint();

                Log::debug("$tile: $boots_hint");
                $world->setText($tile, $boots_hint);
            }

            $picks = range(0, count($locations) - 1);
            for ($i = 0; $i < 5; ++$i) {
                $picks = fy_shuffle($picks);
                $pick = $locations[array_pop($picks)];

                if (is_array($pick)) {
                    $hint = $world->getLocations()->filter(function ($location) use ($pick) {
                        return in_array($location->getName(), $pick);
                    })->getHint();
                } else {
                    $hint = $world->getLocation($pick)->getHint();
                }

                if (!$hint) {
                    continue;
                }
                $tile = array_pop($tiles);

                Log::debug("$tile: $hint");
                $world->setText($tile, $hint);
            }

            $hintables = array_filter($this->advancement_items, function ($item) use ($world) {
                return !$item instanceof Item\Shield
                    && !$item instanceof Item\Key
                    && !$item instanceof Item\Map
                    && !$item instanceof Item\Compass
                    && ($world->config('region.wildBigKeys', false) || !$item instanceof Item\BigKey)
                    && !$item instanceof Item\Bottle
                    && !$item instanceof Item\Sword
                    && !in_array($item->getRawName(), ['TenBombs', 'HalfMagic', 'BugCatchingNet', 'Powder', 'Mushroom']);
            });

            switch ($world->config('rom.HardMode', 0)) {
                case -1:
                    $hints = array_slice(fy_shuffle($hintables ?? []), 0, count($tiles));

                    break;
                case 0:
                    $hints = array_slice(fy_shuffle($hintables ?? []), 0, min(4, count($tiles)));

                    break;
                default:
                    $hints = [];
            }

            $hints = array_filter(array_map(function ($item) use ($world) {
                return $world->getLocationsWithItem($item)->filter(function ($location) {
                    return !$location instanceof Location\Medallion
                        && !$location instanceof Location\Fountain
                        && !$location instanceof Location\Prize
                        && !$location instanceof Location\Trade;
                })->random();
            }, $hints));

            $locations_with_item = $world->getLocationsWithItem()->filter(function ($location) use ($world) {
                $item = $location->getItem();
                return !$location instanceof Location\Medallion
                    && !$location instanceof Location\Fountain
                    && !$location instanceof Location\Prize
                    && !$location instanceof Location\Trade
                    && !$item instanceof Item\Key
                    && !$item instanceof Item\Map
                    && !$item instanceof Item\Compass
                    && ($world->config('region.wildBigKeys', false) || !$item instanceof Item\BigKey);
            });

            $hint_locations = $locations_with_item->randomCollection(get_random_int((int) (floor((count($tiles) - count($hints)) / 2) - 1), count($tiles) - count($hints) - 1))->merge($hints);

            foreach ($tiles as $tile) {
                $hint = $hint_locations->pop();
                $hint_text = ($hint ? $hint->getHint() : null) ?? Arr::first(fy_shuffle($this->joke_hints));

                Log::debug(str_replace("\n", " ", "$tile: $hint_text"));
                $world->setText($tile, $hint_text);
            }
        }
    }
}
