<?php namespace ALttP\Drops;

/**
 * A Prize Pack is a set of droppable sprites that can drop from killed enemies or other means
 */
 class PrizePack {
   protected $drops = [];
   protected $name;

  /**
  * Constructor for PrizePack class
  *
  * @param String $name the name of the Prize Pack
  * @param int $slots the number of slots the Prize Pack has
  */
   public function __construct($name, $slots) {
     $this->name = $name;
     for ($i = 0; $i < $slots; $i++) {
       $slot = new PrizePackSlot();
       array_push($this->drops, $slot);
     }
   }

   /**
   * Gets the name of the Prize Pack
   *
   * @return String
   */
   public function getName() {
     return $this->name;
   }

   /**
   * Gets the Prize Pack Slots within the prize pack
   *
   * @return array
   */
   public function getDrops() {
     return $this->drops;
   }

   /**
   * Gets the Prize Pack Slots within the prize pack that are not filled
   *
   * @return array
   */
   public function getEmptyDrops() {
     return array_filter($this->drops, function($slot) {
       return !$slot->isFilled();
     });
   }
 }
