<?php namespace ALttP\Location;

use ALttP\Item;
use ALttP\Item\Crystal;
use ALttP\Item\Pendant;
use ALttP\Location;
use ALttP\Rom;

/**
 * Prize for completing a dungeon. These have the added benefit of being placed on the map.
 */
class Prize extends Location {
	/**
	 * sets the item for this location.
	 *
	 * @param Item|null $item can only be items [Pendant|Crystal] that "complete" a dungeon.
	 *
	 * @return $this
	 */
	public function setItem(Item $item = null) {
		if (!is_a($item, Pendant::class) && !is_a($item, Crystal::class) && $item !== null) {
			throw new \Exception('Trying to set non-Pendant/Crystal in a Prize Location');
		}

		$this->item = $item;
		return $this;
	}

	/**
	 * When writing a prize we also change the music for the region
	 *
	 * @param Rom $rom ROM we are writing to
	 * @param Item $item item we are placing at this location
	 *
	 * @return $this
	 */
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		if (isset($this->region->music_addresses) && is_array($this->region->music_addresses)) {
			if ($this->region->getWorld()->config('rom.mapOnPickup', false)) {
				$music = mt_rand(0, 1) == 0 ? 0x11 : 0x16;
			} else {
				$item = $this->getItem();
				$music = is_a($item, Pendant::class) ? 0x11 : 0x16;
			}

			foreach ($this->region->music_addresses as $address) {
				$rom->write($address, pack('C*', $music));
			}
		}

		return $this;
	}

	/**
	 * Read Item from ROM into this Location.
	 *
	 * @param Rom $rom ROM we are reading from
	 *
	 * @throws Exception if cannot read Item
	 *
	 * @return $this
	 */
	public function readItem(Rom $rom) {
		if (!$this->address[1] || !$this->address[6]) {
			throw new \Exception(sprintf("No Address to read: %s", $this->getName()));
		}

		$read_byte_1 = $rom->read($this->address[1]);
		$read_byte_6 = $rom->read($this->address[6]);

		$this->setItem(Item::getWithBytes([1 => $read_byte_1, 6 => $read_byte_6]));

		return $this;
	}
}
