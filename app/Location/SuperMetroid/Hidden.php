<?php namespace ALttP\Location\SuperMetroid;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Super Metroid Hidden Location
 */
class Hidden extends Location {
	/**
	 * Write the Item to this Location in ROM. Will set Item if passed in, and only write if there is an Item set.
	 * @TODO: this is side-affecty
	 *
	 * @param Rom $rom ROM we are writing to
	 * @param Item|null $item item we are going to write
	 *
	 * @throws Exception if no item is set for location
	 *
	 * @return $this
	 */
	public function writeItem(Rom $rom, Item $item = null) {
        if ($item) {
			$this->setItem($item);
		}

		if (!$this->item) {
			throw new \Exception('No Item set to be written');
		}

        $item = $this->item;       

		$item_bytes = $item->getHiddenBytes();

		// foreach ($this->address as $key => $address) {
		// 	if (!isset($item_bytes[$key]) || !isset($address)) continue;
		// 	$rom->write($address, pack('C', $item_bytes[$key]));
		// }

        if(isset($item_bytes) && isset($this->address))
        {
            $rom->write($this->address[0], pack("C", $item_bytes[0]));
            $rom->write($this->address[0] + 1, pack("C", $item_bytes[1]));
        }


		foreach ($item->getAddress() as $key => $address) {
			if (!isset($this->bytes[$key]) || !isset($address)) continue;
			$rom->write($address, pack('C', $this->bytes[$key]));
		}

		return $this;        
    }
}