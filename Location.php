<?php namespace Randomizer;

use Randomizer\Support\LocationCollection;

class Location {
	protected $name;
	protected $address;
	protected $bytes;
	protected $region;
	protected $requirement_callback;
	protected $item = null;

	/**
	 * Create a new Location
	 *
	 * @param string $name Unique name of location
	 * @param array $address Addresses in ROM to write to
	 * @param array|null $bytes data to write back to Item addresses if set
	 * @param Region|null $region Region that this Location belongs to
	 * @param Callable|null $requirement_callback callback function when determining if Location is accessable
	 *
	 * @return void
	 */
	public function __construct($name, $address, $bytes = null, Region $region = null, Callable $requirement_callback = null) {
		$this->name = $name;
		$this->address = (array) $address;
		$this->bytes = (array) $bytes;
		$this->region = $region;
		$this->requirement_callback = $requirement_callback;
	}

	/**
	 * Try to place the given Item in this Location.
	 *
	 * @param Item $item Item we are trying to place
	 * @param ItemCollection $items Items that can be collected
	 *
	 * @return bool
	 */
	public function fill(Item $item, $items) {
		if ($this->canFill($item, $items)) {
			$this->setItem($item);
			return true;
		}

		return false;
	}

	/**
	 * Test if given Item can be placed in this location without soft locks.
	 *
	 * @param Item $item Item we are testing for placement
	 * @param ItemCollection $items Items that can be collected
	 *
	 * @return bool
	 */
	public function canFill(Item $item, $items) {
			return $this->canAccess($items);
	}

	/**
	 * Determine if Link can access this location given his Items collected. Starts by checking if access to the Region
	 * is granted, then checks the spcific location.
	 *
	 * @param ItemCollection $items Items Link can collect
	 *
	 * @return bool
	 */
	public function canAccess($items) {
		if (!$this->region->canEnter($this->region->getWorld()->getLocations(), $items)) {
			return false;
		}

		if (!$this->requirement_callback || call_user_func($this->requirement_callback, $this->region->getWorld()->getLocations(), $items)) {
			return true;
		}

		return false;
	}

	/**
	 * Set the requirements callback for this Lcation, closure should take 2 arguments, $locations and $items and
	 * return boolean.
	 *
	 * @param Callable $callback function to be called when checking if Location can have Item
	 *
	 * @return $this
	 */
	public function setRequirements(Callable $callback) {
		$this->requirement_callback = $callback;
		return $this;
	}

    /**
     * Sets the item for this location.
     *
     * @param Item|null $item Item to be placed at this Location
     *
     * @return $this
     */
	public function setItem(Item $item = null) {
		$this->item = $item;
		return $this;
	}

	/**
	 * Does this Location have (a particular) Item assigned
	 *
	 * @param Item|null $item item to search locations for
	 *
	 * @return bool
	 */
	public function hasItem(Item $item = null) {
		return $item ? $this->item == $item : $this->item !== null;
	}

	/**
	 * Get the Item assigned to this Location, null is nothing is assigned
	 *
	 * @return Item|null
	 */
	public function getItem() {
		return $this->item;
	}

	/**
	 * Write the Item to this Location in ROM. Will set Item if passed in, and only write if there is an Item set.
	 *
	 * @param ALttPRom $rom ROM we are writing to
	 * @param Item|null $item item we are going to write
	 *
	 * @throws Exception if no item is set for location
	 *
	 * @return $this
	 */
	public function writeItem(ALttPRom $rom, Item $item = null) {
		if ($item) {
			$this->setItem($item);
		}

		if (!$this->item) {
			throw new \Exception('No Item set to be written');
		}

		$item_bytes = $this->item->getBytes();

		foreach ($this->address as $key => $address) {
			if (!isset($item_bytes[$key]) || !isset($address)) continue;
			$rom->write($address, pack('C', $item_bytes[$key]));
		}

		foreach ($this->item->getAddress() as $key => $address) {
			if (!isset($this->bytes[$key]) || !isset($address)) continue;
			$rom->write($address, pack('C', $this->bytes[$key]));
		}

		return $this;
	}

	/**
	 * Get the name of this Location.
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Get the ROM addres of this Location.
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Get the Region of this Location.
	 *
	 * @return Region
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * Convert this to string representation
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->name;
	}
}
