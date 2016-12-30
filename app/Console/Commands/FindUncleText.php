<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;

class FindUncleText extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:finduncletext {rom}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'find offset of uncle text';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$rom = fopen($this->argument('rom'), "r");

		$search = [0x00, 0xC0, 0x00, 0xAE, 0x00, 0xD8, 0x00, 0xBB, 0x00, 0xAE, 0x00, 0xFF, 0x00, 0xB8, 0x00,
			0xBE, 0x00, 0xBD, 0x00, 0xFF, 0x00, 0xB8, 0x00, 0xAF, 0x75, 0x00, 0xC0, 0x00, 0xAE, 0x00, 0xAE,
			0x00, 0xBD, 0x00, 0xAA, 0x00, 0xAB, 0x00, 0xB2, 0x00, 0xC1, 0x00, 0xCd, 0x00, 0xFF, 0x00, 0xBD,
			0x00, 0xB8, 0x76, 0x00, 0xBD, 0x00, 0xB1, 0x00, 0xAE, 0x00, 0xFF, 0x00, 0xBC, 0x00, 0xBD, 0x00,
			0xB8, 0x00, 0xBB, 0x00, 0xAE, 0x00, 0xC7, 0x7F, 0x7F];

		$i = 0;
		$search_length = count($search);
		$search_left = $search_length;
		while (!feof($rom)) {
			$byte = unpack('C*', fread($rom, 1))[1];
			if ($byte !== $search[$search_length - $search_left]) {
				$search_left = $search_length;
			} else {
				$search_left--;
			}
			$i++;
			if ($search_left == 0) {
				$offset = $i - $search_length;
				break;
			}
		}
		fclose($rom);

		if (isset($offset)) {
			return $this->info(sprintf('Text found: 0x%s', strtoupper(dechex($offset))));
		}

		$this->error('Text not found');
	}
}
