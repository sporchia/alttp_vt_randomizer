<?php namespace NoMajorGlitches\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group NMG
 */
class EastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	/**
	 * @param string $location
	 * @param bool $access
	 * @param array $items
	 * @param array $except
	 *
	 * @dataProvider accessPool
	 */
	public function testLocation(string $location, bool $access, array $items, array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}
	
		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->canAccess($this->collected));
	}

	/**
	 * @param string $location
	 * @param bool $access
	 * @param string $medallion
	 * @param array $items
	 * @param array $except
	 *
	 * @dataProvider accessPoolWithMedallion
	 */
	public function testLocationWithMedallion(string $location, bool $access, string $medallion, array $items, array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}
	
		$this->addCollected($items);

		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get($medallion));

		$this->assertEquals($access, $this->world->getLocation($location)
			->canAccess($this->collected));
	}

	public function testMimicCaveRequiresFireRodIfKeysNotInTurtleRockCompassAndChainChompRooms() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveRequiresFireRodIfKeyNotInTurtleRockChainChompRoom() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveRequiresFireRodIfKeyNotInTurtleRockCompassRoom() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertFalse($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function testMimicCaveDoesNotRequireFireRodIfKeysInTurtleRockCompassAndChainChompRooms() {
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - compass room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D7-1F] Turtle Rock - Chain chomp room")->setItem(Item::get('Key'));

		$this->assertTrue($this->world->getLocation("[cave-013] Mimic cave (from Turtle Rock)")
			->canAccess($this->allItemsExcept(['FireRod'])));
	}

	public function accessPoolWithMedallion() {
		return [
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', []],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', [], ['Quake']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', [], ['Gloves', 'Flute']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', [], ['Hammer']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', [], ['MagicMirror']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', [], ['MoonPearl']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Quake', [], ['CaneOfSomaria']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', []],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', [], ['Ether']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', [], ['Gloves', 'Flute']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', [], ['Hammer']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', [], ['MagicMirror']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', [], ['MoonPearl']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Ether', [], ['CaneOfSomaria']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', []],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', [], ['Bombos']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', [], ['Gloves', 'Flute']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', [], ['Hammer']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', [], ['MagicMirror']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', [], ['MoonPearl']],
			["[cave-013] Mimic cave (from Turtle Rock)", false, 'Bombos', [], ['CaneOfSomaria']],
		];
	}

	public function accessPool() {
		return [
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, []],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, [], ['Gloves', 'Flute']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, [], ['Hammer', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['Flute', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-012-1F] Death Mountain - wall of caves - left cave", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top left middle chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [bottom chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right middle chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, []],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-1F] Death Mountain - wall of caves - right cave [top right chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, []],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [left chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],

			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, []],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, [], ['Gloves', 'Flute']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, [], ['MagicMirror', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, [], ['Hammer', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", false, ['ProgressiveGlove', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['Flute', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["[cave-009-B1] Death Mountain - wall of caves - right cave [right chest]", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
		];
	}
}
