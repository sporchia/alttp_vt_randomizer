<?php

use ALttP\Item;
use ALttP\World;

class WorldTest extends TestCase {
	public function setUp() {
		parent::setUp();
		$this->world = new World('test_rules', 'NoMajorGlitches');
	}

	public function tearDown() {
		parent::tearDown();
		unset($this->world);
	}

	public function testSetRules() {
		$this->world->setRules('testing_rules');

		$this->assertEquals('testing_rules', $this->world->getRules());
	}

	public function testGetRegionDoesntExist() {
		$this->assertNull($this->world->getRegion("This Region Doesn't Exist"));
	}

	public function testGetPlaythroughNormalGame() {
		$this->world->getLocation("Misery Mire Medallion")->setItem(Item::get('Ether'));
		$this->world->getLocation("Turtle Rock Medallion")->setItem(Item::get('Quake'));
		$this->world->getRegion('Eastern Palace')->getPrizeLocation()->setItem(Item::get('PendantOfCourage'));
		$this->world->getRegion('Desert Palace')->getPrizeLocation()->setItem(Item::get('PendantOfWisdom'));
		$this->world->getRegion('Tower of Hera')->getPrizeLocation()->setItem(Item::get('PendantOfPower'));
		$this->world->getLocation("Palace of Darkness Crystal")->setItem(Item::get('Crystal1'));
		$this->world->getLocation("Swamp Palace Crystal")->setItem(Item::get('Crystal2'));
		$this->world->getLocation("Skull Woods Crystal")->setItem(Item::get('Crystal3'));
		$this->world->getLocation("Thieves Town Crystal")->setItem(Item::get('Crystal4'));
		$this->world->getLocation("Ice Palace Crystal")->setItem(Item::get('Crystal5'));
		$this->world->getLocation("Misery Mire Crystal")->setItem(Item::get('Crystal6'));
		$this->world->getLocation("Turtle Rock Crystal")->setItem(Item::get('Crystal7'));
		$this->world->getLocation("Altar")->setItem(Item::get('MasterSword'));

		$this->world->getLocation("[cave-040] Link's House")->setItem(Item::get('Lamp'));

		$this->world->getLocation("[dungeon-L1-1F] Eastern Palace - Big key")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-L1-1F] Eastern Palace - big chest")->setItem(Item::get('Bow'));

		$this->world->getLocation("Sahasrahla")->setItem(Item::get('PegasusBoots'));
		$this->world->getLocation("Library")->setItem(Item::get('BookOfMudora'));

		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Small key room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - Big key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-L2-B1] Desert Palace - big chest")->setItem(Item::get('PowerGlove'));

		$this->world->getLocation("Old Mountain Man")->setItem(Item::get('MagicMirror'));

		$this->world->getLocation("[dungeon-L3-1F] Tower of Hera - first floor")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-L3-4F] Tower of Hera - big chest")->setItem(Item::get('MoonPearl'));

		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - shooter room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-B1] Dark Palace - turtle stalfos room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [left chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - jump room [right chest]")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D1-1F] Dark Palace - big chest")->setItem(Item::get('Hammer'));

		$this->world->getLocation("King Zora")->setItem(Item::get('Flippers'));

		$this->world->getLocation("[dungeon-D2-1F] Swamp Palace - first room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D2-B1] Swamp Palace - big chest")->setItem(Item::get('Hookshot'));

		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - Big Key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D3-B1] Skull Woods - big chest")->setItem(Item::get('FireRod'));

		$this->world->getLocation("[dungeon-D4-B1] Thieves' Town - Bottom left of huge room [bottom right chest]")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D4-B2] Thieves' Town - big chest")->setItem(Item::get('TitansMitt'));

		$this->world->getLocation("Blacksmiths")->setItem(Item::get('L3Sword'));

		$this->world->getLocation("[dungeon-D5-B1] Ice Palace - Big Key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D5-B5] Ice Palace - big chest")->setItem(Item::get('BlueMail'));

		$this->world->getLocation("Catfish")->setItem(Item::get('Quake'));
		$this->world->getLocation("Ether Tablet")->setItem(Item::get('Ether'));
		$this->world->getLocation("Flute Boy")->setItem(Item::get('Shovel'));
		$this->world->getLocation("Haunted Grove item")->setItem(Item::get('OcarinaInactive'));

		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - end of bridge")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big hub room")->setItem(Item::get('Key'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big key")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D6-B1] Misery Mire - big chest")->setItem(Item::get('CaneOfSomaria'));

		$this->world->getLocation("[cave-051] Ice Cave")->setItem(Item::get('IceRod'));
		$this->world->getLocation("Pyramid")->setItem(Item::get('SilverArrowUpgrade'));

		$this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big key room")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-D7-B1] Turtle Rock - big chest")->setItem(Item::get('MirrorShield'));

		$this->world->getLocation("[dungeon-A2-B1] Ganon's Tower - north of Armos room [bottom chest]")->setItem(Item::get('BigKey'));
		$this->world->getLocation("[dungeon-A2-1F] Ganon's Tower - big chest")->setItem(Item::get('RedMail'));

		$this->assertArraySubset(['longest_item_chain' => 14, 'regions_visited' => 28], $this->world->getPlaythrough());
	}
}
