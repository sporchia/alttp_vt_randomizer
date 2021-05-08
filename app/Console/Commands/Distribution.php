<?php

namespace ALttP\Console\Commands;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Randomizer;
use ALttP\Services\PlaythroughService;
use ALttP\World;
use Illuminate\Console\Command;

class Distribution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alttp:distribution {type} {thing} {iterations=1}'
        . ' {--goal=ganon : set game goal}'
        . ' {--state=standard : set game state}'
        . ' {--weapons=randomized : set weapons mode}'
        . ' {--glitches=none : set glitches}'
        . ' {--crystals_ganon=7 : set ganon crystal requirement}'
        . ' {--crystals_tower=7 : set ganon tower crystal requirement}'
        . ' {--item_placement=advanced : set item placement rules}'
        . ' {--dungeon_items=standard : set dungeon item placement}'
        . ' {--accessibility=item : set item/location accessibility}'
        . ' {--hints=off : set hints on or off}'
        . ' {--item_pool=normal : set item pool}'
        . ' {--item_functionality=normal : set item functionality}'
        . ' {--csv= : file to write to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get pool distrobution of a thing over X random iterations.';

    /** @var string */
    private $state;
    /** @var array */
    private $options;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $logic = [
            'none' => 'NoGlitches',
            'overworld_glitches' => 'OverworldGlitches',
            'major_glitches' => 'MajorGlitches',
            'no_logic' => 'NoLogic',
        ][$this->option('glitches')];

        $this->state = $this->option('state');
        $this->options = [
            'itemPlacement' => $this->option('item_placement'),
            'dungeonItems' => $this->option('dungeon_items'),
            'accessibility' => $this->option('accessibility'),
            'goal' => $this->option('goal'),
            'crystals.ganon' => $this->option('crystals_ganon'),
            'crystals.tower' => $this->option('crystals_tower'),
            'entrances' => 'none',
            'mode.weapons' => $this->option('weapons'),
            'tournament' => false,
            'spoil.Hints' => $this->option('hints'),
            'logic' => $logic,
            'item.pool' => $this->option('item_pool'),
            'item.functionality' => $this->option('item_functionality'),
            'enemizer.bossShuffle' => 'none',
            'enemizer.enemyShuffle' => 'none',
            'enemizer.enemyDamage' => 'default',
            'enemizer.enemyHealth' => 'default',
            'enemizer.potShuffle' => 'off',
        ];

        $locations = [];
        switch ($this->argument('type')) {
            case 'item':
                $function = [$this, 'item'];
                if (!is_string($this->argument('thing'))) {
                    $this->error("Need an Item Name");
                    return 1;
                }
                $thing = $this->argument('thing');
                break;
            case 'location':
                $function = [$this, 'location'];
                if (!$this->argument('thing')) {
                    $this->error("Need an Location Name");
                    return 2;
                }
                $thing = $this->argument('thing');
                break;
            case 'location_ordered':
                $function = [$this, 'location_ordered'];
                if (!$this->argument('thing')) {
                    $this->error("Need an Location Name");
                    return 2;
                }
                $thing = $this->argument('thing');
                break;
            case 'region':
                $function = [$this, 'region'];
                if (!$this->argument('thing')) {
                    $this->error("Need an Region Name");
                    return 3;
                }
                $thing = $this->argument('thing');
                break;
            case 'required':
                $function = [$this, 'required'];
                $thing = $this->argument('thing');
                break;
            case 'required_ordered':
                $function = [$this, 'required_ordered'];
                $thing = $this->argument('thing');
                break;
            case 'full':
                $function = [$this, 'full'];
                $thing = $this->argument('thing');
                break;
            case 'full_ordered':
                $function = [$this, 'full_ordered'];
                $thing = $this->argument('thing');
                break;
            default:
                $this->error('Invalid distribution');
                return 4;
        }

        $iterations = min((int) $this->argument('iterations'), 1);

        if ($this->option('verbose') && is_numeric($iterations)) {
            $bar = $this->output->createProgressBar($iterations);
        }

        for ($i = 0; $i < $iterations; $i++) {
            Item::clearCache();
            Boss::clearCache();
            if (!is_callable($function)) {
                continue;
            }
            call_user_func_array($function, [$thing, &$locations]);
            if (isset($bar)) {
                $bar->advance();
            }
        }

        if (isset($bar)) {
            $bar->finish();
        }

        if ($this->option('csv') && is_string($this->option('csv'))) {
            $locations = static::_assureColumnsExist($locations);
            ksortr($locations);
            $out = fopen($this->option('csv'), 'w');
            if ($out === false) {
                $this->error('Could not open csv file');

                return 5;
            }
            fputcsv($out, array_merge(['location'], array_keys(reset($locations))));
            foreach ($locations as $name => $location) {
                fputcsv($out, array_merge([$name], $location));
            }
            fclose($out);
        } else {
            ksortr($locations);
            $json = json_encode($locations, JSON_PRETTY_PRINT);
            if ($json !== false) {
                $this->info($json);
            }
        }
    }

    public static function _assureColumnsExist($array): array
    {
        $keys = [];
        foreach ($array as $part) {
            $keys = array_merge($keys, array_keys($part));
        }
        $keys = array_unique($keys);
        foreach ($array as $k => $part) {
            foreach ($keys as $key) {
                if (!isset($part[$key])) {
                    $array[$k][$key] = 0;
                }
            }
        }
        return $array;
    }

    private function item($item_name, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();
        $item = Item::get($item_name, $world);

        foreach ($world->getLocationsWithItem($item) as $location) {
            if (!isset($locations[(string) $location])) {
                $locations[(string) $location] = 0;
            }
            $locations[(string) $location]++;
        }
    }

    private function location($location_name, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        $item = $world->getLocation($location_name)->getItem();

        if ($item === null) {
            return;
        }

        $item_name = $item->getNiceName();

        if (!isset($locations[$location_name][$item_name])) {
            $locations[$location_name][$item_name] = 0;
        }
        $locations[$location_name][$item_name]++;
    }

    private function location_ordered($location_name, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        $item = $world->getLocation($location_name)->getItem();

        if ($item === null) {
            return;
        }

        $item_name = $item->getNiceName();

        $locations[$location_name][] = $item_name;
    }

    private function region($region_name, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        $region = $world->getRegion($region_name);

        foreach ($region->getLocations() as $location) {
            $location_name = (string) $location;
            $item_name = $location->getItem()->getNiceName();
            if (!isset($locations[$location_name][$item_name])) {
                $locations[$location_name][$item_name] = 0;
            }
            $locations[$location_name][$item_name]++;
        }
    }

    private function required($unused, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        $required_locations = (new PlaythroughService)->getPlayThrough($world, false);
        foreach ($required_locations as $location) {
            $location_name = (string) $location;
            $item = $location->getItem();
            if (!$item) {
                continue;
            }

            $item_name = $item->getNiceName();

            if (!isset($locations[$location_name][$item_name])) {
                $locations[$location_name][$item_name] = 0;
            }
            $locations[$location_name][$item_name]++;
        }
    }

    private function required_ordered($unused, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        $required_locations = (new PlaythroughService)->getPlayThrough($world, false);
        $required_locations_names = array_map(function ($location) {
            return (string) $location;
        }, $required_locations);

        foreach ($world->getCollectableLocations() as $location) {
            $location_name = (string) $location;
            if (!in_array($location_name, $required_locations_names) || strpos($location->getItem()->getName(), 'Key') !== false) {
                $locations[$location_name][] = '';
                continue;
            }

            $locations[$location_name][] = $location->getItem()->getNiceName();
        }
    }

    private function full($unused, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        foreach ($world->getLocations() as $location) {
            $location_name = (string) $location;
            $item = $location->getItem();
            if (!$item) {
                continue;
            }

            $item_name = $item->getNiceName();

            if (!isset($locations[$location_name][$item_name])) {
                $locations[$location_name][$item_name] = 0;
            }
            $locations[$location_name][$item_name]++;
        }
    }

    private function full_ordered($unused, &$locations)
    {
        $world = World::factory($this->state, $this->options);
        $rand = new Randomizer([$world]);
        $rand->randomize();

        foreach ($world->getLocations() as $location) {
            $location_name = (string) $location;
            $item = $location->getItem();
            if (!$item) {
                continue;
            }

            $locations[$location_name][] = $item->getNiceName();
        }
    }
}
