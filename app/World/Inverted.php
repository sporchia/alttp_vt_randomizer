<?php namespace ALttP\World;

use ALttP\Region;
use ALttP\World;

class Inverted extends World {
	/**
	 * Create a new world and initialize all of the Regions within it
	 *
	 * @param string $difficulty difficulty from config to apply to randomization
	 * @param string $logic Ruleset to use when deciding if Locations can be reached
	 * @param string $goal Goal of the game
	 * @param string $variation modifications to difficulty
	 *
	 * @return void
	 */
	public function __construct($difficulty = 'normal', $logic = 'NoGlitches', $goal = 'ganon', $variation = 'none') {
		$this->difficulty = $difficulty;
		$this->variation = $variation;
		$this->logic = in_array($logic, ['None', 'OverworldGlitches', 'NoGlitches']) ? $logic : 'NoGlitches'; // currently only support for No Glicthes and None logic
		$this->goal = $goal;

		$this->regions = [
			'North East Light World' => new Region\Inverted\LightWorld\NorthEast($this),
			'North West Light World' => new Region\Inverted\LightWorld\NorthWest($this),
			'South Light World' => new Region\Inverted\LightWorld\South($this),
			'Escape' => new Region\Inverted\HyruleCastleEscape($this),
			'Eastern Palace' => new Region\Inverted\EasternPalace($this),
			'Desert Palace' => new Region\Inverted\DesertPalace($this),
			'West Death Mountain' => new Region\Inverted\LightWorld\DeathMountain\West($this),
			'East Death Mountain' => new Region\Inverted\LightWorld\DeathMountain\East($this),
			'Tower of Hera' => new Region\Inverted\TowerOfHera($this),
			'Hyrule Castle Tower' => new Region\Inverted\HyruleCastleTower($this),
			'East Dark World Death Mountain' => new Region\Inverted\DarkWorld\DeathMountain\East($this),
			'West Dark World Death Mountain' => new Region\Inverted\DarkWorld\DeathMountain\West($this),
			'North East Dark World' => new Region\Inverted\DarkWorld\NorthEast($this),
			'North West Dark World' => new Region\Inverted\DarkWorld\NorthWest($this),
			'South Dark World' => new Region\Inverted\DarkWorld\South($this),
			'Mire' => new Region\Inverted\DarkWorld\Mire($this),
			'Palace of Darkness' => new Region\Inverted\PalaceOfDarkness($this),
			'Swamp Palace' => new Region\Inverted\SwampPalace($this),
			'Skull Woods' => new Region\Inverted\SkullWoods($this),
			'Thieves Town' => new Region\Inverted\ThievesTown($this),
			'Ice Palace' => new Region\Inverted\IcePalace($this),
			'Misery Mire' => new Region\Inverted\MiseryMire($this),
			'Turtle Rock' => new Region\Inverted\TurtleRock($this),
			'Ganons Tower' => new Region\Inverted\GanonsTower($this),
			'Medallions' => new Region\Standard\Medallions($this),
			'Fountains' => new Region\Standard\Fountains($this),
		];

		parent::__construct($difficulty, $this->logic, $goal, $variation);
	}
}
