<?php namespace Randomizer;

/**
 * A logical collection of Locations. Can have special can_enter function that will apply to all locaitons contained,
 * and can_complete function set to validate that the region prize (if set) can be obtained.
 */
class Region {
	protected $locations;
	protected $can_enter;
	protected $can_complete;
	protected $name = 'Unknown';
	protected $boss_location_in_base = true;
	protected $prize_location;

	/**
	 * Create a new Region.
	 *
	 * @param World $world World this Region is part of
	 *
	 * @return void
	 */
	public function __construct(World $world) {
		$this->world = $world;
	}

	/**
	 * Get the World associated with this Region.
	 *
	 * @return World
	 */
	public function getWorld() {
		return $this->world;
	}

	/**
	 * Get the name of this Region.
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	public function setPrizeLocation(Location $location) {
		$this->prize_location = $location;
		return $this;
	}

	public function getPrizeLocation() {
		return $this->prize_location;
	}

	public function getPrize() {
		if (!isset($this->prize_location) || !$this->prize_location->hasItem()) {
			return null;
		}

		return $this->prize_location->getItem();
	}

	public function hasPrize(Item $item) {
		if (!isset($this->prize_location) || !$this->prize_location->hasItem()) {
			return false;
		}

		return $this->prize_location->hasItem($item);
	}

	// These should be fillable no matter what. Items like keys/maps/compass'
	public function fillBaseItems($my_items) {
		return $this;
	}

	public function init($type = 'NoMajorGlitches') {
		return call_user_func([$this, 'init' . $type]);
	}

	public function initNoMajorGlitches() {
		return $this;
	}

	public function canComplete($locations, $items) {
		if ($this->can_complete) {
			return call_user_func($this->can_complete, $locations, $items);
		}
		return true;
	}

	public function canEnter($locations, $items) {
		if ($this->can_enter) {
			return call_user_func($this->can_enter, $locations, $items);
		}
		return true;
	}

	public function getLocation(string $name) {
		return $this->locations[$name];
	}

	public function getLocations() {
		return $this->locations;
	}

	public function getEmptyLocations() {
		return $this->locations->filter(function($location) {
			return !$location->hasItem();
		});
	}

	public function locationsWithItem(Item $item = null) {
		return $this->locations->locationsWithItem($item);
	}
}
