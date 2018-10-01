<?php namespace ALttP\Location\Drop;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Bombos Tablet Location
 */
class Bombos extends Location {
	public function writeItem(Rom $rom, Item $item = null) {
		parent::writeItem($rom, $item);

		$rom->setBombosTextbox($this->getItemText());

		return $this;
	}

	private function getItemText() {
		switch ($this->item->getTarget()) {
			case Item::get('BigKeyA2'):
				return "The big key\nof evil's bane";
			case Item::get('BigKeyD7'):
				return "The big key\nof terrapins";
			case Item::get('BigKeyD4'):
				return "The big key\nof rogues";
			case Item::get('BigKeyP3'):
				return "The big key\nto moldorm's\nheart";
			case Item::get('BigKeyD5'):
				return "A frozen\nbig key\nrests here";
			case Item::get('BigKeyD3'):
				return "The big key\nof the dark\nforest";
			case Item::get('BigKeyD6'):
				return "The big key\nto Vitreous";
			case Item::get('BigKeyD1'):
				return "Hammeryump\nwith this\nbig key";
			case Item::get('BigKeyD2'):
				return "The big key\nto the swamp";
			case Item::get('BigKeyA1'):
				return "Okay, this big\nkey doesn't\nreally exist";
			case Item::get('BigKeyP2'):
				return "Sand spills\nout of this\nbig key";
			case Item::get('BigKeyP1'):
				return "The big key\nof the east";
			case Item::get('BigKeyH1'):
			case Item::get('BigKeyH2'):
				return "You should\nhave got this\nfrom a guard";
			case Item::get('KeyA2'):
				return "The small key\nof evil's bane";
			case Item::get('KeyD7'):
				return "The small key\nof terrapins";
			case Item::get('KeyD4'):
				return "The small key\nof rogues";
			case Item::get('KeyP3'):
				return "The key\nto moldorm's\nbasement";
			case Item::get('KeyD5'):
				return "A frozen\nsmall key\nrests here";
			case Item::get('KeyD3'):
				return "The small key\nof the dark\nforest";
			case Item::get('KeyD6'):
				return "The small key\nto Vitreous";
			case Item::get('KeyD1'):
				return "A small key\nthat steals\nlight";
			case Item::get('KeyD2'):
				return "Access to\nthe swamp\nis granted";
			case Item::get('KeyA1'):
				return "Agahnim\nhalfway\nunlocked";
			case Item::get('KeyP2'):
				return "Sand spills\nout of this\nsmall key";
			case Item::get('KeyP1'):
				return "Okay, this\nkey doesn't\nreally exist";
			case Item::get('KeyH1'):
			case Item::get('KeyH2'):
				return "The key to\nthe castle";
		}

		switch (get_class($this->item->getTarget())) {
			case Item\Key::class:
				return "The small key\nto the Kingdom";
			case Item\BigKey::class:
				return "The big key\nto the Kingdom";
			case Item\Map::class:
				return "You can now\nfind your way\nhome!";
			case Item\Compass::class:
				return "Now you know\nwhere the boss\nhides!";
			case Item\Egg::class:
				return "Egg-cited\nfor this";
		}

		switch ($this->item->getTarget()) {
			case Item::get('L1Sword'):
			case Item::get('L1SwordAndShield'):
				return "A pathetic\nsword rests\nhere!";
			case Item::get('L2Sword'):
			case Item::get('MasterSword'):
				return "Look at me!\nI am the\npedestal!";
			case Item::get('L3Sword'):
				return "I stole the\nblacksmith's\njob!";
			case Item::get('L4Sword'):
				return "The butter\nsword rests\nhere!";
			case Item::get('BlueShield'):
				return "Now you can\ndefend against\npebbles!";
			case Item::get('RedShield'):
				return "Now you can\ndefend against\nfireballs!";
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
				return "you can turn\nanti-faeries\ninto faeries";
			case Item::get('Bombos'):
				return "Burn, baby,\nburn! Fear my\nring of fire!";
			case Item::get('Ether'):
				return "This magic\ncoin freezes\neverything!";
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
				return "fancy a swim?";
			case Item::get('MoonPearl'):
				return "  Bunny Link\n      be\n     gone!";
			case Item::get('BugCatchingNet'):
				return "Let's catch\nsome bees and\nfaeries!";
			case Item::get('BlueMail'):
				return "Now you're a\nblue elf!";
			case Item::get('RedMail'):
				return "Now you're a\nred elf!";
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
				return "a lonely arrow\nsits here.";
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
				return "increase bomb\nstorage, low\nlow price";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "increase arrow\nstorage, low\nlow price";
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
				return "like the sands\nthrough a red\nhourglass";
			case Item::get('BlueClock'):
				return "sapphire sand\ntrickles down";
			case Item::get('GreenClock'):
				return "tick tock\ntick tock";
			case Item::get('ProgressiveSword'):
				return "a better copy\nof your sword\nfor your time";
			case Item::get('ProgressiveShield'):
				return "have a better\ndefense in\nfront of you";
			case Item::get('ProgressiveArmor'):
				return "time for a\nchange of\nclothes?";
			case Item::get('ProgressiveGlove'):
				return "a way to lift\nheavier things";
			case Item::get('singleRNG'):
			case Item::get('multiRNG'):
				return "who knows? you\nprobably don't\nneed this.";
			case Item::get('Triforce'):
				return "\n   YOU WIN!";
			case Item::get('PowerStar'):
				return "Aim for the\nmoon. You may\nhit a 'star'";
			case Item::get('TriforcePiece'):
				return "a yellow\ntriangle\nyou need this";
			case Item::get('Nothing'):
			default:
				return "Don't waste\nyour time!";
		}
	}
}
