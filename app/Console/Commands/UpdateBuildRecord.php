<?php

namespace ALttP\Console\Commands;

use ALttP\Build;
use ALttP\Rom;
use ALttP\Support\Flips;
use Exception;
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
    protected $description = 'build bps, json patch, and upate the rom build in DB';

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

        $build = Build::firstOrNew([
            'build' => $this->argument('build') ?? date('Y-m-d'),
        ]);
        $build->hash =  hash_file('md5', $this->argument('file'));
        $build->patch = '[]';

        $bps_data = resolve(Flips::class)->createBpsFromFiles(config('alttp.base_rom'), $this->argument('file'), [
            'created' => $build->build,
            'hash' => $build->hash,
        ]);

        file_put_contents(public_path(sprintf('bps/%s.bps', $build->hash)), $bps_data);

        $build->bps = $bps_data;
        $build->save();

        try {
            $this->makeJsonPatch($build->hash, $this->argument('file'));
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return 201;
        }

        $this->updateRomClassFile($build);

        $this->info(sprintf('record updated'));
    }

    /**
     * Update the constants in Rom class.
     *
     * @param \ALttP\Build  $build  Build to update to
     *
     * @return void
     */
    private function updateRomClassFile(Build $build): void
    {
        file_put_contents(app_path('Rom.php'), preg_replace(
            ["/const BUILD = '[\w-]*';/", "/const HASH = '\w*';/"],
            ["const BUILD = '$build->build';", "const HASH = '$build->hash';"],
            file_get_contents(app_path('Rom.php'))
        ));
    }

    /**
     * Create a json patch for internal services.
     *
     * @param string  $hash  hash to save file with
     * @param string  $rom  patched rom to make patch from
     *
     * @throws \Exception  if any filesystem issues arrise
     *
     * @return void
     */
    private function makeJsonPatch(string $hash, string $rom): void
    {
        $tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);

        if ($tmp_file === false) {
            throw new Exception('Could not create tmp file');
        }

        copy(config('alttp.base_rom'), $tmp_file);

        $original_rom = fopen($tmp_file, "r+");

        if ($original_rom === false) {
            throw new Exception('Could not open tmp file');
        }

        ftruncate($original_rom, Rom::SIZE);
        $updated_rom = fopen($rom, "r");

        if ($updated_rom === false) {
            throw new Exception('Could not open updated rom');
        }

        $i = 0;
        $out = [];
        while (!feof($original_rom)) {
            $original_byte = fread($original_rom, 1);
            $updated_byte = fread($updated_rom, 1);
            if ($updated_byte !== $original_byte && $updated_byte !== false) {
                $out[$i] = [unpack('C*', $updated_byte)[1]];
            }
            $i++;
        }
        fclose($updated_rom);
        fclose($original_rom);
        unlink($tmp_file);

        $backwards = array_reverse($out, true);
        foreach ($backwards as $off => $_) {
            if (isset($backwards[$off - 1])) {
                $backwards[$off - 1] = array_merge($backwards[$off - 1], $backwards[$off]);
                unset($backwards[$off]);
            }
        }
        $forwards = array_reverse($backwards, true);

        array_walk($forwards, function (&$write, $address) {
            $write = [$address => $write];
        });

        file_put_contents(
            storage_path(sprintf('patches/%s.json', $hash)),
            json_encode(array_values($forwards))
        );
    }
}
