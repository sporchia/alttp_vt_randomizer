<?php namespace ALttP\Drops;

/**
 * A Prize Pack is a set of droppable sprites that can drops
 */
 class PrizePack {
   protected $drops = [];
   protected $name;

   public function __construct($name, $slots) {
     $this->name = $name;
     for ($i = 0; $i < $slots; $i++) {
       $slot = new PrizePackSlot();
       array_push($this->drops, $slot);
     }
   }

   public function getName() {
     return $this->name;
   }

   public function getDrops() {
     return $this->drops;
   }

   public function getEmptyDrops() {
     return array_filter($this->drops, function($slot) {
       return !$slot->isFilled();
     });
   }

 }