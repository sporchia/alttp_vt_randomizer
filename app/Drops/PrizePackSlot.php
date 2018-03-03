<?php namespace ALttP\Drops;

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
   public function __construct($sprite = null) {
     if ($sprite != null) {
       $this->drop = $sprite;
       $this->filled = true;
     }
   }

   /**
   * Gets the drop in the slot
   *
   * @return Droppable
   */
   public function getDrop() {
     return $this->drop;
   }

   /**
   * Sets the drop in the slot
   *
   * @param Droppable $sprite the sprite to fill the slot with
   */
   public function setDrop($sprite) {
     $this->drop = $sprite;
     $this->filled = true;
   }

   /**
   * Gets whether the slot is filled with a drop
   *
   * @return boolean
   */
   public function isFilled() {
     return $this->filled;
   }
 }
