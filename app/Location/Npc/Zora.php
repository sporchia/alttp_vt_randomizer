<?php namespace ALttP\Location\Npc;

use ALttP\Item;
use ALttP\Location\Npc;
use ALttP\Rom;

/**
 * Zora specifically changes the credits when you write an item.
 */
class Zora extends Npc {
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		$rom->setZoraCredits($this->getItemCreditsText());

		return $this;
	}

	private function getItemCreditsText() {
		switch ($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				return "sword for sale";
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				return "glow sword for sale";
			case Item::get('L3Sword'):
				return "flame sword for sale";
			case Item::get('L4Sword'):
				return "butter for sale";
			case Item::get('BlueShield'):
				return "bad defense for sale";
			case Item::get('RedShield'):
				return "red shield for sale";
			case Item::get('MirrorShield'):
				return "face shield for sale";
			case Item::get('FireRod'):
				return "rage rod for sale";
			case Item::get('IceRod'):
				return "ice cream for sale";
			case Item::get('Hammer'):
				return "m c hammer for sale";
			case Item::get('Hookshot'):
				return "tickle beam for sale";
			case Item::get('Bow'):
				return "arrow sling for sale";
			case Item::get('BowAndArrows'):
				return "point stick for sale";
			case Item::get('BowAndSilverArrows'):
				return "you got lucky";
			case Item::get('Boomerang'):
				return "bent stick for sale";
			case Item::get('RedBoomerang'):
				return "air foil for sale";
			case Item::get('Powder'):
				return "sack for sale";
			case Item::get('Bombos'):
				return "swirly coin for sale";
			case Item::get('Ether'):
				return "bolt coin for sale";
			case Item::get('Quake'):
				return "wavy coin for sale";
			case Item::get('Lamp'):
				return "candle for sale";
			case Item::get('Shovel'):
				return "dirt spade for sale";
			case Item::get('CaneOfSomaria'):
				return "block stick for sale";
			case Item::get('CaneOfByrna'):
				return "shiny stick for sale";
			case Item::get('Cape'):
				return "red hood for sale";
			case Item::get('MagicMirror'):
				return "your face for sale";
			case Item::get('PowerGlove'):
				return "lift glove for sale";
			case Item::get('TitansMitt'):
				return "carry glove for sale";
			case Item::get('BookOfMudora'):
				return "moon runes for sale";
			case Item::get('Flippers'):
				return "finger webs for sale";
			case Item::get('MoonPearl'):
				return "lunar orb for sale";
			case Item::get('BugCatchingNet'):
				return "stick web for sale";
			case Item::get('BlueMail'):
				return "banana hat for sale";
			case Item::get('RedMail'):
				return "purple hat for sale";
			case Item::get('Key'):
			case Item::get('BigKey'):
				return "advancement for sale";
			case Item::get('Compass'):
				return "bearings for sale";
			case Item::get('Map'):
				return "the world for sale";
			case Item::get('PieceOfHeart'):
				return "little love for sale";
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "love for sale";
			case Item::get('Bomb'):
				return "firecracker for sale";
			case Item::get('ThreeBombs'):
				return "fireworks for sale";
			case Item::get('TenBombs'):
				return "boom boom for sale";
			case Item::get('Mushroom'):
				return "legal drugs for sale";
			case Item::get('Bottle'):
				return "terrarium for sale";
			case Item::get('BottleWithRedPotion'):
				return "red goo for sale";
			case Item::get('BottleWithGreenPotion'):
				return "green goo for sale";
			case Item::get('BottleWithBluePotion'):
				return "blue goo for sale";
			case Item::get('BottleWithGoldBee'):
				return "beetor for sale";
			case Item::get('BottleWithBee'):
				return "mad friend for sale";
			case Item::get('BottleWithFairy'):
				return "friend for sale";
			case Item::get('Heart'):
				return "affection for sale";
			case Item::get('Arrow'):
				return "sewing kit for sale";
			case Item::get('TenArrows'):
				return "sewing kit for sale";
			case Item::get('SmallMagic'):
				return "alchemy for sale";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "life lesson for sale";
			case Item::get('OneHundredRupees'):
				return "fair trade for sale";
			case Item::get('ThreeHundredRupees'):
				return "good return for sale";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "duck call for sale";
			case Item::get('PegasusBoots'):
				return "sprint shoe for sale";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "bomb boost for sale";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "arrow boost for sale";
			case Item::get('SilverArrowUpgrade'):
				return "sharp arrow for sale";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "wizardry for sale";
			case Item::get('Rupoor'):
				return "double loss for sale";
			case Item::get('RedClock'):
				return "ruby clock for sale";
			case Item::get('BlueClock'):
				return "blue clock for sale";
			case Item::get('GreenClock'):
				return "green clock for sale";
			case Item::get('ProgressiveSword'):
				return "some sword for sale";
			case Item::get('ProgressiveShield'):
				return "some shield for sale";
			case Item::get('ProgressiveArmor'):
				return "unknown hat for sale";
			case Item::get('ProgressiveGlove'):
				return "some glove for sale";
			case Item::get('Nothing'):
			default:
				return "Nothing, so stupid";
		}
	}
}
