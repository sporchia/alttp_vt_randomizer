<?php namespace Randomizer\Region;

use Randomizer\Item;
use Randomizer\Location;
use Randomizer\Region;
use Randomizer\Support\LocationCollection;
use Randomizer\World;

class HyruleCastleTower extends Region {
	protected $name = 'Castle Tower';

	public function __construct(World $world) {
		parent::__construct($world);

		$this->locations = new LocationCollection([
			new Location("[dungeon-A1-2F] Hyrule Castle Tower - 2 knife guys room", 0xEAB5, $this),
			new Location("[dungeon-A1-3F] Hyrule Castle Tower - maze room", 0xEAB2, $this),
		]);
	}

	public function fillBaseItems($my_items) {
		$this->locations->each(function($location) {
			$location->setItem(Item::get('Key'));
		});

		return $this;
	}
}
