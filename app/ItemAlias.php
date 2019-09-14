<?php

namespace ALttP;

/**
 * Alias Item type, this allows us to use an item as if it were another item in the logic. For the current use case, it
 * will count both items in ItemCollections though
 */
class ItemAlias extends Item
{
    protected $name;
    protected $target;

    /**
     * Create a new Item
     *
     * @param string $name Unique name of alias
     * @param string $target name of target to alias
     *
     * @return void
     */
    public function __construct(string $name, string $target, World $world)
    {
        parent::__construct($name, [], $world);

        $this->name = $name;
        $this->target = Item::get($target, $world);
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget(Item $item)
    {
        $this->target = $item;

        return $this;
    }

    /**
     * Get the name of this Item
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name . ':' . $this->world->id;
    }

    /**
     * Get the nice name of this Item
     *
     * @return string
     */
    public function getNiceName(): string
    {
        return $this->target->getNiceName();
    }

    /**
     * Get the bytes to write
     *
     * @return array
     */
    public function getBytes()
    {
        return $this->target->getBytes();
    }

    public function getLinkedRegion()
    {
        return $this->target->getLinkedRegion();
    }

    /**
     * serialized version of Item
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name . serialize($this->target->getBytes());
    }
}
