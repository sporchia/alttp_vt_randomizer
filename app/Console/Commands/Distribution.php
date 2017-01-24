<?php namespace ALttP\Console\Commands;

use Illuminate\Console\Command;
use ALttP\Item;
use ALttP\Randomizer;
use ALttP\World;

class Distribution extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:distribution {type} {thing} {itterations} {--rules=v8} {--mode=NoMajorGlitches}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'get pool distrobution of a thing over X random itterations.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$locations = [];
		switch ($this->argument('type')) {
			case 'item':
				$function = [$this, 'item'];
				$thing = Item::get($this->argument('thing'));
				break;
			case 'location':
				$function = [$this, 'location'];
				$thing = $this->argument('thing');
				break;
			case 'complexity':
				$function = [$this, 'complexity'];
				$thing = $this->argument('thing');
				break;
			case 'region_fill':
				$function = [$this, 'region_fill'];
				$thing = $this->argument('thing');
				break;
			default:
				return $this->error('Invalid distribution');
		}

		for ($i = 0; $i < $this->argument('itterations'); $i++) {
			call_user_func_array($function, [$thing, &$locations]);
		}

		ksortr($locations);
		$this->info(json_encode($locations, JSON_PRETTY_PRINT));
	}

	private function item(Item $item, &$locations) {
		$rand = new Randomizer($this->option('rules'), $this->option('mode'));
		$rand->makeSeed();

		foreach ($rand->getWorld()->getLocationsWithItem($item) as $location) {
			if (!isset($locations[$location->getName()])) {
				$locations[$location->getName()] = 0;
			}
			$locations[$location->getName()]++;
		}
	}

	private function complexity($type, &$locations) {
		$rand = new Randomizer($this->option('rules'), $this->option('mode'));
		$rand->makeSeed();
		$spoiler = $rand->getWorld()->getPlaythrough();
		$vt_complexity = $spoiler['vt_complexity'];
		$complexity = $spoiler['complexity'];
		$mix_complexity = sprintf("%s (%s)", $spoiler['vt_complexity'], $spoiler['complexity']);
		if (!isset($locations['org'][$complexity])) {
			$locations['org'][$complexity] = 0;
		}
		$locations['org'][$complexity]++;
		if (!isset($locations['mix'][$mix_complexity])) {
			$locations['mix'][$mix_complexity] = 0;
		}
		$locations['mix'][$mix_complexity]++;
		if (!isset($locations['vt'][$vt_complexity])) {
			$locations['vt'][$vt_complexity] = 0;
		}
		$locations['vt'][$vt_complexity]++;
	}

	private function location($location_name, &$locations) {
		$rand = new Randomizer($this->option('rules'), $this->option('mode'));
		$rand->makeSeed();

		$item_name = $rand->getWorld()->getLocation($location_name)->getItem()->getNiceName();

		if (!isset($locations[$location_name][$item_name])) {
			$locations[$location_name][$item_name] = 0;
		}
		$locations[$location_name][$item_name]++;
	}

	private function region_fill(string $region_name, &$locations) {
		$world = new World($this->option('rules'), $this->option('mode'));
		$world->getLocation("Misery Mire Medallion")->setItem(Item::get('Quake'));
		$world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$region = $world->getRegion($region_name);
		$region->fillBaseItems(Item::all());
		foreach ($region->getLocations() as $location) {
			if (!$location->getItem()) {
				continue;
			}
			if (!isset($locations[$location->getName()])) {
				$locations[$location->getName()] = [];
			}
			if (!isset($locations[$location->getName()][$location->getItem()->getNiceName()])) {
				$locations[$location->getName()][$location->getItem()->getNiceName()] = 0;
			}
			$locations[$location->getName()][$location->getItem()->getNiceName()]++;
		}
	}
}
