<?php namespace ALttP\Location\Dig;

use ALttP\Item;
use ALttP\Location\Dig;
use ALttP\Rom;

/**
 * Haunted Grove specifically changes the credits when you write an item.
 */
class HauntedGrove extends Dig {
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		$rom->setFluteBoyCredits($this->getItemCreditsText());

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
				$credit = "fights";
				break;

			case Item::get('BlueShield'):
			case Item::get('MirrorShield'):
			case Item::get('RedShield'):
				$credit = "defends";
				break;

			case Item::get('FireRod'):
				$credit = "burns";
				break;

			case Item::get('IceRod'):
				$credit = "freezes";
				break;

			case Item::get('Hookshot'):
				$credit = "tickles";
				break;

			case Item::get('Bow'):
			case Item::get('BowAndArrows'):
			case Item::get('BowAndSilverArrows'):
				$credit = "shoots";
				break;

			case Item::get('Boomerang'):
			case Item::get('RedBoomerang'):
				$credit = "plays fetch";
				break;

			case Item::get('Powder'):
				$credit = "plays marbles";
				break;

			case Item::get('Bombos'):
			case Item::get('Ether'):
			case Item::get('Quake'):
				$credit = "hides coin";
				break;

			case Item::get('Lamp'):
				$credit = "sees at night";
				break;

			case Item::get('Shovel'):
				$credit = "digs";
				break;

			case Item::get('CaneOfSomaria'):
				$credit = "makes blocks";
				break;

			case Item::get('CaneOfByrna'):
				$credit = "encircles";
				break;

			case Item::get('Cape'):
				$credit = "hides";
				break;

			case Item::get('MagicMirror'):
				$credit = "sees himself";
				break;

			case Item::get('PowerGlove'):
				$credit = "lifts";
				break;

			case Item::get('TitansMitt'):
				$credit = "has bling";
				break;

			case Item::get('BookOfMudora'):
				$credit = "can read";
				break;

			case Item::get('Flippers'):
				$credit = "swims";
				break;

			case Item::get('MoonPearl'):
				$credit = "plays ball";
				break;

			case Item::get('BugCatchingNet'):
				$credit = "catches bees";
				break;

			case Item::get('BlueMail'):
				$credit = "banana hatted";
				break;

			case Item::get('RedMail'):
				$credit = "fears nothing";
				break;

			case Item::get('BigKey'):
			case Item::get('Key'):
				$credit = "picks locks";
				break;

			case Item::get('Compass'):
				$credit = "finds boss";
				break;

			case Item::get('Map'):
				$credit = "navigates";
				break;

			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
			case Item::get('PieceOfHeart'):
				$credit = "feels love";
				break;

			case Item::get('Bomb'):
			case Item::get('TenBombs'):
			case Item::get('ThreeBombs'):
				$credit = "explodes";
				break;

			case Item::get('Mushroom'):
				$credit = "sells drugs";
				break;

			case Item::get('Bottle'):
				$credit = "has terrarium";
				break;

			case Item::get('BottleWithRedPotion'):
				$credit = "has red goo";
				break;

			case Item::get('BottleWithGreenPotion'):
				$credit = "has green goo";
				break;

			case Item::get('BottleWithBluePotion'):
				$credit = "has blue goo";
				break;

			case Item::get('BottleWithGoldBee'):
				$credit = "has beetor";
				break;

			case Item::get('BottleWithBee'):
				$credit = "has mad bee";
				break;

			case Item::get('BottleWithFairy'):
				$credit = "has friend";
				break;

			case Item::get('Heart'):
				$credit = "has affection";
				break;

			case Item::get('Arrow'):
			case Item::get('TenArrows'):
				$credit = "sews";
				break;

			case Item::get('SmallMagic'):
				$credit = "summons";
				break;

			case Item::get('FiftyRupees'):
			case Item::get('FiveRupees'):
			case Item::get('OneRupee'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
				$credit = "has lunch";
				break;

			case Item::get('OneHundredRupees'):
				$credit = "goes drinking";
				break;

			case Item::get('ThreeHundredRupees'):
				$credit = "is rich";
				break;

			case Item::get('PegasusBoots'):
				$credit = "runs";
				break;

			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				$credit = "explodes more";
				break;

			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				$credit = "sews more";
				break;

			case Item::get('SilverArrowUpgrade'):
				$credit = "sharpens";
				break;

			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				$credit = "saves magic";
				break;

			case Item::get('Rupoor'):
				$credit = "steals rupees";
				break;

			case Item::get('RedClock'):
				$credit = "travels time";
				break;

			case Item::get('BlueClock'):
				$credit = "time travels";
				break;

			case Item::get('GreenClock'):
				$credit = "adjusts time";
				break;

			case Item::get('Nothing'):
				$credit = "does nothing";
				break;

		}

		$credit = "boy " . $credit . " again";

		if($this->item == Item::get('Hammer')) {
			$credit = "stop, hammer time";
		} elseif($this->item == Item::get('OcarinaActive') || $this->item == Item::get('OcarinaInactive')) {
			$credit = "ocarina boy plays again";
		}

		return $credit;
	}
}