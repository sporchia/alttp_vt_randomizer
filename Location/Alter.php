<?php namespace Randomizer\Location;

use Randomizer\Location;
use Randomizer\Item;

/**
 * Master Sword Alter Location
 */
class Alter extends Location {
	/**
	 * Sets the item for this location. The L2Sword normally sits here, so if we get MasterSword as our Item we need to
	 * change it to the L2Sword, it will make the pulling of the sword look better.
	 *
	 * @param Item|null $item Item to be placed at this Location
	 *
	 * @return $this
	 */
	public function setItem(Item $item = null) {
		if ($item == Item::get('MasterSword')) {
			$item = Item::get('L2Sword');
		}

		return parent::setItem($item);
	}

}
