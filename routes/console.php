<?php

use ALttP\Enemizer;
use ALttP\EntranceRandomizer;
use ALttP\Jobs\SendPatchToDisk;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\Support\WorldCollection;
use ALttP\World;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/**
 * This file is for one off console commands. Ideally all of these should be
 * properly coded into real commands if they stick around for a while.
 *
 * @todo convert all current commands here to classes
 */

if (!function_exists('getWeighted')) {
    function getWeighted(string $category): string
    {
        $keys = array_keys(config("alttp.randomizer.item.$category"));
        $combined = array_combine($keys, $keys);
        $weights = config("alttp.randomizer.daily_weights.$category");

        return head(weighted_random_pick($combined, $weights));
    }
}

Artisan::command('alttp:dailies {days=7}', function ($days) {
    for ($i = 0; $i < $days; ++$i) {
        $date = Carbon::now()->addDays($i);
        $feature = ALttP\FeaturedGame::firstOrNew([
            'day' => $date->toDateString(),
        ]);
        if (!$feature->exists) {
            $entry_crystals_ganon = getWeighted('ganon_open');
            $crystals_ganon = $entry_crystals_ganon === 'random' ? get_random_int(0, 7) : $entry_crystals_ganon;
            $entry_crystals_tower = getWeighted('tower_open');
            $crystals_tower = $entry_crystals_tower === 'random' ? get_random_int(0, 7) : $entry_crystals_tower;
            $logic = [
                'none' => 'NoGlitches',
                'overworld_glitches' => 'OverworldGlitches',
                'major_glitches' => 'MajorGlitches',
                'no_logic' => 'None',
            ][getWeighted('glitches_required')];

            $world = World::factory(getWeighted('world_state'), [
                'itemPlacement' => getWeighted('item_placement'),
                'dungeonItems' => getWeighted('dungeon_items'),
                'accessibility' => getWeighted('accessibility'),
                'goal' => getWeighted('goals'),
                'crystals.ganon' => $crystals_ganon,
                'crystals.tower' => $crystals_tower,
                'entrances' => getWeighted('entrance_shuffle'),
                'mode.weapons' => getWeighted('weapons'),
                'tournament' => true,
                'spoil.Hints' => getWeighted('hints'),
                'spoilers' => getWeighted('spoilers'),
                'logic' => $logic,
                'item.pool' => getWeighted('item_pool'),
                'item.functionality' => getWeighted('item_functionality'),
                'enemizer.bossShuffle' => getWeighted('boss_shuffle'),
                'enemizer.enemyShuffle' => getWeighted('enemy_shuffle'),
                'enemizer.enemyDamage' => getWeighted('enemy_damage'),
                'enemizer.enemyHealth' => getWeighted('enemy_health'),
                'enemizer.potShuffle' => false,
            ]);

            $rom = new Rom(config('alttp.base_rom'));
            $rom->applyPatchFile(Rom::getJsonPatchLocation());

            if ($world->config('entrances') !== 'none') {
                $rand = new EntranceRandomizer([$world]);
            } else {
                $rand = new Randomizer([$world]);
            }

            $rand->randomize();
            $world->writeToRom($rom, true);

            // E.R. is responsible for verifying winnability of itself
            if ($world->config('entrances') === 'none') {
                $worlds = new WorldCollection($rand->getWorlds());

                if (!$worlds->isWinnable()) {
                    throw new Exception('Game Unwinnable');
                }
            }

            $rom->setTournamentType('standard');

            $patch = $rom->getWriteLog();
            $spoiler = $world->getSpoiler([
                'name' => 'Daily Challenge: ' . $date->toFormattedDateString(),
                'entry_crystals_ganon' => $entry_crystals_ganon,
                'entry_crystals_tower' => $entry_crystals_tower,
                'worlds' => 1,
            ]);

            switch ($spoiler['meta']['spoilers']) {
                case "on":
                case "generate":
                    $spoiler = Arr::except($spoiler, [
                        'spoiler.playthrough',
                    ]);
                    break;
                case "mystery":
                    $spoiler = Arr::only($spoiler, ['meta']);
                    $spoiler['meta'] = Arr::only($spoiler['meta'], [
                        'name',
                        'notes',
                        'logic',
                        'build',
                        'tournament',
                        'spoilers',
                        'size'
                    ]);
                    break;
                case "off":
                default:
                    $spoiler = Arr::except(Arr::only($spoiler, [
                        'meta',
                    ]), ['meta.seed']);
            }

            if ($world->isEnemized()) {
                $en = new Enemizer($world, $patch);
                $en->randomize();
                $en->writeToRom($rom);
                $patch = $rom->getWriteLog();
                $world->updateSeedRecordPatch($patch);
            }

            $seed_record = $world->getSeedRecord();

            $feature->seed_id = $seed_record->id;
            $feature->description = vsprintf("%s %s %s", [
                $world->config('goal'),
                $world->config('mode.weapons'),
                $world->config('logic'),
            ]);
            $feature->save();

            $spoiler = Arr::except(
                Arr::only($spoiler, ['meta']),
                [
                    'meta.seed',
                    'meta.crystals_ganon',
                    'meta.crystals_tower'
                ]
            );

            $save_data = json_encode([
                'logic' => $world->config('logic'),
                'patch' => patch_merge_minify($patch),
                'spoiler' => $spoiler,
                'hash' => $seed_record->hash,
                'generated' => $seed_record->created_at ? $seed_record->created_at->toIso8601String() : now()->toIso8601String(),
                'size' => $spoiler['meta']['size'] ?? 2,
            ]);

            $seed_record->save();
            SendPatchToDisk::dispatch($seed_record);
            cache(['hash.' . $seed_record->hash => $save_data], now()->addDays(7));
        }
    }
});

Artisan::command('alttp:compressgfx {input} {output}', function ($input, $output) {
    if (!is_readable($input)) {
        return $this->error("Can't read file");
    }
    if (file_exists($output) && !is_writable($output) || !is_writable(dirname($output))) {
        return $this->error("Can't write file");
    }

    $lz2 = new ALttP\Support\Lz2();
    file_put_contents($output, pack('C*', ...$lz2->compress(array_values(unpack("C*", file_get_contents($input))))));

    $this->info(sprintf('Compressed: `%s` to `%s`', $input, $output));
});

Artisan::command('alttp:decompressgfx {input} {output}', function ($input, $output) {
    if (!is_readable($input)) {
        return $this->error("Can't read file");
    }
    if (file_exists($output) && !is_writable($output) || !is_writable(dirname($output))) {
        return $this->error("Can't write file");
    }

    $lz2 = new ALttP\Support\Lz2();
    file_put_contents($output, pack('C*', ...$lz2->decompress(array_values(unpack("C*", file_get_contents($input))))));

    $this->info(sprintf('Decompressed: `%s` to `%s`', $input, $output));
});

Artisan::command('alttp:sprpub', function () {
    foreach (Storage::disk('sprites')->allFiles('') as $file) {
        if (preg_match('/\.DS_Store$/', $file)) {
            continue;
        }
        if (preg_match('/\.gitignore$/', $file)) {
            continue;
        }
        if (Storage::disk('images')->exists($file)) {
            continue;
        }

        $this->info($file);
        Storage::disk('images')->put($file, Storage::disk('sprites')->get($file), [
            'headers' => [
                'Access-Control-Expose-Headers' => 'Access-Control-Allow-Origin',
                'Access-Control-Allow-Origin' => '*',
            ]
        ]);
    }
});
