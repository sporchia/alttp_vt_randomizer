<?php namespace ALttP\Location;

use ALttP\Item;
use ALttP\Location;
use ALttP\Rom;

/**
 * Dash type Location. E.g. Library
 */
class Dash extends Location {

	/**
	 * Override key writes so that the pickup animation isn't shown when it doesn't need to be
	 *
	 * @param Rom $rom ROM we are writing to
	 * @param Item|null $item item we are going to write
	 *
	 * @throws Exception if no item is set for location
	 *
	 * @return $this
	 */
	public function writeItem(Rom $rom, Item $item = null) {
		$current_item = $item ?? $this->item;

		if ($current_item instanceof Item\Key
			&& $this->region->isRegionItem($current_item)) {
			$item = Item::get('Key');
		}

		parent::writeItem($rom, $item);

		$this->item = $current_item;

		return $this;
	}
}
