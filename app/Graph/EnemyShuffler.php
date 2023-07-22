<?php

declare(strict_types=1);

namespace App\Graph;

use App\Sprite;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Yaml;

/**
 * Modify the edges of the graph to shuffle entrances.
 */
final class EnemyShuffler
{
    const CHALLENGE_ROOMS = [
        "Mini Moldorm Cave Entrance" => [
            "Mini Moldorm Cave - Mini Moldorm 1",
            "Mini Moldorm Cave - Mini Moldorm 2",
            "Mini Moldorm Cave - Mini Moldorm 3",
            "Mini Moldorm Cave - Mini Moldorm 4",
        ],
        "Turtle Rock - Bomb Ambush" => [
            "Turtle Rock - Bomb Ambush - Zol 1",
            "Turtle Rock - Bomb Ambush - Zol 2",
            "Turtle Rock - Bomb Ambush - Zol 3",
        ],
        "Palace of Darkness - Turtle Party" => [
            "Palace of Darkness - Turtle Party - Terrorpin TR",
            "Palace of Darkness - Turtle Party - Terrorpin TL",
            "Palace of Darkness - Turtle Party - Terrorpin R",
            "Palace of Darkness - Turtle Party - Terrorpin L",
            "Palace of Darkness - Turtle Party - Terrorpin BR",
            "Palace of Darkness - Turtle Party - Terrorpin BL",
        ],
        "Ice Palace - Entrance" => [
            "Ice Palace - Entrance - Freezor",
        ],
        "Ice Palace - Bari Key" => [
            "Ice Palace - Bari Key - Top Bari",
            "Ice Palace - Bari Key - Middle Bari",
            "Ice Palace - Bari Key - Bottom Bari",
        ],
        "Palace of Darkness - Mimics 2" => [
            "Palace of Darkness - Mimics 2 - Red Eyegore",
            "Palace of Darkness - Mimics 2 - Green Eyegore L",
            "Palace of Darkness - Mimics 2 - Green Eyegore R",
        ],
        // "Ganon's Tower - Ice Armos" // covered by boss shuffle code for now.
        "Turtle Rock - Pokeys 2" => [
            "Turtle Rock - Pokeys 2 - Pokey 1",
            "Turtle Rock - Pokeys 2 - Pokey 2",
            "Turtle Rock - Pokeys 2 - Medusa 3",
        ],
        "Tower Of Hera - Beetle Gate" => [
            "Tower Of Hera - Beetle Gate - Hardhat Beetle R",
            "Tower Of Hera - Beetle Gate - Hardhat Beetle L",
            "Tower Of Hera - Beetle Gate - Hardhat Beetle B",
        ],
        "Ice Palace - Stalfos Ambush" => [
            "Ice Palace - Stalfos Ambush - Stalfos Knight T",
            "Ice Palace - Stalfos Ambush - Stalfos Knight B",
        ],
        "Thieves' Town - Basement Block Totems" => [
            "Thieves' Town - Basement Block Totems - Red Zazak",
            "Thieves' Town - Basement Block Totems - Blue Zazak",
            "Thieves' Town - Basement Block Totems - Stalfos",
        ],
        "Palace of Darkness - Mimics 1" => [
            "Palace of Darkness - Mimics 1 - Red Eyegore",
            "Palace of Darkness - Mimics 1 - Green Eyegore L",
            "Palace of Darkness - Mimics 1 - Green Eyegore R",
        ],
        "Desert Palace - Popo Genocide" => [
            "Desert Palace - Popo Genocide - Beamos",
            "Desert Palace - Popo Genocide - Popo TR",
            "Desert Palace - Popo Genocide - Popo TL",
            "Desert Palace - Popo Genocide - Popo BR",
            "Desert Palace - Popo Genocide - Popo BL",
        ],
        "Ganon's Tower - Mimics 1" => [
            "Ganon's Tower - Mimics 1 - Statue",
            "Ganon's Tower - Mimics 1 - Red Eyegore 2",
            "Ganon's Tower - Mimics 1 - Spike Trap 1",
            "Ganon's Tower - Mimics 1 - Spike Trap 2",
            "Ganon's Tower - Mimics 1 - Red Eyegore 3",
        ],
        "Ganon's Tower - Mimics 2" => [
            "Ganon's Tower - Mimics 2 - Red Eyegore T",
            "Ganon's Tower - Mimics 2 - Beamos TR",
            "Ganon's Tower - Mimics 2 - Beamos BL",
            "Ganon's Tower - Mimics 2 - Red Eyegore B",
        ],
        "Ganon's Tower - Gauntlet 1" => [
            "Ganon's Tower - Gauntlet 1 - Red Zazak",
            "Ganon's Tower - Gauntlet 1 - Stalfos L",
            "Ganon's Tower - Gauntlet 1 - Blue Zazak",
            "Ganon's Tower - Gauntlet 1 - Stalfos R",
        ],
        "Ganon's Tower - Gauntlet 2" => [
            "Ganon's Tower - Gauntlet 2 - Beamos",
            "Ganon's Tower - Gauntlet 2 - Stalfos T",
            "Ganon's Tower - Gauntlet 2 - Stalfos L",
            "Ganon's Tower - Gauntlet 2 - Stalfos B",
        ],
        "Ganon's Tower - Gauntlet 3" => [
            "Ganon's Tower - Gauntlet 3 - Beamos TL",
            "Ganon's Tower - Gauntlet 3 - Blue Zazak TR",
            "Ganon's Tower - Gauntlet 3 - Blue Zazak BL",
            "Ganon's Tower - Gauntlet 3 - Blue Zazak B",
            "Ganon's Tower - Gauntlet 3 - Beamos BR",
        ],
        "Ganon's Tower - Gauntlet 4" => [
            "Ganon's Tower - Gauntlet 4 - Red Zazak TL",
            "Ganon's Tower - Gauntlet 4 - Beamos TR",
            "Ganon's Tower - Gauntlet 4 - Beamos BL",
            "Ganon's Tower - Gauntlet 4 - Red Zazak BR",
        ],
        "Ganon's Tower - Gauntlet 5" => [
            "Ganon's Tower - Gauntlet 5 - Medusa",
            "Ganon's Tower - Gauntlet 5 - Beamos",
            "Ganon's Tower - Gauntlet 5 - Stalfos",
            "Ganon's Tower - Gauntlet 5 - Red Zazak",
            "Ganon's Tower - Gauntlet 5 - Spark",
        ],
        // "Ganon's Tower - Lanmolas" // covered by boss shuffle code for now.
        "Ice Palace - Penguin Line Up" => [
            "Ice Palace - Penguin Line Up - Pengator 1",
            "Ice Palace - Penguin Line Up - Pengator 2",
            "Ice Palace - Penguin Line Up - Pengator 3",
            "Ice Palace - Penguin Line Up - Pengator 4",
            "Ice Palace - Penguin Line Up - Pengator 5",
        ],
        "Hyrule Castle - Basement Trap" => [
            "Hyrule Castle - Basement Trap - Green Guard"
        ],
        "Hyrule Castle - Basement Statue Trap" => [
            "Hyrule Castle - Basement Statue Trap - Guard Key",
        ],
        // skipping room 0x75 (someone else can impl)
        // skipping room 0x7b (someone else can impl)
        // skipping room 0x7d (someone else can impl)
        // skipping room 0x7e (freezor room chest)
        "Desert Palace - Compass Room" => [
            "Desert Palace - Compass Room - Popo TL",
            "Desert Palace - Compass Room - Popo TR",
            "Desert Palace - Compass Room - Popo BL",
            "Desert Palace - Compass Room - Beamos",
        ],
        "Ganon's Tower - Tile Room" => [ // chest
            "Ganon's Tower - Tile Room - Tiles",
            "Ganon's Tower - Tile Room - Yomo Medusa T",
            "Ganon's Tower - Tile Room - Antifairy",
            "Ganon's Tower - Tile Room - Bunny Beam",
            "Ganon's Tower - Tile Room - Yomo Medusa B",
            "Ganon's Tower - Tile Room - Wallmaster",
        ],
        "Ganon's Tower - Wizzrobes 1" => [
            "Ganon's Tower - Wizzrobes 1 - Wizzrobe TL",
            "Ganon's Tower - Wizzrobes 1 - Wizzrobe TR",
            "Ganon's Tower - Wizzrobes 1 - Wizzrobe B",
        ],
        "Ganon's Tower - Wizzrobes 2" => [
            "Ganon's Tower - Wizzrobes 2 - Wizzrobe TL",
            "Ganon's Tower - Wizzrobes 2 - Wizzrobe TR",
            "Ganon's Tower - Wizzrobes 2 - Spike Trap",
            "Ganon's Tower - Wizzrobes 2 - Wizzrobe BL",
            "Ganon's Tower - Wizzrobes 2 - Wizzrobe BR",
        ],
        "Eastern Palace - West Wing - Stalfos Ambush" => [
            "Eastern Palace - West Wing - Stalfos Ambush - Stalfos Party",
        ],
        "Agahnims Tower - Circle of Pots" => [
            "Agahnims Tower - Circle of Pots - Keese TL",
            "Agahnims Tower - Circle of Pots - Keese TR",
            "Agahnims Tower - Circle of Pots - Red Spear Guard C",
            "Agahnims Tower - Circle of Pots - Red Spear Guard TR",
        ],
        "Agahnims Tower - Guards" => [
            "Agahnims Tower - Guards - Red Spear Guard B",
            "Agahnims Tower - Guards - Red Spear Guard C",
        ],
        "Agahnims Tower - Throwing Guards" => [
            "Agahnims Tower - Throwing Guards - Keese L",
            "Agahnims Tower - Throwing Guards - Keese R",
            "Agahnims Tower - Throwing Guards - Red Javelin Guard L",
            "Agahnims Tower - Throwing Guards - Red Javelin Guard R",
        ],
        "Misery Mire - Sluggula Cross" => [
            "Misery Mire - Sluggula Cross - Sluggula TL",
            "Misery Mire - Sluggula Cross - Sluggula TR",
            "Misery Mire - Sluggula Cross - Antifairy",
            "Misery Mire - Sluggula Cross - Sluggula BL",
            "Misery Mire - Sluggula Cross - Sluggula BR",
        ],
        // skipping room 0xb6 (someone else can impl tile room)
        // skipping 0xb8 (antifairy circle on pot, need to consider further)
        "Agahnims Tower - Dark Key Guards" => [
            "Agahnims Tower - Dark Key Guards - Blue Guard",
            "Agahnims Tower - Dark Key Guards - Blue Archer R",
            "Agahnims Tower - Dark Key Guards - Blue Archer L",
        ],
        "Misery Mire - Mire 2" => [
            "Misery Mire - Mire 2 - Wizzrobe T",
            "Misery Mire - Mire 2 - Popo TR",
            "Misery Mire - Mire 2 - Wizzrobe TL",
            "Misery Mire - Mire 2 - Wizzrobe TR",
            "Misery Mire - Mire 2 - Beamos",
            "Misery Mire - Mire 2 - Popo C",
            "Misery Mire - Mire 2 - Popo L",
            "Misery Mire - Mire 2 - Wizzrobe B",
            "Misery Mire - Mire 2 - Popo BL",
            "Misery Mire - Mire 2 - Popo BR",
        ],
        "Eastern Palace - Kill Room 1" => [
            "Eastern Palace - Kill Room 1 - Red Eyegore",
            "Eastern Palace - Kill Room 1 - Stalfos T",
            "Eastern Palace - Kill Room 1 - Stalfos B",
        ],
        "Eastern Palace - Kill Room 2" => [
            "Eastern Palace - Kill Room 2 - Red Eyegore L",
            "Eastern Palace - Kill Room 2 - Red Eyegore R",
            "Eastern Palace - Kill Room 2 - Popo B TL",
            "Eastern Palace - Kill Room 2 - Popo B TR",
            "Eastern Palace - Kill Room 2 - Popo B LT",
            "Eastern Palace - Kill Room 2 - Popo B RT",
            "Eastern Palace - Kill Room 2 - Popo LB",
            "Eastern Palace - Kill Room 2 - Popo RB",
        ],
        "Agahnims Tower - Chain Guards" => [
            "Agahnims Tower - Chain Guards - Ball 'n' Chain Guard L",
            "Agahnims Tower - Chain Guards - Ball 'n' Chain Guard R",
        ],
        "Agahnims Tower - Knife Guards" => [
            "Agahnims Tower - Knife Guards - Charging Blue Guard T",
            "Agahnims Tower - Knife Guards - Charging Blue Guard B",
        ],
        "Swamp Palace - Entrance Ledge" => [
            "Swamp Palace - Entrance Ledge - Kyameron",
            "Swamp Palace - Entrance Ledge - Hover 1",
            "Swamp Palace - Entrance Ledge - Hover 2",
            "Swamp Palace - Entrance Ledge - Hover 3",
            "Swamp Palace - Entrance Ledge - Spike Trap",
        ],
        "Mimic Cave Entrance" => [
            "Mimic Cave Entrance - Green Eyegore TL",
            "Mimic Cave Entrance - Green Eyegore TR",
            "Mimic Cave Entrance - Green Eyegore CR",
            "Mimic Cave Entrance - Green Eyegore BR",
        ],
    ];
    const PIT_ROOMS = [
        0x01,
    ];
    const TONGUE_ROOMS = [
        0x0004,
        0x00CE,
        0x003F,
    ];

    // remove this and use the same alg for UW enemies
    const OW_MAP_SHEETS = [
        0x02 => [0x0F, null, 0x4A, null],
        0x03 => [null, null, 0x12, 0x10],
        0x14 => [0x0E, null, null, null],
        0x18 => [0x4F, 0x49, 0x4A, 0x50],
        0x1B => [null, null, null, 0x1D],
        0x30 => [null, null, 0x12, null],
        0x3A => [null, null, null, 0x11], // this should be handled?
        0x4F => [null, null, 0x18, null],
        0x5E => [null, null, null, 0x19],
    ];

    private readonly array $defeats;
    private readonly array $challenge_enemies;
    private readonly array $no_place_sprites;

    /**
     * Add all the vertices to the graph for this region.
     * 
     * 1) Rearrange all the sprite sheet sets
     * 2) find out which sprites can be placed with each set now
     * 3) pick a random sheet for a room
     * 4) pick random sprites for room
     *
     * @param World $world world to reduce graph for
     *
     * @return void
     */
    public function __construct(private World $world)
    {
        $this->defeats = Yaml::parse(file_get_contents(app_path('Graph/data/Enemizer/enemies.yml'))) ?? [];
        $this->challenge_enemies = Yaml::parse(file_get_contents(app_path('Graph/data/Enemizer/challenge.yml'))) ?? [];
        $this->no_place_sprites = Yaml::parse(file_get_contents(app_path('Graph/data/Enemizer/noplace.yml'))) ?? [];

        $world_id = $this->world->id;
        foreach (array_keys($this->defeats) as $token) {
            $this->world->graph->newVertex([
                'name' => "$token:$world_id",
                'type' => 'meta',
                'item' => Item::get($token, $world_id),
            ]);
        }

        $enemies = $world->getLocationsOfType('mob');

        /** @var array $enemy_rooms */
        $enemy_rooms = $enemies->groupBy(fn ($enemy) => $enemy->roomid);
        /** @var array $enemy_ows */
        $enemy_ows = $enemies->groupBy(fn ($enemy) => $enemy->map);

        // Set up sprite sheets
        $sheetable_sprites = Sprite::all()->filter(
            fn ($s) => count(array_filter($s->sheets, fn ($v) => $v !== null)) !== 0
        );
        // sprites that can be moved to any room as they don't have any sheet
        // requirements
        $nosheet_sprites = Sprite::all()->filter(
            fn ($s) => count(array_filter($s->sheets, fn ($v) => $v !== null)) === 0
                && !in_array($s->name, $this->no_place_sprites)
        )->all();

        $sheet_sets = array_fill(0, 124, [null, null, null, null]);
        $sheets_to_sprites = array_fill(0, 124, $nosheet_sprites);

        $room_sheets = [];
        $ow_sheets = [];

        // deal with OW required sheet sets ($j carries over to next block, it's
        // important for filling the array properly)
        $j = 0;
        foreach (self::OW_MAP_SHEETS as $map => $ow_set) {
            $ow_sheets[$map] = $j;
            $sheet_sets[$j] = $ow_set;
            $j++;
        }

        if ($world->config('enemizer.enemyShuffle') === 'none') {
            for ($i = 0; $i < 0x80; $i++) {
                if (!isset($enemy_ows[$i]) || count($enemy_ows[$i]) === 0) {
                    $ow_sheets[$i] = 0xFF;
                    continue;
                }
                if (!isset($ow_sheets[$i])) {
                    $fixed_set = [];
                    $enemies = $enemy_ows[$i]->map(fn ($e) => $e->sprite)->all();
                    foreach ($enemies as $sprite) {
                        $filtered_sprite = array_filter($sprite->sheets, fn ($v) => $v !== null);
                        $filtered_set = array_filter($fixed_set, fn ($v) => $v !== null);
                        $fixed_set = array_replace([null, null, null, null], $filtered_set, $filtered_sprite);
                    }
                    if (empty(array_filter($fixed_set, fn ($v) => $v !== null))) {
                        continue;
                    }
                    for ($k = 0; $k < $j; ++$k) {
                        if (
                            ($fixed_set[0] === null || $sheet_sets[$k][0] === $fixed_set[0])
                            && ($fixed_set[1] === null || $sheet_sets[$k][1] === $fixed_set[1])
                            && ($fixed_set[2] === null || $sheet_sets[$k][2] === $fixed_set[2])
                            && ($fixed_set[3] === null || $sheet_sets[$k][3] === $fixed_set[3])
                        ) {
                            $ow_sheets[$i] = $k;
                            continue 2;
                        }
                    }
                    $sheet_sets[$j] = $fixed_set;
                    $ow_sheets[$i] = $j;
                    ++$j;
                }
            }
        }

        // force fixed room sets! If we have a few "no move" sprites in a room
        // we need to guarantee that a sheet set exists for that room to look
        // correct.
        for ($i = 0; $i < 0x180; $i++) {
            if (!isset($enemy_rooms[$i]) || count($enemy_rooms[$i]) === 0) {
                continue;
            }
            $filtered = $enemy_rooms[$i]->filter(
                fn ($e) => $world->config('enemizer.enemyShuffle') === 'none'
                    || in_array($e->sprite->name, $this->no_place_sprites)
            );
            if (count($filtered) === 0) {
                continue;
            }
            $fixed_set = [];
            $enemies = $filtered->map(fn ($e) => $e->sprite)->all();
            foreach ($enemies as $sprite) {
                $filtered_sprite = array_filter($sprite->sheets, fn ($v) => $v !== null);
                $filtered_set = array_filter($fixed_set, fn ($v) => $v !== null);
                $fixed_set = array_replace([null, null, null, null], $filtered_set, $filtered_sprite);
            }
            if (empty(array_filter($fixed_set, fn ($v) => $v !== null))) {
                continue;
            }
            // potential bug here where fixed set is full, we may end up making 2+ copies in table
            if ($world->config('enemizer.enemyShuffle') === 'none' || get_random_int(0, 1)) {
                for ($k = 0; $k < $j; ++$k) {
                    if (
                        ($fixed_set[0] === null || $sheet_sets[$k][0] === $fixed_set[0])
                        && ($fixed_set[1] === null || $sheet_sets[$k][1] === $fixed_set[1])
                        && ($fixed_set[2] === null || $sheet_sets[$k][2] === $fixed_set[2])
                        && ($fixed_set[3] === null || $sheet_sets[$k][3] === $fixed_set[3])
                    ) {
                        $room_sheets[$i] = $k;
                        continue 2;
                    }
                }
            }
            $sheet_sets[$j] = $fixed_set;
            $room_sheets[$i] = $j;
            ++$j;
        }

        // fill in all sheet sets with valid layouts for sprites
        for ($i = 0; $i < 124; ++$i) {
            while (in_array(null, $sheet_sets[$i], true)) {
                $sprite = $sheetable_sprites->random();
                if (
                    ($sprite->sheets[0] === null || $sheet_sets[$i][0] === null)
                    && ($sprite->sheets[1] === null || $sheet_sets[$i][1] === null)
                    && ($sprite->sheets[2] === null || $sheet_sets[$i][2] === null)
                    && ($sprite->sheets[3] === null || $sheet_sets[$i][3] === null)
                ) {
                    $filtered_sprite = array_filter($sprite->sheets, fn ($v) => $v !== null);
                    $filtered_set = array_filter($sheet_sets[$i], fn ($v) => $v !== null);
                    $sheet_sets[$i] = array_replace([null, null, null, null], $filtered_set, $filtered_sprite);
                }
            }
        }

        // find all the sprites that can be placed validly with a particular sheet set.
        foreach ($sheetable_sprites as $sprite) {
            foreach ($sheet_sets as $i => $set) {
                if (
                    $world->config('enemizer.enemyShuffle') !== 'none'
                    && ($sprite->sheets[0] === null || $set[0] === $sprite->sheets[0])
                    && ($sprite->sheets[1] === null || $set[1] === $sprite->sheets[1])
                    && ($sprite->sheets[2] === null || $set[2] === $sprite->sheets[2])
                    && ($sprite->sheets[3] === null || $set[3] === $sprite->sheets[3])
                    && !in_array($sprite->name, $this->no_place_sprites)
                ) {
                    $sheets_to_sprites[$i][$sprite->name] = $sprite;
                }
            }
        }

        $all_challenge_enemies = array_map(fn ($e) => "$e:{$this->world->id}", Arr::flatten(self::CHALLENGE_ROOMS));
        for ($i = 0; $i < 0x180; $i++) {
            if (!isset($enemy_rooms[$i]) || count($enemy_rooms[$i]) === 0) {
                $room_sheets[$i] = 0x00;
                continue;
            }
            if (!isset($room_sheets[$i])) {
                do {
                    $sheet = get_random_key($sheets_to_sprites);
                } while (count($sheets_to_sprites[$sheet]) === 0);
                $room_sheets[$i] = $sheet;
            }
            $sheet = $room_sheets[$i];
            $filtered_placable = $enemy_rooms[$i]->filter(
                fn ($e) => $world->config('enemizer.enemyShuffle') !== 'none'
                    && !in_array($e->sprite->name, $this->no_place_sprites)
            );
            if (count($filtered_placable) === 0) {
                continue;
            }
            foreach ($filtered_placable as $enemy) {
                if (in_array($enemy->name, $all_challenge_enemies)) {
                    $new = get_random_element(array_filter(
                        $sheets_to_sprites[$sheet],
                        fn ($sprite) => in_array($sprite->name, $this->challenge_enemies)
                    ));
                    if (!$new) {
                        throw new Exception('ugh');
                    }
                } else {
                    $new = get_random_element($sheets_to_sprites[$sheet]);
                }
                Log::debug(vsprintf('%s: placing %s', [
                    $enemy->name,
                    $new->getNiceName(),
                ]));
                $enemy->sprite = $new;
            }
        }

        for ($i = 0; $i < 0x80; $i++) {
            if (!isset($enemy_ows[$i]) || count($enemy_ows[$i]) === 0) {
                $ow_sheets[$i] = 0xFF;
                continue;
            }
            if (!isset($ow_sheets[$i])) {
                do {
                    $sheet = get_random_key($sheets_to_sprites);
                } while (count($sheets_to_sprites[$sheet]) === 0);
                $ow_sheets[$i] = $sheet;
            }
            $sheet = $ow_sheets[$i];
            $filtered_placable = $enemy_ows[$i]->filter(
                fn ($e) => $world->config('enemizer.enemyShuffle') !== 'none'
                    && !in_array($e->sprite->name, $this->no_place_sprites)
            );
            if (count($filtered_placable) === 0) {
                continue;
            }
            foreach ($filtered_placable as $enemy) {
                $new = get_random_element($sheets_to_sprites[$sheet]);
                Log::debug(vsprintf('%s: placing %s', [
                    $enemy->name,
                    $new->getNiceName(),
                ]));
                $enemy->sprite = $new;
            }
        }
        ksort($ow_sheets);
        $ow_sheets = array_merge(
            array_slice($ow_sheets, 0, 0x40),
            array_slice($ow_sheets, 0, 0x40),
            array_slice($ow_sheets, 0, 0x40),
            array_slice($ow_sheets, 0x40, 0x80),
        );

        // pick random sheets where we have options
        $sheet_sets = array_map(
            fn ($set) => array_map(
                fn ($sheet) => is_array($sheet) ? get_random_element($sheet) : $sheet,
                $set
            ),
            $sheet_sets
        );

        $world->sprite_sheets = [
            'underworld' => array_map(fn ($s) => $s - 0x40, $room_sheets),
            'overworld' => $ow_sheets,
            'sets' => $sheet_sets,
        ];
    }

    /**
     * Swap Edges based on new enemy locations settings.
     * 
     * @todo is this going to have a problem with the BunnyGraphifier??
     */
    public function adjustEdges(): void
    {
        $from = $this->world->getLocation('Meta');
        $world_id = $this->world->id;
        foreach ($this->defeats as $token => $items) {
            $to = $this->world->graph->getVertex($token . ":$world_id");
            foreach ($items as $item) {
                $this->world->graph->addDirected($from, $to, "$item:$world_id");
            }
        }

        foreach (self::CHALLENGE_ROOMS as $room => $enemies) {
            $from = $this->world->getLocation($room);
            foreach ($enemies as $enemy) {
                $to = $this->world->getLocation($enemy);
                if (!$to) {
                    dd([$enemy, $to]);
                }
                $take = 'Defeat' . $to->sprite->name . ":$world_id";
                $this->world->graph->addDirected($from, $to, $take);
            }
        }
    }
}
