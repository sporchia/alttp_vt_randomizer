<?php namespace ALttP\Location\Standing;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Hera Basement Location
 */
class HeraBasement extends Location {
	/**
	 * Sets the item for this location. A key normally sits here, so if we get Key as our Item we need
	 * write to a different address.
	 *
	 * @param Item|null $item Item to be placed at this Location
	 *
	 * @return $this
	 */
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		// for quick key pick up or fanfare
		$rom->write(0x4E3BB, pack('C', $this->hasItem(Item::get('Key')) ? 0xE4 : 0xEB));

		return $this;
	}
}
