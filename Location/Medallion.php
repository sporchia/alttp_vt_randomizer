<?php namespace Randomizer\Location;

use Randomizer\ALttPRom;
use Randomizer\Item;
use Randomizer\Item\Medallion as MedallionItem;
use Randomizer\Location;

class Medallion extends Location {

	public function setItem(Item $item = null) {
		if (!is_a($item, MedallionItem::class)) {
			throw new \Exception('Trying to set non-Medallion in a Medallion Location');
		}

		$this->item = $item;
		return $this;
	}

	public function writeItem(ALttPRom $rom, Item $item = null) {
		if ($item) {
			$this->setItem($item);
		}

		$item_bytes = $this->item->getExtraBytes();

		foreach ($this->address as $key => $address) {
			if (!array_key_exists($key, $item_bytes)) continue;

			$rom->write($address, pack('c', $item_bytes[$key]));
		}
	}
}
