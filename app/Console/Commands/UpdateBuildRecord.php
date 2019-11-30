<?php

namespace ALttP\Console\Commands;

use ALttP\Build;
use ALttP\Support\Flips;
use Illuminate\Console\Command;

class UpdateBuildRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alttp:updatebuildrecord {file} {build?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'build bps and upate the rom build in DB';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!is_string($this->argument('file'))) {
            $this->error('argument not string');

            return 101;
        }

        $flips = new Flips;
        $base_rom_location = env('ENEMIZER_BASE', null);

        $build = Build::firstOrNew([
            'build' => $this->argument('build') ?? date('Y-m-d'),
        ]);
        $build->hash =  hash_file('md5', $this->argument('file'));
        $build->patch = '[]';

        $bps_data = $flips->createBpsFromFiles($base_rom_location, $this->argument('file'), [
            'created' => $build->build,
            'hash' => $build->hash,
        ]);

        file_put_contents(public_path(sprintf('bps/%s.bps', $build->hash)), $bps_data);

        $build->bps = $bps_data;
        $build->save();

        $this->info(sprintf('record updated'));
    }
}
