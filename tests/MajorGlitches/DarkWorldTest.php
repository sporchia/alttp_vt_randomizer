<?php namespace MajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group MajorGlitches
 */
class DarkWorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'MajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testSpikeCaveRequiresGloves() {
		$this->assertFalse($this->world->getLocation("[cave-055] Spike cave")
			->canAccess($this->allItemsExcept(['Gloves'])));
	}

	public function testSpikeCaveRequiresMoonPearlOrBottle() {
		$this->assertFalse($this->world->getLocation("[cave-055] Spike cave")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle'])));
	}

	public function testSpikeCaveRequiresHammer() {
		$this->assertFalse($this->world->getLocation("[cave-055] Spike cave")
			->canAccess($this->allItemsExcept(['Hammer'])));
	}

	public function testWestOfMireChestLRequiresMoonPearlOrBottleOrMirror() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle', 'MagicMirror'])));
	}

	public function testWestOfMireChestLRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->collected));
	}

	public function testWestOfMireChestLRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->collected));
	}

	public function testWestOfMireChestLRequiresOnlyMirror() {
		$this->addCollected(['MagicMirror']);

		$this->assertTrue($this->world->getLocation("[cave-071] Misery Mire west area [left chest]")
			->canAccess($this->collected));
	}

	public function testWestOfMireChestRRequiresMoonPearlOrBottleOrMirror() {
		$this->assertFalse($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->allItemsExcept(['MoonPearl', 'AnyBottle', 'MagicMirror'])));
	}

	public function testWestOfMireChestRRequiresOnlyBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->collected));
	}

	public function testWestOfMireChestRRequiresOnlyMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->collected));
	}

	public function testWestOfMireChestRRequiresOnlyMirror() {
		$this->addCollected(['MagicMirror']);

		$this->assertTrue($this->world->getLocation("[cave-071] Misery Mire west area [right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestTAccessibleWithMitt() {
		$this->addCollected(['TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestTAccessibleWithMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestTAccessibleWithBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestTAccessibleWithHammer() {
		$this->addCollected(['Hammer']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestTAccessibleWithMirror() {
		$this->addCollected(['MagicMirror']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [top chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestBAccessibleWithMitt() {
		$this->addCollected(['TitansMitt']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestBAccessibleWithMoonPearl() {
		$this->addCollected(['MoonPearl']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestBAccessibleWithBottle() {
		$this->addCollected(['Bottle']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestBAccessibleWithHammer() {
		$this->addCollected(['Hammer']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainChestBAccessibleWithMirror() {
		$this->addCollected(['MagicMirror']);

		$this->assertTrue($this->world->getLocation("[cave-057-1F] Dark World Death Mountain - cave from top to bottom [bottom chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMirrorAndMoonPearlAndHookShot() {
		$this->addCollected(['MagicMirror', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMirrorAndMoonPearlAndBoots() {
		$this->addCollected(['MagicMirror', 'MoonPearl', 'PegasusBoots']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMirrorAndBottleAndHookShot() {
		$this->addCollected(['MagicMirror', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMirrorAndBottleAndBoots() {
		$this->addCollected(['MagicMirror', 'Bottle', 'PegasusBoots']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMirrorAndMittAndHookShot() {
		$this->addCollected(['MagicMirror', 'TitansMitt', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMirrorAndMittAndBoots() {
		$this->addCollected(['MagicMirror', 'TitansMitt', 'PegasusBoots']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithBottleAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithBottleAndGlovesAndBoots() {
		$this->addCollected(['PowerGlove', 'Bottle', 'PegasusBoots']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMoonPearlAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRAccessibleWithMoonPearlAndGlovesAndBoots() {
		$this->addCollected(['PowerGlove', 'MoonPearl', 'PegasusBoots']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBRRequresBootsIfNoHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom right chest]")
			->canAccess($this->allItemsExcept(['PegasusBoots', 'Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestBLAccessibleWithMirrorAndMoonPearlAndHookShot() {
		$this->addCollected(['MagicMirror', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBLAccessibleWithMirrorAndBottleAndHookShot() {
		$this->addCollected(['MagicMirror', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBLAccessibleWithMirrorAndMittAndHookShot() {
		$this->addCollected(['MagicMirror', 'TitansMitt', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBLAccessibleWithBottleAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBLAccessibleWithMoonPearlAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestBLRequresHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [bottom left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestTLAccessibleWithMirrorAndMoonPearlAndHookShot() {
		$this->addCollected(['MagicMirror', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTLAccessibleWithMirrorAndBottleAndHookShot() {
		$this->addCollected(['MagicMirror', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTLAccessibleWithMirrorAndMittAndHookShot() {
		$this->addCollected(['MagicMirror', 'TitansMitt', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTLAccessibleWithBottleAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTLAccessibleWithMoonPearlAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTLRequresHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top left chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testDeathMountainHookshotCaveChestTRAccessibleWithMirrorAndMoonPearlAndHookShot() {
		$this->addCollected(['MagicMirror', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTRAccessibleWithMirrorAndBottleAndHookShot() {
		$this->addCollected(['MagicMirror', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTRAccessibleWithMirrorAndMittAndHookShot() {
		$this->addCollected(['MagicMirror', 'TitansMitt', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTRAccessibleWithBottleAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'Bottle', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTRAccessibleWithMoonPearlAndGlovesAndHookShot() {
		$this->addCollected(['PowerGlove', 'MoonPearl', 'Hookshot']);

		$this->assertTrue($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->collected));
	}

	public function testDeathMountainHookshotCaveChestTRRequresHookshot() {
		$this->assertFalse($this->world->getLocation("[cave-056] Dark World Death Mountain - cave under boulder [top right chest]")
			->canAccess($this->allItemsExcept(['Hookshot'])));
	}

	public function testCanAccessPyramidFairyWithMirrorAndAG1() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'MagicMirror', 'Cape', 'TitansMitt', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid - Sword")
			->canAccess($this->collected));
	}

	public function testCanAccessPyramidFairyWithHammer() {
		$this->addCollected(['Crystal5', 'Crystal6', 'MoonPearl', 'PowerGlove', 'Hammer', 'L1Sword']);

		$this->assertTrue($this->world->getLocation("Pyramid - Sword")
			->canAccess($this->collected));
	}
}
