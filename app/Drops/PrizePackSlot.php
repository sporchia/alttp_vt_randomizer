<?php namespace ALttP\Drops;

use ALttP\Sprite\Droppable;

/**
 * A Prize Pack slot is a slot that can be filled with a drop
 */
class PrizePackSlot {
	protected $drop = null;
	protected $filled = false;

	/**
	* Constructor for PrizePackSlot class
	*
	* @param Droppable $sprite the sprite to fill the slot with, if any
	*/
	public function __construct(Droppable $sprite = null) {
		$this->drop = $sprite;
	}

	/**
	* Gets the drop in the slot
	*
	* @return Droppable
	*/
	public function getDrop() : Droppable {
		 return $this->drop;
	}

	/**
	* Sets the drop in the slot
	*
	* @param Droppable $sprite the sprite to fill the slot with
	*
	* @return $this
	*/
	public function setDrop($sprite) : self {
		$this->drop = $sprite;

		return $this;
	}

	/**
	* Gets whether the slot is filled with a drop
	*
	* @return bool
	*/
	public function isFilled() : bool {
		 return $this->drop !== null;
	}
}
