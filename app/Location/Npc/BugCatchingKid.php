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
		switch (get_class($this->item->getTarget())) {
			case Item\Key::class:
			case Item\BigKey::class:
				return "the key-holding kid";
			case Item\Map::class:
				return "the cartographer kid";
			case Item\Compass::class:
				return "the navigating kid";
			case Item\Egg::class:
				return "the decorating kid";
		}

		switch ($this->item->getTarget()) {
			case Item::get('ProgressiveSword'):
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
			case Item::get('L3Sword'):
			case Item::get('L4Sword'):
				return "sword-wielding kid";
			case Item::get('ProgressiveShield'):
			case Item::get('BlueShield'):
			case Item::get('RedShield'):
			case Item::get('MirrorShield'):
				return "shield-wielding kid";
			case Item::get('FireRod'):
				return "fire-starting kid";
			case Item::get('IceRod'):
				return "the ice-bending kid";
			case Item::get('Hammer'):
				return "hammer-smashing kid";
			case Item::get('Hookshot'):
				return "tickle-monster kid";
			case Item::get('Bow'):
				return "arrow-slinging kid";
			case Item::get('BowAndArrows'):
				return "arrow-slinging kid";
			case Item::get('BowAndSilverArrows'):
				return "arrow-slinging kid";
			case Item::get('Boomerang'):
				return "the bat-throwing kid";
			case Item::get('RedBoomerang'):
				return "the bat-throwing kid";
			case Item::get('Powder'):
				return "the sack-holding kid";
			case Item::get('Bombos'):
				return "coin-collecting kid";
			case Item::get('Ether'):
				return "coin-collecting kid";
			case Item::get('Quake'):
				return "coin-collecting kid";
			case Item::get('Lamp'):
				return "light-shining kid";
			case Item::get('Shovel'):
				return "archaeologist kid";
			case Item::get('CaneOfSomaria'):
				return "the block-making kid";
			case Item::get('CaneOfByrna'):
				return "the spark-making kid";
			case Item::get('Cape'):
				return "red riding-hood kid";
			case Item::get('MagicMirror'):
				return "the narcissistic kid";
			case Item::get('ProgressiveGlove'):
			case Item::get('PowerGlove'):
			case Item::get('TitansMitt'):
				return "body-building kid";
			case Item::get('BookOfMudora'):
				return "the scholarly kid";
			case Item::get('Flippers'):
				return "the swimming kid";
			case Item::get('MoonPearl'):
				return "fortune-telling kid";
			case Item::get('BugCatchingNet'):
				return "the bug-catching kid";
			case Item::get('ProgressiveArmor'):
			case Item::get('BlueMail'):
				return "the protected kid";
			case Item::get('RedMail'):
				return "well-protected kid";
			case Item::get('PieceOfHeart'):
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "the life-giving kid";
			case Item::get('Bomb'):
			case Item::get('ThreeBombs'):
			case Item::get('TenBombs'):
				return "the bomb-holding kid";
			case Item::get('Mushroom'):
				return "the drug-dealing kid";
			case Item::get('Bottle'):
				return "the terrarium kid";
			case Item::get('BottleWithRedPotion'):
			case Item::get('BottleWithGreenPotion'):
			case Item::get('BottleWithBluePotion'):
				return "potion-slinging kid";
			case Item::get('BottleWithGoldBee'):
			case Item::get('BottleWithBee'):
				return "the bug-caught kid";
			case Item::get('BottleWithFairy'):
				return "fairy-catching kid";
			case Item::get('Heart'):
				return "affection-giving kid";
			case Item::get('Arrow'):
			case Item::get('TenArrows'):
				return "stick-collecting kid";
			case Item::get('SmallMagic'):
				return "magic-slinging kid";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
				return "poverty-struck kid";
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "the piggy-bank kid";
			case Item::get('OneHundredRupees'):
				return "the kind-of-rich kid";
			case Item::get('ThreeHundredRupees'):
				return "the really-rich kid";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "the duck-call kid";
			case Item::get('PegasusBoots'):
				return "the running-man kid";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "boom-enlarging kid";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "quiver-enlarging kid";
			case Item::get('SilverArrowUpgrade'):
				return "arrow-sharpening kid";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "the magic-saving kid";
			case Item::get('Rupoor'):
				return "the toll-booth kid";
			case Item::get('RedClock'):
				return "the ruby-time kid";
			case Item::get('BlueClock'):
				return "the indigo-time kid";
			case Item::get('GreenClock'):
				return "the emerald-time kid";
			case Item::get('singleRNG'):
			case Item::get('multiRNG'):
				return "the something kid";
			case Item::get('Triforce'):
				return "the game-winning kid";
			case Item::get('PowerStar'):
				return "the starry-eyed kid";
			case Item::get('TriforcePiece'):
				return "triforce-holding kid";
			case Item::get('Nothing'):
			default:
				return "nothing-having kid";
		}
	}
}
