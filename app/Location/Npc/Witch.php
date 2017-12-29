<?php namespace ALttP\Location\Npc;

use ALttP\Item;
use ALttP\Location\Npc;
use ALttP\Rom;

/**
 * Witch specifically changes the credits when you write an item.
 */
class Witch extends Npc {
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		$rom->setMagicShopCredits($this->getItemCreditsText());

		return $this;
	}

	private function getItemCreditsText() {
		switch (get_class($this->item)) {
			case Item\Key::class:
			case Item\BigKey::class:
				return "keys, keys, keys";
			case Item\Map::class:
				return "shrooms find secrets";
			case Item\Compass::class:
				return "shrooms for navigation";
		}

		switch ($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				return "fungus for slasher";
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				return "fungus for blue slasher";
			case Item::get('L3Sword'):
				return "fungus for red slasher";
			case Item::get('L4Sword'):
				return "cap churned to butter";
			case Item::get('BlueShield'):
				return "fungus for shield";
			case Item::get('RedShield'):
				return "fungus for fire shield";
			case Item::get('MirrorShield'):
				return "fungus for shiny shield";
			case Item::get('FireRod'):
				return "fungus for rage-rod";
			case Item::get('IceRod'):
				return "fungus for ice-rod";
			case Item::get('Hammer'):
				return "stop...   hammer time";
			case Item::get('Hookshot'):
				return "witch and tickle boy";
			case Item::get('Bow'):
				return "witch and robin hood";
			case Item::get('BowAndArrows'):
				return "witch and robin hood";
			case Item::get('BowAndSilverArrows'):
				return "witch and robin hood";
			case Item::get('Boomerang'):
				return "fungus for puma-stick";
			case Item::get('RedBoomerang'):
				return "fungus for return-stick";
			case Item::get('Powder'):
				return "the witch and assistant";
			case Item::get('Bombos'):
				return "shrooms for swirly-coin";
			case Item::get('Ether'):
				return "shrooms for bolt-coin";
			case Item::get('Quake'):
				return "shrooms for wavy-coin";
			case Item::get('Lamp'):
				return "fungus for illumination";
			case Item::get('Shovel'):
				return "can you dig it";
			case Item::get('CaneOfSomaria'):
				return "twizzle-stick for trade";
			case Item::get('CaneOfByrna'):
				return "spark-stick for trade";
			case Item::get('Cape'):
				return "what's a tog?";
			case Item::get('MagicMirror'):
				return "trades looking-glass";
			case Item::get('PowerGlove'):
				return "fungus for gloves";
			case Item::get('TitansMitt'):
				return "fungus for bling-gloves";
			case Item::get('BookOfMudora'):
				return "drugs for literacy";
			case Item::get('Flippers'):
				return "shrooms let you swim";
			case Item::get('MoonPearl'):
				return "shrooms for moon rock";
			case Item::get('BugCatchingNet'):
				return "fungus for butterflies";
			case Item::get('BlueMail'):
				return "the clothing store";
			case Item::get('RedMail'):
				return "the nice clothing store";
			case Item::get('PieceOfHeart'):
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "fungus for life";
			case Item::get('Bomb'):
			case Item::get('ThreeBombs'):
			case Item::get('TenBombs'):
				return "blend fungus into bombs";
			case Item::get('Mushroom'):
				return "my name is error";
			case Item::get('Bottle'):
				return "first taste is not free";
			case Item::get('BottleWithRedPotion'):
			case Item::get('BottleWithGreenPotion'):
			case Item::get('BottleWithBluePotion'):
				return "free samples";
			case Item::get('BottleWithGoldBee'):
			case Item::get('BottleWithBee'):
				return "insects for trade";
			case Item::get('BottleWithFairy'):
				return "shrooms for friends";
			case Item::get('Heart'):
				return "trading for transplant";
			case Item::get('Arrow'):
				return "fungus for arrow";
			case Item::get('TenArrows'):
				return "fungus for arrows";
			case Item::get('SmallMagic'):
				return "fungus for magic";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
				return "buying cheap drugs";
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "the witch buying drugs";
			case Item::get('OneHundredRupees'):
				return "buying good drugs";
			case Item::get('ThreeHundredRupees'):
				return "buying the best drugs";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "duck-calls for trade";
			case Item::get('PegasusBoots'):
				return "shrooms for speed";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "the shroom goes boom";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "witch and more arrows";
			case Item::get('SilverArrowUpgrade'):
				return "arrow-honing service";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "mekalekahi mekahiney ho";
			case Item::get('Rupoor'):
				return "witch stole your rupees";
			case Item::get('RedClock'):
				return "shrooms for ruby time";
			case Item::get('BlueClock'):
				return "fungus for blue time";
			case Item::get('GreenClock'):
				return "shrooms for green time";
			case Item::get('ProgressiveSword'):
				return "fungus for some slasher";
			case Item::get('ProgressiveShield'):
				return "fungus for some shield";
			case Item::get('ProgressiveArmor'):
				return "the clothing store";
			case Item::get('ProgressiveGlove'):
				return "fungus for gloves";
			case Item::get('singleRNG'):
			case Item::get('multiRNG'):
				return "fungus for something";
			case Item::get('Triforce'):
				return "mushrooms win the game";
			case Item::get('PowerStar'):
				return "the powder or the stars";
			case Item::get('TriforcePiece'):
				return "hoarding for ganon";
			case Item::get('Nothing'):
			default:
				return "mushrooms go poof";
		}
	}
}
