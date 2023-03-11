<?php

namespace ALttP\Console\Commands;

use ALttP\Rom;
use ALttP\Sprite;
use ALttP\Support\Zspr;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class Sprites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alttp:sprites {dir : sprite directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'prep sprites for release';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sprite_dir = $this->argument('dir');

        if (!is_string($sprite_dir)) {
            $this->error('argument not string');

            return 101;
        }

        $meta_data = collect(json_decode(file_get_contents("$sprite_dir/sprites.json"), true))->sortBy('file');
        // $this->info($meta_data->count() . ' sprites found');

        if ($meta_data === null || json_last_error() !== 0) {
            $this->error('json file is garbo');

            return 102;
        }

        $sprite_sheet = 'sprites.31.1.png';

        $this->sprToPng($sprite_dir);

        $files = collect(scandir($sprite_dir));

        $meta_data->groupBy('vtversion')->each(function ($sprites, $version) use ($sprite_dir, $files) {
            $sprite_file_class = $sprites->pluck('file')->map(function ($val) {
                return $val;
            });

            foreach ($sprite_file_class as $file) {
                if (!file_exists("$sprite_dir/$file")) {
                    throw new Exception("sprite $file does not exist");
                };
            }

            $sprite_class = $sprites->pluck('file')->map(function ($val) {
                return "$val.lg.png";
            });

            $found_files = $files->intersect($sprite_class);

            if ($found_files->isEmpty()) {
                return;
            }

            if ($version == 0) {
                // cleanup
                foreach ($found_files as $file) {
                    try {
                        $this->info("remove: $file");
                        unlink("$sprite_dir/$file");
                    } catch (Exception $ignore) {
                        // ignore
                    }
                }
                return;
            }

            $proc = new Process([
                'montage',
                ...$found_files,
                '-tile',
                '6x',
                '-background',
                'none',
                '-geometry',
                '+4+4',
                "sprites.$version.lg.png",
            ], base_path($sprite_dir));

            Log::debug($proc->getCommandLine());

            $proc->run(function ($type, $buffer) {
                Log::debug((Process::ERR === $type) ? "ERR > $buffer" : "OUT > $buffer");
            });

            if (!$proc->isSuccessful()) {
                $this->error($proc->getErrorOutput());

                $this->error("Unable to montage");

                return 301;
            }

            // cleanup
            foreach ($found_files as $file) {
                try {
                    $this->info("remove: $file");
                    unlink("$sprite_dir/$file");
                } catch (Exception $ignore) {
                    // ignore
                }
            }
        });

        $sprite_images = $meta_data->pluck('file')->map(function ($val) {
            return "$val.png";
        });

        foreach ($sprite_images as $file) {
            if (!file_exists("$sprite_dir/$file")) {
                throw new Exception("missing sprite image $file");
            };
        }

        $found_files = $files->intersect($sprite_images);
        if ($found_files->isEmpty()) {
            $this->error('No files to process');

            return 104;
        }

        $proc = new Process([
            'montage',
            resource_path('000.random.zspr.png'),
            ...$found_files,
            '-tile',
            'x1',
            '-background',
            'none',
            '-geometry',
            '+0+0',
            $sprite_sheet,
        ], base_path($sprite_dir));

        Log::debug($proc->getCommandLine());

        $proc->run(function ($type, $buffer) {
            Log::debug((Process::ERR === $type) ? "ERR > $buffer" : "OUT > $buffer");
        });

        if (!$proc->isSuccessful()) {
            $this->error($proc->getErrorOutput());

            $this->error("Unable to montage");

            return 301;
        }

        // cleanup
        // foreach ($found_files as $file) {
        //     try {
        //         $this->info("remove: $file");
        //         unlink("$sprite_dir/$file");
        //     } catch (Exception $ignore) {
        //         // ignore
        //     }
        // }

        // deal with config file and scss
        $top = $meta_data->count();
        $next = $top + 1;

        $scss_file = "[class^=\"icon-custom-\"],\n[class*=\" icon-custom-\"] {\n  width: 16px;\n  height: 24px;\n  vertical-align: bottom;\n  background-image: url(\"https://alttpr-assets.s3.us-east-2.amazonaws.com/$sprite_sheet\");\n}\n\n";
        $scss_file .= ".icon-custom-Random {\n  background-position: 0 0;\n}\n\n";
        $i = 0;
        foreach ($meta_data as $sprite) {
            $scss_file .= sprintf(".icon-custom-%s {\n  background-position: percentage((%d - $next)/ $top) 0;\n}\n\n", str_replace([' ', ')', '(', '.', "'", "/"], '', $sprite['name']), ++$i);
        }
        file_put_contents(resource_path('sass/_sprites.scss'), $scss_file);

        file_put_contents(config_path('sprites.php'), preg_replace(
            '/  /',
            "    ",
            preg_replace(["/^array \(/", "/\)$/", "/=>\s*array\s*\(/", "/\),/"], ["<?php\n\nreturn [", "];\n", '=> [', '],'], var_export($meta_data->keyBy('file')->toArray(), true))
        ));
    }

    private function sprToPng($sprites)
    {
        if (is_dir($sprites)) {
            $sprites = array_map(function ($filename) use ($sprites) {
                return "$sprites/$filename";
            }, scandir($sprites));
            $sprites = array_filter($sprites, function ($file) {
                return is_readable($file) && !in_array($file, ['.', '..', '.git']);
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
            if (empty($sprite)) {
                $rom = new Rom(config('alttp.base_rom'));
                $sprite = $rom->read(0x80000, 0x7000);
            }
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
        }
    }
}
