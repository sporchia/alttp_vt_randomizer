<?php

declare(strict_types=1);

namespace App\Graph;

use App\Sprite;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

/**
 * Modify the edges of the graph to place bosses.
 */
final class BossShuffler
{
    private const BOSS_ITEMS = [
        'Armos' => "DefeatArmos",
        'Lanmola' => "DefeatLanmolas",
        'Moldorm' => "DefeatMoldorm",
        'Agahnim' => "DefeatAgahnim",
        'Helmasaur' => "DefeatHelmasaur",
        'Arrghus' => "DefeatArrghus",
        'Mothula' => "DefeatMothula",
        'Blind' => "DefeatBlind",
        'Kholdstare' => "DefeatKholdstare",
        'Vitreous' => "DefeatVitreous",
        'Trinexx' => "DefeatTrinexx",
        'Agahnim2' => "DefeatAgahnim2",
        'Ganon' => "DefeatGanon",
    ];
    private const NEVER_PLACE = [
        "DefeatAgahnim",
        "DefeatAgahnim2",
        "DefeatGanon",
    ];
    private const NO_PLACE = [
        "Ganon's Tower - Moldorm" => [
            "DefeatArmos",
            "DefeatArrghus",
            "DefeatBlind",
            "DefeatLanmolas",
            "DefeatTrinexx",
        ],
        "Ganon's Tower - Lanmolas" => [
            "DefeatBlind",
        ],
        "Ganon's Tower - Ice Armos" => [
            "DefeatTrinexx",
        ],
        "Skull Woods - Boss" => [
            "DefeatTrinexx",
        ],
        "Tower Of Hera - Boss" => [
            "DefeatArmos",
            "DefeatArrghus",
            "DefeatBlind",
            "DefeatLanmolas",
            "DefeatTrinexx",
        ],
    ];
    private const BOSS_FROM_LOCATION = [
        "Ganon's Tower - Moldorm" => "Ganon's Tower - Moldorm - Kill Zone",
        "Ganon's Tower - Lanmolas" => "Ganon's Tower - Gauntlet Refill",
        "Tower Of Hera - Boss" => "Tower Of Hera - Boss Room",
        "Skull Woods - Boss" => "Skull Woods - Boss Room",
        "Eastern Palace - Boss" => "Eastern Palace - Boss Room",
        "Desert Palace - Boss" => "Desert Palace - Boss Room",
        "Palace of Darkness - Boss" => "Palace of Darkness - Boss Room",
        "Swamp Palace - Boss" => "Swamp Palace - Boss Room",
        "Thieves' Town - Boss" => "Thieves' Town - Boss Room",
        "Ice Palace - Boss" => "Ice Palace - Boss Room",
        "Misery Mire - Boss" => "Misery Mire - Boss Room",
        "Turtle Rock - Boss" => "Turtle Rock - Boss Room",
        "Ganon's Tower - Ice Armos" => "Ganon's Tower - Ice Room",
    ];

    private Collection $boss_location_map;

    /**
     * Add all the vertices to the graph for this region.
     *
     * @param World $this->world world to reduce graph for
     *
     * @return void
     */
    public function __construct(private World $world)
    {
        $this->boss_location_map = collect(Yaml::parse(
            file_get_contents(app_path('Graph/data/Bosses/SpriteLocations.yml'))
        ) ?? [])->keyBy(fn ($item, $key) => "$key:$world->id");
    }

    /**
     * Swap Entrances based on world settings.
     */
    public function adjustEdges(): void
    {
        // most restrictive first
        $boss_locations = [
            "Ganon's Tower - Moldorm",
            "Ganon's Tower - Lanmolas",
            "Tower Of Hera - Boss",
            "Skull Woods - Boss",
            "Eastern Palace - Boss",
            "Desert Palace - Boss",
            "Palace of Darkness - Boss",
            "Swamp Palace - Boss",
            "Thieves' Town - Boss",
            "Ice Palace - Boss",
            "Misery Mire - Boss",
            "Turtle Rock - Boss",
            "Ganon's Tower - Ice Armos",
        ];

        // force Kholdstare for swordless to be in Ice Palace
        if ($this->world->config('mode.weapons') == 'swordless') {
            // remove Ice Palace
            array_splice($boss_locations, 9, 1);
            $this->placeBossItemInLocation('DefeatKholdstare', "Ice Palace - Boss");
        }

        switch ($this->world->config('enemizer.bossShuffle')) {
            case 'random':
                foreach ($boss_locations as $location) {
                    $boss = isset(self::NO_PLACE[$location])
                        ? array_diff(fy_shuffle(self::BOSS_ITEMS), self::NO_PLACE[$location], self::NEVER_PLACE)
                        : array_diff(fy_shuffle(self::BOSS_ITEMS), self::NEVER_PLACE);
                    $this->placeBossItemInLocation(reset($boss), $location);
                }
                break;
            case 'full': // 1 copy of each, +3 other copies
                $place_bosses = [
                    "DefeatArmos",
                    "DefeatLanmolas",
                    "DefeatMoldorm",
                    "DefeatHelmasaur",
                    "DefeatArrghus",
                    "DefeatMothula",
                    "DefeatBlind",
                    "DefeatKholdstare",
                    "DefeatVitreous",
                    "DefeatTrinexx",
                ];
                $place_bosses = array_merge($place_bosses, array_slice(fy_shuffle($place_bosses), 0, 3));

                foreach ($boss_locations as $location) {
                    $boss = isset(self::NO_PLACE[$location])
                        ? array_diff(fy_shuffle($place_bosses), self::NO_PLACE[$location], self::NEVER_PLACE)
                        : array_diff(fy_shuffle($place_bosses), self::NEVER_PLACE);
                    $place_bosses = array_diff($place_bosses, reset($boss));
                    $this->placeBossItemInLocation(reset($boss), $location);
                }
                break;
            case 'simple': // 1:1
                $place_bosses = [
                    "DefeatArmos",
                    "DefeatLanmolas",
                    "DefeatMoldorm",
                    "DefeatHelmasaur",
                    "DefeatArrghus",
                    "DefeatMothula",
                    "DefeatBlind",
                    "DefeatKholdstare",
                    "DefeatVitreous",
                    "DefeatTrinexx",
                    "DefeatArmos",
                    "DefeatLanmolas",
                    "DefeatMoldorm",
                ];

                foreach ($boss_locations as $location) {
                    $boss = isset(self::NO_PLACE[$location])
                        ? array_diff(fy_shuffle($place_bosses), self::NO_PLACE[$location], self::NEVER_PLACE)
                        : array_diff(fy_shuffle($place_bosses), self::NEVER_PLACE);
                    $place_bosses = array_diff($place_bosses, reset($boss));
                    $this->placeBossItemInLocation(reset($boss), $location);
                }
                break;
            case 'none':
            default:
                $this->placeBossItemInLocation("DefeatArmos", "Eastern Palace - Boss");
                $this->placeBossItemInLocation("DefeatLanmolas", "Desert Palace - Boss");
                $this->placeBossItemInLocation("DefeatMoldorm", "Tower Of Hera - Boss");
                $this->placeBossItemInLocation("DefeatHelmasaur", "Palace of Darkness - Boss");
                $this->placeBossItemInLocation("DefeatArrghus", "Swamp Palace - Boss");
                $this->placeBossItemInLocation("DefeatMothula", "Skull Woods - Boss");
                $this->placeBossItemInLocation("DefeatBlind", "Thieves' Town - Boss");
                $this->placeBossItemInLocation("DefeatKholdstare", "Ice Palace - Boss");
                $this->placeBossItemInLocation("DefeatVitreous", "Misery Mire - Boss");
                $this->placeBossItemInLocation("DefeatTrinexx", "Turtle Rock - Boss");
                $this->placeBossItemInLocation("DefeatArmos", "Ganon's Tower - Ice Armos");
                $this->placeBossItemInLocation("DefeatLanmolas", "Ganon's Tower - Lanmolas");
                $this->placeBossItemInLocation("DefeatMoldorm", "Ganon's Tower - Moldorm");
        }

        // since we added the bosses at this step we need to recache the
        // vertices.
        $this->world->remapVertices();
    }

    /**
     * Place Boss item in location.
     * 
     * @throws Exception If can't place boss in location
     * 
     * @param string $boss_item Boss item name
     * @param string $location Location name
     */
    private function placeBossItemInLocation(string $boss_item, string $location): void
    {
        $world_boss_item = $boss_item . ':' . $this->world->id;
        $from_location = self::BOSS_FROM_LOCATION[$location] . ':' . $this->world->id;
        $from = $this->world->graph->getVertex($from_location);
        $location = $location . ':' . $this->world->id;
        $to_boss = $this->world->graph->getVertex($location);

        if (!$from || !$to_boss) {
            Log::error("Can't place boss.", [$from_location, $from, $location, $to_boss]);

            throw new Exception("Can't place boss.");
        }

        $to_boss->setAttribute('enemizerBoss', array_search($boss_item, self::BOSS_ITEMS));
        $this->updateSprites($from, $boss_item);
        $this->world->graph->addDirected($from, $to_boss, [
            'group' => $world_boss_item,
            'graphviz.label' => $world_boss_item,
        ]);
    }

    private function updateSprites($bossRoom, $boss)
    {
        foreach ($this->boss_location_map[$bossRoom->getAttribute('name')][$boss] as $sprite_definition) {
            $this->world->graph->newVertex(array_merge(
                $sprite_definition,
                [
                    'type' => 'mob',
                    'sprite' => Sprite::get($sprite_definition['sprite']),
                ],
            ));
        }
    }
}
