<?php

use App\Http\Controllers\RandomizerController;
use App\Http\Requests\CreateRandomizedGame;
use Carbon\Carbon;
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
        $feature = App\Models\FeaturedGame::firstOrNew([
            'day' => $date->toDateString(),
        ]);
        if ($feature->exists) {
            continue;
        }

        $controller = new RandomizerController();
        $request = new CreateRandomizedGame();
        $request->merge([
            'crystals.ganon' => getWeighted('ganon_open'),
            'crystals.tower' => getWeighted('tower_open'),
            'glitches' => getWeighted('glitches_required'),
            'mode' => getWeighted('world_state'),
            'item_placement' => getWeighted('item_placement'),
            'dungeon_items' => getWeighted('dungeon_items'),
            'accessibility' => getWeighted('accessibility'),
            'goal' => getWeighted('goals'),
            'entrances' => getWeighted('entrance_shuffle'),
            'weapons' => getWeighted('weapons'),
            'hints' => getWeighted('hints'),
            'item.pool' => getWeighted('item_pool'),
            'item.functionality' => getWeighted('item_functionality'),
            'entrances' => 'none',
            'enemizer.boss_shuffle' => getWeighted('boss_shuffle'),
            'enemizer.enemy_shuffle' => getWeighted('enemy_shuffle'),
            'enemizer.enemy_damage' => getWeighted('enemy_damage'),
            'enemizer.enemy_health' => getWeighted('enemy_health'),
            'spoilers' => getWeighted('spoilers'),
            'tournament' => true,
            'allow_quickswap' => true,
            'featured' => $feature,
            'name' => 'Daily Challenge: ' . $date->toFormattedDateString(),
        ]);

        $controller->generateSeed($request);
    }
});

Artisan::command('alttp:compressgfx {input} {output}', function ($input, $output) {
    if (!is_readable($input)) {
        return $this->error("Can't read file");
    }
    if (file_exists($output) && !is_writable($output) || !is_writable(dirname($output))) {
        return $this->error("Can't write file");
    }

    $lz2 = new App\Support\Lz2();
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

    $lz2 = new App\Support\Lz2();
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
        if (preg_match('/link\.1\.zspr$/', $file)) {
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
