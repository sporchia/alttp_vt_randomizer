<?php namespace ALttP\Drops;

/**
 * A Prize Pack is a set of droppable sprites that can drops
 */
 class PrizePackSlot {
   protected $drop;
   protected $filled = false;

   public function __construct($sprite = null) {
     if ($sprite != null) {
       $this->drop = $sprite;
       $this->filled = true;
     }
   }

   public function getDrop() {
     return $this->drop;
   }

   public function setDrop($sprite) {
     $this->drop = $sprite;
     $this->filled = true;
   }

   public function isFilled() {
     return $this->filled;
   }
 }