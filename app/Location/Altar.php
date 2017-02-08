<?php namespace ALttP\Location;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Master Sword Altar Location
 */
class Altar extends Location {
	/**
	 * Sets the item for this location. The L2Sword normally sits here, so if we get MasterSword as our Item we need to
	 * change it to the L2Sword, it will make the pulling of the sword look better.
	 *
	 * @param Item|null $item Item to be placed at this Location
	 *
	 * @return $this
	 */
	public function setItem(Item $item = null) {
		if ($item == Item::get('MasterSword')) {
			$item = Item::get('L2Sword');
		}

		return parent::setItem($item);
	}

	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		$rom->setAltarCredits($this->getItemCreditsText());

		return $this;
	}


	private function getItemCreditsText() {
		switch ($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				return "the plastic sword";
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				return "and the master sword";
			case Item::get('L3Sword'):
				return "the tempered sword";
			case Item::get('L4Sword'):
				return "and the butter sword";
			case Item::get('BlueShield'):
				return "the useless shield";
			case Item::get('RedShield'):
				return "near useless shield";
			case Item::get('MirrorShield'):
				return "and the ditto shield";
			case Item::get('FireRod'):
				return "and the rage rod";
			case Item::get('IceRod'):
				return "and the freeze ray";
			case Item::get('Hammer'):
				return "and m c hammer";
			case Item::get('Hookshot'):
				return "and the tickle beam";
			case Item::get('Bow'):
				return "the stick and twine";
			case Item::get('BowAndArrows'):
				return "the stick and twine";
			case Item::get('BowAndSilverArrows'):
				return "the stick and twine";
			case Item::get('Boomerang'):
				return "the backlash stick";
			case Item::get('RedBoomerang'):
				return "and the rebound rod";
			case Item::get('Powder'):
				return "and the magic sack";
			case Item::get('Bombos'):
				return "and the swirly coin";
			case Item::get('Ether'):
				return "and the bolt coin";
			case Item::get('Quake'):
				return "and the wavy coin";
			case Item::get('Lamp'):
				return "and the flashlight";
			case Item::get('Shovel'):
				return "and the flute scoop";
			case Item::get('CaneOfSomaria'):
				return "the walking stick";
			case Item::get('StaffOfByrna'):
				return "and the blue bat";
			case Item::get('Cape'):
				return "the camouflage cape";
			case Item::get('MagicMirror'):
				return "the face reflector";
			case Item::get('PowerGlove'):
				return "and the grey mittens";
			case Item::get('TitansMitt'):
				return "and the golden glove";
			case Item::get('BookOfMudora'):
				return "and the story book";
			case Item::get('Flippers'):
				return "the water airfoil";
			case Item::get('MoonPearl'):
				return "and the jaw breaker";
			case Item::get('BugCatchingNet'):
				return "and the surprise net";
			case Item::get('BlueMail'):
				return "and the banana hat";
			case Item::get('RedMail'):
				return "and the eggplant hat";
			case Item::get('Key'):
			case Item::get('BigKey'):
				return "and the key";
			case Item::get('Compass'):
				return "and the compass";
			case Item::get('Map'):
				return "and the map";
			case Item::get('PieceOfHeart'):
				return "and the broken heart";
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "and the full heart";
			case Item::get('Bomb'):
				return "and the explosions";
			case Item::get('ThreeBombs'):
				return "the explosions";
			case Item::get('TenBombs'):
				return "the many explosions";
			case Item::get('Mushroom'):
				return "and the legal drugs";
			case Item::get('Bottle'):
				return "and the terrarium";
			case Item::get('BottleWithRedPotion'):
				return "and the red goo";
			case Item::get('BottleWithGreenPotion'):
				return "and the green goo";
			case Item::get('BottleWithBluePotion'):
				return "and the blue goo";
			case Item::get('BottleWithGoldBee'):
				return "and the beetor";
			case Item::get('BottleWithBee'):
				return "and the mad friend";
			case Item::get('BottleWithFairy'):
				return "and the fairy friend";
			case Item::get('Heart'):
				return "and the tiny heart";
			case Item::get('Arrow'):
				return "the vampire skewer";
			case Item::get('TenArrows'):
				return "the vampire skewers";
			case Item::get('SmallMagic'):
				return "and the tiny pouch";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
				return "the pocket change";
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "and the couch cash";
			case Item::get('OneHundredRupees'):
				return "and the rupee stash";
			case Item::get('ThreeHundredRupees'):
				return "and the rupee hoard";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "and the duck call";
			case Item::get('PegasusBoots'):
				return "and the sprint shoes";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "ant the bomb booster";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "and the arrow boost";
			case Item::get('SilverArrowUpgrade'):
				return "and the razer blade";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "and the magic saver";
			case Item::get('Nothing'):
			default:
				return "and nothing";
		}
	}
}
