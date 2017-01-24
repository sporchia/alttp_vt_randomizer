<?php namespace ALttP\Console\Commands;

use ALttP\Rom;
use ALttP\World;
use Illuminate\Console\Command;

class SpoilerFromRom extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:spoiler {rom}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'attempt to get spoiler for rom';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$rom = new Rom($this->argument('rom'));
		$this->world = new World;
		$this->world->modelFromRom($rom);

		$spoiler = [];

		foreach ($this->world->getRegions() as $name => $region) {
			$spoiler[$name] = [];
			$region->getLocations()->each(function($location) use (&$spoiler, $name) {
				if ($location->hasItem()) {
					$spoiler[$name][$location->getName()] = $location->getItem()->getNiceName();
					if (!isset($spoiler['items'][$location->getItem()->getNiceName()])) {
						$spoiler['items'][$location->getItem()->getNiceName()] = 0;
					}
					$spoiler['items'][$location->getItem()->getNiceName()]++;
				} else {
					$spoiler[$name][$location->getName()] = 'Nothing';
				}
			});
		}
		$spoiler['playthrough'] = $this->world->getPlayThrough();

		$this->info(json_encode($spoiler, JSON_PRETTY_PRINT));
	}
}
