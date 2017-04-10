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
		$credit = "";
		switch($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				$credit = "sword";
				break;

			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				$credit = "glow sword";
				break;

			case Item::get('L3Sword'):
				$credit = "flame sword";
				break;

			case Item::get('L4Sword'):
				$credit = "butter";
				break;

			case Item::get('BlueShield'):
				$credit = "bad defense";
				break;

			case Item::get('RedShield'):
				$credit = "red shield";
				break;

			case Item::get('MirrorShield'):
				$credit = "face shield";
				break;

			case Item::get('FireRod'):
				$credit = "rage rod";
				break;

			case Item::get('IceRod'):
				$credit = "ice cream";
				break;

			case Item::get('Hammer'):
				$credit = "m c hammer";
				break;

			case Item::get('Hookshot'):
				$credit = "tickle beam";
				break;

			case Item::get('Bow'):
				$credit = "arrow sling";
				break;

			case Item::get('BowAndArrows'):
				$credit = "point stick";
				break;

			case Item::get('Boomerang'):
				$credit = "bent stick";
				break;

			case Item::get('RedBoomerang'):
				$credit = "air foil";
				break;

			case Item::get('Powder'):
				$credit = "sack";
				break;

			case Item::get('Bombos'):
				$credit = "swirly coin";
				break;

			case Item::get('Ether'):
				$credit = "bolt coin";
				break;

			case Item::get('Quake'):
				$credit = "wavy coin";
				break;

			case Item::get('Lamp'):
				$credit = "candle";
				break;

			case Item::get('Shovel'):
				$credit = "dirt spade";
				break;

			case Item::get('CaneOfSomaria'):
				$credit = "block stick";
				break;

			case Item::get('CaneOfByrna'):
				$credit = "shiny stick";
				break;

			case Item::get('Cape'):
				$credit = "red hood";
				break;

			case Item::get('MagicMirror'):
				$credit = "your face";
				break;

			case Item::get('PowerGlove'):
				$credit = "lift glove";
				break;

			case Item::get('TitansMitt'):
				$credit = "carry glove";
				break;

			case Item::get('BookOfMudora'):
				$credit = "moon runes";
				break;

			case Item::get('Flippers'):
				$credit = "finger webs";
				break;

			case Item::get('MoonPearl'):
				$credit = "lunar orb";
				break;

			case Item::get('BugCatchingNet'):
				$credit = "stick web";
				break;

			case Item::get('BlueMail'):
				$credit = "banana hat";
				break;

			case Item::get('RedMail'):
				$credit = "purple hat";
				break;

			case Item::get('BigKey'):
			case Item::get('Key'):
				$credit = "advancement";
				break;

			case Item::get('Compass'):
				$credit = "bearings";
				break;

			case Item::get('Map'):
				$credit = "world";
				break;

			case Item::get('PieceOfHeart'):
				$credit = "little love";
				break;

			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				$credit = "love";
				break;

			case Item::get('Bomb'):
				$credit = "firecracker";
				break;

			case Item::get('ThreeBombs'):
				$credit = "fireworks";
				break;

			case Item::get('TenBombs'):
				$credit = "boom boom";
				break;

			case Item::get('Mushroom'):
				$credit = "legal drugs";
				break;

			case Item::get('Bottle'):
				$credit = "terrarium";
				break;

			case Item::get('BottleWithRedPotion'):
				$credit = "red goo";
				break;

			case Item::get('BottleWithGreenPotion'):
				$credit = "green goo";
				break;

			case Item::get('BottleWithBluePotion'):
				$credit = "blue goo";
				break;

			case Item::get('BottleWithGoldBee'):
				$credit = "beetor";
				break;

			case Item::get('BottleWithBee'):
				$credit = "mad friend";
				break;

			case Item::get('BottleWithFairy'):
				$credit = "friend";
				break;

			case Item::get('Heart'):
				$credit = "affection";
				break;

			case Item::get('Arrow'):
			case Item::get('TenArrows'):
				$credit = "sewing kit";
				break;

			case Item::get('SmallMagic'):
				$credit = "alchemy";
				break;

			case Item::get('FiftyRupees'):
			case Item::get('FiveRupees'):
			case Item::get('OneRupee'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
				$credit = "life lesson";
				break;

			case Item::get('OneHundredRupees'):
				$credit = "fair trade";
				break;

			case Item::get('ThreeHundredRupees'):
				$credit = "good return";
				break;

			case Item::get('OcarinaActive'):
			case Item::get('OcarinaInactive'):
				$credit = "duck call";
				break;

			case Item::get('PegasusBoots'):
				$credit = "sprint shoe";
				break;

			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				$credit = "bomb boost";
				break;

			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				$credit = "arrow booster";
				break;

			case Item::get('SilverArrowUpgrade'):
				$credit = "sharp arrow";
				break;

			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				$credit = "wizardry";
				break;

			case Item::get('Rupoor'):
				$credit = "double loss";
				break;

			case Item::get('Nothing'):
				$credit = "nothing";
				break;

		}

		$credit = $credit . " for sale";

		if($this->item == Item::get('BowAndSilverArrows')) {
			$credit = "you got lucky";
		}

		return $credit;
	}
}