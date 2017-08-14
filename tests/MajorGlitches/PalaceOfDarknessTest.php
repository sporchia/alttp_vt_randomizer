<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class PalaceOfDarknessTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	/**
	 * @param string $location
	 * @param bool $access
	 * @param string $item
	 * @param array $items
	 * @param array $except
	 *
	 * @dataProvider fillPool
	 */
	public function testFillLocation(string $location, bool $access, string $item, array $items = [], array $except = []) {
		if (count($except)) {
			$this->collected = $this->allItemsExcept($except);
		}

		$this->addCollected($items);

		$this->assertEquals($access, $this->world->getLocation($location)
			->fill(Item::get($item), $this->collected));
	}

	public function fillPool() {
		return [
			["[dungeon-D1-1F] Dark Palace - big key room", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - big chest", false, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - compass room", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - spike statue room", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - statue push room", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, 'BigKeyD1', [], ['BigKeyD1']],

			["[dungeon-D1-B1] Dark Palace - shooter room", true, 'BigKeyD1', [], ['BigKeyD1']],

			["Heart Container - Helmasaur King", false, 'BigKeyD1', [], ['BigKeyD1']],
		];
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

	public function accessPool() {
		return [
			["[dungeon-D1-1F] Dark Palace - big key room", false, []],
			["[dungeon-D1-1F] Dark Palace - big key room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - big key room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - big key room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - big key room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - big key room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - big key room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", false, []],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", false, [], ['AnyBow']],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, ['Bow', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, ['Bow', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, ['Bow', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, ['Bow', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, ['Bow', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - jump room [right chest]", true, ['Bow', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", false, []],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['KeyD1', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['Bow', 'Hammer', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['Bow', 'Hammer', 'MoonPearl', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['Bow', 'Hammer', 'MoonPearl', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - jump room [left chest]", true, ['Bow', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - big chest", false, []],
			["[dungeon-D1-1F] Dark Palace - big chest", false, [], ['Lamp']],
			["[dungeon-D1-1F] Dark Palace - big chest", false, [], ['BigKeyD1']],
			["[dungeon-D1-1F] Dark Palace - big chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - big chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - big chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - big chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - big chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - big chest", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - compass room", false, []],
			["[dungeon-D1-1F] Dark Palace - compass room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - compass room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - compass room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - compass room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - compass room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - compass room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - spike statue room", false, []],
			["[dungeon-D1-1F] Dark Palace - spike statue room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - spike statue room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - spike statue room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - spike statue room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - spike statue room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - spike statue room", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", false, []],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['KeyD1', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['KeyD1', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['KeyD1', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['KeyD1', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['KeyD1', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['KeyD1', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['Bow', 'Hammer', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['Bow', 'Hammer', 'MoonPearl', 'PowerGlove']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['Bow', 'Hammer', 'MoonPearl', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - turtle stalfos room", true, ['Bow', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],

			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", false, []],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", false, [], ['Lamp']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [left chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", false, []],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", false, [], ['Lamp']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - room leading to Helmasaur [right chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'Lamp', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - statue push room", false, []],
			["[dungeon-D1-1F] Dark Palace - statue push room", false, [], ['AnyBow']],
			["[dungeon-D1-1F] Dark Palace - statue push room", true, ['Bow', 'MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - statue push room", true, ['Bow', 'MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - statue push room", true, ['Bow', 'MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - statue push room", true, ['Bow', 'MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - statue push room", true, ['Bow', 'MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - statue push room", true, ['Bow', 'MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", false, []],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", false, [], ['Lamp']],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - maze room [top chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", false, []],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", false, [], ['Lamp']],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'DefeatAgahnim']],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-1F] Dark Palace - maze room [bottom chest]", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'MoonPearl', 'Lamp', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["[dungeon-D1-B1] Dark Palace - shooter room", false, []],
			["[dungeon-D1-B1] Dark Palace - shooter room", true, ['MoonPearl', 'DefeatAgahnim']],
			["[dungeon-D1-B1] Dark Palace - shooter room", true, ['MoonPearl', 'Hammer', 'PowerGlove']],
			["[dungeon-D1-B1] Dark Palace - shooter room", true, ['MoonPearl', 'Hammer', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - shooter room", true, ['MoonPearl', 'Hammer', 'ProgressiveGlove']],
			["[dungeon-D1-B1] Dark Palace - shooter room", true, ['MoonPearl', 'Flippers', 'TitansMitt']],
			["[dungeon-D1-B1] Dark Palace - shooter room", true, ['MoonPearl', 'Flippers', 'ProgressiveGlove', 'ProgressiveGlove']],

			["Heart Container - Helmasaur King", false, []],
			["Heart Container - Helmasaur King", false, [], ['Lamp']],
			["Heart Container - Helmasaur King", false, [], ['Hammer']],
			["Heart Container - Helmasaur King", false, [], ['AnyBow']],
			["Heart Container - Helmasaur King", false, [], ['BigKeyD1']],
			["Heart Container - Helmasaur King", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'Bow', 'DefeatAgahnim']],
			["Heart Container - Helmasaur King", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'Bow', 'PowerGlove']],
			["Heart Container - Helmasaur King", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'Bow', 'TitansMitt']],
			["Heart Container - Helmasaur King", true, ['KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'KeyD1', 'BigKeyD1', 'MoonPearl', 'Lamp', 'Hammer', 'Bow', 'ProgressiveGlove']],
		];
	}
}
