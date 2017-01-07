<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Item;
use ALttP\Randomizer;

class Distribution extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:distrobution {item} {itterations} {--rules=v8}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'get pool distrobution of an advancement item over X random itterations.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$locations = [];
		for ($i = 0; $i < $this->argument('itterations'); $i++) {
			$rand = new Randomizer($this->option('rules'));
			$rand->makeSeed();

			foreach ($rand->getWorld()->getLocationsWithItem(Item::get($this->argument('item'))) as $location) {
				if (!isset($locations[$location->getName()])) {
					$locations[$location->getName()] = 0;
				}
				$locations[$location->getName()]++;
			}
		}
		ksort($locations);
		$this->info(var_export($locations, true));
	}
}
