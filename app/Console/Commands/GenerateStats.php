<?php namespace ALttP\Console\Commands;

use ALttP\Item;
use ALttP\Randomizer;
use ALttP\Rom;
use ALttP\World;
use Illuminate\Console\Command;

class GenerateStats extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'alttp:generatestats {output_directory : where to place generated files}'
		. ' {--difficulty=normal : set difficulty}'
		. ' {--logic=NoGlitches : set logic}'
		. ' {--seed= : generate stats file for specific seed}'
		. ' {--bulk=100000 : generate stats for multiple seeds}'
		. ' {--goal=ganon : set game goal}'
		. ' {--state=standard : set game state}'
		. ' {--variation=none : set game variation}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate spheres files for statistical analysis.';

	protected $reset_patch;

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if (!is_dir($this->argument('output_directory')) || !is_writable($this->argument('output_directory'))) {
			return $this->error('Target Directory not writable');
		}

		$bulk = ($this->option('seed') == null) ? $this->option('bulk') : 100000;

		$seeds = [];

		if ($this->option('seed') !== null) {
			$seeds = [$this->option('seed')];
		}
		else {
			// generate a seed value, and make sure it hasn't been used already for --bulk
			for ($i = 0; $i < $bulk; $i++) {
				$unique = false;
				$count = 0;

				do {
					$rng_seed = get_random_int(1, 999999999);
					$count++;

					if (!in_array($rng_seed, $seeds)) {
						array_push($seeds, $rng_seed);
						$unique = true;
					}
					if ($count > 10000) {
						// stop after 10000 just in case php's mt_rand is really bad
						$unique = true;
					}
				} while ($unique === false);
			}

			$bulk = count($seeds);
		}

		foreach ($seeds as $seed) {
			$rom = new Rom(null);

			config(['alttp.mode.state' => $this->option('state')]);

			$rand = new Randomizer($this->option('difficulty'), $this->option('logic'), $this->option('goal'), $this->option('variation'));

			$rand->makeSeed($seed);

			$spheres_file = sprintf($this->argument('output_directory') . '/' . 'alttp - VT_%s_%s_%s_%s_%s.stats.txt',
				$rand->getLogic(), $this->option('difficulty'), $this->option('state'), $this->option('variation'), $rand->getSeed());

			file_put_contents($spheres_file, json_encode($this->getStats($rand), JSON_PRETTY_PRINT));

			$this->info(sprintf('Stats Saved: %s', $spheres_file));
		}
	}

	/**
	 * Get the stats for this seed
	 *
	 * @return array
	 */
	public function getStats($rand) {
		$stats = [];
		$stats['locationspheres'] = $this->getSpheres($rand);
		$stats['playthrough'] = $rand->getWorld()->getPlayThrough();
		$stats['meta'] = [
			'difficulty' => $this->option('difficulty'),
			'logic' => $rand->getLogic(),
			'logicNice' => $rand->getLogicNiceName(),
			'version' => Randomizer::LOGIC,
			'seed' => $rand->getSeed(),
			'goal' => $this->option('goal'),
			'variation' => $this->option('variation'),
			'build' => Rom::BUILD,
			'mode' => config('alttp.mode.state', 'standard'),
		];

		return $stats;
	}

	/**
	 * Get location spheres formatted for parsing into SQL Server
	 *
	 * @return array
	 */
	public function getSpheres($rand) {
		$location_sphere = $rand->getWorld()->getLocationSpheres();
		$ret = [];
		foreach($location_sphere as $sphere_level => $sphere) {
			array_push($ret, (object)['sphereLevel' => $sphere_level, 'regions' => []]);
			$sphereKey = array_search($sphere_level, array_column($ret, 'sphereLevel'));
			foreach($sphere as $location) {
				$regionName = $location->getRegion()->getName();
				$regionKey = array_search($regionName, array_column($ret[$sphereKey]->regions, 'regionName'));
				if($regionKey === false) {
					array_push($ret[$sphereKey]->regions, (object)['regionName' => $regionName, 'locations' => []]);
					$regionKey = array_search($regionName, array_column($ret[$sphereKey]->regions, 'regionName'));
				}
				$locationName = $location->getName();
				$itemName = $location->getItem() ? $location->getItem()->getNiceName() : 'Nothing';
				array_push($ret[$sphereKey]->regions[$regionKey]->locations, (object)['location' => $locationName, 'item' => $itemName]);
			}
		}
		return $ret;
	}
}
