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
		switch ($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				return "boy fights again";
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				return "boy fights again";
			case Item::get('L3Sword'):
				return "boy fights again";
			case Item::get('L4Sword'):
				return "boy fights again";
			case Item::get('BlueShield'):
				return "boy defends again";
			case Item::get('RedShield'):
				return "boy defends again";
			case Item::get('MirrorShield'):
				return "boy defends again";
			case Item::get('FireRod'):
				return "boy burns again";
			case Item::get('IceRod'):
				return "boy freezes again";
			case Item::get('Hammer'):
				return "stop, hammer time";
			case Item::get('Hookshot'):
				return "boy tickles again";
			case Item::get('Bow'):
				return "boy shoots again";
			case Item::get('BowAndArrows'):
				return "boy shoots again";
			case Item::get('BowAndSilverArrows'):
				return "boy shoots again";
			case Item::get('Boomerang'):
				return "boy plays fetch again";
			case Item::get('RedBoomerang'):
				return "boy plays fetch again";
			case Item::get('Powder'):
				return "boy plays marbles again";
			case Item::get('Bombos'):
				return "boy hides coin again";
			case Item::get('Ether'):
				return "boy hides coin again";
			case Item::get('Quake'):
				return "boy hides coin again";
			case Item::get('Lamp'):
				return "boy sees at night again";
			case Item::get('Shovel'):
				return "boy digs again";
			case Item::get('CaneOfSomaria'):
				return "boy makes blocks again";
			case Item::get('CaneOfByrna'):
				return "boy encircles again";
			case Item::get('Cape'):
				return "boy hides again";
			case Item::get('MagicMirror'):
				return "boy sees himself again";
			case Item::get('PowerGlove'):
				return "boy lifts again";
			case Item::get('TitansMitt'):
				return "boy has bling again";
			case Item::get('BookOfMudora'):
				return "boy can read again";
			case Item::get('Flippers'):
				return "boy swims again";
			case Item::get('MoonPearl'):
				return "boy plays ball again";
			case Item::get('BugCatchingNet'):
				return "boy catches bees again";
			case Item::get('BlueMail'):
				return "boy banana hatted again";
			case Item::get('RedMail'):
				return "boy fears nothing again";
			case Item::get('Key'):
			case Item::get('BigKey'):
				return "boy picks locks again";
			case Item::get('Compass'):
				return "boy finds boss again";
			case Item::get('Map'):
				return "boy navigates again";
			case Item::get('PieceOfHeart'):
				return "boy feels love again";
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "boy feels love again";
			case Item::get('Bomb'):
				return "boy explodes again";
			case Item::get('ThreeBombs'):
				return "boy explodes again";
			case Item::get('TenBombs'):
				return "boy explodes again";
			case Item::get('Mushroom'):
				return "boy sells drugs again";
			case Item::get('Bottle'):
				return "boy has terrarium again";
			case Item::get('BottleWithRedPotion'):
				return "boy has red goo again";
			case Item::get('BottleWithGreenPotion'):
				return "boy has green goo again";
			case Item::get('BottleWithBluePotion'):
				return "boy has blue goo again";
			case Item::get('BottleWithGoldBee'):
				return "boy has beetor again";
			case Item::get('BottleWithBee'):
				return "boy has mad bee again";
			case Item::get('BottleWithFairy'):
				return "boy has friend again";
			case Item::get('Heart'):
				return "boy has affection again";
			case Item::get('Arrow'):
				return "boy sews again";
			case Item::get('TenArrows'):
				return "boy sews again";
			case Item::get('SmallMagic'):
				return "boy summons again";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "boy has lunch again";
			case Item::get('OneHundredRupees'):
				return "boy goes drinking again";
			case Item::get('ThreeHundredRupees'):
				return "boy is rich again";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "ocarina boy plays again";
			case Item::get('PegasusBoots'):
				return "boy runs again";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "boy explodes more again";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "boy sews more again";
			case Item::get('SilverArrowUpgrade'):
				return "boy sharpens again";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "boy saves magic again";
			case Item::get('Rupoor'):
				return "boy steals rupees";
			case Item::get('RedClock'):
				return "boy travels time again";
			case Item::get('BlueClock'):
				return "boy time travels again";
			case Item::get('GreenClock'):
				return "boy adjusts time again";
			case Item::get('Nothing'):
			default:
				return "boy does nothing again";
		}
	}
}
