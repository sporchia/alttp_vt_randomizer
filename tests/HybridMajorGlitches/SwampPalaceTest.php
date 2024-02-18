<?php

namespace HybridMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group HybridMajorGlitches
 */
class SwampPalaceTest extends TestCase {
  public function setUp(): void {
    parent::setUp();
    $this->world = World::factory('standard', ['difficulty' => 'test_rules', 'logic' => 'HybridMajorGlitches']);
    $this->addCollected(['RescueZelda']);
    $this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether', $this->world));
    $this->collected->setChecksForWorld($this->world->id);
  }

  public function tearDown(): void {
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
      ->fill(Item::get($item, $this->world), $this->collected));
  }

  /**
   * @param bool $access
   * @param array $items
   * @param array $except
   *
   * @dataProvider entryPool
   */
  public function testEntry(bool $access, array $items, array $except = []) {
    if (count($except)) {
      $this->collected = $this->allItemsExcept($except);
    }

    $this->addCollected($items);

    $this->assertEquals($access, $this->world->getRegion('Swamp Palace')
      ->canEnter($this->world->getLocations(), $this->collected));
  }

  public function entryPool() {
    return [
      [false, []],
      [false, ['PegasusBoots', 'Lamp', 'Flippers', 'MoonPearl', 'UncleSword', 'Ether', 'BigKeyP3']],
      [true, [], ['MagicMirror']],
      [true, ['PegasusBoots', 'MagicMirror', 'Flippers', 'MoonPearl']],
      [true, ['PegasusBoots', 'Lamp', 'Flippers', 'MoonPearl', 'UncleSword', 'Ether', 'KeyD6', 'KeyD6', 'KeyD6', 'BigKeyD6']],
    ];
  }

  public function fillPool() {
    return [
      ["Swamp Palace - Entrance", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Entrance", true, 'KeyD2', [], ['KeyD2']],
      ["Swamp Palace - Entrance", true, 'Ether', [], ['Ether']],
      ["Swamp Palace - Big Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Big Key Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Map Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - West Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Compass Chest", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Flooded Room - Left", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Flooded Room - Right", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Waterfall Room", true, 'BigKeyD2', [], ['BigKeyD2']],
      ["Swamp Palace - Boss", true, 'BigKeyD2', [], ['BigKeyD2']],
    ];
  }

  public function accessPool() {
    return [
      ["Swamp Palace - Entrance", false, []],
      ["Swamp Palace - Entrance", false, [], ['MoonPearl']],
      ["Swamp Palace - Entrance", false, [], ['Flippers']],
      ["Swamp Palace - Entrance", true, ['MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots']],

      ["Swamp Palace - Big Chest", false, []],
      ["Swamp Palace - Big Chest", false, [], ['MoonPearl']],
      ["Swamp Palace - Big Chest", false, [], ['Flippers']],
      ["Swamp Palace - Big Chest", false, ['BigKeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'KeyD6', 'KeyD6', 'Ether', 'UncleSword']],
      ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer']],
      ["Swamp Palace - Big Chest", true, ['BigKeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'KeyD6', 'KeyD6', 'KeyD6', 'Ether', 'UncleSword']],
      ["Swamp Palace - Big Chest", true, ['BigKeyD6', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'KeyD6', 'KeyD6', 'KeyD6', 'Ether', 'UncleSword']],

      ["Swamp Palace - Big Key Chest", false, []],
      ["Swamp Palace - Big Key Chest", false, [], ['MoonPearl']],
      ["Swamp Palace - Big Key Chest", false, [], ['Flippers']],
      ["Swamp Palace - Big Key Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer']],

      ["Swamp Palace - Map Chest", false, []],
      ["Swamp Palace - Map Chest", false, [], ['MoonPearl']],
      ["Swamp Palace - Map Chest", false, [], ['Flippers']],
      ["Swamp Palace - Map Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots']],

      ["Swamp Palace - West Chest", false, []],
      ["Swamp Palace - West Chest", false, [], ['MoonPearl']],
      ["Swamp Palace - West Chest", false, [], ['Flippers']],
      ["Swamp Palace - West Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer']],

      ["Swamp Palace - Compass Chest", false, []],
      ["Swamp Palace - Compass Chest", false, [], ['MoonPearl']],
      ["Swamp Palace - Compass Chest", false, [], ['Flippers']],
      ["Swamp Palace - Compass Chest", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer']],

      ["Swamp Palace - Flooded Room - Left", false, []],
      ["Swamp Palace - Flooded Room - Left", false, [], ['MoonPearl']],
      ["Swamp Palace - Flooded Room - Left", false, [], ['Flippers']],
      ["Swamp Palace - Flooded Room - Left", false, [], ['Hookshot']],
      ["Swamp Palace - Flooded Room - Left", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],

      ["Swamp Palace - Flooded Room - Right", false, []],
      ["Swamp Palace - Flooded Room - Right", false, [], ['MoonPearl']],
      ["Swamp Palace - Flooded Room - Right", false, [], ['Flippers']],
      ["Swamp Palace - Flooded Room - Right", false, [], ['Hookshot']],
      ["Swamp Palace - Flooded Room - Right", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],

      ["Swamp Palace - Waterfall Room", false, []],
      ["Swamp Palace - Waterfall Room", false, [], ['MoonPearl']],
      ["Swamp Palace - Waterfall Room", false, [], ['Flippers']],
      ["Swamp Palace - Waterfall Room", false, [], ['Hookshot']],
      ["Swamp Palace - Waterfall Room", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],

      ["Swamp Palace - Boss", false, []],
      ["Swamp Palace - Boss", false, [], ['MoonPearl']],
      ["Swamp Palace - Boss", false, [], ['Flippers']],
      ["Swamp Palace - Boss", false, [], ['Hookshot']],
      ["Swamp Palace - Boss", true, ['KeyD2', 'MagicMirror', 'MoonPearl', 'Flippers', 'PegasusBoots', 'Hammer', 'Hookshot']],
    ];
  }
}