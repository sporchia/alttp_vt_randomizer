<?php

namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;

class UpdateBuildRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alttp:updatebuildrecord {file=js/base2current.json} {build?} {hash?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update the rom build in DB';

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

        $patch_left = $patch_right = [];

        if (is_readable(public_path('js/base2current.json'))) {
            $file_contents = file_get_contents(public_path($this->argument('file')));

            if ($file_contents === false) {
                $this->error('could not read base2current.json');

                return 1;
            }

            $patch_left = json_decode($file_contents, true);
        }

        Rom::saveBuild(patch_merge_minify($patch_left, $patch_right), $this->argument('build'), $this->argument('hash'));

        $this->info(sprintf('record updated'));
    }
}
