<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;

class UpdateResetJson extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:updatereset {base_rom} {bad_rom}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'update the romreset.json file from roms';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if (!is_readable($this->argument('base_rom')) || !is_readable($this->argument('bad_rom'))) {
			return $this->error('Source Files not readable');
		}

		$bad_rom = fopen($this->argument('bad_rom'), "r");
		$base_rom = fopen($this->argument('base_rom'), "r");

		$i = 0;
		$cont = $i;
		$out = [];
		while (!feof($bad_rom)) {
			$base_byte = fread($bad_rom, 1);
			$vt_byte = fread($base_rom, 1);
			if ($base_byte !== $vt_byte) {
				$out[$i] = [unpack('C*', $vt_byte)[1]];
			}
			$i++;
		}
		fclose($base_rom);
		fclose($bad_rom);

		$backwards = array_reverse($out, true);
		foreach ($backwards as $off => $value) {
			if (isset($backwards[$off - 1])) {
				$backwards[$off - 1] = array_merge($backwards[$off - 1], $backwards[$off]);
				unset($backwards[$off]);
			}
		}
		$forwards = array_reverse($backwards, true);

		array_walk($forwards, function(&$write, $address) {
			$write = [$address => $write];
		});

		$update_with = array_values($forwards);

		$rom_reset = [];
		if (is_readable(public_path('js/romreset.json'))) {
			$rom_reset = json_decode(file_get_contents(public_path('js/romreset.json')), true);
		}

		$write_array = [];
		// set up previous
		foreach ($rom_reset as $wri) {
			foreach ($wri as $seek => $bytes) {
				for ($i = 0; $i < count($bytes); $i++) {
					$write_array[$seek + $i] = [$bytes[$i]];
				}
			}
		}
		// overwrite with changes
		foreach ($update_with as $wri) {
			foreach ($wri as $seek => $bytes) {
				for ($i = 0; $i < count($bytes); $i++) {
					$write_array[$seek + $i] = [$bytes[$i]];
				}
			}
		}
		$out = $write_array;
		ksort($out);

		$backwards = array_reverse($out, true);
		foreach ($backwards as $off => $value) {
			if (isset($backwards[$off - 1])) {
				$backwards[$off - 1] = array_merge($backwards[$off - 1], $backwards[$off]);
				unset($backwards[$off]);
			}
		}
		$forwards = array_reverse($backwards, true);

		array_walk($forwards, function(&$write, $address) {
			$write = [$address => $write];
		});

		file_put_contents(public_path('js/romreset.json'), json_encode(array_values($forwards)));

		$this->info(sprintf('file updated'));
	}
}
