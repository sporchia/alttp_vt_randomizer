<?php namespace ALttP\Location;

use ALttP\Item;
use ALttP\Item\Medallion as MedallionItem;
use ALttP\Location;
use ALttP\Rom;

/**
 * Medallion required Location. E.g. Turtle Rock entrance.
 */
class Medallion extends Location {

	/**
	 * sets the item for this location.
	 *
	 * @param Item|null $item can only be magic items that unlock something.
	 *
	 * @return $this
	 */
	public function setItem(Item $item = null) {
		if (!is_a($item, MedallionItem::class) && $item !== null) {
			throw new \Exception('Trying to set non-Medallion in a Medallion Location');
		}

		$this->item = $item;
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
		if (!$this->address[1]) {
			throw new \Exception(sprintf("No Address to read: %s", $this->getName()));
		}

		$read_byte = $rom->read($this->address[1]);

		$this->setItem(Item::getWithBytes([1 => $read_byte]));

		return $this;
	}
}
