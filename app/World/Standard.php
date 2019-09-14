<?php

namespace ALttP\World;

use ALttP\Region;
use ALttP\World;

class Standard extends World
{
    /**
     * Create a new world and initialize all of the Regions within it
     *
     * @param int    $id      Id of this world
     * @param array  $config  config for this world
     *
     * @return void
     */
    public function __construct(int $id = 0, array $config = [])
    {
        $this->id = $id;
        $this->config = array_merge([
            'difficulty' => 'normal',
            'logic' => 'NoGlitches',
            'goal' => 'ganon',
        ], $config);

        $this->regions = [
            'North East Light World' => new Region\Standard\LightWorld\NorthEast($this),
            'North West Light World' => new Region\Standard\LightWorld\NorthWest($this),
            'South Light World' => new Region\Standard\LightWorld\South($this),
            'Escape' => new Region\Standard\HyruleCastleEscape($this),
            'Eastern Palace' => new Region\Standard\EasternPalace($this),
            'Desert Palace' => new Region\Standard\DesertPalace($this),
            'West Death Mountain' => new Region\Standard\LightWorld\DeathMountain\West($this),
            'East Death Mountain' => new Region\Standard\LightWorld\DeathMountain\East($this),
            'Tower of Hera' => new Region\Standard\TowerOfHera($this),
            'Hyrule Castle Tower' => new Region\Standard\HyruleCastleTower($this),
            'East Dark World Death Mountain' => new Region\Standard\DarkWorld\DeathMountain\East($this),
            'West Dark World Death Mountain' => new Region\Standard\DarkWorld\DeathMountain\West($this),
            'North East Dark World' => new Region\Standard\DarkWorld\NorthEast($this),
            'North West Dark World' => new Region\Standard\DarkWorld\NorthWest($this),
            'South Dark World' => new Region\Standard\DarkWorld\South($this),
            'Mire' => new Region\Standard\DarkWorld\Mire($this),
            'Palace of Darkness' => new Region\Standard\PalaceOfDarkness($this),
            'Swamp Palace' => new Region\Standard\SwampPalace($this),
            'Skull Woods' => new Region\Standard\SkullWoods($this),
            'Thieves Town' => new Region\Standard\ThievesTown($this),
            'Ice Palace' => new Region\Standard\IcePalace($this),
            'Misery Mire' => new Region\Standard\MiseryMire($this),
            'Turtle Rock' => new Region\Standard\TurtleRock($this),
            'Ganons Tower' => new Region\Standard\GanonsTower($this),
            'Medallions' => new Region\Standard\Medallions($this),
            'Fountains' => new Region\Standard\Fountains($this),
        ];

        parent::__construct($id, $config);
    }
}
