<?php namespace Randomizer;

use Randomizer\Support\LocationCollection;

/**
 * This is the container for all the regions and locations one can find items in the game.
 */
class World {
	protected $regions = [];
	protected $locations;

	/**
	 * Create a new world and initialize all of the Regions within it
	 *
	 * @param string $type Ruleset to use when deciding if Locations can be reached
	 *
	 * @return void
	 */
	public function __construct($type = 'NoMajorGlitches') {
		$this->regions = [
			'Light World' => new Region\LightWorld($this),
			'Escape' => new Region\HyruleCastleEscape($this),
			'Eastern Palace' => new Region\EasternPalace($this),
			'Desert Palace' => new Region\DesertPalace($this),
			'Death Mountain' => new Region\DeathMountain($this),
			'Tower of Hera' => new Region\TowerOfHera($this),
			'Hyrule Castle Tower' => new Region\HyruleCastleTower($this),
			'Dark World' => new Region\DarkWorld($this),
			'Palace of Darkness' => new Region\PalaceOfDarkness($this),
			'Swamp Palace' => new Region\SwampPalace($this),
			'Skull Woods' => new Region\SkullWoods($this),
			'Thieves Town' => new Region\ThievesTown($this),
			'Ice Palace' => new Region\IcePalace($this),
			'Misery Mire' => new Region\MiseryMire($this),
			'Turtle Rock' => new Region\TurtleRock($this),
			'Ganons Tower' => new Region\GanonsTower($this),
			'Pendants' => new Region\Pendants($this),
			'Crystals' => new Region\Crystals($this),
			'Swords' => new Region\Swords($this),
			'Medallions' => new Region\Medallions($this),
			'Fountains' => new Region\Fountains($this),
		];

		$this->locations = new LocationCollection;

		foreach ($this->regions as $name => $region) {
			$region->init($type);
			$this->locations = $this->locations->merge($region->getLocations());
			switch ($name) {
				case 'Eastern Palace':
					$region->setPrizeLocation($this->regions['Pendants']->getLocation("Eastern Palace Pendant"));
					break;
				case 'Desert Palace':
					$region->setPrizeLocation($this->regions['Pendants']->getLocation("Desert Palace Pendant"));
					break;
				case 'Tower of Hera':
					$region->setPrizeLocation($this->regions['Pendants']->getLocation("Tower of Hera Pendant"));
					break;
				case 'Palace of Darkness':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Palace of Darkness Crystal"));
					break;
				case 'Swamp Palace':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Swamp Palace Crystal"));
					break;
				case 'Skull Woods':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Skull Woods Crystal"));
					break;
				case 'Thieves Town':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Thieves Town Crystal"));
					break;
				case 'Ice Palace':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Ice Palace Crystal"));
					break;
				case 'Misery Mire':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Misery Mire Crystal"));
					break;
				case 'Turtle Rock':
					$region->setPrizeLocation($this->regions['Crystals']->getLocation("Turtle Rock Crystal"));
					break;
			}
		}
	}

	/**
	 * Get a region by Key name
	 *
	 * @param string $name Name of region to return
	 *
	 * @return Region
	 */
	public function getRegion(string $name) {
		return $this->regions[$name];
	}

	/**
	 * Get all the Regions in this world
	 *
	 * @return array
	 */
	public function getRegions() {
		return $this->regions;
	}

	/**
	 * Get all the Locations in all Regions in this world
	 *
	 * @return LocationCollection
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * Get Location in this world by name
	 *
	 * @var string $name name of the Location
	 *
	 * @return Location
	 */
	public function getLocation(string $name) {
		return $this->locations[$name];
	}

	/**
	 * Get all the Locations that contain the requested Item
	 *
	 * @param Item|null $item item we are looking for
	 *
	 * @return LocationCollection
	 */
	public function getLocationsWithItem(Item $item = null) {
		return $this->locations->locationsWithItem($item);
	}

	/**
	 * Get all the Regions that contain the requested Item
	 *
	 * @param Item|null $item item we are looking for
	 *
	 * @return array
	 */
	public function getRegionsWithItem(Item $item = null) {
		return $this->getLocationsWithItem($item)->getRegions();
	}
}
