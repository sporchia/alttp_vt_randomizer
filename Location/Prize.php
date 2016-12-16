<?php namespace Randomizer\Location;

use Randomizer\ALttPRom;
use Randomizer\Item;
use Randomizer\Item\Crystal;
use Randomizer\Item\Pendant;
use Randomizer\Location;

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
}
