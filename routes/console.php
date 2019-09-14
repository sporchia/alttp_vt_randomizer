<?php

use ALttP\Console\Commands\Distribution;
use ALttP\Enemizer;
use ALttP\EntranceRandomizer;
use ALttP\Jobs\SendPatchToDisk;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\Sprite;
use ALttP\Support\WorldCollection;
use ALttP\Support\Zspr;
use ALttP\World;
use Carbon\Carbon;

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
                'logic' => getWeighted('glitches_required'),
                'item.pool' => getWeighted('item_pool'),
                'item.functionality' => getWeighted('item_functionality'),
                'enemizer.bossShuffle' => getWeighted('boss_shuffle'),
                'enemizer.enemyShuffle' => getWeighted('enemy_shuffle'),
                'enemizer.enemyDamage' => getWeighted('enemy_damage'),
                'enemizer.enemyHealth' => getWeighted('enemy_health'),
            ]);

            $rom = new Rom(env('ENEMIZER_BASE', null));
            $rom->applyPatchFile(public_path('js/base2current.json'));

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

            $patch = $rom->getWriteLog();
            $spoiler = $world->getSpoiler([
                'name' => 'Daily Challenge: ' . $date->toFormattedDateString(),
                'entry_crystals_ganon' => $entry_crystals_ganon,
                'entry_crystals_tower' => $entry_crystals_tower,
                'worlds' => 1,
                'spoilers' => false,
            ]);

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

            $spoiler = array_except(
                array_only($spoiler, ['meta']),
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

Artisan::command('alttp:romtospr {rom} {output}', function ($rom, $output) {
    if (filesize($rom) == 1048576 || filesize($rom) == 2097152) {
        file_put_contents($output, file_get_contents($rom, false, null, 0x80000, 0x7000)
            . file_get_contents($rom, false, null, 0xDD308, 120));
    }
});

Artisan::command('alttp:sprtopng {sprites}', function ($sprites) {
    if (is_dir($sprites)) {
        $sprites = array_map(function ($filename) use ($sprites) {
            return "$sprites/$filename";
        }, scandir($sprites));
        $sprites = array_filter($sprites, function ($file) {
            return is_readable($file) && !in_array($file, ['.', '..']);
        });
    } else {
        if (!is_readable($sprites)) {
            return;
        }
        $sprites = [$sprites];
    }
    foreach ($sprites as $spr_file) {
        try {
            $spr = new Zspr($spr_file);
        } catch (Exception $e) {
            continue;
        }

        $sprite = $spr->getPixelBytes();
        $palette = array_map(function ($bytes) {
            return $bytes[0] + ($bytes[1] << 8);
        }, array_chunk(array_slice($spr->getPaletteBytes(), 0, 30), 2));

        $im = imagecreatetruecolor(16, 24);
        imagesavealpha($im, true);

        $palettes = [imagecolorallocatealpha($im, 0, 0, 0, 127)];
        foreach ($palette as $color) {
            $palettes[] = imagecolorallocate($im, ($color & 0x1F) * 8, (($color & 0x3E0) >> 5) * 8, (($color & 0x7C00) >> 10) * 8);
        }
        imagefill($im, 0, 0, $palettes[0]);

        // shadow
        $shadow_color = imagecolorallocate($im, 40, 40, 40);
        $shadow = [
            [0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0],
            [0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0],
            [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            [0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0],
            [0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0],
        ];
        for ($y = 0; $y < 6; ++$y) {
            for ($x = 0; $x < 12; ++$x) {
                if ($shadow[$y][$x]) {
                    imagesetpixel($im, $x + 2, $y + 17, $shadow_color);
                }
            }
        }

        $body = Sprite::load16x16($sprite, 0x4C0);

        for ($x = 0; $x < 16; ++$x) {
            for ($y = 0; $y < 16; ++$y) {
                imagesetpixel($im, $x, $y + 8, $palettes[$body[$x][$y]]);
            }
        }

        $head = Sprite::load16x16($sprite, 0x40);

        for ($x = 0; $x < 16; ++$x) {
            for ($y = 0; $y < 16; ++$y) {
                imagesetpixel($im, $x, $y, $palettes[$head[$x][$y]]);
            }
        }

        $dst = imagecreatetruecolor(16 * 8, 24 * 8);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagecopyresized($dst, $im, 0, 0, 0, 0, 16 * 8, 24 * 8, 16, 24);

        imagepng($im, "$spr_file.png");
        imagedestroy($im);
        imagepng($dst, "$spr_file.lg.png");
        imagedestroy($dst);

        //montage *.zspr.lg.png -tile 6x -background none -geometry +4+4 sprites.X.lg.png
        //montage *.zspr.png -tile x1 -background none -geometry +0+0 sprites.X.png
    }
});

Artisan::command('alttp:sprconf {sprites}', function ($sprites) {
    if (!is_dir($sprites)) {
        return $this->error('Must be a directory of zsprs');
    }

    $sprites = array_map(function ($filename) use ($sprites) {
        return "$sprites/$filename";
    }, scandir($sprites));

    $output = [];
    $i = 0;
    foreach ($sprites as $spr_file) {
        try {
            $spr = new Zspr($spr_file);
        } catch (Exception $e) {
            continue;
        }
        $output[basename($spr_file)] = [
            'name' => $spr->getDisplayText(),
            'author' => $spr->getAuthor(),
        ];
        $this->info(sprintf(".icon-custom-%s {background-position: percentage((%d - 236)/ 235) 0}", str_replace([' ', ')', '(', '.', "'"], '', $spr->getDisplayText()), ++$i));
    }
    file_put_contents(config_path('sprites.php'), preg_replace(
        '/  /',
        "    ",
        preg_replace(["/^array \(/", "/\)$/", "/=>\s*array\s*\(/", "/\),/"], ["<?php\n\nreturn [", "];\n", '=> [', '],'], var_export($output, true))
    ));
});

Artisan::command('alttp:sprpub', function () {
    foreach (Storage::disk('sprites')->allFiles('') as $file) {
        if (preg_match('/\.DS_Store$/', $file)) {
            continue;
        }
        if (preg_match('/\.gitignore$/', $file)) {
            continue;
        }
        if (Storage::disk('images')->has($file)) {
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

// this is a dirty hack to get some stats fast
// @TODO: make this a proper command, and clean it up
Artisan::command('alttp:ss {dir} {outdir}', function ($dir, $outdir) {
    $files = scandir($dir);
    $out = [
        'items' => [
            'spheres' => [],
            'full' => [],
            'required' => [],
        ],
        'locations' => [
            'spheres' => [],
            'full' => [],
            'required' => [],
        ],
    ];
    foreach ($files as $file) {
        $data = json_decode(file_get_contents("$dir/$file"), true);
        if (!$data) {
            continue;
        }
        foreach ($data as $section => $sdata) {
            if (in_array($section, ['playthrough', 'meta', 'Special', 'Shops'])) {
                continue;
            }
            foreach ($sdata as $location => $item) {
                if (strpos($item, 'Bottle') === 0) {
                    $item = 'Bottle';
                }
                if (!isset($out['items']['full'][$item][$location])) {
                    $out['items']['full'][$item][$location] = 0;
                }
                if (!isset($out['locations']['full'][$location][$item])) {
                    $out['locations']['full'][$location][$item] = 0;
                }
                ++$out['items']['full'][$item][$location];
                ++$out['locations']['full'][$location][$item];
            }
        }
        foreach ($data['playthrough'] as $key => $sphere) {
            if (!is_numeric($key)) {
                continue;
            }
            foreach (array_collapse($sphere) as $location => $item) {
                if (strpos($item, 'Bottle') === 0) {
                    $item = 'Bottle';
                }
                if (!isset($out['items']['spheres'][$item][$key])) {
                    $out['items']['spheres'][$item][$key] = 0;
                }
                if (!isset($out['locations']['spheres'][$location][$key])) {
                    $out['locations']['spheres'][$location][$key] = 0;
                }
                ++$out['items']['spheres'][$item][$key];
                ++$out['locations']['spheres'][$location][$key];
                if (!isset($out['items']['required'][$item][$location])) {
                    $out['items']['required'][$item][$location] = 0;
                }
                if (!isset($out['locations']['required'][$location][$item])) {
                    $out['locations']['required'][$location][$item] = 0;
                }
                ++$out['items']['required'][$item][$location];
                ++$out['locations']['required'][$location][$item];
            }
        }
    }

    foreach ($out as $key => $section) {
        foreach ($section as $type => $data) {
            $mdata = Distribution::_assureColumnsExist($data);
            ksortr($mdata);

            $csv = fopen(sprintf("%s/%s_%s.csv", $outdir, $key, $type), 'w');
            fputcsv($csv, array_merge(['item'], array_keys(reset($mdata))));
            foreach ($mdata as $name => $item) {
                fputcsv($csv, array_merge([$name], $item));
            }
            fclose($csv);
        }
    }
});
