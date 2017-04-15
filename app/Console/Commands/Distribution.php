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
	protected $signature = 'alttp:distribution {type} {thing} {itterations} {--rules=normal} {--mode=NoMajorGlitches}'
		. '{--csv}';

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
			case 'region_fill':
				$function = [$this, 'region_fill'];
				$thing = $this->argument('thing');
				break;
			case 'full':
				$function = [$this, 'full'];
				$thing = $this->argument('thing');
				break;
			default:
				return $this->error('Invalid distribution');
		}

		for ($i = 0; $i < $this->argument('itterations'); $i++) {
			call_user_func_array($function, [$thing, &$locations]);
		}

		if ($this->option('csv')) {
			$locations = $this->_assureColumnsExist($locations);
			ksortr($locations);
			$out = fopen('php://output', 'w');
			fputcsv($out, array_merge(['location'], array_keys(reset($locations))));
			foreach ($locations as $name => $location) {
				fputcsv($out, array_merge([$name], $location));
			}
			fclose($out);
		} else {
			ksortr($locations);
			$this->info(json_encode($locations, JSON_PRETTY_PRINT));
		}
	}

	private function _assureColumnsExist($array) : array {
		$keys = [];
		foreach ($array as $part) {
			$keys = array_merge($keys, array_keys($part));
		}
		$keys = array_unique($keys);
		foreach ($array as $k => $part) {
			foreach ($keys as $key) {
				if (!isset($part[$key])) {
					$array[$k][$key] = 0;
				}
			}
		}
		return $array;
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

	private function full($unused, &$locations) {
		$rand = new Randomizer($this->option('rules'), $this->option('mode'));
		$rand->makeSeed();

		foreach ($rand->getWorld()->getLocations() as $location) {
			$location_name = $location->getName();
			$item_name = $location->getItem()->getNiceName();

			if (!isset($locations[$location_name][$item_name])) {
				$locations[$location_name][$item_name] = 0;
			}
			$locations[$location_name][$item_name]++;
		}
	}
}
