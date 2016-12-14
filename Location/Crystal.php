<?php namespace Randomizer\Location;

use Randomizer\ALttPRom;
use Randomizer\Item;
use Randomizer\Item\Crystal as CrystalItem;
use Randomizer\Location;

class Crystal extends Location {

	public function setItem(Item $item = null) {
		if (!is_a($item, CrystalItem::class)) {
			throw new \Exception('Trying to set non-Crystal in a Crystal Location');
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
