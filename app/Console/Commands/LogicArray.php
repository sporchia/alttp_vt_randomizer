<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Item;
use ALttP\Randomizer;
use ALttP\World;

class LogicArray extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:logicarray';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'generate logic array to put in Randomizer when logic changes.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		mt_srand(Randomizer::LOGIC);
		$array = array_chunk(mt_shuffle(range(0, 255)), 16);
		foreach ($array as $row) {
			$this->info(sprintf("0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X,"
				. "0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X, 0x%02X,", ...$row));
		}
	}
}
