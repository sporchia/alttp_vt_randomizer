<?php namespace ALttP\Location\Npc;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Uncle Location
 */
class Uncle extends Location {
	/**
	 * Sets the item for this location. We need to check mode to determine fills/assit.
	 *
	 * @param Item|null $item Item to be placed at this Location
	 *
	 * @return $this
	 */
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);
		$item = $this->getItem();

		$world = $this->region->getWorld();
		if ($world->config('mode.weapons') == 'randomized') {
			if ($item instanceof Item\Bow) {
				$rom->setEscapeFills(0b00000001);
			} elseif ($item instanceof Item\Upgrade\Bomb) {
				$rom->setEscapeFills(0b00000010);
			} elseif ($item == Item::get('FireRod')
				|| $item == Item::get('CaneOfSomaria')
				|| $item == Item::get('CaneOfByrna')) {
				$rom->setEscapeFills(0b00000100);
			}
		} else {
			$rom->setEscapeFills(0b00000000);
		}

		if ($world->getDifficulty() == 'easy') {
			if ($world->config('mode.weapons') == 'randomized') {
				if ($item instanceof Item\Bow) {
					$rom->setEscapeAssist(0b00000001);
				} elseif ($item instanceof Item\Upgrade\Bomb) {
					$rom->setEscapeAssist(0b00000010);
				} elseif ($item == Item::get('FireRod')
					|| $item == Item::get('CaneOfSomaria')
					|| $item == Item::get('CaneOfByrna')) {
					$rom->setEscapeAssist(0b00000100);
				}
			}
		} else {
			$rom->setEscapeAssist(0b00000000);
		}

		$rom->setLinksHouseCredits($this->getItemCreditsText());

		return $this;
	}

	private function getItemCreditsText() {
		switch (get_class($this->item)) {
			case Item\Key::class:
			case Item\BigKey::class:
				return "your uncle picks locks";
			case Item\Map::class:
				return "your uncle finds treasure";
			case Item\Compass::class:
				return "your uncle navigates";
		}

		switch ($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
			case Item::get('L3Sword'):
			case Item::get('L4Sword'):
			case Item::get('ProgressiveSword'):
				return "your uncle recovers";
			case Item::get('BlueShield'):
			case Item::get('RedShield'):
			case Item::get('MirrorShield'):
			case Item::get('ProgressiveShield'):
				return "your uncle protects";
			case Item::get('FireRod'):
				return "your uncle starts fires";
			case Item::get('IceRod'):
				return "your uncle is cold as ice";
			case Item::get('Hammer'):
				return "stop...   hammer time";
			case Item::get('Hookshot'):
				return "your uncle is BOING";
			case Item::get('Bow'):
			case Item::get('BowAndArrows'):
			case Item::get('BowAndSilverArrows'):
				return "your uncle, robin hood";
			case Item::get('Boomerang'):
			case Item::get('RedBoomerang'):
				return "your uncle is stunning";
			case Item::get('Powder'):
				return "your uncle and his sack";
			case Item::get('Bombos'):
			case Item::get('Ether'):
			case Item::get('Quake'):
				return "your uncle collects coins";
			case Item::get('Lamp'):
				return "your uncle has night vision";
			case Item::get('Shovel'):
				return "your uncle digs it";
			case Item::get('CaneOfSomaria'):
				return "your uncle makes blocks";
			case Item::get('CaneOfByrna'):
				return "your uncle sparks";
			case Item::get('Cape'):
				return "your uncle can hide";
			case Item::get('MagicMirror'):
				return "your uncle is vain";
			case Item::get('PowerGlove'):
			case Item::get('TitansMitt'):
			case Item::get('ProgressiveGlove'):
				return "your uncle goes back to the gym";
			case Item::get('BookOfMudora'):
				return "your uncle can read";
			case Item::get('Flippers'):
				return "your uncle swims";
			case Item::get('MoonPearl'):
				return "your uncle shoots marbles";
			case Item::get('BugCatchingNet'):
				return "your uncle catches bees";
			case Item::get('BlueMail'):
			case Item::get('RedMail'):
			case Item::get('ProgressiveArmor'):
				return "your uncle tailors";
			case Item::get('PieceOfHeart'):
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "your uncle is healthly";
			case Item::get('Bomb'):
			case Item::get('ThreeBombs'):
			case Item::get('TenBombs'):
				return "your uncle belives";
			case Item::get('Mushroom'):
				return "your uncle deals drugs";
			case Item::get('Bottle'):
				return "your uncle likes turtles";
			case Item::get('BottleWithRedPotion'):
			case Item::get('BottleWithGreenPotion'):
			case Item::get('BottleWithBluePotion'):
				return "your uncle helps out";
			case Item::get('BottleWithGoldBee'):
				return "your uncle has beetor";
			case Item::get('BottleWithBee'):
				return "your uncle likes arthropods";
			case Item::get('BottleWithFairy'):
				return "your uncle has a friend";
			case Item::get('Heart'):
				return "your uncle is creepy";
			case Item::get('Arrow'):
				return "your uncle believes in you";
			case Item::get('TenArrows'):
				return "your uncle sews";
			case Item::get('SmallMagic'):
				return "your uncle is magic";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
				return "your uncle is cheap";
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "your uncle likes cash";
			case Item::get('OneHundredRupees'):
			case Item::get('ThreeHundredRupees'):
				return "your uncle is rich";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "your uncle trains ducks";
			case Item::get('PegasusBoots'):
				return "your uncle goes fast";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "your uncle has the bomb bag";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "your uncle has the quiver";
			case Item::get('SilverArrowUpgrade'):
				return "your uncle shaves";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "your uncle is magical";
			case Item::get('Rupoor'):
				return "your uncle collects";
			case Item::get('RedClock'):
			case Item::get('BlueClock'):
			case Item::get('GreenClock'):
				return "your uncle keeps time";
			case Item::get('singleRNG'):
			case Item::get('multiRNG'):
				return "your uncle recovers";
			case Item::get('Triforce'):
				return "your uncle wins the game";
			case Item::get('PowerStar'):
			case Item::get('TriforcePiece'):
				return "your uncle is important";
			case Item::get('Nothing'):
			default:
				return "your uncle does nothing";
		}
	}
}
