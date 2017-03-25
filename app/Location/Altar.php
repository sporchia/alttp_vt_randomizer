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
		$rom->setPedestalTextbox($this->getItemPedestalText());

		return $this;
	}


	private function getItemCreditsText() {
		$credit = "";
		switch($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				$credit = "plastic sword";
				break;

			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				$credit = "master sword";
				break;

			case Item::get('L3Sword'):
				$credit = "tempered sword";
				break;

			case Item::get('L4Sword'):
				$credit = "butter sword";
				break;

			case Item::get('BlueShield'):
				$credit = "useless shield";
				break;

			case Item::get('RedShield'):
				$credit = "near-useless shield";
				break;

			case Item::get('MirrorShield'):
				$credit = "ditto shield";
				break;

			case Item::get('FireRod'):
				$credit = "rage rod";
				break;

			case Item::get('IceRod'):
				$credit = "freeze ray";
				break;

			case Item::get('Hammer'):
				$credit = "m c hammer";
				break;

			case Item::get('Hookshot'):
				$credit = "tickle beam";
				break;

			case Item::get('Bow'):
			case Item::get('BowAndArrows'):
			case Item::get('BowAndSilverArrows'):
				$credit = "stick and twine";
				break;

			case Item::get('Boomerang'):
				$credit = "backlash stick";
				break;

			case Item::get('RedBoomerang'):
				$credit = "rebound rod";
				break;

			case Item::get('Powder'):
				$credit = "magic sack";
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
				$credit = "flashlight";
				break;

			case Item::get('Shovel'):
				$credit = "flute scoop";
				break;

			case Item::get('CaneOfSomaria'):
				$credit = "walking stick";
				break;

			case Item::get('CaneOfByrna'):
				$credit = "blue bat";
				break;

			case Item::get('Cape'):
				$credit = "camouflage cape";
				break;

			case Item::get('MagicMirror'):
				$credit = "face reflector";
				break;

			case Item::get('PowerGlove'):
				$credit = "grey mittens";
				break;

			case Item::get('TitansMitt'):
				$credit = "golden glove";
				break;

			case Item::get('BookOfMudora'):
				$credit = "story book";
				break;

			case Item::get('Flippers'):
				$credit = "water airfoil";
				break;

			case Item::get('MoonPearl'):
				$credit = "jaw breaker";
				break;

			case Item::get('BugCatchingNet'):
				$credit = "surprise net";
				break;

			case Item::get('BlueMail'):
				$credit = "banana hat";
				break;

			case Item::get('RedMail'):
				$credit = "eggplant hat";
				break;

			case Item::get('BigKey'):
			case Item::get('Key'):
				$credit = "key";
				break;

			case Item::get('Compass'):
				$credit = "compass";
				break;

			case Item::get('Map'):
				$credit = "map";
				break;

			case Item::get('PieceOfHeart'):
				$credit = "broken heart";
				break;

			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				$credit = "full heart";
				break;

			case Item::get('Bomb'):
			case Item::get('ThreeBombs'):
				$credit = "explosions";
				break;

			case Item::get('TenBombs'):
				$credit = "many explosions";
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
				$credit = "fairy friend";
				break;

			case Item::get('Heart'):
				$credit = "tiny heart";
				break;

			case Item::get('Arrow'):
				$credit = "vampire skewer";
				break;

			case Item::get('TenArrows'):
				$credit = "vampire skewers";
				break;

			case Item::get('SmallMagic'):
				$credit = "tiny pouch";
				break;

			case Item::get('FiveRupees'):
			case Item::get('OneRupee'):
				$credit = "pocket change";
				break;

			case Item::get('FiftyRupees'):
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
				$credit = "couch cash";
				break;

			case Item::get('OneHundredRupees'):
				$credit = "rupee stash";
				break;

			case Item::get('ThreeHundredRupees'):
				$credit = "rupee hoard";
				break;

			case Item::get('OcarinaActive'):
			case Item::get('OcarinaInactive'):
				$credit = "duck call";
				break;

			case Item::get('PegasusBoots'):
				$credit = "sprint shoes";
				break;

			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				$credit = "bomb booster";
				break;

			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				$credit = "arrow booster";
				break;

			case Item::get('SilverArrowUpgrade'):
				$credit = "razor blade";
				break;

			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				$credit = "magic-saver";
				break;

			case Item::get('Rupoor'):
				$credit = "toll-booth";
				break;

			case Item::get('RedClock'):
				$credit = "ruby clock";
				break;

			case Item::get('BlueClock'):
				$credit = "sapphire clock";
				break;

			case Item::get('GreenClock'):
				$credit = "emerald clock";
				break;

			case Item::get('Nothing'):
			default:
				$credit = "nothing";
				break;

		}

		$credit = "and the " . $credit;
		return $credit;
	}

	private function getItemPedestalText() {
		switch ($this->item) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				return "A pathetic\nsword rests\nhere!";
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				return "I thought this\nwas meant to\nbe randomized?";
			case Item::get('L3Sword'):
				return "I stole the\nblacksmith's\njob!";
			case Item::get('L4Sword'):
				return "The butter\nsword rests\nhere!";
			case Item::get('BlueShield'):
				return "Now you can\ndefend against\npebbles!";
			case Item::get('RedShield'):
				return "Now you can\ndefend against\fireballs!";
			case Item::get('MirrorShield'):
				return "Now you can\ndefend against\nlasers!";
			case Item::get('FireRod'):
				return "I'm the hot\nrod. I make\nthings burn!";
			case Item::get('IceRod'):
				return "I'm the cold\nrod. I make\nthings freeze!";
			case Item::get('Hammer'):
				return "stop\nhammer time!";
			case Item::get('Hookshot'):
				return "BOING!!!\nBOING!!!\nBOING!!!";
			case Item::get('Bow'):
				return "You have\nchosen the\narcher class.";
			case Item::get('BowAndArrows'):
				return "You are now an\naverage archer";
			case Item::get('BowAndSilverArrows'):
				return "You are now a\nmaster archer!";
			case Item::get('Boomerang'):
				return "No matter what\nyou do, blue\nreturns to you";
			case Item::get('RedBoomerang'):
				return "No matter what\nyou do, red\nreturns to you";
			case Item::get('Powder'):
				return "you can turn\nanti-faeries\ninto fairies";
			case Item::get('Bombos'):
				return "Burn, baby,\nburn! Fear my\nring of fire!";
			case Item::get('Ether'):
				return "Zero Kelvin!\nAbsolute zero!\nFear the cold!";
			case Item::get('Quake'):
				return "Maxing out the\nRichter scale\nis what I do!";
			case Item::get('Lamp'):
				return "Baby, baby,\nbaby.\nLight my way!";
			case Item::get('Shovel'):
				return "Can\n   You\n      Dig it?";
			case Item::get('CaneOfSomaria'):
				return "I make blocks\nto hold down\nswitches!";
			case Item::get('CaneOfByrna'):
				return "Use this to\nbecome\ninvincible!";
			case Item::get('Cape'):
				return "Wear this to\nbecome\ninvisible!";
			case Item::get('MagicMirror'):
				return "Isn't your\nreflection so\npretty?";
			case Item::get('PowerGlove'):
				return "Now you can\nlift weak\nstuff!";
			case Item::get('TitansMitt'):
				return "Now you can\nlift heavy\nstuff!";
			case Item::get('BookOfMudora'):
				return "This is a\nparadox?!";
			case Item::get('Flippers'):
				return "Fancy a swim?";
			case Item::get('MoonPearl'):
				return "  Bunny Link\n      be\n     gone!";
			case Item::get('BugCatchingNet'):
				return "Let's catch\nsome bees and\nfaeries!";
			case Item::get('BlueMail'):
				return "Now you're a\nblue elf!";
			case Item::get('RedMail'):
				return "Now you're a\nred elf!";
			case Item::get('Key'):
				return "The small key\nto the Kingdom";
			case Item::get('BigKey'):
				return "The big key\nto the Kingdom";
			case Item::get('Compass'):
				return "Now you know\nwhere the boss\nhides!";
			case Item::get('Map'):
				return "You can now\nfind your way\nhome!";
			case Item::get('PieceOfHeart'):
				return "Just a little\npiece of love!";
			case Item::get('BossHeartContainer'):
			case Item::get('HeartContainer'):
			case Item::get('HeartContainerNoAnimation'):
				return "Maximum health\nincreased!\nYeah!";
			case Item::get('Bomb'):
				return "I make things\ngo BOOM! But\njust once.";
			case Item::get('ThreeBombs'):
				return "I make things\ngo triple\nBOOM!!!";
			case Item::get('TenBombs'):
				return "I make things\ngo BOOM!\nso many times!";
			case Item::get('Mushroom'):
				return "I'm a fun guy!\n\nI'm a funghi!";
			case Item::get('Bottle'):
				return "Now you can\nstore potions\nand stuff!";
			case Item::get('BottleWithRedPotion'):
				return "You see red\ngoo in a\nbottle?";
			case Item::get('BottleWithGreenPotion'):
				return "You see green\ngoo in a\nbottle?";
			case Item::get('BottleWithBluePotion'):
				return "You see blue\ngoo in a\nbottle?";
			case Item::get('BottleWithGoldBee'):
			case Item::get('BottleWithBee'):
				return "Release me\nso I can go\nbzzzzz!";
			case Item::get('BottleWithFairy'):
				return "If you die\nI will revive\nyou!";
			case Item::get('Heart'):
				return "I'm a lonely\nheart.";
			case Item::get('Arrow'):
				return "A lonely arrow\nsits here.";
			case Item::get('TenArrows'):
				return "This will give\nyou ten shots\nwith your bow!";
			case Item::get('SmallMagic'):
				return "A tiny magic\nrefill rests\nhere";
			case Item::get('OneRupee'):
			case Item::get('FiveRupees'):
				return "Just pocket\nchange. Move\nright along.";
			case Item::get('TwentyRupees'):
			case Item::get('TwentyRupees2'):
			case Item::get('FiftyRupees'):
				return "Just couch\ncash. Move\nright along.";
			case Item::get('OneHundredRupees'):
				return "A rupee stash!\nHell yeah!";
			case Item::get('ThreeHundredRupees'):
				return "A rupee hoard!\nHell yeah!";
			case Item::get('OcarinaInactive'):
			case Item::get('OcarinaActive'):
				return "Save the duck\nand fly to\nfreedom!";
			case Item::get('PegasusBoots'):
				return "Gotta go fast!";
			case Item::get('BombUpgrade5'):
			case Item::get('BombUpgrade10'):
			case Item::get('BombUpgrade50'):
				return "Increase bomb\nstorage, low\nlow price";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "Increase arrow\nstorage, low\nlow price";
			case Item::get('SilverArrowUpgrade'):
				return "Do you fancy\nsilver tipped\narrows?";
			case Item::get('HalfMagic'):
				return "Your magic\npower has been\ndoubled!";
			case Item::get('QuarterMagic'):
				return "Your magic\npower has been\nquadrupled!";
			case Item::get('PendantOfCourage'):
				return "Courage for\nthose who\nalready had it";
			case Item::get('PendantOfWisdom'):
				return "Wisdom for\nthose who\nalready had it";
			case Item::get('PendantOfPower'):
				return "Power for\nthose who\nalready had it";
			case Item::get('Rupoor'):
				return "This is not\nreally worth\nyour time";
			case Item::get('RedClock'):
				return "Like the sands\nthrough a red\nhourglass";
			case Item::get('BlueClock'):
				return "Sapphire sand\ntrickles down";
			case Item::get('GreenClock'):
				return "tick tock\ntick tock";
			case Item::get('Nothing'):
			default:
				return "Don't waste\nyour time!";
		}
	}
}