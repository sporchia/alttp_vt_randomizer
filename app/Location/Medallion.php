<?php namespace ALttP\Location;

use ALttP\Item;
use ALttP\Item\Medallion as MedallionItem;
use ALttP\Location;

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
