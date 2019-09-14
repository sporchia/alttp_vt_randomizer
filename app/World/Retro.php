<?php

namespace ALttP\World;

class Retro extends Open
{
    /**
     * Create a new world and initialize all of the Regions within it.
     * In Retro we force certain config values that cannot be overriden.
     *
     * @param int    $id      Id of this world
     * @param array  $config  config for this world
     *
     * @return void
     */
    public function __construct(int $id = 0, array $config = [])
    {
        parent::__construct($id, array_merge($config, [
            'rom.rupeeBow' => true,
            'rom.genericKeys' => true,
            'region.takeAnys' => true,
            'region.wildKeys' => true,
        ]));
    }
}
