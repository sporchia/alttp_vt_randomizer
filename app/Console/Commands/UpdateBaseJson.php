<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Rom;

class UpdateBaseJson extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:updatebase {original_rom} {updated_rom}';

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
	public function handle() {
		if (!is_readable($this->argument('updated_rom')) || !is_readable($this->argument('original_rom'))) {
			return $this->error('Source Files not readable');
		}

		$tmp_file = tempnam(sys_get_temp_dir(), __CLASS__);
		copy($this->argument('original_rom'), $tmp_file);

		$original_rom = fopen($tmp_file, "r+");
		ftruncate($original_rom, Rom::SIZE);
		$updated_rom = fopen($this->argument('updated_rom'), "r");


		$i = 0;
		$cont = $i;
		$out = [];
		while (!feof($original_rom)) {
			$original_byte = fread($original_rom, 1);
			$updated_byte = fread($updated_rom, 1);
			if ($updated_byte !== $original_byte) {
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

		array_walk($forwards, function(&$write, $address) {
			$write = [$address => $write];
		});

		file_put_contents(public_path('js/base2current.json'), json_encode(array_values($forwards)));
		//file_put_contents(public_path('patch/base2current.ips'), (new \ALttP\Support\Ips)->patchToIps(array_values($forwards)));

		$this->info(sprintf('file updated'));
	}
}
