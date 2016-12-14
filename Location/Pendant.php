<?php namespace Randomizer\Location;

use Randomizer\ALttPRom;
use Randomizer\Item;
use Randomizer\Item\Pendant as PendantItem;
use Randomizer\Location;

class Pendant extends Location {

	public function setItem(Item $item = null) {
		if (!is_a($item, PendantItem::class)) {
			throw new \Exception('Trying to set non-Pendant in a Pendant Location');
		}

		$this->item = $item;
		return $this;
	}

	public function writeItem(ALttPRom $rom, Item $item = null) {
		if ($item) {
			$this->setItem($item);
		}

		$item_bytes = $this->item->getExtraBytes();

		if (count($item_bytes) != count($this->address)) {
			return false;
		}

		foreach ($this->address as $key => $address) {
			$rom->write($address, pack('c', $item_bytes[$key]));
		}
	}
}
