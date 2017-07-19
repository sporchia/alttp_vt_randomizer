<?php namespace OverworldGlitches\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group OverworldGlitches
 */
class EastTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'OverworldGlitches');
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

	public function accessPool() {
		return [
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", false, []],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp']],

			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", false, []],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Flute']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp']],
			["[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp']],

			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", false, []],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", false, [], ['Gloves']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", false, [], ['MoonPearl']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Flute', 'PegasusBoots']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Flute', 'PegasusBoots']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'MagicMirror', 'Hammer', 'Lamp', 'PegasusBoots']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]", true, ['MoonPearl', 'TitansMitt', 'MagicMirror', 'Hammer', 'Lamp', 'PegasusBoots']],

			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", false, []],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", false, [], ['Gloves']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", false, [], ['MoonPearl']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],

			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", false, []],
			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", false, [], ['Gloves']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", false, [], ['MoonPearl']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top left chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],

			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", false, []],
			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", false, [], ['Gloves']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", false, [], ['MoonPearl']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Flute']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove', 'Hookshot', 'Lamp']],
			["[cave-056] Dark World Death Mountain - cave under boulder [top right chest]", true, ['MoonPearl', 'TitansMitt', 'Hookshot', 'Lamp']],
		];
	}
}
