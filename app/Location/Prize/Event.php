<?php namespace ALttP\Location\Prize;

use ALttP\Location\Prize;
use ALttP\Item;
use ALttP\Item\Event as ItemEvent;

/**
 * Event Location
 */
class Event extends Prize {
	/**
	 * sets the item for this location.
	 *
	 * @param Item|null $item can only be items [Pendant|Crystal] that "complete" a dungeon.
	 *
	 * @return $this
	 */
	public function setItem(Item $item = null) {
		if (!is_a($item, ItemEvent::class) && $item !== null) {
			throw new \Exception('Trying to set non-Event in an Event Prize Location');
		}

		$this->item = $item;
		return $this;
	}

}
