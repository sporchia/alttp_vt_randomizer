<?php

namespace ALttP\Services;

use ALttP\Support\WorldCollection;

/**
 * Service class to create multiworld files for consumption by the multiworld
 * server.
 */
class MultiworldFileService
{
    /** @var \ALttP\Support\WorldCollection */
    protected $worlds;

    /**
     * Create a new multiworld file service.
     *
     * @param \ALttP\Support\WorldCollection  $worlds  worlds to create hints for
     *
     * @return void
     */
    public function __construct(WorldCollection $worlds)
    {
        $this->worlds = $worlds;
    }

    /**
     * Create the multiworld config file based on world data.
     *
     * @return string
     */
    public function createFile(): string
    {
        return '';
    }
}
