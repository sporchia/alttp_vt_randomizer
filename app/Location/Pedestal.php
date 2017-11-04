<?php namespace ALttP\Location;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Master Sword Pedestal Location
 */
class Pedestal extends Location {
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

		$rom->setPedestalCredits($this->getItemCreditsText());
		$rom->setPedestalTextbox($this->getItemPedestalText());

		return $this;
	}


	private function getItemCreditsText() {
		switch ($this->item) {
			case Item::get('BigKeyA2'):
				return "la key of evils bane";
		}

		switch (get_class($this->item)) {
			case Item\Key::class:
			case Item\BigKey::class:
				return "and the key";
			case Item\Map::class:
				return "and the map";
			case Item\Compass::class:
				return "and the compass";
		}

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
			case Item::get('CaneOfByrna'):
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
				return "and the bomb booster";
			case Item::get('ArrowUpgrade5'):
			case Item::get('ArrowUpgrade10'):
			case Item::get('ArrowUpgrade70'):
				return "and the arrow boost";
			case Item::get('SilverArrowUpgrade'):
				return "and the razer blade";
			case Item::get('HalfMagic'):
			case Item::get('QuarterMagic'):
				return "and the magic saver";
			case Item::get('Rupoor'):
				return "and the toll-booth";
			case Item::get('RedClock'):
				return "and the ruby clock";
			case Item::get('BlueClock'):
				return "the sapphire clock";
			case Item::get('GreenClock'):
				return "the emerald clock";
			case Item::get('ProgressiveSword'):
				return "the unknown sword";
			case Item::get('ProgressiveShield'):
				return "the unknown shield";
			case Item::get('ProgressiveArmor'):
				return "the unknown hat";
			case Item::get('ProgressiveGlove'):
				return "the magic hand cover";
			case Item::get('singleRNG'):
			case Item::get('multiRNG'):
				return "the whatever";
			case Item::get('Triforce'):
				return "and the triforce";
			case Item::get('PowerStar'):
				return "and the power star";
			case Item::get('TriforcePiece'):
				return "the triforce piece";
			case Item::get('Nothing'):
			default:
				return "and nothing";
		}
	}

	private function getItemPedestalText() {
		switch ($this->item) {
			case Item::get('BigKeyA2'):
				return "The Big Key\nof evils bane";
			case Item::get('BigKeyD7'):
				return "The big key\nof terrorpins";
			case Item::get('BigKeyD4'):
				return "The Big Key\nof rouges";
			case Item::get('BigKeyP3'):
				return "The big key\nto moldorms\nheart";
			case Item::get('BigKeyD5'):
				return "A frozen\nbig key\nrests here";
			case Item::get('BigKeyD3'):
				return "The big key\nof the dark\nforest";
			case Item::get('BigKeyD6'):
				return "The big key\nto Vitreous";
			case Item::get('BigKeyD1'):
				return "Hammeryump\nwith this\nbig key";
			case Item::get('BigKeyD2'):
				return "The Big key\nto the swamp";
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
				return "The small key\nof evils bane";
			case Item::get('KeyD7'):
				return "The small key\nof terrorpins";
			case Item::get('KeyD4'):
				return "The small key\nof rouges";
			case Item::get('KeyP3'):
				return "The key\nto moldorms\nbasement";
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
				return "Agahanim\nhalfway\nunlocked";
			case Item::get('KeyP2'):
				return "Sand spills\nout of this\nsmall key";
			case Item::get('KeyP1'):
				return "Okay, this\nkey doesn't\nreally exist";
			case Item::get('KeyH1'):
			case Item::get('KeyH2'):
				return "The key to\nthe castle";
		}

		switch (get_class($this->item)) {
			case Item\Key::class:
				return "The small key\nto the Kingdom";
			case Item\BigKey::class:
				return "The big key\nto the Kingdom";
			case Item\Map::class:
				return "You can now\nfind your way\nhome!";
			case Item\Compass::class:
				return "Now you know\nwhere the boss\nhides!";
		}

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
				return "you can turn\nanti-faeries\ninto fairies";
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
