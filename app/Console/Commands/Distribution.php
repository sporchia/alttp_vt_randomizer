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
	protected $signature = 'alttp:distribution {type} {thing} {itterations=1}'
		. ' {--difficulty=normal : set difficulty}'
		. ' {--logic=NoMajorGlitches : set logic}'
		. ' {--goal=ganon : set game goal}'
		. ' {--mode=standard : set game mode}'
		. ' {--csv= : file to write to}';

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
				if (!$this->argument('thing')) {
					return $this->error("Need an Item Name");
				}
				$thing = Item::get($this->argument('thing'));
				break;
			case 'location':
				$function = [$this, 'location'];
				if (!$this->argument('thing')) {
					return $this->error("Need an Location Name");
				}
				$thing = $this->argument('thing');
				break;
			case 'region_fill':
				$function = [$this, 'region_fill'];
				if (!$this->argument('thing')) {
					return $this->error("Need an Region Name");
				}
				$thing = $this->argument('thing');
				break;
			case 'required':
				$function = [$this, 'required'];
				$thing = $this->argument('thing');
				break;
			case 'full':
				$function = [$this, 'full'];
				$thing = $this->argument('thing');
				break;
			default:
				return $this->error('Invalid distribution');
		}

		if ($this->option('verbose')) {
			$bar = $this->output->createProgressBar($this->argument('itterations'));
		}

		for ($i = 0; $i < $this->argument('itterations'); $i++) {
			call_user_func_array($function, [$thing, &$locations]);
			isset($bar) && $bar->advance();
		}

		isset($bar) && $bar->finish();

		if ($this->option('csv')) {
			$locations = $this->_assureColumnsExist($locations);
			ksortr($locations);
			$out = fopen($this->option('csv'), 'w');
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
		$rand = new Randomizer($this->option('difficulty'), $this->option('logic'), $this->option('goal'));
		$rand->makeSeed();

		foreach ($rand->getWorld()->getLocationsWithItem($item) as $location) {
			if (!isset($locations[$location->getName()])) {
				$locations[$location->getName()] = 0;
			}
			$locations[$location->getName()]++;
		}
	}

	private function location($location_name, &$locations) {
		$rand = new Randomizer($this->option('difficulty'), $this->option('logic'), $this->option('goal'));
		$rand->makeSeed();

		$item_name = $rand->getWorld()->getLocation($location_name)->getItem()->getNiceName();

		if (!isset($locations[$location_name][$item_name])) {
			$locations[$location_name][$item_name] = 0;
		}
		$locations[$location_name][$item_name]++;
	}

	private function region_fill(string $region_name, &$locations) {
		$world = new World($this->option('difficulty'), $this->option('logic'), $this->option('goal'));
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

	private function required($unused, &$locations) {
		$rand = new Randomizer($this->option('difficulty'), $this->option('logic'), $this->option('goal'));
		$rand->makeSeed();

		$required_locations = $rand->getWorld()->getPlayThrough(false);
		foreach ($required_locations as $location) {
			$location_name = $location->getName();
			$item = $location->getItem();
			if (!$item) {
				continue;
			}

			$item_name = $item->getNiceName();

			if (!isset($locations[$location_name][$item_name])) {
				$locations[$location_name][$item_name] = 0;
			}
			$locations[$location_name][$item_name]++;
		}
	}

	private function full($unused, &$locations) {
		$rand = new Randomizer($this->option('difficulty'), $this->option('logic'), $this->option('goal'));
		$rand->makeSeed();

		foreach ($rand->getWorld()->getLocations() as $location) {
			$location_name = $location->getName();
			$item = $location->getItem();
			if (!$item) {
				continue;
			}

			$item_name = $item->getNiceName();

			if (!isset($locations[$location_name][$item_name])) {
				$locations[$location_name][$item_name] = 0;
			}
			$locations[$location_name][$item_name]++;
		}
	}
}
