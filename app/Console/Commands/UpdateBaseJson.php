<?php

namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;

/**
 * Diff 2 binary files and create a json patch formatted file.
 */
class UpdateBaseJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alttp:updatebase {original_rom} {updated_rom}'
        . ' {output=js/base2current.json : output file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update the base2current.json file from roms';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (
            !is_string($this->argument('updated_rom'))
            || !is_string($this->argument('original_rom'))
            || !is_string($this->argument('output'))
        ) {
            $this->error('argument not string');

            return 101;
        }

        if (!is_readable($this->argument('updated_rom')) || !is_readable($this->argument('original_rom'))) {
            $this->error('Source Files not readable');

            return 1;
        }

        $tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);

        if ($tmp_file === false) {
            $this->error('Could not create tmp file');

            return 102;
        }

        copy($this->argument('original_rom'), $tmp_file);

        $original_rom = fopen($tmp_file, "r+");

        if ($original_rom === false) {
            $this->error('Could not open tmp file');

            return 103;
        }

        ftruncate($original_rom, Rom::SIZE);
        $updated_rom = fopen($this->argument('updated_rom'), "r");

        if ($updated_rom === false) {
            $this->error('Could not open updated rom');

            return 104;
        }

        $i = 0;
        $cont = $i;
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
        foreach ($backwards as $off => $value) {
            if (isset($backwards[$off - 1])) {
                $backwards[$off - 1] = array_merge($backwards[$off - 1], $backwards[$off]);
                unset($backwards[$off]);
            }
        }
        $forwards = array_reverse($backwards, true);

        array_walk($forwards, function (&$write, $address) {
            $write = [$address => $write];
        });

        $output = public_path($this->argument('output'));
        file_put_contents($output, json_encode(array_values($forwards)));

        $this->info(sprintf('file updated'));
    }
}
