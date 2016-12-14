<?php namespace Randomizer\Item;

use Randomizer\Item;

class Crystal extends Item {
    protected $extra_bytes;

    public function __construct($name, $nice_name, $byte, $extra_bytes = []) {
        parent::__construct($name, $nice_name, $byte);

        $this->extra_bytes = $extra_bytes;
    }

    public function getExtraBytes() {
        return $this->extra_bytes;
    }
}
