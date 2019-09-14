<?php

namespace ALttP\Contracts;

/**
 * The basic definition of a Randomizer must be able to randomize and return
 * worlds.
 */
interface Randomizer
{
    /**
     * Fill all empty Locations with Items using logic from the World. This is
     * achieved by first setting up base portions of the world. Then taking the
     * remaining empty locations we order them, and try to fill them in order in
     * a way that opens more locations.
     *
     * @return void
     */
    public function randomize(): void;

    /**
     * Get all the worlds being randomized.
     *
     * @return array
     */
    public function getWorlds(): array;
}
