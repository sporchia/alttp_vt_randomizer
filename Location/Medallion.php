<?php namespace Randomizer\Location;

use Randomizer\Item;
use Randomizer\Item\Medallion as MedallionItem;
use Randomizer\Location;

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
}
