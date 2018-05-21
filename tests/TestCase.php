<?php

use ALttP\Item;
use ALttP\Support\ItemCollection;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase {
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://localhost';

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication() {
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}

	public function setUp() {
		parent::setUp();
		// Assume Zelda is rescued for all tests
		// @TODO: rewrite all tests to actually account for this
		$this->collected = new ItemCollection([Item::get('RescueZelda')]);
	}

	public function tearDown() {
		parent::tearDown();
		$refl = new \ReflectionObject($this);
		foreach ($refl->getProperties() as $prop) {
			if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
				$prop->setAccessible(true);
				$prop->setValue($this, null);
			}
		}
	}

	protected function addCollected(array $items) {
		foreach ($items as $item) {
			$this->collected->addItem(Item::get($item));
		}
	}

	/**
	 * Lets pretend all items doesn't include keys just in case it affects things
	 */
	protected function allItems() {
		return $this->allItemsExcept(['BigKey', 'Key']);
	}

	protected function allItemsExcept(array $remove_items) {
		$items = Item::all()->copy()->manyKeys();
		foreach (array_merge($remove_items, ['BigKey', 'Key']) as $item) {
			switch ($item) {
				case 'AnySword':
					$items->offsetUnset('L1Sword');
					$items->offsetUnset('L1SwordAndShield');
					$items->offsetUnset('ProgressiveSword');
					$items->offsetUnset('UncleSword');
				case 'UpgradedSword':
					$items->offsetUnset('UncleSword');
					$items->offsetUnset('L2Sword');
					$items->offsetUnset('MasterSword');
					$items->offsetUnset('L3Sword');
					$items->offsetUnset('L4Sword');
					break;
				case 'AnyBottle':
					$items->offsetUnset('BottleWithBee');
					$items->offsetUnset('BottleWithFairy');
					$items->offsetUnset('BottleWithRedPotion');
					$items->offsetUnset('BottleWithGreenPotion');
					$items->offsetUnset('BottleWithBluePotion');
					$items->offsetUnset('Bottle');
					$items->offsetUnset('BottleWithGoldBee');
					break;
				case 'AnyBow':
					$items->offsetUnset('Bow');
					$items->offsetUnset('BowAndArrows');
					$items->offsetUnset('BowAndSilverArrows');
					break;
				case 'Flute':
					$items->offsetUnset('OcarinaActive');
					$items->offsetUnset('OcarinaInactive');
					break;
				case 'Gloves':
					$items->offsetUnset('ProgressiveGlove');
					$items->offsetUnset('PowerGlove');
					$items->offsetUnset('TitansMitt');
					break;
				default:
					$items->offsetUnset($item);
					break;
			}
		}
		return $items;
	}
}
