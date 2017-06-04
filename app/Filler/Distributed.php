<?php namespace ALttP\Filler;

use ALttP\Support\LocationCollection as Locations;

class Distributed extends Random {
	protected function shuffleLocations(Locations $locations) {
		$new_locations = [];
		$regions = array_fill_keys(array_map(function($region) {
			return get_class($region);
		}, $locations->getRegions()), 0);

		foreach ($locations->randomCollection($locations->count()) as $location) {
			$region_name = get_class($location->getRegion());
			if ($regions[$region_name] <= min($regions)) {
				array_unshift($new_locations, $location);
				$regions[$region_name]++;
			} else {
				array_push($new_locations, $location);
			}
		}
		return new Locations($new_locations);
	}
}
