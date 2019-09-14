<?php

namespace ALttP\Location\Drop;

use ALttP\Location;
use ALttP\Item;
use ALttP\Rom;

/**
 * Ether Tablet Location
 */
class Ether extends Location
{
    /**
     * Write item to rom.
     *
     * @param \ALttP\Rom  $rom  rom to write to
     * @param \ALttP\Item $item item to write
     *
     * @return \ALttP\Location
     */
    public function writeItem(Rom $rom, Item $item = null)
    {
        parent::writeItem($rom, $item);

        $rom->setText('tablet_ether_book', $this->getItemText());

        return $this;
    }

    private function getItemText()
    {
        $item = ($this->region->getWorld()->config('rom.genericKeys', false) && $this->item instanceof Item\Key)
            ? Item::get('KeyGK', $this->region->getWorld())
            : $this->item;

        switch ($item->getTarget()->getRawName()) {
            case 'BigKeyA2':
                return "The big key\nof evil's bane";
            case 'BigKeyD7':
                return "The big key\nof terrapins";
            case 'BigKeyD4':
                return "The big key\nof rogues";
            case 'BigKeyP3':
                return "The big key\nto moldorm's\nheart";
            case 'BigKeyD5':
                return "A frozen\nbig key\nrests here";
            case 'BigKeyD3':
                return "The big key\nof the dark\nforest";
            case 'BigKeyD6':
                return "The big key\nto Vitreous";
            case 'BigKeyD1':
                return "Hammeryump\nwith this\nbig key";
            case 'BigKeyD2':
                return "The big key\nto the swamp";
            case 'BigKeyA1':
                return "Okay, this big\nkey doesn't\nreally exist";
            case 'BigKeyP2':
                return "Sand spills\nout of this\nbig key";
            case 'BigKeyP1':
                return "The big key\nof the east";
            case 'BigKeyH1':
            case 'BigKeyH2':
                return "You should\nhave got this\nfrom a guard";
            case 'KeyA2':
                return "The small key\nof evil's bane";
            case 'KeyD7':
                return "The small key\nof terrapins";
            case 'KeyD4':
                return "The small key\nof rogues";
            case 'KeyP3':
                return "The key\nto moldorm's\nbasement";
            case 'KeyD5':
                return "A frozen\nsmall key\nrests here";
            case 'KeyD3':
                return "The small key\nof the dark\nforest";
            case 'KeyD6':
                return "The small key\nto Vitreous";
            case 'KeyD1':
                return "A small key\nthat steals\nlight";
            case 'KeyD2':
                return "Access to\nthe swamp\nis granted";
            case 'KeyA1':
                return "Agahnim\nhalfway\nunlocked";
            case 'KeyP2':
                return "Sand spills\nout of this\nsmall key";
            case 'KeyP1':
                return "Okay, this\nkey doesn't\nreally exist";
            case 'KeyH1':
            case 'KeyH2':
                return "The key to\nthe castle";
        }

        switch (get_class($item->getTarget())) {
            case Item\Key::class:
                return "A small key\nto the Kingdom";
            case Item\BigKey::class:
                return "A big key\nto the Kingdom";
            case Item\Map::class:
                return "You can now\nfind your way\nhome!";
            case Item\Compass::class:
                return "Now you know\nwhere the boss\nhides!";
            case Item\Egg::class:
                return "Egg-cited\nfor this";
        }

        switch ($item->getTarget()->getRawName()) {
            case 'L1Sword':
            case 'L1SwordAndShield':
                return "A pathetic\nsword rests\nhere!";
            case 'L2Sword':
            case 'MasterSword':
                return "Look at me!\nI am the\npedestal!";
            case 'L3Sword':
                return "I stole the\nblacksmith's\njob!";
            case 'L4Sword':
                return "The butter\nsword rests\nhere!";
            case 'BlueShield':
                return "Now you can\ndefend against\npebbles!";
            case 'RedShield':
                return "Now you can\ndefend against\nfireballs!";
            case 'MirrorShield':
                return "Now you can\ndefend against\nlasers!";
            case 'FireRod':
                return "I'm the hot\nrod. I make\nthings burn!";
            case 'IceRod':
                return "I'm the cold\nrod. I make\nthings freeze!";
            case 'Hammer':
                return "stop\nhammer time!";
            case 'Hookshot':
                return "BOING!!!\nBOING!!!\nBOING!!!";
            case 'Bow':
            case 'ProgressiveBow':
                return "You have\nchosen the\narcher class.";
            case 'BowAndArrows':
                return "You are now an\naverage archer";
            case 'BowAndSilverArrows':
                return "You are now a\nmaster archer!";
            case 'Boomerang':
                return "No matter what\nyou do, blue\nreturns to you";
            case 'RedBoomerang':
                return "No matter what\nyou do, red\nreturns to you";
            case 'Powder':
                return "you can turn\nanti-faeries\ninto faeries";
            case 'Bombos':
                return "Burn, baby,\nburn! Fear my\nring of fire!";
            case 'Ether':
                return "This magic\ncoin freezes\neverything!";
            case 'Quake':
                return "Maxing out the\nRichter scale\nis what I do!";
            case 'Lamp':
                return "Baby, baby,\nbaby.\nLight my way!";
            case 'Shovel':
                return "Can\n   You\n      Dig it?";
            case 'CaneOfSomaria':
                return "I make blocks\nto hold down\nswitches!";
            case 'CaneOfByrna':
                return "Use this to\nbecome\ninvincible!";
            case 'Cape':
                return "Wear this to\nbecome\ninvisible!";
            case 'MagicMirror':
                return "Isn't your\nreflection so\npretty?";
            case 'PowerGlove':
                return "Now you can\nlift weak\nstuff!";
            case 'TitansMitt':
                return "Now you can\nlift heavy\nstuff!";
            case 'BookOfMudora':
                return "This is a\nparadox?!";
            case 'Flippers':
                return "fancy a swim?";
            case 'MoonPearl':
                return "  Bunny Link\n      be\n     gone!";
            case 'BugCatchingNet':
                return "Let's catch\nsome bees and\nfaeries!";
            case 'BlueMail':
                return "Now you're a\nblue elf!";
            case 'RedMail':
                return "Now you're a\nred elf!";
            case 'PieceOfHeart':
                return "Just a little\npiece of love!";
            case 'BossHeartContainer':
            case 'HeartContainer':
            case 'HeartContainerNoAnimation':
                return "Maximum health\nincreased!\nYeah!";
            case 'Bomb':
                return "I make things\ngo BOOM! But\njust once.";
            case 'ThreeBombs':
                return "I make things\ngo triple\nBOOM!!!";
            case 'TenBombs':
                return "I make things\ngo BOOM!\nso many times!";
            case 'Mushroom':
                return "I'm a fun guy!\n\nI'm a funghi!";
            case 'Bottle':
                return "Now you can\nstore potions\nand stuff!";
            case 'BottleWithRedPotion':
                return "You see red\ngoo in a\nbottle?";
            case 'BottleWithGreenPotion':
                return "You see green\ngoo in a\nbottle?";
            case 'BottleWithBluePotion':
                return "You see blue\ngoo in a\nbottle?";
            case 'BottleWithGoldBee':
            case 'BottleWithBee':
                return "Release me\nso I can go\nbzzzzz!";
            case 'BottleWithFairy':
                return "If you die\nI will revive\nyou!";
            case 'Heart':
                return "I'm a lonely\nheart.";
            case 'Arrow':
                return "a lonely arrow\nsits here.";
            case 'TenArrows':
                return "This will give\nyou ten shots\nwith your bow!";
            case 'SmallMagic':
                return "A tiny magic\nrefill rests\nhere";
            case 'OneRupee':
            case 'FiveRupees':
                return "Just pocket\nchange. Move\nright along.";
            case 'TwentyRupees':
            case 'TwentyRupees2':
            case 'FiftyRupees':
                return "Just couch\ncash. Move\nright along.";
            case 'OneHundredRupees':
                return "A rupee stash!\nHell yeah!";
            case 'ThreeHundredRupees':
                return "A rupee hoard!\nHell yeah!";
            case 'OcarinaInactive':
            case 'OcarinaActive':
                return "Save the duck\nand fly to\nfreedom!";
            case 'PegasusBoots':
                return "Gotta go fast!";
            case 'BombUpgrade5':
            case 'BombUpgrade10':
            case 'BombUpgrade50':
                return "increase bomb\nstorage, low\nlow price";
            case 'ArrowUpgrade5':
            case 'ArrowUpgrade10':
            case 'ArrowUpgrade70':
                return "increase arrow\nstorage, low\nlow price";
            case 'SilverArrowUpgrade':
                return "Do you fancy\nsilver tipped\narrows?";
            case 'HalfMagic':
                return "Your magic\npower has been\ndoubled!";
            case 'QuarterMagic':
                return "Your magic\npower has been\nquadrupled!";
            case 'PendantOfCourage':
                return "Courage for\nthose who\nalready had it";
            case 'PendantOfWisdom':
                return "Wisdom for\nthose who\nalready had it";
            case 'PendantOfPower':
                return "Power for\nthose who\nalready had it";
            case 'Rupoor':
                return "This is not\nreally worth\nyour time";
            case 'RedClock':
                return "like the sands\nthrough a red\nhourglass";
            case 'BlueClock':
                return "sapphire sand\ntrickles down";
            case 'GreenClock':
                return "tick tock\ntick tock";
            case 'ProgressiveSword':
                return "a better copy\nof your sword\nfor your time";
            case 'ProgressiveShield':
                return "have a better\ndefense in\nfront of you";
            case 'ProgressiveArmor':
                return "time for a\nchange of\nclothes?";
            case 'ProgressiveGlove':
                return "a way to lift\nheavier things";
            case 'singleRNG':
            case 'multiRNG':
                return "who knows? you\nprobably don't\nneed this.";
            case 'Triforce':
                return "\n   YOU WIN!";
            case 'PowerStar':
                return "Aim for the\nmoon. You may\nhit a 'star'";
            case 'TriforcePiece':
                return "a yellow\ntriangle\nyou need this";
            case 'Nothing':
            default:
                return "Don't waste\nyour time!";
        }
    }
}
