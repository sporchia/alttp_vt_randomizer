<?php namespace ALttP\Filler;

use ALttP\Filler;
use ALttP\Support\LocationCollection;

class Distributed extends Filler {
	public function shuffleLocations(LocationCollection $locations) {
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
		return new LocationCollection($new_locations);
	}

	public function shuffleItems(array $items) {
		return mt_shuffle($items);
	}
}
