<?php namespace Randomizer;

use Randomizer\Support\LocationCollection;

class Location {
	protected $name;
	protected $address;
	protected $bytes;
	protected $region;
	protected $requirement_callback;
	protected $item = null;

	public function __construct($name, $address, $bytes = null, Region $region = null, Callable $requirement_callback = null) {
		$this->name = $name;
		$this->address = (array) $address;
		$this->bytes = (array) $bytes;
		$this->region = $region;
		$this->requirement_callback = $requirement_callback;
	}

	public function fill(Item $item, $items) {
		if ($this->canFill($item, $items)) {
			$this->setItem($item);
			return true;
		}

		return false;
	}

	public function canFill(Item $item, $items) {
			return $this->canAccess($items);
	}

	public function canAccess($items) {
		if (!$this->region->canEnter($this->region->getWorld()->getLocations(), $items)) {
			return false;
		}

		if (!$this->requirement_callback || call_user_func($this->requirement_callback, $this->region->getWorld()->getLocations(), $items)) {
			return true;
		}

		return false;
	}

	public function setRequirements(Callable $callback) {
		$this->requirement_callback = $callback;
	}

	public function setItem(Item $item = null) {
		$this->item = $item;
		return $this;
	}

	public function hasItem(Item $item = null) {
		return $item ? $this->item == $item : $this->item !== null;
	}

	public function getItem() {
		return $this->item;
	}

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
	}

	public function getName() {
		return $this->name;
	}

	public function getAddress() {
		return $this->address;
	}

	public function getRegion() {
		return $this->region;
	}

	public function __toString() {
		return $this->name;
	}
}
