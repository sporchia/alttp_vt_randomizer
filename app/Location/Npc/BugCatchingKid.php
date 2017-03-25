<?php namespace ALttP\Location\Npc;

use ALttP\Item;
use ALttP\Location\Npc;
use ALttP\Rom;

/**
 * Bug-Catching Kid specifically changes the credits when you write an item.
 */
class BugCatchingKid extends Npc {
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		$rom->setBugCatchingKidCredits($this->getItemCreditsText());

		return $this;
	}

	private function getItemCreditsText() {
		$credit = "";
		switch($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
			case Item::get('L2Sword'):
			case Item::get('L3Sword'):
			case Item::get('L4Sword'):
			case Item::get('MasterSword'):
				$credit = "sword-wielding";
				break;

			case Item::get('BlueShield'):
			case Item::get('MirrorShield'):
			case Item::get('RedShield'):
				$credit = "shield-wielding";
				break;

			case Item::get('FireRod'):
				$credit = "fire-starting";
				break;

			case Item::get('IceRod'):
				$credit = "ice-bending";
				break;

			case Item::get('Hammer'):
				$credit = "hammer-smashing";
				break;

			case Item::get('Hookshot'):
				$credit = "tickle-monster";
				break;

			case Item::get('Bow'):
			case Item::get('BowAndArrows'):
			case Item::get('BowAndSilverArrows'):
				$credit = "arrow-slinging";
				break;

			case Item::get('Boomerang'):
			case Item::get('RedBoomerang'):
				$credit = "bat-throwing";
				break;

			case Item::get('Powder'):
				$credit = "sack-holding";
				break;

			case Item::get('Bombos'):
			case Item::get('Ether'):
			case Item::get('Quake'):
				$credit = "coin-collecting";
				break;

			case Item::get('Lamp'):
				$credit = "light-shining";
				break;

			case Item::get('Shovel'):
				$credit = "archaeologist";
				break;

			case Item::get('CaneOfSomaria'):
				$credit = "block-making";
				break;

			case Item::get('CaneOfByrna'):
				$credit = "spark-making";
				break;

			case Item::get('Cape'):
				$credit = "red riding-hood";
				break;

			case Item::get('MagicMirror'):
				$credit = "narcissistic";
				break;

			case Item::get('PowerGlove'):
			case Item::get('TitansMitt'):
				$credit = "body-building";
				break;

			case Item::get('BookOfMudora'):
				$credit = "scholarly";
				break;

			case Item::get('Flippers'):
				$credit = "swimming";
				break;

			case Item::get('MoonPearl'):
				$credit = "fortune-telling";
				break;

			case Item::get('BugCatchingNet'):
				$credit = "bug-catching";
				break;

			case Item::get('BlueMail'):
				$credit = "protected";
				break;

			case Item::get('RedMail'):
				$credit = "well-protected";
				break;

			case Item::get('BigKey'):
			case Item::get('Key'):
				$credit = "key-holding";
				break;

			case Item::get('Compass'):
				$credit = "navigating";
				break;

			case Item::get('Map'):
				$credit = "cartographer";
				break;

			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
			case Item::get('PieceOfHeart'):
				$credit = "life-giving";
				break;

			case Item::get('Bomb'):
			case Item::get('TenBombs'):
			case Item::get('ThreeBombs'):
				$credit = "bomb-holding";
				break;

			case Item::get('Mushroom'):
				$credit = "drug-dealing";
				break;

			case Item::get('Bottle'):
				$credit = "terrarium";
				break;

			case Item::get('BottleWithBluePotion'):
			case Item::get('BottleWithGreenPotion'):
			case Item::get('BottleWithRedPotion'):
				$credit = "potion-slinging";
				break;

			case Item::get('BottleWithBee'):
			case Item::get('BottleWithGoldBee'):
				$credit = "bug-caught";
				break;

			case Item::get('BottleWithFairy'):
				$credit = "fairy-catching";
				break;

			case Item::get('Heart'):
				$credit = "affection-giving";
				break;

			case Item::get('Arrow'):
			case Item::get('TenArrows'):
				$credit = "stick-collecting";
				break;

			case Item::get('SmallMagic'):
				$credit = "magic-slinging";
				break;

			case Item::get('FiveRupees'):
			case Item::get('OneRupee'):
				$credit = "poverty-struck";
				break;

			case Item::get('FiftyRupees'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
				$credit = "piggy-bank";
				break;

			case Item::get('OneHundredRupees'):
				$credit = "kind-of-rich";
				break;

			case Item::get('ThreeHundredRupees'):
				$credit = "really-rich";
				break;

			case Item::get('OcarinaActive'):
			case Item::get('OcarinaInactive'):
				$credit = "duck-call";
				break;

			case Item::get('PegasusBoots'):
				$credit = "running-man";
				break;

			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				$credit = "boom-enlarging";
				break;

			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				$credit = "quiver-enlarging";
				break;

			case Item::get('SilverArrowUpgrade'):
				$credit = "arrow-sharpening";
				break;

			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				$credit = "magic-saving";
				break;

			case Item::get('Rupoor'):
				$credit = "toll-booth";
				break;

			case Item::get('RedClock'):
				$credit = "ruby-time";
				break;

			case Item::get('BlueClock'):
				$credit = "indigo-time";
				break;

			case Item::get('GreenClock'):
				$credit = "emerald-time";
				break;

			case Item::get('Nothing'):
				$credit = "nothing-having";
				break;

		}

		$credit = "the " . $credit . " kid";
		return $credit;
	}
}