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
		switch (get_class($this->item)) {
			case Item\Key::class:
			case Item\BigKey::class:
				return "key boy picks locks again";
			case Item\Map::class:
				return "map boy navigates again";
			case Item\Compass::class:
				return "compass boy finds boss again";
		}

		switch ($this->item) {
			case Item::get('ProgressiveSword'):
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
			case Item::get('L3Sword'):
			case Item::get('L4Sword'):
				return "sword boy fights again";
			case Item::get('ProgressiveShield'):
			case Item::get('BlueShield'):
			case Item::get('RedShield'):
			case Item::get('MirrorShield'):
				return "shield boy defends again";
			case Item::get('FireRod'):
				return "firestarter boy burns again";
			case Item::get('IceRod'):
				return "ice-cube boy freezes again";
			case Item::get('Hammer'):
				return "stop, hammer time";
			case Item::get('Hookshot'):
				return "beam boy tickles again";
			case Item::get('Bow'):
				return "archer boy shoots again";
			case Item::get('BowAndArrows'):
				return "archer boy shoots again";
			case Item::get('BowAndSilverArrows'):
				return "archer boy shoots again";
			case Item::get('Boomerang'):
				return "throwing boy plays fetch again";
			case Item::get('RedBoomerang'):
				return "magical boy plays fetch again";
			case Item::get('Powder'):
				return "magic boy plays marbles again";
			case Item::get('Bombos'):
				return "medallion boy melts room again";
			case Item::get('Ether'):
				return "medallion boy sees floor again";
			case Item::get('Quake'):
				return "medallion boy shakes dirt again";
			case Item::get('Lamp'):
				return "illuminated boy can see again";
			case Item::get('Shovel'):
				return "shovel boy digs again";
			case Item::get('CaneOfSomaria'):
				return "cane boy makes blocks again";
			case Item::get('CaneOfByrna'):
				return "cane boy encircles again";
			case Item::get('Cape'):
				return "dapper boy hides again";
			case Item::get('MagicMirror'):
				return "narcissistic boy is happy again";
			case Item::get('ProgressiveGlove'):
			case Item::get('PowerGlove'):
				return "body-building boy lifts again";
			case Item::get('TitansMitt'):
				return "body-building boy has gold again";
			case Item::get('BookOfMudora'):
				return "book-worm boy can read again";
			case Item::get('Flippers'):
				return "swimming boy swims again";
			case Item::get('MoonPearl'):
				return "moon boy plays ball again";
			case Item::get('BugCatchingNet'):
				return "wrong boy catches bees again";
			case Item::get('BlueMail'):
				return "tailor boy banana hatted again";
			case Item::get('RedMail'):
				return "tailor boy fears nothing again";
			case Item::get('PieceOfHeart'):
				return "life boy feels some love again";
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "life boy feels love again";
			case Item::get('Bomb'):
				return "'splosion boy explodes again";
			case Item::get('ThreeBombs'):
				return "'splosion boy explodes again";
			case Item::get('TenBombs'):
				return "'splosion boy explodes again";
			case Item::get('Mushroom'):
				return "shroom boy sells drugs again";
			case Item::get('Bottle'):
				return "bottle boy has terrarium again";
			case Item::get('BottleWithRedPotion'):
				return "bottle boy has red goo again";
			case Item::get('BottleWithGreenPotion'):
				return "bottle boy has green goo again";
			case Item::get('BottleWithBluePotion'):
				return "bottle boy has blue goo again";
			case Item::get('BottleWithGoldBee'):
				return "bottle boy has beetorp again";
			case Item::get('BottleWithBee'):
				return "bottle boy has mad bee again";
			case Item::get('BottleWithFairy'):
				return "bottle boy has friend again";
			case Item::get('Heart'):
				return "loving boy has affection again";
			case Item::get('Arrow'):
				return "archer boy sews again";
			case Item::get('TenArrows'):
				return "archer boy sews again";
			case Item::get('SmallMagic'):
				return "magic boy summons again";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "destitute boy has lunch again";
			case Item::get('OneHundredRupees'):
				return "affluent boy goes drinking again";
			case Item::get('ThreeHundredRupees'):
				return "fat-cat boy is rich again";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "ocarina boy plays again";
			case Item::get('PegasusBoots'):
				return "gotta-go-fast boy runs again";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "upgrade boy explodes more again";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "upgrade boy sews more again";
			case Item::get('SilverArrowUpgrade'):
				return "archer boy shines again";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "magic boy saves magic again";
			case Item::get('Rupoor'):
				return "affluent boy steals rupees";
			case Item::get('RedClock'):
				return "moment boy travels time again";
			case Item::get('BlueClock'):
				return "moment boy time travels again";
			case Item::get('GreenClock'):
				return "moment boy adjusts time again";
			case Item::get('ProgressiveArmor'):
				return "tailor boy has threads again";
			case Item::get('singleRNG'):
			case Item::get('multiRNG'):
				return "unknown boy somethings again";
			case Item::get('Triforce'):
				return "greedy boy wins game again";
			case Item::get('PowerStar'):
				return "mario powers up again";
			case Item::get('TriforcePiece'):
				return "wise boy has triangle again";
			case Item::get('Nothing'):
			default:
				return "empty boy does nothing again";
		}
	}
}
