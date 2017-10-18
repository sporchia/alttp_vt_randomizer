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

	public function accessPoolWithMedallion() {
		return [
			["Mimic Cave", false, 'Quake', []],
			["Mimic Cave", false, 'Quake', [], ['Quake']],
			["Mimic Cave", false, 'Quake', [], ['Gloves', 'Flute']],
			["Mimic Cave", false, 'Quake', [], ['Hammer']],
			["Mimic Cave", false, 'Quake', [], ['MagicMirror']],
			["Mimic Cave", false, 'Quake', [], ['MoonPearl']],
			["Mimic Cave", false, 'Quake', [], ['CaneOfSomaria']],
			["Mimic Cave", false, 'Ether', []],
			["Mimic Cave", false, 'Ether', [], ['Ether']],
			["Mimic Cave", false, 'Ether', [], ['Gloves', 'Flute']],
			["Mimic Cave", false, 'Ether', [], ['Hammer']],
			["Mimic Cave", false, 'Ether', [], ['MagicMirror']],
			["Mimic Cave", false, 'Ether', [], ['MoonPearl']],
			["Mimic Cave", false, 'Ether', [], ['CaneOfSomaria']],
			["Mimic Cave", false, 'Bombos', []],
			["Mimic Cave", false, 'Bombos', [], ['Bombos']],
			["Mimic Cave", false, 'Bombos', [], ['Gloves', 'Flute']],
			["Mimic Cave", false, 'Bombos', [], ['Hammer']],
			["Mimic Cave", false, 'Bombos', [], ['MagicMirror']],
			["Mimic Cave", false, 'Bombos', [], ['MoonPearl']],
			["Mimic Cave", false, 'Bombos', [], ['CaneOfSomaria']],
		];
	}

	public function accessPool() {
		return [
			["Spiral Cave", false, []],
			["Spiral Cave", false, [], ['Gloves', 'Flute']],
			["Spiral Cave", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Spiral Cave", false, [], ['MagicMirror', 'Hookshot']],
			["Spiral Cave", false, [], ['Hammer', 'Hookshot']],
			["Spiral Cave", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Spiral Cave", false, ['ProgressiveGlove', 'Hookshot']],
			["Spiral Cave", false, ['Flute', 'MagicMirror']],
			["Spiral Cave", false, ['Flute', 'Hammer']],
			["Spiral Cave", true, ['Flute', 'Hookshot']],
			["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Spiral Cave", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Spiral Cave", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Spiral Cave", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Spiral Cave", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Spiral Cave", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Spiral Cave", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Far Left", false, []],
			["Paradox Cave Lower - Far Left", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Lower - Far Left", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Lower - Far Left", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Lower - Far Left", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Lower - Far Left", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Lower - Far Left", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Lower - Far Left", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Lower - Far Left", false, ['Flute', 'Hammer']],
			["Paradox Cave Lower - Far Left", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Left", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Left", false, []],
			["Paradox Cave Lower - Left", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Lower - Left", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Lower - Left", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Lower - Left", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Lower - Left", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Lower - Left", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Lower - Left", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Lower - Left", false, ['Flute', 'Hammer']],
			["Paradox Cave Lower - Left", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Left", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Middle", false, []],
			["Paradox Cave Lower - Middle", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Lower - Middle", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Lower - Middle", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Lower - Middle", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Lower - Middle", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Lower - Middle", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Lower - Middle", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Lower - Middle", false, ['Flute', 'Hammer']],
			["Paradox Cave Lower - Middle", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Middle", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Middle", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Middle", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Middle", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Right", false, []],
			["Paradox Cave Lower - Right", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Lower - Right", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Lower - Right", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Lower - Right", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Lower - Right", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Lower - Right", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Lower - Right", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Lower - Right", false, ['Flute', 'Hammer']],
			["Paradox Cave Lower - Right", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Right", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Lower - Far Right", false, []],
			["Paradox Cave Lower - Far Right", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Lower - Far Right", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Lower - Far Right", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Lower - Far Right", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Lower - Far Right", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Lower - Far Right", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Lower - Far Right", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Lower - Far Right", false, ['Flute', 'Hammer']],
			["Paradox Cave Lower - Far Right", true, ['Flute', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Lower - Far Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Lower - Far Right", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Upper - Left", false, []],
			["Paradox Cave Upper - Left", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Upper - Left", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Upper - Left", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Upper - Left", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Upper - Left", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Upper - Left", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Upper - Left", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Upper - Left", false, ['Flute', 'Hammer']],
			["Paradox Cave Upper - Left", true, ['Flute', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Left", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Left", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Left", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Left", true, ['Flute', 'MagicMirror', 'Hammer']],

			["Paradox Cave Upper - Right", false, []],
			["Paradox Cave Upper - Right", false, [], ['Gloves', 'Flute']],
			["Paradox Cave Upper - Right", false, [], ['MagicMirror', 'Hammer', 'Hookshot']],
			["Paradox Cave Upper - Right", false, [], ['MagicMirror', 'Hookshot']],
			["Paradox Cave Upper - Right", false, [], ['Hammer', 'Hookshot']],
			["Paradox Cave Upper - Right", false, ['ProgressiveGlove', 'Lamp', 'MagicMirror']],
			["Paradox Cave Upper - Right", false, ['ProgressiveGlove', 'Hookshot']],
			["Paradox Cave Upper - Right", false, ['Flute', 'MagicMirror']],
			["Paradox Cave Upper - Right", false, ['Flute', 'Hammer']],
			["Paradox Cave Upper - Right", true, ['Flute', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'Hookshot']],
			["Paradox Cave Upper - Right", true, ['ProgressiveGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Right", true, ['PowerGlove', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Right", true, ['TitansMitt', 'Lamp', 'MagicMirror', 'Hammer']],
			["Paradox Cave Upper - Right", true, ['Flute', 'MagicMirror', 'Hammer']],
		];
	}
}
